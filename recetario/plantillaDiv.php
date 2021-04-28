<?php 
include "../php/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ORL: Recetario</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
	<style>
	@page {
		size: landscape !important;
	}
	.marron{color: #5c3f16}
	p{font-size: 0.9rem}
	.esImagen{
		width: 150px;
		
	}
	.esTexto{
		margin-bottom: 0;
	}
	.firma{
		position: absolute;
    bottom: 50px;
    left: 30%;
		z-index: 1031;
	}
	</style>
	<?php 

$esclavo= new mysqli($server, $username, $password, $db);
$esclavo->set_charset("utf8");

$nHC=$_GET['hc'];
$nReceta=$_GET['receta'];


$sql="SELECT r.*, c.cliApellidoPaterno, c.cliApellidoMaterno, c.cliNombres FROM `recetas` r 
inner join cliente c on c.idCliente = r.idCliente
where idReceta = {$nReceta} and r.idCliente = {$nHC}; ";
$resultado=$esclavo->query($sql);
$row=$resultado->fetch_assoc();
//echo $sql;

$recetaP=json_decode( $row['contReceta'] ); 
//var_dump( $recetaP );
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col px-1">
				<img class="img-fluid" src="images/cabecera.png">
			</div>
			<div class="col px-1">
				<img class="img-fluid" src="images/cabecera_gris.png">
			</div>
		</div>
		<div class="row">
			<div class="col px-1 marron">
				<h5 class="text-center">RECETARIO</h5>
			</div>
			<div class="col px-1 ">
				<h5 class="text-center">RECETARIO</h5>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p class="mb-1">Paciente: <span><?= "{$row['cliApellidoPaterno']} {$row['cliApellidoMaterno']}, {$row['cliNombres']}" ?></span></p>
				<p><strong>Receta:</strong></p>
			</div>
			<div class="col-2">
				<p>N° H.C.: <strong><?= $row['idCliente'] ?></strong></p>
			</div>
			<div class="col">
				<p class="mb-1">Paciente: <span><?= "{$row['cliApellidoPaterno']} {$row['cliApellidoMaterno']}, {$row['cliNombres']}" ?></span></p>
				<p><strong>Receta:</strong></p>
			</div>
			<div class="col-2">
				<p>N° H.C.: <strong><?= $row['idCliente'] ?></strong></p>
			</div>
		</div>
		<div class="row">
			<div class="col px-4">
				<?php 
				for ($i=0; $i < count($recetaP) ; $i++) { 
					if($recetaP[$i]->esTexto==1){ ?> 
						<p class="esTexto text-capitalize"><?= utf8_decode( $recetaP[$i]->relleno ); ?></p>
					<?php
					}else{ ?>
						<img class="esImagen" src="images/firma.png"><img class="esImagen" src="images/path833.png"> <?php	
					}
				}
				?>
			</div>
			<div class="col px-4">
			<?php 
				for ($i=0; $i < count($recetaP) ; $i++) { 
					if($recetaP[$i]->esTexto==1){ ?> 
						<p class="esTexto text-capitalize"><?= utf8_decode( $recetaP[$i]->relleno ); ?></p>
					<?php
					}else{ ?>
						<img class="esImagen" src="images/path833.png"> <?php	
					}
				}
				?>
			</div>
		</div>
		<div class="row fixed-bottom">
			<div class="col">
				<img src="images/pieNuevo.png" class="img-fluid">
			</div>
			<div class="col">
				<img src="images/pieNuevo_gris.png" class="img-fluid">
			</div>
		</div>
		<div class="firma"><img class="esImagen" src="images/firma.png"> <p class="mb-1 text-center"><small><?= date("d") . "/". date("m") ."/". date("Y") ?></small></p></div>
		
	</div>
</body>

</html>