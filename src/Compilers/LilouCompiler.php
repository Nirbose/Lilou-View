<?php

namespace LilouView\Compilers;

use LilouView\LilouView;
use LilouView\Parser;

class LilouCompiler extends LilouView {

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

    public function compile(string $content, string $name) {
        $parse =  Parser::parse($content);

        if (is_dir($this->folder . 'view/cache/') === false) {
            mkdir($this->folder . 'view/cache/', 0777, true);
        }

        $file = $this->folder . 'view/cache/' . sha1($name) . '.php';

        file_put_contents($file, $parse);
    }
}
