<?php

class Product
{
    private $id;
    private $brand;
    private $price;
    private $category;

    // we assume that $data=[field=>value...]
    public function __construct(array $data) {
        foreach( $data as $field=>$value) {
            $this->$field=$value;
        }
    }

    public function getId() { return $this->id; }
    public function getBrand() { return $this->brand; }
    public function getPrice() { return $this->price; }
    public function getCategory() { return $this->category; }
}
