<?php

namespace Nirbose\LilouView;

use Nirbose\LilouView\Exception\TokenizerException;

class Tokenizer {

    const REGEX_FUNCTION = '/@([\d\w\s]+)\((.*)\)/';
    const REGEX_VARIABLE = '';

    private static string $view;
    public array $tokens = [];
    private static array $noClosuresTokens = [
        'endif', 'enddeclare', 'endfor', 'endforeach', 'endswitch', 'endwhile'
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

    public static function setToken(string $name, callable $function)
    {
        static::me()->tokens[$name] = $function;
    }

    /**
     * Parse a string
     *
     * @param string $content
     * @return string
     */
    public static function tokenize(string $content)
    {
        static::$view = $content;

        return static::parser(Tokenizer::REGEX_FUNCTION);
    }

    private static function parser(string $regex)
    {
        preg_match_all($regex, static::$view, $matches);

        foreach ($matches[1] as $i => $name) {

            $replace = "<?php " . $name;

            if (! in_array($name, static::$noClosuresTokens)) {
                $replace .= " (". $matches[2][$i] . "); ?>";
            }

            static::$view = static::replace($matches[0][$i], $replace);
        }

        return static::$view;
    }

    private static function replace($search, $replace)
    {
        return str_replace($search, $replace, static::$view);
    }

}
