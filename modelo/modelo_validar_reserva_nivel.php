<?php
include_once("conexion.php");

validarReservaNivel();
function validarReservaNivel(){
    $conn=getConexion();

    $sqlTraeDatos="SELECT reserva.nro_reserva nro_reserva, vuelo.id_vuelo id_vuelo, login.nick nick FROM login 
                   JOIN reserva ON reserva.fk_login = login.id_login
                   JOIN vuelo_trayecto ON reserva.fk_id_vuelo_trayecto = vuelo_trayecto.id_vuelo_trayecto
                   JOIN vuelo ON vuelo_trayecto.fk_vuelo = vuelo.id_vuelo";
    $resultTraeDatos = mysqli_query($conn, $sqlTraeDatos);

    $datos = Array();
    if (mysqli_num_rows($resultTraeDatos) > 0) {
        while($row = mysqli_fetch_assoc($resultTraeDatos)) {
            $dato = Array();
            $dato['id_vuelo'] =  $row["id_vuelo"];
            $dato['nick'] =  $row["nick"];
            $dato['nro_reserva'] =  $row["nro_reserva"];
            $datos[] = $dato;
        }
    }

    foreach ($datos as $dato){
        $validacion_nivel=validarNivel($dato['id_vuelo'], $dato['nick']);
        if ($validacion_nivel==0){
            return $html='<div class="toast" data-autohide="false" style="position: fixed; bottom: 50px; left: 20px; z-index: 20">
                            <div class="toast-header">
                              <strong class="mr-auto text-danger">Aviso</strong>                             
                              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                            </div>
                            <div class="toast-body">
                              Su vuelo ha sido cancelado<br>debido a que ustedo sus acompañantes<br>no tienen el nivel requerido.
                            </div>
                          </div>
                        </div>
                        
                        <script>
                        $(document).ready(function(){
                          $(".toast").toast("show");
                        });
                        </script>';
            cancelar_vuelo($dato['nro_reserva']);
        }
    }
}