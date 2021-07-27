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
        
    }

}