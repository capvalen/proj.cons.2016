<?php 
include 'conexion.php';

$filas=array();
$log = mysqli_query($conection,"call listarCitasPorFecha('".$_POST['dia']."');");

while($row = mysqli_fetch_array($log, MYSQLI_ASSOC))
{
	$filas[]= $row; 
}

echo json_encode($filas);

 //echo json_encode(mysqli_fetch_array($log, MYSQL_NUM)); //sólo retorna los datos.
?>
