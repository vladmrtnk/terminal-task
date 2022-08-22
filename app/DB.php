<?php

namespace App;

use PDO;

class DB
{
    /**
     * @return PDO
     */
    public static function getConection()
    {
        $connection = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

        return $connection;
    }
}