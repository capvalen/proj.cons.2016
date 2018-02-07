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
	<title>Paciente: Consultorio ORL</title>
	<link rel="shortcut icon" href="images/favicon.png">

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/sticky-footer.css" rel="stylesheet">
	<link href="css/estilos.css?version=1.2.4" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/bootstrap-switch.css" rel="stylesheet">
	<link rel="stylesheet" href="css/espera.css">
	<link rel="stylesheet" href="css/icofont.css">
	
	
</head>
<body>
 	<div id="overlay">
		<div class="espera"></div>
	</div>
<style>
	body{background-color: #383a42;}
	main{ background-color: #fff;	padding-bottom: 40px;margin-top: 2px; border-radius: 10px;}
	.dropdown-menu-large .disabled > a{color: #999999!important;}
	.dropdown-menu-large > li > ul > li > a {color: #2196F3!important;}
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


<div class="container-fluid" style="margin-top: 10px;">
	<main class=" col-md-10 col-md-offset-1">
		<div class="container hidden-md hidden-lg">
			
			<div class="input-group" style="margin-top: 10px;">
				<input type="text" class="form-control" id="txtBuscarMini" placeholder="Buscar por: Nombre, Dni, N° Historia" >
				<span class="input-group-btn">
					<button type="button" class="btn btn-negro" id="btnBuscarMini"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-8"><h3><span class="glyphicon glyphicon-user"></span> Panel del cliente <small><span class="mayuscula" id="datoClienteTitulo"></span></small></h3></div>
			<div class="col-sm-4 text-center"><br><small class="text-muted" id="horaServer"></small>, <small class="text-muted" id="fechaServer"></small> <p><!-- <small class="text-muted" >Usuario:</small>  --><small class="text-primary"><?php echo $_SESSION['usuario'] ;?></small></p></div><br>
		</div >
		<div class="row" style="margin-right: 45px; margin-left: 45px;">
		<div class="alert alert-warning alert-white rounded alert-dismissible fade in hidden" id="mnjClienteRegistrado" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<div class="icon"><i class="icofont icofont-check-circled"></i></div>
         <strong>Felicidades!</strong> <span id="texto"></span> </div></div>
		<div class="container alert alert-success alert-white rounded alert-dismissible fade in hidden" id="mnjCitaRegistrada" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
		<div class="icon"><i class="icofont icofont-check-circled"></i></div>
         <strong>Felicidades!</strong> La cita se agregó para <span id="lblMnjCita"></span></div>
		
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" id="ulTabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-eye-open"></span> Información</a></li>
			<li role="presentation"><a href="#calendar" aria-controls="calendar" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-calendar"></span> Calendario</a></li>
			<li role="presentation"><a href="#receta" aria-controls="receta" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-plus-sign"></span> Recetar</a></li>
			<li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Comentarios <span class="label label-success" id="lblContarComentarios"></span></a></li>
			<li role="presentation"><a href="#galeria" aria-controls="galeria" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-picture"></span> Galería <span class="label label-success" id="lblContarComentarios"></span></a></li>
			
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active" id="home">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-3 hidden-print">
					<!--<div class="panel panel-default">
					<div class="panel-heading " >Acciones permitidas</div>-->
						<div class="panel-body" id="panel-acciones">
								<div class="btn-group-vertical col-xs-12" role="group" aria-label="...">
								<button type="button" class="btn btn-cielo btn-outline" id="btnActualizarDatos"><i class="icofont icofont-marker"></i> Editar datos</button>
								<button type="button" class="btn btn-cielo btn-outline" id="crearHistoria"><i class="material-icons">description</i> Crear historia clínica</button>
								<button type="button" class="btn btn-cielo btn-outline" id="imprHistoria"><i class="material-icons">description</i> Ver historia clínica</button>
								<button type="button" class="btn btn-cielo btn-outline" id="btnIngresarPagoExtraCliente"><i class="material-icons">attach_money</i> Agregar pagos extras</button>
								<button type="button" class="btn btn-cielo btn-outline disabled" id="btnCrearCita"><i class="material-icons">event_note</i> Crear cita</button>
								<button type="button" class="btn btn-cielo btn-outline disabled" id="btnCrearRevaluacion"><i class="material-icons">enhanced_encryption</i> Crear revaluación</button>
								<button type="button" class="btn btn-cielo btn-outline disabled" id="btnCrearProcedimiento"><i class="material-icons">airline_seat_flat</i> Crear procedimiento</button>
								<!--<button type="button" class="btn btn-danger hidden"  id="btnEliminarCliente">Eliminar cliente</button>-->
							</div>
						</div><!--</div>-->
					</div><!--Fin de col-sm-4-->

					<div class="col-xs-12 col-sm-8  col-md-8">
					<div class="panel panel-cielo" id="panelDatosMid">
						<!--<div class="panel-heading"><h4>Datos del cliente</h4></div>-->
						<div class="panel-body">
							<p><i class="icofont icofont-user-alt-3"></i><strong> Datos del paciente: </strong> <span class="yellow-text text-darken-3 mayuscula" id="lblNombre" style="font-size: 18px;"></span></p>
							<div style="padding-left: 30px">
							<div class="col-sm-6"><p><i class="icofont icofont-heartbeat"></i> <strong>N° de Historia Clínica: </strong><span id="lblHistoria"></span> <span class="sr-only" id="lblIdCliente"></span></p>								
							<p><i class="icofont icofont-finger-print"></i> <strong>D.N.I.: </strong><span class="mayuscula" id="lblDni"></span>.</p>
							<p><i class="icofont icofont-hat-alt"></i> <strong>Grado de Instrucción: </strong><span class="mayuscula" id="lblGrado"></span>.</p>
							<p><i class="icofont icofont-ui-timer"></i> <strong>Edad: </strong><span id="lblEdad"></span>.</p>
							<p><i class="icofont icofont-ui-love"></i> <strong>Estado civil: </strong> <span class="mayuscula" id="lblEstado"></span></p>
							</div>
							<div class="col-sm-6"><p><i class="icofont icofont-ui-clip"></i> <strong>Ocupación: </strong> <span class="mayuscula" id="lblOcupacion"></span></p>
							<p><i class="icofont icofont-home"></i> <strong>Dirección: </strong> <span class="mayuscula" id="lblDireccion"></span> </p>
							<p><i class="icofont icofont-phone"></i><strong>Teléfono</strong> <span id="lblTelefono"></span> <strong>~ Celular</strong> <span id="lblCelular">
							<p><i class="icofont icofont-fast-delivery"></i> <strong>Procedencia: </strong> <span class="mayuscula" id="lblProcedencia"></span></p>
							</span></p></div>
							
							
							</div>
							
						</div>
					</div>          
					</div><!--Fin de col-md-5-->
					
				</div>

				<div class="mover">
					<di class="row">
						<div class="col-md-3 hidden-xs hidden-sm">
						<div class="panel panel-cielo">
							<!-- <div class="panel-heading">Foto</div> -->
							<div class="panel-body text-center ">
								<div id="mi_camara" style="width:100%; height:180px;" class="hidden-print col-sm-9 col-sm-offset-3 col-md-12 col-md-offset-0"><img src="" class="img-responsive" style="width: auto;"><br>
								</div>
								<div class="col-sm-10 col-sm-offset-2 hidden">
									<button class="btn btn-negro btn-outline" id="activarCamara"><span class="glyphicon glyphicon-camera"></span></button>
									<button class="btn btn-primary btn-outline sr-only" id="tomarFoto"><span class="glyphicon glyphicon-picture"></span></button>
									<button class="btn btn-danger btn-outline sr-only" id="cancelarFoto"><span class="glyphicon glyphicon-remove-sign"></span></button>
								</div>
							</div>
						</div>
						</div>

						<div class="col-xs-12 col-md-8 ">
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
					</di>
					
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="calendar" >

				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4">	
						<div class="panel panel-morita">
							<div class="panel-heading"><h4>Saltar días habiles</h4></div>
							<div class="panel-body">
							<div class="row">
								<div class="col-sm-6 col-sm-offset-3 ">
									<input type="date" class='form-control' id="dtpControladorFechasv2">
									<h3 class="input-group-lg"><input type="number" id="txtAdelantarFechav2" class="form-control text-center" min="0" value=0 style="color: #716e70;"></h3>
								</div>
								
							</div>
							<div class="row"><p>
								<div class="text-center">
									<button class="btn btn-primary btn-outline" id="btnSaltarDiasv2"><span class="glyphicon glyphicon-share-alt"></span> Saltar días</button>
								</div></p>
								<p>
								<div class="text-center">
									<button class="btn btn-info btn-outline" id="btnMostrarDiaHoyv2"><span class="glyphicon glyphicon-share-alt"></span> Mostrar el día de hoy</button>
								</div></p>
								
							</div>
							
							</div>

						</div> <!-- Fin de panel -->
						<div class="panel panel-default">
							<div class="panel-body" style="color: #716e70;">
								<div class="container row">
								<p><strong style="color: #a9a9a9;">Resumen para: <span id="spanFechaMiniRepov2" style="color:#6d6c6c;">Lunes, 20 de Julio de 2017</span></strong></p>
								<div class="container">
									<p class="pReevaluacionxPaciente"><span class="glyphicon glyphicon-signal"></span> <span id="spanConteoRevaluacion">0</span> Revaluaciones</p>
									<p class="pNuevoxPaciente"><span class="glyphicon glyphicon-signal"></span> <span id="spanConteoNuevo">0</span> Pacientes nuevos</p>
									<p class="pOperacionxPaciente"><span class="glyphicon glyphicon-signal"></span> <span id="spanConteoOperacion">0</span> Operaciones</p>
								</div>
							</div>
							</div>
						</div>
						</div> <!-- fin de sm-4 -->

						<div class="col-sm-8">
						<div class="panel panel-menta">
							<div class="panel-heading"><h4>Asignar una fecha específica</h4></div>
						</div> <!-- Fin de panel -->


						<table class="table table-bordered">
						<thead>
						  <tr>
							<th><h3><button type="button" class="btn btn-default" id="btnRestarAñov2"><i class="icofont icofont-caret-left"></i></button></h3></th>
							<th id="trParaAño">
								<span class="dropdown dropdown-large">
								<button class="btn btn-lg btn-info dropdown-toggle btn-outline" data-toggle="dropdown" id="btnAñosInfo"><span id="divAñov2"></span> <b class="caret"></b></button>
								<ul class="dropdown-menu dropdown-menu-large row" >
									<li class="col-sm-12">
									<ul>
										<li class="dropdown-header">Elija un año</li>
										<li class="divider"></li>
										<li><a class="aAñov2" href="#" valor="2017">2017</a></li>
										<li><a class="aAñov2" href="#" valor="2018">2018</a></li>
										<li><a class="aAñov2" href="#" valor="2019">2019</a></li>
									</ul>
									</li>
									

								  </ul>
								</span>
							</th>
							<th><h3><button type="button" class="btn btn-default" id="btnSumarAñov2"><i class="icofont icofont-caret-right"></i></button></h3></th>
						  </tr>
						  <tr>
							<th><h3><button type="button" class="btn btn-default" id="btnRestarMesv2"><i class="icofont icofont-caret-left"></i></button></h3></th>
							<th id="trParaMeses">
								<span class="dropdown dropdown-large">
								<button class="btn btn-lg btn-info dropdown-toggle btn-outline" data-toggle="dropdown" id="btnMesesInfo"><span id="divMesv2"></span> <b class="caret"></b></button>
								<ul class="dropdown-menu dropdown-menu-large row">
									<ul>
										<li class="dropdown-header">Seleccione un mes</li>
										<li class="divider"></li>
									</ul>
									<li class="col-sm-6">
									<ul>
										<li><a class="aMesv2" href="#" valor="01">Enero</a></li>
										<li><a class="aMesv2" href="#" valor="02">Febrero</a></li>
										<li><a class="aMesv2" href="#" valor="03">Marzo</a></li>
										<li><a class="aMesv2" href="#" valor="04">Abril</a></li>
										<li><a class="aMesv2" href="#" valor="05">Mayo</a></li>
										<li><a class="aMesv2" href="#" valor="06">Junio</a></li>
										
									</ul>
									</li>
									<li class="col-sm-6">
									<ul>
										<li><a class="aMesv2" href="#" valor="07">Julio</a></li>
										<li><a class="aMesv2" href="#" valor="08">Agosto</a></li>
										<li><a class="aMesv2" href="#" valor="09">Septiembre</a></li>
										<li><a class="aMesv2" href="#" valor="10">Octubre</a></li>
										<li><a class="aMesv2" href="#" valor="11">Noviembre</a></li>
										<li><a class="aMesv2" href="#" valor="12">Diciembre</a></li>
									</ul>
									</li>

								  </ul>
								</span>
							</th>
							<th><h3><button type="button" class="btn btn-default"  id="btnSumarMesv2"><i class="icofont icofont-caret-right"></i></button></h3></th>
						  </tr>
						  <tr>
							<th><h3><button type="button" class="btn btn-default" id="btnRestarDiav2"><i class="icofont icofont-caret-left"></i></button></h3></th>
							<th id="trParaDias">
								<span class="dropdown dropdown-large">
								<button class="btn btn-lg btn-info dropdown-toggle btn-outline" data-toggle="dropdown" id="btnDiasInfo"><span id="divDiav2"></span> <b class="caret"></b></button>
								<ul class="dropdown-menu dropdown-menu-large row">
									<ul>
										<li class="dropdown-header">Seleccione un día</li>
										<li class="divider"></li>
									</ul>
									<li class="col-sm-4 liDeDia">
									<ul id="ulDiaDeMes1al1">
									</ul>
									</li>
									<li class="col-sm-4 liDeDia">
									<ul id="ulDiaDeMes12al23">
									</ul>
									</li>
									<li class="col-sm-4 liDeDia">
									<ul id="ulDiaDeMes23al30">
									</ul>
									</li>

								  </ul>
								</span>
							</th>
							<th><h3><button type="button" class="btn btn-default" id="btnSumarDiav2"><i class="icofont icofont-caret-right"></i></button></h3></th>
						  </tr>
						  <tr>
							<th><h3><button type="button" class="btn btn-default" id="btnRestarHorav2"><i class="icofont icofont-caret-left"></i></button></h3></th>
							<th id="trParaHoras">
								<span class="dropdown dropdown-large">
								<button class="btn btn-lg btn-info dropdown-toggle btn-outline" data-toggle="dropdown" id="btnHorasInfo"><span id="horaDisplayCalendv2"></span> <b class="caret"></b></button><span class="sr-only" id="horaAsignarCalend12v2"></span><span class="sr-only" id="horaAsignarCalend24v2"></span>
								<ul class="dropdown-menu dropdown-menu-large row">
									<ul>
										<li class="dropdown-header">Seleccione un horario</li>
										<li class="divider"></li>
									</ul>
									<li class="col-sm-6">
									<ul>
										<li class="dropdown-header">Mañanas</li>
										<li><a href="#" class="aHorav2" valor='6'>6:00 a.m.</a></li>
										<li><a href="#" class="aHorav2" valor='7'>7:00 a.m.</a></li>
										<li><a href="#" class="aHorav2" valor='8'>8:00 a.m.</a></li>
										<li><a href="#" class="aHorav2" valor='9'>9:00 a.m.</a></li>
										<li><a href="#" class="aHorav2" valor='10'>10:00 a.m.</a></li>
										<li><a href="#" class="aHorav2" valor='11'>11:00 a.m.</a></li>
										<li><a href="#" class="aHorav2" valor='12'>12:00 a.m.</a></li>
									</ul>
									</li>
									<li class="col-sm-6">
									<ul>
										<li class="dropdown-header">Tardes</li>
										<li><a href="#" class="aHorav2" valor='13'>1 p.m.</a></li>
										<li><a href="#" class="aHorav2" valor='14'>2 p.m.</a></li>
										<li><a href="#" class="aHorav2" valor='15'>3 p.m.</a></li>
										<li><a href="#" class="aHorav2" valor='16'>4 p.m.</a></li>
										<li><a href="#" class="aHorav2" valor='17'>5 p.m.</a></li>
										<li><a href="#" class="aHorav2" valor='18'>6 p.m.</a></li>
										<li><a href="#" class="aHorav2" valor='19'>7 p.m.</a></li>
										<li><a href="#" class="aHorav2" valor='20'>8 p.m.</a></li>
										<li><a href="#" class="aHorav2" valor='21'>9 p.m.</a></li>
									</ul>
									</li>

								  </ul>
								</span>
							</th>
							<th><h3><button type="button" class="btn btn-default" id="btnSumarHorav2"><i class="icofont icofont-caret-right"></i></button></h3></th>
						  </tr>
						</thead>
						

					  </table >
						</div>
						<!-- <div class="col-sm-6">
						
						</div> -->
					  </div>
					  <div class="row col-sm-12 hidden" id="divDomingos" style="margin-top:20px">
					<div class="alert alert-warning alert-white rounded alert-dismissible fade in " role="alert"> <div class="icon"><i class="icofont icofont-animal-cat-alt-4"></i></div> <strong>Ups! </strong>  <span id="lblMnjCita">No hay atención por ser: <strong id="spanFeriado"></strong></span></div>
				</div>
					  <div class="row" id="divColexionHorasv2">
						<div class="col-sm-6"><table class="table table-bordered tblHorasVsMin">
					  <thead>
							<tr>
								<th><span class="glyphicon glyphicon-time"></span></th>
								<th>Detalles</th>
							</tr>
						</thead>
						<tbody>
						<tr>
							<td class="tdHoras" valor="0"><span class="horaChangeable">8</span>:00 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="00"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="1"><span class="horaChangeable">8</span>:01 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="01"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="2"><span class="horaChangeable">8</span>:02 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="02"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="3"><span class="horaChangeable">8</span>:03 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="03"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="4"><span class="horaChangeable">8</span>:04 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="04"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="5"><span class="horaChangeable">8</span>:05 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="05"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="6"><span class="horaChangeable">8</span>:06 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="06"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="7"><span class="horaChangeable">8</span>:07 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="07"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="8"><span class="horaChangeable">8</span>:08 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="08"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="9"><span class="horaChangeable">8</span>:09 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="09"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="10"><span class="horaChangeable">8</span>:10 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="10"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="11"><span class="horaChangeable">8</span>:11 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="11"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="12"><span class="horaChangeable">8</span>:12 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="12"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="13"><span class="horaChangeable">8</span>:13 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="13"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="14"><span class="horaChangeable">8</span>:14 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="14"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="15"><span class="horaChangeable">8</span>:15 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="15"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="16"><span class="horaChangeable">8</span>:16 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="16"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="17"><span class="horaChangeable">8</span>:17 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="17"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="18"><span class="horaChangeable">8</span>:18 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="18"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="19"><span class="horaChangeable">8</span>:19 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="19"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="20"><span class="horaChangeable">8</span>:20 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="20"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="21"><span class="horaChangeable">8</span>:21 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="21"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="22"><span class="horaChangeable">8</span>:22 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="22"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="23"><span class="horaChangeable">8</span>:23 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="23"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="24"><span class="horaChangeable">8</span>:24 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="24"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="25"><span class="horaChangeable">8</span>:25 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="25"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="26"><span class="horaChangeable">8</span>:26 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="26"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="27"><span class="horaChangeable">8</span>:27 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="27"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="28"><span class="horaChangeable">8</span>:28 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="28"></td>
						</tr>
						<tr>
							<td class="tdHoras" valor="29"><span class="horaChangeable">8</span>:29 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="29"></td>
						</tr>
					</tbody>
					</table></div>

					<div class="col-sm-6">
					<table class="table table-bordered tblHorasVsMin">
						<thead>
							<tr>
								<th><span class="glyphicon glyphicon-time"></span></th>
								<th>Detalles</th>
							</tr>
						</thead>
						<tbody>
						  <tr>
							<td class="tdHoras" valor="30"><span class="horaChangeable">8</span>:30 <span class="horaAMPM"></span></td>
							<td class="tdDatoCliente" valor="30"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="31"><span class="horaChangeable">8</span>:31 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="31"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="32"><span class="horaChangeable">8</span>:32 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="32"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="33"><span class="horaChangeable">8</span>:33 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="33"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="34"><span class="horaChangeable">8</span>:34 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="34"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="35"><span class="horaChangeable">8</span>:35 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="35"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="36"><span class="horaChangeable">8</span>:36 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="36"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="37"><span class="horaChangeable">8</span>:37 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="37"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="38"><span class="horaChangeable">8</span>:38 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="38"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="39"><span class="horaChangeable">8</span>:39 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="39"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="40"><span class="horaChangeable">8</span>:40 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="40"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="41"><span class="horaChangeable">8</span>:41 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="41"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="42"><span class="horaChangeable">8</span>:42 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="42"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="43"><span class="horaChangeable">8</span>:43 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="43"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="44"><span class="horaChangeable">8</span>:44 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="44"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="45"><span class="horaChangeable">8</span>:45 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="45"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="46"><span class="horaChangeable">8</span>:46 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="46"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="47"><span class="horaChangeable">8</span>:47 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="47"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="48"><span class="horaChangeable">8</span>:48 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="48"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="49"><span class="horaChangeable">8</span>:49 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="49"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="50"><span class="horaChangeable">8</span>:50 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="50"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="51"><span class="horaChangeable">8</span>:51 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="51"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="52"><span class="horaChangeable">8</span>:52 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="52"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="53"><span class="horaChangeable">8</span>:53 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="53"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="54"><span class="horaChangeable">8</span>:54 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="54"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="55"><span class="horaChangeable">8</span>:55 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="55"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="56"><span class="horaChangeable">8</span>:56 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="56"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="57"><span class="horaChangeable">8</span>:57 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="57"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="58"><span class="horaChangeable">8</span>:58 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="58"></td>
							</tr>
							<tr>
								<td class="tdHoras" valor="59"><span class="horaChangeable">8</span>:59 <span class="horaAMPM"></span></td>
								<td class="tdDatoCliente" valor="59"></td>
							</tr>
						  </tbody>
					  </table>
						
					  </div>
					  </div>

				</div>


				
			<div class="container well col-md-9 col-md-offset-1 hidden">
			<label >Planificar para: </label>

			<div class="row">
				<div class="col-xs-12 col-sm-3">
					<div class="input-group">
						<input type="number" class="form-control mitooltip" id='txtAdelantarFecha' placeholder="...días" data-toggle="tooltip" data-placement="bottom" title="Agrega una cantidad n de días hábiles a la fecha de hoy">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="btnAdelantarFecha"><i class="icofont icofont-caret-right"></i></button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-3 -->

				<div class="col-xs-12 col-sm-4">
					<div class="input-group">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="btnRestarFecha"><span class="glyphicon glyphicon-chevron-down"></span></button>
						</span>
						<input type="date" class="form-control text-center" id='dtpFechaCalendario'>
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="btnSumarFecha"><span class="glyphicon glyphicon-chevron-up"></span></button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-3 -->
				<label id="lblDiaCalendar">Hoy,</label>
			</div><br>
			<div class="alert alert-danger alert-white rounded alert-dismissible fade in hidden" id="mnjClienteCitadoHoy" role="alert"> <div class="icon"><i class="icofont icofont-close-circled"></i></div> <strong>Ups!</strong>  <span id="lblMnjCita"></span></div>
		</div>

		<div class="row col-xs-12 col-sm-12 text-center hidden calendLunesaViernes" id="tblControl5min"><h2 style="margin-top: 7px;">Día (Lunes a Viernes)</h2>
			<table class="table table-bordered tablaCalendario text-center" id="mañana5min">
			<thead>
				<tr>
				<th class="cabecera encabezado text-center"><span class="glyphicon glyphicon-time"></span> Horas</th>
				<th class="col-xs-1 text-center encabezado" data-column="0">"0</th>
				<th class="col-xs-1 text-center encabezado" data-column="5">"5</th>
				<th class="col-xs-1 text-center encabezado" data-column="10">"10</th>
				<th class="col-xs-1 text-center encabezado" data-column="15">"15</th>
				<th class="col-xs-1 text-center encabezado" data-column="20">"20</th>
				<th class="col-xs-1 text-center encabezado" data-column="25">"25</th>
				<th class="col-xs-1 text-center encabezado" data-column="30">"30</th>
				<th class="col-xs-1 text-center encabezado" data-column="35">"35</th>
				<th class="col-xs-1 text-center encabezado" data-column="40">"40</th>
				<th class="col-xs-1 text-center encabezado" data-column="45">"45</th>
				<th class="col-xs-1 text-center encabezado" data-column="50">"50</th>
				<th class="col-xs-1 text-center encabezado" data-column="55">"55</th>
				</tr>
			</thead>
			<tbody>
				<tr><th class="text-right encabezado">6 a.m.</th>
				<td data-row="6" data-column="0"></td>
				<td data-row="6" data-column="5"></td><td data-row="6" data-column="10"></td>
				<td data-row="6" data-column="15"></td><td data-row="6" data-column="20"></td>
				<td data-row="6" data-column="25"></td><td data-row="6" data-column="30"></td>
				<td data-row="6" data-column="35"></td><td data-row="6" data-column="40"></td>
				<td data-row="6" data-column="45"></td><td data-row="6" data-column="50"></td>
				<td data-row="6" data-column="55"></td></tr>
				<tr><th class="text-right encabezado">7 a.m.</th>
				<td data-row="7" data-column="0"></td><td data-row="7" data-column="5"></td>
				<td data-row="7" data-column="10"></td><td data-row="7" data-column="15"></td>
				<td data-row="7" data-column="20"></td><td data-row="7" data-column="25"></td>
				<td data-row="7" data-column="30"></td><td data-row="7" data-column="35"></td>
				<td data-row="7" data-column="40"></td><td data-row="7" data-column="45"></td>
				<td data-row="7" data-column="50"></td><td data-row="7" data-column="55"></td></tr>
				<tr><th class="text-right encabezado">8 a.m.</th>
				<td data-row="8" data-column="0"></td><td data-row="8" data-column="5"></td>
				<td data-row="8" data-column="10"></td><td data-row="8" data-column="15"></td>
				<td data-row="8" data-column="20"></td><td data-row="8" data-column="25"></td>
				<td data-row="8" data-column="30"></td><td data-row="8" data-column="35"></td>
				<td data-row="8" data-column="40"></td><td data-row="8" data-column="45"></td>
				<td data-row="8" data-column="50"></td><td data-row="8" data-column="55"></td>
				</tr><tr><th class="text-right encabezado">9 a.m.</th>
				<td data-row="9" data-column="0"></td><td data-row="9" data-column="5"></td>
				<td data-row="9" data-column="10"></td><td data-row="9" data-column="15"></td>
				<td data-row="9" data-column="20"></td><td data-row="9" data-column="25"></td>
				<td data-row="9" data-column="30"></td><td data-row="9" data-column="35"></td>
				<td data-row="9" data-column="40"></td><td data-row="9" data-column="45"></td>
				<td data-row="9" data-column="50"></td><td data-row="9" data-column="55"></td>
				</tr>
			</tbody>
			<thead>
				<tr>
				<th class="cabecera encabezado text-center"><span class="glyphicon glyphicon-time"></span> Horas</th>
				<th class="col-xs-1 encabezado" data-column="0">"0</th>
				<th class="col-xs-1 encabezado" data-column="5">"5</th>
				<th class="col-xs-1 encabezado" data-column="10">"10</th>
				<th class="col-xs-1 encabezado" data-column="15">"15</th>
				<th class="col-xs-1 encabezado" data-column="20">"20</th>
				<th class="col-xs-1 encabezado" data-column="25">"25</th>
				<th class="col-xs-1 encabezado" data-column="30">"30</th>
				<th class="col-xs-1 encabezado" data-column="35">"35</th>
				<th class="col-xs-1 encabezado" data-column="40">"40</th>
				<th class="col-xs-1 encabezado" data-column="45">"45</th>
				<th class="col-xs-1 encabezado" data-column="50">"50</th>
				<th class="col-xs-1 encabezado" data-column="55">"55</th>
				</tr>
			</thead>
			</table>
		</div>
		<div class="row col-sm-12 text-center calendLunesaViernes hidden" id="tblControl10min"><h2>Mañanas (Lunes a Viernes)</h2>
			 <table class="table table-bordered tablaCalendario text-center" id="mañana10min">
				<thead>
					<tr>
					<th class="cabecera encabezado"><span class="glyphicon glyphicon-time"></span> Horas</th>
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
					<td data-row='6' data-column='30'></td>
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
						<th class="cabecera encabezado"><span class="glyphicon glyphicon-time"></span> Horas</th>
						<th class="col-xs-2 text-center encabezado" data-column='0'>"00</th>
						<th class="col-xs-2 text-center encabezado" data-column='10'>"10</th>
						<th class="col-xs-2 text-center encabezado" data-column='20'>"20</th>
						<th class="col-xs-2 text-center encabezado" data-column='30'>"30</th>
						<th class="col-xs-2 text-center encabezado" data-column='40'>"40</th>
						<th class="col-xs-2 text-center encabezado" data-column='50'>"50</th>
					</tr>
					</thead>
				</tbody>
			</table></div>
			
			<div class="row col-sm-12 text-center hidden calendLunesaViernes"><h2>Tardes y Noches (Lunes a Viernes)</h2>
			
			<table class="table table-bordered tablaCalendario text-center" id="tarde">
				<thead>
					<tr>
					<th class="cabecera encabezado text-center"><span class="glyphicon glyphicon-time"></span> Horas</th>
					<th class="col-xs-1 encabezado" data-column="0">"0</th>
					<th class="col-xs-1 encabezado" data-column="5">"5</th>
					<th class="col-xs-1 encabezado" data-column="10">"10</th>
					<th class="col-xs-1 encabezado" data-column="15">"15</th>
					<th class="col-xs-1 encabezado" data-column="20">"20</th>
					<th class="col-xs-1 encabezado" data-column="25">"25</th>
					<th class="col-xs-1 encabezado" data-column="30">"30</th>
					<th class="col-xs-1 encabezado" data-column="35">"35</th>
					<th class="col-xs-1 encabezado" data-column="40">"40</th>
					<th class="col-xs-1 encabezado" data-column="45">"45</th>
					<th class="col-xs-1 encabezado" data-column="50">"50</th>
					<th class="col-xs-1 encabezado" data-column="55">"55</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<th class="text-right encabezado">10 a.m.</th>
					<td data-row="10" data-column="0"></td>
					<td data-row="10" data-column="5"></td><td data-row="10" data-column="10"></td>
					<td data-row="10" data-column="15"></td><td data-row="10" data-column="20"></td>
					<td data-row="10" data-column="25"></td><td data-row="10" data-column="30"></td>
					<td data-row="10" data-column="35"></td><td data-row="10" data-column="40"></td>
					<td data-row="10" data-column="45"></td><td data-row="10" data-column="50"></td>
					<td data-row="10" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">11 a.m.</th>
					<td data-row="11" data-column="0"></td>
					<td data-row="11" data-column="5"></td><td data-row="11" data-column="10"></td>
					<td data-row="11" data-column="15"></td><td data-row="11" data-column="20"></td>
					<td data-row="11" data-column="25"></td><td data-row="11" data-column="30"></td>
					<td data-row="11" data-column="35"></td><td data-row="11" data-column="40"></td>
					<td data-row="11" data-column="45"></td><td data-row="11" data-column="50"></td>
					<td data-row="11" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">12 a.m.</th>
					<td data-row="12" data-column="0"></td>
					<td data-row="12" data-column="5"></td><td data-row="12" data-column="10"></td>
					<td data-row="12" data-column="15"></td><td data-row="12" data-column="20"></td>
					<td data-row="12" data-column="25"></td><td data-row="12" data-column="30"></td>
					<td data-row="12" data-column="35"></td><td data-row="12" data-column="40"></td>
					<td data-row="12" data-column="45"></td><td data-row="12" data-column="50"></td>
					<td data-row="12" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">1 p.m.</th>
					<td data-row="13" data-column="0"></td>
					<td data-row="13" data-column="5"></td><td data-row="13" data-column="10"></td>
					<td data-row="13" data-column="15"></td><td data-row="13" data-column="20"></td>
					<td data-row="13" data-column="25"></td><td data-row="13" data-column="30"></td>
					<td data-row="13" data-column="35"></td><td data-row="13" data-column="40"></td>
					<td data-row="13" data-column="45"></td><td data-row="13" data-column="50"></td>
					<td data-row="13" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">2 p.m.</th>
					<td data-row="14" data-column="0"></td>
					<td data-row="14" data-column="5"></td><td data-row="14" data-column="10"></td>
					<td data-row="14" data-column="15"></td><td data-row="14" data-column="20"></td>
					<td data-row="14" data-column="25"></td><td data-row="14" data-column="30"></td>
					<td data-row="14" data-column="35"></td><td data-row="14" data-column="40"></td>
					<td data-row="14" data-column="45"></td><td data-row="14" data-column="50"></td>
					<td data-row="14" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">3 p.m.</th>
					<td data-row="15" data-column="0"></td>
					<td data-row="15" data-column="5"></td><td data-row="15" data-column="10"></td>
					<td data-row="15" data-column="15"></td><td data-row="15" data-column="20"></td>
					<td data-row="15" data-column="25"></td><td data-row="15" data-column="30"></td>
					<td data-row="15" data-column="35"></td><td data-row="15" data-column="40"></td>
					<td data-row="15" data-column="45"></td><td data-row="15" data-column="50"></td>
					<td data-row="15" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">4 p.m.</th>
					<td data-row="16" data-column="0"></td>
					<td data-row="16" data-column="5"></td><td data-row="16" data-column="10"></td>
					<td data-row="16" data-column="15"></td><td data-row="16" data-column="20"></td>
					<td data-row="16" data-column="25"></td><td data-row="16" data-column="30"></td>
					<td data-row="16" data-column="35"></td><td data-row="16" data-column="40"></td>
					<td data-row="16" data-column="45"></td><td data-row="16" data-column="50"></td>
					<td data-row="16" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">5 p.m.</th>
					<td data-row="17" data-column="0"></td>
					<td data-row="17" data-column="5"></td><td data-row="17" data-column="10"></td>
					<td data-row="17" data-column="15"></td><td data-row="17" data-column="20"></td>
					<td data-row="17" data-column="25"></td><td data-row="17" data-column="30"></td>
					<td data-row="17" data-column="35"></td><td data-row="17" data-column="40"></td>
					<td data-row="17" data-column="45"></td><td data-row="17" data-column="50"></td>
					<td data-row="17" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">6 p.m.</th>
					<td data-row="18" data-column="0"></td>
					<td data-row="18" data-column="5"></td><td data-row="18" data-column="10"></td>
					<td data-row="18" data-column="15"></td><td data-row="18" data-column="20"></td>
					<td data-row="18" data-column="25"></td><td data-row="18" data-column="30"></td>
					<td data-row="18" data-column="35"></td><td data-row="18" data-column="40"></td>
					<td data-row="18" data-column="45"></td><td data-row="18" data-column="50"></td>
					<td data-row="18" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">7 p.m.</th>
					<td data-row="19" data-column="0"></td>
					<td data-row="19" data-column="5"></td><td data-row="19" data-column="10"></td>
					<td data-row="19" data-column="15"></td><td data-row="19" data-column="20"></td>
					<td data-row="19" data-column="25"></td><td data-row="19" data-column="30"></td>
					<td data-row="19" data-column="35"></td><td data-row="19" data-column="40"></td>
					<td data-row="19" data-column="45"></td><td data-row="19" data-column="50"></td>
					<td data-row="19" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">8 p.m.</th>
					<td data-row="20" data-column="0"></td>
					<td data-row="20" data-column="5"></td><td data-row="20" data-column="10"></td>
					<td data-row="20" data-column="15"></td><td data-row="20" data-column="20"></td>
					<td data-row="20" data-column="25"></td><td data-row="20" data-column="30"></td>
					<td data-row="20" data-column="35"></td><td data-row="20" data-column="40"></td>
					<td data-row="20" data-column="45"></td><td data-row="20" data-column="50"></td>
					<td data-row="20" data-column="55"></td></tr>
					<tr>
					<th class="text-right encabezado">9 p.m.</th>
					<td data-row="21" data-column="0"></td>
					<td data-row="21" data-column="5"></td><td data-row="21" data-column="10"></td>
					<td data-row="21" data-column="15"></td><td data-row="21" data-column="20"></td>
					<td data-row="21" data-column="25"></td><td data-row="21" data-column="30"></td>
					<td data-row="21" data-column="35"></td><td data-row="21" data-column="40"></td>
					<td data-row="21" data-column="45"></td><td data-row="21" data-column="50"></td>
					<td data-row="21" data-column="55"></td></tr>
					<thead>
					<tr>
					<th class="cabecera encabezado text-center"><span class="glyphicon glyphicon-time"></span> Horas</th>
					<th class="col-xs-1 encabezado" data-column="0">"0</th>
					<th class="col-xs-1 encabezado" data-column="5">"5</th>
					<th class="col-xs-1 encabezado" data-column="10">"10</th>
					<th class="col-xs-1 encabezado" data-column="15">"15</th>
					<th class="col-xs-1 encabezado" data-column="20">"20</th>
					<th class="col-xs-1 encabezado" data-column="25">"25</th>
					<th class="col-xs-1 encabezado" data-column="30">"30</th>
					<th class="col-xs-1 encabezado" data-column="35">"35</th>
					<th class="col-xs-1 encabezado" data-column="40">"40</th>
					<th class="col-xs-1 encabezado" data-column="45">"45</th>
					<th class="col-xs-1 encabezado" data-column="50">"50</th>
					<th class="col-xs-1 encabezado" data-column="55">"55</th>
					</tr>
				</thead>
				</tbody>
			</table>
			</div>

			<div class="row col-sm-12 text-center calendSabados"><h2>Mañana y Tarde (Sábados)</h2>
			<table class="table table-bordered tablaCalendario text-center" id="sabados">
				<thead>
					<tr>
					<th class="cabecera encabezado"><span class="glyphicon glyphicon-time"></span> Horas</th>
					<th class="col-xs-1 encabezado" data-column="0">"0</th>
					<th class="col-xs-1 encabezado" data-column="5">"5</th>
					<th class="col-xs-1 encabezado" data-column="10">"10</th>
					<th class="col-xs-1 encabezado" data-column="15">"15</th>
					<th class="col-xs-1 encabezado" data-column="20">"20</th>
					<th class="col-xs-1 encabezado" data-column="25">"25</th>
					<th class="col-xs-1 encabezado" data-column="30">"30</th>
					<th class="col-xs-1 encabezado" data-column="35">"35</th>
					<th class="col-xs-1 encabezado" data-column="40">"40</th>
					<th class="col-xs-1 encabezado" data-column="45">"45</th>
					<th class="col-xs-1 encabezado" data-column="50">"50</th>
					<th class="col-xs-1 encabezado" data-column="55">"55</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<th class="text-right encabezado">6 a.m.</th>
					<td data-row='6' data-column='0'></td><td data-row='6' data-column='5'></td>
					<td data-row='6' data-column='10'></td><td data-row='6' data-column='15'></td>
					<td data-row='6' data-column='20'></td><td data-row='6' data-column='25'></td>
					<td data-row='6' data-column='30'></td><td data-row='6' data-column='35'></td>
					<td data-row='6' data-column='40'></td><td data-row='6' data-column='45'></td>
					<td data-row='6' data-column='50'></td><td data-row='6' data-column='55'></td>
					</tr>
					<tr>
					<th class="text-right encabezado">7 a.m.</th>
					<td data-row='7' data-column='0'></td><td data-row='7' data-column='5'></td>
					<td data-row='7' data-column='10'></td><td data-row='7' data-column='15'></td>
					<td data-row='7' data-column='20'></td><td data-row='7' data-column='25'></td>
					<td data-row='7' data-column='30'></td><td data-row='7' data-column='35'></td>
					<td data-row='7' data-column='40'></td><td data-row='7' data-column='45'></td>
					<td data-row='7' data-column='50'></td><td data-row='7' data-column='55'></td>
					</tr>
					<tr>
					<th class="text-right encabezado">8 a.m.</th>
					<td data-row='8' data-column='0'></td><td data-row='8' data-column='5'></td>
					<td data-row='8' data-column='10'></td><td data-row='8' data-column='15'></td>
					<td data-row='8' data-column='20'></td><td data-row='8' data-column='25'></td>
					<td data-row='8' data-column='30'></td><td data-row='8' data-column='35'></td>
					<td data-row='8' data-column='40'></td><td data-row='8' data-column='45'></td>
					<td data-row='8' data-column='50'></td><td data-row='8' data-column='55'></td>
					</tr>
					<tr>
					<th class="text-right encabezado">9 a.m.</th>
					<td data-row='9' data-column='0'></td><td data-row='9' data-column='5'></td>
					<td data-row='9' data-column='10'></td><td data-row='9' data-column='15'></td>
					<td data-row='9' data-column='20'></td><td data-row='9' data-column='25'></td>
					<td data-row='9' data-column='30'></td><td data-row='9' data-column='35'></td>
					<td data-row='9' data-column='40'></td><td data-row='9' data-column='45'></td>
					<td data-row='9' data-column='50'></td><td data-row='9' data-column='55'></td>
					</tr>
					<tr>
					<th class="text-right encabezado">10 a.m.</th>
					<td data-row='10' data-column='0'></td><td data-row='10' data-column='5'></td>
					<td data-row='10' data-column='10'></td><td data-row='10' data-column='15'></td>
					<td data-row='10' data-column='20'></td><td data-row='10' data-column='25'></td>
					<td data-row='10' data-column='30'></td><td data-row='10' data-column='35'></td>
					<td data-row='10' data-column='40'></td><td data-row='10' data-column='45'></td>
					<td data-row='10' data-column='50'></td><td data-row='10' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">11 a.m.</th>
					<td data-row='11' data-column='0'></td><td data-row='11' data-column='5'></td>
					<td data-row='11' data-column='10'></td><td data-row='11' data-column='15'></td>
					<td data-row='11' data-column='20'></td><td data-row='11' data-column='25'></td>
					<td data-row='11' data-column='30'></td><td data-row='11' data-column='35'></td>
					<td data-row='11' data-column='40'></td><td data-row='11' data-column='45'></td>
					<td data-row='11' data-column='50'></td><td data-row='11' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">12 a.m.</th>
					<td data-row='12' data-column='0'></td><td data-row='12' data-column='5'></td>
					<td data-row='12' data-column='10'></td><td data-row='12' data-column='15'></td>
					<td data-row='12' data-column='20'></td><td data-row='12' data-column='25'></td>
					<td data-row='12' data-column='30'></td><td data-row='12' data-column='35'></td>
					<td data-row='12' data-column='40'></td><td data-row='12' data-column='45'></td>
					<td data-row='12' data-column='50'></td><td data-row='12' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">1 p.m.</th>
					<td data-row='13' data-column='0'></td><td data-row='13' data-column='5'></td>
					<td data-row='13' data-column='10'></td><td data-row='13' data-column='15'></td>
					<td data-row='13' data-column='20'></td><td data-row='13' data-column='25'></td>
					<td data-row='13' data-column='30'></td><td data-row='13' data-column='35'></td>
					<td data-row='13' data-column='40'></td><td data-row='13' data-column='45'></td>
					<td data-row='13' data-column='50'></td><td data-row='13' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">2 p.m.</th>
					<td data-row='14' data-column='0'></td><td data-row='14' data-column='5'></td>
					<td data-row='14' data-column='10'></td><td data-row='14' data-column='15'></td>
					<td data-row='14' data-column='20'></td><td data-row='14' data-column='25'></td>
					<td data-row='14' data-column='30'></td><td data-row='14' data-column='35'></td>
					<td data-row='14' data-column='40'></td><td data-row='14' data-column='45'></td>
					<td data-row='14' data-column='50'></td><td data-row='14' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">3 p.m.</th>
					<td data-row='15' data-column='0'></td><td data-row='15' data-column='5'></td>
					<td data-row='15' data-column='10'></td><td data-row='15' data-column='15'></td>
					<td data-row='15' data-column='20'></td><td data-row='15' data-column='25'></td>
					<td data-row='15' data-column='30'></td><td data-row='15' data-column='35'></td>
					<td data-row='15' data-column='40'></td><td data-row='15' data-column='45'></td>
					<td data-row='15' data-column='50'></td><td data-row='15' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">4 p.m.</th>
					<td data-row='16' data-column='0'></td><td data-row='16' data-column='5'></td>
					<td data-row='16' data-column='10'></td><td data-row='16' data-column='15'></td>
					<td data-row='16' data-column='20'></td><td data-row='16' data-column='25'></td>
					<td data-row='16' data-column='30'></td><td data-row='16' data-column='35'></td>
					<td data-row='16' data-column='40'></td><td data-row='16' data-column='45'></td>
					<td data-row='16' data-column='50'></td><td data-row='16' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">5 p.m.</th>
					<td data-row='17' data-column='0'></td><td data-row='17' data-column='5'></td>
					<td data-row='17' data-column='10'></td><td data-row='17' data-column='15'></td>
					<td data-row='17' data-column='20'></td><td data-row='17' data-column='25'></td>
					<td data-row='17' data-column='30'></td><td data-row='17' data-column='35'></td>
					<td data-row='17' data-column='40'></td><td data-row='17' data-column='45'></td>
					<td data-row='17' data-column='50'></td><td data-row='17' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">6 p.m.</th>
					<td data-row='18' data-column='0'></td><td data-row='18' data-column='5'></td>
					<td data-row='18' data-column='10'></td><td data-row='18' data-column='15'></td>
					<td data-row='18' data-column='20'></td><td data-row='18' data-column='25'></td>
					<td data-row='18' data-column='30'></td><td data-row='18' data-column='35'></td>
					<td data-row='18' data-column='40'></td><td data-row='18' data-column='45'></td>
					<td data-row='18' data-column='50'></td><td data-row='18' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">7 p.m.</th>
					<td data-row='19' data-column='0'></td><td data-row='19' data-column='5'></td>
					<td data-row='19' data-column='10'></td><td data-row='19' data-column='15'></td>
					<td data-row='19' data-column='20'></td><td data-row='19' data-column='25'></td>
					<td data-row='19' data-column='30'></td><td data-row='19' data-column='35'></td>
					<td data-row='19' data-column='40'></td><td data-row='19' data-column='45'></td>
					<td data-row='19' data-column='50'></td><td data-row='19' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">8 p.m.</th>
					<td data-row='20' data-column='0'></td><td data-row='20' data-column='5'></td>
					<td data-row='20' data-column='10'></td><td data-row='20' data-column='15'></td>
					<td data-row='20' data-column='20'></td><td data-row='20' data-column='25'></td>
					<td data-row='20' data-column='30'></td><td data-row='20' data-column='35'></td>
					<td data-row='20' data-column='40'></td><td data-row='20' data-column='45'></td>
					<td data-row='20' data-column='50'></td><td data-row='20' data-column='55'></td>
					</tr><tr>
					<th class="text-right encabezado">9 p.m.</th>
					<td data-row='21' data-column='0'></td><td data-row='21' data-column='5'></td>
					<td data-row='21' data-column='10'></td><td data-row='21' data-column='15'></td>
					<td data-row='21' data-column='20'></td><td data-row='21' data-column='25'></td>
					<td data-row='21' data-column='30'></td><td data-row='21' data-column='35'></td>
					<td data-row='21' data-column='40'></td><td data-row='21' data-column='45'></td>
					<td data-row='21' data-column='50'></td><td data-row='21' data-column='55'></td>
					</tr>
					<thead>
					<tr>
					<th class="cabecera encabezado"><span class="glyphicon glyphicon-time"></span> Horas</th>
					<th class="col-xs-1 encabezado" data-column="0">"0</th>
					<th class="col-xs-1 encabezado" data-column="5">"5</th>
					<th class="col-xs-1 encabezado" data-column="10">"10</th>
					<th class="col-xs-1 encabezado" data-column="15">"15</th>
					<th class="col-xs-1 encabezado" data-column="20">"20</th>
					<th class="col-xs-1 encabezado" data-column="25">"25</th>
					<th class="col-xs-1 encabezado" data-column="30">"30</th>
					<th class="col-xs-1 encabezado" data-column="35">"35</th>
					<th class="col-xs-1 encabezado" data-column="40">"40</th>
					<th class="col-xs-1 encabezado" data-column="45">"45</th>
					<th class="col-xs-1 encabezado" data-column="50">"50</th>
					<th class="col-xs-1 encabezado" data-column="55">"55</th>
					</tr>
				</thead>
				</tbody>
			</table></div>
			
			
			
		</div>

		<div role="tabpanel" class="tab-pane fade" id="receta">
		<div class="container">
			<div class="row"><br>
				<button type="button" class="btn btn-warning" id="btnAgregarReceta"><span class="glyphicon glyphicon-pencil"></span> Agregar nueva receta</button></div><br>
			<div class="row well" id="divReceta">
				
				
			</div>
		</div>
		</div>


		<div role="tabpanel" class="tab-pane fade" id="messages">
		<div class="container">
			<div class="row"><br>
				<button type="button" class="btn btn-warning btn-outline" id="agregarNota"><span class="glyphicon glyphicon-pencil"></span> Agregar nueva entrada</button>
			</div><br>
			<div class="row well" id="divNotas">
									
			</div>
		</div>
		</div>

		<div role="tabpanel" class="tab-pane fade" id="galeria">
		<div class="container">
			<div class="row"><br>
				<span class="btn btn-info btn-file"> 
				<!-- ver como se hace aca: https://www.youtube.com/watch?v=r5TGCq8SFiw -->
						<span class="glyphicon glyphicon-screenshot"></span> Buscar archivo <input type="file">
				</span>
			</div><br>
			<div class="row well" id="divGaleria">
				
				
			</div>
		</div>
		</div>
		
		</div>
		
	</main>

</div>

<?php include "piePagina.php"; ?>

<style>.btn-file {
	position: relative;
	overflow: hidden;
}
.btn-file input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity=0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
}</style>


	<!--Modal Para ingresar una receta -->
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
					<div class="col-xs-1 text-center">#</div>
					<div class="col-xs-4 text-center">Medicamento</div>
					<div class="col-xs-1 text-center">Cant.</div>
					<div class="col-xs-2 text-center">Dosis</div>
					<div class="col-xs-4 text-center">Indicaciones</div>
					
					<div class="row rowDeModal">
						<div class="col-xs-1 text-center"><strong>1</strong></div>
					<div class="col-xs-4"><input type="text" class="form-control" id="foc" ></div>
					<div class="col-xs-1"><input type="text" class="form-control" /></div>
					<div class="col-xs-2"><input type="text" class="form-control" /></div>
					<div class="col-xs-4"><input type="text" class="form-control" /></div>
					</div>

					<div class="row rowDeModal">
						<div class="col-xs-1 text-center"><strong>1</strong></div>
					<div class="col-xs-4"><input type="text" class="form-control" ></div>
					<div class="col-xs-1"><input type="text" class="form-control" /></div>
					<div class="col-xs-2"><input type="text" class="form-control" /></div>
					<div class="col-xs-4"><input type="text" class="form-control" /></div>
					</div>



			<br>
			<label for="btnAgregarNuevaFilaReceta">Agregar nueva fila </label> <button class="btn btn-warning" >+</button>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary" id="" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-save"></span> Agregar</button>
				</div>
			</div>
		</div>
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
					<button type="button" class="btn btn-primary" id="btnAgregarConsultaHorario" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-save"></span> Agregar</button>
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
				<div class="modal-tittle grey-text text-darken-3"><h4>Motivo de la visita</h4></div>          
			</div>
			<div class="modal-body">
				<div class="form-inline">
					<label>Ingrese el motivo de la consulta del paciente: </label>
					<input class="form-control mayuscula" id="txtMotivoHC" type="text" placeholder="...ingrese un motivo">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btnGuardarMotivo"><span class="glyphicon glyphicon-king"></span> Guardar</button>
				
			</div>
		</div>
		</div>
	</div>

	<!--Modal Para ingresar motivo de Nuevas entradas-->
	<div class="modal fade modal-notas" tabindex=-1 role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
				<div class="modal-tittle grey-text text-darken-3"><h4><span class="glyphicon glyphicon-tags"></span> Agregar nueva nota</h4></div>          
			</div>
			<div class="modal-body">
				<div class="alert alert-danger alert-dismissible fade in sr-only" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Ups!</strong> <span class="mensajeError"></span> </div>
				<form class="form-horizontal">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Título de la nota</label>
						<div class="col-sm-8">
							<input type="text" class="form-control mayuscula" id="txtTituloNota" placeholder="...Ingrese un título">
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Mensaje</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="txtMensajeNota" placeholder="...Su mensaje">
						</div>
					</div>
				</form>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="btnGuardarNota"><span class="glyphicon glyphicon-bell"></span> Guardar</button>
				
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



	<!--Modal Para ingresar adelanto-->
	<div class="modal fade modal-adelanto" tabindex=-1 role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<div class="modal-tittle grey-text text-darken-3"><h4><span class="glyphicon glyphicon-shopping-cart"></span> Depósitos de dinero de parte del cliente</h4></div>         
				</div>
				<div class="modal-body">
					<div class="alert alert-danger alert-dismissible fade in sr-only" id="divErrorPago" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Hay un problema!</strong> <span class="mensajeError"></span> </div>
					<p>Ingrese los campos requeridos a continuación:</p>
					<div class="container-fluid">
						<div class="form-group col-sm-4" lang="en-US"> 
							<label for="cmbTipoDeposito">Turno:</label>
							<div class="btn-group">
							<select class="form-control btn-primary" id="cmbTipoDeposito">
								<option class="bg-info indigo-text text-darken-4" value='1'>Día</option>
								<option class="bg-info indigo-text text-darken-4" value='2'>Tardes y noches</option>
							</select>
						</div>
						</div>
						
						<div class="form-group col-sm-6" lang="en-US"> 
							<label for="txtMontoPagado">Monto depositado (S/.):</label>
							<input type="number" class="form-control" id="txtMontoPagado" placeholder="S/. 0.00" min="0" step=".10">
						</div>
						<div class="form-group col-sm-12"> 
							<label for="txtObservacion">Observaciones:</label>
							<input type="text" class="form-control mayuscula" id="txtObservacion" placeholder="¿Alguna observación?">
						</div>
						<label id="lblidRegistro" class="sr-only"></label>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>  
					<button type="button" class="btn btn-primary" id="btnGuardarPago"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>
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
							<select class="form-control btn-primary mayuscula" id="cmbProcedencia">
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
								<select class="form-control mayuscula" id="cmbEstadoCivil">
									<option value="0">Estado Civil</option>
									<?php require('php/listarEstadoCivil.php'); ?>
								</select>
							</div>
						</div>
						<div class="col-sm-3">
						<label for="cmbGrado">Estudios:</label>
							<div class="btn-group">
								<div class="btn-group">
								<select class="form-control mayuscula" id="cmbGrado">
									<option value="0">Grado de estudios</option>
									<?php require('php/listarGrado.php'); ?>
								</select>
							</div>
							</div>
						</div>
						<div class="col-sm-3">
							<label for="cmbOcupacion">Ocupación:</label>
							<select id="cmbOcupacion" class="form-control mayuscula">
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
					<h4 class="modal-tittle text-primary"><span class="glyphicon glyphicon-minus-sign"></span> Eliminar registro</h4>
				</div>
				<div class="modal-body">
					<p>¿Realmente desea eliminar éste registro?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-danger" id="btnCancelarCita"><span class="glyphicon glyphicon-floppy-remove"></span> Eliminar</button>
				</div>
			</div>
		</div>
	</div>

	

	<!--Modal Para insertar un motivo de procedimiento-->
	<div class="modal fade modal-motivoProcedimiento">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-tittle text-primary">Motivo del procedimiento</h4>
				</div>
				<div class="modal-body">
				<div class="alert alert-danger alert-dismissible fade in sr-only" id="divErrorMotivoProcedimiento" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Hay un problema!</strong> <span class="mensajeError"></span> </div>
				<div class="form-inline ">
					<label>Motivo de la del procedimiento a realizar: </label>
					<div class="row">
						<div class="col-sm-5">              
							<select id="cmbTipoProcedimiento" class="form-control mayuscula">
								<option value="0" select>Elija uno de los motivos</option>
								<?php include "php/listarProcedimientos.php"; ?>

							</select>
						</div>
						<div class="col-sm-5"><input class="form-control mayuscula" id="txtMotivoProcedimiento" size="35" type="text" placeholder="...ingrese su motivo"></div>
					</div>
				</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" id="btnCrearMotivoProcedimiento"><span class="glyphicon glyphicon-king"></span> Crear</button>
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
<script src="js/mijs.js?v1.0.11"></script>
<script src="js/jquery.PrintArea.js"></script>
<script src="js/jquery.printPage.js?version=1.1"></script>
<script src="js/bootstrap-switch.js"></script>
<!-- <script src="./node_modules/socket.io-client/dist/socket.io.js"></script>  -->
<script src="js/moment-precise-range.js"></script>
<script src="js/socketCliente.js"></script>
<script src="js/webcam.js"></script>
<script>
$('.mitooltip').tooltip();
$('.BSswitch').bootstrapSwitch('state', true);
listadoDatosUsuario();
var overlay=$('#overlay');
window.addEventListener('load',function(){
	overlay.css('display','none');
});
$(document).ready(function() {
	var idCliente = <?php  
		if(isset($_GET["id"]))  echo $_GET['id'];
		else echo 0;?>;
	//console.log(idCliente);
	if(idCliente!=0){//console.log('llamar datos totales');
		$('#lblIdCliente').text(idCliente);
		
		solicitarDatosClientePanel(idCliente);
		/*socket.emit('listarProcedimientos');
		socket.emit('listarTiempoControles');*/
	}
	else{//console.log('redireccionar a panel porque no hay nada');
	$(window).attr('location','Cliente.html');
	}
	var nuevo= <?php  if(isset($_GET["n"])) echo $_GET["n"];  else echo 0;?>;
	switch(nuevo){
		case 1: $('#mnjClienteRegistrado')
			.addClass('alert-warning')
			.removeClass('alert-info')
			.removeClass('hidden')
			.find('#texto').html('El cliente fue creado con éxito.'); break;
		case 2: $('#mnjClienteRegistrado')
			.removeClass('alert-warning')
			.addClass('alert-info')
			.removeClass('hidden')
			.find('#texto').html('El cliente fue actualizado con éxito.'); break;
		default: $('#mnjClienteRegistrado').addClass('sr-only');
	}
	listarFeriados();
	
	
	$.get('images/fotosClientes/'+idCliente+'.jpg')
		.done(function() { 
				$('#mi_camara').html(`<img src="images/fotosClientes/${idCliente}.jpg" class="img-responsive" style="width: auto;">`);
		}).fail(function() { 
				$('#mi_camara').html(`<img src="images/kids.jpg" class="img-responsive" style="width: auto;">`);
		});
	//console.log(UrlExists('localhost/consultorio/images/fotosClientes/30407.jpg'));
});
function listarFeriados() {
	$.ajax({url:'php/listarFeriados.php', type: 'POST'}).done(function (resp) {
		$.feriados=JSON.parse(resp);
	});
}

$("#imprime").click(function () {
	//$(".myPrintArea").removeClass('sr-only');
	$(".myPrintArea").printArea();
	//$(".myPrintArea").addClass('sr-only');
});
$('#txtAdelantarFecha').keypress(function(){
	if ( event.which == 13 ) {
 event.preventDefault();
 $('#btnAdelantarFecha').click();
	}
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

$('#dtpControladorFechasv2').change(function () {
	var dia = moment($('#dtpControladorFechasv2').val());
	var hoy= moment().format('YYYY-MM-DD');

	moment.locale('es');
	$.ajax({url: 'php/listarContadorResumen.php', type: 'POST', data: {dia: $('#dtpControladorFechasv2').val()}}).done(function (resp) {
		var valores=JSON.parse(resp); 
		if(valores.sumaConsultas == null ){$('#spanConteoNuevo').text(0);} else { $('#spanConteoNuevo').text(valores.sumaConsultas); }
		if(valores.sumaRevaluados == null ){$('#spanConteoOperacion').text(0);} else { $('#spanConteoOperacion').text(valores.sumaRevaluados); }
		if(valores.sumaRevaluados == null ){$('#spanConteoRevaluacion').text(0);} else { $('#spanConteoRevaluacion').text(valores.sumaRevaluados); }
		//console.log(valores)
	});
	$.ajax({url:'php/listarCitasPorFecha.php', type:'POST', data:{dia: $("#dtpControladorFechasv2").val() }
		}).success(function (resp) {
		var dato=JSON.parse(resp);
		$.datosCitasDelDiav2=dato;
		//console.log($.datosCitasDelDiav2)
		asignarHorav2(moment().format('HH'));
		bloquearMeses();  rellenarDiasxMesv2();
	});
	var fechav2=moment($(this).val(), 'YYYY-MM-DD');
	$('#divAñov2').text(fechav2.year());
	$('#divMesv2').text(fechav2.format('MMMM'));
	$('#divDiav2').text(fechav2.format('dddd D'));
	$('#spanFechaMiniRepov2').text(fechav2.format('dddd, D [de] MMMM [de] YYYY'));
	
	if(fechav2.day()==0){
		//console.log('domingo')
		$('#divDomingos').removeClass('hidden').find('#spanFeriado').text('Domingo');
		$('#divColexionHorasv2').hide();
	}else{
		$.each($.feriados,function (i, dato) {
			if(dato.ferFecha==$('#dtpControladorFechasv2').val()){
				$('#divDomingos').removeClass('hidden').find('#spanFeriado').text(dato.ferDescripcion);
				$('#divColexionHorasv2').hide(); return false;
				//console.log(dato.ferDescripcion); 
			}
			else{
				$('#divDomingos').addClass('hidden');
				$('#divColexionHorasv2').show();}
		});
	}
});
function asignarHorav2(fijarHora) {
	var nuevaHora= moment(fijarHora, 'HH');
	$('#horaDisplayCalendv2').text(nuevaHora.format('h a').replace('am', 'a.m.').replace('pm', 'p.m.'));
	$('#horaAsignarCalend12v2').text(nuevaHora.format('h'));
	$('#horaAsignarCalend24v2').text(nuevaHora.format('HH'));
	$('.horaChangeable').text(nuevaHora.format('h'));
	$('.horaAMPM').text(nuevaHora.format('a').replace('am', 'a.m.').replace('pm', 'p.m.'));
	bloquearHorasv2();
}
function bloquearHorasv2(){
	//console.log($.queMichiEs);

	$('.tdDatoCliente').children().remove();
	var horaAct=moment().format('H');
	var minutoAct=parseInt(moment().format('m'))-5; //console.log(minutoAct);
	if( $('#dtpControladorFechasv2').val()==moment().format('YYYY-MM-DD') ){
		$.each( $('.aHorav2'), function (i, elem) {
			if(parseInt($(elem).attr('valor'))<horaAct){
				$(elem).parent().addClass('disabled');
			}
		});
	}else{
		$('.aHorav2').parent().removeClass('disabled');

	}
	horaPorCaso();
}
function horaPorCaso(){
	//$('.tdDatoCliente').children().remove();
	var horaAct=moment().format('H');
	var minutoAct=parseInt(moment().format('m'))-5; //console.log(minutoAct);
	//console.log($('#horaAsignarCalend24v2').text())
	$.each($('.tdDatoCliente'), function (i, elem) {
			var minRecorrido=parseInt($(elem).attr('valor'));
			if( $('#dtpControladorFechasv2').val()==moment().format('YYYY-MM-DD') && horaAct==$('#horaAsignarCalend24v2').text() && minRecorrido<minutoAct){
				$(this).append('<p class="pNoDisponible"><i class="icofont icofont-puzzle"></i> Lo siento, ya no se puede asignar.</p>');
			}/*else{$(this).append('<p class="pDisponible"><button class="btn btn-default btn-outline btnHoraDisponiblev2 " ><i class="icofont icofont-animal-cat-alt-3"></i> Horario libre para asignar</button></p>');}*/
			//console.log($.queMichiEs);
			switch($.queMichiEs){
				case 'nuevaCita':
					if( parseInt($('#horaAsignarCalend24v2').text())>8){
						if($.trim($(this).text()).length==0){
						$(this).append('<button class="btn btn-primary btn-outline btnHoraDisponiblev2"><span class="glyphicon glyphicon-triangle-right"></span>Horario disponible</button>');
						}
					}
					else if( parseInt($('#horaAsignarCalend24v2').text()) ==8 && minRecorrido>=30 ){
						//Asigna un limite de tiempo para poner el boton de Disponible
						$(this).append('<button class="btn btn-primary btn-outline btnHoraDisponiblev2"><span class="glyphicon glyphicon-triangle-right"></span>Horario disponible</button>');
					}
					else{
						if($.trim($(this).text()).length==0){
							$(this).append('<p class="pAdvertenciaHorario"><i class="icofont icofont-puzzle"></i> Sólo se permite nuevos a partir de 8:30 am.</p>');
						}
					}
				break;
				case 'nuevaRevaluacion': 
					if( parseInt($('#horaAsignarCalend24v2').text())==7){
					//Asigna un limite de tiempo para poner el boton de Disponible
					$(this).append('<button class="btn btn-success btn-outline btnHoraDisponiblev2"><span class="glyphicon glyphicon-triangle-right"></span>Horario disponible</button>');
					}
					else if( parseInt($('#horaAsignarCalend24v2').text()) ==8 && minRecorrido<=30 ){
						$(this).append('<button class="btn btn-success btn-outline btnHoraDisponiblev2"><span class="glyphicon glyphicon-triangle-right"></span>Horario disponible</button>');
					}
					else{
						if($.trim($(this).text()).length==0){
							$(this).append('<p class="pAdvertenciaHorario"><i class="icofont icofont-puzzle"></i> Sólo se permite controles entre 7:00 am y 8:30 am.</p>');
						}
					}
					break;
				case 'nuevoProcedimiento':
					if($.trim($(this).text()).length==0){
						$(this).append('<button class="btn btn-success btn-outline btnHoraDisponiblev2"><span class="glyphicon glyphicon-triangle-right"></span>Horario disponible</button>');
							}
					break; 
				case 'actualizacion':
					if($.trim($(this).text()).length==0){
						$(this).append('<button class="btn btn-success btn-outline btnHoraDisponiblev2"><span class="glyphicon glyphicon-triangle-right"></span>Actualizar horario</button>');
							}
					break; 
			}
		});
	
	$.each($.datosCitasDelDiav2, function (i, elem) {
		var horaBD=moment(elem.hora, 'H:mm a');	
		if(horaBD.hours()== parseInt($('#horaAsignarCalend24v2').text())){
			if(elem.descripcion=="Consulta"){
			$(`.tdDatoCliente[valor=${horaBD.format('mm')}]`).html(`
				<p class="pNuevoxPaciente"><strong>Nuevo:</strong> <span class="mayuscula">${elem.nombres.toLowerCase()}</span>. <strong>#H.C.:</strong> ${elem.idHistoriaClinica}</p>`);
			}
		}
		if(horaBD.hours()== parseInt($('#horaAsignarCalend24v2').text())){
			if(elem.descripcion=="Revaluación"){
			$(`.tdDatoCliente[valor=${horaBD.format('mm')}]`).html(`
				<p class="pReevaluacionxPaciente"><strong>Control:</strong> <span class="mayuscula">${elem.nombres.toLowerCase()}</span>. <strong>#H.C.:</strong> ${elem.idHistoriaClinica}</p>`);
			}
		}
		if(horaBD.hours()== parseInt($('#horaAsignarCalend24v2').text())){
			if(elem.descripcion=="Procedimiento"){
			$(`.tdDatoCliente[valor=${horaBD.format('mm')}]`).html(`
				<p class="pOperacionxPaciente"><strong>Procedimiento:</strong> <span class="mayuscula">${elem.nombres.toLowerCase()}</span>. <strong>#H.C.:</strong> ${elem.idHistoriaClinica}. <span class="mayuscula">${elem.regDescripcion.toLowerCase()}. </span></p>`);
			}
		}

	});
}

$('#btnSumarHorav2').click(function () {
	var nuevaHorav2=parseInt($('#horaAsignarCalend24v2').text())+1;
	if(nuevaHorav2<=22 ){
		asignarHorav2(nuevaHorav2);
	}
});
$('#btnRestarHorav2').click(function () {
	var nuevaHorav2=parseInt($('#horaAsignarCalend24v2').text())-1;
	if($('#dtpControladorFechasv2').val()==moment().format('YYYY-MM-DD') ){
		if(nuevaHorav2>=moment().format('HH') ){
			asignarHorav2(nuevaHorav2);
		}
	}else{
		if(nuevaHorav2>=6 && nuevaHorav2<=22  ){
			asignarHorav2(nuevaHorav2);
		}
	}
	
});
function rellenarDiasxMesv2(){
	$('#ulDiaDeMes1al1').children().remove();
	$('#ulDiaDeMes12al23').children().remove();
	$('#ulDiaDeMes23al30').children().remove();
	var fechaFormateada= moment($('#dtpControladorFechasv2').val(), 'YYYY-MM-DD').format('YYYY-MM');
	var maximDiasMes= moment(fechaFormateada).daysInMonth();
	var diaCambiante, contenidoDia;
	var diaNumero='', diaLetra='';
	//console.log(fechaFormateada);
	for (var i = 1; i <= maximDiasMes; i++) {
		if(i<=9){
			diaCambiante=moment(fechaFormateada+ '-0'+i); diaNumero=diaCambiante.format('DD')
			diaLetra= diaCambiante.format('dddd D');}
		else{
			diaCambiante=moment(fechaFormateada+'-'+i); diaNumero=diaCambiante.format('DD')
			diaLetra= diaCambiante.format('dddd D');}
		if(	fechaFormateada==moment().format('YYYY-MM')){
			if(i< moment().format('D')){
				contenidoDia=`<li class="disabled"><a class="aDiav2" href="#" valor="${diaNumero}">${diaLetra}</a></li>`;
			}else{
				contenidoDia=`<li><a class="aDiav2" href="#" valor="${diaNumero}">${diaLetra}</a></li>`;
			}

		}else{
			contenidoDia=`<li><a class="aDiav2" href="#" valor="${diaNumero}">${diaLetra}</a></li>`;
		}
		
		if(i>=1 && i<=10){ $('#ulDiaDeMes1al1').append(contenidoDia);}
		if(i>=11 && i<=20){ $('#ulDiaDeMes12al23').append(contenidoDia);}
		if(i>=21 && i<=31){ $('#ulDiaDeMes23al30').append(contenidoDia);}
	}
//, , 
}
function bloquearMeses(){
	var cambio= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD');
	var mesactual= cambio.month();
	if(cambio.year()==moment().year()){
		$.each($('.aMesv2'), function (i, elem) {// console.log(elem)
			if(parseInt($(elem).attr('valor')) <mesactual){
				$(elem).parent().addClass('disabled');
			}
		});
	}else{
		$('.aMesv2').parent().removeClass('disabled');
	}
}
$('.dropdown-menu').on('click', '.aAñov2', function (argument) {
	if(! $(this).parent().hasClass('disabled')){
		var dtpDefault= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD');
		var añoElegido=$(this).attr('valor');
		if(añoElegido==moment().year()){
			$('#dtpControladorFechasv2').val( moment().format('YYYY-MM-DD')).change();
		}else{
			$('#dtpControladorFechasv2').val( añoElegido+'-01-01').change();
		}
		$('html body').animate({scrollTop: 110}, 800);
	}
});
$('.dropdown-menu').on('click', '.aMesv2', function (argument) {
	if(! $(this).parent().hasClass('disabled')){
		var dtpDefault= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD');
		var mesElegido=$(this).attr('valor');
		$('#dtpControladorFechasv2').val( dtpDefault.format('YYYY')+'-'+mesElegido+'-01').change();
		$('html body').animate({scrollTop: 110}, 800);
	}
});
$('.dropdown-menu').on('click', '.aDiav2', function (argument) {
	if(! $(this).parent().hasClass('disabled')){
		var dtpDefault= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD');
		var diaElegido=$(this).attr('valor');
		$('#dtpControladorFechasv2').val( dtpDefault.format('YYYY')+'-'+dtpDefault.format('MM')+'-'+diaElegido).change();
		$('html body').animate({scrollTop: 110}, 800);
	}
});
$('.dropdown-menu').on('click', '.aHorav2', function (argument) {
	if(! $(this).parent().hasClass('disabled')){
		var nuevaHorav2=$(this).attr('valor');
		asignarHorav2(nuevaHorav2);
		$('html body').animate({scrollTop: 110}, 800);
	}
});
$('#txtAdelantarFechav2').keypress(function (event) {
		if(event.keyCode===13){event.preventDefault(); diasHabilesv2();}
	});
$('#btnSaltarDiasv2').click(function () {
	diasHabilesv2();
});
function diasHabilesv2(){
	if($('#txtAdelantarFechav2').val()!=''){
	var numDias=$('#txtAdelantarFechav2').val();
	var semanasHabiles=parseInt(numDias/5);
	var diasFindesemana=semanasHabiles*2;
	var diasHabiles= parseInt(numDias)+ parseInt(numDias/5)*2;
	//console.log('días '+numDias + '\nSemanas ' + semanasHabiles+ '\nSábados y domingos ' + diasFindesemana+ '\nDías hábiles ' + diasHabiles);
	var fechaDestino=moment().add(diasHabiles,'days'); console.log(fechaDestino)
	if(fechaDestino.format('d')=='0'){
		$('#dtpControladorFechasv2').val(fechaDestino.add(1,'day').format('YYYY-MM-DD')).change();
	}else{
		$('#dtpControladorFechasv2').val(fechaDestino.format('YYYY-MM-DD')).change();
	}
	
}
}
$('#btnMostrarDiaHoyv2').click(function () {
	$('#dtpControladorFechasv2').val( moment().format('YYYY-MM-DD')).change();
});
$('#btnSumarAñov2').click(function () {
	var cambio= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD').add(1, 'years');
	if(cambio.year()<=2018){
		$('#dtpControladorFechasv2').val( cambio.format('YYYY')+'-01-01').change();
	}
	
});
$('#btnRestarAñov2').click(function () {
	var cambio= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD').subtract(1, 'years');
	if(cambio.isBefore( moment().format('YYYY-MM-DD'))){ 
		$('#dtpControladorFechasv2').val(moment().format('YYYY-MM-DD') ).change();
	}else{
		if(cambio.year()>=moment().year()){ $('#dtpControladorFechasv2').val( cambio.format('YYYY')+'-01-01').change(); }
	}
});
$('#btnSumarMesv2').click(function () {
	var cambio= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD').add(1, 'month');
	$('#dtpControladorFechasv2').val( cambio.format('YYYY')+'-'+cambio.format('MM')+'-01').change();
});
$('#btnRestarMesv2').click(function () {
	var cambio= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD').subtract(1, 'month');
	if(cambio.isBefore( moment().format('YYYY-MM-DD'))){ 
		$('#dtpControladorFechasv2').val(moment().format('YYYY-MM-DD') ).change();}
	else{
		if(cambio.year()>=moment().year()){
			$('#dtpControladorFechasv2').val( cambio.format('YYYY')+'-'+cambio.format('MM')+'-01').change(); }
	}
});
$('#btnSumarDiav2').click(function () {
	var cambio= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD').add(1, 'day');
	$('#dtpControladorFechasv2').val( cambio.format('YYYY')+'-'+cambio.format('MM')+'-'+cambio.format('DD')).change();
});
$('#btnRestarDiav2').click(function () {
	var cambio= moment( $('#dtpControladorFechasv2').val(), 'YYYY-MM-DD').subtract(1, 'day');
	if(cambio.isBefore( moment().format('YYYY-MM-DD'))){ 
		$('#dtpControladorFechasv2').val(moment().format('YYYY-MM-DD') ).change();}
	else{
		if(cambio.year()>=moment().year()){
			$('#dtpControladorFechasv2').val( cambio.format('YYYY')+'-'+cambio.format('MM')+'-'+cambio.format('DD')).change(); }
	}
});
$(document).on('click', '#trParaAño',function (event) {
	event.stopPropagation(); event.preventDefault();
	$('#btnAñosInfo').click();
});
$(document).on('click', '#trParaMeses',function (event) {
	event.stopPropagation(); event.preventDefault();
	$('#btnMesesInfo').click();
});
$(document).on('click', '#trParaDias',function (event) {
	event.stopPropagation(); event.preventDefault();
	$('#btnDiasInfo').click();
});
$(document).on('click', '#trParaHoras',function (event) {
	event.stopPropagation(); event.preventDefault();
	$('#btnHorasInfo').click();
});
$('.tdDatoCliente').on('click','.btnHoraDisponiblev2',function () {
	
	var minSelecv2=$(this).parent().attr('valor');

	var horaSelcv2=  $('#horaAsignarCalend24v2').text();
	var fechaSelcv2=$('#dtpControladorFechasv2').val();
	//console.log('Seleccionado:');
	var hora=moment(horaSelcv2+':'+minSelecv2,'H:mm');
	//console.log('fecha: '+horaSelcv2+':'+ minSelecv2)
	/* fechaSelcv2 +' '+*/
	//console.log(hora.format('LT'))

	$('#lblAsignarHoraAMPM').text(hora.format('LT'));
	$('#lblAsignarHoraCompleta').text(horaSelcv2+':'+ minSelecv2);
	$('#modalAsignar').modal('show');
	
});
</script>
	</body>
</html>
<?php 
} else{
	echo '<script> window.location="iniciosesion.php"; </script>';
}
?>