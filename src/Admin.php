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
     * Display main menu and clear all ratings notifications
     */
    public static function menu()
    {
        Database::query("UPDATE ? SET notification = false WHERE id > 0");
        Asset::style('admin');

        foreach(self::ratings() as $rating)
        {
            $state = ($rating->state) ? 'mgb_admin_rating_on': 'mgb_admin_rating_off';
            
            echo <<<EOT
                <article class="mgb_admin_rating ${state}">
                    <header class="mgb_admin_rating_header">
                        <h3> " $rating->message " </h3>
                    </header>
                    <aside>
                        <p>Author: <strong> $rating->author </strong></p>
                        <p>Date: <strong> $rating->time </strong></p>
                    </aside>
                    <footer class="mgb_admin_rating_footer">
                        <input class="mgb_admin_rating_footer_btn" type="button" value="X">
                        <input class="mgb_admin_rating_footer_btn" type="button" value="&#x2714">
                    </footer>
                </article>
            EOT;
        }
    }

    /**
     * Display secondary About page
     */
    public static function about()
    {
        Asset::style('admin');

        echo '<p>About page ( si tu lis ceci, prends le ticket prévu pour la page "À propos" sur Trello ! )</p>';
    }

    private static function count()
    {
        $count = Database::result("SELECT COUNT(*) FROM ? WHERE notification = true");
        return ($count) ? "<span class=\"awaiting-mod\">${count}</span>" : null;
    }

    private static function ratings()
    {
        $ratings = Database::list("SELECT * FROM ? ORDER BY time DESC");
        return ($ratings) ? array_map(Plugin::SPACE . 'Database::format', $ratings) : [];
    }

}