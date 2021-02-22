<?php
    include("includes/db.php");
?>

<h1 id="h1Login">Login para Proveedores</h1>
<form class="loginForm" method="POST" onsubmit="return validate();">
    <div class="row">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" autocomplete="off" placeholder="email@example.com" required>
    </div>
    <div class="row">
        <label for="pass">Password</label>
        <input type="password" name="pass" required>
    </div>
    <input type="submit" class="login" name="login" value="Login">
</form>

<?php 
    if(isset($_POST['login'])){
        $c_email = $_POST['email'];
        $c_pass = $_POST['pass'];

        $sel_c = "SELECT * FROM brands where brand_pass='$c_pass' AND brand_email='$c_email'";

        $run_c = mysqli_query($con,$sel_c);

        $check_provider = mysqli_num_rows($run_c);// chequeamos si existe el cliente o no

        if($check_provider==0){//si no existe
            echo "<script>alert('El email o a contraseña son incorrectos')</script>";
            exit();//no se ejecuta el resto de la pagina si el email o contrasela estan incorrectos
        }
        $_SESSION['brand_email'] = $c_email;
        echo "<script>alert('Login de proveedor exitoso')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }

?>