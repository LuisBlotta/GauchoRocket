<?php
include("conexion.php");

function getVuelos(){
    $conn = getConexion();    

    $fecha_ida=$_POST['fecha_ida'];
    $origen=$_POST['origen'];
    $destino=$_POST['destino'];

    

    $fechaSinGuiones=str_replace("-", "", $fecha_ida);

   

    $sql="SELECT vuelo.dia_partida fecha_ida, d1.descripcion origen, d0.descripcion destino, tipo_viaje.descripcion tipo_viaje FROM vuelo JOIN trayecto ON vuelo.fk_trayecto = trayecto.id_trayecto 
            JOIN destino d0 on trayecto.fk_punto_llegada = d0.id_destino
            JOIN destino d1 on trayecto.fk_punto_partida = d1.id_destino
            JOIN tipo_viaje on vuelo.fk_tipo_viaje = tipo_viaje.id_tipo_viaje";

            if (!empty($fecha_ida)) {                
                $sql.=" WHERE vuelo.dia_partida='$fecha_ida'";

                if (!empty($origen)){
                     $sql.=" AND d1.id_destino='$origen'";

                      if (!empty($destino)){
                     $sql.=" AND d0.id_destino='$destino';";
                    }
                }
            }
            elseif (!empty($origen)) {
                $sql.=" WHERE d1.id_destino='$origen'";

                 if (!empty($destino)){
                     $sql.=" AND d0.id_destino='$destino';";
                    }
            }
            elseif (!empty($destino)) {
                     $sql.=" WHERE d1.id_destino='$destino'";
            }
           
         
            
    $result = mysqli_query($conn, $sql);

    $vuelos = Array();
    if (mysqli_num_rows($result) > 0) {        
        while($row = mysqli_fetch_assoc($result)) {
            $vuelo = Array();
            $vuelo['fecha_ida'] =  $row["fecha_ida"];
            $vuelo['origen'] =  $row["origen"];
            $vuelo['destino'] =  $row["destino"];
            $vuelo['tipo_viaje'] =  $row["tipo_viaje"];
            $vuelos[] = $vuelo;            
        }
    }else{           
        echo "<h2 class='error-busqueda col-sm-12' >Vuelo no encontrado</h2>";
        
    }
    mysqli_close($conn);
    return $vuelos;   
}
$vuelos = getVuelos();
?>