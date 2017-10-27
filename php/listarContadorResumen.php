<?php 
require("conexion.php");

$filas=array();
$sql = mysqli_query($conection,"call listarContadorResumen('".$_POST['dia']."');");
$i=0;

while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC))
{
	$filas[$i]= $row;
	$i++;
}
mysqli_close($conection); //desconectamos la base de datos
echo json_encode($filas[0]);
?>