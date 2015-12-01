<?php

namespace WordNetPHP\Parse;

class Parser
{
    /**
     * @var string
     */
    protected $result;

    /**
     * Construct.
     *
     * @param string $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * Explode results by line breaks.
     *
     * @param string $result
     *
     * @return array
     */
    protected function getResultArray()
    {
        return explode("\n", $this->result);
    }

    /**
     * Get array of lines that contain needle.
     *
     * @param string $needle
     *
     * @return array
     */
    protected function lineSearch($needle)
    {
        $resultArray = $this->getResultArray();

        return array_filter($resultArray, function ($line) use ($needle) {
            return strpos($line, $needle) !== false;
        });
    }
}
