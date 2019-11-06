<?php
include("conexion.php");
include("head.php");
registro();
function registro(){
    $userConfirmado = false;
    $hoy = getdate();
    $hashConfirmacion =hash('ripemd160', $hoy['seconds'].$hoy['minutes'].$hoy['hours']);
    $nombre = $_POST["nombre"];
    $nick = $_POST["nick"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $passwordConfirmada = md5($_POST["passwordConfirmada"]);
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
            //Inserto datos en la tabla login
            $query = "INSERT INTO login (userConfirmado, hashConfirmacion, nick, password)
 			VALUES ('$userConfirmado','$hashConfirmacion','$nick','$password')";
            //echo $query;
            //	exit();
            if ($conn->query($query) === TRUE) {
                //traigo el ID del usuario creado
                $queryConsulta ="SELECT id_login FROM login WHERE nick='$nick'";

                $result = mysqli_query($conn, $queryConsulta);
                $dato=mysqli_fetch_row($result);
                //echo $dato[0];
                //exit();

                //Segunda parte del guardado (en tabla usuario)
                $sqlGuardado = "insert into usuario (nombre, mail, rol, fk_login) values ('$nombre','$email',1,'$dato[0]' )";
                $result = mysqli_query($conn, $sqlGuardado);

                echo "<h2>" . "Bienvenido: " . $nombre . "</h2>" . "\n\n";
                echo "<p>Por favor revisa tu correo para confirmar el registro</p>";
                //----borrar si se hace con mail
                echo "<br><a type='button' class='btn btn-info' href='gauchorocket?hash=".$hashConfirmacion."'>Volver al inicio</a>";
                echo "<br><br><a type='button' class='btn btn-info' href='pantalla-confirmacion?hash=".$hashConfirmacion."'>Confirmar</a>";
                //------------------------------
                //echo "<br><a type='button' class='btn btn-info' href='index.php'>Volver al inicio</a>";
                setcookie("login", $nick, time() + 1000); // recuerda el nick en el login

                /*
                //Crea el mail de confirmacion

               // datos de email
               $para=$email;
               $asunto= "Confirmacion de cuenta";
               $cuerpo='';

               // cuerpo de email
               $cuerpo.="Gracias ".$nombre." por registrarte en GauchoRocket\n";
               $cuerpo.="Haz click aqui para confirmar\n";
               $cuerpo.="http://localhost/htdocs-progra-2/GauchoRocket/confirmacion.php?hash=".$hashConfirmacion."\n";

               mail($para, $asunto, $cuerpo);
               */
            }else{
                echo "Error al crear el usuario." . $query . "<br>" . $conn->error;
                //header('location:registro.php');
            }
        }
        mysqli_close($conn);
    }
    else{
        header('location:registro-form?falloPass=true');
    }
}



