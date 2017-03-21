<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");

$sql= "call confirmarContrasena (".$_SESSION['IdUsuario'].", '".$_POST['campo']."')";

if ($llamadoSQL = $conection->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
	/* obtener el array de objetos */
	//echo json_encode(mysqli_fetch_array($llamadoSQL, MYSQL_ASSOC)); //sólo retorna los datos.
	if (mysqli_num_rows($llamadoSQL)==1){
		echo true;
	}else{ echo false;}


}else{echo null;}

 ?>