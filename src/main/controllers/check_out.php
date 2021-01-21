<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once '../models/Client.php';
session_start();
if( isset($_SESSION['client']) ) {
    $client = $_SESSION['client'];
    if ( isset($_COOKIE['cart']) ) {
        include_once '../models/DB.php';
        $connection = DB::connect(DB::u_client, DB::p_client);
        include_once '../models/ProductManager.php';
        $product_manager = new ProductManager($connection);
        // get products from cookies
        $num_item = $_COOKIE['cart'];
        $products = [];
        $quantities = [];
        for ($i = 1; $i <= $num_item; ++$i) {
            if (isset($_COOKIE['item' . $i])) {
                $data = preg_split('/;/', $_COOKIE['item' . $i]);
                $product_id = $data[0];
                $quantity = $data[1];
                if ($product_manager->is_exist($product_id)) {
                    $product = $product_manager->search('%', $product_id);
                    $products[] = $product[0];
                    $quantities[] = $quantity;
                }
                setcookie('item'.$i, '', time()-3600); // delete cookie
            }
        }
        setcookie('cart', '', time()-3600);
        include_once '../models/CommandManager.php';
        $command_manager = new CommandManager($connection);
        $command = new Command();
        $command->set_client_id($client->get_id());
        $command_id = $command_manager->add($command);
        for ($i = 0; $i < $num_item; $i++) {
            $command_manager->add_ligne($products[$i], $quantities[$i], $command_id);
        }
        header('Location: ../views/payment.php');
        //exit();
    }
}
else
    header('Location: ../views/login.php');