<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

if( isset($_POST['addProduct']) ) {
    $product_data=["id"=>$_POST['id'], "brand"=>$_POST['brand'], "price"=>$_POST['price'],
                    "category"=>$_POST['category']];
    $errors=[];
    include_once '../models/Product.php';
    $product=new Product($product_data, $errors);
    if( !error_exist($errors) ) {
        include_once '../models/DB.php';
        include_once '../models/ProductManager.php';
        $connection=DB::connect(DB::u_admin, DB::p_admin);
        $product_manager=new ProductManager($connection);
        if( $product_manager->isExist($product) )
            $errors['id']="a product with the same id already exist";
        else {
            include "store_product_img.php";
            if( store_product_img($product) )  // if product images stored wihout errors
                $product_manager->add($product);
        }
    }
    $_SESSION['errors']=$errors;
    header("Location: ../views/".$_GET['source']);
}

// see if the user is the admin if not redirect him to sign-up page
function is_admin() {
    if( !isset($_SESSION['admin']) ) {
        header("Location: ../../../connexion.php");
    }
}

// see if there is at least a message error in the array $errors
function error_exist(array $errors) {
    foreach($errors as $error) {
        if( $error!="") { // if at least an error exist
            return true;
        }
    }
    return false;
}

