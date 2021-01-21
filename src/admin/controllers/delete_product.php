<?php
/*if( isset($_SESSION['admin']) ) {
    header('Location: ../../sign_in.php');
}*/
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once '../models/DB.php';
include_once '../models/ProductManager.php';
include_once '../models/Product.php';
$connection=DB::connect(DB::u_admin, DB::p_admin);
$product_manager=new ProductManager($connection);
$product_to_delete=new Product(array('id'=>$_GET['id']));
if( $product_manager->isExist($product_to_delete) ) {
    $product_manager->delete($product_to_delete);
    delete_product_images($_GET['id']);
}
header('Location: ../views/category.php');

function delete_product_images(String $id) {
    $img_name='../../product_img/'.$id;
    // delete front image
    if( unlink($img_name.'.jpg')==false )
        unlink($img_name.'.png');
    include_once '../views/AddProductForm.php';
    for($i=1; $i<=AddProductForm::NUMBER_OF_IMAGES; ++$i) {
        // delete image number $i
        if( unlink($img_name.$i.'.jpg')==false )
            unlink($img_name.$i.'.png');
        // delete it's mini version
        if( unlink($img_name.$i.'_m.jpg')==false )
            unlink($img_name.$i.'_m.png');
    }
}
