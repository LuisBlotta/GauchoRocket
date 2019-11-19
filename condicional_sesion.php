<?php
	if (empty($_SESSION['usuario'])&&empty($_SESSION['admin'])||!isset($_COOKIE["login"])) {
    	header('location:gauchorocket');
	}
?>