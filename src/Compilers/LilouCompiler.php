<?php

namespace LilouView\Compilers;

use LilouView\Config\Config;
use LilouView\LilouView;
use LilouView\Parser;

class LilouCompiler {

    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function compile(string $content, array $data)
    {
        $tags = new LilouTagsCompiler();
        $parse = $tags->compile($content);

        $parse =  Parser::parse($parse);

        $pattern = '/\{\{(.*)\}\}/';
        preg_match_all($pattern, $parse, $matches);

        foreach ($matches[1] as $match) {
            $parse = str_replace('{{' . $match . '}}', $data[trim(substr($match, 2, strlen($match) - 1))], $parse);
        }

        $file = trim(Config::get('cacheFolderPath'), '/') . '/' . sha1($this->name) . '.php';

        file_put_contents($file, $parse);
    }
}
