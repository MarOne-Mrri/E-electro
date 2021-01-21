<?php
include_once 'DataValidation.php';

class Client
{
    private $id, $first_name, $last_name, $email, $password, $birth_date, $address, $city;

    // set of constants to describe the state of the parameter passed to a setX function
    const VALID=8;
    const NOT_VALID=10;
    const EMPTY=9;
    const TOO_LONG=11;
    const TOO_SHORT=12;
    const NOT_YET_BORN=14;
    const TOO_YOUNG=13;
    // the maximum length/value a field can accept
    private static $max_length=['first_name'=>20, 'last_name'=>20, 'email'=>50, 'password'=>256, 'address'=>50, 'city'=>20];
    // the minimum length/value a field should have
    private static $min_length=['password'=>6, 'age'=>18];

    // we assume $data=[field_name=>fiel_value, ...]
    public function __construct(array $data, array &$errors=array()) {
        $errors=[];
        foreach($data as $field=>$value) {
            $setter="set_".$field;
            if( method_exists($this, $setter) ) {
                $error_code=$this->$setter($value);
                $errors[$field]=self::decrypt($error_code, $field);
            }
        }
    }

    public function set_id($id) {
        $this->id=$id;  return self::VALID;
    }
    public function set_first_name(String $first_name) {
        if( $first_name=="" )   return self::EMPTY;
        if( strlen($first_name)>self::$max_length['first_name'] )
            return self::TOO_LONG;
        $valid=DataValidation::client_name($first_name);
        if( $valid ) {
            $this->first_name=$first_name;
            return self::VALID;
        }
        return self::NOT_VALID;
    }
    public function set_last_name(String $last_name) {
        if( $last_name=="" )   return self::EMPTY;
        if( strlen($last_name)>self::$max_length['last_name'] )
            return self::TOO_LONG;
        $valid=DataValidation::client_name($last_name);
        if( $valid ) {
            $this->last_name=$last_name;
            return self::VALID;
        }
        return self::NOT_VALID;
    }
    public function set_email(String $email) {
        if( $email=="" )    return self::EMPTY;
        if( strlen($email)>self::$max_length['email'] )
            return self::TOO_LONG;
        $valid=DataValidation::client_email($email);
        if( $valid ) {
            $this->email=$email;
            return self::VALID;
        }
        return self::NOT_VALID;
    }
    public function set_password(String $password) {
        if( $password=="" ) return self::EMPTY;
        if( strlen($password)>self::$min_length['password'] ) return self::TOO_LONG;
        if( strlen($password)<self::$min_length['password'] ) return self::TOO_SHORT;
        $this->password=$password;
        return self::VALID;
    }
    public function set_birth_date($birth_date) {
        if( !isset($birth_date)|| $birth_date=="" ) {
            $this->birth_date=null;     return self::VALID;
        }
        $valid=DataValidation::client_birthdate($birth_date);
        if( $valid ) {
            $birth_date=new DateTime($birth_date);
            $today=new DateTime();
            if( $birth_date>=$today )   return self::NOT_YET_BORN;
            $diff= $today->diff($birth_date);
            if( $diff->format('%y')<self::$min_length['age'] )  return self::TOO_YOUNG;
            $this->birth_date=$birth_date->format('Y-m-d');
            return self::VALID;
        }
        return self::NOT_VALID;
    }
    public function set_address($adress) {
        if( !isset($adress) || $adress=="" ) {
            $this->address=null;    return self::VALID;
        }
        if( strlen($adress)>self::$max_length['address'] )
            return self::TOO_LONG;
        $valid=DataValidation::client_address($adress);
        if( $valid ) {
            $this->address=$adress;
            return self::VALID;
        }
        return self::NOT_VALID;
    }
    public function set_city($city) {
        if( !isset($city) || $city=="" ) {
            $this->city=null;   return self::VALID;
        }
        if( strlen($city)>self::$max_length['city'] )
            return self::TOO_LONG;
        $valid=DataValidation::client_city($city);
        if( $valid ) {
            $this->city=$city;
            return self::VALID;
        }
        return self::NOT_VALID;
    }

    public function get_id() { return $this->id; }
    public function get_first_name() { return $this->first_name; }
    public function get_last_name() { return $this->last_name; }
    public function get_email() { return $this->email; }
    public function get_password() { return $this->password; }
    public function get_birth_date() { return $this->birth_date; }
    public function get_address() { return $this->address; }
    public function get_city() { return $this->city; }

    /* translate error code to a message */
    private static function decrypt($error_code, $field) {
        $f_field=self::translate($field); // field name in french
        if( $error_code==self::NOT_VALID )  return $f_field." n'est pas valide";
        else if( $error_code==self::EMPTY )  return $f_field." est obligatoire";
        else if( $error_code==self::TOO_LONG ) {
                return $f_field." est trop long(ue)(longueur maximal est ".self::$max_length[$field].")";
        }
        else if( $error_code==self::TOO_SHORT ) {
            return $f_field." est trop court(longueur minimal est ".self::$min_length[$field].")";
        }
        else if( $error_code==self::NOT_YET_BORN )
            return "vous etes encore un bébé";
        else if( $error_code==self::TOO_YOUNG )
            return "l'age minimal pour créer un compte est 18 ans";
        else if( $error_code==self::VALID ) return "";
        else return "unknown error code";
    }
    // translate field name to french
    private static function translate(String $field) {
        if( $field=='first_name' )      return  'prénom';
        else if( $field=='last_name')   return  'nom';
        else if( $field=='email')       return 'email';
        else if( $field=='password' )   return  'mot de passe';
        else if( $field=='birth_date' ) return  'date de naissance';
        else if( $field=='address' )    return  'addresse';
        else if( $field=='city' )       return  'ville';
        else                            return  '';
    }
}