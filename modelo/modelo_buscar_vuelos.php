<?php
include_once("conexion.php");

function getVuelos()
{
    $conn = getConexion();

    $fecha_ida = $_POST['fecha_ida'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];


    $fechaSinGuiones = str_replace("-", "", $fecha_ida);


    $sql = "SELECT vuelo_trayecto.id_vuelo_trayecto id_vuelo_trayecto ,vuelo_trayecto.fk_vuelo id_vuelo,  vuelo_trayecto.fk_trayecto id_trayecto, vuelo.dia_partida fecha_ida, d1.descripcion origen, d1.id_destino id_origen, d0.descripcion destino, d0.id_destino id_destino,tipo_viaje.descripcion tipo_viaje, tipo_vuelo.descripcion tipo_vuelo 
            FROM  vuelo_trayecto JOIN vuelo on  vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
            JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
            JOIN equipo on vuelo.fk_equipo = equipo.id_equipo
            JOIN modelo on equipo.fk_modelo = modelo.id_modelo
            JOIN tipo_vuelo on modelo.fk_tipo_vuelo = tipo_vuelo.id_tipo_vuelo";

    if (!empty($fecha_ida)) {
        $sql .= " WHERE vuelo.dia_partida='$fecha_ida'";

        if (!empty($origen)) {
            $sql .= " AND d1.id_destino='$origen'";

            if (!empty($destino)) {
                $sql .= " AND d0.id_destino='$destino';";
            }
        }
    } elseif (!empty($origen)) {
        $sql .= " WHERE d1.id_destino='$origen'";

        if (!empty($destino)) {
            $sql .= " AND d0.id_destino='$destino';";
        }
    } elseif (!empty($destino)) {
        $sql .= " WHERE d0.id_destino='$destino'";
    }


    $result = mysqli_query($conn, $sql);

    $vuelos = Array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $vuelo = Array();
            $vuelo['id_vuelo_trayecto'] = $row["id_vuelo_trayecto"];
            $vuelo['id_destino'] = $row["id_destino"];
            $vuelo['id_trayecto'] = $row["id_trayecto"];
            $vuelo['id_vuelo'] = $row["id_vuelo"];
            $vuelo['fecha_ida'] = $row["fecha_ida"];
            $vuelo['id_origen'] = $row["id_origen"];
            $vuelo['origen'] = $row["origen"];
            $vuelo['destino'] = $row["destino"];
            $vuelo['tipo_viaje'] = $row["tipo_viaje"];
            $vuelo['tipo_vuelo'] = $row["tipo_vuelo"];
            $vuelos[] = $vuelo;
        }


    } else {
        echo "<h2 class='error-busqueda col-sm-12' >Vuelo no encontrado</h2>";


        $sql = "SELECT vuelo_trayecto.id_vuelo_trayecto id_vuelo_trayecto ,vuelo_trayecto.fk_vuelo id_vuelo,  vuelo_trayecto.fk_trayecto id_trayecto, vuelo.dia_partida fecha_ida, d1.descripcion origen, d1.id_destino id_origen, d0.descripcion destino, d0.id_destino id_destino,tipo_viaje.descripcion tipo_viaje, tipo_vuelo.descripcion tipo_vuelo 
            FROM  vuelo_trayecto JOIN vuelo on  vuelo_trayecto.fk_vuelo = vuelo.id_vuelo
            JOIN trayecto ON vuelo_trayecto.fk_trayecto = trayecto.id_trayecto 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje
            JOIN equipo on vuelo.fk_equipo = equipo.id_equipo
            JOIN modelo on equipo.fk_modelo = modelo.id_modelo
            JOIN tipo_vuelo on modelo.fk_tipo_vuelo = tipo_vuelo.id_tipo_vuelo";

        $result = mysqli_query($conn, $sql);

        $vuelos = Array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $vuelo = Array();
                $vuelo['id_vuelo_trayecto'] = $row["id_vuelo_trayecto"];
                $vuelo['id_destino'] = $row["id_destino"];
                $vuelo['id_trayecto'] = $row["id_trayecto"];
                $vuelo['id_vuelo'] = $row["id_vuelo"];
                $vuelo['fecha_ida'] = $row["fecha_ida"];
                $vuelo['id_origen'] = $row["id_origen"];
                $vuelo['origen'] = $row["origen"];
                $vuelo['destino'] = $row["destino"];
                $vuelo['tipo_viaje'] = $row["tipo_viaje"];
                $vuelo['tipo_vuelo'] = $row["tipo_vuelo"];
                $vuelos[] = $vuelo;
            }

        }
        mysqli_close($conn);

    } return $vuelos;
}