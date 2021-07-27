<?php

namespace MyGuestBook;

class Plugin
{

    public const NAME = 'myguestbook';

    public static function activate()
    {
        Repository::init();
    }

    public static function load()
    {}

    public static function admin()
    {
        // Crée et ajoute le menu à l'interface admin
        add_menu_page(
            'MyGuestBook Settings',
            'MyGuestBook',
            'manage_options',
            'myguestbook',
            '',
            'dashicons-awards',
            null
        );
    }

    public static function widgets()
    {
        register_widget( new MGB_Widget() );
    }

}