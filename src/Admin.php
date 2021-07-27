<?php

namespace MyGuestBook;

class Admin
{

    public static function load()
    {
        $count = self::count();

        add_menu_page(
            'MyGuestBook - Settings',
            ($count) ? "MyGuestBook ${count}" : 'MyGuestBook',
            'manage_options',
            'myguestbook',
            '\\MyGuestBook\\Admin::menu',
            'dashicons-awards',
            null
        );

        add_submenu_page(
            'myguestbook',
            'MyGuestBook - About',
            'About',
            'manage_options',
            'myguestbook-about',
            '\\MyGuestBook\\Admin::about',
            null
        );
    }

    public static function menu()
    {
        Database::query("UPDATE ? SET notification = false WHERE id > 0");
        
        echo '<p>1</p>';
        echo '<p>2</p>';
        echo '<p>3</p>';
        echo '<p>4</p>';
        echo '<p>5</p>';
    }

    public static function about()
    {
        echo '<p>about</p>';
    }

    private static function count()
    {
        $count = Database::result("SELECT COUNT(*) FROM ? WHERE notification = true");
        return ($count) ? "<span class=\"awaiting-mod\">${count}</span>" : null;
    }

}