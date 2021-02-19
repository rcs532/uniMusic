<?php
    include("includes/db.php");
    $user = $_SESSION['customer_email'];
    $get_customer = "SELECT * FROM customers WHERE customer_email='$user'";
    $run_customer = mysqli_query($con,$get_customer);
    $row_customer = mysqli_fetch_array($run_customer); 

    $c_id = $row_customer['customer_id'];
    $name = $row_customer['customer_name'];
    $email = $row_customer['customer_email'];
    $pass = $row_customer['customer_pass'];
    $country = $row_customer['customer_country'];  
    $city = $row_customer['customer_city'];
    $contact = $row_customer['customer_contact'];
    $address = $row_customer['customer_address'];
?> 
<form class="loginForm" method="POST"  onsubmit="return validate();" enctype="multipart/form-data">

    <div class="row">
        <label for="c_name">Nombre</label>
        <input type="text" id="c_name" name="c_name" autocomplete="off" value="<?php echo $name; ?>" required>
    </div>

    <div class="row">
        <label for="c_email">Email</label>
        <input type="text" name="c_email" id="c_email" value="<?php echo $email; ?>" required>
    </div>
    

    
    <div class="row">
        <label for="c_image">Imagen</label>
        <input type="file" name="c_image" id="c_image" required>
    </div>


    <div class="row">
        <label for="c_country">Pais</label>
        <select name="c_country" id="c_country" disabled>
            <option><?php echo$country; ?></option>
            <option>Honduras</option>
            <option>Argentina</option>
            <option>Ecuador</option>
            <option>Colombia</option>
            <option>El Salvador</option>
            <option>Costa Rica</option>

        </select>
    </div>

    <div class="row">
        <label for="c_city">Ciudad</label>
        <input type="text" name="c_city" id="c_city" value="<?php echo $city; ?>" required>
    </div>

    <div class="row">
        <label for="c_contact">Numero de contacto</label>
        <input type="text" name="c_contact" id="c_contact" value="<?php echo $contact; ?>" required>
    </div>

    <div class="row">
        <label for="c_address">Direccion</label>
        <input type="text" name="c_address" id="c_address" value="<?php echo $address; ?>" required>
    </div>

    <input type="submit" name="update" class="login" value="Actualizar Informacion!">
</form>


<?php
    if(isset($_POST['update'])){//si se le dio click al boton register
        //$ip = getIp();
        $customer_id = $c_id;
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];

        move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

        $update_c = "UPDATE `customers` SET`customer_name`='$c_name',`customer_email`='$c_email',`customer_city`='$c_city',`customer_contact`='$c_contact',`customer_address`='$c_address',`customer_image`='$c_image' WHERE customer_id='$customer_id'";

        $run_update = mysqli_query($con,$update_c);

        if($run_update){
            echo "<script>alert('Usuario modificado con exito!')</script>";
            echo "<script>window.open('my_account.php','_self')</script>";
        }
    }

?>