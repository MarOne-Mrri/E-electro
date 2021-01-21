<?php

function display_sign_up_form(array $errors=array()) {
    echo '<form method="post" action="../controllers/sign_up.php" >';

    if( isset($errors['first_name']) )  echo '<p class="error">'.$errors['first_name'].'</p>';
    echo '<input class="form-control" type="text" id="first-name" class="fadeIn second" name="first_name" 
                 placeholder="prénom">';

    if( isset($errors['last_name']) )   echo '<p class="error">'.$errors['last_name'].'</p>';
    echo '<input class="form-control" type="text" id="last-name" class="fadeIn second" name="last_name" placeholder="nom">';

    if( isset($errors['email']) )   echo '<p class="error">'.$errors['email'].'</p>';
    echo '<input class="form-control" type="email" id="email" class="fadeIn second" name="email" placeholder="E-mail">';

    if( isset($errors['password']) )    echo '<p class="error">'.$errors['password'].'</p>';
    echo '<input class="form-control" type="password" id="password" class="fadeIn second" name="password" 
                placeholder="mot de passe">';

    if( isset($errors['birth_date']) )    echo '<p class="error">'.$errors['birth_date'].'</p>';
    echo '<input class="form-control" type="date" id="date" class="fadeIn third" name="birth_date" 
                placeholder="date de naissance">';

    if( isset($errors['address']) )    echo '<p class="error">'.$errors['address'].'</p>';
    echo '<input class="form-control" type="text" id="address" class="fadeIn second" name="address" placeholder="adresse">';

    if( isset($errors['city']) )    echo '<p class="error">'.$errors['city'].'</p>';
    echo '<input class="form-control" type="text" id="city" class="fadeIn second" name="city" placeholder="ville">';

    echo '<input type="submit" name="sign_up" class="fadeIn fourth" id="button" value="Créer" />';
    echo '</form>';
}