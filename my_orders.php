<?php
    include("includes/db.php");
    $user = $_SESSION['customer_email'];
    $get_customer = "SELECT * FROM customers WHERE customer_email='$user'";
    $run_customer = mysqli_query($con,$get_customer);
    $row_customer = mysqli_fetch_array($run_customer); 

    $c_id = $row_customer['customer_id'];
?>


<div class="main-content">
    <div class="content-page">
        <div class="title-section" style='text-align:center;'><b><?php cambiarHeader();?></b></div>
        <div class="products-list" id="space-list">
            <?php
                global $con;
                


                $get_venta= "SELECT * FROM ventas WHERE idCliente=$c_id"; //solo vamos a traer 6 random
        
                $run_ventas = mysqli_query($con,$get_venta);
        
                while($row_venta = mysqli_fetch_array($run_ventas)){
                    $idVenta = $row_venta['idVenta']; //aqui obtengo una venta
                    //ahora necesito obtener sus productos que estan en la tabla detalleventas
                    $fechaCompra = $row_venta['fecha'];
                    $totalGastado = $row_venta['precioTotal'];
                    $query_productos = "SELECT * FROM detalleventas WHERE idVenta=$idVenta";

                    $run_productos = mysqli_query($con,$query_productos);
                    echo "<h1 align=".'center'.">Compra realizada en la fecha: $fechaCompra.</h1>";
                    echo "<h2 align=".'center'." style='margin-top:2%; margin-bottom: 3%;'>Por un total de: $totalGastado USD</h2>";

                    while($row_producto=mysqli_fetch_array($run_productos)){
                        $idProducto = $row_producto['idProd'];
                        $query_singular = "SELECT * FROM products WHERE product_id=$idProducto";
                        $run_singular = mysqli_query($con,$query_singular);
                        $producto = mysqli_fetch_array($run_singular);

                        $pro_image = $producto['product_image'];
                        $pro_title  = $producto['product_title'];
                        $pro_price = $producto['product_price'];

                        echo "
                        <div class='product-box'>
                            <a href='details.php?pro_id=$idProducto'>
                                <div class='product'>
                                    <img src='admin_area/product_images/$pro_image'/>
                                    <div class='detail-title'>$pro_title</div>
                                    <div class='detail-price'>USD:  $pro_price</div>
                                </div>
                            </a>
                        </div>";


                    }
        
                }
            
            
            
            ?>
        </div>
    </div>
</div>