<?php
header();
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once '../models/DB.php';
include_once '../models/Product.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'import_files.php'; ?>
    <link rel="stylesheet" href="styles/cart.css">
    <title>Cart</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <section id="container">
        <h1>Panier</h1>
        <?php
            include 'display_cart.php';
            display_cart();
        ?>
    </section>
</body>
</html>
