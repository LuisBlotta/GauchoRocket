<?php	
	if (!empty($_SESSION['usuario'])){
		echo "<a type='button' class='btn btn-info' href= 'logout.php'>Cerrar Sesión</a>"; 		
	}else{
		echo "<a type='button' class='btn btn-info' href='login-form.php'>Iniciar Sesión</a>";
	}
?>