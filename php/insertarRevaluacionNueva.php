<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");


$sql= "call insertarRevaluacion (".$_POST['idcliente'].",'".$_POST['fechaHora']."',".$_SESSION['IdUsuario'].")";


if ($llamadoSQL = $conection->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
	/* obtener el array de objetos */
	 echo json_encode(mysqli_fetch_array($llamadoSQL, MYSQL_ASSOC)); //sólo retorna los datos de una sola fila.

}else{echo null;}


?>