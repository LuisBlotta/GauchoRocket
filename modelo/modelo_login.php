<?php
include("head.php");
include("conexion.php");
login();
function login(){

    $nick = $_POST["user_name"];
    $password = md5($_POST["password"]);
    $conn = getConexion();
    $file = fopen("historial.txt", "a");

    /*$query = "SELECT nick, password FROM login
                    WHERE nick ='$nick' AND password ='$password'";
    $resultado = mysqli_query($conn, $query);*/


    $sqlRol="SELECT rol FROM usuario JOIN login ON usuario.fk_login = login.id_login WHERE login.nick = '$nick'";
    $resultadoRol= mysqli_query($conn,$sqlRol);
    $rol = mysqli_fetch_assoc($resultadoRol);


    if ($stmt = mysqli_prepare($conn, "SELECT nick, password FROM login WHERE nick = ? and password = ?")) {

        /* ligar parámetros para marcadores */
        mysqli_stmt_bind_param($stmt, "ss", $nick, $password);

        /* ejecutar la consulta */
        mysqli_stmt_execute($stmt);
        /* obtener valor */


        if($resulta=mysqli_stmt_fetch($stmt)) {


            setcookie("login", $nick, time() + 10000);
            if ( $rol['rol']==1){
                session_start();
                $_SESSION['usuario'] = true;
            }elseif ($rol['rol']){
                session_start();
                $_SESSION['admin'] = true;
            }


            fwrite($file, "El usuario $nick ingresó correctamente". PHP_EOL );
            fclose($file);


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
                    echo "<br><a type='button' class='btn btn-info' href='gauchorocket?hash=".$hashConfirmacion."'>Volver al inicio</a>";
                }else{
                    //------------------------------
                    echo "<br><a type='button' class='btn btn-info' href='gauchorocket'>Volver al inicio</a>";
                }
                echo "<br><br><a type='button' class='btn btn-info' href='pantalla_confirmacion?hash=".$hashConfirmacion."'>Confirmar</a>";
                die();
            }
            else{
                header('location:gauchorocket');

            }

        } else {

            header('location:login_form?fallo=true');
            fwrite($file, "El usuario $nick intentó ingresar y no pudo ". PHP_EOL );
            fclose($file);
        };

        /* cerrar sentencia */
        mysqli_stmt_close($stmt);
    }


    //-------------------------------------------------------------

}