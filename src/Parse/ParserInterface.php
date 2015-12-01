<?php

namespace WordNetPHP\Parse;

interface ParserInterface
{
    /**
     * Construct.
     *
     * @param string $result
     */
    public function __construct($result);

    /**
     * Handle the parse.
     *
     * @return string/array
     */
    public function handle();
}
