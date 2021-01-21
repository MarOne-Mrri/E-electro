<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if( isset($_POST['product_id'], $_POST['quantity']) ) {
    $product_id=$_POST['product_id'];   $quantity=$_POST['quantity'];
    // test if the product exist
    include_once '../models/DB.php';
    $connection=DB::connect(DB::u_client, DB::p_client);
    include_once '../models/ProductManager.php';
    $product_manager=new ProductManager($connection);
    if( !$product_manager->is_exist($product_id) )  exit();

    $expire=time()+86400*365; // 1 year
    if( !isset($_SESSION['client']) ) { // client not connected
        // cookies
        if( first_product() ) {
            setcookie('cart', '1', $expire);
            setcookie('item1', $product_id.';'.$quantity, $expire);
        }
        else { // not the first product to add
            $num_items=$_COOKIE['cart'];    $num_items++;
            setcookie('cart', $num_items, $expire); // update number of items
            setcookie('item'.$num_items, $product_id.';'.$quantity, $expire); // store the new added product
        }
    }
    header('Location: ../views/product.php?product_id='.$_POST['product_id']);
}

// check if it's the first time the client add a product to the cart
function first_product() {
    return !isset($_COOKIE['cart']);
}
