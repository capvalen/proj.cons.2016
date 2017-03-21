<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");


$sql= "call insertarComentario (".$_POST['idCli'].",'".$_POST['titulo']."', '".$_POST['relleno']."' ,".$_SESSION['IdUsuario'].")";


if ($llamadoSQL = $conection->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
	/* obtener el array de objetos */
	 echo 1;

}else{echo null;}


?>