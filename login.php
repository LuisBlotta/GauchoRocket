<?php
include("sesion.php");
include("conexion.php");
    login();
    function login(){
        $nick = $_POST["user_name"];
        $password = md5($_POST["password"]);
        $conn = getConexion();

        $query = "SELECT nick, password FROM login 
                    WHERE nick ='$nick' AND password ='$password'";
		//echo $query;
		//exit();
        $resultado = mysqli_query($conn, $query);
        //echo $query;
        //exit();
        if (mysqli_num_rows($resultado)>0) {
            setcookie("login", $nick, time() + 1000);
            session_start();
            $_SESSION['usuario'] = true;            
            header('location:index.php');             
        } else {
            header('location:login-form.php?fallo=true');
        }
}
?>
