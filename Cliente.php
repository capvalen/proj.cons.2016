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
		<link href="css/estilos.css?version=1.1" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/bootstrap-switch.css" rel="stylesheet">
		<link href="css/icofont.css" rel="stylesheet">

	</head>
	<body>
	<style>
		body{
			background-color: #383a42;
		}
		.conPrincipal{background-color: #fdfdfd;
			border-radius: 9px;
			margin-top: 20px;
		-webkit-box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);
		box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);}
		footer{margin-top: 133px;}
		.xs4Datos{background-color: #fff;
			color: #ffbf01;
			border: 1px solid #ddd;border-radius: 4px;
			-webkit-transition: border .2s ease-in-out;
			o-transition: border .2s ease-in-out; cursor: default;
			padding-bottom:5px; margin-bottom: 15px;
			transition: all 0.6s;}
		.xs4Datos:hover{
			background-color: #f3f3f3;
			color: #FF5722;font-weight: 700;
			transition: all 0.6s;

		}
		.tablita{color: #888;}
		hr{ margin-bottom: 5px;}
		h3{ margin-top: 5px;}
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
			<a class="navbar-brand" href="index.php"><img src="images/logoMini.png" alt=""></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><i class="material-icons">home</i></a></li>
				<li class="active"><a href="Cliente.php"><i class="material-icons">group</i> Clientes</a></li>
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
						<button type="button" class="btn btn-negro" id="btnBuscar"><span class="glyphicon glyphicon-search"></span></button>
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

	<div class="container conPrincipal">
		<main>
			<div class="container hidden-md hidden-lg">
				<div class="input-group" style="margin-top: 10px;">
					<input type="text" class="form-control" id="txtBuscarMini" placeholder="Buscar por: Nombre, Dni, N° Historia" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-negro" id="btnBuscarMini"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
			<div class="row col-sm-7"><h2 style="margin-top: 21px;"><span class="glyphicon glyphicon-th-list"></span> Panel de control <small>Clientes</small></h2></div>
			<div class="row col-sm-5 text-center"><br><small class="text-muted" id="horaServer"></small>, <small class="text-muted" id="fechaServer"></small> <p><small class="text-muted" >Usuario:</small> <small class="text-primary"><?php echo $_SESSION['usuario'] ;?></small></p></div><br>
			<div class="row page-header ">
			</div>
				<div class="row">
					<div class="col-xs-4 text-center" id="divx4Nuevos"><div class="xs4Datos"><h3 id="h3txtNuevos"></h3><p>Nuevos</p></div></div>
					<div class="col-xs-4 text-center" id="divx4Revaluados"><div class="xs4Datos"><h3 id="h3txtRevaluados"></h3><p>Revaluados</p></div></div>
					<div class="col-xs-4 text-center" id="divx4Procedimientos"><div class="xs4Datos"><h3 id="h3txtProcedimientos"></h3><p>Procedimientos</p></div></div>
				</div>

				<div class="row ">
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail text-center" id="thumNuevoCliente"><br>
							<a  class="btn deep-purple white-text btn-circle-grande right"  id="btnNuevoCliente" border="0" ><i class="material-icons icono-grande">contact_mail</i></a>
							<div class="caption"><hr>
								<h3 class="indigo-text">Nuevo cliente</h3>
								<p class="indigo-text">Inserte un nuevo cliente que viene por primera vez.</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail text-center" id="thumListarPacientes"><br>							
							<a href="ClienteLista.php" class="btn light-green  white-text btn-circle-grande right"><i class="material-icons icono-grande">group</i></a>
							<div class="caption"><hr>
								<h3 class="indigo-text">Listar pacientes</h3>
								<p class="indigo-text">Liste los pacientes programados para el día hoy.</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail text-center" id="thumListarUltimos"><br>							
							<a href="#" id="alistarUltimos" class="btn blue darken-1  white-text btn-circle-grande right"><i class="material-icons icono-grande">dns</i></a>
							<div class="caption"><hr>
								<h3 class="indigo-text">Últimos pacientes registrados</h3>
								<p class="indigo-text">Puede ver los 15 últimos pacientes registrados.</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail text-center" id="thumCrearHospiral"><br>							
							<a href="#" id="alistarUltimos" class="btn amber darken-1  white-text btn-circle-grande right"><i class="material-icons icono-grande">location_city</i></a>
							<div class="caption"><hr>
								<h3 class="indigo-text">Crear una nueva procedencia</h3>
								<p class="indigo-text">Puede crear un nuevo módulo de tienda.</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail text-center" id="thumCrearUsuario"><br>							
							<a href="#" id="alistarUltimos" class="btn pink darken-1  white-text btn-circle-grande right"><i class="material-icons icono-grande">person_add</i></a>
							<div class="caption"><hr>
								<h3 class="indigo-text">Crear un nuevo usuario</h3>
								<p class="indigo-text">Ud. puede crear un nuevo usuario para nuevos personales.</p>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-4 hidden">
						<div class="thumbnail text-center" id="thumResumenHoy"><br>							
							<a href="#" id="alistarUltimos" class="btn red darken-1  white-text btn-circle-grande right"><i class="material-icons icono-grande">transfer_within_a_station</i></a>
							<div class="caption"><hr>
								<h3 class="indigo-text">Resumen pacientes para hoy</h3>
								<p class="indigo-text">Ud. puede ver todos los pacientes nuevos el día de hoy.</p>
							</div>
						</div>
					</div>

				</div>
		</main>
		
	</div>
	<?php include "piePagina.php"; ?>
	

	<!--Modal Para Ingresar nuevo cliente-->
	<div class="modal fade modal-nuevoCliente" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header-success">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle"><i class="icofont icofont-ui-love-add"></i> Registro de nuevo cliente</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-warning sr-only" id="mensajeErrorCliente" role="alert"><strong><i class="icofont icofont-ui-text-chat"></i> Alerta! </strong><span id="contenidoErrorCliente"></span></div>
					<div class="row container-fluid form-group">
					
					<div class="col-sm-4 col-lg-3">
						<label for="cmbProcedencia">Procedencia:</label>
						 <div class="btn-group">
							<select class="form-control btn-success mayuscula" id="cmbProcedencia">
								<option value='0'>Lugar de procedencia</option>
								<?php 

									// Llenado por php
									mysql_query("set charset utf8;");
									$log = mysql_query("call listarProcedencia();");
									while($row = mysql_fetch_array($log))
										{
										echo'<option class="mayuscula" value="'.$row['idProcedencia'].'">'.$row['prodDetalle'].'</option>';
										}
								?>
							</select>
						</div> 
					</div>
					<div class="col-sm-4 col-lg-3">
						<label for="cmbTipoPersona">Tipo:</label>
						<select id="cmbTipoPersona" class="form-control">
									<option value="1" select>Mayor de edad</option>
									<option value="2">Menor de edad</option>
									<option value="3">No posee Dni</option>
								</select>
					</div>
					<div class="col-sm-4 col-lg-3">
						<label for="txtDni">Documento de Identidad:</label>
							<input type="text" class="form-control" id="txtDni" placeholder="D.N.I." maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
					</div>
					<div class="form-group col-sm-4 col-lg-3">
							<label for="chkSexo">Género:</label>
							<input id="chkSexo" type="checkbox" data-off-color="warning"  data-off-text="Dama" data-on-text="Varón" checked="false" class="BSswitch">
						</div>
					</div>
					<div class="container-fluid form-inline">						
						<div class="row">
						<div class="form-group col-sm-6 col-lg-4">
							<label for="txtApellidoPaterno">Apellido paterno:</label>
							<input type="text" class="form-control mayuscula" id="txtApellidoPaterno" placeholder="Apellido paterno" required size="30" >
						</div>
						<div class="form-group col-sm-6 col-lg-4">
							<label for="txtApellidoMaterno">Apellido materno:</label>
							<input type="text" class="form-control mayuscula" id="txtApellidoMaterno" placeholder="Apellido materno" size="30">
						</div>
						<div class="form-group col-sm-6 col-lg-4">
							<label for="txtNombres">Nombres:</label>
							<input type="text" class="form-control mayuscula" id="txtNombres" placeholder="Nombres" size="30">
						</div></div><br>
						<div class="row">
						<div class="form-group col-sm-4 col-lg-3">
							<label for="dtpFechaNacimiento">Fecha de nacimiento:</label>
							<input type="date" class="form-control " id="dtpFechaNacimiento">
						</div>
						<div class="col-sm-4 col-lg-2">
						<label for="cmbEstadoCivil">Estado civil:</label>
							<div class="btn-group">
								<select class="form-control mayuscula" id="cmbEstadoCivil">
									<option value="0">Estado Civil</option>
									<?php require('php/listarEstadoCivil.php'); ?>
								</select>
							</div>
						</div>
						<div class="col-sm-4 col-lg-3">
						<label for="cmbGrado">Grado de estudios:</label>
							<div class="btn-group">
								<div class="btn-group">
								<select class="form-control mayuscula" id="cmbGrado">
									<option value="0">Grado de estudios</option>
									<?php require('php/listarGrado.php'); ?>
								</select>
							</div>
							</div>
						</div>
						<div class="col-sm-4 col-lg-3">
							<label for="cmbOcupacion">Ocupación:</label>
							<select class="form-control mayuscula" id="cmbOcupacion" >
								<option value="0">Su ocupación</option>
								<?php require('php/listarOcupacion.php'); ?>
							</select>
						</div>
						</div><br>
						<div class="row">
							<div class="col-sm-6">
								<label for="txtDireccion">Dirección de domicilio:</label>
								<input type="text" class="form-control mayuscula" id="txtDireccion" placeholder="Dirección de domicilio" size="45">
							</div>
							<div class="col-sm-4 col-lg-3">
								<label for="txtTelefono">Teléfono:</label>
								<input type="text" class="form-control " id="txtTelefono" placeholder="Teléfono">
							</div>
							<div class="col-sm-4 col-lg-3">
								<label for="txtCelular">Celular:</label>
								<input type="text" class="form-control " id="txtCelular" placeholder="Celular">
							</div>
						</div><br>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger btn-outline btn-error pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cerrar ventana</button>
						<button type="button" class="btn btn-success btn-outline" id="btnGuardarCliente"><i class="icofont icofont-folder-open"></i> Guardar cliente</button>
					</div>
			</div>
		</div>
	</div></div>


	<!--Modal Para listar los últimos registrados-->
	<div class="modal fade modal-ultimosRegistrados" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header-morado">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle"><i class="icofont icofont-server"></i> Últimos 15 clientes registrados</h4>
				</div>
				<div class="modal-body">
					<table class="table table-condensed tablita">
						<thead>
							<tr>
								<th>#</th>
								<th>N° Historia</th>
								<th>Nombres</th>
								<th>Hace</th>
								<th>@</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<!--Modal Para mostrar los resultados de la búsqueda-->
	<div class="modal fade modal-resultadosBusqueda" tabindex="-1" role="dialog">
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
	<div class="modal fade modal-ingreso" tabindex=-1 role="dialog">
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
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>	
					<button type="button" class="btn btn-primary" id="btnGuardarIngreso">Guardar</button>
				</div>
			</div>
		</div>
	</div>

		<!--Modal Para ingresar monto externo-->
	<div class="modal fade modal-SinPrivilegios" tabindex=-1 role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header-danger">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4>No hay privilegios</h4>				
				</div>
				<div class="modal-body">
					<p>Lo sentimos, no posees los privilegios para acceder a éste módulo</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="icofont icofont-close"></i> Ok</button>	
				</div>
			</div>
		</div>
	</div>


	<!--Modal Para resumir los pacientes de hoy-->
	<div class="modal fade modal-ResumirPacientes" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle text-primary"><i class="icofont icofont-flag"></i> Resumen para hoy</h4>
				</div>
				<div class="modal-body">
					<p>Tiene <strong class="text-primary" id="spanCantResumen">0</strong> pacientes por «<strong class="text-primary" id="spanTipoResumen">Consultas</strong>»</p>
					<table class="table table-condensed tablita">
						<thead>
							<tr>
								<th>N° Historia</th>
								<th>Nombre del Cliente</th>
								<th>Tipo</th>
								<th>Hora</th>
								<th>@</th>
							</tr>
						</thead>
						<tbody id="divResultadoDatosCompendio">
						</tbody>
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-morado btn-outline" data-dismiss="modal"><i class="icofont icofont-social-meetme"></i> Ok</button>
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
		<script src="js/mijs.js"></script>
		<script src="js/moment.js"></script>
		<!-- <script src="./node_modules/socket.io-client/dist/socket.io.js"></script>  -->
		<script src="js/moment-precise-range.js"></script> 
		<script src="js/socketCliente.js?version=1.0.5"></script>
		<script src="js/bootstrap-switch.js"></script>
	
		
		<script>
			listadoDatosUsuario();
			$.ajax({url: 'php/listarContadorResumen.php', type: 'POST', data: {dia: moment().format('YYYY-MM-DD')}}).done(function (resp) {
				//console.log(resp)
				var valores=JSON.parse(resp);
				if(valores.sumaConsultas==null ){$('#h3txtNuevos').text(0)}else{$('#h3txtNuevos').text(valores.sumaConsultas)}
				if(valores.sumaRevaluados==null ){$('#h3txtRevaluados').text(0)}else{$('#h3txtRevaluados').text(valores.sumaRevaluados)}
				if(valores.sumaRevaluados==null ){$('#h3txtProcedimientos').text(0)}else{$('#h3txtProcedimientos').text(valores.sumaRevaluados)}
			});
			
			
			$('.mitooltip').tooltip();
			$('.BSswitch').bootstrapSwitch('state', true);

			$('#thumNuevoCliente').click(function () {
				llamadoNuevoRegistroClientePorModal();
			});
			$('#thumListarPacientes').click(function(){
				location.href='ClienteLista.php';
			});
			$('#thumListarUltimos').click(function(){
				//socket.emit('listarUltimosRegistrados');
				listadoUltimosRegistrados();
			});
			$('#thumResumenHoy').click(function(){
				//socket.emit('listarUltimosRegistrados'); 
				listadoPendientesParaHoy(0);
			});
			$('#divx4Nuevos').click(function () { listadoPendientesParaHoy(3); });
			$('#divx4Revaluados').click(function () { listadoPendientesParaHoy(4); });
			$('#divx4Procedimientos').click(function () { listadoPendientesParaHoy(5); });
			$('#thumCrearUsuario').click(function () {
				$('.modal-SinPrivilegios').modal('show');
			})
		</script>
	</body>
</html>
<?php	
} else{
	echo '<script> window.location="php/cerrarSesion.php"; </script>';
}
?>