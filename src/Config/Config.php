<?php

namespace LilouView\Config;

class Config {

    private static string $cacheFolderPath = './cache';

    private static string $viewsFolderPath = './views';

    private static string $cacheFileExtension = '.php';

    private static string $componentsFolderPath = './views/components';

    public static function create(array $configs)
    {
        foreach ($configs as $key => $value) {
            if (property_exists(Config::class, $key)) {
                self::$$key = $value;
            }
        }
    }

    public static function get(string $key)
    {
        if (property_exists(Config::class, $key)) {
            return self::$$key;
        }

        return null;
    }

}
