<?php 
usleep(500000);
include "../../php/conexion.php";

$esclavo= new mysqli($server, $username, $password, $db);
$esclavo->set_charset("utf8");
$_POST = json_decode(file_get_contents('php://input'),true); 

$fila =[];


$sql="SELECT c.*, hc.idHistoriaClinica  FROM `cliente` c
inner join historiaclinica hc on hc.idCliente = c.idCliente
left join documentoidentidad d on d.idCliente = c.idCliente
where concat(cliApellidoPaterno, ' ', cliApellidoMaterno, ' ', cliNombres ) like '%{$_POST['texto']}%'
or hc.idHistoriaClinica = '{$_POST['texto']}'  or d.NumeroDocumento = '{$_POST['texto']}' ;";
//echo $sql;
$resultado=$esclavo->query($sql);
if($resultado->num_rows>0){ $i=0;
	while($row=$resultado->fetch_assoc()){ 
		$fila[$i] = array( 'histClinica' => $row['idHistoriaClinica'] , 'paciente'=> $row['cliApellidoPaterno']. " ".$row['cliApellidoMaterno']. " ".$row['cliNombres'] );
		$i++;
	}
}
echo json_encode($fila);

?>