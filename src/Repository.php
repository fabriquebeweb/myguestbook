<?php

namespace MyGuestBook;

class Repository
{

    private static function db()
    {
        global $wpdb;
        return $wpdb;
    }

    private static function name() : string
    {
        return self::db()->prefix . Plugin::NAME;
    }

    private static function replace(string $sql)
    {
        return preg_replace('/\?/i', self::name(), $sql);
    }

    private static function delta(string $sql)
    {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        return dbDelta(self::replace($sql));
    }

    public static function insert(string $message, string $name = 'Anonymous')
    {
        self::db()->insert( 
            self::name(), 
            array(
                'message' => $message, 
                'name' => $name
            )
        );
    }

    public static function findAll(string $sql)
    {
        return self::db()->get_results(self::replace($sql));
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