<?php

namespace MyGuestBook;

class Asset
{

    /**
     * Load a CSS style asset file
     */
    public static function style(string $file)
    {
        $style = file_get_contents(self::path() . $file . '.css');
        echo "<style>${style}</style>";
    }
    
    /**
     * Load a JS script asset file
     */
    public static function script(string $file)
    {
        $script = file_get_contents(self::path() . $file . '.js');
        echo "<script>${script}</script>";
    }

    private static function path()
    {
        return dirname(__FILE__) . '/../assets/';
    }

}