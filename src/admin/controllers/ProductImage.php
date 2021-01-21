<?php
class ProductImage {
    private $img;
    private $extension;
    private $width;
    private $height;

    // define the max dimensions for each type of image
    private static $front_img_max=["width"=>300, "height"=>300];
    private static $img_max=["width"=>500, "height"=>500];
    private static $mini_img_max=["width"=>100, "height"=>100];

    // $img: is an object created from uploaded image
    public function __construct($img, String $extension)
    {
        $this->img=$img;
        $this->extension=$extension;
        $this->width=imagesx($img);
        $this->height=imagesy($img);
    }

    // to make sure all images are within max dimensions
    public function resize() {
        $new_dim=$this->getNewDimensions(self::$img_max);
        if( $this->same_dimensions($new_dim) )
            return $this->img; // no need to resize
        $new_img=imagecreatetruecolor($new_dim['width'], $new_dim['height']);
        imagecopyresampled($new_img, $this->img, 0, 0, 0, 0,
                            $new_dim['width'], $new_dim['height'], $this->width, $this->height);
        return $new_img;

    }

    // produce mini version of an image
    public function produceMiniImg() {
        $new_dim=$this->getNewDimensions(self::$mini_img_max);
        if( $this->same_dimensions($new_dim) )
            return $this->img;
        $mini_img=imagecreatetruecolor($new_dim['width'], $new_dim['height']);
        imagecopyresampled($mini_img, $this->img, 0, 0, 0, 0,
            $new_dim['width'], $new_dim['height'], $this->width, $this->height);
        return $mini_img;
    }

    public function produceFrontImg() {
        $new_dim=$this->getNewDimensions(self::$front_img_max);
        if( $this->same_dimensions($new_dim) )
            return $this->img;
        $front_img=imagecreatetruecolor($new_dim['width'], $new_dim['height']);
        imagecopyresampled($front_img, $this->img, 0, 0, 0, 0,
            $new_dim['width'], $new_dim['height'], $this->width, $this->height);
        return $front_img;
    }

    // get new dimensions that recpect max dimensions passed as a parameter
    private function getNewDimensions(array $max_dim) {
        $new_dim=array("width"=>$this->width, "height"=>$this->height);
        if( $this->width>$max_dim['width'] ) {
            $a=$this->width/$max_dim['width'];
            if( !is_int($a) )   $a=floor($a)+1;
        }
        if( $this->height>$max_dim['height'] ) {
            $b=$this->height/$max_dim['height'];
            if( !is_int($b) )   $b=floor($b)+1;
        }
        if( isset($a) ) {
            if( isset($b) ) {
                $mid=($a+$b)/2;
                if( $a>$b ) {
                    $new_dim['width']/=$a;
                    $new_dim['height']/=$mid;
                }
                else {
                    $new_dim['width']/=$mid;
                    $new_dim['height']/=$b;
                }
            }
            else {
                $new_dim['width']/=$a;
                $new_dim['height']/=($a/2+0.5);
            }
        }
        else {
            if( isset($b) ) {
                $new_dim['height']/=$b;
                $new_dim['width']/=($b/2+0.5);
            }
        }
        return $new_dim;
    }

    // check if dimensions of this image are the same in the array $dim
    private function same_dimensions(array $dim) {
        return $this->width==$dim['width'] && $this->height==$dim['height'];
    }
}

