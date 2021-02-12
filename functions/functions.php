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








?>