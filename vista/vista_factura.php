<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
    <?php include("head.php");?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-factura.css">

</head>
<body>

<main>
    <section class="container card factura">
    <?php
        echo "<h1>¡Gracias!</h1>
              <article>
                  <h4>Hola ".$datos_transaccion['nombre'].":</h4>
                  <p>Gracias por tu compra en Gaucho Rocket</p>
              </article>
                            
              <article>
                  <h3>Número de factura:</h3>
                  <h5>".$datos_transaccion['cod_transaccion']."</h5>
                  <p>(Guarda una copia de este recibo como referencia)</p>
              </article>
              
              <article>
                  <h4>Informacion de compra:</h4>
                  <p>
                      <span>Fecha: ".$datos_transaccion['fecha']."</span>
                      <span>Hora: ".$datos_transaccion['hora']."</span>
                  </p>
                  <p>Facturado a: ".$datos_transaccion['mail']." </p>
              </article>
              
              <table class='table'>
                  <thead class='thead-light'>
                      <th>Descripcion</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                  </thead>
                  <tbody>
                      <th>Vuelo a ".$datos_transaccion['punto_llegada']."</th>
                      <th>".$datos_transaccion['cantidad_lugares']."</th>
                      <th>$".$datos_transaccion['precio'].".-</th>
                  </tbody>
                  <tbody>
                      <th>TOTAL</th>
                      <th></th>                      
                      <th>$".$datos_transaccion['total'].".-</th>
                  </tbody>
              </table>
              
              <article>
              <h4>Detalles de pago:</h4>
              <p>Pagado con: ".$datos_transaccion['tipo_tarjeta']." - [".$datos_transaccion['nro_tarjeta']."]</p>
              </article>";
    ?>
    </section>
</main>
</body>
