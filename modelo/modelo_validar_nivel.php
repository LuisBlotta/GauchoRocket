<?php
include_once("conexion.php");

function validarNivel(){
    $id_vuelo=$_GET['id_vuelo'];
    $nick = $_COOKIE["login"];
    $conn = getConexion();

    $buscarNivelUsuario = "SELECT usuario.fk_nivel nivel_pasajero FROM usuario
                            JOIN login ON usuario.fk_login = login.id_login
                            WHERE nick ='$nick'";
    $resultNivelUsuario = mysqli_query($conn, $buscarNivelUsuario);
    $datoUsuario=mysqli_fetch_row($resultNivelUsuario);

    $buscarNivelVuelo = "SELECT nivel_modelo.fk_nivel FROM nivel_modelo
                            JOIN modelo ON nivel_modelo.fk_modelo = modelo.id_modelo
                            JOIN equipo ON equipo.fk_modelo = modelo.id_modelo
                            JOIN vuelo ON vuelo.fk_equipo = equipo.id_equipo
                            WHERE vuelo.id_vuelo ='$id_vuelo'";
    $resultNivelVuelo = mysqli_query($conn, $buscarNivelVuelo);
    $datoVuelo=mysqli_fetch_row($resultNivelVuelo);

    if(!empty($datoUsuario[0])){
        $i=0;
        while ($i<count($datoVuelo)){
            if (in_array($datoUsuario[0], $datoVuelo[$i])){
                $resultado=1;
            }else{
                $resultado=0;
            }
            $i++;
        }
    }else{
        $resultado=2;
    }

    return $resultado;

}
