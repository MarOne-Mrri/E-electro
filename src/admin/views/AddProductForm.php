<?php
class AddProductForm {
    private $id;
    private $action;

    const NUMBER_OF_IMAGES=3;

    public function __construct(String $action, String $id="add_product_form") {
        $this->action=$action;
        $this->id=$id;
    }

    public function show(array $errors=array()) {
        echo '<form method="post" action="'.$this->action.'" id="'.$this->id.'" enctype="multipart/form-data">';
        $this->showFieldsZone($errors);
        echo '<div class="field">';
            include 'categories.php';
        echo '</div>';
        $this->showImagesZone($errors);
        $this->showButtons();
        echo '</form>';
    }

    private function showFieldsZone(array $errors=array()) {
        include_once '../models/Product.php';
        $product_class=new ReflectionClass('Product');
        //global $errors;
        foreach( $product_class->getProperties() as $field) {
            if( !$field->isStatic() ) {
                $field_name = $field->getName();
                if ($field_name == 'category') continue;
                echo '<div class="field">';
                if (isset($errors[$field_name])) {
                    echo '<div></div>';
                    echo '<p class="error">' . $errors[$field_name] . '</p>';
                    //echo '<div></div>';
                }
                echo '<label for="'.$field_name.'">'.ucfirst($field_name).'</label>';
                echo '<input type="text" name="'.$field_name.'" id="'.$field_name.'" />';
                echo '</div>';
            }
        }
    }

    private function showImagesZone(array $errors=array()) {
        //global $errors;
        for($i=1; $i<=self::NUMBER_OF_IMAGES; ++$i) {
            echo '<div class="field">';
            if( isset($errors['product_img'.$i]) ) {
                echo '<div></div>';
                echo '<p class="error">'.$errors["product_img".$i].'</p>';
            }
            echo '<label for="product_img'.$i.'">Product Image '.$i.'</label>';
            echo '<input type="file" name="product_img'.$i.'" id="product_img'.$i.'" />';
            echo '</div>';
        }
    }

    private function showButtons() {
        echo '<div id="buttons">
		    <input type="submit" value="Ajouter" name="addProduct" />
		    <input type="reset" value="Effacer" />
	        </div>';
    }
}