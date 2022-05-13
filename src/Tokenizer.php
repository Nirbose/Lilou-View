<?php

namespace Nirbose\LilouView;

use Nirbose\LilouView\Exception\TokenizerException;

class Tokenizer {

    /**
     * @var array Array of regex patterns to match
     */
    const TOKEN_REGEX = [
        "func" => '/@([A-Za-z0-9\ \t]+)\((.*)\)/',
        "var" => '/{([A-Za-z0-9]+)}/',
    ];

    /**
     * @var string The template string
     */
    private string $template;

    /**
     * @var array Array of tokens
     */
    private array $token_types = [
        "func" => [],
        "var" => [],
    ];
    
    public static function create(string $template) {
        return new Tokenizer($template);
    }

    /**
     * Tokenizer constructor.
     * @param string $template
     */
    public function __construct(string $template) {
        $this->template = $template;
        $this->tokenize();
    }

    /**
     * Tokenize the template string
     * @return void
     * @throws TokenizerException
     */
    private function tokenize() {
        foreach (self::TOKEN_REGEX as $token_type => $regex) {
            preg_match_all($regex, $this->template, $matches);
            $this->token_types[$token_type] = $matches;
        }
    }

    /**
     * Get the tokens
     * 
     * @return array
     */
    public function getTokens(): array
    {
        return $this->token_types;
    }

    /**
     * Get the token type
     * 
     * @param string $type
     * @return array
     */
    public function getTokenType(string $type): array
    {
        return $this->token_types[$type];
    }

}
