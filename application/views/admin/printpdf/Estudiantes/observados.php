<?php

date_default_timezone_set('America/Lima');

$date_current = date("Y-m-d H:i:s");


$pdf->AddPage(); //'P', 'A4', 0
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);

//$pdf->SetFillColor(28, 132, 198);
$pdf->Cell(277, 5, '', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(277, 5, utf8_decode('LISTA DE ESTUDIANTES OBSERVADOS CON INFORMACIÓN FALTANTE'), 0, 1, 'C');
$pdf->Cell(190, 5, '', 0, 1, 'C');

$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);

//$pdf->ln(0);

$pdf->Cell(6, 0, 'NRO', 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(6, 0, '', 1, 0, 'C', 1);
$pdf->Cell(28+53, 8, 'DATOS DEL RESPONSABLE DEL ESTUDIANTE', 1, 0, 'C', 1);
$pdf->Cell((14+58+48+19), 8, 'DATOS DEL ESTUDIANTE', 1, 0, 'C', 1);
$pdf->Cell(51, 0, '', 1, 1, 'C', 1);
$pdf->Cell(6, 13, '', 0, 1, 'C', 1);

$pdf->SetFont('Arial', '', 7);
$pdf->Cell(6, -13, 'NRO', 1, 0, 'C', 1);
$pdf->Cell(14, -5, 'CODIGO', 1, 0, 'C', 1);
$pdf->Cell(14, -5, 'DNI', 1, 0, 'C', 1);
$pdf->Cell(53, -5, 'NOMBRES', 1, 0, 'C', 1);
$pdf->Cell(14, -5, 'DNI', 1, 0, 'C', 1);
$pdf->Cell(58, -5, utf8_decode('NOMBRES'), 1, 0, 'C', 1);
$pdf->Cell(48, -5, utf8_decode('INSTITUCIÓN'), 1, 0, 'C', 1);
$pdf->Cell(19, -5, 'NIVEL', 1, 0, 'C', 1);
$pdf->Cell(51, -13, 'OBSERVACIONES', 1, 1, 'C', 1);
//$pdf->Cell(20, 5, 'CELULAR', 1, 1, 'C', 1);

//$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->ln(13);


$count = 1;

foreach ($observados as $row) :

	$pdf->SetFillColor(255, 255, 255);
	$pdf->Cell(6, 5, utf8_decode(str_pad($count, 3, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
	$pdf->Cell(14, 5, utf8_decode($row->codigo), 1, 0, 'C', 1);
	$pdf->Cell(14, 5, utf8_decode($row->dni_f), 1, 0, 'C', 1);
	$pdf->Cell(53, 5, utf8_decode($row->nombres_f), 1, 0, 'L', 1);
	$pdf->Cell(14, 5, utf8_decode($row->dni_e), 1, 0, 'C', 1);
	$pdf->Cell(58, 5, utf8_decode($row->nombres_e), 1, 0, 'L', 1);
	$pdf->Cell(48, 5, utf8_decode($row->institucion), 1, 0, 'L', 1);
	$pdf->Cell(19, 5, utf8_decode($row->nivel), 1, 0, 'L', 1);
	if	($row->observations == "DNI ACTUALIZADO"){
		$pdf->SetFillColor(0, 255, 0);
		$pdf->Cell(51, 5, utf8_decode($row->observations), 1, 1, 'L', 1);
	}else
	{
		$pdf->Cell(51, 5, utf8_decode($row->observations), 1, 1, 'L', 1);
	}

	$count++;

endforeach;


$pdf->Output();
