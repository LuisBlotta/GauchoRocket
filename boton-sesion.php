<?php	
	if (!empty($_SESSION['usuario'])){
		echo "<a type='button' class='btn btn-info' href= 'logout.php'>Cerrar Sesión</a>"; 		
	}else{	
		//----borrar si se hace con mail	
		if (isset($_GET["hash"])) {
			$hashConfirmacion = $_GET["hash"];
			echo "<a type='button' class='btn btn-info' href='login-form.php?hash=".$hashConfirmacion."'>Iniciar Sesión</a>";
		}else{	
		//------------------------------		
			echo "<a type='button' class='btn btn-info' href='login-form.php'>Iniciar Sesión</a>";
		}		
	}
?>