<?php

namespace WordNetPHP\WordNet;

class WordNetConsole
{
    /**
     * Path to wordnet.
     *
     * @var string
     */
    private $wordNetPath;

    /**
     * Construct.
     *
     * @param string $wordNetPath
     */
    public function __construct($wordNetPath)
    {
        $this->wordNetPath = $wordNetPath;
    }

    /**
     * Get overview of word entry.
     *
     * @param string $word
     *
     * @return string
     */
    public function overview($word)
    {
        return shell_exec($this->wordNetPath.' "'.$word.'" -over');
    }
}
