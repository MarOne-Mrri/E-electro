<header>
    <style>
        .sidebarBtn {
            width: 40px;
            height: 35px;
            background: transparent;
            box-sizing: border-box;
            outline: none;
            border: none;
        }

        .sidebarBtn span {
            display: block;
            width: 30px;
            height: 3px;
            background-color: white;
            position: absolute;
            top: 40px;
        }

        .sidebarBtn span:before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0px;
            background-color: white;
            width: 100%;
            height: 3px;
        }

        .sidebarBtn span:after {
            content: '';
            position: absolute;
            left: 0px;
            top: 10px;
            background-color: white;
            width: 100%;
            height: 3px;
        }

        .sidebar {
            position: fixed;
            top: 75px;
            left: -250px;
            width: 250px;
            height: 100%;
        }

        .active {
            left: 0;
        }

        .sidebarBtn.toggle span {
            background: transparent;
        }

        .sidebarBtn.toggle span:before {
            top: 0;
            transform: rotate(45deg);
        }

        .sidebarBtn.toggle span:after {
            top: 0;
            transform: rotate(-45deg);
        }

        @media only screen and (max-width: 600px) {
            #dropdown {
                width: 120px;
                margin-top: 5px;
                margin-left: 0px;
            }

            .sidebarBtn span {
                top: 40px;
            }

            .sidebar {
                top: 75px;
            }
        }

        #num-product {
            /*margin-top: 5px;*/
            margin-left: 7px;
            border-radius: 50%;
            background-color: orangered;
            padding: 3px;
            color: black;
        }

    </style>
    <script>
        $(function() {
            $(".sidebarBtn").click(function() {
                $(".sidebar").toggleClass('active');
                $(".sidebarBtn").toggleClass('toggle');
            });
        });
    </script>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="sidebarBtn">
            <span></span>
        </button>
        <a class="navbar-brand" href="index.php" style="margin-left: 10px;">
            <img src="./images/icons8-market-square-96.png" width="60px" height="60px">
            <span>E-electro</span>
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navb">
            <form action="category.php" method="get">
            <div class="input-group container-sm">
                <div class="input-group-prepend" id="dropdown">
                    <?php include("categories.php"); ?>
                </div>
                <input type="text"  name="product_id" class="form-control input-group-prepend" placeholder="Chercher">
                <button class="btn btn-outline-success" type="submit" style="border-radius: 0%;">
                    <i class='fas fa-search'></i>
                </button>
            </div>
            </form>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" style="margin-top: 10px;">
                    <?php
                        if( isset($_SESSION['client']))
                            echo '<a class="nav-link" href="../controllers/logout.php">Déconnexion</a>';
                        else
                            echo '<a class="nav-link" href="login.php">Connexion</a>';
                    ?>
                </li>
                <li class="nav-item" style="margin-top: 10px;">
                    <a class="nav-link" href="sign_up.php">S'inscrire</a>
                </li>
                <li class="nav-item shopping-basket">
                    <a class="nav-link" href="../controllers/cart.php">
                        <span id="num-product"></span><br>
                        <span><i class="fa fa-shopping-basket text-success"></i></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>