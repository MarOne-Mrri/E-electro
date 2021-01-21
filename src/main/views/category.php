<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();
    if( isset($_GET['category']) ) {
        $_SESSION['category']=htmlspecialchars($_GET['category']);
    }
    if( !isset($_SESSION['category']) )
        $_SESSION['category']='smartphone';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'import_files.php'; ?>
    <link rel="stylesheet" type="text/css" href="styles/category.css">
    <title>Category</title>

</head>
<body>
    <?php
        include 'header.php';
    ?>
    <section id="container">
        <section id="categories_and_brands">
            <?php
                include_once 'display_category_sisters.php';
                display_category_sisters($_SESSION['category']);

                include_once 'display_brands.php';
            ?>
        </section>
        <?php include_once 'display_products.php'; ?>
    </section>
    <?php include 'sidebar.php'; ?>
    <?php include 'footer.php'; ?>
    
</body>
</html>