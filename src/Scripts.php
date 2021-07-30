<?php

namespace MyGuestBook;
use ZipArchive;

class Scripts
{

    /**
     * Zip plugin and create files on specified paths
     */
    public static function zip($args)
    {
        $paths = (empty($args->getArguments())) ? [self::path('/myguestbook.zip')] : self::args($args);
        foreach ($paths as $path)
        {
            $zip = new ZipArchive();
            $zip->open($path, ZipArchive::CREATE);
            self::addFolder(self::path(), $zip);
            $zip->close();
        }
    }

    private static function addFolder(string $dir, ZipArchive $zip, string $entry = '')
    {
        foreach (self::files($dir) as $file) {
            (is_dir(self::path("/$entry/$file"))) ? self::addFolder(self::path("/$entry/$file"), $zip, ($entry) ? "$entry/$file" : $file)
                : $zip->addFile(($entry) ? "$entry/$file" : $file);
        }
    }

    private static function path(string $file = '')
    {
        return dirname(dirname(__FILE__)) . $file;
    }

    private static function args($args)
    {
        return array_map(Plugin::SPACE . 'Scripts::format', $args->getArguments());
    }

    private static function files(string $dir)
    {
        return array_diff(scandir($dir), ['..', '.', '.git']);
    }

    private static function append(string $file)
    {
        return (is_dir($file)) ? "${file}/myguestbook.zip" : $file;
    }

    private static function exists(string $file)
    {
        return self::append((file_exists($file)) ? $file : self::mkdir($file));
    }

    private static function mkdir(string $path)
    {
        if (mkdir($path, 0777, true)) return $path;
    }

    private static function format(string $arg)
    {
        return (preg_match('/^\/[A-Z0-9_-]*$/i', $arg)) ? self::exists($arg) : self::exists(self::path("/${arg}"));
    }

}