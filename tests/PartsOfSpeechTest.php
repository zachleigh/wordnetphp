<?php

namespace WordNet\Tests;

use WordNet\WordNet;
use WordNet\Tests\TestCase;

class PartsOfSpeechTest extends TestCase
{
    /**
     * @var WordNet\WordNet
     */
    public static $wordnet;

    /**
     * Set static WordNet on object.
     */
    public static function setUpBeforeClass()
    {
        self::$wordnet = new WordNet();
    }

    /**
     * @test
     */
    public function it_gets_single_part_of_speech()
    {
        $result = self::$wordnet->lookup('tv')->pos();

        $this->assertEquals(['noun'], $result);
    }

    /**
     * @test
     */
    public function it_gets_two_parts_of_speech()
    {
        $result = self::$wordnet->lookup('drink')->pos();

        $this->assertEquals(['noun', 'verb'], $result);
    }

    /**
     * @test
     */
    public function it_gets_three_parts_of_speech()
    {
        $result = self::$wordnet->lookup('slow')->pos();

        $this->assertEquals(['verb', 'adjective', 'adverb'], $result);
    }

    /**
     * @test
     */
    public function it_gets_four_parts_of_speech()
    {
        $result = self::$wordnet->lookup('fast')->pos();

        $this->assertEquals(['noun', 'verb', 'adjective', 'adverb'], $result);
    }
}
