<?php

namespace WordNet;

use WordNet\Parse\Parsers\PartsOfSpeech;

class WordNet
{
    /**
     * Result from the lookup method.
     *
     * @var string
     */
    private $result;

    /**
     * Construct.
     */
    public function __construct()
    {
        $this->config = include dirname(__DIR__).'/src/config.php';
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
        $path = $this->getWordNetPath();

        $result = shell_exec($path.' '.$word.' -over');

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
            return $this->config['path'];
        }

        $path = trim(shell_exec('which wn'));

        if (!$path) {
            throw new \Exception('WordNet cannot be found.');
        }

        return $path;
    }
}
