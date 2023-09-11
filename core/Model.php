<?php
use Config\Core as Config;

abstract class Model
{
    protected string $table;

    protected static PDO $con;

    public function __construct()
    {

        if (empty(self::$con)) {
            self::connect();
        }
    }

    public static function connect()
    {

        try {
            self::$con = new PDO(
                'pgsql:host=' . Config::HOSTNAME . ';port=' . Config::PORT . ';dbname=' . Config::DBNAME,
                Config::USERNAME,
                Config::PASSWORD,
                Config::OPTIONS
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

}
