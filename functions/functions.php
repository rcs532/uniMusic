<?php
//getting the categories

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

    echo "<a href='#'>$cat_title</a>";
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

    echo "<a href='#'>$brand_title</a>";
    }

}


    //traer los productos de bd
    function getPro(){
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




?>