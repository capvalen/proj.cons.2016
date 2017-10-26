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
	<link rel="stylesheet" href="css/icofont.css"> <!--Iconos en: https://design.google.com/icons/-->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/inicio.css?version=1.0" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<title>Consultorio ORL</title>
	<link rel="shortcut icon" href="images/favicon.png">

</head>

<body >
<style type="text/css">
	body{background: linear-gradient(90deg, #100b19 10%, #291c40 90%);}
	.container{ margin-top:80px; padding:0 50px}
	.wello{padding:40px 50px; border-radius: 6px;}
	.form-control:focus{border-color: #9866e9;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(122, 81, 189, 0.6);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(122, 81, 189, 0.6);}
	.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none;   /* Chrome/Safari/Opera */
  -khtml-user-select: none;    /* Konqueror */
  -moz-user-select: none;      /* Firefox */
  -ms-user-select: none;       /* Internet Explorer/Edge */
  user-select: none;           /* Non-prefixed version, currently
                                  not supported by any browser */
}
	a{color: #4b33a7;}
</style>
<div class="container noselect">
	<div class="row">
		<div class="col-md-12">
			<div class="wello login-box">
				<h2 class="text-center" style="font-weight:300;">Consultorio ORL</h2>
				<legend><small>Centro médico especializado en oído, nariz y garganta</small></legend>
				
			<div class="form-group">
				<label for="username"><i class="icofont icofont-nurse-alt"></i> Usuario</label>
				<input class="form-control" value='' id="txtUsuario" placeholder="Ingrese su nombre de usuario" type="text"  />
			</div>
			<div class="form-group">
				<label for="password"><i class="icofont icofont-key"></i> Contraseña</label>
				<input class="form-control" id="txtPassw" value='' placeholder="Contraseña" type="password" />
			</div>
			
			<div class="form-group text-center">
				<button class="btn btn-danger btn-outline" id="btnCancelar"><i class="icofont icofont-logout"></i> Cancelar</button>
				<button class="btn btn-morado btn-outline" id="btnAcceder"><div class="fa-spin sr-only"><i class="icofont icofont-spinner"></i> </div><i class="icofont icofont-key"></i> Iniciar</button>
			</div>
			<div class="form-group text-center text-danger hidden" id="divError">Error en alguno de los datos, complételos todos cuidadosamente.</div>
			
			<div class="pull-right" ><small><?php include 'php/version.php' ?> | 2016-<?php echo date("Y"); ?> <a href="https://info-cat.com" target="_blank">®  Info-cat</a></small></div>
			</div>
		</div>
	</div>
</div>
</body>

	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/jquery.md5.js"></script>
	
	<!-- <script src="./node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script> 
	<script src="js/socketCliente.js"></script>-->
	<script>
		$(document).ready(function () {
			$('#txtUsuario').focus();
			$('.wello').addClass('animated bounceIn');
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
			$.ajax({
				type:'POST',
				url: 'php/validarLogin.php',
				data: {user: $('#txtUsuario').val(), pw: $.md5($('#txtPassw').val())},
				success: function(iduser) {
					if (iduser!=0){//console.log('el id es '+data)
						//console.log(iduser)
						window.location="Cliente.php";
					}
					else {
						$('#divError').removeClass('hidden');
						var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
						$('#btnAcceder').addClass('animated wobble' ).one(animationEnd, function() {
								$(this).removeClass('animated wobble');
						});
						$('#txtUsuario').select();
						$('.fa-spin').addClass('sr-only');$('.icofont-key').removeClass('sr-only');
						//console.log(iduser);
						console.log('error en los datos')}
				}
			});
		});
		
	</script>

</html>