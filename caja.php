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
		<title>Menú: Consultorio ORL</title>
		<link rel="shortcut icon" href="images/favicon.png">

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/sticky-footer.css" rel="stylesheet">
		<link href="css/estilos.css?version=1.2.8" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/bootstrap-datepicker3.css" rel="stylesheet">
		
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
		
		hr{ margin-bottom: 5px;}
		h3{ margin-top: 5px;}
		.pheader{background-color: #a35bb4;padding: 10px 10px; color: white; font-size: 17px; display: block; 
	clear: left; }
			
		table{color:#5f5f5f;}
		
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
			<a class="navbar-brand" href="index.php"><img src="images/logoTransparente.png"  height="50"  alt=""></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="navbar-colapsador">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><i class="material-icons">home</i></a></li>
				<li><a href="Cliente.php"><i class="material-icons">group</i> Clientes</a></li>
				<li dropdown><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">monetization_on</i> Economía <span class="caret"></span></a>
					<ul class="dropdown-menu animated fadeIn">
						<li><a href="#" id="ingresoExterno"><span class="glyphicon glyphicon-plus"></span> Ingreso externo</a></li>
						<li><a href="#" id="egresoExterno"><span class="glyphicon glyphicon-minus"></span> Gasto externo</a></li>
					</ul>
				</li>
				<li class="active" dropdown><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">attach_file</i> Reportes <span class="caret"></span></a>
					<ul class="dropdown-menu animated fadeIn">
						<li><a href="cuadrecaja.php" id="ingresoExterno"><span class="glyphicon glyphicon-piggy-bank"></span> Cuadre de caja</a></li>
					</ul>
				</li>
			</ul>
		 
			<ul class="nav navbar-nav navbar-right">
				
			 <form class="navbar-form navbar-left hidden-xs hidden-sm" role="search">
	 
				<div class="input-group">
					<input type="text" class="form-control" id="txtBuscar" placeholder="Buscar">
					<span class="input-group-btn" >
						<button type="button" class="btn btn-amarillo btn-outline" id="btnBuscar"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
				
			</form>        
				<li><a href="configuraciones.html"><i class="material-icons">settings</i></a></li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">fingerprint</i> <span class="caret"></span></a>
					<ul class="dropdown-menu animated fadeIn">
						<li><a href="#" data-toggle="modal" data-target=".modal-password"><span class="glyphicon glyphicon-cog"></span> Cambiar contraseña</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="php/cerrarSesion.php"><span class="glyphicon glyphicon-send"></span> Cerrar sesión</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
		</div>
	</nav>

	<div class="container conPrincipal noselect">
		<main>
			<div class="container hidden-md hidden-lg">
				<div class="input-group" style="margin-top: 10px;">
					<input type="text" class="form-control" id="txtBuscarMini" placeholder="Buscar por: Nombre, Dni, N° Historia" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-negro" id="btnBuscarMini"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row col-sm-7"><h3 class="purple-text" style="margin-top: 21px;"><span class="glyphicon glyphicon-piggy-bank"></span> Cierre de caja </h3></div> 
			</div>
			<div class="container-fluid">
				<div class="col-xs-12 col-sm-8">
					<p class="pheader">Datos de Cuadre</p>
				
				
				<div class="panel panel-default ">
					<div style="padding: 10px;">
						<p style="color: #a35bb4;">Código de Caja: #<strong>850</strong></p>
						<p style="color: #a35bb4;">Por: <strong>Pariona Valencia Carlos Alex</strong></p>
						<p style="color: #a35bb4;">Fecha: <strong>Miércoles 14 de Febrero de 2018. 07:57 p.m.</strong></p>
					</div>
				</div>  
				</div>
				<div class="col-xs-12 col-sm-4">
					<p style="color: #a35bb4;">Seleccione fecha de reporte:</p>
					<div class="sandbox-container"><input id="dtpFechaInicio" type="text" class="form-control text-center inputConIco" placeholder="" style="color: #a35bb4;" autocomplete="off"> <span class="icoTransparent"><i class="icofont icofont-caret-down"></i></span></div>
					<div style="margin-top: 10px;">
						<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Seleccione turno <span class="caret"></span>
						</button>
						<ul class="dropdown-menu animated fadeIn" style="margin-top: 36px;">
							<li><a href="#">Cierre 11:50 a.m. </a></li>
							<li><a href="#">Cierre 8:50 p.m.</a></li>
						</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid">
				<p class="pheader col-xs-6">Clientes atentidos</p>
				<div class=" panel panel-default  ">
					<table class="table table-hover">
					<thead> 
						<tr> <th># HC</th> <th>Procedencia</th> <th>Datos de Cliente</th> <th>Razón <i class="icofont icofont-long-arrow-right"></i> Usuario</th> <th>Cantidad</th> </tr> </thead>
					<tbody>
						<tr> <th scope="row">023003</th> <td>Particular</td> <td>Pariona Valencia, Carlos Alex</td> <td>Consulta <i class="icofont icofont-long-arrow-right"></i> <em>cacuña</em></td> <td>S/. 60.00</td>
						<tr> <th scope="row">039485</th> <td>Puno</td> <td>Chumbe Villanueva, Patricia</td> <td>Consulta <i class="icofont icofont-long-arrow-right"></i> <em>cacuña</em></td> <td>S/. 60.00</td>
						<tr> <th scope="row">039484</th> <td>Particular</td> <td>De La Cruz Cardenas, Erick</td> <td>Rinoplastía <i class="icofont icofont-long-arrow-right"></i> <em>cacuña</em></td> <td>S/. 2600.00</td>
						<tr> <th scope="row">039483</th> <td>Particular</td> <td>Arauco Casas, Emma Elsa</td> <td>Consulta <i class="icofont icofont-long-arrow-right"></i> <em>cacuña</em></td> <td>S/. 50.00</td>
						<tr> <th scope="row">039482</th> <td>Particular</td> <td>Alvarado Yupanqui, Fernando</td> <td>Consulta <i class="icofont icofont-long-arrow-right"></i> <em>cacuña</em></td> <td>S/. 60.00</td>
						<tr> <th scope="row"></th> <td></td> <td>Certificado médico</td> <td><i class="icofont icofont-long-arrow-right"></i> <em>cacuña</em></td> <td>S/. 25.00</td>
						<tr> <th scope="row"></th> <td></td> <td>Vacuna</td> <td><i class="icofont icofont-long-arrow-right"></i> <em>cacuña</em></td> <td>S/. 30.00</td>
						<tr> <th scope="row"  style="border-top: transparent;"></th> <td style="border-top: transparent;"></td> <td style="border-top: transparent;"></td> <td class="text-center" style="border-top: 1px solid #989898; color: #636363"><strong >Total</strong></td> <td style="border-top: 1px solid #989898; color: #636363"><strong>S/. 2885.00</strong></td>
					</tbody> </table>
				</div>
			</div>
			<div class="container-fluid col-xs-6">
				<h4 class="pheader">Entradas de dinero</h4>
				<div class=" panel panel-default  ">
					<table class="table table-hover">  <thead> <tr> <th>#</th> <th>Motivo de ingreso</th> <th>Usuario</th> <th>Cantidad</th> </tr> </thead>
					<tbody>
						<tr> <th scope="row"></th> <td>No hay ingresos</td> <td></td><td></td><tr>
						<tr> <th scope="row"  style="border-top: transparent;"></th>  <td style="border-top: transparent;"></td> <td class="text-center" style="border-top: 1px solid #989898; color: #636363"><strong >Total</strong></td> <td style="border-top: 1px solid #989898; color: #636363"><strong>S/. 0.00</strong></td>
					</tbody> </table>
				</div>
			</div>
			<div class="container-fluid col-xs-6">
				<h4 class="pheader">Salidas de dinero</h4>
				<div class=" panel panel-default  ">
					<table class="table">  <thead> <tr> <th>#</th> <th>First Name</th> <th>Last Name</th> <th>Username</th> </tr> </thead> <tbody> <tr> <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr> <tr> <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr> <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr> </tbody> </table>
				</div>
			</div>
			<div class="container-fluid col-xs-12 text-center">
				<h4 class="pheader">Efectivo total del día:</h4>
			</div>
		</main>
		
	</div>
	<?php include "piePagina.php"; ?>
	

	


	<!--Modal Para mostrar los resultados de la búsqueda-->
	<div class="modal fade modal-resultadosBusqueda noselect" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header-warning">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle">Resultados de la búsqueda</h4>
				</div>
				<div class="modal-body">
					<p>Se encontró <strong></strong> coincidencias</p>
					<table class="table table-condensed tablita">
						<thead>
							<tr>
								<th>#</th>
								<th>N° Historia</th>
								<th>Nombres</th>
								<th>Edad</th>
								<th>@</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Mark</td>
								<td>Otto</td>
								<td class="hidden">0003</td>
								<td><a class="btn btn-sm btn-success" href="#" role="button">Ver <span class="glyphicon glyphicon-user"></span></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<!--Modal Para ingresar monto externo-->
	<div class="modal fade modal-ingreso noselect" tabindex=-1 role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<div class="modal-tittle text-primary"><h4>Ingreso de soles a caja</h4></div>                   
				</div>
				<div class="modal-body">
					<div class="alert alert-danger alert-dismissible fade in sr-only" id="divErrorPago" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Hay un problema!</strong> <span class="mensajeError"></span> </div>
					<p>¿Cuánto ingresa a caja y por qué motivo?</p>
					<div class="container-fluid">
						
						<div class="form-group col-sm-6" lang="en-US"> 
							<label for="txtMontoPagado">Monto ingresando (S/.):</label>
							<input type="number" class="form-control" id="txtMontoPagado" placeholder="S/. 0.00" min="0" step=".10">
						</div>
						<div class="form-group col-sm-6"> 
							<strong><span for="txtObservacion">Motivo:</span></strong>
							<input type="text" class="form-control mayuscula" id="txtMotivo" placeholder="¿Por qué motivo?">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-outline" data-dismiss="modal"><i class="icofont icofont-error"></i> Cerrar</button>    
					<button type="button" class="btn btn-azul btn-outline" id="btnGuardarIngreso"><i class="icofont icofont-diskette"></i> Guardar</button>
				</div>
			</div>
		</div>
	</div>







	<!--Modal Para cambiar contraseña-->
	<div class="modal fade modal-password myPrintArea" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle text-primary"><i class="material-icons">https</i> Cambio de contraseña</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger alert-dismissible fade in sr-only" id="mnjClienteRegistrado" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Error!</strong> <span id="texto"></span> </div>
					<p>Ingrese las contraseñas a cambiar</p>
					<div class="row container-fluid">
						<div class="form-group col-sm-6">
							<label for="txtPassAnterior ">Contraseña anterior:</label>
							<input type="password" class="form-control " id="txtPassAnterior" placeholder="Contraseña anterior">
						</div>
						<div class="form-group col-sm-6">
							<label for="txtPassAnterior">Nueva contraseña:</label>
							<input type="password" class="form-control " id="txtPassNuevo" placeholder="Contraseña nueva">
						</div>
						<div class="form-group col-sm-6">
							<label for="txtPassAnterior">Repita la nueva contraseña:</label>
							<input type="password" class="form-control " id="txtPassReNuevo" placeholder="Repita su contraseña">
						</div>
						
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" id="guardarContraseña" class="btn btn-primary">Guardar</button>
				</div>
			</div>
		</div>
	</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-2.2.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/moment.js"></script>
<!-- <script src="./node_modules/socket.io-client/dist/socket.io.js"></script>  -->
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/bootstrap-datepicker.es.min.js"></script>
<script src="js/mijs.js?version=1.0.14"></script>
<script src="js/socketCliente.js?version=1.0.6"></script>
<script src="js/moment-precise-range.js"></script>


<script>
	listadoDatosUsuario();

</script>
	</body>
</html>
<?php   
} else{
	echo '<script> window.location="php/cerrarSesion.php"; </script>';
}
?>