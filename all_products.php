<!DOCTYPE html>
<?php
    include("functions/functions.php");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <title>UniMusic</title>
    </head>
    <body>

      <header>
          <a href="index.php"><img  class="itemHeader"id="logo" src="images/logo.png" alt="logotipoUniMusic"></a>

          <div class="search-container itemHeader">
              <form metho="get" action="results.php" enctype="multipart/form-data">
                <input type="text" placeholder="Search.." name="user_query">
                <input class="submit" type="submit" name="search" value="Search">
              </form>
          </div>

          <div class="dropdown itemHeader">
              <a href="customer/my_account.php"><button class="dropbtn">My account</button></a>
              <div class="dropdown-content">
                <a href="#">Login User</a>
                <a href="#">Register User</a>
                <a href="#">Login Provider</a>
              </div>
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
        <span style="font-size:18px; padding: 5px; line-height:40px;">Bienvenido ! <b style="color:yellow">Carrito - </b>
          Cantidad de Items: <?php total_items();?>; Precio Total: <?php total_price(); ?> USD
        </span>
      </div>



        <div class="main-content">
            <div class="content-page">
            <div class="title-section" style='text-align:center;'><b><?php cambiarHeader();?></b></div>
                <div class="products-list" id="space-list">
                    <?php 
                        $get_pro = "SELECT * FROM products";

                        $run_pro = mysqli_query($con,$get_pro);

                        while($row_pro = mysqli_fetch_array($run_pro)){
                            
                            $pro_id=$row_pro['product_id'];
                            $pro_cat=$row_pro['product_cat'];
                            $pro_brand=$row_pro['product_brand'];
                            $pro_title=$row_pro['product_title'];
                            $pro_price=$row_pro['product_price'];
                            //$pro_desc=$row_pro['product_desc'];
                            $pro_image=$row_pro['product_image'];
                            //$pro_=$row_pro['product_'];

                        echo "
                            <div class='product-box'>
                                <a href='details.php?pro_id=$pro_id'>
                                    <div class='product'>
                                        <img src='admin_area/product_images/$pro_image'/>
                                        <div class='detail-title'>$pro_title</div>
                                        <div class='detail-price'>USD:  $pro_price</div>
                                        <a href='index.php?add_cart=$pro_id'><button class='botonToCart'>Add to Cart</button></a>
                                    </div>
                                </a>
                            </div>";

                        }
                                    
                    ?>

                </div>
            </div>
	    </div>


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