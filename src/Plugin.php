<?php

namespace MyGuestBook;

class Plugin
{

    public const VERSION = 2;
    public const NAME = 'myguestbook';
    public const SPACE = '\\MyGuestBook\\';

    /**
     * Plugin Activation hook
     */
    public static function activate()
    {
        Database::create();
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
        register_widget( new WidgetList() );
        register_widget( new WidgetForm() );
    }

    /**
     * Styles loading hook
     */
    public static function assets(bool $admin)
    {
        Asset::styles($admin);
        Asset::script('HTTP');
        Asset::scripts($admin);
    }

    /**
     * HTTP Requests
     */
    public static function request()
    {
        switch ($_REQUEST['action']) {
            case 'mgb_new_rating':
                Rating::new(); break;
            case 'mgb_admin_rating_delete':
                Rating::delete(); break;
            case 'mgb_admin_rating_toggle':
                Rating::toggle(); break;
        };
    }

}