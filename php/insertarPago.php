<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");

//,,,,,,
$sql= "call insertarPago (".$_POST['idreg'].",".$_POST['cant']." ,".$_SESSION['IdUsuario'].",
'".$_POST['obs']."', ".$_POST['idcli'].", ".$_POST['tipoPago'].",  ".$_POST['turno'].")";


if ($llamadoSQL = $conection->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
	/* obtener el array de objetos */
	 echo 1;

}else{echo null;}


?>