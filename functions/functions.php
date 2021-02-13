<?php

$con = mysqli_connect("localhost","root","","ecommerce");

if($con==false){
    echo die(mysqli_connect_error());
}

//getting the categories
function getCats(){
    global $con;

    $get_cats = "SELECT * from categories";

    $run_cats=mysqli_query($con,$get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)){
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

    echo "<a href='index.php?cat=$cat_id'>$cat_title</a>";
    }

}

//getting the brands
function getBrands(){
    global $con;

    $get_brands = "SELECT * from brands";

    $run_brands=mysqli_query($con,$get_brands);

    while($row_brands=mysqli_fetch_array($run_brands)){
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];

    echo "<a href='index.php?brand=$brand_id'>$brand_title</a>";
    }

}


//traer los productos de bd
function getPro(){


    if(!isset($_GET['cat']) && !isset($_GET['brand'])){ //si no esta set tirame productos random
        global $con;
        

        $get_pro = "SELECT * FROM products ORDER BY RAND() LIMIT 0,5"; //solo vamos a traer 6 random

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
                        <a href='index.php?pro_id=$pro_id'><button class='botonToCart'>Add to Cart</button></a>
                    </div>
                </a>
            </div>";

        }
    }
}

//para cambiar el header del display
function cambiarHeader(){
    if(!isset($_GET['cat']) && !isset($_GET['brand'])){
        global $con;
        echo "Productos Destacados";
    }else if(isset($_GET['cat'])){
        global $con;

        $cat_id = $_GET['cat'];
        
        $sql = "SELECT * FROM `categories` WHERE cat_id=$cat_id";

        $run = mysqli_query($con,$sql);

        $row = mysqli_fetch_array($run);

        echo $row['cat_title'];



    }else if(isset($_GET['brand'])){
        global $con;

        $brand_id = $_GET['brand'];
        $sql = "SELECT * FROM `brands` WHERE brand_id=$brand_id";

        $run = mysqli_query($con,$sql);

        $row = mysqli_fetch_array($run);

        echo $row['brand_title'];    
    }
}

function getCatPro(){


    if(isset($_GET['cat'])){ //si esta set en la url la variable cat tirame productos random
        global $con;
        $cat_id = $_GET['cat'];

        $get_cat_pro = "SELECT * FROM products WHERE product_cat = '$cat_id'"; //solo vamos a traer 6 random

        $run_cat_pro = mysqli_query($con,$get_cat_pro);

        $count_cats= mysqli_num_rows($run_cat_pro);
        if($count_cats==0){
            echo "<h2 style='margin=0 auto;'>No hay productos de esta categoria.</h2>";
        }
        while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){
            
            $pro_id=$row_cat_pro['product_id'];
            $pro_cat=$row_cat_pro['product_cat'];
            $pro_brand=$row_cat_pro['product_brand'];
            $pro_title=$row_cat_pro['product_title'];
            $pro_price=$row_cat_pro['product_price'];
            //$pro_desc=$row_pro['product_desc'];
            $pro_image=$row_cat_pro['product_image'];
            //$pro_=$row_pro['product_'];


            echo "
            <div class='product-box'>
                <a href='details.php?pro_id=$pro_id'>
                    <div class='product'>
                        <img src='admin_area/product_images/$pro_image'/>
                        <div class='detail-title'>$pro_title</div>
                        <div class='detail-price'>USD:  $pro_price</div>
                        <a href='index.php?pro_id=$pro_id'><button class='botonToCart'>Add to Cart</button></a>
                    </div>
                </a>
            </div>";
            

        }
    }
}


function getBrandsPro(){// traigo productos por marcas


    if(isset($_GET['brand'])){ 
        global $con;
        $brand_id = $_GET['brand'];

        $get_brand_pro = "SELECT * FROM products WHERE product_brand = '$brand_id'";

        $run_brand_pro = mysqli_query($con,$get_brand_pro);
        $count_brands= mysqli_num_rows($run_brand_pro);
        if($count_brands==0){
            echo "<h2 style='margin=0 auto;'>No hay productos de esta marca.</h2>";
        }
        while($row_brand_pro = mysqli_fetch_array($run_brand_pro)){
            $pro_id=$row_brand_pro['product_id'];
            $pro_cat=$row_brand_pro['product_cat'];
            $pro_brand=$row_brand_pro['product_brand'];
            $pro_title=$row_brand_pro['product_title'];
            $pro_price=$row_brand_pro['product_price'];
            //$pro_desc=$row_pro['product_desc'];
            $pro_image=$row_brand_pro['product_image'];
            //$pro_=$row_pro['product_'];

     
            echo "
            <div class='product-box'>
                <a href='details.php?pro_id=$pro_id'>
                    <div class='product'>
                        <img src='admin_area/product_images/$pro_image'/>
                        <div class='detail-title'>$pro_title</div>
                        <div class='detail-price'>USD:  $pro_price</div>
                        <a href='index.php?pro_id=$pro_id'><button class='botonToCart'>Add to Cart</button></a>
                    </div>
                </a>
            </div>";
            

        }
    }
}



?>