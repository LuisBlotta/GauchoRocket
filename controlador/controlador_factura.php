<?php
    include("modelo/modelo_info_factura.php");
        function factura_index(){}
        $datos_transaccion=traerInfoFactura();
    include("vista/vista_factura.php");
