<?php 


//$link = mysqli_connect("localhost", "consulto_root", "*123456*", "consulto_orl_web");
require 'conexion.php';


/* verificar la conexión */
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
//$link->set_charset("utf8");

$query = "call listarGrado()";



$result = mysqli_query($conection, $query);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	echo '<option value="'.$row['idGradoEstudios'].'" >'. $row['gradDescripcion'].'</option>';
}




/* liberar la serie de resultados */
mysqli_free_result($result);

/* cerrar la conexión */
mysqli_close($conection);
?>