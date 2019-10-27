<?php 
    include("sesion.php");
    if (empty($_SESSION['usuario'])) {
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reserva Centro Médico</title>
    <?php include("head.php") ?>
</head>
<body>
    <?php include("header.php") ?>
    <main>
        <?php
        include("mostrar-medico.php");
        foreach ($medicos as $medico) {
            echo "
            <div class='card-body'>
				<h2>" . $medico['nombre'] . "</h2>	
				<h4>" . $medico['direccion'] . "</h4>														
			</div>";
        }
        ?>
        <form action="#" method="post">
            <input type="text" name="nombre" required placeholder="Nombre">
            <input type="text" name="email" required placeholder="E-mail">
            <input type="date" name="fecha_turno">
        </form>
    </main>
</body>
</html>