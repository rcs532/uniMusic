<h1 id="h1Login">Login o Registrarse para comprar</h1>
<form class="loginForm" method="POST" action="" onsubmit="return validate();">
    <div class="row">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" autocomplete="off" placeholder="email@example.com" required>
    </div>
    <div class="row">
        <label for="pass">Password</label>
        <input type="pass" name="pass" required>
    </div>
    <input type="submit" class="login" name="login" value="Login">
    <a href="checkout.php?forgot_pass" style="margin-top: 10%;">Olvido su contraseña?</a>
    <a href="customer_register.php"  style="margin-top: 10%; margin-left: 5%;">¡Registrarse aqui!</a>
</form>
