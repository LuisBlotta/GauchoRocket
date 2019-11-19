<?php
include_once("conexion.php");
function tieneNivel($nick){
    //$nick = $_COOKIE["login"];
    //$nick = $valor;
    $conn = getConexion();

    $buscarNivelUsuario = "SELECT usuario.fk_nivel nivel_pasajero FROM usuario
                            JOIN login ON usuario.fk_login = login.id_login
                            WHERE nick ='$nick'";
    $resultNivelUsuario = mysqli_query($conn, $buscarNivelUsuario);
    $datoUsuario=mysqli_fetch_row($resultNivelUsuario);

    if(!empty($datoUsuario[0])){
        $tiene_nivel=true;
    }else{
        $tiene_nivel=false;
    }
    return $tiene_nivel;
}
?>