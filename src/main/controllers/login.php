<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

if( isset($_POST['login']) ) {
    $errors=[];
    // validate e-mail and password
    if( !isset($_POST['email']) || $_POST['email']=="" ) {
        $errors['email']='entrez votre e-mail';
    }
    else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
        $errors['email']="e-mail n'est pas valide";
    }
    if( !isset($_POST['password']) || $_POST['password']=="" ) {
        $errors['password']='entrez votre mot de passe';
    }
    // check if he is a client
    if( empty($errors) ) { // data valid
        include_once '../models/DB.php';
        include_once '../models/ClientManager.php';
        $connection=DB::connect(DB::u_client, DB::p_client);
        $client_manager=new ClientManager($connection);
        $client=$client_manager->is_client($_POST['email'], $_POST['password']);
        if( $client ) {
            $_SESSION['client']=$client;
            header('Location: ../views/index.php');
            exit();
        }
        $errors['email']="vous n'avez pas un compte";
    }
    $_SESSION['errors']=$errors;
    header('Location: ../views/login.php');
}
