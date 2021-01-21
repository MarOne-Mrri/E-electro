<?php
include_once 'ProductImage.php';
// $key format is: product_img'i' , where i is a number

function store_product_img(Product $product) {
    $stored=true; // stored without errors or not
    global $errors;
    foreach( $_FILES as $key=>$img ) {
        if( !upload_succed($img, $key, $errors) || !image($img, $key, $errors) ) {
            $stored=false;
            continue;
        }
        $extension=pathinfo($img['name'])['extension'];
        $imagecreate='imagecreatefrom';
        if( $extension=='jpg' ) $imagecreate.='jpeg';
        else $imagecreate.=$extension;
        $src_img=new ProductImage($imagecreate($img['tmp_name']), $extension);
        $new_img = $src_img->resize(); // make sure this image respect dimensions limits
        $mini_img = $src_img->produceMiniImg();
        if( first_img($key) ) {
            $front_img=$src_img->produceFrontImg();
        }
        $storeimage='image';
        if( $extension=='jpg' ) $storeimage.='jpeg';
        else $storeimage.=$extension;
        $path='../../product_img/'.$product->getId().get_img_index($key);
        $storeimage($new_img, $path.'.'.$extension);
        $storeimage($mini_img, $path.'_m.'.$extension);
        if( isset($front_img) ) {
            $storeimage($front_img, '../../product_img/'.$product->getId().'.'.$extension);
        }
    }
    return $stored;
}

function upload_succed($img, $key, array &$errors=array()) {
    if( $img['error']!=0 ) {
        switch( $img['error'] ) {
            case 1:
                $errors[$key]="image too big (max: 2MB)";
                break;
            case 2:
                $errors[$key]="image was only partially uploaded";
                break;
            case 4:
                $errors[$key]="product image ".get_img_index($key)." is required";
                break;
            default:
                $errors[$key]="an unknown error occured";
                break;
        }
        return false;
    }
    return true;
}

// check if $file is an image
function image($file, $key, array &$errors=array()) {
    $img_extensions=["jpg", "png"];
    $extension=pathinfo($file['name'])['extension'];
    if( !in_array($extension, $img_extensions) ) {
        $errors[$key]="selected file not an image";
        return false;
    }
    return true;
}

// check if the image with key $key is the first selected image
function first_img($key) {
    return get_img_index($key)=="1";
}

// get index of an image from it's key
function get_img_index($key) {
    return substr($key, -1);
}