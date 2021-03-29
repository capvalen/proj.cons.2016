<?php 

include "../php/conexion.php";
include "fpdf/fpdf.php";


$esclavo= new mysqli($server, $username, $password, $db);
$esclavo->set_charset("utf8");

$nHC=$_GET['hc'];
$nReceta=$_GET['receta'];


$sql="SELECT r.*, c.cliApellidoPaterno, c.cliApellidoMaterno, c.cliNombres FROM `recetas` r 
inner join cliente c on c.idCliente = r.idCliente
where idReceta = {$nReceta} and r.idCliente = {$nHC}; ";
$resultado=$esclavo->query($sql);
$row=$resultado->fetch_assoc();

$recetaP=json_decode( $row['contReceta'] );
//var_dump( $recetaP ); 

$pdf = new FPDF();
$pdf->SetTitle('Certificado INAPROF');
$pdf->AddPage('L');
$pdf->SetAutoPageBreak(false);
$mitad=$pdf->GetPageWidth()/2;
$total=$pdf->GetPageWidth();
/* $pdf->Image( 'images/vertical.png', $mitad, 3, 0.1, 200);  */
$pdf->Image( 'images/cabecera.png', 0, 0, $mitad);
$pdf->Image( 'images/pie.png', 0, 180, $mitad);
$pdf->Image( 'images/cabecera_gris.png', $mitad+1, 0, $mitad);
$pdf->Image( 'images/pie_gris.png', $mitad+1, 180, $mitad);


$pdf->SetFont('Arial','B',12);
$pdf->SetXY(0,25);


marron($pdf);
$pdf->Cell($mitad, 5, utf8_decode( "RECETARIO" ), 0, 0, 'C');
negro($pdf);
$pdf->Cell($mitad, 5, utf8_decode( "RECETARIO" ), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$pdf->Cell($total/3, 5, utf8_decode( "Paciente: " . "{$row['cliApellidoPaterno']} {$row['cliApellidoMaterno']} {$row['cliNombres']}" ));
$pdf->Cell(45, 5, utf8_decode( "N° H.C.: " . "50026"  ));
$pdf->Cell($total/3, 5, utf8_decode( "Paciente: " . "{$row['cliApellidoPaterno']} {$row['cliApellidoMaterno']} {$row['cliNombres']}" ));
$pdf->Cell(45, 5, utf8_decode( "N° H.C.: " . "50026"  ));

$pdf->SetXY(10,35);
$pdf->SetFont('Arial','B',8);
$pdf->Cell($mitad, 5, utf8_decode( "Receta:" ), 0, 0, 'L');
$pdf->SetFont('Arial','',8);
$pdf->Ln();

$posXActual = 40;
for ($i=0; $i < count($recetaP) ; $i++) { 
	if($recetaP[$i]->esTexto==1){
		$pdf->SetX(15);
		$pdf->MultiCell($mitad, 5, utf8_decode( $recetaP[$i]->relleno ));
	}else{
		$pdf->Image( 'images/path833.png', 11, $posXActual, 30 );
	}
	$posXActual+=5;
}



$pdf->SetXY($mitad+10,35);
$pdf->SetFont('Arial','B',8);
$pdf->Cell($mitad, 5, utf8_decode( "Receta:" ), 0, 0, 'L');
$pdf->SetFont('Arial','',8);
$pdf->Ln();
$pdf->SetXY($mitad+15,40);

$posXActual = 40;
for ($i=0; $i < count($recetaP) ; $i++) { 
	if($recetaP[$i]->esTexto==1){
		$pdf->SetX($mitad+15);
		$pdf->MultiCell($mitad, 5, utf8_decode( $recetaP[$i]->relleno ));
	}else{
		$pdf->Image( 'images/path833.png', 11, $posXActual, 30 );
	}
	$posXActual+=5;
}


$pdf->SetFont('Arial','',8);
$pdf->Text($mitad-30, 200, date("d") . "/". date("m") ."/". date("Y"));
$pdf->Text($total-30, 200, date("d") . "/". date("m") ."/". date("Y"));
$pdf->SetFont('Arial','',6.5);
$pdf->SetXY(30,203);
marron($pdf);
$pdf->Cell($mitad, 5, utf8_decode( "davidbalbinvilla@gmail.com" ));

$pdf->Image( 'images/firma.png', $mitad-38, 180, 30 );

$pdf->Output();

function negro($pdf){ $pdf->SetTextColor(0,0,0); }
function marron($pdf){ $pdf->SetTextColor(92,63,22); }
 ?>