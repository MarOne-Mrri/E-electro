<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("import_files.php"); ?>
    <style>
        @media only screen and (max-width: 600px) {
            .carousel-inner img {
                height: 100%;
            }

            #indics {
                display: none;
            }
        }

        .carousel-inner img {
            width: 100%;
        }
    </style>
    <title>Acceuil</title>
</head>

<body>
    <?php include("header.php"); ?>
    <main>
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators" id="indics">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./images/proxy-immage.png" alt="" height="300px">
                </div>
                <div class="carousel-item">
                    <img src="./images/proxy-image.png" alt="" height="300px" hi>
                </div>
                <div class="carousel-item">
                    <img src="./images/proxy-immmage.jpg" alt="" height="300px">
                </div>
            </div>
        </div>
        <br><br>
    </main>
    <?php include("footer.php"); ?>
    <?php include("sidebar.php"); ?>
</body>

</html>