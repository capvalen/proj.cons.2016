<?php 
include 'conexion.php';
session_start();

$log = mysqli_query($conection,"call listarDatosUsuario(".$_SESSION['IdUsuario'].");");

echo json_encode(mysqli_fetch_array($log, MYSQL_ASSOC)); //sólo retorna los datos.
?>