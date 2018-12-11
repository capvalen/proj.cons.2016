<?php 
session_start();
require_once 'php/contServ.php';
if(isset($_SESSION['usuario'])){?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<link rel="stylesheet" href="iconfont/material-icons.css"> <!--Iconos en: https://design.google.com/icons/-->
		<title>Reporte por fecha: Consultorio ORL</title>
		<link rel="shortcut icon" href="images/favicon.png">

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/sticky-footer.css" rel="stylesheet">
		<link href="css/estilos.css?version=1.2.9" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/bootstrap-switch.css" rel="stylesheet">
		<link href="css/icofont.css" rel="stylesheet">

	</head>
	<body>
	<style> 
		body{
			background-color: #f3f3f3;
		}
		.conPrincipal{background-color: #fdfdfd;
			border-radius: 9px;
			margin-top: 20px;
			border: 1px solid #dadada;}
		/* -webkit-box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);
		box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23); */
		footer{margin-top: 133px;}
		.xs4Datos{background-color: #fff;
			color: #ffbf01;
			border: 1px solid #ddd;border-radius: 4px;
			-webkit-transition: border .2s ease-in-out;
			o-transition: border .2s ease-in-out; cursor: default;
			padding-bottom:5px; margin-bottom: 15px;
			transition: all 0.6s;}
		.xs4Datos:hover{cursor:pointer;
			background-color: #f3f3f3;
			color: #FF5722;font-weight: 700;
			transition: all 0.6s;

		}
		.tablita{color: #888;}
		hr{ margin-bottom: 5px;}
		h3{ margin-top: 5px;}
		option{background-color: #fff; color: #694D9F; margin-top: 5px;}
		.form-control{ color: #694D9F;}
		.bootstrap-switch:focus{-webkit-box-shadow: none;
    	outline: -webkit-focus-ring-color auto 0px;}
    	label{font-size: 13px; color: #7b7b7b}
    	.modal-nuevoCliente i{font-size: 22px;}
	</style>
		<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><img src="images/logoTransparente.png"  id="logoEmpresa"  alt=""></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav navbar-nav">
			<li><a href="index.php"><i class="material-icons">home</i></a></li>
			<li><a href="Cliente.php"><i class="material-icons">group</i> Clientes</a></li>
			<li dropdown><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">monetization_on</i> Economía <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#" id="ingresoExterno"><span class="glyphicon glyphicon-plus"></span> Ingreso externo</a></li>
					<li><a href="#" id="egresoExterno"><span class="glyphicon glyphicon-minus"></span> Gasto externo</a></li>
				</ul>
			</li>
			<li dropdown><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">attach_file</i> Reportes <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="cuadrecaja.php" id="ingresoExterno"><span class="glyphicon glyphicon-piggy-bank"></span> Cuadre de caja</a></li>
				</ul>
			</li>
		</ul>
	 
		<ul class="nav navbar-nav navbar-right">				
		 <form class="navbar-form navbar-left hidden-xs hidden-sm" role="search">
 
			<div class="input-group">
				<input type="text" class="form-control" id="txtBuscar" placeholder="Buscar">
				<span class="input-group-btn">
					<button type="button" class="btn btn-warning btn-outline" id="btnBuscar"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
			
		</form>        
			<li><a href="configuraciones.html"><i class="material-icons">settings</i></a></li>
			
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">fingerprint</i> <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#" data-toggle="modal" data-target=".modal-password"><span class="glyphicon glyphicon-cog"></span> Cambiar contraseña</a></li>
					<li role="separator" class="divider"></li>
					<li><a href="php/cerrarSesion.php"><span class="glyphicon glyphicon-send"></span> Cerrar sesión</a></li>
				</ul>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
		</div>
	</nav>

	<div class="container conPrincipal noSelect">
		<main>
			<div class="container hidden-md hidden-lg hidden-print">
				<div class="input-group" style="margin-top: 10px;">
					<input type="text" class="form-control" id="txtBuscarMini" placeholder="Buscar por: Nombre, Dni, N° Historia" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-negro" id="btnBuscarMini"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
			<div class="row col-sm-7 "><h3 style="margin-top: 21px;"><span class="glyphicon glyphicon-th-list "></span> Reportes por fechas </h3></div>
			<div class="row page-header hidden-print">
			</div>
				<div class="container-fluid">
					<div class="row panel panel-default  noselect" id="botonesDoctor">
					<div class="row">
						<div class="col-xs-6">
						<p><strong>Fecha de filtro:</strong></p>
						<input type="date" class="form-control text-center" id="dtpFechaReporte">
						<br><p><strong>Resultados:</strong></p>
						</div>
					</div>
					<hr class="hidden-print">
					
					<table class="table table-hover">
					<thead>
					<tr>
						<th>Cod.</th>
						<th>Nombre</th>
						<th>Tipo</th>
						<th>Fecha & Hora</th>
						<th>Teléfono</th>
					</tr></thead>
					<tbody>
						<tr><td></td><td>Seleccione una fecha para generar el reporte</td></tr>
					</tbody>
					</table>
					</div>
				</div>
				
				
		</main>
		
	</div>
	<?php include "piePagina.php"; ?>
	

	

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-2.2.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<script src="js/moment.js"></script>

<script src="js/moment-precise-range.js"></script> 


<script>
$('#dtpFechaReporte').val(moment().format('YYYY-MM-DD'));
$('#dtpFechaReporte').keypress(function (e) { 
	if(e.keyCode == 13){ 
		llamarRows();
	}
});
$('#dtpFechaReporte').change(function () {
	llamarRows();
});
function llamarRows() {
	var diaCons= moment($('#dtpFechaReporte').val()).format('DD/MM/YYYY');
		$.ajax({url: 'php/listarCitasPorFecha.php', type: 'POST', data: { dia: $('#dtpFechaReporte').val()  }}).done(function(resp) {
			$('tbody').children().remove(); console.log(JSON.parse(resp))
			var respuesta= JSON.parse(resp);
			if(respuesta.length>0){
				$.each(respuesta, function(i, elem){
					$('tbody').append(`<tr>
							<td>${elem.idHistoriaClinica}</td>
							<td>${elem.nombres}</td>
							<td>${elem.descripcion}</td>
							<td> ${elem.hora}</td>
							<td>${elem.cliCelular}</td></tr>`);
				});
			}else{
				$('tbody').append(`<tr><td></td><td>No hay clientes registrados en ésta fecha</td></tr>`);
			}
		});
}

</script>
	</body>
</html>
<?php	
} else{
	echo '<script> window.location="php/cerrarSesion.php"; </script>';
}
?>