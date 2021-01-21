<?php


class ProductManager
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection=$connection;
    }

    public function add(Product $produit) {
        $req=$this->connection->prepare
        ('INSERT INTO article(id_article, marque, prix_unitaire, categorie) VALUES(?, upper(?), ?, ?)');
        $req->execute(array($produit->getId(),$produit->getBrand(),$produit->getPrice(),$produit->getCategory()));
    }

    public function delete(Product $product) {
        $req=$this->connection->prepare('DELETE FROM article WHERE id_article=?');
        $req->execute(array($product->getId()));
    }

    public function search(String $category, String $id="%", String $brand="%") {
        $req=$this->connection->prepare
        ('SELECT * FROM article WHERE categorie=? AND id_article LIKE(?) AND marque LIKE(?)');
        $req->execute(array($category, $id, $brand));
        $products=[];
        while( $product=$req->fetch() ) {
            // translate keys from french to english
            $product=['id'=>$product['id_article'], 'brand'=>$product['marque'],
                'price'=>$product['prix_unitaire'], 'category'=>$product['categorie']];
            $products[]=new Product($product);
        }
        return $products;
    }

    // check if the product passed as a parameter exist in the DB
    public function isExist(Product $product) {
        $req=$this->connection->prepare('SELECT EXISTS(SELECT 1 FROM article WHERE id_article=?) AS exist');
        $req->execute( array($product->getId()) );
        $exist=($req->fetch())['exist'];
        return $exist;
    }
}