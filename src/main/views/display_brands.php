<?php
include_once '../models/DB.php';
$connection=DB::connect(DB::u_client, DB::p_client);
include_once '../models/ProductManager.php';
$product_manager=new ProductManager($connection);
$brands=$product_manager->get_brands_in_category($_SESSION['category']);

echo '<div id="brands">';
echo '<h1>Marques</h1>';
$link='category.php?category='.$_SESSION['category'];
if( isset($_GET['product_id']) )
    $link.='&amp;product_id='.$_GET['product_id'];
echo '<ul><a href="'.$link.'" ';
if( !isset($_GET['brand']) )
    echo 'id="selected_brand" ';
echo '>Toutes</a></ul>';

foreach($brands as $brand) {
    $link='category.php?category='.$_SESSION['category'].'&amp;brand='.$brand;
    if( isset($_GET['product_id']) )
        $link.='&amp;product_id='.$_GET['product_id'];
    echo '<ul><a href="'.$link.'" ';
    if( is_selected($brand) )
        echo 'id="selected_brand" ';
    echo '>'.$brand.'</a></ul>';
}
echo '</div>';

function is_selected(String $brand) {
    return isset($_GET['brand']) && $brand==$_GET['brand'];
}