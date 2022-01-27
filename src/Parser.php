<?php

namespace LilouView;

class Parser {

    protected static string $item = "";

    public static function parse(string $content): string
    {
        preg_match_all('/@(.*)/', $content, $matches);

        foreach ($matches[1] as $key => $match) {
            $match = trim($match);
            preg_match('/\((.*)\)/', $match, $args);

            if (count($args) > 0) {
                $match = str_replace($args[0], '', $match);
                self::$item = $args[0];
            }

            $content = self::render($match, $matches[0][$key], $content);
        }

        return $content;
    }

    private static function render(string $func, string $init, string $content): string
    {
        if (!empty(self::$item)) {
            $func = "<?php " . $func . self::$item . " ?>";
            self::$item = "";
        } else {
            $func = "<?php " . $func . " ?>";
        }

        return str_replace($init, $func, $content);
    }
}
