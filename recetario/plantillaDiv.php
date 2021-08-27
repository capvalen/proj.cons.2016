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
	p, .rowCajas{font-size: 0.9rem}
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
	.firma2{
		position: absolute;
    bottom: 0!important;
    left: 30%;
		z-index: 1031;
	}
	.pies{
		position: absolute;
    bottom: 0px;
		left:0px;
		z-index: 1031;
	}
	hr{
		margin-top: 0.5rem!important;
    margin-bottom: 0.5rem!important;
    border-top: 1px solid rgb(0 0 0 / 40%);
	}
	.fechaFirma{font-size: 75%;}
	@media print{
		.cuadrado{
			width: 2em!important;
			heigth:10px;
			border: 1px solid #000;
			display: inline-block;
		}
	}
	</style>
	<?php 

$esclavo= new mysqli($server, $username, $password, $db);
$esclavo->set_charset("utf8");

$nHC=$_GET['hc'];
$nReceta=$_GET['receta'];


$sql="SELECT r.*, c.cliApellidoPaterno, c.cliApellidoMaterno, c.cliNombres, retornarDNI(c.idCliente) as dni, cliFechaNacimiento FROM `recetas` r 
inner join cliente c on c.idCliente = r.idCliente
where idReceta = {$nReceta} and r.idCliente = {$nHC}; ";
$resultado=$esclavo->query($sql);
$row=$resultado->fetch_assoc();
//echo $sql;
$edad = DateTime::createFromFormat('Y-m-d', $row['cliFechaNacimiento'])->diff(new DateTime('now'))->y;

