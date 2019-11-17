<?php
include_once("conexion.php");

//tieneNivel();
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

function validarNivel(){
    $id_vuelo=$_GET['id_vuelo'];
    $nick = $_COOKIE["login"];
    $conn = getConexion();
    $tiene_nivel=tieneNivel($nick);

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

    if($tiene_nivel==true){
        $numeros= array();
        foreach ($datoVuelo as $vuelo){
            $numeros[] = $vuelo;
        }
        if (in_array($datoUsuario[0], $numeros)){
            $resultado=1; //Tiene el nivel necesario
        }else{
            $resultado=0; //No tiene el nivel necesario
        }
    }else{
        $resultado=2; //No tiene nivel
    }
    return $resultado;
}

