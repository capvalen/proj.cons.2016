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
		<title>Caja: Consultorio ORL</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/estilos.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		
	</head>
	<body>
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
				<li dropdown class="active"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="material-icons">attach_file</i> Reportes <span class="caret"></span></a>
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
						<button type="button" class="btn btn-negro" id="btnBuscar"><span class="glyphicon glyphicon-btnBuscar"></span></button>
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
		<main>
			<div class="container hidden-md hidden-lg">
				<p><div class="input-group">
					<input type="text" class="form-control" id="txtBuscarMini" placeholder="Buscar por: Nombre, Dni, N° Historia" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-warning" id="btnBuscarMini"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div></p>
			</div>
			<div class="row col-sm-7"><h1><span class="glyphicon glyphicon-piggy-bank"></span> Cuadre de caja <small>Diario</small></h1></div>
			<div class="row col-sm-5 text-center"><br><small class="text-muted" id="horaServer"></small>, <small class="text-muted" id="fechaServer"></small> <p><small class="text-muted" >Usuario:</small> <small class="text-primary"><?php echo $_SESSION['usuario'] ;?></small></p></div><br>

			<div class="page-header">				
			</div>
				<ul class="nav nav-tabs">
					<li class="active"><a href="#cuadreHoy" aria-controls="cuadreHoy" role="tab" data-toggle="tab">Cuadre de Hoy</a></li>
					<li><a href="#otrosDias" aria-controls="otrosDias" role="tab" data-toggle="tab">Días anteriores <span class="label label-success">S/. <span id="TotalDia">0.00</span></span></a></li>
					
				</ul>
				<div class="tab-content row">
					<div id="cuadreHoy" class="tab-pane fade in active">
						<div class="container col-sm-9 col-sm-offset-1"><br>
							<div class="panel panel-cielo">
								<div class="panel-heading">Datos para filtrar día actual</div>
								<div class="panel-body well">
									<div class="row container form-inline col-sm-offset-3 col-sm-6">
										<label for="">Desde las 8.00 a.m. hasta las 2:00 p.m.</label>
										<div class="row">
											<label><strong>Filtrar: </strong></label>
											<div class="btn-group">
												<button type="button" class="btn btn-primary dropdown-toggle cmbTurnoCuadre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Turno diurno <span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a class="aTurnoDiurno" href="#">Turno diurno</a></li>
													<li><a class="aTurnoNocturno" href="#">Turno nocturno</a></li>
												</ul>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>

					<div id="otrosDias" class="tab-pane fade">
						<div class="container col-sm-9 col-sm-offset-1"><br>
							<div class="panel panel-verde">
								<div class="panel-heading">Datos para filtrar días anteriores</div>
								<div class="panel-body well">

									<div class="center-block col-sm-12" style="float: none;">
									<div class="form-inline sr-only">
										<label>Listado para fecha: </label>
										<input class="form-control" id="dtpFecha" type="date">
										<a class="btn btn-negro" id="btnlistarFechaDtp"><span class="glyphicon glyphicon-triangle-right"></span></a>
									</div><br>
									<div class="row">
										<label class="col-lg-3 text-right">Fecha a mostrar: </label>
										<div class="col-lg-7">
											<div class="input-group">
												<span class="input-group-btn">
													<button class="btn btn-warning" type="button" id="btnHoyFecha"><span class="glyphicon glyphicon-modal-window"></span></button>
													<button class="btn btn-negro" type="button" id="btnDownFecha"><span class="glyphicon glyphicon-chevron-down"></span></button>
												</span>
												<input type="text" class="form-control text-center" id='txtFechaMovible' readonly>
												<span class="input-group-btn">
													<button class="btn btn-negro" type="button" id="btnUpFecha"><span class="glyphicon glyphicon-chevron-up"></button>
												</span>
											</div><!-- /input-group -->
											<br>
											<label> Filtro por consulta: </label>
											<div class="btn-group">

												<button type="button" class="btn btn-primary dropdown-toggle cmbTurnoCuadre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Turno diurno <span class="caret"></span>
												</button>
												<ul class="dropdown-menu">
													<li><a class="aTurnoDiurno" href="#">Turno diurno</a></li>
													<li><a class="aTurnoNocturno" href="#">Turno nocturno</a></li>
												</ul>
											</div>
											
										</div><!-- /.col-lg-6 -->
									</div>
									

								</div>
					
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="content-fluid col-sm-9 col-sm-offset-1">
					<div class="panel panel-negro" id="panelConsultas">
								<div class="panel-heading">Consultas <div class="pull-right"><span class="badge">S/. <span id="sumaParcialConsultas">0.00</span></span></div></div>
								<div class="panel-body well">
									<div class="panel-group panelPagos" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#PARTICULAR" aria-expanded="false" role="tab" aria-controls="PARTICULAR">
												<h4 class="panel-title">
													<span>
														Pacientes independientes <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="PARTICULAR" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#CONVENIO" aria-expanded="false" role="tab" aria-controls="CONVENIO">
												<h4 class="panel-title">
													<span>
														Pacientes de Convenio	 <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="CONVENIO" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#PUNO" aria-expanded="false" role="tab" aria-controls="PUNO">
												<h4 class="panel-title">
													<span >
														Pacientes de Puno <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="PUNO" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#CAYETANO_HEREDIA" aria-expanded="false" role="tab" aria-controls="CAYETANO_HEREDIA">
												<h4 class="panel-title">
													<span>
														Pacientes de Cayetano Heredia <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="CAYETANO_HEREDIA" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#FRANK_PAIS" aria-expanded="false" role="tab" aria-controls="FRANK_PAIS">
												<h4 class="panel-title">
													<span>
														Pacientes de Frank Pais <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="FRANK_PAIS" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#FRANCO_PERUANO" aria-expanded="false" role="tab" aria-controls="FRANCO_PERUANO">
												<h4 class="panel-title">
													<span>
														Pacientes de Franco Peruano <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="FRANCO_PERUANO" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#NIÑO_JESUS" aria-expanded="false" role="tab" aria-controls="NIÑO_JESUS">
												<h4 class="panel-title">
													<span>
														Pacientes de Niño Jesús <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="NIÑO_JESUS" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#SALUD_MUJER" aria-expanded="false" role="tab" aria-controls="SALUD_MUJER">
												<h4 class="panel-title">
													<span >
														Pacientes de Salud & Mujer <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="SALUD_MUJER" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#SANTA_CRUZ" aria-expanded="false" role="tab" aria-controls="SANTA_CRUZ">
												<h4 class="panel-title">
													<span >
														Pacientes de Santa Cruz <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="SANTA_CRUZ" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#SAN_LUIS" aria-expanded="false" role="tab" aria-controls="SAN_LUIS">
												<h4 class="panel-title">
													<span >
														Pacientes de San Luis <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="SAN_LUIS" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#SAN_PABLO" aria-expanded="false" role="tab" aria-controls="SAN_PABLO">
												<h4 class="panel-title">
													<span >
														Pacientes de San Pablo <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="SAN_PABLO" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#SANTO_DOMINGO" aria-expanded="false" role="tab" aria-controls="SANTO_DOMINGO">
												<h4 class="panel-title">
													<span >
														Pacientes de Santo Domingo <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="SANTO_DOMINGO" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-lavanda sr-only">
											<div class="panel-heading collapsed" role="button" data-toggle="collapse" href="#PNP" aria-expanded="false" role="tab" aria-controls="PNP">
												<h4 class="panel-title">
													<span >
														Pacientes de PNP <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="PNP" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>


									</div>
								</div>
							</div>
							<div class="panel panel-negro">
								<div class="panel-heading">Procedimientos <div class="pull-right"><span class="badge">S/. <span id="sumaParcialProcedimientos">0.00</span></span></div></div>
								<div class="panel-body well">
									<div class="panel-group panelPagos" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel panel-verde sr-only">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse" href="#AUDIOMETRÍA" aria-expanded="false" aria-controls="AUDIOMETRÍA">
														Audiometría <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="AUDIOMETRÍA" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-verde sr-only">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse" href="#CAUTERIZACIÓN" aria-expanded="false" aria-controls="CAUTERIZACIÓN">
														Cauterización <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="CAUTERIZACIÓN" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-verde sr-only">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse" href="#CIRUJÍA" aria-expanded="false" aria-controls="CIRUJÍA">
														Cirujía <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="CIRUJÍA" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-verde sr-only">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse" href="#CURACIÓN" aria-expanded="false" aria-controls="CURACIÓN">
														Curación <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="CURACIÓN" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-verde sr-only">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse" href="#LARINGOSCOPÍA" aria-expanded="false" aria-controls="LARINGOSCOPÍA">
														Laringoscopía <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="LARINGOSCOPÍA" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-verde sr-only">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse" href="#LIBERACIÓN" aria-expanded="false" aria-controls="LIBERACIÓN">
														Liberación de sinequias <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="LIBERACIÓN" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-verde sr-only">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse" href="#OTROS" aria-expanded="false" aria-controls="OTROS">
														Otros <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="OTROS" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
										<div class="panel panel-verde sr-only">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse"  href="#REDUCCIÓN" aria-expanded="false" aria-controls="REDUCCIÓN">
														Reducción <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="REDUCCIÓN" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="panel panel-negro">
								<div class="panel-heading">Otros ingresos<div class="pull-right"><span class="badge">S/. <span id="sumaParcialOtros">0.00</span></span></div></div>	
								<div class="panel-body well">
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel panel-cielo">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse" href="#OTROSINGRESOS" aria-expanded="false" aria-controls="OTROSINGRESOS">
														Ingresos extras <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="OTROSINGRESOS" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>										
									</div>
								</div>
							</div>
							<div class="panel panel-negro">
								<div class="panel-heading">Egresos en el turno<div class="pull-right"><span class="badge">S/. <span id="sumaParcialEgresos">0.00</span></span></div></div>	
								<div class="panel-body well">
									<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
										<div class="panel panel-dulce">
											<div class="panel-heading" role="tab">
												<h4 class="panel-title">
													<span class="collapsed" role="button" data-toggle="collapse"  href="#EGRESOS" aria-expanded="false" aria-controls="EGRESOS">
														Egresos <span class="badge" id="cantidad">0</span>
													</span><div class="pull-right"><span class="badge">S/. <span class="montoSumado">0.00</span></span></div>
												</h4>
											</div>
											<div id="EGRESOS" class="panel-collapse collapse" role="tabpanel" >
												<div class="panel-body panelCuadre"><br>
													<ul class="list-group">
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-negro">
								<div class="panel-heading">Resumen</div>
								<div class="panel-body well text-center">
									<h5>Ingresos: S/. <span id="montoIngresos">0.00</span></h5>
									<h5>Egresos: S/. (<span id="montoEgresos">0.00</span>)</h5>
									<h4>Total: <span>S/. <span id="sumaTotal">0.00</span></span></h4>
								</div>
							</div>
				</div>
		</main>
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
					<div class="alert alert-danger sr-only" role="alert"> <strong>Ouch!</strong> <span></span> </div>
					<p>Ingrese las contraseñas a cambiar</p>
					<div class="row container-fluid">
						<div class="form-group col-sm-6">
							<label for="txtPassAnterior ">Contraseña anterior:</label>
							<input type="password" class="form-control " id="txtPassAnterior" placeholder="Contraseña anterior">
						</div>
						<div class="form-group col-sm-6">
							<label for="txtPassNuevo">Nueva contraseña:</label>
							<input type="password" class="form-control " id="txtPassNuevo" placeholder="Contraseña nueva">
						</div>
						<div class="form-group col-sm-6">
							<label for="txtPassReNuevo">Repita la nueva contraseña:</label>
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
		<script src="./node_modules/moment-precise-range-plugin/moment-precise-range.js"></script>
		<script src="./node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>		
		<script src="js/socketCliente.js"></script>
		
		<script>
			$(document).ready(function () {
				socket.emit('datosDeUsuario', <?php echo $_SESSION['IdUsuario']; ?>);
				var hora='';
				$.get('php/gethora.php').done(function (data) {hora=moment(data,'h:m a').format('H');
				if(parseInt(hora)<=14){llamarpagosDeDia();}
				else{llamarpagosDeNoche();}
				});
				$('#dtpFecha').val(moment().format('YYYY-MM-DD'));
				moment.locale('es');
				$('#txtFechaMovible').val(moment().format('[Hoy,] dddd[,] DD [de] MMMM [de] YYYY'));

			});
			
			
			socket.on('IngresoExtra',function(cantidad, moti){console.log(moti);
				$('#OTROSINGRESOS').find('.panelCuadre ul').append(`<li class="list-group-item"><div class="col-xs-7 col-sm-9 mayuscula"><span class="label label-warning">Nuevo!</span> ${moti.toLowerCase()} </div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(cantidad).toFixed(2)}</div></li>`);
					monto=parseFloat($('#OTROSINGRESOS').parent().find('.montoSumado').text())+cantidad;
					$('#OTROSINGRESOS').parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));					
					$('#sumaParcialOtros').text(parseFloat(monto).toFixed(2));
					calcularSumaDia();
					
			});
			socket.on('EgresoExtra',function(cantidad, moti){
				$('#EGRESOS').find('.panelCuadre ul').append(`<li class="list-group-item"><div class="col-xs-7 col-sm-9 mayuscula"><span class="label label-warning">Nuevo!</span> ${moti.toLowerCase()} </div><div class="col-xs-push-7 col-sm-push-9">S/. ${parseFloat(cantidad).toFixed(2)}</div></li>`);
					monto=parseFloat($('#EGRESOS').parent().find('.montoSumado').text())+cantidad;
					$('#EGRESOS').parent().find('.montoSumado').text(parseFloat(monto).toFixed(2));					
					$('#sumaParcialEgresos').text(parseFloat(monto).toFixed(2));
					calcularSumaDia();
					
			});
			$('#btnUpFecha').click(function(){
				var nuevaFecha=moment($('#dtpFecha').val(),'YYYY-MM-DD');
				nuevaFecha.add(1,'days');
				$('#dtpFecha').val(nuevaFecha.format('YYYY-MM-DD'));
				$('#txtFechaMovible').val(nuevaFecha.format('dddd[,] DD [de] MMMM [de] YYYY'));
				$('#dtpFecha').change();
				//$(this).parent().parent().prev().html('Turno diurno <span class="caret"></span>');
				socket.emit('listarCuadreDiurno', $('#dtpFecha').val());
				$('.cmbTurnoCuadre').html('Turno diurno <span class="caret"></span>');
				
			});
			$('#btnDownFecha').click(function(){
				var nuevaFecha=moment($('#dtpFecha').val(),'YYYY-MM-DD');
				nuevaFecha.subtract(1,'days');
				$('#dtpFecha').val(nuevaFecha.format('YYYY-MM-DD'));
				$('#txtFechaMovible').val(nuevaFecha.format('dddd[,] DD [de] MMMM [de] YYYY'));
				$('#dtpFecha').change();
				//$(this).parent().parent().prev().html('Turno diurno <span class="caret"></span>');
				socket.emit('listarCuadreDiurno', $('#dtpFecha').val());
				$('.cmbTurnoCuadre').html('Turno diurno <span class="caret"></span>');
				
			});
			$('#btnHoyFecha').click(function(){
				var nuevaFecha=moment();				
				$('#dtpFecha').val(nuevaFecha.format('YYYY-MM-DD'));
				$('#txtFechaMovible').val(nuevaFecha.format('[Hoy,] dddd[,] DD [de] MMMM [de] YYYY'));
				$('#dtpFecha').change();
			});
			$('.aTurnoDiurno').click(function(){
				llamarpagosDeDia()
			});
			$('.aTurnoNocturno').click(function(){
				llamarpagosDeNoche();
			});
			function llamarpagosDeNoche() {
				console.log('clic en boton noche con el día ' + $('#dtpFecha').val());
				$('.cmbTurnoCuadre').html('Turno Nocturno <span class="caret"></span>');
				socket.emit('listarCuadreNocturno', $('#dtpFecha').val());
			}
			function llamarpagosDeDia() {
				console.log('clic en boton dia con el día ' + $('#dtpFecha').val());
				$('.cmbTurnoCuadre').html('Turno diurno <span class="caret"></span>');
				socket.emit('listarCuadreDiurno', $('#dtpFecha').val());
			}
			
			
			

		
			$('a[aria-controls="home"]').on('shown.bs.tab', function (){
				
			});
			function limpiarTodoPagos() {
				$('.list-group').empty();
				$('.montoSumado').text('0.00');
			}
			$('h1').click(function() {console.log('1')
				limpiarTodoPagos();
			})
		</script>
	</body>
</html>
<?php	
} else{
	echo '<script> window.location="iniciosesion.php"; </script>';
}
?>