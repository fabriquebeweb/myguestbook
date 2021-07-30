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

        foreach(self::ratings() as $rating)
        {
            $state_class = ($rating->state) ? 'mgb_admin_rating_on': 'mgb_admin_rating_off';
            $state = ($rating->state) ? 'true' : 'false';

            echo <<<EOT
                <article id="$rating->id" class="mgb_admin_rating ${state_class}">
                    <header class="mgb_admin_rating_header">
                        <h3> " $rating->message " </h3>
                    </header>
                    <aside>
                        <p>Author: <strong> $rating->author </strong></p>
                        <p>Date: <strong> $rating->time </strong></p>
                    </aside>
                    <footer class="mgb_admin_rating_footer">
                        <input class="mgb_admin_rating_footer_btn mgb_admin_rating_delete" type="button" value="X">
                        <input name="${state}" class="mgb_admin_rating_footer_btn mgb_admin_rating_toggle" type="button" value="&#x2714">
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
        $widgets = Asset::image('widgets');

        echo <<<EOT
            <h1>A propos</h1>
            <p>MyGuestBook a pour but l’ajout d’un système de « Livre d’Or » gérable facilement et intégrable à n'importe quel site. </p>
            <p>Après installation et activation du plugin, trois widgets deviennent disponibles depuis l'onglet Apparence -> Widgets du menu admin, 
            que l’utilisateur peut placer à sa guise. </p>
            <p>Une nouvelle table est également créée en base de données. 
            Cette dernière accueillera tous les messages laissés par les clients depuis le widget.</p>
            <h3>Les widgets : </h3>
            <ul>
                <li><strong>« MyGuestBook List »</strong> : Liste tous les messages.</li>
                <li><strong>« MyGuestBook Form »</strong> : Permet à l’utilisateur de créer un nouveau message.</li>
            </ul>
            <div>
                <img src="${widgets}" alt="widgets"></img>
            </div>
        EOT;
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