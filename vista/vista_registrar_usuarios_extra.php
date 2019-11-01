<?php
include("head.php");
include_once("conexion.php");
include("condicional_sesion.php");
$cantidadPasajeros = $_GET['cantidadPasajeros'];
$id_vuelo = $_GET['id_vuelo'];
$nro_reserva = $_GET['nro_reserva'];
$id_destino = $_GET['id_destino'];
$id_vuelo_trayecto = $_GET['id_vuelo_trayecto'];

if($cantidadPasajeros==0){
    header("location:index.php?pag=centro-medico");
    exit();
}

$i=0;
echo "<link rel='stylesheet' type='text/css' href='public/css/estilos-usuarios_extra.css'>";
echo "<section class='cont-form_usuarios_extra'>
        <h2>Ingrese el nombre de los demás pasajeros</h2>
        <p>Pasajeros restantes $cantidadPasajeros</p>
        <article class='form_usuarios_extra'>";
if ($cantidadPasajeros > 0){
    echo "    
            <form action='index.php?pag=registro_usuarios_extra&cantidadPasajeros=$cantidadPasajeros&id_vuelo=$id_vuelo&nro_reserva=$nro_reserva&id_destino=$id_destino&id_vuelo_trayecto=$id_vuelo_trayecto' method='post'>               
				
                <label for='user_name'>Nick</label>
                <input class='form-control mr-sm-2' type='text' name='nick' placeholder='Nick' required>
               
				<label for='mail'>E-mail</label>
				<input class='form-control mr-sm-2' type='text' name='mail' placeholder='E-mail' required>		
				
				<label for='user_name'>Contraseña</label>
				<input class='form-control mr-sm-2' type='password' name='password' placeholder='Contraseña' required>				
                
                <label for='user_name'>Confirmar Contraseña</label>
                <input class='form-control mr-sm-2' type='password' name='passwordConfirmada' placeholder='Contraseña' required>                
                <br>                                
				<button class='btn btn-info'>Agregar</button>
            </form>";

    if(isset($_GET["falloPass"]) && $_GET["falloPass"] == 'true'){
        echo "<div style='color:red'>Las contraseñas no coinciden</div>";
    }
};
echo "  </article>
    </section>";
?>