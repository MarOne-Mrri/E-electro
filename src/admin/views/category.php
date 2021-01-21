<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    session_start();
	if( !isset($_SESSION['admin']) ) {
		header('Location: sign_in.php');
	}
	if( isset($_GET['category']) ) {
		$_SESSION['category']=htmlspecialchars($_GET['category']);
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Category</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="styles/header.css" />
    <link rel="stylesheet" type="text/css" href="styles/menu.css" />
    <link rel="stylesheet" type="text/css" href="styles/category.css" />
    <link rel="stylesheet" type="text/css" href="styles/add_product_form2.css" />
    <script type="text/javascript" src="styles/menu.js"></script>
</head>
<body>
<?php
    include 'header.php';
    include 'menu.php';

    echo '<section id="mother_section">';

    include 'display_add_product_form.php';
    $action_attribute='../controllers/add_product.php?source=category.php';
    display_add_product_form($action_attribute);

    // show products that belong to the category: $_SESSION['category']
    include 'display_products.php';

    echo '</section>';
?>
</body>
</html>
