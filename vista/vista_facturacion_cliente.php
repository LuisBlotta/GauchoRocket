<html>
<head>
    <title>Form reportes</title>
    <?php include("head.php");?>

</head>

<body>
<h1>Resultado</h1>
<section>
    <h3>Facturación por cliente</h3>



        <table  class="table table-bordered table-hover table-stripped">

            <thead>
            <tr>
                <th>Número Transacción</th>
                <th>Número Reserva</th>
                <th>Fecha</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $total =0;
            foreach ($transacciones as $transaccion) {

            $total += $transaccion['precio'];
            ?>
             <tr>

                 <td><?= $transaccion['cod_transaccion'] ?></td>
                 <td><?=$transaccion['nro_reserva'] ?></td>
                 <td><?= $transaccion['fecha'] ?></td>
                 <td><?= $transaccion['precio'] ?></td>
                 <?php
                 }?>

             </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?=$total?></td>
            </tr>


            </tbody>
        </table>







</section>
</body>
</html>