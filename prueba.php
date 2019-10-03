<?php
session_start();
if(!isset($_SESSION['usuario'])){
    header('location:login-form.php');
    exit();
}
else{
    echo "Hola Mundo";
    header('location:index.php');

}
?>
