<?php
	session_start();
	include 'contServ.php';

	$usuario = $_POST['user'];
	$pw = $_POST['pw'];
	mysql_query("set charset utf8;");
	$log = mysql_query("SELECT * FROM usuario WHERE usuNick='$usuario' AND usuPass='$pw'");
	echo mysql_num_rows($log);
	if (mysql_num_rows($log)>0) {
		$row = mysql_fetch_array($log);
		$_SESSION["usuario"] = $row['usuNombre'].' '.$row['usuApellidos']; //Me entrega el id del usuario
		$_SESSION["IdUsuario"] = $row['idUsuario'];
	  	echo $row['idUsuario'];
	  	//echo $usuario . ' entro' ;
	  	//echo "SELECT * FROM usuario WHERE usuNick='$usuario' AND usuPass='$pw'";
	}
	else{// sino me devuelve 0
		echo '0';
		//echo "SELECT * FROM usuario WHERE usuNick='$usuario' AND usuPass='$pw'";
	}
?>