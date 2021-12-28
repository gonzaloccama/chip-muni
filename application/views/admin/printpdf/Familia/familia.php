<?php

date_default_timezone_set('America/Lima');

$date_current = date("Y-m-d H:i:s");

$pdf->AddPage(); //'P', 'A4', 0
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);

//$pdf->SetFillColor(28, 132, 198);
$pdf->Cell(190, 5, '', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(190, 5, utf8_decode($title), 0, 1, 'C');
$pdf->Cell(190, 5, '', 0, 1, 'C');

$row_higth = 5;

$col_weigth = [
	'nro' => 7,
	'dni' => 12,
	'nombre' => 36,
	'pat' => 30,
	'mat' => 30,
	'nest' => 7,
	'cse' => 22,
	'fentrega' => 24,
	'plan' => 8,
	'numero' => 14
];

$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', '', 7.5);

$pdf->Cell($col_weigth['nro'], $row_higth, 'NRO', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['dni'], $row_higth, 'DNI', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['nombre'], $row_higth, 'NOMBRES', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['pat'], $row_higth, 'APE PATERNO', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['mat'], $row_higth, 'APE MATERNO', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['nest'], $row_higth, 'EST', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['cse'], $row_higth, 'CSE-SISFOH', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['fentrega'], $row_higth, 'FECHA ENTREGA', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['plan'], $row_higth, 'PLAN', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['numero'], $row_higth, 'NUMERO', 1, 1, 'C', 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$count = 1;
$row_higth = 4;

$pdf->SetFont('Arial', '', 6.6);

foreach ($familia as $row) :

	$pdf->Cell($col_weigth['nro'], $row_higth, utf8_decode(str_pad($count, 4, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['dni'], $row_higth, utf8_decode($row->dni), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['nombre'], $row_higth, utf8_decode($row->nombres), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['pat'], $row_higth, utf8_decode($row->ape_pat), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['mat'], $row_higth, utf8_decode($row->ape_mat), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['nest'], $row_higth, utf8_decode($row->total_estudiante), 1, 0, 'C', 1);

	$pdf->Cell($col_weigth['cse'], $row_higth, utf8_decode($row->cse), 1, 0, 'C', 1);

	if ($row->fecha_entrega != 0000) {
		$pdf->SetFillColor(97, 218, 215);
		$pdf->Cell($col_weigth['fentrega'], $row_higth, utf8_decode($row->fecha_entrega), 1, 0, 'C', 1);
	} else {
		$pdf->Cell($col_weigth['fentrega'], $row_higth, utf8_decode('Chip no entregado'), 1, 0, 'C', 1);
	}

//		$pdf->Cell(25, 5, utf8_decode($row->plan), 1, 1, 'C', 1);
	$pdf->SetFillColor(255, 255, 255);

	if ($row->plan == 5) {
		$pdf->SetFillColor(97, 218, 215);
		$pdf->Cell($col_weigth['plan'], $row_higth, $row->plan, 1, 0, 'C', 1);
	} elseif ($row->plan == 2) {
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell($col_weigth['plan'], $row_higth, $row->plan, 1, 0, 'C', 1);
	} else {
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell($col_weigth['plan'], $row_higth, $row->plan, 1, 0, 'C', 1);
	}

	$pdf->Cell($col_weigth['numero'], $row_higth, utf8_decode($row->numero_chip), 1, 1, 'C', 1);


	$pdf->SetFillColor(255, 255, 255);
	$count++;

endforeach;


$pdf->Output();


