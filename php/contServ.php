<?php 
	$conect = @mysql_connect("localhost","root","*123456*") or die("No se encontró el servidor");
	mysql_select_db("consultorio",$conect)or die("No se encontró la base de datos");
	mysql_query("set charset utf8;");

 ?>