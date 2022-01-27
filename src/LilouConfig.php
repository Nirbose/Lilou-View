<?php

namespace LilouView;

class LilouConfig {
    
    public static string $components = "";

    public static function componentsPath(string $path) 
    {
        self::$components = $path;
    }

}
