<?php

namespace WordNetPHP;

use WordNetPHP\Config\Config;
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
    public function __construct($configFile = null)
    {
        $this->config = Config::getInstance($configFile);

        $wordNetPath = $this->config->getPath();

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
}
