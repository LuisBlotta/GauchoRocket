<?php
include("head.php");
include("header.php");
include("sesion.php");
include_once("conexion.php");

$cantidadPasajeros = $_GET['cantidadLugares'];
$id_vuelo = $_GET['id_vuelo'];
$nro_reserva = $_GET['nro_reserva'];


$i=0;
echo "<h2>Ingrese el nombre de los demás pasajeros</h2>";
for ($i=0; $i<$cantidadPasajeros; $i++){
    echo "  <form action='registro_usuarios_extra.php?cantidadPasajeros=$cantidadPasajeros&id_vuelo=$id_vuelo&nro_reserva=$nro_reserva' method='post' STYLE='width: 50%;'>
               
				<div class='form-group'>
                <label for='user_name'>Nick</label>
                <input class='form-control mr-sm-2' type='text' name='nick' placeholder='Nick' required>
                </div>
				
				<div class='form-group'>
					<label for='user_name'>Contraseña</label>
					<input class='form-control mr-sm-2' type='password' name='password' placeholder='Contraseña' required>
				</div>
                <div class='form-group'>
                    <label for='user_name'>Confirmar Contraseña</label>
                    <input class='form-control mr-sm-2' type='password' name='passwordConfirmada' placeholder='Contraseña' required>
                </div>
                                                
				<button class='btn btn-info'>Agregar</button>
			</form>			
    
  ";

    if(isset($_GET["falloPass"]) && $_GET["falloPass"] == 'true'){
        echo "<div style='color:red'>Las contraseñas no coinciden</div>";
    }
        };


?>