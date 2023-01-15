<?php

class Db
{
    private static object $dbh;

    public static function connect(): object
    {
        if (!isset (self::$dbh)) {
            self::$dbh = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWD, DB_NAME);
        }
        return self::$dbh;
    }
}