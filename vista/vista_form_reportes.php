<html>
<head>
    <title>Form reportes</title>
    <?php include("head.php");
    include("charts/lib/inc/chartphp_dist.php");
    $p = new chartphp();
    $p->data = array(array(
        array('Familiar',$datosCabina[0]),
        array('General',$datosCabina[1]),
        array('Suite',$datosCabina[2])
    ));
    $p->chart_type = "donut";
    $out = $p->render("c1");
    ?>

    <link rel="stylesheet" href="charts/lib/js/chartphp.css">
    <script src="charts/lib/js/jquery.min.js"></script>
    <script src="charts/lib/js/chartphp.js"></script>
    <link rel="stylesheet" href="public/css/estilos-reportes.css">
</head>

<body>
<h1 class="titulo">Reportes</h1>

<section class="container card reportes">
    <h3>Facturación Mensual:</h3>
    <h4> $<?=  $facturacionMensual[0] ?></h4>

</section>
<br><br>


<section class="container card reportes">
    <h3>Facturación por cliente</h3>
<form action="facturacion_cliente" method="post">
    <label for="">Clientes:</label>
    <select name="cliente" class="custom-select mr-sm-2">
        <?php

        foreach ($clientes as $cliente){
            echo"<option value=".$cliente['id_login'].">".$cliente['nick']."</option> ";
        }
        ?>

    </select>

    <br><br><button type="submit" class="btn btn-info">Buscar</button>

</form>
</section>
<br><br>
<section class="container card reportes">
    <h3>Cabina más vendida:</h3>
    <h5> <?=  $cabinaMasVendida ?></h5>
</section>
<section>
    <?php echo "$out"; ?>
</section>

</body>
</html>