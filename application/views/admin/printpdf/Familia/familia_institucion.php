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
if (isset($insti) && !empty($insti)) {
	$pdf->Cell(190, 9, utf8_decode($insti), 0, 1, 'C');
}

$pdf->Cell(190, 5, '', 0, 1, 'C');

$row_higth = 5;

$col_weigth = [
	'nro' => 6,
	'nro_inst' => 5,
	'dni' => 12,
	'nombre' => 35,
	'pat' => 29,
	'mat' => 29,
	'institucion' => 45,
	'nivel' => 16,
	'numero_chip' => 13,
	'fecha_entrega' => 15
];

$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', '', 7.5);

$pdf->Cell($col_weigth['nro'], $row_higth, 'NRO', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['nro_inst'], $row_higth, 'IN', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['dni'], $row_higth, 'DNI', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['nombre'], $row_higth, 'NOMBRES', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['pat'], $row_higth, 'APE PATERNO', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['mat'], $row_higth, 'APE MATERNO', 1, 0, 'C', 1);
$pdf->Cell($col_weigth['institucion'], $row_higth, utf8_decode('INSTITUCIÓN'), 1, 0, 'C', 1);
$pdf->Cell($col_weigth['nivel'], $row_higth, 'NIVEL', 1, 0, 'C', 1);

$pdf->Cell($col_weigth['numero_chip'], $row_higth, 'NUMERO', 1, 1, 'C', 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$count = 1;
$row_higth = 4;
$count_inst = 1;
$institucion_ = '';

$pdf->SetFont('Arial', '', 6.6);

foreach ($familia as $row) :

	if ($institucion_ != utf8_decode($row->institucion)) {
		$count_inst = 1;
		$pdf->SetFillColor(7, 99, 9);
	}
	if (isset($insti) && !empty($insti)) {
		$pdf->SetFillColor(255, 255, 255);
	}

	$pdf->Cell($col_weigth['nro'], $row_higth, utf8_decode(str_pad($count, 4, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['nro_inst'], $row_higth, utf8_decode(str_pad($count_inst, 3, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['dni'], $row_higth, utf8_decode($row->dni), 1, 0, 'C', 1);
	$pdf->Cell($col_weigth['nombre'], $row_higth, utf8_decode($row->nombres), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['pat'], $row_higth, utf8_decode($row->ape_pat), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['mat'], $row_higth, utf8_decode($row->ape_mat), 1, 0, 'L', 1);
	$pdf->Cell($col_weigth['institucion'], $row_higth, $institucion_ = utf8_decode($row->institucion), 1, 0, 'L', 1);

	$pdf->Cell($col_weigth['nivel'], $row_higth, utf8_decode($row->nivel), 1, 0, 'C', 1);

	if ($row->numero_chip != '') {
		$pdf->SetFillColor(97, 190, 215);
		$pdf->Cell($col_weigth['numero_chip'], $row_higth, utf8_decode($row->numero_chip), 1, 1, 'C', 1);
	}else {
		$pdf->Cell($col_weigth['numero_chip'], $row_higth, utf8_decode('No recogió'), 1, 1, 'C', 1);
	}
	$pdf->SetFillColor(255, 255, 255);
	$count++;
	$count_inst++;

endforeach;


$pdf->Output();


