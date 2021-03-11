<!DOCTYPE html>
<?php
    include("../includes/db.php");
    include("../functions/functions.php");
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert Product </title>
    </head>
    <body>

        <h1 id="h1Login">Agregue un Producto</h1>
        <form class="loginForm" action="insert_product.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <label for="product_title">Titulo</label>
                <input type="text" id="product_title" name="product_title" autocomplete="off" placeholder="Insertar Titulo" required>
            </div>
            <div class="row">
                <label for="product_cat">Categoria</label>
                <select name="product_cat" id="product_cat">
                    <option>Seleccionar Categoria</option>
                    <?php
                        
                    
                        $get_cats = "SELECT * from categories";
                    
                        $run_cats=mysqli_query($con,$get_cats);
                    
                        while($row_cats=mysqli_fetch_array($run_cats)){
                            $cat_id = $row_cats['cat_id'];
                            $cat_title = $row_cats['cat_title'];
                    
                        echo "<option value='$cat_id'>$cat_title</option>";
                        }
                        
                    ?>

                </select>
            </div>    
            <div class="row">
                <label for="product_brand">Marca</label>
                <select name="product_brand" id="product_brand">
                    <?php
                        $brand_email = $_SESSION['brand_email'];
                        $get_brands = "SELECT * from brands where brand_email='$brand_email'";

                        $run_brands=mysqli_query($con,$get_brands);

                        $row_brands=mysqli_fetch_array($run_brands);
                        $brand_id = $row_brands['brand_id'];
                        $brand_title = $row_brands['brand_title'];

                        echo "<option value='$brand_id'>$brand_title</option>";
                        
                    ?>

                </select>
            </div>    
            <div class="row">
                <label for="product_image">Imagen</label>
                <input type="file" id="product_image" name="product_image" required>
            </div>    
            <div class="row">
                <label for="product_price">Precio</label>
                <input type="text" id="product_price" name="product_price" autocomplete="off" placeholder="Insertar Precio" required>
            </div>
            <div class="row">
                <label for="product_stock">Cantidad de Productos</label>
                <input type="text" id="product_stock" name="product_stock" autocomplete="off" placeholder="Insertar Stock de Producto" required>
            </div>     
            <div class="row">
                <label for="product_desc">Descripcion</label>
                <textarea name="product_desc" id="product_desc" cols="20" rows="10"></textarea>
            </div>    
            <div class="row">
                <label for="product_keywords">Palabras Clave</label>
                <input type="text" id="product_keywords" name="product_keywords" autocomplete="off" placeholder="Insertar Palabras Clave" required>
            </div>    
            <div class="row">
                <input id="submit" type="submit" name="insert_post" value="Insertar Producto">
            </div>    

        </form>


    </body>
</html>

<?php
    if(isset($_POST['insert_post'])){//si se hace la submission de el boton con nombre 'insert_post'
        //guardo eso que viene en el post en variables locales
        $product_title = $_POST['product_title']; 
        $product_cat= $_POST['product_cat']; 
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $product_stock = $_POST['product_stock'];
        //metodo de agarrar la imagen
        $product_image = $_FILES['product_image']['name']; //no se hace el target con post. Se hace con FILES
        $product_image_tmp = $_FILES['product_image']['tmp_name'];

        move_uploaded_file($product_image_tmp,"product_images/$product_image");//la muevo a un repo local


        // INSERT INTO `products`
        // (`product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, 
        // `product_keywords`) 
        // VALUES ([value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
        
        $insert_product= "INSERT INTO `products`(`product_cat`, `product_brand`, `product_title`, `product_price`, `product_stock`, `product_desc`, `product_image`, `product_keywords`) VALUES ('$product_cat','$product_brand','$product_title','$product_price','$product_stock','$product_desc','$product_image','$product_keywords')";
        
        $insert_pro = mysqli_query($con,$insert_product);//mando el query
        if($insert_pro){
            echo "<script>alert('Producto fue agregado')</script>";
            echo "<script>window.open('index.php?insert_product','_self')</script>";
        }else{
            echo "<script>alert('Producto NOOO fue agregado')</script>";
        }
    }





?>