<!DOCTYPE html>
<?php
    include("../includes/db.php");
    include("../functions/functions.php");

    if(isset($_GET['edit_pro'])){
        $get_id = $_GET['edit_pro'];

        $get_pro = "SELECT * FROM products where product_id=$get_id";

        $run_pro = mysqli_query($con,$get_pro);
        $row_pro=mysqli_fetch_array($run_pro);
        
        $pro_id = $row_pro['product_id'];
        $pro_title = $row_pro['product_title'];
        $pro_image= $row_pro['product_image'];
        $pro_price = $row_pro['product_price'];
        $pro_desc = $row_pro['product_desc'];
        $pro_keywords = $row_pro['product_keywords'];
        $pro_cat = $row_pro['product_cat'];
        $pro_brand = $row_pro['product_brand'];
    }
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Producto</title>
    </head>
    <body>

        <h1 id="h1Login">Edite el Producto</h1>
        <form class="loginForm" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <label for="product_title">Titulo</label>
                <input type="text" id="product_title" name="product_title" autocomplete="off" placeholder="Insertar Titulo" value="<?php echo $pro_title; ?>">
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
                <input type="file" id="product_image" name="product_image">
            </div>    
            <div class="row">
                <label for="product_price">Precio</label>
                <input type="text" id="product_price" name="product_price" autocomplete="off" placeholder="Insertar Precio" value="<?php echo $pro_price; ?>">
            </div>    
            <div class="row">
                <label for="product_desc">Descripcion</label>
                <textarea name="product_desc" id="product_desc" cols="20" rows="10"><?php echo $pro_desc; ?></textarea>
            </div>    
            <div class="row">
                <label for="product_keywords">Palabras Clave</label>
                <input type="text" id="product_keywords" name="product_keywords" autocomplete="off" placeholder="Insertar Palabras Clave" value="<?php echo $pro_keywords; ?>">
            </div>    
            <div class="row">
                <input id="submit" type="submit" name="update_product" value="Realizar Cambios">
            </div>    

        </form>


    </body>
</html>

<?php
    if(isset($_POST['update_product'])){
        $update_id = $pro_id;

        $product_title = $_POST['product_title']; 
        $product_cat= $_POST['product_cat']; 
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];

        //metodo de agarrar la imagen
        $product_image = $_FILES['product_image']['name']; //no se hace el target con post. Se hace con FILES
        $product_image_tmp = $_FILES['product_image']['tmp_name'];

        move_uploaded_file($product_image_tmp,"product_images/$product_image");//la muevo a un repo local

        $update_product= "UPDATE products SET `product_cat`='$product_cat',`product_brand`='$product_brand',`product_title`='$product_title',
        `product_price`='$product_price',`product_desc`='$product_desc',`product_image`='$product_image',`product_keywords`='$product_keywords' WHERE product_id='$update_id'";
        
        $run_update = mysqli_query($con,$update_product);//mando el query
        if($run_update){
            echo "<script>alert('Producto fue modificado')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
        }
    }





?>