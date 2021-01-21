<?php
// show products that belong to the category: $_SESSION['category']

echo '<section id="products_section">';
echo '<h1 id="category_name">'.ucfirst($_SESSION['category']).'</h1>';
include_once '../models/DB.php';
$connection=DB::connect(DB::u_admin, DB::p_admin);
include_once '../models/ProductManager.php';
$product_manager=new ProductManager($connection);
$products=$product_manager->search($_SESSION['category']);
if( empty($products) )
    echo '<p id="empty_category">No product in this category</p>';
else
    display_products($products);
echo '</section>';

function display_product(Product $product) {
    echo '<div class="product">';
    echo '<figure>';
    $image_name='../../product_img/'.$product->getId();
    if( file_exists($image_name.'.jpg') )
        $image_name.='.jpg';
    else
        $image_name.='.png';

    echo '<img src="'.$image_name.'" alt="product image" />';
    echo '</figure>';
    echo '<div class="product_info">';
    echo '<p class="brand">'.$product->getBrand().'</p>';
    echo '<p class="id">'.$product->getId().'</p>';
    echo '<p class="price">'.$product->getPrice().' DH</p>';
    echo '</div>';
    echo '<div class="delete_product_button">';
    echo '<a href="../controllers/delete_product.php?id='.$product->getId().'">Delete</a>';
    echo '</div>';
    echo '</div>';
}

function display_products(array $products) {
    echo '<div id="products">';
    foreach($products as $product) {
        display_product($product);
    }
    echo '</div>';
}