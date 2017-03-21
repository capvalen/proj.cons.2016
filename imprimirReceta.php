<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Impresión de receta</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/estilosReceta.css" rel="stylesheet">

</head>
<body>
	
	<main>
		<div class="panel  col-xs-8 " >  <!-- aggregar para un mejor aspecto en papel Blanco: classe>  panel-defaul  -->
		
			<img class="imgCabecera" src="images/cabecera.png">
			<h4 class="text-center">Recetario médico</h4>
			<div class="row">
				<div class="col-xs-3"><strong>Origen: </strong> <span>Consultorio</span></div>
				<div class="col-xs-4 text-left"><strong>N° de Solicitud: </strong><span>001-2016-OR</span></div>
				<div class="col-xs-5"><strong><span id="labelFecha"></span></strong> </div>				
			</div>
			<div class="row">
				<div class="col-xs-7"><strong>Paciente: </strong> <span>Pariona Valencia, Carlos Alex</span></div>
				<div class="col-xs-3"><strong>D.N.I: </strong> <span>44475064</span></div>
				<div class="col-xs-2"><strong>Sexo: </strong> <span>M</span></div>
			</div>
			<div class="row">
				<div class="col-xs-3"><strong>Edad: </strong> <span>29 años</span></div>
				<div class="col-xs-3"><strong>Celular: </strong> <span>96325893</span></div>
				<div class="col-xs-3"><strong>N° Historia: </strong> <span>001596</span></div>
				
			</div>
			<div class="row">
				<div class="col-xs-7"><strong>Médico: </strong> <span>Dr. David Balbin Villaverde</span></div>
				
			</div>

			<div class="panel"> <!-- aggregar para un mejor aspecto en papel Blanco: classe>  panel-defaul  -->
		<!-- Default panel contents -->
		<div class="panel-heading">Diagnóstico presuntivo:</div>

		<!-- Table -->
		<table class="table tablaImpresionReceta">
			<thead>
				<tr>
					<th class="col-xs-4 text-center">Medicamento</th>
					<th class="col-xs-1 text-center">Cant.</th>
					<th class="col-xs-1 text-center">Dosif.</th>
					<th class="col-xs-1 text-center">Present.</th>
					<th class="col-xs-5 text-center">Indicaciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="tdReceta text-capitalize">1. </td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-capitalize"></td>
				</tr>
				<tr>
					<td class="tdReceta text-capitalize">2. </td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-capitalize"></td>
				</tr>
				<tr>
					<td class="tdReceta text-capitalize">3. </td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-capitalize"></td>
				</tr>
				<tr>
					<td class="tdReceta text-capitalize">4. </td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-capitalize"></td>
				</tr>
				<tr>
					<td class="tdReceta text-capitalize">5. </td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-capitalize"></td>
				</tr>
				<tr>
					<td class="tdReceta text-capitalize">6 .</td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-capitalize"></td>
				</tr>
				<tr>
					<td class="tdReceta text-capitalize">7 .</td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-capitalize"></td>
				</tr>
				<tr>
					<td class="tdReceta text-capitalize">8 .</td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-center text-capitalize"></td>
					<td class="tdReceta text-capitalize"></td>
				</tr>
			</tbody>
		</table>
	<div class="nuevo"></div>	
			
		
		</div>
		<div class="row text-center"> <img src="images/firma1.jpg"></div>
		<hr>
		<div class=" text-center">Llame a los siguientes números si posee alguna consulta: Oficina 1: 064-789440 ¦ Oficina 2: 064-243247 y en caso de emergencias: Movistar: 954 489089.<br> Horario mañanas: 8:00 a.m. hasta 2:00 p.m. y Horario noches: 4.30 p.m. hasta 9:00 p.m.</div>
	</div>
	</main>
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/moment.js"></script>
	<script>
	
	
	<?php 
	for ( $i = 0; $i <= 39; $i++) {?>
		$('tbody td').eq( <?php echo $i; ?> ).append( <?php echo isset($_GET['rc'.$i]) ? $_GET['rc'.$i] : ' '; ?> );<?php 
	}
	 ?>
	moment.locale('es');
	$('#labelFecha').text(moment().format('dddd[,] DD MMMM YYYY. h:mm a'));
		//console.log($('tbody').find('td').length);
		
		
	</script>
	
</body>
</html>