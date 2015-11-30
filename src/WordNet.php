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
        $result = shell_exec($this->config['path'].' '.$word.' -over');

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
