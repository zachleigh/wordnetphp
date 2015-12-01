<?php

namespace WordNetPHP\tests;

use WordNetPHP\WordNetPHP;
use WordNetPHP\Tests\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @test
     *
     * @expectedException Exception
     * @expectedExceptionMessage Invalid path provided in config.php.
     */
    public function it_throws_exception_for_invalid_path()
    {
        $wordnet = new WordNetPHP(['path' => '/usr/wn']);
    }
}
