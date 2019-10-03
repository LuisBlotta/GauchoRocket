<?php
$a="";
    if (isset($_COOKIE["login"])) {
     $a = $_COOKIE["login"];
    }
include("conexion.php");
    login();
    function login(){
        $usuario = $_POST["user_name"];
        $password = $_POST["password"];
        $conn = getConexion();

        $query = "SELECT nombre, password FROM usuario WHERE nombre ='$usuario' AND password ='$password'";
		/*echo $query;
		exit();*/
        $resultado = mysqli_query($conn, $query);
        /*echo $query;
       exit();*/
        if (mysqli_num_rows($resultado)>0) {
            setcookie("login", $usuario, time() + 1000);
            session_start();
            $_SESSION['usuario'] = true;
            header('location:prueba.php');

                // header('location:ppal.php');
        } else {
            //header('location:login.php');
            echo("Ingrese usuario y clave");
            exit();
        }
}
?>
