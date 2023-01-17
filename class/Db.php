<?php

///** * Design Pattern: Singleton */
class Db
{
    private static object $dbh;

    public static function connect(): object
    {
        if (!isset(self::$dbh)) {
//            bei Fehlern, auf die wir keinen Einfluss haben(z . B . db down, Zugangsdaten geändert)
            // fangen wir mit try - catch (- finally) und - throw ab
            try {
                self::$dbh = mysqli_connect(DB_SERVER,
                    DB_USER, DB_PASSWD, DB_NAME);
            } catch (Error $e) {
                // nur für mySQL, bei MariaDB ist ein Fehler bei der connection eine Exception
                throw new Error('Fehlermeldung aus Db::connect()');
            } catch (Exception $e) {
                throw new Exception('Datenbankconnect misslungen');
            }
        }
        return self::$dbh;
    }
}