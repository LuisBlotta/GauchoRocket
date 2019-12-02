
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <?php //include("head.php")?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-login-registro.css">
</head>
<body>
<main>
    <section class="cont-form_login-registro col-sm-6">
        <h2 class="titulo">Iniciar Sesión</h2>
        <?php
        //----borrar si se hace con mail
        if (isset($_GET["hash"])) {
            $hashConfirmacion=$_GET["hash"];
            echo "<form action='login?hash=".$hashConfirmacion."' method='post'>";
        }else{
            //------------------------------
            echo "<form action='login' method='post'>";
        }
        ?>
        <div class="form-group">
            <label for="user_name">Nick</label>
            <input class="form-control mr-sm-2" type="text" name="user_name" placeholder="Nick" value='<?php echo $a; ?>'>
        </div>

        <div class="form-group">
            <label for="user_name">Contraseña</label>
            <input class="form-control mr-sm-2" type="password" name="password" placeholder="Contraseña">
        </div>
        <?php
        if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true'){
            echo "<div style='color:red'>Usuario o contraseña invalido </div>";
        }
        ?>

        <button class="btn btn-info">Entrar</button><br><br>
        </form>
        <p>¿No tienes cuenta?<a href="registro_form">Regístrate</a></p>
        <p><a href="gauchorocket">Volver al Inicio</a></p>
    </section>
</main>
</body>
</html>