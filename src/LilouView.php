<?php

namespace Nirbose\LilouView;

use Exception;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;

/**
 * LilouView class
 * 
 * @method Option make()
 * @method void set()
 * @method string render()
 * @method bool exists()
 */
class LilouView {

    private static string $cache = './';
    private static string $path = './';

    /**
     * Make a view
     *
     * @param string $name
     * @param array $data
     * @return LilouOption
     */
    public static function make(string $name, array $data = []): LilouOption
    {
        $filesystem = new Filesystem();
        $filename = static::$path . $name . '.lilou.php';

        if ( !$filesystem->exists($name . '.lilou.php') )  {
            new FileNotFoundException("File not found");
        }

        $content = file_get_contents($filename);

        $render = Tokenizer::tokenize($content);
        file_put_contents(static::$cache . $name . ".php", $render);

        return new LilouOption();
    }

    /**
     * Set a cache
     * 
     * @param string $path
     * @return void
     */
    public static function set(string $key, string $value)
    {
        $value = trim($value, '/') . '/';

        switch (strtolower($key)) {
            case 'cache':
                static::$cache = $value;
                break;
            case 'path':
                static::$path = $value;
                break;
        }
    }

}
