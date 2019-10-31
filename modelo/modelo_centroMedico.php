<?php
include_once("conexion.php");

function getCentroMedico(){

    $conn = getConexion();

    $sql= "SELECT id_medico, nombre, direccion, turnos FROM medico;";

    $result = mysqli_query($conn, $sql);

    $medicos = Array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $medico = Array();
            $medico['id_medico'] =  $row["id_medico"];
            $medico['nombre'] = $row["nombre"];
            $medico['direccion'] = $row["direccion"];
            $medico['turnos'] =  $row["turnos"];
            $medicos[] = $medico;
        }
    }
    mysqli_close($conn);
    return $medicos;
}



