<?php

namespace MyGuestBook;

class Admin
{

    /**
     * Create Admin page menus
     */
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

    /**
     * Display main menu and clear all messages notifications
     */
    public static function menu()
    {
        Database::query("UPDATE ? SET notification = false WHERE id > 0");
        
        foreach(self::messages() as $message)
        {
            echo <<<EOT
                <div style="border: 1px solid grey; padding: 1em; margin: 3em;">
                    <p> <strong> NOTE: </strong> $message->message </p> 
                    <p> <strong> NAME: </strong> $message->name </p> 
                    <p> <strong> DATE: </strong> $message->time </p>
                </div>
            EOT;
        }
    }

    /**
     * Display secondary About page
     */
    public static function about()
    {
        echo '<p>About page ( si tu lis ceci, prends le ticket prévu pour la page "À propos" sur Trello ! )</p>';
    }

    private static function count()
    {
        $count = Database::result("SELECT COUNT(*) FROM ? WHERE notification = true");
        return ($count) ? "<span class=\"awaiting-mod\">${count}</span>" : null;
    }

    private static function messages()
    {
        $messages = Database::list("SELECT * FROM ? ORDER BY time DESC LIMIT 5");
        return ($messages) ? $messages : [];
    }

}