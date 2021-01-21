<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="styles/sign_in.css" />
</head>
<body>
	<section id="mother_section">
		<h1>Sign in to your account (for admins)</h1>
        <?php
            include_once 'SignInForm.php';
            $action_attribute='../controllers/sign_in.php';
            $form=new SignInForm($action_attribute);
            if( isset($_SESSION['errors']) ) {
                $form->show($_SESSION['errors']);
                unset($_SESSION['errors']);
            }
            else
                $form->show();
        ?>
	</section>
</body>
</html>