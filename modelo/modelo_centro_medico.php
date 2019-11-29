<?php

use FontLib\Table\Type\head;

include_once("conexion.php");
/* muestra los centros medicos*/

confirmarSiNecesitanTurno();
function confirmarSiNecesitanTurno(){

    /*Ver si tiene nivel de vuelo*/  /*Ver si tiene nivel de vuelo*/
    $conn = getConexion();
    $nro_reserva = $_GET['nro_reserva'];

            $queryConsultalogins ="SELECT reserva.fk_login fk_login FROM reserva JOIN login on reserva.fk_login = login.id_login
            JOIN usuario on usuario.fk_login = login.id_login
            WHERE nro_reserva=$nro_reserva AND usuario.fk_nivel IS NULL";


           
         $resultlogin = mysqli_query($conn, $queryConsultalogins);
         if(mysqli_num_rows($resultlogin)==0){
             header('location: gauchorocket');
         }
}

function getCentroMedico(){




    $conn = getConexion();

    $sql= "SELECT id_medico, nombre, direccion FROM medico;";

    $result = mysqli_query($conn, $sql);

    $medicos = Array();

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $medico = Array();
            $medico['id_medico'] =  $row["id_medico"];
            $medico['nombre'] = $row["nombre"];
            $medico['direccion'] = $row["direccion"];
            $medicos[] = $medico;
        }
    }
    mysqli_close($conn);
    return $medicos;
}



