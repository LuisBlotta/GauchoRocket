<?php
include_once("conexion.php");

asignar_nivel_pasajero();
function asignar_nivel_pasajero(){
    $fecha_actual=getFechaConGuiones();
    $conn=getConexion();

    $sql="SELECT login.id_login id_login, login.nick nick FROM turno 
          JOIN login ON turno.fk_login = login.id_login
          WHERE fecha='$fecha_actual'";

    $result= mysqli_query($conn, $sql);

    $usuarios = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $usuario = Array();
            $usuario['id_login'] =  $row["id_login"];
            $usuario['nick'] =  $row["nick"];
            $usuarios[] = $usuario;
        }
    }

    foreach ($usuarios as $usuario){
        $id_login=$usuario['id_login'];
        $nick = $usuario['nick'];

        $tiene_nivel=tieneNivel($nick);
        if ($tiene_nivel==false){
            $nivel_pasajero=mt_rand(1,3);

            $asigna_nivel="UPDATE usuario SET fk_nivel=$nivel_pasajero WHERE fk_login=$id_login";
            $resultNivel= mysqli_query($conn, $asigna_nivel);
        }
    }

    mysqli_close($conn);
}
