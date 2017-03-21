<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");

$idUsuario=$_SESSION['IdUsuario'];
//echo 'user'.$idUsuario;

$sql= "call actualizarClientev2 (".$_POST['idCli'].",'".$_POST['paterno']."','".$_POST['materno']."','".$_POST['nombre']."','".$_POST['fecha']."',".$_POST['civil'].",'".$_POST['sexo']."',".$_POST['ocupacion'].",'".$_POST['direccion']."','".$_POST['telefono']."','".$_POST['celular']."', ".$_POST['procedencia'].", ".$_SESSION['IdUsuario'].", ".$_POST['grado'].", '".$_POST['dni']."', ".$_POST['tipoDni'].")";


if ($llamadoSQL = $conection->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
	echo 1;

}else{echo null;}


?>