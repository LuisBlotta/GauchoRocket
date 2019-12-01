<html>
<head>
    <title>Facturación de Meses Anteriores</title>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-facturacion.css">
</head>
<body>
    <main>
        <form action="facturacion_meses_anteriores" method="post" class="form-meses container">
            <div class="inputs">
                <h3>Fecha inicio</h3>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="public/img/calendar.png"></span>
                    </div>
                    <input type="date" name="primerDia" class="form-control mr-sm-2" >
                </div>
            </div>
            <div class="inputs">
                <h3>Fecha fin</h3>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="public/img/calendar.png"></span>
                    </div>
                    <input type="date" name="ultimoDia" class="form-control mr-sm-2" >
                </div>
            </div>
            <button class="btn btn-info">Consultar</button>
        </form>
    </main>
</body>
</html>
