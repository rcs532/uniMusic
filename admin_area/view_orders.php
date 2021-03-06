<?php
    include_once("includes/db.php");
    $user = $_SESSION['brand_email'];
    $get_brand = "SELECT * FROM brands WHERE brand_email='$user'";
    $run_brand = mysqli_query($con,$get_brand);
    $row_brand = mysqli_fetch_array($run_brand); 

    $brand_id = $row_brand['brand_id'];
?>



<table class="responsive-table">
    <caption>Top 10 Grossing Animated Films of All Time</caption>
    <thead>
      <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Fecha</th>
        <th scope="col">Id Producto</th>
        <th scope="col">Producto</th>
        <th scope="col">Precio</th>
        <th scope="col">Imagen</th>
        <th scope="col">Id Venta</th>
      </tr>
    </thead>
    <tbody>
    <?php
    global $con;
    $sql = "SELECT ventas.idVenta, ventas.fecha,ventas.idCliente, customers.customer_name, detalleventas.idProd, products.product_brand, products.product_title, products.product_price, products.product_image\n"

    . "\n"

    . "FROM ventas\n"

    . "INNER JOIN customers ON ventas.idCliente = customers.customer_id\n"

    . "INNER JOIN detalleventas ON ventas.idVenta = detalleventas.idVenta\n"

    . "INNER JOIN products ON  detalleventas.idProd = products.product_id\n"

    . "WHERE products.product_brand=$brand_id\n"

    . "ORDER BY ventas.fecha,customers.customer_name";

    
    $run_query = mysqli_query($con,$sql);
    $i=0;
    while($row = mysqli_fetch_array($run_query)){
        $nombreCliente = $row['customer_name'];
        $fechaCompra = $row['fecha'];
        $nombrePro = $row['product_title'];
        $pro_price = $row['product_price'];
        $pro_image = $row['product_image'];
        $idProducto = $row['idProd'];
        $idVenta = $row['idVenta'];

        echo "
        <tr>
            <th scope='row'>$nombreCliente</th>
            <td data-title='Released'>$fechaCompra</td>
            <td data-title='Studio'>$idProducto</td>
            <td data-title='Worldwide Gross' data-type='currency'>$nombrePro</td>
            <td data-title='Domestic Gross' data-type='currency'>$pro_price</td>
            <td data-title='Foreign Gross' data-type='currency'><img src='product_images/$pro_image' style='max-width:150px;'/></td>
            <td data-title='Budget' data-type='currency'>$idVenta</td>
        </tr>
        
        ";



    }
    ?>
    </tbody>
  </table>