$recetaP=json_decode( $row['contReceta'] ); 
//var_dump( $recetaP );
?>
	<div class="container-fluid" style="page-break-after: always;">
		<div class="row fixed-top">
			<div class="col px-1">
				<img class="img-fluid" src="images/cabecera.png">
			</div>
			<div class="col px-1">
				<img class="img-fluid" src="images/cabecera_gris.png">
			</div>
		</div>
		<div class="row pt-5 mt-5">
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
		<div class="row pies"> <!-- fixed-bottom d-none -->
			<div class="col">
				<img src="images/pieNuevo.png" class="img-fluid">
			</div>
			<div class="col">
				<img src="images/pieNuevo_gris.png" class="img-fluid">
			</div>
		</div>
		<div class="firma"><img class="esImagen" src="images/firma.png"> <p class="mb-1 text-center fechaFirma"><span><?= date("d") . "/". date("m") ."/". date("Y") ?></span></p></div>
		
	</div>
	
	<?php if($_GET['solicitudImgs']=='true'): ?>
	<div class="container-fluid mt-5 pt-5">
		<div class="row">
			<div class="col">
				<p class="mb-1 text-center"><strong>SOLICITUD DE IMÁGENES Y PRUEBAS ELECTROFÍSIOLÓGICAS</strong></p>
				<p class="mb-1">Paciente: <span><?= "{$row['cliApellidoPaterno']} {$row['cliApellidoMaterno']}, {$row['cliNombres']}" ?></span></p>
				<p class="mb-1">DNI: <span class="mr-5"><?= $row['dni']==''? '-' : $row['dni'] ?></span>  Edad: <span><?= $edad . " años"; ?></span> <span class="ml-4">Fecha: <span><?=  date('d')."/".date('m')."/".date('Y') ." ".date('g').":".date('i')." ".date('a'); ?></span></span> </p>
				<p class="mb-1">Diagnóstico clínico: ........................................................................</p>
				<p class="mb-1">Exámen Solicitado: ........................................................................</p>
				<div class="rowCajas d-flex">
					<div class="mr-3">
						<div class="cuadrado text-center"> <?= $edad < 18 ? 'X' : "&nbsp"; ?> </div> <span>Niño</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> <?= $edad >= 18 ? 'X' : "&nbsp"; ?> </div> <span>Adulto</span>
					</div>
				</div>
				<hr />
				<p><strong>01. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
				<p><strong>02. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
				<p><strong>03. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
				<p><strong>04. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
				<p><strong>05. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
			</div>
			<div class="col">
				<p class="mb-1 text-center"><strong>SOLICITUD DE IMÁGENES Y PRUEBAS ELECTROFÍSICAS</strong></p>
				<p class="mb-1">Paciente: <span><?= "{$row['cliApellidoPaterno']} {$row['cliApellidoMaterno']}, {$row['cliNombres']}" ?></span></p>
				<p class="mb-1">DNI: <span class="mr-5"><?= $row['dni']==''? '-' : $row['dni'] ?></span>  Edad: <span><?= $edad . " años"; ?></span> <span class="ml-4">Fecha: <span><?=  date('d')."/".date('m')."/".date('Y') ." ".date('g').":".date('i')." ".date('a'); ?></span></span> </p>
				<p class="mb-1">Diagnóstico clínico: ........................................................................</p>
				<p class="mb-1">Exámen Solicitado: ........................................................................</p>
				<div class="rowCajas d-flex">
					<div class="mr-3">
						<div class="cuadrado text-center"> <?= $edad < 18 ? 'X' : "&nbsp;"; ?> </div> <span>Niño</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> <?= $edad >= 18 ? 'X' : "&nbsp;"; ?> </div> <span>Adulto</span>
					</div>
				</div>
				<hr />
				<p><strong>01. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
				<p><strong>02. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
				<p><strong>03. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
				<p><strong>04. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
				<p><strong>05. </strong> ........................................................................................................................................................
				................................................................................................................................................................
				................................................................................................................................................................ </p>
			</div>
		</div>
		<div class="row "> <!-- fixed-bottom d-none -->
			<div class="col">
				<img src="images/pieNuevo.png" class="img-fluid">
			</div>
			<div class="col">
				<img src="images/pieNuevo_gris.png" class="img-fluid">
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if($_GET['solicitudPatologia']=='true'): ?>
	<div class="container-fluid mt-5 pt-5">
		<div class="row mt-5 pt-5">
			<div class="col">
				<p class="text-center"><strong>SOLICITUD DE PATOLOGÍA QUIRÚRGICA - BIOPSIAS</strong></p>
				<p class="mb-1">Diagnóstico Presuntivo: ........................................................................</p>
				<div class="rowCajas d-flex">
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Biopsia Quirúrgica</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Biopsia Endoscópica</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Pieza Quirúrgica</span>
					</div>
					
				</div>
				<div class="rowCajas d-flex my-3">
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Revisión de Láminas</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Histoquímica</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Inmunohistoquímica</span>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<p>Signos y Síntomas: .........................................................................................................
							.................................................................................................................................................</p>
							<p>Tiempo de Enfermedad: ........................................ Forma de Inicio: ..............................</p>
							<p>Forma de Obtención: ......................................................................................................</p>
							<p>Fecha de operación: ............................................. Hora: .................................</p>
							<p>Biopsia anterior: ...............................................................................................................</p>
							<p>Hallazgos intraoperatorios: .........................................................................................
								.................................................................................................................................................</p>
							<p>Observaciones: .................................................................................................................</p>
							

					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="text-center"><img class="esImagen" src="images/firma.png"> <p class="mb-1 text-center fechaFirma"><span><?= date("d") . "/". date("m") ."/". date("Y") ?></span></p></div>
					</div>
				</div>

			</div>
			<div class="col">
				<p class="text-center"><strong>SOLICITUD DE PATOLOGÍA QUIRÚRGICA - BIOPSIAS</strong></p>
				<p class="mb-1">Diagnóstico Presuntivo: ...........................................................................................</p>
				<div class="rowCajas d-flex">
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Biopsia Quirúrgica</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Biopsia Endoscópica</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Pieza Quirúrgica</span>
					</div>
					
				</div>
				<div class="rowCajas d-flex my-3">
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Revisión de Láminas</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Histoquímica</span>
					</div>
					<div class="mr-3">
						<div class="cuadrado text-center"> &nbsp; </div> <span>Inmunohistoquímica</span>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<p>Signos y Síntomas: .........................................................................................................
							.................................................................................................................................................</p>
							<p>Tiempo de Enfermedad: ........................................ Forma de Inicio: ..............................</p>
							<p>Forma de Obtención: ......................................................................................................</p>
							<p>Fecha de operación: ............................................. Hora: .................................</p>
							<p>Biopsia anterior: ...............................................................................................................</p>
							<p>Hallazgos intraoperatorios: .........................................................................................
								.................................................................................................................................................</p>
							<p>Observaciones: .................................................................................................................</p>
							

					</div>
				</div>
				<div class="row">
					<div class="col">
						<div class="text-center"><img class="esImagen" src="images/firma.png"> <p class="mb-1 text-center fechaFirma"><span><?= date("d") . "/". date("m") ."/". date("Y") ?></span></p></div>
					</div>
				</div>
				
			
			</div>
		</div>
		<div class="row "> <!-- fixed-bottom d-none -->
			<div class="col">
				<img src="images/pieNuevo.png" class="img-fluid">
			</div>
			<div class="col">
				<img src="images/pieNuevo_gris.png" class="img-fluid">
			</div>
		</div>

		
		
		
		
	</div>
	<?php endif; ?>

</body>

</html>