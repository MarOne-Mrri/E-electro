<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("import_files.php"); ?>
    <link href="./styles/loginStyles.css" rel="stylesheet">
    <title>s'inscrir</title>

</head>
<body>
    <?php include("header.php"); ?>
    <div class="wrapper fadeInDown">
        <div id="formContent">
        <div class="fadeIn first">
            <h1>Créer un Compte</h1>
        </div>
            <?php
                include_once 'display_sign_up_form.php';
                if( isset($_SESSION['errors']) ) {
                    display_sign_up_form($_SESSION['errors']);
                    unset($_SESSION['errors']);
                }
                else
                    display_sign_up_form();
            ?>
            <div id="formFooter">
                <a class="underlineHover" href="#">Vous avez un compte ? <br>Se connecter</a>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</body>
</html>