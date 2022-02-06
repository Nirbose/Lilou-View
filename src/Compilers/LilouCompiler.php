<?php

namespace LilouView\Compilers;

use LilouView\LilouView;
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

    public static function compile(string $content, string $name, string $folder = "") {
        $parse =  Parser::parse($content);

        if (is_dir($folder . '/cache/') === false) {
            mkdir($folder . '/cache/', 0777, true);
        }

        $file = $folder . '/cache/' . sha1($name) . '.php';

        file_put_contents($file, $parse);
    }
}
