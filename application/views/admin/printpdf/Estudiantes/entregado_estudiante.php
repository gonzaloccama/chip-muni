<?php

date_default_timezone_set('America/Lima');

$date_current = date("Y-m-d H:i:s");

$row_higth = 5;

$col_weigth = [
	'nro' => 6,
	'nroinst' => 5,
	'dni' => 11,
	'nombre' => 33,
	'pat' => 28,
	'mat' => 30,
	'insti' => 47,
	'nivel' => 16,
	'fentrega' => 21,
	'dnifam' => 11,
	'respon' => 56,
	'celular' => 13
];


$pdf->AddPage(); //'P', 'A4', 0
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);

//$pdf->SetFillColor(28, 132, 198);
$pdf->Cell(277, 5, '', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(277, 5, $title, 0, 1, 'C');
$pdf->Cell(277, 5, '', 0, 1, 'C');

$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', '', 7.5);
$pdf->Cell($col_weigth['nro'], $row_higth, 'NRO', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['nroinst'], $row_higth, 'NI', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['dni'], $row_higth, 'DNI', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['nombre'], $row_higth, 'NOMBRES', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['pat'], $row_higth, 'APE PATERNO', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['mat'], $row_higth, 'APE MATERNO', 1, 0, 'C', 1);
//$pdf->Cell(37, 5, utf8_decode('DIRECCIÓN'), 1, 0, 'C', 1);
$pdf->Cell($col_weigth['insti'], $row_higth, 'INSTITUCION', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['nivel'], $row_higth, 'NIVEL', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['fentrega'], $row_higth, 'FEC. ENTREGA', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['dnifam'], $row_higth, 'FAMILIA', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['respon'], $row_higth, utf8_decode('RESPONSABLE'), 1, 0, 'C', 1);
$pdf->Cell($col_weigth['celular'], $row_higth, utf8_decode('CELULAR'), 1, 1, 'C', 1);

//$pdf->Cell(20, 5, 'CELULAR', 1, 1, 'C', 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);


$count = 1;
$count_inst = 1;
$row_higth = 3.5;

$institucion = "";

$pdf->SetFont('arial', '', 6);

foreach ($estudiante as $row) :

	if ($row->institucion != $institucion):
		$pdf->SetFillColor(97, 180, 65);
		$count_inst = 1;
	endif;

	$pdf->Cell($col_weigth['nro'], $row_higth, utf8_decode(str_pad($count, 4, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['nroinst'], $row_higth, utf8_decode(str_pad($count_inst, 3, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['dni'], $row_higth, utf8_decode($row->dni), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['nombre'], $row_higth, utf8_decode(strtoupper($row->nombres)), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['pat'], $row_higth, utf8_decode(strtoupper($row->ape_pat)), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['mat'], $row_higth, utf8_decode(strtoupper($row->ape_mat)), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['insti'], $row_higth, utf8_decode($institucion = $row->institucion), 1, 0, 'L', 1);

	$pdf->Cell($col_weigth['nivel'], $row_higth, utf8_decode($row->nivel), 1, 0, 'C', 1);

	$pdf->SetFillColor(255, 255, 255);

	if ($row->fecha_entrega != 0000) {
		$pdf->SetFillColor(97, 190, 215);
		$pdf->Cell($col_weigth['fentrega'], $row_higth, utf8_decode($row->fecha_entrega), 1, 0, 'C', 1);
	} else {
		$pdf->Cell($col_weigth['fentrega'], $row_higth, utf8_decode('Chip no entregado'), 1, 0, 'C', 1);
	}

	$pdf->SetFillColor(255, 255, 255);

	$pdf->Cell($col_weigth['dnifam'], $row_higth, utf8_decode($row->dni_familia), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['respon'], $row_higth, utf8_decode(strtoupper($row->responsable)), 1, 0, 'L', 1);

	if ($row->fecha_entrega != 0000) {
		$pdf->SetFillColor(97, 190, 215);
		$pdf->Cell($col_weigth['celular'], $row_higth, utf8_decode(strtoupper($row->celular)), 1, 1, 'L', 1);
	} else {
		$pdf->Cell($col_weigth['celular'], $row_higth, utf8_decode(''), 1, 1, 'L', 1);
	}

	$pdf->SetFillColor(255, 255, 255);

	$count++;
	$count_inst++;

endforeach;


$pdf->Output();
