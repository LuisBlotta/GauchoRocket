<html>
<head>
    <title>Facturación de Meses Anteriores</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-reportes.css">
</head>

<body>
    <main>
        <h1 class="titulo">Reportes</h1>
        <section class="container card reportes">
            <?php
                if(!isset($resultado[2])){
                    echo "<h3>Facturacion de ".$resultado[1]."</h3>";
                }else{
                    echo "<h3>Facturacion de ".$resultado[1]." a ".$resultado[2]."</h3>";
                }

                if (is_null($resultado[0])){
                    echo "<h5>No se facturó en el mes</h5>";
                }else{
                    echo "<h4> $".$resultado[0]."</h4>";
                }
            ?>
        </section>
    </main>
</body>
</html>