<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Consultorio ORL</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/reporte.css" rel="stylesheet" >

		
	</head>
	<body>
	<div class="container micuerpo">
		<main>

			<div class="row divFecha flex-parent">
				<div class="col-xs-8"><img src="images/logoLargo.png" alt=""></div>
				<div class="col-xs-4 ">
					<label class="text-right ">N° DE HISTORIA:</label>
					<label class="text-center divHistoria"><h4><?php echo $_GET['idHistoria'];?></h4></label><br>
					<label>INSCRIPCIÓN: <strong><span id="labelFechaInscripcion"></span></strong></label><br>
					<label>ATENDIÓ: <strong><span><?php echo $_GET['usunom'];?></span></strong></label><br>
					<label class="labelPaciente">PACIENTE: <strong><span class="labelPaciente"><?php echo $_GET['tipopaciente'];?></span></strong></label>
					
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-8">APELLIDOS Y NOMBRES: <span><strong><?php echo $_GET['nombres'];?></strong></span></div> 
				<div class="col-xs-4">OCUPACIÓN: <strong><?php 
				switch ($_GET['ocupacion']) {
					case 'EMPLEADO INDEPENDIENTE':
						echo 'INDEPENDIENTE';
						break;
					case 'EMPLEADO DEPENDIENTE':
						echo 'DEPENDIENTE';
						break;
					default:
						echo $_GET['ocupacion'];
						break;}
				;
				?></strong></div>
			</div>

			<div class="row">
				<div class="col-xs-4">FECHA NACIMIENTO: <strong><span><?php echo $_GET['nacimiento'];?></span></strong></div>
				<div class="col-xs-4">ESTADO CIVIL: <strong><span><?php echo $_GET['estado'];?></span></strong></div>
				<div class="col-xs-4">CELULAR: <strong><span><?php echo $_GET['celular'];?></span></strong></div>
			</div>
			<div class="row">
				<div class="col-xs-2">SEXO: <strong><?php echo $_GET['sexo'];?></strong></div>
				<div class="col-xs-3">EDAD: <strong><?php echo $_GET['edad'];?></strong></div>
				<div class="col-xs-7">DIRECCIÓN: <strong><span><?php echo $_GET['direccion'];?></span></strong></div>
			</div>
			<hr>
			<div class="row">
				<div class="col-xs-12">MOTIVO DE LA CONSULTA: <strong><span><?php echo $_GET['motivo'];?></span></strong></div>
			</div>
			<div class="container"><br>
				<div class="col-xs-12"><strong>FUNCIONES VITALES:</strong></div>
				<div class="container">
					<div class="col-xs-2">P/A:</div><div class="col-xs-2">mmHg FC</div>
					<div class="col-xs-2">x min T°</div>
					<div class="col-xs-2">°C PESO</div>
					<div class="col-xs-2">Kg Talla</div>
					<div class="col-xs-2">m.</div>
				</div><br>
				<div class="col-xs-12"><strong>ANAMNESIS:</strong></div>
				<div class="container">
					<div class="col-xs-12">FECHA: ____/____/________</div>
					<div class="col-xs-12">ENF. ACTUAL:</div>
					<div class="container">
					<div class="row">
						<div class="col-xs-4">T.E:</div>
						<div class="col-xs-4">F.I:</div>
						<div class="col-xs-4">CURSO:</div>
					</div>
					<div class="row">
						<div class="col-xs-12">SIGNOS Y SÍNTOMAS:</div>
					</div>
					</div>
				</div>
				<div class="container row">
					<br><br><br>
					<div class="container">
						<div class="col-xs-4">ANT:</div>
						<div class="col-xs-4">HTA:</div>
						<div class="col-xs-4">DM:</div>
						<div class="col-xs-12">IQX:</div>
						<div class="col-xs-12">RAM:</div>
						<div class="col-xs-12">EXAMEN CLÍNICO:</div>
						<div class="col-xs-12">FN:</div>
					</div>
				</div>
				<br>
				<div class="container row">
					<div class="container">
						<div class="col-xs-12">OF:</div>
					</div>
				</div>
				<br>
				<div class="container row">
					<div class="container">
						<div class="col-xs-12">OIDO DER.:</div>
					</div>
				</div>
				<br>
				<div class="container row">
					<div class="container">
						<div class="col-xs-12">OIDO IZQ.:</div>
					</div>
				</div>
				<br>
				<div class="container row">
					<div class="container">
						<div class="col-xs-5">R.:</div>
						<div class="col-xs-3">U.:</div>
					</div>
				</div>
				<br>
				<div class="container row">
					<div class="container">
						<div class="col-xs-12">LARINGOSCOPÍA:</div>
					</div>
				</div>
				<br>
				<div class="container row">
					<div class="container">
						<div class="col-xs-12">DIAGNÓSTICO:</div>
					</div>
				</div>
				<br><br>
				<div class="container row">
					<div class="container">
						<div class="col-xs-12">TRATAMIENTO:</div>
					</div>
				</div>

			</div>
		</main>
	</div>
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/moment.js"></script>
	<script>
	moment.locale('es');
	//var fechinscrip=moment('<?php echo $_GET['registro'];?>');
	//$('#labelFechaInscripcion').text(fechinscrip.format('DD MMMM YYYY h:mm a'));
	$('#labelFechaInscripcion').text(moment().format('DD MMMM YYYY h:mm a'));

	</script>
	</body>
</html>