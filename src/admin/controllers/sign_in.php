<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

if( isset($_POST['sign_in']) ) {
    $errors=[];
    // validate e-mail and password
    if( !isset($_POST['mail']) || $_POST['mail']=="" ) {
        $errors['mail']='enter your e-mail';
    }
    else if( !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) ) {
        $errors['mail']='Invalid e-mail';
    }
    if( !isset($_POST['password']) || $_POST['password']=="" ) {
        $errors['password']='enter your password';
    }
    // check if he is an admin
    if( empty($errors) ) { // data valid
        include_once 'Admin.php';
        $admin=Admin::is_admin($_POST['mail'], $_POST['password']);
        if( $admin ) {
            $_SESSION['admin']=true;
            header('Location: ../views/home.php');
            exit();
        }
        else {
            $errors['mail']='you are not an admin';
        }
    }
    $_SESSION['errors']=$errors;
    header('Location: ../views/sign_in.php');
}
