<?php
include("head.php");
include("conexion.php");
login();
function login(){

    $nick = $_POST["user_name"];
    $password = md5($_POST["password"]);
    $conn = getConexion();
    $file = fopen("historial.txt", "a");

    $query = "SELECT nick, password FROM login 
                    WHERE nick ='$nick' AND password ='$password'";
    $resultado = mysqli_query($conn, $query);

    //Revisa si el usuario está confirmado------------------------
    $query2 = "SELECT userConfirmado FROM login 
                    WHERE nick ='$nick' AND password ='$password'";
    $resultado2 = mysqli_query($conn, $query2);
    $userConfirmado = mysqli_fetch_array($resultado2, MYSQLI_ASSOC);

    if (isset($userConfirmado["userConfirmado"])&& $userConfirmado["userConfirmado"]==false) {
        echo "<p>Para ingresar necesitas confirmar el registro</p>";
        echo "<p>Revisa tu correo y hazlo!</p>";
        //----borrar si se hace con mail
        if (isset($_GET["hash"])) {
            $hashConfirmacion=$_GET["hash"];
            echo "<br><a type='button' class='btn btn-info' href='index.php?hash=".$hashConfirmacion."'>Volver al inicio</a>";
        }else{
            //------------------------------
            echo "<br><a type='button' class='btn btn-info' href='index.php'>Volver al inicio</a>";
        }
        echo "<br><br><a type='button' class='btn btn-info' href='index.php?pag=pantalla-confirmacion&hash=".$hashConfirmacion."'>Confirmar</a>";
        die();
    }
    //-------------------------------------------------------------
    if (mysqli_num_rows($resultado)>0) {
        setcookie("login", $nick, time() + 1000);
        session_start();
        $_SESSION['usuario'] = true;
        header('location:index.php');
        fwrite($file, "El usuario $nick ingresó correctamente". PHP_EOL );
        fclose($file);
    } else {
        header('location:index.php?pag=login-form&fallo=true');
        fwrite($file, "El usuario $nick quiso ingresar y no pudo ". PHP_EOL );
        fclose($file);
    }
}