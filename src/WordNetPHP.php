<?php

namespace WordNetPHP;

use WordNetPHP\WordNet\WordNetConsole;
use WordNetPHP\Parse\Parsers\PartsOfSpeech;

class WordNetPHP
{
    /**
     * Config array.
     *
     * @var array
     */
    private $config;

    /**
     * WordNet access.
     *
     * @var WordNetPHP\WordNet\WordNetInterface
     */
    private $wordNet;

    /**
     * Result from the lookup method.
     *
     * @var string
     */
    private $result;

    /**
     * Construct.
     */
    public function __construct($config = null)
    {
        $this->config = ($config ? $config : include dirname(__DIR__).'/src/config.php');

        $wordNetPath = $this->getWordNetPath();

        $this->wordNet = new WordNetConsole($wordNetPath);
    }

    /**
     * Lookup a word.
     *
     * @param string $word
     *
     * @return this
     */
    public function lookup($word)
    {
        $result = $this->wordNet->overview($word);

        $this->result = $result;

        return $this;
    }

    /**
     * Get all possible parts of speech for word in array.
     *
     * @return array
     */
    public function pos()
    {
        $parser = new PartsOfSpeech($this->result);

        return $parser->handle();
    }

    /**
     * Find WordNet path.
     *
     * @return string/Exception
     */
    private function getWordNetPath()
    {
        if ($this->config['path']) {
            if (!$this->commandExists()) {
                throw new \Exception('Invalid path provided in config.php.');
            }

            return $this->config['path'];
        }

        $path = trim(shell_exec('which wn'));

        if (!$path) {
            throw new \Exception('WordNet cannot be found on local machine.');
        }

        return $path;
    }

    /**
     * Validate command exists.
     *
     * @return bool
     */
    private function commandExists()
    {
        $response = shell_exec('which '.$this->config['path']);

        return (empty($response) ? false : true);
    }
}
