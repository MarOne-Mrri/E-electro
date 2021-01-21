<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once '../models/ProductManager.php';
include_once '../models/DB.php';
session_start();

if( isset($_COOKIE['cart']) ) {
    $connection=DB::connect(DB::u_client, DB::p_client);
    $product_manager=new ProductManager($connection);

    $num_item=$_COOKIE['cart'];
    $products=[];   $quantities=[];
    for($i=1; $i<=$num_item; ++$i) {
        if( isset($_COOKIE['item'.$i]) ) {
            $data=preg_split('/;/', $_COOKIE['item'.$i]);
            $product_id=$data[0];   $quantity=$data[1];
            if( $product_manager->is_exist($product_id) ) {
                $product=$product_manager->search('%', $product_id);
                $products[]=$product[0];
                $quantities[]=$quantity;
            }
        }
    }
    $_SESSION['products']=$products;
    $_SESSION['quantities']=$quantities;
}
header('Location: ../views/cart.php');
