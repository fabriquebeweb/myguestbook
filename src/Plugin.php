<?php

namespace MyGuestBook;

class Plugin
{

    public const NAME = 'myguestbook';

    public static function activate()
    {
        Database::init();
        Page::create();
    }

    public static function load()
    {}

    public static function admin()
    {
        Admin::load();
    }

    public static function widgets()
    {
        register_widget( new Widget() );
    }

}