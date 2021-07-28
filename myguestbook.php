<?php

/**
 * @package MyGuestBook
 * @version 1
 * Plugin Name: MyGuestBook
 * Plugin URI: https://wordpress.org/plugins/myguestbook/
 * Description: Rajoute un section livre d'or qui permet au client de laisser un commentaire et une note, attribué au restaurant
 * Author: Yohan Beneito, Sidney Carlos, Raphaël Cima, Valentin Creuillenet, Alexandre Labsi, Jonathan Littardi, Maïalen Watrigant
 */

require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';
use MyGuestBook\Plugin;

// Activation
register_activation_hook( __FILE__, function() { Plugin::activate(); } );

// Events
add_action( 'wp_ajax_mgb_admin_rating_delete', function() { Plugin::request(); }) ;
add_action( 'wp_ajax_mgb_admin_rating_toggle', function() { Plugin::request(); }) ;
add_action( 'wp_ajax_nopriv_mgb_new_rating', function() { Plugin::request(); }) ;
add_action( 'wp_ajax_mgb_new_rating', function() { Plugin::request(); }) ;
add_action( 'widgets_init', function() { Plugin::widgets(); } );
add_action( 'plugins_loaded', function() { Plugin::load(); } );
add_action( 'admin_menu', function() { Plugin::admin(); } );