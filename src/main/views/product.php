<?php
const NUMBER_OF_IMAGES=3;
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if( !isset($_GET['product_id']) ) {
    exit();
}
include_once '../models/DB.php';
$connection=DB::connect(DB::u_client, DB::p_client);
include_once '../models/ProductManager.php';
$product_manager=new ProductManager($connection);
$product=$product_manager->search('%', $_GET['product_id']);
if( empty($product) )   exit();
$product=$product[0]; // because ProductManager returns an array, in this case the array has one item
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include 'import_files.php'; ?>
        <link rel="stylesheet" href="styles/product.css">
        <script src="styles/show_image.js"></script>
        <title>Product</title>
    </head>
    <body>
    <?php
    include 'header.php'; ?>
    <section id="container">
        <div id="image_section">
            <div id="mini_images">
                <?php
                $images_names=get_mini_images($product);
                for($i=0; $i<NUMBER_OF_IMAGES; $i++)
                    echo '<button onclick="show_image(this.firstElementChild.src)">
                                    <img src="'.$images_names[$i].'">
                                </button>';
                ?>
            </div>
            <div id="big_image">
                <div><img src=""></div>
            </div>
        </div>
        <div id="product_info">
            <?php
            echo '<h1>'.$product->getId().'</h1>';
            echo '<p id="brand">'.$product->getBrand().'</p>';
            echo '<hr>';
            echo '<p id="price">';
            echo ' <span class="label">Prix:</span>';
            echo '<span id="unity_price">'.$product->getPrice().' DH</span>';
            echo '<form method="post" action="../controllers/add_to_cart.php">';
            echo '<input type="hidden" value="'.$product->getId().'" name="product_id" />';
            echo '<label class="label">Quantité:</label>';
            echo '<input type="text"  name="quantity" value="1" 
                    onkeyup="validate_quantity1(this)" onfocusout="validate_quantity2(this)" />';
            echo '<input type="submit" id="add_to_cart" value="Ajouter au panier" />';
            echo '</form>';
            ?>
        </div>
    </section>
    <?php //include 'sidebar.php'; ?>
    <?php include 'footer.php'; ?>

    </body>
    </html>

<?php
function get_mini_images(Product $product) {
    $path='../../product_img/'.$product->getId();
    $images_names=[];
    for($i=1; $i<=NUMBER_OF_IMAGES; ++$i) {
        if( file_exists($path.$i.'_m.jpg') )
            $images_names[$i-1]=$path.$i.'_m.jpg';
        elseif ( file_exists($path.$i.'_m.png') )
            $images_names[$i-1]=$path.$i.'_m.png';
    }
    return $images_names;
}
?>