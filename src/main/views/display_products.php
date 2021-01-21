<?php

// show products that belong to the category: $_SESSION['category']

echo '<section id="products_section">';
display_sort_by_bar();
echo '<h1 id="category_name">' . ucfirst($_SESSION['category']) . '</h1>';
include_once '../models/DB.php';
$connection = DB::connect(DB::u_client, DB::p_client);
include_once '../models/ProductManager.php';
$product_manager = new ProductManager($connection);
$id='%';
if( searching_product() ) { // if we are searching a product
    $_GET['product_id']=htmlspecialchars($_GET['product_id']);
    $id=$_GET['product_id'];
    $id=preg_replace('/ /', '%', $id);
    $id='%'.$id.'%';
}
$brand='%';
if( isset($_GET['brand']) )
    $brand=$_GET['brand'];
$sort_by='price';
if( isset($_GET['sort_by']) )   $sort_by=$_GET['sort_by'];

$products = $product_manager->search($_SESSION['category'], $id, $brand, $sort_by);
if (empty($products)) {
    if( searching_product() )
        echo '<p id="empty_category">"'.$_GET['product_id'].'": Aucun produit trouvé</p>';
    else
        echo '<p id="empty_category">Cette catégorie est vide</p>';

}
else
    display_products($products);
echo '</section>';


function display_product(Product $product)
{
    echo '<div class="product">';
    echo '<a href="product.php?product_id='.$product->getId().'">';
    echo '<figure>';
    $image_name = '../../product_img/' . $product->getId();
    if (file_exists($image_name . '.jpg'))
        $image_name .= '.jpg';
    else
        $image_name .= '.png';

    echo '<img src="' . $image_name . '" alt="product image" />';
    echo '</figure>';
    echo '<div class="product_info">';
    echo '<p class="brand">' . $product->getBrand() . '</p>';
    echo '<p class="id">' . $product->getId() . '</p>';
    echo '<p class="price">' . $product->getPrice() . ' DH</p>';
    echo '</div>';
    echo '</a>';
    echo '</div>';
}

function display_products(array $products)
{
    if( searching_product() )
        echo '<p id="search_message">Résultats de recherche pour: "'.$_GET['product_id'].'"</p>';
    echo '<div id="products">';
    foreach ($products as $product) {
        display_product($product);
    }
    echo '</div>';
}

function display_sort_by_bar() {
    $properties=array('price', 'brand');
    echo '<div id="sort_by">';
    echo '<h1>Trie par</h1>';
    foreach( $properties as $property ) {
        echo '<div>';
        $link='category.php?category='.$_SESSION['category'];
        if( searching_product() )
            $link.='&amp;product_id='.$_GET['product_id'];
        if( isset($_GET['brand']) )
            $link.='&amp;brand='.$_GET['brand'];
        $link.='&amp;sort_by='.$property;
        echo '<a href="'.$link.'">'.ucfirst($property).'</a>';
        echo '</div>';
    }
    echo '</div>';
}
// return true if we are trying to search a product false otherwise
function searching_product() {
    return isset($_GET['product_id']) && $_GET['product_id']!="";
}