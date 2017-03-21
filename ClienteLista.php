<?php 
session_start();
include 'php/contServ.php';
if(isset($_SESSION['usuario'])){?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<link rel="stylesheet" href="iconfont/material-icons.css"> <!--Iconos en: https://design.google.com/icons/-->
		<title>Listado: Consultorio ORL</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">    
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/bootstrap-switch.css" rel="stylesheet">
		<link href="css/estilos.css" rel="stylesheet">
		<link href="css/tblListaPacientes.css" rel="stylesheet">
		<link rel="shortcut icon" href="images/favicon.png">
		
	</head>
	<body>
<style>
.btn-outline.active{color: #fff !important;}
.btn-morado .badge{background-color: #704ea7;}
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
					<input type="text" class="form-control " id="txtBuscar" placeholder="Buscar">
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
	<div class="container">
	<div class="container row">
		<main class="hidden-print ">
			<div class="container hidden-md hidden-lg ">
				<div class="input-group">
					<input type="text" class="form-control" id="txtBuscarMini" placeholder="Buscar por: Nombre, Dni, N° Historia" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-negro" id="btnBuscarMini"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
			<div class="row">
				<div class=" col-sm-7 hidden-print"><h3><span class="glyphicon glyphicon-th-list"></span> Panel de control <small>Pacientes programados</small></h3></div>
				<div class="col-sm-5 text-center hidden-print"><br><small class="text-muted" id="horaServer"></small>, <small class="text-muted" id="fechaServer"></small> <p><small class="text-muted" >Usuario:</small> <small class="text-primary"><?php echo $_SESSION['usuario'] ;?></small></p></div>
			</div>

				<div class="center-block col-sm-12 col-lg-11 " style="float: none;">
					<div class="form-inline sr-only hidden-print">
						<label>Listado para fecha: </label>
						<input class="form-control" id="dtpFecha" type="date">
						<a class="btn btn-negro" id="btnlistarFechaDtp"><span class="glyphicon glyphicon-triangle-right"></span></a>
					</div>
					
					<div class="row well hidden-print">
					<div class="row hidden-print">
						<label class="col-lg-2">Fecha a mostrar: </label>
						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-warning mitooltip" type="button" id="btnHoyFecha" data-toggle="tooltip" data-placement="top" title="Mostrar Hoy"><span class="glyphicon glyphicon-modal-window"></span></button>
									<button class="btn btn-negro mitooltip" type="button" id="btnDownFecha" data-toggle="tooltip" data-placement="top" title="Bajar 1 día"><span class="glyphicon glyphicon-chevron-down"></span></button>
								</span>
								<input type="text" class="form-control text-center" id='txtFechaMovible' readonly>
								<span class="input-group-btn">
									<button class="btn btn-negro mitooltip" type="button" id="btnUpFecha" data-toggle="tooltip" data-placement="top" title="Subir 1 día"><span class="glyphicon glyphicon-chevron-up"></span></button></span>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						
					</div>
					<br>
					<div class="form-inline hidden-print">
						<label> Filtrar la lista: </label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-morado  btn-outline active" id="btnFiltroListaTodos">
								<input type="radio" name="options" autocomplete="off" checked> Todos <span class="badge" id="badgeTodos"></span>
							</label>
							<label class="btn btn-morado btn-outline"  id="btnFiltroListaNuevos">
								<input type="radio" name="options" autocomplete="off"> Nuevos <span class="badge" id="badgeNuevos"></span>
							</label>
							<label class="btn btn-morado btn-outline" id="btnFiltroListaRevaluados">
								<input type="radio" name="options" autocomplete="off"> Revaluados <span class="badge" id="badgeRevaluados"></span>
							</label>
							<label class="btn btn-morado btn-outline" id="btnFiltroListaProcedimientos">
								<input type="radio" name="options" autocomplete="off"> Procedimientos <span class="badge" id="badgeProcedimientos"></span>
							</label>
							<label class="btn btn-warning btn-outline" id="btnFiltroListaDia">
								<input type="radio" name="options" autocomplete="off"> Turno día <span class="badge" id="badgeTDia" style="color: #ffffff; background-color: #f0ad4e;"></span>
							</label>
							<label class="btn btn-warning btn-outline" id="btnFiltroListaNoche">
								<input type="radio" name="options" autocomplete="off"> Turno noche <span class="badge" id="badgeTNoche" style="color: #ffffff; background-color: #f0ad4e;"></span>
							</label>
						</div>
					</div>
					</div><br>
					
					<div class="row well hidden-print" id="botonesDoctor">
						<!--<div class="col-sm-4">
							<button type="button" class="btn btn-group-justified btn-danger btnAtencion mitooltip" id="btnAtencionAusente" data-toggle="tooltip" data-placement="top" title="El cliente no se presentó al atención. Tecla «a»"><i class="material-icons">weekend</i> Ausente</button>
							
						</div>
						<div class="col-sm-4">
							<button type="button" class="btn btn-group-justified btn-negro btnAtencion mitooltip" id="btnAtencionIniciar" data-toggle="tooltip" data-placement="top" title="Inicie la atención de los clientes. Tecla «i»"><i class="material-icons">play_arrow</i> Iniciar atención</button>
							<button type="button" class="btn btn-group-justified btn-success btnAtencion mitooltip" id="btnAtencionProximo" data-toggle="tooltip" data-placement="top" title="Llame a su siguiente cliente. Tecla «p»"><i class="material-icons">transfer_within_a_station</i> Próximo</button>
						</div>
						<div class="col-sm-4">
							<button type="button" class="btn btn-group-justified btn-warning btnAtencion mitooltip" id="btnAtencionDetener" data-toggle="tooltip" data-placement="top" title="Pausee, si existe un descanso. Tecla «d»"><i class="material-icons">watch_later</i> Detener atención</button>
						</div>-->
						<div class="row col-sm-6 text-center" id="spansDatosAnt"><h4> <span id="spanTipoConsultaAnterior">Anterior atendido: </span> <span class="text-primary mayuscula" id="spanNombrePacienteAnterior"></span> </span> <a id="botonVerAnteriorPaciente" href="#" class="btn btn-success btn-xs" target="_blank" role="button"><span class="glyphicon glyphicon-eye-open"></span></a></h4></div>
						<div class="row col-sm-6 text-center" id="spansDatos"><h4> <span id="spanTipoConsultaLlamado">En atención: </span> <span class="text-primary mayuscula" id="spanNombrePacienteLlamado"></span> <span class="sr-only" id="idPacListaLlamado"> </h4></div>
					</div>
					<br>

					

			</div>
		</main> 
	</div>
	</div>
	<div class="row">

		<div class="container-fluid  col-sm-8">
			
		<div class="  hidden-print">
			<div class="panel panel-negro" style="margin-left: 10px;">
				<div class="panel-heading">Listado de pacientes</div>
				<div class="panel-body contenedorTablaFinal">
					<table class="table tablita noselect " id="listadoFinal" >
					<thead>
						<tr>
							<th class="text-center"><span class="glyphicon glyphicon-time"></span> Hora</th>
							<th class="text-center">Datos del paciente</th>
							<th class="text-center">Tipo</th>
							<th class="text-center">Origen</th>
							<th class="text-center">Estado</th>
							<th class="text-center">@</th>
						</tr>
					</thead>
					<tbody style="color: #550fa0;">
							
					</tbody>
					</table>
				</div>
			</div>
			
		</div>
		<div class="container "><br>
		<div class="alert alert-info hidden-print">
			<p><strong>Conteo de consultas:</strong> Ud. Tiene <strong id="lblCantAtendidosConsulta"></strong> atendidos y <strong id="lblCantAusentesConsulta"></strong> sin atender.</p>
			<p><strong>Conteo de revaluados:</strong> Ud. Tiene <strong id="lblCantAtendidosRevalua"></strong> atendidos y <strong id="lblCantAusentesRevalua"></strong> sin atender.</p>

		</div>
		</div>
		
	</div>
		
	<div class="container-fluid  col-sm-4  hidden-print " >
		<div class="panel panel-default panel-negro divCompendio  sr-only" style="margin-left: -20px; margin-right: 5px;">
			<div class="panel-heading">Compendio de paciente</div>
			<div class="panel-body">
				<div class="col-xs-6">
					<p><strong class="text-primary">Nombre: </strong> <em  class="text-capitalize" id="emNombre"></em></p>
					<p><strong class="text-primary">Edad: </strong> <em class="text-capitalize" id="emEdad"></em></p>
					<p><strong class="text-primary">Estado civil: </strong> <em class="text-capitalize" id="emCivil"></em></p>
					<p><strong class="text-primary">Grado Instrucción: </strong> <em class="text-capitalize" id="emGrado"></em></p>
					<p><strong class="text-primary">Ocupación: </strong> <em class="text-capitalize" id="emOcupacion"></em></p>
					<p><strong class="text-primary">Procedencia: </strong> <em class="text-capitalize" id="emProcedencia"></em></p>
					<hr style="margin-top: 0px; margin-bottom: 10px;border-top: 1px solid #ccc;">
					<p><strong class="text-primary">Última visita: </strong> <em id="emVisita"></em></p>
					
					<button class="btn btn-warning" data-toggle="modal" data-target=".modal-Receta" ><i class="material-icons">print</i> Crear receta</button>
				</div>
				<div class="col-xs-6"><img class="img-responsive" id="fotoCompendio" src="images/cabecera.png" alt=""></div>
				
				
			</div>
			
			
		</div>
	</div>
	</div>
		<div class="container-fluid  col-sm-6  hidden" >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, inventore, animi, repudiandae voluptatibus reiciendis cum tenetur modi eius veritatis nisi at rem quas corrupti blanditiis nemo consectetur esse. Voluptate, repudiandae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, laboriosam, voluptatem enim aliquam iure consectetur repellendus magnam officiis cum minima consequatur officia laborum repellat eligendi velit dolor fugiat vitae 
	</div>
	
		
		
	<!--Tabla que se muestra solo en la version imprimible-->
	<div class="impresionTablaFinal visible-print-block">
		<div class="text-center"><label >Listado para <span class="impresionFehaMovible"></span></label></div>
			<table class="table tablita table-condensed " id="listadoFinal2">
			<thead>
				<tr>
					<th class="text-center"><span class="glyphicon glyphicon-time"></span> Hora</th>
					<th class="text-center">Datos del paciente</th>
					<th class="text-center">Tipo</th>
					<th class="text-center">Origen</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>


	<!--Modal Para imprimir una receta por paciente-->
	<div class="modal fade modal-Receta" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title text-primary"><span class="glyphicon glyphicon-plus-sign"></span> Ingresar receta al paciente <em>Carlos Pariona</em></h4>
				</div>
				<style>
					.rowDeModal{padding-bottom: 4px;}
				</style>
				<div class="modal-body">
					
					<div class="col-xs-4 text-center">Medicamento</div>
					<div class="col-xs-1 text-center">Cant.</div>
					<div class="col-xs-2 text-center">Dosis</div>
					<div class="col-xs-2 text-center">Present.</div>
					<div class="col-xs-3 text-center">Indicaciones</div>
					
					<div class="row rowDeModal">
						
					<div class="col-xs-4"><textarea class="form-control" rows="2" id="foc" placeholder="Item #1"></textarea></div>
					<div class="col-xs-1"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-3"><textarea class="form-control" rows="2" ></textarea></div>
					</div>

					<div class="row rowDeModal">
					<div class="col-xs-4"><textarea class="form-control" rows="2" placeholder="Item #2"></textarea></div>
					<div class="col-xs-1"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-3"><textarea class="form-control" rows="2" ></textarea></div>
					</div>

					<div class="row rowDeModal">
					<div class="col-xs-4"><textarea class="form-control" rows="2" placeholder="Item #3"></textarea></div>
					<div class="col-xs-1"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-3"><textarea class="form-control" rows="2" ></textarea></div>
					</div>

					<div class="row rowDeModal">
					<div class="col-xs-4"><textarea class="form-control" rows="2" placeholder="Item #4"></textarea></div>
					<div class="col-xs-1"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-3"><textarea class="form-control" rows="2" ></textarea></div>
					</div>

					<div class="row rowDeModal">
					<div class="col-xs-4"><textarea class="form-control" rows="2" placeholder="Item #5"></textarea></div>
					<div class="col-xs-1"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-3"><textarea class="form-control" rows="2" ></textarea></div>
					</div>

					<div class="row rowDeModal">
					<div class="col-xs-4"><textarea class="form-control" rows="2" placeholder="Item #6"></textarea></div>
					<div class="col-xs-1"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-3"><textarea class="form-control" rows="2" ></textarea></div>
					</div>

					<div class="row rowDeModal">
					<div class="col-xs-4"><textarea class="form-control" rows="2" placeholder="Item #7"></textarea></div>
					<div class="col-xs-1"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-3"><textarea class="form-control" rows="2" ></textarea></div>
					</div>

					<div class="row rowDeModal">
					<div class="col-xs-4"><textarea class="form-control" rows="2" placeholder="Item #8"></textarea></div>
					<div class="col-xs-1"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-2"><textarea class="form-control" rows="2" ></textarea></div>
					<div class="col-xs-3"><textarea class="form-control" rows="2" ></textarea></div>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-success" id="btnImprPanelDoc" ><span class="glyphicon glyphicon-print"></span> Imprimir</button>
				</div>
			</div>
		</div>
	</div>

	


	<!--Modal Para mostrar los resultados de la búsqueda-->
	<div class="modal fade modal-resultadosBusqueda" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle text-primary">Resultados de la búsqueda</h4>
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
	

	<!--Modal Para cambiar contraseña-->
	<div class="modal fade modal-password" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle text-primary"><i class="material-icons">https</i> Cambio de contraseña</h4>
				</div>
				<div class="modal-body">
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
	<?php include "piePagina.php"; ?>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-2.2.3.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-switch.js"></script>
		<script src="js/mijs.js"></script>
		<script src="js/jquery.tablesorter.js"></script> <!--Documentación en: http://tablesorter.com/docs/-->
		<script src="js/moment.js"></script>
		
		<script src="js/jquery.stickytableheaders.min.js"></script>
		<script src="js/socketCliente.js"></script>
		<script src="js/jquery.printPage.js"></script>
		<script src="js/moment-precise-range.js"></script>
		<script>

		$(document).ready(function(){
			listadoDatosUsuario();
			$('.mitooltip').tooltip();
			$('[data-toggle="tooltip"]').tooltip();     
			$('#dtpFecha').val(moment().format('YYYY-MM-DD'));
			moment.locale('es');
			$('#txtFechaMovible').val(moment().format('[Hoy,] dddd[,] DD [de] MMMM [de] YYYY'));
			$('.impresionFehaMovible').text(moment().format('[Hoy,] dddd[,] DD [de] MMMM [de] YYYY'));
			
			//$("table").stickyTableHeaders();      
			$("table").stickyTableHeaders({ scrollableArea: $(".contenedorTablaFinal")[0], "fixedOffset": 0 });
			
			//socket.emit('listarCitasXFecha',$('#dtpFecha').val());
			listadoCitasXFecha(moment().format('YYYY-MM-DD'))
			$('html body').animate({scrollTop: 70}, 1000);
			iniciarBotones();

		});

		function listadoCitasXFecha(fecha) {
			$.ajax({url: 'php/listarCitasPorFecha.php', type:'POST', data: { dia: fecha}}).done(function (resp) {
				
				var total=0, nuevos=0, reval=0, proce=0, turno='';
				$('table tbody').empty();
				var dato=JSON.parse(resp);

				console.log(dato);
				total=dato.length;
				dato.map(function(elemento,index){
					//if ($('#dtpFecha').val()==moment().format('YYYY-MM-DD') && usuario.idUsuario==5){
						//codigo de botones que ya no van:
						/*<button class="btn btn-danger btnIcono btnAusente mitooltip" id="${elemento.idregistroMovimientos}" data-toggle="tooltip" data-placement="right" title="Ausente"><i class="material-icons">weekend</i></button>
								<button class="btn btn-success btnIcono btnSiguiente mitooltip" id="${elemento.idregistroMovimientos}" data-toggle="tooltip" data-placement="right" title="Finalizar, siguiente"><i class="material-icons">record_voice_over</i></button>*/
					botones=`
								<button class="btn btn-morado btnIcono btnDetalles mitooltip" id="${elemento.idCliente}" data-toggle="tooltip" data-placement="right" title="Más detalles"><i class="material-icons">person_pin</i></button>`;
					tfecha=moment(elemento.regFecha);
					if(tfecha.hour()<=14){turno='dia'}
					else{turno='noche'}
					
					if(elemento.descripcion=='Consulta'){nuevos++;}
					if(elemento.descripcion=='Revaluación'){reval++;}
					if(elemento.descripcion=='Procedimiento'){proce++;}
					$('table tbody').append(`<tr class="${turno}" id="${elemento.idregistroMovimientos}">
								<th class="hora text-center">${elemento.hora.replace('AM','a.m.').replace('PM','p.m.')}</th>
								<td class="hidden">${moment(elemento.regFecha).format('H.m')}</td>
								<td class="idPacienteEsperaLista hidden">${elemento.idCliente}</td>
								<td class="pendienteNombres mayuscula"><span class="glyphicon glyphicon-flag text-primary"></span> ${elemento.nombres.toLowerCase()}</td>
								<td class="tipo">${elemento.descripcion}</td>
								<td class="turno hidden">${turno}</td>
								<td class="mayuscula">${elemento.prodDetalle.toLowerCase()}</td>
								<td class="estado hidden-print">${elemento.estadoDescripcion}</td>
								<td class="text-center hidden-print">
								${botones}
								</td>
							</tr>`);
					$('.mitooltip').tooltip();
					$('[data-toggle="tooltip"]').tooltip();
				});
				$('.pendienteNombres .glyphicon').hide();
				$('#badgeTodos').text(total);
				$('#badgeNuevos').text(nuevos);
				$('#badgeRevaluados').text(reval);
				$('#badgeProcedimientos').text(proce);
				
				conteoEnLaTabla();
			});
			
		}

			
	

		$('#dtpFecha').change(function(){
			if($('#dtpFecha').val()==moment().format('YYYY-MM-DD')){
				$('#botonesDoctor').show();
			}
			else{$('#botonesDoctor').hide();}
			socket.emit('listarCitasXFecha',$('#dtpFecha').val());
		});
		$('table').on('click','.btnDetalles',function () {
			$(this).tooltip('hide');
			window.location.href =`ClientePanel.php?id=${$(this).attr('id')}`;
		});
		$('table').on('click','.btnSiguiente',function () {
			$(this).tooltip('hide');
		});
		$('table').on('click','.btnAusente',function () {
			$(this).tooltip('hide');
		});
		$('#btnUpFecha').click(function(){
			var nuevaFecha=moment($('#dtpFecha').val(),'YYYY-MM-DD');
			nuevaFecha.add(1,'days');
			$('#dtpFecha').val(nuevaFecha.format('YYYY-MM-DD'));
			$('#txtFechaMovible').val(nuevaFecha.format('dddd[,] DD [de] MMMM [de] YYYY'));
			$('.impresionFehaMovible').text(nuevaFecha.format('dddd[,] DD [de] MMMM [de] YYYY'));
			$('#dtpFecha').change();
		});
		$('#btnDownFecha').click(function(){
			var nuevaFecha=moment($('#dtpFecha').val(),'YYYY-MM-DD');
			nuevaFecha.subtract(1,'days');
			$('#dtpFecha').val(nuevaFecha.format('YYYY-MM-DD'));
			$('#txtFechaMovible').val(nuevaFecha.format('dddd[,] DD [de] MMMM [de] YYYY'));
			$('.impresionFehaMovible').text(nuevaFecha.format('dddd[,] DD [de] MMMM [de] YYYY'));
			$('#dtpFecha').change();
		});
		$('#btnHoyFecha').click(function(){
			var nuevaFecha=moment();
			
			$('#dtpFecha').val(nuevaFecha.format('YYYY-MM-DD'));
			$('#txtFechaMovible').val(nuevaFecha.format('[Hoy,] dddd[,] DD [de] MMMM [de] YYYY'));
			$('.impresionFehaMovible').text(nuevaFecha.format('dddd[,] DD [de] MMMM [de] YYYY'));
			$('#dtpFecha').change();
		});
		$('#listadoFinal').on('dblclick','tr',function(){
			//Para llamar por id a la celda que se hizo click:
			//console.log($(this).attr('id'));
			//Para extraer los nombres de quien se esta llamando actualmente
			//console.log($(this).find('.pendienteNombres ').text());

			if($(this).find('.estado').text()!='Finalizado' && $('#dtpFecha').val()==moment().format('YYYY-MM-DD')){				

				//A continuacion se hace el llamado de los pacientes para el televisor y la actualizacion en las tablas conectadas por socket.
				socket.emit('actualizarEstadoAtencion', $(this).attr('id'), 3);
				socket.emit('iniciaAtencionPacientes',$(this).find('.pendienteNombres ').text(),'',$(this).find('.idPacienteEsperaLista ').text());
				$(this).find('.estado').text('Finalizado');
				conteoEnLaTabla();
			}
			$('.divCompendio').removeClass('sr-only');
			socket.emit('listarConsolidadxCliente', $(this).find('.idPacienteEsperaLista ').text());
			$('.divCompendio').addClass('animated jello').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$('.divCompendio').removeClass('animated jello')
			});;

			
			
		});
		$('#listadoFinal').on('click','.btnAusente',function() {
			var thisAcual=$(this).parent().parent();

			var row_index = thisAcual.index('tr'); //Devuelve el id de la row i+1
			thisAcual.find('.estado').text('Ausente');
			thisAcual.find('.pendienteNombres span').remove();
			thisAcual.removeClass('text-primary');
			thisAcual.removeClass('bg-success');
			thisAcual.find('.btnAusente').remove();
			thisAcual.find('.btnSiguiente').remove();
			encontrarPrimerPendiente();
		});
		$('#listadoFinal').on('click','.btnSiguiente',function() {
			var thisAcual=$(this).parent().parent();

			var row_index = thisAcual.index('tr'); //Devuelve el id de la row i+1
			thisAcual.find('.estado').text('Finalizado');
			thisAcual.find('.pendienteNombres span').remove();
			thisAcual.removeClass('text-primary');
			thisAcual.removeClass('bg-success');
			thisAcual.find('.btnAusente').remove();
			thisAcual.find('.btnSiguiente').remove();
			encontrarPrimerPendiente();
		});
		// socket.on('agregarListaPendientes', function (dato) {
		// 	console.log(dato)
		// 	nfecha = moment(dato.regfecha);
		// 	var cant=0, total=0;

		// 	switch(dato.descripcion){
		// 		case 'Consulta': 
		// 			cant=parseInt($('#badgeNuevos').text())+1;
		// 			total=parseInt($('#badgeTodos').text())+1;
		// 			$('#badgeTodos').text(total); $('#badgeNuevos').text(cant); break;
		// 		case 'Revaluación':
		// 			cant=parseInt($('#badgeRevaluados').text())+1;
		// 			total=parseInt($('#badgeTodos').text())+1;
		// 			$('#badgeTodos').text(total); $('#badgeRevaluados').text(cant); break;
		// 		case 'Procedimiento':
		// 			cant=parseInt($('#badgeProcedimientos').text())+1;
		// 			total=parseInt($('#badgeTodos').text())+1;
		// 			$('#badgeTodos').text(total); $('#badgeProcedimientos').text(cant); break;

		// 	}
			//Estos botones ya no van
			/*<button class="btn btn-danger btnIcono btnAusente mitooltip" id="${dato.idregistroMovimientos}" data-toggle="tooltip" data-placement="right" title="Ausente"><i class="material-icons">weekend</i></button>
							<button class="btn btn-success btnIcono btnSiguiente mitooltip" id="${dato.idregistroMovimientos}" data-toggle="tooltip" data-placement="right" title="Finalizar, siguiente"><i class="material-icons">record_voice_over</i></button>*/
		// 	if($('#dtpFecha').val()==nfecha.format('YYYY-MM-DD')){//las fecha que se muestra en el cliente es igual
		// 		$('table tbody').append(`<tr class="${dato.idregistroMovimientos}">
		// 					<th class="hora text-center">${nfecha.format('hh:mm a').replace('am','a.m.').replace('pm','p.m.')}</th>
		// 					<td class="hidden">${nfecha.format('H.m')}</td>
		// 					<td class="pendienteNombres mayuscula">${dato.nombres.toLowerCase()}</td>
		// 					<td class="tipo">${dato.descripcion}</td>
		// 					<td class="mayuscula">${dato.prodDetalle.toLowerCase()}</td>
		// 					<td class="estado">Pendiente</td>
		// 					<td>
		// 					<button class="btn btn-primary btnIcono btnDetalles mitooltip" id="${dato.idCliente}" data-toggle="tooltip" data-placement="right" title="Más detalles"><i class="material-icons">person_pin</i></button>
		// 					</td>
		// 				</tr>`);

		// 		$("table").tablesorter({sortList: [ [1,0]]}); //{sortList: [[0,0], [1,0]]} ordena la columna 0, luego columna 1
		// 	}
		// 		else{}//console.log('otrro dia')
		// });
		// socket.on('actualizacionDeListaConsultas',function (idReg, fecha){
		// 	$(`.${idReg}`).find('.hora').text(`${moment(fecha).format('hh:mm a').replace('am','a.m.').replace('pm','p.m.')}`);
		// 	$("table").tablesorter({sortList: [[0,0], [1,0]]});
		// });
		function conteoEnLaTabla(){
			var finalizados =0, ausentes=0, revaluaFinalizados=0, revaluaAusentes=0, consuFinalizados=0, consuAusentes=0;
			$('#listadoFinal tbody tr .tipo:contains("Consulta")').each(function (index, element) {
				if($(this).next().next().html()=="Pendiente"){consuAusentes++; $(this).next().next().addClass('text-danger');}
			});
			$('#listadoFinal tbody tr .tipo:contains("Revaluación")').each(function (index, element) {
				if($(this).next().next().html()=="Pendiente"){revaluaAusentes++; $(this).next().next().addClass('text-danger')}
			});
			$('#listadoFinal tbody tr .tipo:contains("Consulta")').each(function (index, element) {
				if($(this).next().next().html()=="Finalizado"){consuFinalizados++; $(this).next().next().removeClass('text-danger').addClass('text-success')}
			});
			$('#listadoFinal tbody tr .tipo:contains("Revaluación")').each(function (index, element) {
				if($(this).next().next().html()=="Finalizado"){revaluaFinalizados++; $(this).next().next().removeClass('text-danger').addClass('text-success')}
			});
			$('#listadoFinal tbody tr .estado:contains("Finalizado")').each(function (index, element) {
				finalizados++;});
			$('#listadoFinal tbody tr .estado:contains("Ausente")').each(function (index, element) {
				ausentes++;});
			$('#lblCantAtendidosConsulta').text(consuFinalizados);
			$('#lblCantAusentesConsulta').text(consuAusentes);
			$('#lblCantAtendidosRevalua').text(revaluaFinalizados);
			$('#lblCantAusentesRevalua').text(revaluaAusentes);
			$('#badgeTDia').text($('#listadoFinal tbody .dia').length);
			$('#badgeTNoche').text($('#listadoFinal tbody .noche').length);			

		}
		// $.registroActualTabla =0;
		// function encontrarPrimerPendiente() {
		// 	var estadoActual='';
		// 	var existeActual=false, existeSiguiente;
		// 	conteoEnLaTabla()

		// 	//if(usuario.tipo==1 && usuario.idUsuario==5){
		// 		//console.log('doctor');
		// 		for (var i = 0; i <= $('#listadoFinal tbody tr').length-1; i++) {
		// 			estadoActual=$('#listadoFinal tbody tr').eq(i).find('.estado').text();
		// 			if(estadoActual=='Pendiente'){existeActual=true;

		// 				$('#listadoFinal tbody tr').removeClass('trActual');

		// 				$('#listadoFinal tbody tr').eq(i).find('.pendienteNombres .glyphicon').show();
		// 				//$('#listadoFinal tbody tr').eq(i).find('.pendienteNombres').prepend('<span class="glyphicon glyphicon-flag"></span> ');
		// 				$('#listadoFinal tbody tr').eq(i).addClass('text-primary');
		// 				$('#listadoFinal tbody tr').eq(i).addClass('bg-success');
		// 				//console.log($('#listadoFinal tbody tr').eq(i).position().top);
		// 				$('html body').animate({scrollTop: 90}, 1000);
		// 				//$('.contenedorTablaFinal').animate({scrollTop: $('#listadoFinal tbody tr').eq(i).position().top-311}, 1000);


						
		// 				if($('#dtpFecha').val()==moment().format('YYYY-MM-DD')){
		// 					$('#spansDatos').show().addClass('animated fadeInLeft');
		// 					switch($('#listadoFinal tbody tr').eq(i).find('.tipo').text()){
		// 						case 'Consulta': $('#spanTipoConsultaLlamado').text('Consulta: ').addClass('text-success');  break;
		// 						case 'Revaluación': $('#spanTipoConsultaLlamado').text('Revaluación: ').addClass('text-warning'); break;
		// 						case 'Procedimiento': $('#spanTipoConsultaLlamado').text('Procedimiento: ').addClass('text-danger'); break;
		// 					}
		// 					$('#spanNombrePacienteLlamado').text($('#listadoFinal tbody tr').eq(i).find('.pendienteNombres').text());
		// 					$('.idPacListaActual').attr('href','ClientePanel.php?id='+$('#listadoFinal tbody tr').eq(i).find('.idPacienteEsperaLista').text());
		// 					$('#listadoFinal tbody tr').eq(i).addClass('trActual');
		// 					$.registroActualTabla=i;

		// 					var container = $('.contenedorTablaFinal'),
		// 					scrollTo =$('.trActual');
		// 					console.log($('.trActual'))
		// 					container.animate({
		// 						scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
		// 					},1000);
							
		// 				socket.emit('iniciaAtencionPacientes',$('#listadoFinal tbody tr').eq(i).find('.pendienteNombres').text(), $('#listadoFinal tbody tr').eq(i+1).find('.pendienteNombres').text());}
		// 				console.log('El primer pendiente se encontro en el paciente #' + (i+1) + ' de nombre: '+ $('#listadoFinal tbody tr').eq(i).find('.pendienteNombres').text());
		// 				console.log('el siguiente paciente es: '+ $('#listadoFinal tbody tr').eq(i+1).find('.pendienteNombres').text());
		// 				break;}
		// 				else{existeActual=false;}

		// 			if(estadoActual=='Finalizado'){
		// 				$('#listadoFinal tbody tr').eq(i).find('.btnAusente').remove();
		// 				$('#listadoFinal tbody tr').eq(i).find('.btnSiguiente').remove();
		// 			}
		// 		}
		// 		if(existeActual==false && $('#dtpFecha').val()==moment().format('YYYY-MM-DD')){socket.emit('iniciaAtencionPacientes','','');}
		// 	//}
			
		// }
		// socket.on('solicitarPacienteDoc',function() {
		// 	encontrarPrimerPendiente();
		// });
		// $('#aCerrarSesion').click(function() {
		// 	if(usuario.tipo==1 && usuario.idUsuario==5){socket.emit('iniciaAtencionPacientes','','');}
			
		// 	location.href = 'php/cerrarSesion.php';
		// });
		// socket.on('siguientePaciente', function(pacienteActual,pacienteSiguiente, idPacienteActual){

		// 	if($('#dtpFecha').val()==moment().format('YYYY-MM-DD')){//si caja de fecha concuerda con el dia de hoy> entonces...

		// 		//Antes de asignar todos los valores, hacemos la extraccion de datos del anterior paciente:
		// 		$('#spanNombrePacienteAnterior').text($('#spanNombrePacienteLlamado').text());
		// 		//$('#idPacListaAnterior').text($('#idPacListaLlamado').text());
		// 		$('#botonVerAnteriorPaciente').attr('href','ClientePanel.php?id='+$('#idPacListaLlamado').text());
				

		// 		//animamos el anterior paciente:
		// 		$('#spansDatosAnt').addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function (){
		// 			$(this).removeClass('animated bounceIn')
		// 		});
		// 		//Animamos el nuevo paciente
		// 		$('#spansDatos').addClass('animated bounceIn').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function (){
		// 			$(this).removeClass('animated bounceIn')
		// 		});
		// 		//rellenamos con los nuevos datos nombre e id Actuales
		// 		$('#spanNombrePacienteLlamado').text(pacienteActual);
		// 		$('#idPacListaLlamado').text(idPacienteActual);

		// 	}
		// });
		function iniciarBotones () {
			/*if(<?php echo $_SESSION['IdUsuario'] ?>!=5){
				$('#botonesDoctor').remove();
			}*/
			$('#btnAtencionAusente').hide();
			$('#btnAtencionProximo').hide();
			$('#btnAtencionDetener').hide();
			//$('#spansDatos').hide();
		}
		$('#btnAtencionIniciar').click(function () {
			$(this).addClass('animated flipOutX').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
				$(this).hide();
				$('#btnAtencionAusente').show().addClass('animated flipInX');
				$('#btnAtencionProximo').show().addClass('animated flipInX');
				$('#btnAtencionDetener').show().addClass('animated flipInX');
				encontrarPrimerPendiente();
			});
		});
		/*$('#btnAtencionAusente').click(function (){
			socket.emit('actualizarEstadoAtencion', $('#listadoFinal tbody tr').eq($.registroActualTabla).attr('id'), 4);
			$('#listadoFinal tbody tr').eq($.registroActualTabla).find('.estado').text('Ausente');
			$('#listadoFinal tbody tr').eq($.registroActualTabla).find('.pendienteNombres span').remove();
			$('#listadoFinal tbody tr').eq($. registroActualTabla).removeClass('text-primary');
			$('#listadoFinal tbody tr').eq($.registroActualTabla).removeClass('bg-success');

			$('#spansDatos').removeClass('animated fadeInLeft').addClass('animated fadeOutRight').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
				$(this).removeClass('animated fadeOutRight').addClass('animated fadeInLeft')});
			encontrarPrimerPendiente();
		});
		$('#btnAtencionProximo').click(function (){
			socket.emit('actualizarEstadoAtencion', $('#listadoFinal tbody tr').eq($.registroActualTabla).attr('id'), 3);
			$('#listadoFinal tbody tr').eq($.registroActualTabla).find('.estado').text('Finalizado');
			$('#listadoFinal tbody tr').eq($.registroActualTabla).find('.pendienteNombres span').remove();
			$('#listadoFinal tbody tr').eq($.registroActualTabla).removeClass('text-primary');
			$('#listadoFinal tbody tr').eq($.registroActualTabla).removeClass('bg-success');

			$('#spansDatos').removeClass('animated fadeInLeft').addClass('animated fadeOutRight').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
				$(this).removeClass('animated fadeOutRight').addClass('animated fadeInLeft')});
			encontrarPrimerPendiente();
		});
		$('#btnAtencionDetener').click(function (){
			socket.emit('iniciaAtencionPacientes','','');
			location.reload();
		});
*/
		$("textarea").focus(function(){	   
		  this.select();
		});
		$('#btnImprPanelDoc').click(function () {
			
			var contador=0;
			var textoURL ='';
			//$('.rowDeModal').find('textarea').each(function(index) {			console.log($(this).val());			});
			var prueba=$('textarea');
			for ( var i = 0;  i <= prueba.length - 1; i++) {
				textoURL+='rc'+i+'="'+prueba.eq(i).val()+'"&';
			}
			/*console.log(prueba.eq(0).val()	);
			console.log(prueba.length	);*/
			console.log(textoURL.substr(0,textoURL.length-1));
			urlImpr='imprimirReceta.php?'+textoURL;
			loadPrintDocument(this,{
				url: urlImpr,
				attr: "href",
				message:"Tu documento está siendo creado"
			});

		});

