<?php

function display_login_form(array $errors=array()) {
    echo '<form method="post" action="../controllers/login.php">';

    if( isset($errors['email']) )   echo '<p class="error">'.$errors['email'].'</p>';
    echo '<input type="email" id="email" class="fadeIn second" name="email" placeholder="E-mail">';

    if( isset($errors['password']) )   echo '<p class="error">'.$errors['password'].'</p>';
    echo '<input type="password" id="password" class="fadeIn third" name="password" placeholder="Mot de Passe">';

    echo '<input type="submit" name="login" class="fadeIn fourth" id="button" value="Se Connecter">';
    echo '</form>';
}
