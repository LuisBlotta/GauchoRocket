<?php
	if (!empty($_SESSION['usuario'])){
		echo "<a type='button' class='btn btn-info btn-sesion' href= 'index.php?pag=logout'>Cerrar Sesión</a>";
	}else{	
		//----borrar si se hace con mail	
		if (isset($_GET["hash"])) {
			$hashConfirmacion = $_GET["hash"];
			echo "<a type='button' class='btn btn-info btn-sesion' href='index.php?pag=login-form&hash=".$hashConfirmacion."'>Iniciar Sesión</a>";
		}else{	
		//------------------------------		
			echo "<a type='button' class='btn btn-info btn-sesion' href='index.php?pag=login-form'>Iniciar Sesión</a>";
		}		
	}
?>