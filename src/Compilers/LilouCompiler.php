<?php

namespace LilouView\Compilers;

use LilouView\Parser;

class LilouCompiler {

    /**
     * Array of open and closing tags for escaped content
     *
     * @var array
     */
    protected array $rawTags = ['{!', '!}'];

    /**
     * Array of open and closing tags for content
     *
     * @var array
     */
    protected array $contentTags = ['{{', '}}'];

    private string $item;

    public function compile(string $content) {
        $parse =  Parser::parse($content);
        dump($parse);
        return $parse;
    }
}
