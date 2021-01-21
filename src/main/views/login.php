<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/loginStyles.css" rel="stylesheet">
    <?php include("import_files.php"); ?>
    <title>Connecter</title>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <div class="fadeIn first">
                <h1>Se Connecter</h1>
            </div>
            <?php
                include_once 'display_login_form.php';
                if( isset($_SESSION['errors']) ) {
                    display_login_form($_SESSION['errors']);
                    unset($_SESSION['errors']);
                }
                else {
                    display_login_form();
                }
            ?>
            <div id="formFooter">
                <a class="underlineHover" href="#">pas de compte? <br>Créer un Compte</a>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    <?php include("sidebar.php"); ?>
</body>
</html>