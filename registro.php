<?php
include("conexion.php");
include("head.php");
 registro();
 function registro(){
 	$nombre = $_POST["nombre"];
 	$nick = $_POST["nick"];
 	$email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirmada = $_POST["passwordConfirmada"];
 	$conn = getConexion();

 	//Confirma igualdad de passwords
	if ($password == $passwordConfirmada){

		//Confirma que no hayan usuarios con el mismo nombre
 	$buscarUsuario = "SELECT * FROM login
 	WHERE nick = '$nick' ";
 	$result = $conn->query($buscarUsuario);
 	$count = mysqli_num_rows($result);

 	if ($count == 1) {
 		echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";
 		echo "<a href='registro-form.php'>Por favor escoga otro Nombre</a>";
 	}else{
 		//$hash = clave_hash($form_pass, clave_BCRYPT);
		//Inserto datos en la tabla login
 		$query = "INSERT INTO login (nick, password)
 		VALUES ('$nick','$password')";
		//echo $query;
 		//	exit();
 			if ($conn->query($query) === TRUE) {
				//traigo el ID del usuario creado
				$queryConsulta ="select id from login where nick='$nick';";

				$result = mysqli_query($conn, $queryConsulta);
				$dato=mysqli_fetch_row($result);
				//echo $dato[0];
				//exit();

				//Segunda parte del guardado (en tabla usuario)
				$sqlGuardado = "insert into usuario (nombre, mail, rol, login) values ('$nombre','$email',1,'$dato[0]' )";
				$result = mysqli_query($conn, $sqlGuardado);


				echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 				echo "<h4>" . "Bienvenido: " . $nombre . "</h4>" . "\n\n";
 				echo "<br><a type='button' class='btn btn-info' href='login-form.php'>Iniciar Sesión</a>"; 
 				setcookie("login", $nombre, time() + 1000);
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
