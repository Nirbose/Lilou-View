<?php

namespace LilouView\Compilers;

use LilouView\LilouView;
use LilouView\Parser;

class LilouCompiler {

    private string $cache;

    private string $name;

    public function __construct(string $name, string $cache)
    {
        $this->name = $name;
        $this->cache = $cache;
    }

    public function compile(string $content, array $data) {
        $parse =  Parser::parse($content);

        $pattern = '/\{\{(.*)\}\}/';
        preg_match_all($pattern, $parse, $matches);

        foreach ($matches[1] as $match) {
            $parse = str_replace('{{' . $match . '}}', $data[trim(substr($match, 2, strlen($match) - 1))], $parse);
        }

        if (is_dir($this->cache . '/cache/') === false) {
            mkdir($this->cache . '/cache/', 0777, true);
        }

        $file = $this->cache . '/cache/' . sha1($this->name) . '.php';

        file_put_contents($file, $parse);
    }
}
