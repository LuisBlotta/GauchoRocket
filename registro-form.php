<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<?php include("head.php")?>
</head>
<body>
	<main>
		<section>
			<form action="registro.php" method="post">
				<div class="form-group">
					<label for="user_name">Nombre de Usuario</label>
					<input class="form-control mr-sm-2" type="text" name="user_name" placeholder="Usuario" required>
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
                    echo "<div style='color:red'>Las contraseñas no coinciden</div>";
                }
                ?>
				<button class="btn btn-info">Registrarse</button>
			</form>			
		</section>
		<p><a href="index.php">Volver al Inicio</a></p>
	</main>
</body>
</html>