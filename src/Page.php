<?php

namespace MyGuestBook;

class Page
{

    /**
     * Cette méthode va créer la page du livre d'or et insérer les bon plugin
     */
    public static function create()
    {
        if ( ! current_user_can( 'activate_plugins' ) ) return;
        
        $current_user = wp_get_current_user();

        // Création d'un tableau associatif comprenant les champs de la page
        $page = array(
            'post_title'  => __( 'GuestBook Page' ),
            'post_status' => 'publish',
            'post_author' => $current_user->ID,
            'post_type'   => 'page',
        );
        
        // insert the post into the database
        wp_insert_post( $page );
    }

}