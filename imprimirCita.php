<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Impresión de cita</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/estilosCita.css" rel="stylesheet">

</head>
<body>
	
	<main>
		<div class="panel panel-default col-xs-6" >
		<div class="panel-body">
			<img src="images/consultoria.png">
			<h4 class="text-center"><strong><?php echo $_GET['motivo'] ?></strong></h4>
				<div class="row">
					<div class="text-center mayuscula"><strong>Para: </strong><br>
					<strong><?php echo $_GET['dia']  ?></strong> a las <strong><?php echo $_GET['hora'] ?></strong></div>
					<div class="text-center"><span><?php echo $_GET['observacion'] ?></span></div>
					<hr>
					<div class="text-center"><strong>N° Historia Clínica: </strong><?php echo $_GET['idHistoria'] ?></div>
					<div class="text-center"><strong>Paciente: </strong><?php echo $_GET['nombres'] ?></div>
					<hr>
					<div class="piePagina">
					Av. 13 de Noviembre 832 - El Tambo - Huancayo<br>
					Telf. 1: (064) 789440 / Telf. 2: (064) 243247 / RPM: #956 428880<br>
					<em class="piePagina">Éste registro fue generado el día <span class="piePagina"  id='sfecha'><?php echo $_GET['sfecha'] ?></span> y Ud. fue atendido por <span class="piePagina"><?php echo ucwords($_GET['nomUsuario']) ?></span>.</em></div>
				</div>
			
		</div>
		</div>
	</main>
	<!-- <script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/moment.js"></script> -->
	<script>
	// moment.locale('es');
		// $('#sfecha').text(moment().format('dddd[,] DD [de] MMMM [de] YYYY [a las:] h:mm a'));
	</script>
	
</body>
</html>