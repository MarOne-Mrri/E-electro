<?php

class Admin
{
    private static $mail="admin@gmail.com";
    private static $password="admin";

    public static function is_admin(String $mail, String $password) {
        return self::$mail==$mail && self::$password==$password;
    }
}