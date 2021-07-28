<?php

namespace MyGuestBook;

class Plugin
{

    public const VERSION = '1.0.0';
    public const NAME = 'myguestbook';
    public const SPACE = '\\MyGuestBook\\';

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