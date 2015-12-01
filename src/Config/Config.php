<?php

namespace WordNetPHP\Config;

class Config
{
    /**
     * Config file.
     *
     * @var array
     */
    private $configFile;

    /**
     * Instance of self.
     *
     * @var self
     */
    private static $instance;

    /**
     * Private construct.
     *
     * @param array $configFile
     */
    private function __construct($configFile)
    {
        $this->setConfigFile($configFile);
    }

    /**
     * Get instance of self.
     *
     * @param array $configFile
     *
     * @return self
     */
    public static function getInstance($configFile = null)
    {
        if (!isset(self::$instance)) {
            self::$instance = new self($configFile);
        }

        return self::$instance;
    }

    /**
     * Set configFile on object.
     *
     * @param array $configFile
     * @param string
     */
    public function setConfigFile($configFile = null)
    {
        if ($configFile) {
            $this->configFile = $configFile;
        } elseif (function_exists('config') && config('wordnetphp') !== null) {
            $this->configFile = config('wordnetphp');
        } else {
            $this->configFile = include dirname(__DIR__).'/config.php';
        }
    }

    /**
     * Find path to WordNet on machine.
     *
     * @return string/Exception
     */
    public function getPath()
    {
        if ($this->configFile['path']) {
            if (!$this->commandExists()) {
                throw new \Exception('Invalid path provided in config.php.');
            }

            return $this->configFile['path'];
        }

        $path = trim(shell_exec('which wn'));

        if (!$path) {
            throw new \Exception('WordNet cannot be found on local machine.');
        }

        return $path;
    }

    /**
     * Validate command exists.
     *
     * @return bool
     */
    private function commandExists()
    {
        $response = shell_exec('which '.$this->configFile['path']);

        return (empty($response) ? false : true);
    }
}
