<div class="main-content">
    <div class="content-page">
        <div class="title-section" style='text-align:center;'><b>Productos de esta marca</b></div>
        <div class="products-list" id="space-list">
            <?php 
                $brand_email = $_SESSION['brand_email'];
                $get_brands = "SELECT * from brands where brand_email='$brand_email'";

                $run_brands=mysqli_query($con,$get_brands);

                $row_brands=mysqli_fetch_array($run_brands);
                $brand_id = $row_brands['brand_id'];



            $get_pro = "SELECT * FROM products where product_brand='$brand_id'";
            //$emailUsuario = $_SESSION['customer_email'];
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
                <div class='product'>
                    <img src='product_images/$pro_image'/>
                    <div class='detail-title'>$pro_title</div>
                    <div class='detail-price'>USD:  $pro_price</div>
                    <a href='delete_pro.php'><button id='delete' class='botonToCart'>Eliminar Producto</button></a>
                    <a href='index.php?edit_pro.php'><button id='delete' class='botonToCart'>Editar Producto</button></a>
                </div>
            </div>";

            }

            ?>

        </div>
    </div>
</div>