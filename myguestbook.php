<?php
/**
 * @package MyGuestBook
 * @version 1
 */
/*
Plugin Name: MyGuestBook
Plugin URI: https://wordpress.org/plugins/myguestbook/
Description: Rajoute un section livre d'or qui permet au client de laisser un commentaire et une note, attribué au restaurant
Author: Yohan Beneito, Sidney Carlos, Raphaël Cima, Valentin Creuillenet, Alexandre Labsi, Jonathan Littardi, Maïalen Watrigant
Version: 1
Author URI: ∞∞∞∞∞∞∞∞∞∞∞∞∞
*/

include_once('src/form.php');

// Récupérer le nom de la table
function getTableName() {
    global $wpdb;

    return $wpdb->prefix . 'myguestbook';
}

// Créer la table en BDD
function db_create() {
    global $wpdb;

    $table_name = getTableName();
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
    id int NOT NULL AUTO_INCREMENT,
    message text NOT NULL,
    name tinytext,
    time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

// Appels lors de l'activation du plugin
register_activation_hook( __FILE__, 'db_create' );

// Crée et ajoute le menu à l'interface admin
add_action('admin_menu', function() {
    add_menu_page(
        'MyGuestBook Settings',
        'MyGuestBook',
        'manage_options',
        'myguestbook',
        '',
        'dashicons-awards',
        null
    );
});

//link le style au plugin
function register_style() {
    wp_register_style( 'style', plugins_url('/assets/style.css', __FILE__), false, '1.0.0', 'all' );
    wp_enqueue_style( 'style' );
}
add_action( 'admin_init', 'register_style' );





