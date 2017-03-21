<?php 
include 'conexion.php';

$filas=array();
$log = mysqli_query($conection,"call validarDniExistente(".$_POST['dni'].");");
/*while($row = mysqli_fetch_array($log))
{
	$filas[]= array('mes' => $row['mes']); 
}*/
 echo json_encode(mysqli_fetch_array($log, MYSQL_ASSOC)); //sólo retorna los datos.
?>
 
