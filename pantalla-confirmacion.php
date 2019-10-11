<?php
include("head.php");
	$hashConfirmacion=$_GET["hash"];
	echo "Gracias por registrarte en GauchoRocket<br>";
	echo "Haz click aquí para confirmar<br>";
	echo "<a type='button' class='btn btn-info' href='confirmacion.php?hash=".$hashConfirmacion."'>Confirmar</a>";
?>	
