<?php 
include 'conexion.php';
session_start();

//echo "call listarDatosUsuario(".$_SESSION['IdUsuario'].");";
$log = mysqli_query($conection,"call listarDatosUsuario(".$_SESSION['IdUsuario'].");");

echo json_encode(mysqli_fetch_array($log, MYSQLI_ASSOC)); //sólo retorna los datos.
?>