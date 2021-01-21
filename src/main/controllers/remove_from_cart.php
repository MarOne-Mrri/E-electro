<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if( isset($_GET['product_id']) ) {
    $product_id=$_GET['product_id'];
    $num_items=$_COOKIE['cart'];
    for($i=1; $i<=$num_items; $i++) {
        if( isset($_COOKIE['item'.$i]) ) {
            $data=preg_split('/;/', $_COOKIE['item'.$i]);
            if( $product_id==$data[0] ) {
                setcookie('item'.$i, '', time()-3600);
                setcookie('cart', $num_items-1, time()+86400*365);
                break;
            }
        }
    }
    header('Location: cart.php');
}
