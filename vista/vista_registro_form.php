<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-login-registro.css">
</head>
<body>
<main>
    <section class="cont-form_login-registro col-sm-6">
        <h2 class="titulo">Registrarse</h2>
        <form action="registro" method="post">
            <div class="form-group">
                <label for="user_name">Nombre</label>
                <input class="form-control mr-sm-2" type="text" name="nombre" placeholder="Nombre" required>
            </div>
            <div class="form-group">
                <label for="user_name">Nick</label>
                <input class="form-control mr-sm-2" type="text" name="nick" placeholder="Nick" required>
                <?php
                if(isset($_GET["falloNick"]) && $_GET["falloNick"] == 'true'){
                    echo "<p style='color:red'>El Nick ya a sido tomado, por favor escoja otro</p>";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="user_name">Email</label>
                <input class="form-control mr-sm-2" type="email" name="email" placeholder="email@example.com" required>
            </div>
            <div class="form-group">
                <label for="user_name">Contraseña</label>
                <input class="form-control mr-sm-2" type="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <label for="user_name">Confirmar Contraseña</label>
                <input class="form-control mr-sm-2" type="password" name="passwordConfirmada" placeholder="Contraseña" required>
            </div>

            <?php
            if(isset($_GET["falloPass"]) && $_GET["falloPass"] == 'true'){
                echo "<p style='color:red'>Las contraseñas no coinciden</p>";
            }
            ?>
            <button class="btn btn-info">Registrarse</button><br><br>
            <p><a href="gauchorocket">Volver al Inicio</a></p>
        </form>
    </section>

</main>
</body>
</html>