<?php 
include 'conexion.php';

$filas=array();

 $sql="call validarNombreExiste('".$_POST['nombre']."');";
 $resultado=$cadena->query($sql);
 $row=$resultado->fetch_assoc())
	 
 
 echo json_encode($row);
?>
 
