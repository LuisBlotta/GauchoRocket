<?php include("sesion.php");?>
<!DOCTYPE html>
<html>
<head>
    <title>Reserva de pasaje</title>
    <?php include("head.php");
    $id_vuelo=$_GET['id_vuelo'];
   ?>

</head>
<?php include("header.php") ?>
<body>
    <main>
        <h3>Reserva de pasaje</h3>
        <section class="wrapper" style="margin-top: 20px; margin-bottom: 20px;">
                <?php echo"<form method='post' action='modelo-reserva.php?id_vuelo=$id_vuelo'> "?>
                    <label for="pasajeros">Cantidad de pasajeros</label>
                    <input type="text" class="form-control mr-sm-4" name="cant_pasajeros" id="cant_pasajeros" required placeholder="N° de pasajeros" style="width: 10%; margin-bottom: 10px;">
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
                            <input type="text" class="form-control" name="cabina" id="cabina" placeholder="Cabina">
                        </div>

                   <button class="btn btn-info">Reservar</button>
                </form>
        </section>


    </main>
    <?php include("footer.php") ?>
</body>
</html>