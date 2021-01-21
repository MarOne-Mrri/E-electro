<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if( isset($_GET['image_name']) ) {
    // open the file in a binary mode
    $name = $_GET['image_name'];
    $fp = fopen($name, 'rb');

    // send the right headers
    header("Content-Type: image/png");
    header("Content-Length: " . filesize($name));

    // dump the picture and stop the script
    fpassthru($fp);
    exit;
}
