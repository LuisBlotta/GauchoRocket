<html>
<head>
    <title>Iniciar Sesión</title>
    <?php //include("head.php")?>
</head>
<body>
<form action="facturacion_meses_anteriores" method="post">
<h3>Fecha inicio</h3>
<div class="input-group">

    <div class="input-group-prepend">
        <span class="input-group-text"><img src="public/img/calendar.png"></span>
    </div>

    <input type="date" name="primerDia" class="form-control mr-sm-2" >
</div>
<br><br>
<h3>Fecha fin</h3>
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><img src="public/img/calendar.png"></span>
    </div>
    <input type="date" name="ultimoDia" class="form-control mr-sm-2" >
</div>
    <button class="btn btn-info">Consultar</button>

</form>

</body>
</html>
