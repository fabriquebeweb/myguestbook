<?php

namespace MyGuestBook;

class Asset
{

    /**
     * Load all CSS style asset files
     */
    public static function styles(bool $admin)
    {
        foreach (self::files(($admin) ? 'styles/admin*.css' : 'styles/widget*.css') as $file)
        {
            self::style(self::preg($file));
        }
    }

    /**
     * Load all JS script asset files
     */
    public static function scripts(bool $admin, bool $footer = true)
    {
        foreach (self::files(($admin) ? 'scripts/admin*.js' : 'scripts/widget*.js') as $file)
        {
            self::script(self::preg($file), $footer);
        }
    }

    /**
     * Load one CSS style asset file
     */
    public static function style(string $file)
    {
        wp_enqueue_style("mgb_plugin_${file}_stylesheet", plugins_url("/assets/styles/${file}.css", __FILE__));
    }

    /**
     * Load one JS script asset file
     */
    public static function script(string $file, bool $footer = true)
    {
        wp_enqueue_script("mgb_plugin_${file}_script", plugins_url("/assets/scripts/${file}.js", __FILE__), [], false, $footer);
    }

    /**
     * Get one image asset filepath
     */
    public static function image(string $file)
    {
        foreach (['png', 'jpg', 'jpeg', 'svg', 'gif'] as $ext)
        {
            if (file_exists(self::path() . "images/${file}.${ext}")) return self::url() . "images/${file}.${ext}";
        }
    }

    private static function path()
    {
        return plugin_dir_path(__FILE__) . 'assets/';
    }

    private static function url()
    {
        return plugin_dir_url(__FILE__) . 'assets/';
    }

    private static function files(string $pattern)
    {
        return glob(self::path() . $pattern);
    }

    private static function preg(string $file)
    {
        return preg_replace('/(^(\/.*)\/|\.(html|css|js))/i', '', $file);
    }

}