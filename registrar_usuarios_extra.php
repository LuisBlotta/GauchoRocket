<?php
include("sesion.php");
include("head.php");
include("header.php");
include_once("conexion.php");

$cantidadPasajeros = $_GET['cantidadLugares'];
$id_vuelo = $_GET['id_vuelo'];
$nro_reserva = $_GET['nro_reserva'];

if (empty($_SESSION['usuario'])) {
    header('location:index.php');
}

if($cantidadPasajeros==0){
    header("location:centro-medico.php");
    exit();
}

$i=0;
echo "<link rel='stylesheet' type='text/css' href='public/css/estilos-usuarios_extra.css'>";
echo "<section class='cont-form_usuarios_extra'>
        <h2>Ingrese el nombre de los demás pasajeros</h2>
        <article class='form_usuarios_extra'>";
for ($i=0; $i<$cantidadPasajeros; $i++){    
    echo "    
            <form action='registro_usuarios_extra.php?cantidadPasajeros=$cantidadPasajeros&id_vuelo=$id_vuelo&nro_reserva=$nro_reserva' method='post'>               
				
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
include("footer.php");
?>