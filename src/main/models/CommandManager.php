<?php
include_once 'Command.php';

class CommandManager
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection=$connection;
    }

    public function add(Command $command) {
        $req=$this->connection->prepare('INSERT INTO commande(client_id, date) VALUES
            (?, CURDATE())');
        $req->execute(array($command->get_client_id()));
        return $this->connection->lastInsertId();
    }
    public function add_ligne(Product $product, $quantity, $command_id) {
        $req=$this->connection->prepare('INSERT INTO ligne(commande_id, article_id, quantite, prix) VALUES(?, ?, ?, ?)');
        $req->execute(array($command_id, $product->getId(), $quantity, $product->getPrice()*$quantity));

    }
}