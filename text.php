<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/espera.css">
</head>
<body>
	
	<div id="overlay">
		<div class="letra">esperando</div>
		<div class="espera"></div>
	</div>
	<h3>text</h3>
	<iframe width="560" height="315" src="https://www.youtube.com/embed/Kb8PG8b-dek" frameborder="0" allowfullscreen></iframe>
</body>
	<script>
		
		/*var x = "<?php // echo $_POST['otro'];?>";
		console.log(parseInt(x)+9);*/
		var overlay=document.getElementById('overlay');
		window.addEventListener('load',function(){
			overlay.style.display='none';
		});
	</script>
</html>