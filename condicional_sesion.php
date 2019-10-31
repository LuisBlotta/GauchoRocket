<?php
	if (empty($_SESSION['usuario'])) {
    	header('location:index.php');
	}
?>