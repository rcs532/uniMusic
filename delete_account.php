<h1 id="h1Login">Eliminar su cuenta?</h1>
<form class="loginForm" method="POST">
    <input type="submit" class="login" name="yes" value="Eliminar">
    <input type="submit" class="login" name="no" value="No quiero eliminar">
</form>

<?php
    include("includes/db.php");

    $user = $_SESSION['customer_email'];

    if(isset($_POST['yes'])){
        $delete_customer = "DELETE FROM customers where customer_email='$user'";
        $run_customer = mysqli_query($con,$delete_customer);

        echo "<script>alert('Su cuenta fue borrada con exito.')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    }else if(isset($_POST['no'])){
        echo "<script>window.open('my_account.php','_self')</script>";

    }

?>