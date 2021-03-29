<?php 
include "../../php/conexion.php";
$esclavo= new mysqli($server, $username, $password, $db);
$esclavo->set_charset("utf8");
$_POST = json_decode(file_get_contents('php://input'),true);

$receta = json_encode($_POST['receta']);

$sql="INSERT INTO `recetas`(`idReceta`, `contReceta`, `idCliente`) VALUES (null, '{$receta}', {$_POST['hc']}); ";

if($esclavo->query($sql)){
	echo $esclavo->insert_id;
}


?>