<?php

namespace MyGuestBook;

class Rating
{

    /**
     * Insert new rating in DB
     */
    public static function new()
    {
        if ( ! empty($_REQUEST['mgb_rating_message']) ) Database::insert([
            'message' => $_REQUEST['mgb_rating_message'],
            'author' => self::author(),
            'state' => (!json_decode($_REQUEST['mgb_rating_moderation'])) ? true : false
        ]);
    }

    /**
     * Hide/Show Rating in Widget
     */
    public static function toggle()
    {
        if ( empty($_REQUEST['mgb_rating_id']) || empty($_REQUEST['mgb_rating_state']) ) return;
        $state = ($_REQUEST['mgb_rating_state'] === 'true') ? 'false' : 'true';
        $id = (int) $_REQUEST['mgb_rating_id'];

        Database::query(
           "UPDATE ?
            SET state=${state}
            WHERE id=${id}"
        );
    }

    /**
     * Delete Rating from DB
     */
    public static function delete()
    {
        if ( empty($_REQUEST['mgb_rating_id']) ) return;
        $id = (int) $_REQUEST['mgb_rating_id'];

        Database::query(
           "DELETE FROM ?
            WHERE id=${id}"
        );
    }

    private static function author()
    {
        return ( ! empty($_REQUEST['mgb_rating_author']) ) ? $_REQUEST['mgb_rating_author'] : 'Anonymous';
    }

}