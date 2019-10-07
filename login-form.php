<?php
include("sesion.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Iniciar Sesión</title>
	<?php include("head.php")?>
</head>
<body>
	<main>
		<section>
			<form action="login.php" method="post">
				<div class="form-group">
					<label for="user_name">Nombre de Usuario</label>
					<input class="form-control mr-sm-2" type="text" name="user_name" placeholder="Usuario" value='<?php echo $a; ?>'>
				</div>	
			
				<div class="form-group">
					<label for="user_name">Contraseña</label>
					<input class="form-control mr-sm-2" type="password" name="password" placeholder="Contraseña">
				</div>
				<button class="btn btn-info">Entrar</button>
			</form>
			<p>¿No tienes cuenta?<a href="registro-form.php">Regístrate</a></p>
		</section>
	</main>

</body>
</html>