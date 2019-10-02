<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesión</title>
	<?php include("head.php")?>
</head>
<body>
	<main>
		<section>
			<form action="#" method="post">
				<div class="form-group">
					<label for="user_name">Nombre de Usuario</label>
					<input class="form-control mr-sm-2" type="text" name="user_name" placeholder="Usuario">
				</div>
				<div class="form-group">
					<label for="user_name">Contraseña</label>
					<input class="form-control mr-sm-2" type="password" name="pass" placeholder="Contraseña">
				</div>
				<button class="btn btn-info">Entrar</button>
			</form>
			<p>Aún no tienes cuenta?<a href="registro.php">Regístrate</a></p>
		</section>
	</main>

</body>
</html>