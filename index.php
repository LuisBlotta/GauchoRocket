<?php
include("sesion.php");
include ("head.php");
include_once("header.php");
include ("controlador/controlador_verificar_turno.php");
include ("controlador/controlador_activar_lista_espera.php");
include ("controlador/controlador_validar_reserva_nivel.php");
//include ("controlador/controlador_borrar_reservas_canceladas.php");

$routes = parseRoutes();
$moduleName = extractModuleName($routes);
$action = extractActionName($routes);
$_GET = extractGetParams();


$filename = "controlador/controlador_" . $moduleName . ".php";
if( file_exists($filename) ){
    include_once($filename);
    call_user_func( $moduleName . '_' . $action);
} else {
    echo "<section class='container'>
              <h2 style='color:#17a2b8; text-align:center; margin-top: 50px'>La pagina solicitada no existe</h2>
                   <div class='row'>
                       <div class='col-sm-4'>                           
                       </div>
                       <div class='col-sm-4' style='display: flex; justify-content: center; margin-top: 50px'>
                           <a href='gauchorocket' class='btn btn-info'>Ir al inicio</a>
                       </div>
                       <div class='col-sm-4'>                          
                       </div>
                   </div>              
          </section>";
}

/*
 * echo "<br>";
print_r( $_SERVER['REQUEST_URI']);
echo "<br>";
print_r(implode("/", $_GET));
exit();*/


include_once("footer.php");




function parseRoutes(){
    $urlAndParams = explode('?', $_SERVER['REQUEST_URI']);
    return explode('GauchoRocket/', $urlAndParams[0]);

}

function extractModuleName($routes){
    return !empty($routes[1]) ? $routes[1] : "gauchorocket";
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