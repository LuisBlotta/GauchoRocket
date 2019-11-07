<?php
	if (empty($_SESSION['usuario'])||!isset($_COOKIE["login"])) {
    	header('location:gauchorocket');
	}
?>