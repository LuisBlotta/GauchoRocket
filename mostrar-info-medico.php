
<?php
include_once("conexion.php");

function getMedicos(){

    $id_medico=$_GET['id_medico'];
    $conn = getConexion();

    $sql = "SELECT id_medico, nombre, direccion, turnos
            FROM medico
            WHERE id_medico = '$id_medico'";

    $result = mysqli_query($conn, $sql);

    $medicos = Array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $medico = Array();
            $medico['id_medico'] =  $row["id_medico"];
            $medico['nombre'] =  $row["nombre"];
            $medico['direccion'] =  $row["direccion"];
            $medicos[] = $medico;
        }
    }
    mysqli_close($conn);
    return $medicos;
}

$medicos = getMedicos();

?>
