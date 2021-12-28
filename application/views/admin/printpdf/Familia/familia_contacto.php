<?php

date_default_timezone_set('America/Lima');

$date_current = date("Y-m-d H:i:s");

$pdf->AddPage(); //'P', 'A4', 0
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(190, 5, '', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(190, 5, 'LISTA DE FAMILIA PARA CONTACTO', 0, 1, 'C');
$pdf->Cell(190, 5, '', 0, 1, 'C');

$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', '', 7.5);
$pdf->Cell(7, 5, 'NRO', 1, 0, 'C', 1);
//$pdf->Cell(6, 5, 'NI', 1, 0, 'C', 1);
$pdf->Cell(12, 5, 'DNI', 1, 0, 'C', 1);
$pdf->Cell(32, 5, 'NOMBRES', 1, 0, 'C', 1);
$pdf->Cell(24, 5, 'APE PATERNO', 1, 0, 'C', 1);
$pdf->Cell(24, 5, 'APE MATERNO', 1, 0, 'C', 1);
//$pdf->Cell(37, 5, utf8_decode('DIRECCIÓN'), 1, 0, 'C', 1);
$pdf->Cell(52, 5, utf8_decode('DIRECCIÓN'), 1, 0, 'C', 1);
$pdf->Cell(27, 5, 'BARRIO', 1, 0, 'C', 1);
$pdf->Cell(14, 5, 'CELULAR', 1, 1, 'C', 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$count = 1;

$pdf->SetFont('arial', '', 7);

foreach ($familia as $row) :

	$pdf->Cell(7, 3.5, utf8_decode(str_pad($count, 4, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
	//$pdf->Cell(6, 3.5, utf8_decode(str_pad($count_inst, 3, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
	$pdf->Cell(12, 3.5, utf8_decode($row->dni), 1, 0, 'C', 1);
	$pdf->Cell(32, 3.5, utf8_decode(strtoupper($row->nombres)), 1, 0, 'L', 1);
	$pdf->Cell(24, 3.5, utf8_decode(strtoupper($row->ape_pat)), 1, 0, 'L', 1);
	$pdf->Cell(24, 3.5, utf8_decode(strtoupper($row->ape_mat)), 1, 0, 'L', 1);
	$pdf->Cell(52, 3.5, utf8_decode(strtoupper($row->direccion)), 1, 0, 'L', 1);

	$pdf->Cell(27, 3.5, utf8_decode($row->barrio), 1, 0, 'L', 1);
	$pdf->Cell(14, 3.5, utf8_decode($row->celular != 0 ? $row->celular : ''), 1, 1, 'C', 1);

	$count++;

endforeach;

$pdf->Output();
