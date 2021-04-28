<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");

$idUsuario=$_SESSION['IdUsuario'];
//echo 'user'.$idUsuario;

$sql= "call insertarHistoriaClinica (".$_POST['idcliente'].",'".$_POST['motivo']."',".$_SESSION['IdUsuario'].")";


$resultado=$cadena->query($sql);
if($row=$resultado->fetch_assoc()){
	echo json_encode($row);
}else{
	echo 'error';
}
?>