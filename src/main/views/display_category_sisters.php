<?php
// this code display sisters of a the selected category
function display_category_sisters(String $category) {
    $categories=array(
        'smartphones'=>['smartphone'=>'smartphone'],
        'TV & Vidéo'=>['tv'=>'Téléviseurs', 'videoProjecteur'=>'Vidéoprojecteurs', 'camera'=>'Caméras'],
        'Ordinateurs & Tabletes'=>['ordinateur portbale'=>'Ordinateurs Portbales',
            'ordinateur bureau'=>'Ordinateurs de Bureau', 'tablette tactile'=>'Tablettes Tactiles']
    );
    echo '<div>';
    foreach($categories as $key=>$mother_category) {
        if( array_key_exists($category, $mother_category) ) {
            echo '<h1 id="mother_category">'.ucfirst($key).'</h1>';
            echo '<ul id="sub_categories">';
            foreach($mother_category as $k=>$sub_category) {
                echo '<li><a href="category.php?category='.$k.'" ';
                if( $k==$category )
                    echo 'id="selected_category">';
                else
                    echo '>';
                echo $sub_category.'</a></li>';
            }
            echo '</ul>';
            break;
        }
    }
    echo '</div>';
}