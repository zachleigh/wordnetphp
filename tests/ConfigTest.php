<?php

namespace WordNetPHP\tests;

use WordNetPHP\WordNetPHP;
use WordNetPHP\Config\Config;
use WordNetPHP\Tests\TestCase;

class ConfigTest extends TestCase
{
    /**
     * Reset config file after class.
     */
    public function tearDown()
    {
        $config = Config::getInstance();

        $config->setConfigFile();
    }

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
