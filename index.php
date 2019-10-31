<?php
include("sesion.php");
include_once("header.php");
/*
    if( isset($_GET['pag']) && $_GET['pag'] == "canciones"){
        include("controlador/controlador_canciones.php");
    } else if( isset($_GET['pag']) && $_GET['pag'] == "centro-medico"){
        include("controlador/controlador_centro-medico.php");
    } else if( isset($_GET['pag']) && $_GET['pag'] == "resultado_busqueda"){
        include("controlador/controlador_resultado_busqueda.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "info_vuelo"){
        include("controlador/controlador_info_vuelo.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "login-form"){
        include("controlador/controlador_login-form.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "login"){
        include("controlador/controlador_login.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "logout"){
        include("controlador/controlador_logout.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "registro-form"){
        include("controlador/controlador_registro-form.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "registro"){
        include("controlador/controlador_registro.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "pantalla-confirmacion"){
        include("controlador/controlador_pantalla-confirmacion.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "confirmacion"){
        include("controlador/controlador_confirmacion.php");
    } else if( isset($_GET['pag']) && $_GET['pag'] == "reservar-form"){
        include("controlador/controlador_reservar-form.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "reserva"){
        include("controlador/controlador_reserva.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "registrar_usuarios_extra"){
        include("controlador/controlador_registrar_usuarios_extra.php");
    }else if( isset($_GET['pag']) && $_GET['pag'] == "registro_usuarios_extra"){
        include("controlador/controlador_registro_usuarios_extra.php");
    } else {
       include("controlador/controlador_gauchorocket.php");
    }*/


$routes = parseRoutes();
$moduleName = extractModuleName($routes);
$action = extractActionName($routes);
$_GET = extractGetParams();



if( isset($_GET['pag'])){
    include("controlador/controlador_".$_GET['pag'].".php");
} else {
    include("controlador/controlador_gauchorocket.php");
}
include_once("footer.php");
function parseRoutes(){
    $urlAndParams = explode('?', $_SERVER['REQUEST_URI']);
    return explode('/', $urlAndParams[0]);
}

function extractModuleName($routes){
    return !empty($routes[1]) ? $routes[1] : "gauchorocket_mvc";
}

function extractActionName($routes){
    return !empty($routes[2]) ? $routes[2] : "index";
}

function extractGetParams() {

    $getParams = array();
    if (isset($_SERVER["REQUEST_URI"])) {

        // Separo la URL de los parametros tipo GET
        $requestPath = explode("?", $_SERVER['REQUEST_URI']);

        // Obtengo los parametros tipo GET si es que existen
        if (isset($requestPath[1])) {

            $path["query_utf8"] = $requestPath[1];
            $path["query"] = utf8_decode($path["query_utf8"]);

            // Parseo los parametros tipo GET en un array asociativo
            $vars = explode('&', $path["query"]);
            foreach ($vars as $var) {
                $param = explode('=', $var, 2);
                if (count($param) == 2) {
                    $getParams[$param[0]] = $param[1];
                }
            }
        }
    }
    return $getParams;
}
?>