<?php
	$server="localhost";
	$username="root";
	$password="*123456*";
	$db='consultorioweb';
	$conection= mysqli_connect($server,$username,$password)or die("No se ha podido establecer la conexion");
	$sdb= mysqli_select_db($conection,$db)or die("La base de datos no existe");
	$conection->set_charset("utf8");



// Conexión del servidor

// 	$server="localhost";
// 	$username="consulto_root";
// 	$password="*123456*";
// 	$db='consulto_orl_web';
// 	$conection= mysqli_connect($server,$username,$password)or die("No se ha podido establecer la conexion");
// 	$sdb= mysqli_select_db($conection,$db)or die("La base de datos no existe");
// 	$conection->set_charset("utf8");
 

 ?>


