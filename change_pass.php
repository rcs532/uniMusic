

<h1 id="h1Login">Cambiar Contraseña</h1>
<form class="loginForm" method="POST" action="" onsubmit="return validatePass();">

    <div class="row">
        <label for="current_pass">Current Password</label>
        <input type="password" name="current_pass" id="current_pass" required>
    </div>

    <div class="row">
        <label for="new_pass">New Password</label>
        <input type="password" name="new_pass" id="new_pass" required>
    </div>
    <div class="row">
        <label for="confirm-password">Confirm-Password</label>
        <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password" required>
    </div>


    <input type="submit" name="change_pass" class="login" value="Cambiar Contraseña">
</form>

<?php
    include("includes/db.php");

    if(isset($_POST['change_pass'])){
        $user = $_SESSION['customer_email'];
        $current_pass = $_POST['current_pass'];
        $new_pass = $_POST['new_pass'];

        $sel_pass = "SELECT * FROM customers where customer_pass='$current_pass' AND customer_email='$user'";
        $run_pass = mysqli_query($con,$sel_pass);
        $check_pass =mysqli_num_rows($run_pass);

        if($check_pass==0){
            echo "<script>alert('La contraseña actual ingresada es incorrecta')</script>";
            exit();
        }else{
            $update_pass = "UPDATE customers SET customer_pass='$new_pass' where customer_email='$user'";
            $run_update = mysqli_query($con,$update_pass);
            echo "<script>alert('Su contraseña se actualizo correctamente')</script>";
            echo "<script>window.open('my_account.php','_self')</script>";
        }


    }

?>