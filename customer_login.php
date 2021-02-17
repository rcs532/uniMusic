<?php
    include("includes/db.php");
?>

<h1 id="h1Login">Login o Registrarse para comprar</h1>
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
    <a href="checkout.php?forgot_pass" style="margin-top: 10%;">Olvido su contraseña?</a>
    <a href="customer_register.php"  style="margin-top: 10%; margin-left: 5%;">¡Registrarse aqui!</a>
</form>

<?php 
    if(isset($_POST['login'])){
        $c_email = $_POST['email'];
        $c_pass = $_POST['pass'];

        $sel_c = "SELECT * FROM customers where customer_pass='$c_pass' AND customer_email='$c_email'";

        $run_c = mysqli_query($con,$sel_c);

        $check_customer = mysqli_num_rows($run_c);// chequeamos si existe el cliente o no

        if($check_customer==0){//si no existe
            echo "<script>alert('El email o a contraseña son incorrectos')</script>";
            exit();//no se ejecuta el resto de la pagina si el email o contrasela estan incorrectos
        }

        //$ip = getIp();
        $elCliente = mysqli_fetch_row($run_c);
        $id_Cliente = $elCliente['customer_id'];

        $sel_cart = "SELECT * FROM cart where customer_id='$id_Cliente'";

        $run_cart = mysqli_query($con,$sel_cart);

        $check_cart = mysqli_num_rows($run_cart);

        if($check_customer>0 AND $check_cart==0){
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Login exitoso')</script>";
            echo "<script>window.open('my_account.php','_self')</script>";
        }else{ //si tiene cosas en el carrito lo mando a pagar
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Login exitoso')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
    }

?>
