<?php

class DataValidation
{
    public static function product_id(String $id) {
        $valid_id="/^[a-zA-Z0-9-,. ]+$/";
        return preg_match($valid_id, $id);
    }

    public static function product_brand($brand) {
        $valid_brand="/^[a-zA-Z ]+$/";
        return preg_match($valid_brand, $brand);
    }

    public static function product_price($price) {
        $valid_price="/^[0-9]+([.]?[0-9]+)?$/";
        return preg_match($valid_price, $price);
    }
}