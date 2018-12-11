<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<link rel="stylesheet" href="iconfont/material-icons.css"> <!--Iconos en: https://design.google.com/icons/-->
		<title>Consultorio ORL</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/estilos.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/bootstrap-switch.css" rel="stylesheet">
		<link rel="stylesheet" href="css/espera.css">
		
		
	</head>
	<body>
		<div id="overlay">
			<div class="espera"></div>
		</div>
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
			<a class="navbar-brand" href="index.html">Consultorio ORL</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="index.html"><i class="material-icons">home</i></a></li>
				<li class="active"><a href="Cliente.html"><i class="material-icons">group</i> Clientes</a></li>
				<li><a href="ventas.html"><i class="material-icons">monetization_on</i> Economía</a></li>
				<li><a href="reportes.html"><i class="material-icons">attach_file</i> Reportes</a></li>
			</ul>
		 
			<ul class="nav navbar-nav navbar-right">
				<p class="navbar-text" id="horaServer"></p>
				<p class="navbar-text" id="fechaServer"></p>                
			 <form class="navbar-form navbar-left" role="search">
	 
				<div class="input-group">
					<input type="text" class="form-control" id="txtBuscar" placeholder="Buscar">
					<span class="input-group-btn">
						<button type="button" class="btn btn-warning" id="btnBuscar"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
				
			</form>        
				<li><a href="configuraciones.html"><i class="material-icons">settings</i></a></li>
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">fingerprint</i> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#" data-toggle="modal" data-target=".modal-password">Cambiar contraseña</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="#">Cerrar sesión</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
		</div>
	</nav>


	<div class="container">
		<main>
			<div class="page-header">
				<h1>Panel del cliente <small><span class="mayuscula"></span></small></h1>
			</div>
			<div class="alert alert-warning alert-dismissible fade in sr-only" id="mnjClienteRegistrado" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Felicidades!</strong> <span id="texto"></span> </div>
			<div class="alert alert-success alert-dismissible fade in sr-only" id="mnjCitaRegistrada" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Felicidades!</strong> La cita se agregó para <span id="lblMnjCita"></span></div>
			<div class="alert alert-danger alert-dismissible fade in sr-only" id="mnjClienteCitadoHoy" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Ups!</strong>  <span id="lblMnjCita"></span></div>

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="ulTabs" role="tablist">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Información</a></li>
				<li role="presentation" ><a href="#calendar" aria-controls="calendar" role="tab" data-toggle="tab" >Calendario</a></li>
				<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
				<li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade in active" id="home">
					<div class="row"><br>
						<div class="col-sm-3 hidden-print"><div class="panel panel-negro">
						<div class="panel-heading " id="one	" >Acciones permitidas</div>
							<div class="panel-body">
									<div class="btn-group-vertical col-sm-12" role="group" aria-label="...">
									<button type="button" class="btn btn-default btnOpciones" id="btnActualizarDatos"><i class="material-icons">fingerprint</i> Editar datos</button>
									<button type="button" class="btn btn-default btnOpciones" id="crearHistoria"><i class="material-icons">description</i> Crear Historia clínica</button>
									<button type="button" class="btn btn-default btnOpciones" id="imprHistoria"><i class="material-icons">description</i> Ver Historia clínica</button>
									<button type="button" class="btn btn-default btnOpciones disabled" id="btnCrearCita"><i class="material-icons">event_note</i> Crear cita</button>
									<button type="button" class="btn btn-default btnOpciones disabled" id="btnCrearRevaluacion"><i class="material-icons">event_note</i> Crear revaluación</button>
									<button type="button" class="btn btn-default btnOpciones disabled" id="btnCrearProcedimiento"><i class="material-icons">event_note</i> Crear procedimiento</button>
									<button type="button" class="btn btn-danger"  id="btnEliminarCliente">Eliminar cliente</button>
								</div>
							</div></div>
						</div><!--Fin de col-sm-3-->

						<div class="col-sm-6">
						<div class="panel panel-negro">
							<div class="panel-heading"><h4 class="mayuscula" id="lblNombre"></h4></div>
							<div class="panel-body">
									<p><span class="glyphicon glyphicon-tag"></span> <span id="lblHistoria"></span>	<span class="sr-only" id="lblIdCliente"></span></p> 
									<p><span class="glyphicon glyphicon-pushpin"></span> <span class="mayuscula" id="lblOcupacion"></span> con <span id="lblEdad"></span> de edad.</p> 
								<p><span class="glyphicon glyphicon-pushpin"></span> <span class="mayuscula" id="lblEstado"></span></p>
								<p><span class="glyphicon glyphicon-pushpin"></span> Con dirección: <span class="mayuscula" id="lblDireccion"></span> </p>
								<p><span class="glyphicon glyphicon-pushpin"></span> Contacto al Teléfono <span id="lblTelefono"></span> al Celular <span id="lblCelular"></span></p>	
								
							</div>
						</div>					
						</div><!--Fin de col-sm-6-->

						<div class="col-sm-3 hidden-print text-center"><img src="images/man.jpg" alt=""></div>

						
					</div>

					<div class="mover">
						<div class="col-sm-10 col-lg-offset-1">
						<div class="panel panel-cielo">
						<div class="panel-heading">
							<h4>Registro de actividades:</h4>
						</div>
						<div class="panel-body">
							<div class="panel-group" id="listRegistro" role="tablist" aria-multiselectable="true">
								<!-- <a href="#!" class="list-group-item list-group-item-success">
									<p class="list-group-item-text"><strong>Re-evaluación: </strong>30/06/2016 </p>
								</a> -->
							</div>
						</div>
						</div>
						</div>
						
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="calendar" >
					<br><p>Seleccione el día: </p><div class="form-inline">
					<div class="input-group col-sm-3">
					<span class="input-group-btn"><button class="btn btn-default" type="button" id="btnRestarFecha"><span class="glyphicon glyphicon-chevron-down"></span></button></span>
					<input type="date" id="dtpFechaCalendario" class="form-control text-center">
					<span class="input-group-btn"><button class="btn btn-default" type="button" id="btnSumarFecha"><span class="glyphicon glyphicon-chevron-up"></span></button></span>
					</div>
					<label id="lblDiaCalendar">Hoy,</label></div>
					<h2>Turno: mañanas</h2>

					 <table class="table table-bordered tablaCalendario text-center" id="mañana">
						<thead>
							<tr>
							<th class="cabecera encabezado">Hora / minutos</th>
							<th class="col-xs-2 text-center encabezado" data-column='0'>"00</th>
							<th class="col-xs-2 text-center encabezado" data-column='10'>"10</th>
							<th class="col-xs-2 text-center encabezado" data-column='20'>"20</th>
							<th class="col-xs-2 text-center encabezado" data-column='30'>"30</th>
							<th class="col-xs-2 text-center encabezado" data-column='40'>"40</th>
							<th class="col-xs-2 text-center encabezado" data-column='50'>"50</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<th class="text-right encabezado">6 a.m.</th>
								<td data-row='6' data-column='0'></td>
								<td data-row='6' data-column='10'></td>
								<td data-row='6' data-column='20'></td>
								<td data-row='6' data-column='30' disabled></td>
								<td data-row='6' data-column='40'></td>
								<td data-row='6' data-column='50'></td>
							</tr>
							<tr>
							<th class="text-right encabezado">7 a.m.</th>
							<td data-row='7' data-column='0'></td>
							<td data-row='7' data-column='10'></td>
							<td data-row='7' data-column='20'></td>
							<td data-row='7' data-column='30'></td>
							<td data-row='7' data-column='40'></td>
							<td data-row='7' data-column='50'></td>
							</tr>
							<tr>
							<th class="text-right encabezado">8 a.m.</th>
							<td data-row='8' data-column='0'></td>
							<td data-row='8' data-column='10'></td>
							<td data-row='8' data-column='20'></td>
							<td data-row='8' data-column='30'></td>
							<td data-row='8' data-column='40'></td>
							<td data-row='8' data-column='50'></td>
							</tr>
							<tr>
							<th class="text-right encabezado">9 a.m.</th>
							<td data-row='9' data-column='0'></td>
							<td data-row='9' data-column='10'></td>
							<td data-row='9' data-column='20'></td>
							<td data-row='9' data-column='30'></td>
							<td data-row='9' data-column='40'></td>
							<td data-row='9' data-column='50'></td>
							</tr>
							<thead>
							<tr>
								<th class="cabecera encabezado">Hora / minutos</th>
								<th class="col-xs-2 text-center encabezado" data-column='0'>"00</th>
								<th class="col-xs-2 text-center encabezado" data-column='10'>"10</th>
								<th class="col-xs-2 text-center encabezado" data-column='20'>"20</th>
								<th class="col-xs-2 text-center encabezado" data-column='30'>"30</th>
								<th class="col-xs-2 text-center encabezado" data-column='40'>"40</th>
								<th class="col-xs-2 text-center encabezado" data-column='50'>"50</th>
							</tr>
							</thead>
						</tbody>
					</table>
					<h2>Turno: tardes y noches</h2>
					<table class="table table-bordered tablaCalendario text-center" id="tarde">
						<thead>
							<tr>
							<th class="col-xs-1 cabecera encabezado">Hora / minutos</th>
							<th class="col-xs-2 text-center encabezado" data-column='0'>"00</th>
							<th class="col-xs-2 text-center encabezado" data-column='15'>"15</th>
							<th class="col-xs-2 text-center encabezado" data-column='30'>"30</th>
							<th class="col-xs-2 text-center encabezado" data-column='45'>"45</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							<th class="text-right encabezado">10 a.m.</th>
							<td data-row='10' data-column='0'></td>
							<td data-row='10' data-column='15'></td>
							<td name="hola" data-row='10' data-column='30'></td>
							<td data-row='10' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">11 a.m.</th>
							<td data-row='11' data-column='0'></td>
							<td data-row='11' data-column='15'></td>
							<td data-row='11' data-column='30'></td>
							<td data-row='11' data-column='45'></td>

							</tr><tr>
							<th class="text-right encabezado">12 a.m.</th>
							<td data-row='12' data-column='0'></td>
							<td data-row='12' data-column='15'></td>
							<td data-row='12' data-column='30'></td>
							<td data-row='12' data-column='45'></td>

							</tr><tr>
							<th class="text-right encabezado">1 p.m.</th>
							<td data-row='13' data-column='0'></td>
							<td data-row='13' data-column='15'></td>
							<td data-row='13' data-column='30'></td>
							<td data-row='13' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">2 p.m.</th>
							<td data-row='14' data-column='0'></td>
							<td data-row='14' data-column='15'></td>
							<td data-row='14' data-column='30'></td>
							<td data-row='14' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">3 p.m.</th>
							<td data-row='15' data-column='0'></td>
							<td data-row='15' data-column='15'></td>
							<td data-row='15' data-column='30'></td>
							<td data-row='15' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">4 p.m.</th>
							<td data-row='16' data-column='0'></td>
							<td data-row='16' data-column='15'></td>
							<td data-row='16' data-column='30'></td>
							<td data-row='16' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">5 p.m.</th>
							<td data-row='17' data-column='0'></td>
							<td data-row='17' data-column='15'></td>
							<td data-row='17' data-column='30'></td>
							<td data-row='17' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">6 p.m.</th>
							<td data-row='18' data-column='0'></td>
							<td data-row='18' data-column='15'></td>
							<td data-row='18' data-column='30'></td>
							<td data-row='18' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">7 p.m.</th>
							<td data-row='19' data-column='0'></td>
							<td data-row='19' data-column='15'></td>
							<td data-row='19' data-column='30'></td>
							<td data-row='19' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">8 p.m.</th>
							<td data-row='20' data-column='0'></td>
							<td data-row='20' data-column='15'></td>
							<td data-row='20' data-column='30'></td>
							<td data-row='20' data-column='45'></td>
							</tr><tr>
							<th class="text-right encabezado">9 p.m.</th>
							<td data-row='21' data-column='0'></td>
							<td data-row='21' data-column='15'><div class="btn-group contenido"></td>
							<td data-row='21' data-column='30'></td>
							<td data-row='21' data-column='45'></td>
							</tr>
							<thead>
							<tr>
							<th class="col-xs-1 cabecera encabezado">Hora / minutos</th>
							<th class="col-xs-2 text-center encabezado" data-column='0'>"00</th>
							<th class="col-xs-2 text-center encabezado" data-column='15'>"15</th>
							<th class="col-xs-2 text-center encabezado" data-column='30'>"30</th>
							<th class="col-xs-2 text-center encabezado" data-column='45'>"45</th>
							</tr>
						</thead>
						</tbody>
					</table>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="messages">d...</div>
				<div role="tabpanel" class="tab-pane fade" id="settings">...g</div>
			</div>
			
			
			

			
		</main>
		<section>
		 <div class="container">
		 
		 </div>
	</section>

	</div>

	<!--Modal Para ingresar Asignar una consulta-->
	<div class="modal fade" id="modalAsignar" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Asignar horario</h4>
				</div>
				<div class="modal-body">
					<p>¿Desea agregar la cita para la <span id="lblAsignarHoraAMPM"></span><span class="sr-only" id="lblAsignarHoraCompleta"></span>?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary" id="btnAgregarConsultaHorario" data-dismiss="modal">Agregar</button>
				</div>
			</div>
		</div>
	</div>


	<!--Modal Para ingresar motivo de consulta-->
	<div class="modal fade modal-motivo" tabindex=-1 role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<div class="modal-tittle grey-text text-darken-3"><h4>Motivo de la consulta</h4></div>					
			</div>
			<div class="modal-body">
				<div class="form-inline">
					<label>Motivo de la consulta: </label>
					<input class="form-control mayuscula" id="txtMotivo" type="text" placeholder="...ingrese su motivo">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btnGuardarMotivo">Guardar</button>
				
			</div>
		</div>
		</div>
	</div>



	<!--Modal Para ingresar cita-->
	<div class="modal fade modal-cita" tabindex=-1 role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<div class="modal-tittle grey-text text-darken-3"><h4>Crear una nueva cita</h4></div>					
				</div>
				<div class="modal-body">
					<div class="alert alert-danger alert-dismissible fade in sr-only" id="divErrorCita" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Hay un problema!</strong> <span class="mensajeError"></span> </div>
					<div class="container-fluid form-inline">
						<div class="form-group">
							<label>Programar para</label>
							<div class="input-group">
							<input class="form-control" id="txtAsignarDias" type="text" maxlength="2" size="2"  placeholder="...días">
							<span class="input-group-btn">
								<button class="btn btn-default" id="asignarDias" type="button"><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span></button>
							</span>
							</div>
						</div>
						<div class="form-group ">
							<label>Fecha:</label>
							<input class="form-control" id="dtpFechaCita" type="date">
						</div>
						<div class="form-group ">
							<label>Hora:</label>
							<input class="form-control" id="dtpHoraCita" type="time"  step="600">
							<label class="sr-only" id="lblidRegistroUpdate"></label>
						</div>
						<button type="button" class="btn btn-primary" id="btnProgramarCita">Programar</button>
						<button type="button" class="btn btn-success sr-only" id="btnActualizarProgramacionCita">Cambiar</button>
						<table class="container-fluid table table-hover table-condensed" id="tblCitas">
								<thead>
									<tr>
										<th>Hora</th>
										<th class="sr-only">IdPaciente</th>
										<th>Datos del paciente</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="hora">8:00 a.m.</td>
										<td class="id sr-only">1</td>
										<td>Artega Rivera, Rocio</td>
										<td><button class="btn btn-danger btn-sm eliminarCita">Cancelar cita</button>
										<button class="btn btn-success btn-sm" id="btnImprimirCita"><span class="glyphicon glyphicon-print"></span></button></td>
									</tr>
								</tbody>
							</table>
					</div>
					
				</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>	
				
			</div>
		</div>
		</div>
	</div>




	<!--Modal Para ingresar adelanto-->
	<div class="modal fade modal-adelanto" tabindex=-1 role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<div class="modal-tittle grey-text text-darken-3"><h4>Adelantos de parte del cliente</h4></div>					
				</div>
				<div class="modal-body">
					<div class="alert alert-danger alert-dismissible fade in sr-only" id="divErrorPago" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Hay un problema!</strong> <span class="mensajeError"></span> </div>
					<p>Ingrese los campos requeridos</p>
					<div class="container-fluid">
						
						<div class="form-group col-sm-6" lang="en-US"> 
							<label for="txtMontoPagado">Monto pagado S/.:</label>
							<input type="number" class="form-control" id="txtMontoPagado" placeholder="S/. 0.00" min="0" step=".10">
						</div>
						<div class="form-group col-sm-6"> 
							<label for="txtObservacion">Observaciones:</label>
							<input type="text" class="form-control" id="txtObservacion" placeholder="¿Alguna observación?">
						</div>
						<label id="lblidRegistro" class="sr-only"></label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>	
					<button type="button" class="btn btn-primary" id="btnGuardarPago">Guardar</button>
				</div>
			</div>
		</div>
	</div>

	
	<!--Modal Para Modificar Cliente existente-->
	<div class="modal fade modal-actualizarCliente" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle text-primary"><i class="material-icons">contact_mail</i> Actualización de datos cliente</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-warning sr-only" id="mensajeErrorCliente" role="alert"><strong>Alerta! </strong><span id="contenidoErrorCliente"></span></div>
					<div class="row container-fluid form-group">
					
					<div class="col-sm-3">
						<label for="cmbProcedencia">Procedencia:</label>
						<div class="btn-group">
							<select class="form-control btn-primary" id="cmbProcedencia">
								<option value='0'>Lugar de procedencia</option>
							</select>
						</div>
					</div>
					<div class="col-sm-3">
						<label for="cmbTipoPersona">Tipo:</label>
						<select id="cmbTipoPersona" class="form-control">
									<option value="1" select>Mayor de edad</option>
									<option value="2">Menor de edad</option>
									<option value="3">No posee Dni</option>
								</select>
					</div>
					<div class="col-sm-3">
						<label for="txtDni">Documento de Identidad:</label>
							<input type="text" class="form-control" id="txtDni" placeholder="D.N.I." maxlength="8" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
					</div>
					<div class="form-group col-sm-3">
							<label for="chkSexo">Género:</label>
							<input id="chkSexo" type="checkbox" data-off-color="warning" data-off-text="Dama" data-on-text="Varón" checked="false" class="BSswitch">
						</div>
					</div>
					<div class="container-fluid form-inline">						
						<div class="row">
						<div class="form-group col-sm-4">
							<label for="txtApellidoPaterno">Apellido paterno:</label>
							<input type="text" class="form-control mayuscula" id="txtApellidoPaterno" placeholder="Apellido paterno" required size="30" >
						</div>
						<div class="form-group col-sm-4">
							<label for="txtApellidoMaterno">Apellido materno:</label>
							<input type="text" class="form-control mayuscula" id="txtApellidoMaterno" placeholder="Apellido materno" size="30">
						</div>
						<div class="form-group col-sm-4">
							<label for="txtNombres">Nombres:</label>
							<input type="text" class="form-control mayuscula" id="txtNombres" placeholder="Nombres" size="30">
						</div></div><br>
						<div class="row">
						<div class="form-group col-sm-3">
							<label for="dtpFechaNacimiento">Fecha de nacimiento:</label>
							<input type="date" class="form-control " id="dtpFechaNacimiento">
						</div>
						<div class="col-sm-3">
						<label for="cmbEstadoCivil">Estado civil:</label>
							<div class="btn-group">
								<select class="form-control" id="cmbEstadoCivil">
									<option value="0">Estado Civil</option>
								</select>
							</div>
						</div>
						<div class="col-sm-3">
						<label for="cmbGrado">Estudios:</label>
							<div class="btn-group">
								<div class="btn-group">
								<select class="form-control" id="cmbGrado">
									<option value="0">Grado de estudios</option>
								</select>
							</div>
							</div>
						</div>
						<div class="col-sm-3">
							<label for="cmbOcupacion">Ocupación:</label>
							<select id="cmbOcupacion" class="form-control">
								<option value="0">Su ocupación</option>
							</select>
						</div>
						</div><br>
						<div class="row">
							<div class="col-sm-6">
								<label for="txtDireccion">Dirección de domicilio:</label>
								<input type="text" class="form-control mayuscula" id="txtDireccion" placeholder="Dirección de domicilio" size="45">
							</div>
							<div class="col-sm-3">
								<label for="txtTelefono">Teléfono:</label>
								<input type="text" class="form-control " id="txtTelefono" placeholder="Teléfono">
							</div>
							<div class="col-sm-3">
								<label for="txtCelular">Celular:</label>
								<input type="text" class="form-control " id="txtCelular" placeholder="Celular">
							</div>
						</div><br>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-error" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar</button>
						<button type="button" class="btn btn-success" id="btnActualizarCliente"><span class="glyphicon glyphicon-refresh"></span> Actualizar</button>
					</div>
			</div>
		</div></div>
	</div>

	<!--Modal Para eliminar una cita control-->
	<div class="modal fade modal-cancelarCita">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle text-primary">Cancelar cita control</h4>
				</div>
				<div class="modal-body">
					<p>¿Desea eliminar ésta cita control?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-danger" id="btnCancelarCita">Eliminar</button>
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


	<!--Modal Para cambiar contraseña-->
	<div class="modal fade modal-password myPrintArea" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle text-primary">Cambio de contraseña</h4>
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
							<input type="password" class="form-control " id="txtPassAnterior" placeholder="Contraseña nueva">
						</div>
						<div class="form-group col-sm-6">
							<label for="txtPassAnterior">Repita la nueva contraseña:</label>
							<input type="password" class="form-control " id="txtPassAnterior" placeholder="Repita su contraseña">
						</div>
						
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="imprime">Guardar</button>
				</div>
			</div>
		</div>

	</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-2.2.3.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/moment.js"></script>
		<script src="js/mijs.js"></script>
		<script src="js/jquery.PrintArea.js"></script>
		<script src="js/jquery.printPage.js"></script>
		<script src="js/bootstrap-switch.js"></script>
		<script src="./node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
		<script src="./node_modules/moment-precise-range-plugin/moment-precise-range.js"></script>
		<script src="js/socketCliente.js"></script>
		<script>
			var overlay=$('#overlay');
			window.addEventListener('load',function(){
				overlay.css('display','none');
			});
			$(document).ready(function() {
				var idCliente = <?php  
					if(isset($_GET["id"]))	echo $_GET['id'];
					else echo 0;?>;
				console.log(idCliente);
				if(idCliente!=0){//console.log('llamar datos totales');
					$('#lblIdCliente').text(idCliente);
					solicitarDatosClientePanel(idCliente);
					llenadoCmb();
				}
				else{//console.log('redireccionar a panel porque no hay nada');
				$(window).attr('location','Cliente.html')
			}
				var nuevo= <?php  if(isset($_GET["n"]))	echo $_GET["n"];	else echo 0;?>;
				switch(nuevo){
					case 1: $('#mnjClienteRegistrado')
						.addClass('alert-warning')
						.removeClass('alert-info')
						.removeClass('sr-only')
						.find('#texto').html('El cliente fue registrado con éxito.'); break;
					case 2: $('#mnjClienteRegistrado')
						.removeClass('alert-warning')
						.addClass('alert-info')
						.removeClass('sr-only')
						.find('#texto').html('El cliente fue actualizado con éxito.'); break;
					default: $('#mnjClienteRegistrado').addClass('sr-only');
				}
				/*if(nuevo==1){}
				else{}*/
			});
			$("#imprime").click(function () {
				//$(".myPrintArea").removeClass('sr-only');
				$(".myPrintArea").printArea();
				//$(".myPrintArea").addClass('sr-only');
			});
			

			/*$("#btnImprimirCita").printPage({
				url: "imprimirCita.html",
				attr: "href",
				message:"Tu documento está siendo creado"
			});*/
			/*$('#btnCrearReevaluacion').click(function(){
				loadPrintDocument(this,{
					url: "imprimirCita.html",
					attr: "href",
					message:"Tu documento está siendo creado"
				});
			});*/

		</script>
	</body>
</html>