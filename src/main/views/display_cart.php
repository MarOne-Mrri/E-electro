<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function display_cart() {
    if( empty($_SESSION['products']) || empty($_SESSION['quantities']) ) {
        echo '<h1 id="empty_cart">Panier vide</h1>';
        exit();
    }
    $products=$_SESSION['products'];    unset($_SESSION['products']);
    $quantities=$_SESSION['quantities'];    unset($_SESSION['quantities']);
    echo '<table>';
    echo '<tr id="head">';
    echo '<th>article</th><th>quantité</th><th>prix unitaire</th><th>sous total</th>';
    echo '</tr>';
    $num_item=count($products);
    for($i=1; $i<=$num_item; ++$i) {
        display_row($products[$i-1], $quantities[$i-1], $i);
    }
    echo '</table>';
    echo '<div id="validate"><a href="../controllers/check_out.php" >Valider commande</a></div>'; ///!!!!
}


function display_row($product, $quantity, $index) {
    echo '<tr>';
    echo '<td class="first_column">';
    echo '<div class="product">';
    $image='../../product_img/'.$product->getId().'1_m.';
    if( file_exists($image.'jpg') )    $image.='jpg';
    else if( file_exists($image.'png') )    $image.='png';
    echo '<figure><img src="'.$image.'"></figure>';
    echo '<h1>'.$product->getId().'</h1>';
    echo '</div>';
    $link='../controllers/remove_from_cart.php?product_id='.$product->getId();
    echo '<div id="remove_button"><a href="'.$link.'">Supprimer</a></div>';
    echo '</td>';
    echo '<td>'.$quantity.'</td>';// !!!!
    echo '<td>'.$product->getPrice().'</td>';
    echo '<td>'.$product->getPrice()*$quantity.'</td>';
    echo '</tr>';
}



















