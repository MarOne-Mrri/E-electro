<?php

class DB
{
    const u_admin="store_admin", p_admin="admin"; // MYSQL account used by the admin
    const u_client="store_client", p_client="client"; // MYSQL account used by all app users

    public static function connect($user, $password) {
        $db='mysql:host=localhost;dbname=store';
        try {
            $connection=new PDO($db, $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $connection;
    }
}