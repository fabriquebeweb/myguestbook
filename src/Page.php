<?php

namespace MyGuestBook;

class Page
{

    /**
     * Creation of the GuestBook page
     */
    public static function create()
    {
        if ( ! current_user_can( 'activate_plugins' ) ) return;
        $current_user = wp_get_current_user();

        $page = array(
            'post_title'  => __( 'GuestBook' ),
            'post_status' => 'publish',
            'post_author' => $current_user->ID,
            'post_type'   => 'page',
        );
        
        wp_insert_post( $page );
    }

}