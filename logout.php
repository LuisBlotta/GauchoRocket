<?php
	logout();
	function logout(){				
		session_start();
		unset($_SESSION['usuario']); 		
		session_destroy();
		header("location: index.php");
	}
?>