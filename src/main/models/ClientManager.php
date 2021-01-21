<?php
include_once 'Client.php';

class ClientManager
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection=$connection;
    }

    // we assume that client data are valid
    public function add(Client $client) {
        $req=$this->connection->prepare('INSERT INTO client(prenom, nom, mail, mot_passe, 
                                        date_naissance, adresse, ville) VALUES (?, ?, ?, PASSWORD(?), ?, ?, ?)');
        $req->execute($this->get_client_data($client));
        return $this->connection->lastInsertId(); // return id of the client we added
    }

    // to check if a user has an account
    public function is_client(String $email, String $password) {
        $req=$this->connection->prepare
        ('SELECT * FROM client WHERE mail=? AND mot_passe=PASSWORD(?)');
        $req->execute(array($email, $password));
        if( $data=$req->fetch() ) {
            $data=['id'=>$data['id_client'], 'first_name'=>$data['prenom'], 'last_name'=>$data['nom'],
                'email'=>$data['mail'], 'password'=>$data['mot_passe'], 'birthdate'=>$data['date_naissance'],
                'address'=>$data['adresse'], 'city'=>$data['ville']];
            return new Client($data);
        }
        else
            return false;
    }

    public function email_exist(String $email) {
        $req=$this->connection->prepare
        ('SELECT EXISTS(SELECT 1 FROM client WHERE mail=?) AS exist');
        $req->execute(array($email));
        $exist=($req->fetch())['exist'];
        return $exist;
    }

    /* put data of the client we want to add to DB in an array */
    private function get_client_data(Client $client) {
        $client_data=[];
        $client_class=new ReflectionClass('Client');
        foreach ($client_class->getProperties() as $field) {
            $getter='get_'.$field->getName();
            if( !$field->isStatic() && $field->getName()!='id' && method_exists($client, $getter) )
                $client_data[]=$client->$getter();
        }
        return $client_data;
    }
}