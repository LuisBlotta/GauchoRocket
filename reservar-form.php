<?php 
    include("sesion.php");    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reserva de pasaje</title>
    <?php include("head.php");
        $id_vuelo=$_GET['id_vuelo'];
       
        if (empty($_SESSION['usuario'])) {
            header('location:info_vuelo.php?id_vuelo='.$id_vuelo);
        }
    ?>

</head>
<?php include("header.php") ?>
<body>
    <main>
        <h3>Reserva de pasaje</h3>
        <section class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
                <?php echo"<form method='post' action='modelo-reserva.php?id_vuelo=$id_vuelo'> "?>
                    <label for="pasajeros">Cantidad de pasajeros</label>
                    <input type="number" class="form-control mr-sm-4" name="cant_pasajeros" id="cant_pasajeros" required placeholder="N° de pasajeros" style="width: 10%; margin-bottom: 10px;" value="1">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="mail">E-mail</label>
                                <input type="text" class="form-control" name="mail" id="mail" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cabina">Cabina</label>
                            <select name="cabina" class="custom-select mr-sm-2">
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
    <?php include("footer.php") ?>
</body>
</html>