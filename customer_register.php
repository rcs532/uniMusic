<!DOCTYPE html>
<?php
    session_start();
    include("functions/functions.php");
    include("includes/db.php");

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <title>Register</title>
        <script type="text/javascript" src="js/registerValidation.js"></script>
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


        <h1 id="h1Login">Registrar Cuenta</h1>
        <form class="loginForm" method="POST" action="customer_register.php" onsubmit="return validate();" enctype="multipart/form-data">

            <div class="row">
                <label for="c_name">Nombre</label>
                <input type="text" id="c_name" name="c_name" autocomplete="off" placeholder="Nombre" required>
            </div>

            <div class="row">
                <label for="c_email">Email</label>
                <input type="text" name="c_email" id="c_email" required>
            </div>

            <div class="row">
                <label for="c_pass">Password</label>
                <input type="password" name="c_pass" id="c_pass" required>
            </div>


            <div class="row">
                <label for="confirm-password">Confirm-Password</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required>
            </div>
            

            
            <div class="row">
                <label for="c_image">Imagen</label>
                <input type="file" name="c_image" id="c_image" required>
            </div>


            <div class="row">
                <label for="c_country">Pais</label>
                <select name="c_country" id="c_country">
                    <option>Select a Country</option>
                    <option>Honduras</option>
                    <option>Argentina</option>
                    <option>Ecuador</option>
                    <option>Colombia</option>
                    <option>El Salvador</option>
                    <option>Costa Rica</option>

                </select>
            </div>

            <div class="row">
                <label for="c_city">Ciudad</label>
                <input type="text" name="c_city" id="c_city" required>
            </div>

            <div class="row">
                <label for="c_contact">Numero de contacto</label>
                <input type="text" name="c_contact" id="c_contact" required>
            </div>

            <div class="row">
                <label for="c_address">Direccion</label>
                <input type="text" name="c_address" id="c_address" required>
            </div>

            <input type="submit" name="register" class="login" value="Crear Cuenta!">
        </form>


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

<?php
    if(isset($_POST['register'])){//si se le dio click al boton register
        //$ip = getIp();
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];

        move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

        $insert_c = "INSERT INTO `customers`(`customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`) 
        VALUES ('$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";

        $run_c = mysqli_query($con,$insert_c);

        if($run_c){
            echo "<script>alert('Usuario creado con exito!')</script>";
        }

        $sel_c = "SELECT * FROM customers WHERE customer_email='$c_email'";

        $run_c = mysqli_query($con,$sel_c);

        $elCliente = mysqli_fetch_row($run_c);
        $id_Cliente = $elCliente['customer_id'];



        $sel_cart = "SELECT * FROM cart where customer_id='$id_Cliente'";
        
        $run_cart = mysqli_query($con,$sel_cart);

        $check_cart = mysqli_num_rows($run_cart);

        if($check_cart==0){//si no hay items en el carrito
            $_SESSION['customer_email'] = $c_email; // abrimos sesion para la persona que se registro
            echo "<script>window.open('my_account.php','_self')</script>";
        }else{
            $_SESSION['customer_email'] = $c_email; // abrimos sesion para la persona que se registro
            echo "<script>window.open('checkout.php','_self')</script>"; //si tiene items en el carrito lo mandamos a pagar
        }
    }

?>