$('#btnFiltroListaNuevos').click(function(){

	$('#btnFiltroListaTodos').click();
	$('.table>tbody>tr').each(function(index,element){
		if($(element).find('.tipo').html()!='Consulta'){$(element).hide('slow');}
	});
});
$('#btnFiltroListaRevaluados').click(function(){
	$('#btnFiltroListaTodos').click();
	$('.table>tbody>tr').each(function(index,element){
		if($(element).find('.tipo').html()!='Revaluación'){$(element).hide('slow');}
	});
});
$('#btnFiltroListaProcedimientos').click(function(){
	$('#btnFiltroListaTodos').click();
	$('.table>tbody>tr').each(function(index,element){
		if($(element).find('.tipo').html()!='Procedimiento'){$(element).hide('slow');}
	});
});
$('#btnFiltroListaTodos').click(function(){
	$('.table>tbody>tr').each(function(index,element){
			$(element).show('slow');
	});
});
$('#btnFiltroListaDia').click(function(){
	$('#btnFiltroListaTodos').click();
	$('.table>tbody>tr').each(function(index,element){
		if($(element).find('.turno').html()!='dia'){$(element).hide('slow');}
	});
});
$('#btnFiltroListaNoche').click(function(){
	$('#btnFiltroListaTodos').click();
	$('.table>tbody>tr').each(function(index,element){
		if($(element).find('.turno').html()!='noche'){$(element).hide('slow');}
	});
});
		</script>
	</body>
</html>
<?php 
} else{
	echo '<script> window.location="iniciosesion.php"; </script>';
}
?>