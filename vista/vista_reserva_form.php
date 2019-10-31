<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reserva de pasaje</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-form_reserva.css">
    <?php include("head.php");
    $id_vuelo=$_GET['id_vuelo'];
    $id_trayecto=$_GET['id_trayecto'];
    $id_destino = $_GET['id_destino'];
    $id_vuelo_trayecto = $_GET['id_vuelo_trayecto'];
    $id_origen = $_GET['id_origen'];


    if (empty($_SESSION['usuario'])) {
        header('location:index.php?pag=info_vuelo&id_vuelo='.$id_vuelo."&id_trayecto=".$id_trayecto);
    }
    ?>

</head>
<body>
<main>
    <section class="cont-form_reserva">
        <h3>Reserva de pasaje</h3>
        <?php echo"<form method='post' action='index.php?pag=reserva&id_vuelo=$id_vuelo&id_trayecto=$id_trayecto&id_destino=$id_destino&id_vuelo_trayecto=$id_vuelo_trayecto&id_origen=$id_origen'> "?>

        <div class="form-row">
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
        </div>

        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">


        <label for="mail">E-mail</label>
        <input type="text" class="form-control" name="mail" id="mail" placeholder="E-mail">

        <br>
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