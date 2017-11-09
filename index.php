<?php 
session_start();
include 'php/contServ.php';
if(isset($_SESSION['usuario'])){
	echo '<script> window.location="Cliente.php"; </script>';
}
 ?>

<!DOCTYPE html>
<html lang="es">
<head >
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/icofont.css">
	
	<title>Bienvenido: Infocat-Grifo</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/inicio.css?version=1.0" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link rel="shortcut icon" href="images/peto.png" />


</head>

<body >
<style type="text/css">
	body{background: linear-gradient(90deg, #100b19 10%, #291c40 90%);}
	.container{ margin-top:80px; padding:0 50px}
	.wello{padding:40px 50px; border-radius: 6px;padding-bottom: 58px;}
	.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none;   /* Chrome/Safari/Opera */
  -khtml-user-select: none;    /* Konqueror */
  -moz-user-select: none;      /* Firefox */
  -ms-user-select: none;       /* Internet Explorer/Edge */
  user-select: none;           /* Non-prefixed version, currently
                                  not supported by any browser */
}
input{height: 40px!important;}
label{font-size: 14px!important}
</style>
<div class="container noselect">
	<div class="row">
		<div class="col-md-12">
			<div class="wello login-box" style="color:#493267" >
				<div class="row">
					<div class="col-xs-4"><img src="images/VirtualCorto.png" class="img-responsive" alt=""></div>
					<div class="col-xs-7"><h3 class="text-center" style="margin-bottom: 0px;">Virtual Pet </h3>
						<div class="text-center"><span >Sistema para Consultorio ORL</span></div>
						<legend  style="color:#493267"><small style=" font-size: 70%;"></small></legend></div>
				</div>
				
			<div class="form-group">
				<label for=""><i class="icofont icofont-doctor-alt"></i> Usuario</label>
				<input class="form-control" value='' id="txtUser_VirtualPet" placeholder="Ingrese su nombre de usuario" type="text" autocomplete="off" />
			</div>
			<div class="form-group">
				<label for=""><i class="icofont icofont-key"></i> Contraseña</label>
				<input class="form-control" id="txtPassw" value='' placeholder="Contraseña" type="password" autocomplete="off" />
			</div>
			
			<div class="form-group text-center">
				<button class="btn btn-danger btn-outline" id="btnCancelar"><i class="icofont icofont-logout"></i> Cancelar</button>
				<button class="btn btn-morado btn-outline" id="btnAcceder"><div class="fa-spin sr-only"><i class="icofont icofont-spinner"></i> </div><i class="icofont icofont-key"></i> Iniciar</button>
			</div>
			<div class="form-group text-center text-danger animated fadeIn hidden" id="divError">Error en alguno de los datos, complételos todos cuidadosamente.</div>
			
			<div class="pull-right" style="margin-bottom: 10px" ><small><?php include 'php/version.php' ?> | <?php echo date("Y"); ?> <a href="https://info-cat.com/consultorioorl">® Un producto de Infocat Sol S.A.C</a></small></div>
			</div>
		</div>
	</div>
</div>
</body>

	<script src="js/jquery-2.2.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<!-- <script src="./node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script> 
	<script src="js/socketCliente.js"></script>-->
	<script>
		$(document).ready(function () {
			$('#txtUser_VirtualPet').val('');
			$('#txtPassw').val('');
			$('#txtUser_VirtualPet').focus();
			$('.wello').addClass('animated bounceIn');
			$('.fa-spin').addClass('sr-only');
			//$('body').css("background-image", "url(images/fondo.jpg)");		
		});
		$('#txtPassw').keypress(function(event){
			if (event.keyCode === 10 || event.keyCode === 13) 
				{event.preventDefault();
				$('#btnAcceder').click();
			 }
		});
		$('#btnAcceder').click(function() {
			$('.fa-spin').removeClass('sr-only');$('.icofont-key').addClass('sr-only');
			$('#divError').addClass('hidden');
			$.ajax({
				type:'POST',
				url: 'php/validarLogin.php',
				data: {user: $('#txtUser_VirtualPet').val(), pw: $('#txtPassw').val()},
				success: function(iduser) {
					if (iduser!=0){//console.log('el id es '+data)
						//console.log(iduser)
						window.location="Cliente.php";
					}
					else {
						$('#divError').removeClass('hidden');
						//var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
						// $('#btnAcceder').addClass('animated wobble' ).one(animationEnd, function() {
						// 		$(this).removeClass('animated wobble');
						// });
						$('#txtUser_VirtualPet').select();
						$('.fa-spin').addClass('sr-only');$('.icofont-key').removeClass('sr-only');
						//console.log(iduser);
						console.log('error en los datos')}
				}
			});
		});
		$('#btnCancelar').click(function () {
			window.location='https://www.gooogle.com.pe';
		})	
	</script>
</html>