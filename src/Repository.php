<?php

namespace MyGuestBook;

class Repository
{

    private static function db()
    {
        global $wpdb;
        return $wpdb;
    }

    private static function name()
    {
        return self::db()->prefix . Plugin::NAME;
    }

    private static function delta(string $sql)
    {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        return dbDelta( $sql );
    }

    private static function insert(string $message, string $name = null)
    {
        self::db()->insert( 
            self::name(), 
            array(
                'message' => $message, 
                'name' => $name
            )
        );
    }

    // Créer la table en BDD
    public static function init()
    {
        $name = self::name(); $charset = self::db()->get_charset_collate();

        self::delta(
           "CREATE TABLE ${name} (
            id int NOT NULL AUTO_INCREMENT,
            message text NOT NULL,
            name tinytext,
            time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
            ) ${charset};"
        );
    }

}