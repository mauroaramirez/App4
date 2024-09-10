<!--
<!DOCTYPE html>
<html>
<head>
    <title> Login - App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE."css/login.css" ?>">

</head>
<body>
    <div class="login-container">
        <form class="login-form">
            <h2>Iniciar Sesión</h2>
            <div class="input-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" placeholder="Ingresar correo" required>
            </div>
            <div class="input-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión</button>
            <p class="forgot-password"><a href="#">¿Olvidaste tu contraseña?</a></p>
        </form>
    </div>
</body>
</html>
-->
<!DOCTYPE html>
<html>
<head>
    <title> Login - App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo SITE."css/login.css" ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image"> 
                <img src="images/free-crosshairs-icon-download-in-svg-png-gif-file-formats--ui-elements-pack-user-interface-icons-444638.png" alt="Iconoapp">
                <div class="text">
                    <p>Nuestro eslogan <i>- Nombre</i></p>
                </div>
            </div>
            <div class="col-md-6 right">
                <div class="input-box">
                <header>Iniciar sesión</header>
                <div class="input-field">
                        <input type="text" class="input" id="email" required="" autocomplete="off">
                        <label for="email">Correo electrónico</label> 
                    </div> 
                <div class="input-field">
                        <input type="password" class="input" id="pass" required="">
                        <label for="pass">Contraseña</label>
                    </div> 
                <div class="recuperar">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                </div>
                <div class="input-field">
                        <input type="submit" class="submit" value="Ingresar">
                </div> 
                <div class="registrarse">
                    <span>¿Todavía no tenés cuenta? <a href="#">Registrate</a></span>
                </div>
                </div>  
            </div>
        </div>
    </div>
</div>
</body>
</html>
