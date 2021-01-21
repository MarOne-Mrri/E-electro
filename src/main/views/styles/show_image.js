
function show_image(image_name) {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if( this.readyState==4 && this.status==200) {
            document.getElementById('big_image').src=this.responseText;
        }
    };
    image_name=image_name.replace('_m', '');
    document.getElementById('big_image').firstElementChild.firstElementChild.src=image_name;
    xmlhttp.open('GET', 'get_image.php?image_name='+image_name, true);
    xmlhttp.send();
}

function validate_quantity1(quantity) {
    quantity.value=quantity.value.replace(/[^0-9]/g, '');
}
function validate_quantity2(quantity) {
    if( quantity.value=="" || quantity.value==0 ) {
        quantity.value=1;
    }
}