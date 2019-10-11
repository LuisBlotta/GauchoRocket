<?php  

$cuerpo='';
$nombre=$_POST['nombre'];
$email=$_POST['email'];

// configuramos datos de email

$para=$email;
$asunto= "Confirmacion de cuenta";

// cuerpo de email
$cuerpo.="Gracias ".$nombre." por registrarte en GauchoRocket";
$cuerpo.="Haz click aquí para confirmar";

mail($para, $asunto, $cuerpo);

?>