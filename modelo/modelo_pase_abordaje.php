<?php 

function getQR(){

	//Agregamos la libreria para genera códigos QR
	require "phpqrcode/qrlib.php";    
	
	//Declaramos una carpeta temporal para guardar la imagenes generadas
	$dir = 'temp/';
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	
    //Declaramos la ruta y nombre del archivo a generar
	$filename = $dir.'test.png';

    //Parametros de Condiguración

	$nro_reserva=$_GET['nro_reserva'];	

	$tamaño = 5; //Tamaño de Pixel
	$level = 'H'; //Precisión Baja
	$framSize = 3; //Tamaño en blanco
	$contenido = $nro_reserva; //Texto
	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
	
        //Mostramos la imagen generada
	 
	return $dir.basename($filename); 
}

?>