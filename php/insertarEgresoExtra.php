<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");

$sql= "call insertarEgresoExtra (".$_POST['cant']." ,".$_SESSION["IdUsuario"].",'".$_POST['motivo']."', 1)";


if ($llamadoSQL = $conection->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
	/* obtener el array de objetos */
	 echo 1;

}else{echo null;}


?>