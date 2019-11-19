<?php
	if (!empty($_SESSION['usuario'])||!empty($_SESSION['admin'])){
		echo "<a type='button' class='btn btn-info btn-sesion' href= 'logout'>Cerrar Sesión</a>";
	}else{	
		//----borrar si se hace con mail	
		if (isset($_GET["hash"])) {
			$hashConfirmacion = $_GET["hash"];
			echo "<a type='button' class='btn btn-info btn-sesion' href='login_form?hash=".$hashConfirmacion."'>Iniciar Sesión</a>";
		}else{	
		//------------------------------		
			echo "<a type='button' class='btn btn-info btn-sesion' href='login_form'>Iniciar Sesión</a>";
		}		
	}
?>