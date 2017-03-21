<?php 
include 'conexion.php';
session_start();

$filas = array();
$sql = mysqli_query($conection,"call listarUltimosRegistrados();");


while($temp = mysqli_fetch_assoc($sql)) {
    $filas[] = $temp;
}
echo json_encode($filas);

?>