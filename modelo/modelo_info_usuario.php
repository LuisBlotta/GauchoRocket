<?php
include_once("conexion.php");

function getInfoUsuario(){
    $nick=$_COOKIE['login'];
    $conn = getConexion();
    $sql = "SELECT nombre, fk_nivel, mail
            FROM usuario JOIN login ON usuario.fk_login = login.id_login
            WHERE nick = '$nick'";
    $result = mysqli_query($conn, $sql);
    $datos = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $datos['nombre'] =  $row["nombre"];
            $datos['nick'] =  $nick;
            $datos['mail'] =  $row["mail"];
            $datos['fk_nivel'] =  $row["fk_nivel"];
            if ($datos['fk_nivel']==null){
                $datos['fk_nivel']="Aún no posee nivel";
            }
        }
    }
    mysqli_close($conn);
    return $datos;
}

