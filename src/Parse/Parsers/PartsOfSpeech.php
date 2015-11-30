<?php

namespace WordNet\Parse\Parsers;

use WordNet\Parse\Parser;
use WordNet\Parse\ParserInterface;

class PartsOfSpeech extends Parser implements ParserInterface
{
    /**
     * Conversions for pos abbreviations.
     *
     * @var array
     */
    private $conversions = [
        'adv' => 'adverb',
        'adj' => 'adjective',
    ];

    /**
     * Construct.
     *
     * @param string $result
     */
    public function __construct($result)
    {
        parent::__construct($result);
    }

    /**
     * Handle the parse.
     *
     * @return array
     */
    public function handle()
    {
        $posLines = $this->lineSearch('Overview');

        $partsOfSpeech = array_map([$this, 'getPartOfSpeech'], $posLines);

        return array_values($partsOfSpeech);
    }

    /**
     * Get part of speech from overview output line.
     *
     * @param string $line
     *
     * @return string
     */
    private function getPartOfSpeech($line)
    {
        $lineArray = explode(' ', $line);

        $pos = $lineArray[2];

        if (in_array($pos, array_keys($this->conversions))) {
            $pos = $this->conversions[$pos];
        }

        return $pos;
    }
}
