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
        <title>UniMusic</title>
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
                <a href="customer/my_account.php"><button class="dropbtn">My account</button></a>
                <div class="dropdown-content">
                <a href="#">Register User</a>
                <a href="#">Login Provider</a>
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
        <form action="" method="post">
            <table align="center" width="100%" bgcolor="skyblue">
                <tr align="centers">
                    <th>Borrar</th>
                    <th>Producto/S</th>
                    <th>Cantidad</th>
                    <th>Precio Total</th>
                </tr>
                <?php 
                    $total = 0;
                    global $con;
                
                    $ip = getIp();
                
                    $sel_price = "SELECT * FROM cart where ip_add='$ip'"; //cambiar el ip por el id de usuario mas adelante
                
                
                    $run_price = mysqli_query($con,$sel_price);
                
                    while($p_price = mysqli_fetch_array($run_price)){
                
                        $pro_id  = $p_price['p_id'];
                
                        $pro_price = "SELECT * FROM products where product_id='$pro_id'";//saco data de la tabla products
                        
                        $run_pro_price = mysqli_query($con,$pro_price);
                
                        while($pp_price = mysqli_fetch_array($run_pro_price)){
                            $product_price = array($pp_price['product_price']);

                            $product_title = $pp_price['product_title'];

                            $product_image = $pp_price['product_image'];

                            $single_price = $pp_price['product_price'];
                            $values = array_sum($product_price);
                            $total += $values;
                        }
                        ?>
                        <tr align="center">
                            <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                            <td><?php echo $product_title;?><br>
                                <img src="admin_area/product_images/<?php echo $product_image;?>" width="60px" height="60px" style="margin-top:0;">
                            </td>
                            <td><input type="text" size="4" name="qty"  value="<?php
                                if(isset($_SESSION['qty'])){
                                    echo $_SESSION['qty'];
                                }else{
                                    echo 1;
                                }
                            ?>"/></td>
                            <?php
                                global $con;
                                if(isset($_POST['update_cart'])){
                                    
                                    $qty = $_POST['qty']; //cantidad

                                    $update_qty = "UPDATE cart set qty='$qty'";

                                    $run_qty = mysqli_query($con,$update_qty);

                                    $_SESSION['qty'] = $qty;

                                    $total = $total*$qty;
                                }
                            
                            ?>
                            <td><?php echo "$".$single_price; ?></td>
                        </tr>
                         <?php    
                    }
                
                               
                ?> 
                <tr align="right">
                    <td colspan="4"><b>SubTotal: </b><?php echo "$".$total; ?></td>
                </tr> 
                <tr align="center">
                    <td><input  class="botonToCart" type="submit" name="delete_cart" value="Borrar Seleccionados"/></td>
                    <td><input  class="botonToCart" type="submit" name="update_cart" value="Actualizar Seleccion"/></td>
                    <td><input class="botonToCart" type="submit" name="continue" value="Continua Comprando"/></td>
                    <td><button class="botonToCart"><a href="checkout.php" style="text-decoration:none;">Checkout</a></button></td>
                </tr>
            </table>
        
        </form>
        <?php 
            
                global $con;
                $ip = getIp();
                if(isset($_POST['delete_cart'])){ //si se le da click a borrar loopeamos sobre cada uno
                    //borramos y despues refrescamos
                    foreach($_POST['remove'] as $remove_id){
                        $delete_product = "DELETE FROM cart where p_id='$remove_id' AND ip_add='$ip'";
                        $run_delete = mysqli_query($con,$delete_product);
                        if($run_delete){
                            echo "<script>window.open('cart.php','_self')</script>";
                        }
                    }
                }
                if(isset($_POST['continue'])){//si alguien quiere seguir comprando y salir del carrito
                    echo "<script>window.open('index.php','_self')</script>";
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