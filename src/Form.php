<?php

namespace MyGuestBook;

class Form
{

    /**
     * Insert new rating in DB
     */
    public static function rating()
    {  
        if ( ! empty($_POST['mgb_rating_message']) ) Database::insert([
            'message' => $_POST['mgb_rating_message'],
            'author' => self::author()
        ]);
    }

    private static function author()
    {
        return ( ! empty($_POST['mgb_rating_author']) ) ? $_POST['mgb_rating_author'] : 'Anonymous';
    }

    public static function test()
    {
        var_dump($_POST);
        // exit();
    }

}