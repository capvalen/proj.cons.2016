<?php 
	
	$conect= mysqli_connect('localhost','root','')or die("No se ha podido establecer la conexion");
	$sdb= mysqli_select_db($conect, 'consulto_orl_web')or die("La base de datos no existe");
	$conect->set_charset("utf8");
 ?>