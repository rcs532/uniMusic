<!DOCTYPE html>
<?php
    session_start();
    include("functions/functions.php");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <title>Checkout</title>
        <script type="text/javascript" src="js/loginValidation.js"></script>
    </head>
    <body>

        <header>
            <a href="index.php"><img  class="itemHeader"id="logo" src="images/logo.png" alt="logotipoUniMusic"></a>

            <div class="search-container itemHeader">
                <form method="get" action="results.php" enctype="multipart/form-data">
                <input type="text" placeholder="Search.." name="user_query">
                <input class="submit" type="submit" name="search" value="Search">
                </form>
            </div>

            <div class="dropdown itemHeader">
                <a href="my_account.php"><button class="dropbtn">My account</button></a>
                <div class="dropdown-content">
                <a href="customer_register.php">Register User</a>
                <a href="admin_area/index.php?login_provider">Login Provider</a>
                </div>
            </div>
            <div class="dropdown itemHeader">
            <?php
              if(!isset($_SESSION['customer_email'])){
                echo "<a href='checkout.php'><button class='dropbtn'>Login</button></a>";
              }else{
                echo "<a href='logout.php'><button class='dropbtn'>Logout</button></a>";
              }
            ?>
          </div>
            <a href="cart.php" id="carrito"><img src="images/carritoIcon.png" class="itemHeader" alt="carrito"></a>

        </header>

        <nav> <!--equipment, musica, home, brands, instrumentos  -->
            <a href="index.php"><button class="dropbtn">Home</button></a>
            <a href="all_products.php"><button class="dropbtn">All Products</button></a>
            <div class="dropdown itemNav">
                <a href=""><button class="dropbtn">Categorias</button></a>
                <div class="dropdown-content">
                    <?php getCats();?> 
                </div>
            </div>
            <div class="dropdown itemNav">
                <a href=""><button class="dropbtn">Marcas</button></a>
                <div class="dropdown-content">
                    <?php getBrands();?> 
                </div>
            </div>

            <div id="shopping_Cart">

            </div>

        </nav>

        <?php cart();?>
        <div id="shopping_Cart">
            <span style="font-size:18px; padding: 5px; line-height:40px;">
                <?php
                if(isset($_SESSION['customer_email'])){
                    echo "<b>Bienvenido </b>".$_SESSION['customer_email']."<b style='color:yellow'> Tu </b>";
                }else{
                    echo "Bienvenido Invitado: ";
                }
                ?>
                <b style="color:yellow">Carrito - </b>
                Cantidad de Items: <?php if(isset($_SESSION['customer_email'])){total_items();}else{echo"Login para ver";}?>
            </span>
        </div>


        <?php
            if(!isset($_SESSION['customer_email'])){//si no esta seteada la sesion
                include("customer_login.php");
            }else{
                include("payment.php");
            }
        ?>


        <footer class="footer-distributed">

            <div class="footer-left">

                <img src="images/logo.png" alt="">

                <p class="footer-links">
                    <a href="#" class="link-1">Home</a>

                    <a href="#">Quienes somos</a>
                    
                    <a href="#">Contact</a>
                </p>

                <p class="footer-company-name">UniMusic © 2020</p>
            </div>

            <div class="footer-center">

                <div>
                    <p><span>Puerto Madero</span> Buenos Aires, Argentina</p>
                </div>

                <div>
                    <p>+54.11.6678.4884</p>
                </div>

                <div>
                    <p><a href="mailto:support@company.com">uniMusic@company.com</a></p>
                </div>

            </div>

            <div class="footer-right">

                <p class="footer-company-about">
                    <span>Sobre la pagina</span>
                    Ecommerce creado para la materia Programacion Web
                </p>

                <div class="footer-icons">
                    <a href="" target="_blank">
                    <img width="34" height="34" src="https://res.cloudinary.com/cloudinary-account/image/upload/v1469457641/facebook_khedl5.svg"></a></img>

                    <a href="" target="_blank">
                    <img width="34" height="34" src="https://res.cloudinary.com/cloudinary-account/image/upload/v1469457641/twitter_fu5ejk.svg"></a></img>

                    <a href="" target="_blank">
                    <img width="34" height="34" src="https://res.cloudinary.com/cloudinary-account/image/upload/v1469457641/instagram_ugek0w.svg"></a></img>

                </div>

            </div>

        </footer>

        
    </body>
</html>