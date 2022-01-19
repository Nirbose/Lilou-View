<?php

namespace LilouView;

class LilouFunc {

    public function echo(string $content, ?string $no_return_line = "false"): string
    {
        if ($no_return_line != "true") {
            return $content . PHP_EOL;
        } else {
            return $content;
        }
    }

    public function include(string $file)
    {
        include $file;
    }

}
