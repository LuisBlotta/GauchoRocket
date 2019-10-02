<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
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
					<label for="user_name">Email</label>
					<input class="form-control mr-sm-2" type="email" name="email" placeholder="email@example.com">
				</div>
				<div class="form-group">
					<label for="user_name">Contraseña</label>
					<input class="form-control mr-sm-2" type="password" name="pass" placeholder="Contraseña">
				</div>
				<button class="btn btn-info">Registrarse</button>
			</form>			
		</section>
	</main>

</body>
</html>