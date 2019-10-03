<?php
getConexion();

function getConexion(){
    
    $servername = "localhost:3307";
    $username = "root";
    $dbname = "gauchoRocket";
    $password = "";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
  
    return $conn;
}

?>