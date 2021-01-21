<?php
// show add product form + errors of they exist
function display_add_product_form($action_attribute) {
    include_once 'AddProductForm.php';
    //$action_attribut='../controllers/add_product.php?source=home.php';
    $form=new AddProductForm($action_attribute);
    if( isset($_SESSION['errors']) ) {
        $form->show($_SESSION['errors']);
        unset($_SESSION['errors']);
    }
    else
        $form->show();
}