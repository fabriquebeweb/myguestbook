<?php
/**
 * @package Livre d'or
 * @version 1
 */
/*
Plugin Name: Livre d'or
Plugin URI: http://wordpress.org/plugins/livre_dor/
Description: Rajoute un section livre d'or qui permet au client de laisser un commentaire et une note, attribué au restaurant
Author: Alexandre Labsi
Version: 1
Author URI: ∞∞∞∞∞∞∞∞∞∞∞∞∞
*/


//crée un menu wordpress
function set_menu(){
    add_menu_page( 'Test Plugin Page', "Livre d'or", 'manage_options', 'test-plugin', 'getComments');
}

//ajoute ce menu au back-office
add_action('admin_menu', 'set_menu');

function getComments(){
    //arugment de recherche de post
    $args = array( 
        'post_type'   => 'post' ,
        'post_status' => 'publish', 
        'status'      => 'approve', 
    );
    $comments = get_comments( $args );

    //affichage de chaqu'un des commentaires
    foreach( $comments as $comment ) :
        echo( $comment->comment_author.' '.$comment->comment_author_email. '<br />' . $comment->comment_content.'<br />');
    endforeach;

    wp_reset_query();
}