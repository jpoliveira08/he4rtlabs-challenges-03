<?php

namespace Core;

use PDO;
use App\Config;

/**
 * Base model
 */
abstract class Model
{
    /**
     * Get the PDO database connection
     *
     * @return \PDO
     */
    public static function connectionCreator(): PDO
    {
        $connection = new PDO(
            'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME,
            Config::DB_USER,
            Config::DB_PASSWORD
        );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}
