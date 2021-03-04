<!DOCTYPE html>
<?php
  session_start();
  include_once("includes/db.php");
  //include("functions/functions.php");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/style.css">
        <script type="text/javascript" src="../js/loginValidation.js"></script>
        <title>Admin Panel</title>
    </head>
    <body>
        <header>
            <a href="index.php"><img  class="itemHeader"id="logo" src="../images/logo.png" alt="logotipoUniMusic"></a>
            <h1 id="titulo">Bienvenido <?php
              if(isset($_SESSION['brand_email'])){
                echo $_SESSION['brand_email']; 
              }
            
            ?></h1>
            <a href="<?php  if(isset($_SESSION['brand_email'])){echo "logout.php";}else{echo "index.php?login_provider";}  ?>"><button class="dropbtn"><?php  if(isset($_SESSION['brand_email'])){echo "Logout";}else{echo "Login";}  ?></button></a>
        </header>

        <nav> <!--equipment, musica, home, brands, instrumentos  -->
            <a href="index.php?insert_product"><button class="dropbtn">Insertar Producto</button></a>
            <a href="index.php?view_products"><button class="dropbtn">Ver Productos</button></a>
            <a href="index.php?view_orders"><button class="dropbtn">Ver Ordenes</button></a>
        </nav>

        <?php
          if(isset($_GET['login_provider'])){
            include("login_provider.php");
          }
          if(isset($_GET['insert_product'])){
            if(isset($_SESSION['brand_email'])){
              include("insert_product.php");
            }else{
              include("login_provider.php");
            }
          }
          if(isset($_GET['view_products'])){
            if(isset($_SESSION['brand_email'])){
              include("view_products.php");
            }else{
              include("login_provider.php");
            }
          }   
          if(isset($_GET['edit_pro'])){
            if(isset($_SESSION['brand_email'])){
              include("edit_pro.php");
            }else{
              include("login_provider.php");
            }
          }   
        ?>

        <footer class="footer-distributed">

            <div class="footer-left">
  
              <img src="../images/logo.png" alt="">
  
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