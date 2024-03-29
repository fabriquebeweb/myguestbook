<?php

namespace MyGuestBook;

class Database
{

    /**
     * Database creation
     */
    public static function create()
    {
        $charset = self::db()->get_charset_collate();

        self::delta(
           "CREATE TABLE ? (
            id INT NOT NULL AUTO_INCREMENT,
            message TEXT NOT NULL,
            author VARCHAR(20) DEFAULT 'Anonymous' NOT NULL,
            state boolean DEFAULT false NOT NULL,
            time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            notification boolean DEFAULT true NOT NULL,
            PRIMARY KEY  (id)
            ) ${charset};"
        );
    }

    /**
     * Insert into database
     */
    public static function insert(array $params)
    {
        self::db()->insert(self::name(), $params);
    }

    /**
     * Query alist of results
     */
    public static function list(string $sql, array $params = [])
    {
        return self::db()->get_results(self::prepare($sql, $params));
    }

    /**
     * Query a result
     */
    public static function result(string $sql, array $params = [])
    {
        return self::db()->get_var(self::prepare($sql, $params));
    }

    /**
     * Random query
     */
    public static function query(string $sql, array $params = [])
    {
        self::db()->query(self::prepare($sql, $params));
    }

    /**
     * Format a Rating object
     */
    public static function format($obj)
    {
        $obj->time = date_format(date_create($obj->time), 'd/m/Y');
        $obj->message = stripslashes($obj->message);
        return $obj;
    }

    private static function db()
    {
        global $wpdb;
        return $wpdb;
    }

    private static function name() : string
    {
        return self::db()->prefix . Plugin::NAME;
    }

    private static function prepare(string $sql, array $params)
    {
        return self::db()->prepare(preg_replace('/\?/i', self::name(), $sql), $params);
    }

    private static function delta(string $sql, array $params = [])
    {
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        return dbDelta(self::prepare($sql, $params));
    }

}