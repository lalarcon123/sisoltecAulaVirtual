<?php
include('../class/classAsistencias.php');
$clase = new sistema;
$clase->conexion();

$registro = $_SESSION['cod_asistencia'];
$estudiante = $_POST['nombre'];

mysql_query("INSERT INTO detalle_asistencias (cod_asistencia, estudiante)VALUES('$registro','$estudiante') ");


//DEVOLVER LOS NOMBRES DE LOS ESTUDIANTES REGISTRADOS
$resultado = mysql_query("SELECT * FROM detalle_asistencias WHERE cod_asistencia = '$registro' ");

echo '<ul>';
while($mostrar = mysql_fetch_array($resultado)){
	echo '<li>'.$mostrar['estudiante'].'</li>';
}
echo '</ul>';
?>