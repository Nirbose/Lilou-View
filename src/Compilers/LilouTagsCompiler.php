<?php

namespace LilouView\Compilers;

use LilouView\Config\Config;

class LilouTagsCompiler {

    private array $htmlTags = [
        '<l-(.*)>', 
        '<\/l-(.*)>', 
        '<l-(.*)\/>'
    ];

    public function compile(string $content): string
    {
        $pattern = '/' . $this->htmlTags[0] . '(.*)' . $this->htmlTags[1] . '/';
        preg_match_all($pattern, $content, $matches);

        foreach ($matches[1] as $key => $matche) {
            dump($matche);

            $component = file_get_contents(dirname(__DIR__) . '/../' . trim(Config::get('componentsFolderPath'), '/') . '/' . $matche . '.lilou.php');

            $content = str_replace($matches[0][$key], $component, $content);
        }

        return $content;
    }

}