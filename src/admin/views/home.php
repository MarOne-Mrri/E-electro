<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
if( !isset($_SESSION['admin']) )
    header('Location: sign_in.php');
?>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="styles/header.css" />
	<link rel="stylesheet" type="text/css" href="styles/menu.css" />
	<link rel="stylesheet" type="text/css" href="styles/add_product_form.css" />
	<script type="text/javascript" src="styles/menu.js"></script>
</head>
<body>
	<?php
	    include 'header.php';
	    include 'menu.php';

	    // show add product form + errors if they exist
        include 'display_add_product_form.php';
        $action_attribute='../controllers/add_product.php?source=home.php';
        display_add_product_form($action_attribute);
	?>
    <!--<script type="text/javascript">init();</script>-->
</body>
</html>