<?php
    session_start();
    include("functions/functions.php");
    if(!isset($_SESSION['customer_email'])){
        echo "<script>window.open('customer_login.php','_self')</script>";
    }else{
        $c_email = $_SESSION['customer_email'];
        $sel_c = "SELECT * FROM customers WHERE customer_email='$c_email'";

        $run_c = mysqli_query($con,$sel_c);

        $elCliente = mysqli_fetch_array($run_c);
        $id_Cliente = $elCliente['customer_id'];
        $nombreCliente = $elCliente['customer_name'];
        $imgCliente = $elCliente['customer_image'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Checkout Card</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="js/cardValidation.js"></script>
        <!-- style css -->
        <link rel="stylesheet" href="styles/stylePayment.css">
    </head>
    <body>

        <h2 align="center">Realice el Pago</h2>
        <div class="row">
            <div class="col-75">
                <div class="container">
                    <form id="validate" method="POST" onsubmit="return validarTarjeta();">
                        <div class="row">
                            <div class="col-50">
                                <a href="index.php">Regresar a tienda</a>
                                <h3>Cliente:</h3>
                                <label for="fname">Nombre Completo: </label>
                                <input type="text" id="fname" name="fullname" value="<?php echo $nombreCliente;?>">
                                <label for="email"></i> Email: </label>
                                <input type="text" id="email" name="email" value="<?php $c_email = $_SESSION['customer_email']; echo $c_email; ?>">
                                <img src="<?php echo "customer/customer_images/$imgCliente";?>" alt="" width="300px">
                            </div>

                            <div class="col-50">
                                <h3>Payment</h3>
                
                                <div class="icon-container">
                                    <img src="images/masterCardIcon.png" alt="" width="55px"> 
                                    <img src="images/visaIcon.png" alt="" width="55px">
                                </div>

                                <label for="cname">Nombre en tarjeta</label>
                                <input type="text" id="cname" name="cardname" placeholder="Roberto Salinas" required>
                                <label for="ccnum">Credit card number</label>
                                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>
                                <label for="expmonth">Mes de expiracion</label>
                                <input type="text" id="expmonth" name="expmonth" placeholder="Septiembre"required>
                                <div class="row">
                                    <div class="col-50">
                                        <label for="expyear">Año Expiracion</label>
                                        <input type="text" id="expyear" name="expyear" placeholder="2021"required>
                                    </div>
                                    <div class="col-50">
                                        <label for="cvv">CVV</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="352"required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="comprar" value="Intentar Pago" class="btn">
                    </form>
                </div>
            </div>
            <div class="col-25">
            <?php 
                if(isset($_SESSION['customer_email'])){
                    $total = 0;
                    global $con;
                    $c_email = $_SESSION['customer_email'];


                    $sel_c = "SELECT * FROM customers WHERE customer_email='$c_email'";

                    $run_c = mysqli_query($con,$sel_c);

                    $elCliente = mysqli_fetch_array($run_c);
                    $id_Cliente = $elCliente['customer_id'];
                
                    $sel_price = "SELECT * FROM cart where customer_id='$id_Cliente'"; //cambiar el ip por el id de usuario mas adelante
                
                
                    $run_price = mysqli_query($con,$sel_price);
                    ?>
                    <div class="container">
                        <h4>Carrito</h4>
                    <?php
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
                        <p><a href="details.php?pro_id=<?php echo $pro_id;?>"><?php echo $product_title;?></a> <span class="price"><?php echo "$".$single_price; ?></span></p>
                        <hr>                       
                        <?php 
                    }
                    ?>
                    <p>Total <span class="price" style="color:black"><b>USD: <?php echo $total;?></b></span></p>
                    </div> 
                <?php
                }
                ?> 
            </div>
        </div>
    </body>
</html>

<?php 
if(isset($_POST['comprar'])){//si se apreta el boton de intentar Pago(y se valido)
    //ya estan arriba los datos del cliente
    $totalCarrito = getTotalCarrito();
    $mydate = getdate();
    $fechaCompra = "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year], $mydate[hours]:$mydate[minutes]:$mydate[seconds] seconds ";
    $queryVentas = "INSERT INTO `ventas`(`idCliente`, `fecha`,`precioTotal`) VALUES ('$id_Cliente','$fechaCompra','$totalCarrito')";
    $runqueryVentas = mysqli_query($con,$queryVentas);
    //agrego detalles de la venta

    $ventaQuery = "SELECT * FROM `ventas` WHERE `idCliente`='$id_Cliente' AND `fecha`='$fechaCompra'";
    $runVenta = mysqli_query($con,$ventaQuery);
    $venta = mysqli_fetch_array($runVenta);

    $idVenta = $venta['idVenta']; //agarro el id de la venta para empezar a armar detalles

    $arregloDeProductos = getItemsCarrito();
    $i=0;
    while($i<sizeof($arregloDeProductos)){
        $query = "INSERT INTO `detalleventas`(`idProd`, `idVenta`) VALUES ('$arregloDeProductos[$i]','$idVenta')";
        $run = mysqli_query($con,$query);
        cambiarStock($arregloDeProductos[$i],$idVenta);
        $queryCarrito = "DELETE FROM `cart` WHERE `customer_id`='$id_Cliente' AND p_id='$arregloDeProductos[$i]'";
        $runQueryCarrito = mysqli_query($con,$queryCarrito);
        $i++;
    }

    
    echo "<script>alert('Compra exitosa')</script>";
    echo "<script>window.open('index.php','_self')</script>";
}


?>