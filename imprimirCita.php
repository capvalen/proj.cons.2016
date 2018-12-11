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
					<div class="text-center"><strong>Citado para: </strong><br>
					<strong><?php echo $_GET['dia']  ?></strong> a las <strong><?php echo $_GET['hora'] ?></strong></div>
					<hr>
					<div class="text-center"><strong>N° Historia: </strong><?php echo $_GET['idHistoria'] ?></div>
					<div class="text-center"><strong>Paciente: </strong><?php echo $_GET['nombres'] ?></div>
					<hr>
					<div class="piePagina">
					Av. 13 de Noviembre 832 - El Tambo - Huancayo<br>
					Cel.: 954 489089 / RPM: *446453 / Telf: (064) 789440<br>
					Generado el día	<span class="piePagina" id='sfecha'></span> atendido por Carlos Pariona Valencia</div>
				</div>
			
		</div>
		</div>
	</main>
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/moment.js"></script>
	<script>
	moment.locale('es');
		$('#sfecha').text(moment().format('dddd[,] DD [de] MMMM [de] YYYY [hora:] h:mm a'));
	</script>
	
</body>
</html>