<?php
include_once("conexion.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reserva de pasaje</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-form_reserva.css">
    <?php
        $id_vuelo=$_GET['id_vuelo'];
        $id_trayecto=$_GET['id_trayecto'];
        $id_destino = $_GET['id_destino'];
        $id_vuelo_trayecto = $_GET['id_vuelo_trayecto'];
        $id_origen = $_GET['id_origen'];
        $fecha_ida= $_GET['fecha_ida'];

        if (empty($_SESSION['usuario'])) {
            header('location:info_vuelo?id_vuelo='.$id_vuelo."&id_trayecto=".$id_trayecto);
        }
        if($resultado==0){
            header('location:info_vuelo?id_vuelo='.$id_vuelo."&id_trayecto=".$id_trayecto."&fallo_nivel=1");
        }
    ?>

</head>
<body>
<main>
    <section class="cont-form_reserva">
        <h3>Reserva de pasaje</h3>
        <?php echo"<form method='post' action='reserva?id_vuelo=$id_vuelo&id_trayecto=$id_trayecto&id_destino=$id_destino&id_vuelo_trayecto=$id_vuelo_trayecto&id_origen=$id_origen&fecha_ida=$fecha_ida'> "?>
            <div class="form-group">
                <label for="pasajeros">Cantidad de pasajeros</label>
                <input type="number" class="form-control" name="cant_pasajeros" id="cant_pasajeros" required placeholder="N° de pasajeros" value="1">
            </div>
            <div class="form-group">
                <label for="cabina">Cabina</label>
                <select name="cabina" class="custom-select">
                    <option value="F">Familiar</option>
                    <option value="G">General</option>
                    <option value="S">Suite</option>
                </select>
            </div>
        <button class="btn btn-info">Reservar</button>
        </form>
    </section>
    <?php
    if(isset($_GET["falloLugares"]) && $_GET["falloLugares"] == 'true'){
        echo "<div style='color:red'>No hay lugares suficientes</div>";
    }
    ?>

</main>

</body>
</html>