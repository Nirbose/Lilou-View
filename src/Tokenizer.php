<?php

namespace Nirbose\LilouView;

use Nirbose\LilouView\Exception\TokenizerException;

class Tokenizer {

    private array $regex = [
        'function' => '',
        'variable' => '',
    ];

    /**
     * Get instance of Tokenizer
     *
     * @return static
     */
    private static function me(): static
    {
        return new static();
    }

    /**
     * Parse a string
     *
     * @param string $content
     * @return void
     */
    public static function parse(string $content)
    {

    }

    private function replace(): array
    {
        return [];
    }

}
