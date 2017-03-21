<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");

$sql= "call cambiarContraseña (".$_SESSION['IdUsuario'].", '".$_POST['pssNuevo']."')";

if ($llamadoSQL = $conection->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
	/* obtener el array de objetos */
	//echo json_encode(mysqli_fetch_array($llamadoSQL, MYSQL_ASSOC)); //sólo retorna los datos.
	echo 1;


}else{echo null;}

 ?>