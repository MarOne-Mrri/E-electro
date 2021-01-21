<?php
include_once '../controllers/DataValidation.php';

class Product
{
    private $id;
    private $brand;
    private $price;
    private $category;
    // set of constants to describe the state of the parameter passed to a setX function
    const VALID=0;
    const NOT_VALID=1;
    const EMPTY=3;
    const TOO_LONG=4;
    // the maximum length/value a field can accept
    private static $max_length=['id'=>150, 'brand'=>30, 'price'=>99999.99, 'category'=>50];

    // we assume that $data=[field=>value...]
    public function __construct(array $data, array &$errors=array()) {
        $errors=[]; // hold error message for each field
        foreach( $data as $field=>$value) {
            $setter="set".ucfirst($field);
            if( method_exists($this, $setter) ) {
                $error_code=$this->$setter($value);
                $errors[$field]=self::decrypt($error_code, $field);
            }
        }
    }

    public function setId($id) {
        if( !isset($id) || $id=="" ) return self::EMPTY;
        if( strlen($id)>self::$max_length['id'] )   return self::TOO_LONG;
        // replace unwanted caracters because this id will be used to name images
        $id=preg_replace("/[()|\/]/", "-", $id);
        $id=preg_replace('/[\"+”]/', " ", $id);
        $id_valid=DataValidation::product_id($id);
        if( $id_valid ) {
            $this->id=$id;
            return self::VALID;
        }
        return self::NOT_VALID;
    }
    public function setBrand($brand) {
        if( !isset($brand) || $brand=="" )  return self::EMPTY;
        if( strlen($brand)>self::$max_length['brand'] )    return self::TOO_LONG;
        $brand_name_valid=DataValidation::product_brand($brand);
        if( $brand_name_valid ) {
            $this->brand=$brand;
            return self::VALID;
        }
        return self::NOT_VALID;
    }
    public function setPrice($price) {
        if( !isset($price) || $price=="" )  return self::EMPTY;
        if( $price>self::$max_length['price'] ) return self::TOO_LONG;
        $price_valid=DataValidation::product_price($price);
        if( $price_valid )  {
            $this->price=$price;
            return self::VALID;
        }
        return self::NOT_VALID;
    }
    public function setCategory($category) {
        if( strlen($category)>self::$max_length['category'] )   return self::TOO_LONG;
        // $category for sure is valid because the user will choose from a list
        $this->category=$category;
        return self::VALID;
    }

    public function getId() { return $this->id; }
    public function getBrand() { return $this->brand; }
    public function getPrice() { return $this->price; }
    public function getCategory() { return $this->category; }

    /* translate error code to a message */
    private static function decrypt($error_code, $field) {
        if( $error_code==self::NOT_VALID )  return $field." is not valid";
        else if( $error_code==self::EMPTY )  return $field." is required";
        else if( $error_code==self::TOO_LONG ) {
            if( $field=="price" )
                return $field." is too big(max value is ".self::$max_length[$field].")";
            else
                return $field." is too long(max length is ".self::$max_length[$field].")";
        }
        else if( $error_code==self::VALID ) return "";
        else return "unknown error code";
    }
}
