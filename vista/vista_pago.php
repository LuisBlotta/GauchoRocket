<?php include_once("conexion.php");
include("condicional_sesion.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Gaucho Rocket</title>
    <?php include("head.php") ?>
    <link rel="stylesheet" type="text/css" href="public/css/estilos-info_vuelo.css">

    <script type='text/javascript'>
        (function(){function $MPC_load(){window.$MPC_loaded !== true && (function(){var s = document.createElement('script');s.type = 'text/javascript';s.async = true;s.src = document.location.protocol+'//secure.mlstatic.com/mptools/render.js';var x = document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s, x);window.$MPC_loaded = true;})();}window.$MPC_loaded !== true ? (window.attachEvent ?window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;})();
    </script>
</head>
<body>

<main>
    <section class="cont-info">
        <?php
        foreach ($datos as $dato) {
            echo "
                        <article class='card'>
                            <div class='card-body'>                                
                                <p>N° de reserva: " . $dato['nro_reserva'] . "</p>  
                                <h2>" . $dato['destino'] . "</h2>
                                <p>Origen: " . $dato['origen'] . "</p><br>

                                <p>
                                    <span>
                                    <img src='public/img/calendar.png'> ".$dato['fecha_ida']."
                                    </span>
                                    <span>
                                        Hora: " . $dato['hora_partida'] . ":00 AM
                                    </span><br>                              
                                
                                <h3>$" . $dato['precio_total'] . ".-</h3><br>                            
                                                                
                                <!--<a class='btn-reservar btn btn-info' href='index.php?pag=reservar-form'>Pagar</a>-->

                                <!--<a mp-mode='dftl' href='https://www.mercadopago.com.ar/checkout/v1/redirect?pref_id=285177117-56fb8c1d-ce9d-4a1c-ab4a-3f32bf105a35' name='MP-payButton' class='blue-ar-l-rn-none'>Pagar</a>-->
                                <button type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal'>Pagar</button>";                         

                                include('vista_modal_pagar.php');

                        echo"</div>                            
                        </article>"; 

        }
        ?>
    </section>
    <?php
        if (!empty($_GET['fallo_datos'])==1){
            echo "<script>alert('Hubo un error en los datos ingresados, por favor intentelo nuevamente');</script>";
        }
    ?>
</main>
</body>
</html>