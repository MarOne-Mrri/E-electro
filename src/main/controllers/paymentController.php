<?php
if (isset($_POST["submited"])) {
    function cardValidation($number, $mod5 = false) {
		$parity = strlen($number) % 2;
		$total = 0;
	  	$digits = str_split($number);
	  	foreach($digits as $key => $digit) {
		  	if (($key % 2) == $parity) 
			  	$digit = ($digit * 2);
		  	if ($digit >= 10) {
			  	$digit_parts = str_split($digit);
			  	$digit = $digit_parts[0]+$digit_parts[1];
		  	}
			$total += $digit;
	  	}
		return ($total % ($mod5 ? 5 : 10) == 0 ? true : false);
    }
    echo '<!DOCTYPE html>
        <html lang="en">
        <head>';
            echo '<meta charset="UTF-8">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
            <script src="https://kit.fontawesome.com/a076d05399.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
            <link rel="icon" href="" type="image" sizes="any"> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>';
    if (cardValidation($_POST["cardNumber"], true)) {
        echo '<center>
            <h1>paiment bien validé !</h1>
            <a class="btn btn-primary" href="http://localhost/githubcode/e-store/src/views/index.php">acceuil</a>
        </center>';
    }else {
        echo '<a href="http://localhost/githubcode/e-store/src/views/payment.php">
        <center>
            <h1>carte invalide ! tappez pour retourner!</h1>
        </center>
        </a>';
    }
    echo '</body>
    </html>';
}
?>