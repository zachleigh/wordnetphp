<?php

namespace WordNetPHP\Tests;

use WordNetPHP\WordNetPHP;
use WordNetPHP\Tests\TestCase;

class WordNetPHPTest extends TestCase
{
    /**
     * @var WordNetPHP\WordNetPHP
     */
    public static $wordnet;

    /**
     * Set static WordNetPHP on object.
     */
    public static function setUpBeforeClass()
    {
        self::$wordnet = new WordNetPHP();
    }

    /**
     * @test
     */
    public function it_returns_raw_lookup_string()
    {
        $result = self::$wordnet->lookup('hello')->raw();

        $expected = "\n".
            'Overview of noun hello' . "\n"."\n".
            'The noun hello has 1 sense (first 1 from tagged texts)'."\n".
            '                                           '."\n".
            '1. (1) hello, hullo, hi, howdy, how-do-you-do -- (an expression of greeting; "every morning they exchanged polite hellos")'."\n";
        
        $this->assertEquals($expected, $result);
    }
}
