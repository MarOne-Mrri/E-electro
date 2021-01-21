<?php

class DataValidation
{
    public static function client_name(String $name) {
        $valid_name='/^([a-z][ ]?)+$/i';
        return preg_match($valid_name, $name);
    }
    public static function client_email(String $email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    // date format mm-dd-yyyy
    public static function client_birthdate(String $birthdate) {
        $zones=preg_split('/-/', $birthdate);
        return checkdate((int)$zones[1], (int)$zones[2], (int)$zones[0]);
    }
    public static function client_address(String $address) {
        $valid_adress='/^[a-z0-9 ]+$/i';
        return preg_match($valid_adress, $address);
    }
    public static function client_city(String $city) {
        $valid_city='/[a-z ]+$/i';
        return preg_match($valid_city, $city);
    }
}