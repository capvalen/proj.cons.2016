<?php 
session_start();
header('Content-Type: text/html; charset=utf8');
require("conexion.php");

$idUsuario=$_SESSION['IdUsuario'];
//echo 'user'.$idUsuario;

$sql= "call insertarClienteNuevo ('".$_POST['paterno']."','".$_POST['materno']."','".$_POST['nombre']."','".$_POST['fecha']."',".$_POST['civil'].",'".$_POST['sexo']."',".$_POST['ocupacion'].",'".$_POST['direccion']."','".$_POST['telefono']."','".$_POST['celular']."', ".$_POST['procedencia'].", ".$_SESSION['IdUsuario'].", ".$_POST['grado'].", '".$_POST['dni']."', ".$_POST['tipoDni'].")";

// echo  "call insertarClienteNuevo ('".$_POST['paterno']."','".$_POST['materno']."','".$_POST['nombre']."','".$_POST['fecha']."',".$_POST['civil'].",'".$_POST['sexo']."',".$_POST['ocupacion'].",'".$_POST['direccion']."','".$_POST['telefono']."','".$_POST['celular']."', ".$_POST['procedencia'].", ".$_SESSION['IdUsuario'].", ".$_POST['grado'].", '".$_POST['dni']."', ".$_POST['tipoDni'].")";
if ($llamadoSQL = $conection->query($sql)) { //Ejecución mas compleja con retorno de dato de sql del procedure.
	/* obtener el array de objetos */
	 echo json_encode(mysqli_fetch_array($llamadoSQL, MYSQL_ASSOC)); //sólo retorna los datos.

}else{echo null;}


?>