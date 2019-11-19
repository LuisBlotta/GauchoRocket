<?php
include_once("conexion.php");
confirmar();
function confirmar(){
    $conn = getConexion();

    $hashConfirmacion=$_GET["hash"];

    $query = "SELECT hashConfirmacion FROM login WHERE hashConfirmacion ='$hashConfirmacion'";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado)>0){
        $queryUpdate = "UPDATE login SET userConfirmado = true WHERE hashConfirmacion ='$hashConfirmacion'";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);
        header('location:gauchorocket');
    }
}