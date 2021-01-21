<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

if( isset($_POST['sign_up']) ) {
    /*$client_data=['first_name'=>$_POST['first_name'], 'last_name'=>$_POST['last_name'], 'email'=>$_POST['email'],
        'password'=>$_POST['password'], 'birth_date'=>$_POST['birth_date'], 'address'=>$_POST['address'], 'city'=>$_POST['city']];
    */
    include_once '../models/Client.php';
    $client_data=get_client_data();
    $errors=[];
    $client=new Client($client_data, $errors);
    if( !error_exist($errors) ) {
        include_once '../models/DB.php';
        include_once '../models/ClientManager.php';
        $connection=DB::connect(DB::u_admin, DB::p_admin);
        $client_manager=new ClientManager($connection);
        if( $client_manager->email_exist($client->get_email()) )
            $errors['email']='email déja existe';
        else {
            $id=$client_manager->add($client);
            $client->set_id($id);
            $_SESSION['client']=$client;
            header('Location: ../views/index.php');
            exit();
        }
    }
    $_SESSION['errors']=$errors;
    header('Location: ../views/sign_up.php');
}

// get client data from array $_POST and put them in an array
function get_client_data() {
    $client_data=[];
    $client_class=new ReflectionClass('Client');
    foreach ($client_class->getProperties() as $field) {
        if( !$field->isStatic() ) {
            if( isset($_POST[$field->getName()]) )
                $client_data[$field->getName()]=$_POST[$field->getName()];
            else
                $client_data[$field->getName()]='';
        }
    }
    return $client_data;
}
// see if there is at least a message error in the array $errors
function error_exist(array $errors) {
    foreach($errors as $error) {
        if( $error!="") { // if at least an error exist
            return true;
        }
    }
    return false;
}