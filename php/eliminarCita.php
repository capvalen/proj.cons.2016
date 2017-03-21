<?php 
session_start();
include 'conexion.php';



$log = mysqli_query($conection,"call eliminarCita(".$_POST['idCita'].", '".$_SESSION["usuario"]."');");
	echo 1;

//echo json_encode($filas)
 //echo json_encode(mysqli_fetch_array($log, MYSQL_NUM)); //sólo retorna los datos.
?>
