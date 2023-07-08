<?php 

define('FPDF_FONTPATH', 'font/');
require ('fpdf.php');
require_once('includes/load.php');
$id_user  = $_GET['id_user'];
//echo $id_user;
$id_curso = $_GET['id_curso'];
//echo $id_curso;

$datos = find_by_id_certificado('estudiante_curso',$id_curso,$id_user);
if (isset($datos['estudiante'])){
	$estudiante = $datos['estudiante'];
}
if (isset($datos['descripcion'])){
	$curso = $datos['descripcion'];
	$fecha_inio = $datos['fecha_inicio'];
	$fecha_fin = $datos['fecha_fin'];
}
# code...

//Propiedades
//$datos = $_POST['cedula'];


//$pdf = new FPDF('L','cm',array(29.700,21));
$pdf=new FPDF('L','mm','A4');
$pdf->SetTextColor(0,0,0);

$pdf->AddPage();
$pdf->Image('img/certificado.png',0,0,297,210,'PNG');

// Nombre y Apellido
$pdf->SetFont('helvetica','B',35);
$pdf->Text(50,95,$estudiante);


$pdf->SetFont('helvetica','B',30);
$pdf->Text(20,150,$curso);


// Fecha Inicio
$pdf->SetFont('helvetica','B',15);
$pdf->Text(125,180,'Desarrollado desde');

$pdf->SetFont('helvetica','B',15);
$pdf->Text(180,180,$fecha_inio);

// Fecha Fin
$pdf->SetFont('helvetica','B',15);
$pdf->Text(215,180,'Hasta');

$pdf->SetFont('helvetica','B',15);
$pdf->Text(240,180,$fecha_fin);


$pdf->Output('certificado','I');

?>