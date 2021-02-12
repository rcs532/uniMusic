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
        <link rel="stylesheet" href="../styles/style.css">
        <title>Insert Product </title>
    </head>
    <body>
        <header>
            <img  class="itemHeader"id="logo" src="../images/logo.png" alt="logotipoUniMusic">

            <div class="search-container itemHeader">
                <form metho="get" action="results.php" enctype="multipart/form-data">
                  <input type="text" placeholder="Search.." name="user_query">
                  <input class="submit" type="submit" name="search" value="Search">
                </form>
            </div>

            <div class="dropdown itemHeader">
                <button class="dropbtn">My account</button>
                <div class="dropdown-content">
                  <a href="#">Login User</a>
                  <a href="#">Register User</a>
                  <a href="#">Login Provider</a>
                </div>
            </div>

            <a href="" id="carrito"><img src="../images/carritoIcon.png" class="itemHeader" alt="carrito"></a>

        </header>

        <nav> <!--equipment, musica, home, brands, instrumentos  -->
            <a href=""><button class="dropbtn">Home</button></a>
            <a href=""><button class="dropbtn">All Products</button></a>
            <div class="dropdown itemNav">
                <a href=""><button class="dropbtn">Categorias</button></a>
                <div class="dropdown-content">
                   <?php getCats();?> 
                </div>
            </div>
            <a href=""><button class="dropbtn">Marcas</button></a>
        </nav>

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
                    <option>Seleccionar Marca</option>
                    <?php
                        
                        $get_brands = "SELECT * from brands";

                        $run_brands=mysqli_query($con,$get_brands);

                        while($row_brands=mysqli_fetch_array($run_brands)){
                            $brand_id = $row_brands['brand_id'];
                            $brand_title = $row_brands['brand_title'];

                        echo "<option value='$brand_id'>$brand_title</option>";
                        }
                        
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

<?php
    if(isset($_POST['insert_post'])){//si se hace la submission de el boton con nombre 'insert_post'
        //guardo eso que viene en el post en variables locales
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


        // INSERT INTO `products`
        // (`product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`, 
        // `product_keywords`) 
        // VALUES ([value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
        
        $insert_product= "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, 
        product_keywords) values ('$product_cat', '$product_brand', '$product_title', '$product_price','$product_desc', '$product_image', 
        '$product_keywords')";
        
        $insert_pro = mysqli_query($con,$insert_product);//mando el query
        if($insert_pro){
            echo "<script>alert('Producto fue agregado')</script>";
            echo "<script>window.open('insert_product.php','_self')</script>";
        }
    }





?>