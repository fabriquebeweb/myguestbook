<?php

namespace MyGuestBook;

class Plugin
{

    public const NAME = 'myguestbook';

    /**
     * Plugin Activation hook
     */
    public static function activate()
    {
        Database::create();
        Page::create();
    }

    /**
     * Plugins Loaded hook
     */
    public static function load()
    {}

    /**
     * Admin Page Loading hook
     */
    public static function admin()
    {
        Admin::load();
    }

    /**
     * Widgets Initialization hook
     */
    public static function widgets()
    {
        register_widget( new Widget() );
    }

}