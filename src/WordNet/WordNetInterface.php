<?php

namespace WordNetPHP\WordNet;

interface WordNetInterface
{
    /**
     * Construct.
     *
     * @param string $wordNetPath
     */
    public function __construct($wordNetPath);

    /**
     * Get overview of word entry.
     *
     * @param string $word
     *
     * @return string
     */
    public function overview($word);
}
