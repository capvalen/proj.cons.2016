<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bienvenido: Infocat-Grifo</title>
	<link href="css/bootstrap.4.6.min.css" rel="stylesheet">
</head>
<body>
<style>
	body{
		background-color: #310b4d;
	}
	.container{
		z-index:20
	}
	h2{font-size: 2rem; font-weight: 300;}
	input{
		margin: 1.5rem 0;
    background-color: #ffffff36!important;
		color:white!important;
		font-size: 1.2rem!important;
		border: 1px solid #d5ceda7a!important;
	}
	input::placeholder{
		text-align: left;
		padding-left: 0.5rem;
		color:white!important;
		font-size: 1rem!important;
	}
	.btn-primary{
		background-color: #23b348;
		border: 1px solid #23b348;
	}
	.btn-primary:hover{
		background-color: #159235;
		border: 1px solid #159235;
	}
	.pie{line-height: 1; color: #f8f9fa91!important;}
	a, a:hover{
		color:#b36be0!important;
	}
	.ondas{
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		height: 300px;
		background: url('images/ondas.png');
		background-repeat: no-repeat;
		background-size: cover;
		opacity: 0.5;
		background-position: right top;
		z-index:-1;
	}
</style>
<div class="container">
	<div class="row d-flex justify-content-center mt-5 pt-5">
		<div class="col-10 col-md-5 col-lg-4 text-light ">
			<center><img src="images/VirtualCorto.png" class="img-fluid"></center>
			<h2 class="text-center" >CONSULTORIO ORL</h2>
			<p class="text-center" >Ingrese su usuario y contraseña</p>

			<div class=" ">
				<input class="form-control " value='' id="txtUser_app" placeholder="Usuario" type="text" autocomplete="nope" />
				<input class="form-control " id="txtPassw" value='' placeholder="Contraseña" type="password" autocomplete="nope" />
				<button class="btn btn-primary btn-block btn-lg" id="btnAcceder"> Iniciar sesión</button>
			</div>
			<p class="pie mb-0 mt-2"><small>Versión: <?php include 'php/version.php' ?> </small></p>
			<p class="pie mb-0"><small>© Derechos reservados  2016 - <?php echo date("Y");?></small></p>
			<p class="pie mb-0"><small>Desarrollado por <a href="https://infocatsoluciones.com">Infocat Soluciones SAC ®</a></small></p>
		</div>
	</div>
</div>
<div class="ondas"></div>
	
<script src="js/jquery-2.2.4.min.js"></script>
<script>
	$(document).ready(function () {
		$('#txtUser_app').val('');
		$('#txtPassw').val('');
		$('#txtUser_app').focus();
		/*$('.wello').addClass('animated bounceIn');*/
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
			data: {user: $('#txtUser_app').val(), pw: $('#txtPassw').val()},
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
					$('#txtUser_app').select();
					$('.fa-spin').addClass('sr-only');$('.icofont-key').removeClass('sr-only');
					//console.log(iduser);
					console.log('error en los datos')}
			}
		});
	});
</script>
</body>
</html>