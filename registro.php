<?php
include("conexion.php");
include("head.php");
 registro();
 function registro(){
 	$usuario = $_POST["user_name"];
 	$email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirmada = $_POST["passwordConfirmada"];
 	$conn = getConexion();
	if ($password == $passwordConfirmada){

 	$buscarUsuario = "SELECT * FROM usuario
 	WHERE nombre = '$usuario' ";

 	$result = $conn->query($buscarUsuario);

 	$count = mysqli_num_rows($result);

 	if ($count == 1) {
 		echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";
 		echo "<a href='registro-form.php'>Por favor escoga otro Nombre</a>";
 	}else{
 		//$hash = clave_hash($form_pass, clave_BCRYPT);
 		$query = "INSERT INTO usuario (nombre, mail, password, rol)
 		VALUES ('$usuario','$email','$password',1)";
		//echo $query;
 		//	exit();
 			if ($conn->query($query) === TRUE) {
 				echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 				echo "<h4>" . "Bienvenido: " . $usuario . "</h4>" . "\n\n";
 				echo "<br><a type='button' class='btn btn-info' href='login-form.php'>Iniciar Sesión</a>"; 
 				setcookie("login", $usuario, time() + 1000);
 				session_start();
 				$_SESSION['usuario'] = true; 				
 			}else{

 				echo "Error al crear el usuario." . $query . "<br>" . $conn->error; 
 				//header('location:registro.php');
 			}
 	}
 	mysqli_close($conn);
	}
	else{
		header('location:registro-form.php?falloPass=true');
	}
 }
 


 
?>
