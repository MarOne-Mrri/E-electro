<?php
include_once 'Product.php';

class ProductManager
{
    private $connection;

    public function __construct(PDO $connection) {
        $this->connection=$connection;
    }

    public function search(String $category, String $id="%", String $brand="%", String $sort_by='price') {
        if( $sort_by=='brand' )
            $req=$this->connection->prepare
            ('SELECT * FROM article WHERE categorie LIKE(?) AND id_article LIKE(?) 
                        AND marque LIKE(?) ORDER BY marque');
        else
            $req=$this->connection->prepare
            ('SELECT * FROM article WHERE categorie LIKE(?) AND id_article LIKE(?) 
                        AND marque LIKE(?) ORDER BY prix_unitaire');
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

    // check if a product exist
    public function is_exist(String $product_id) {
        $req=$this->connection->prepare('SELECT EXISTS(SELECT 1 FROM article WHERE id_article=?) AS exist');
        $req->execute( array($product_id) );
        $exist=($req->fetch())['exist'];
        return $exist;
    }

    // get brands that exist in a category
    public function get_brands_in_category(String $category) {
        $req=$this->connection->prepare('SELECT DISTINCT marque FROM article WHERE categorie=?');
        $req->execute(array($category));
        $brands=[];
        while( $brand=$req->fetch() ) {
            $brands[]=$brand['marque'];
        }
        return $brands;
    }
}