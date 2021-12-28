<?php
require ('application/views/admin/printpdf/fpdf/fpdf.php');
require_once ('application/models/admin/Query_print_familia.php');


date_default_timezone_set('America/Lima');

$date_current = date("Y-m-d H:i:s");

class PDF extends FPDF
{
	function Header()
	{
		$this->AddLink();
		$this->Cell(190,0, '', 1,1,'C');
		$this->Image( 'accets/img/Escudo_de_Macusani.png', 10, 12, 15, 0, '' );
		$this->Image( 'accets/img/Escudo_de_Macusani.png', 185, 12, 15, 0, '' );
		$this->SetFont('Arial', '', 18);
		$this->Cell(80);
		$this->Cell(30, 10, 'MUNICIPALIDAD PROVINCIAL DE CARABAYA', 0, 1, 'C');
		$this->SetFont('Arial', 'i', 14);
		$this->Cell(80);
		$this->Cell(30, 7, utf8_decode('OFICINA DE EDUCACIÓN, CULTURA Y DEPORTE'), 0, 1, 'C');
		$this->SetFont('Arial', 'i', 7);
		$this->Cell(80);
		$this->Cell(30, 5, utf8_decode('SUB-GERENCIA DE DESARROLLO SOCIAL'), 0, 1, 'C');
		$this->SetY(32);
		$this->Cell(190,0, '', 1,1,'C');
		$this->Ln(3);
	}

	function Footer()
	{
		$this->SetY(-18);
		$this->SetFont('Arial', 'I', 12);
		$this->AddLink();
		//$this->Cell(5, 10, 'www.onelcn.com', 0, 0, 'L');
		$this->SetFont('Arial', 'I', 10);
		$this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
		//$this->Cell(0, 10, utf8_decode($date_current), 0, 0, 'L');
	}
}



//$sql_familia =  "
//				SELECT f.dni, f.nombres, f.ape_pat, f.ape_mat, f.fecha_entrega, f.direccion, c.cse
//				FROM familia AS f
//					INNER JOIN db_cse AS c
//					ON f.dni = c.dni_fammilia
//				ORDER BY c.cse DESC , f.ape_pat ASC, f.ape_mat ASC
//				";
//$result_familia = $conn->query($sql_familia);


$pdf = new PDF('P', 'mm', 'A4'); //'P','mm', array(210, 297)

$pdf->AddPage(); //'P', 'A4', 0
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);

//$pdf->SetFillColor(28, 132, 198);
$pdf->Cell(190, 5, '', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(190, 5, 'FAMILIAS CON ESTUDIANTES BENEFICIADOS CON INTERNET', 0, 1, 'C');
$pdf->Cell(190, 5, '', 0, 1, 'C');

$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', '', 7.5);
$pdf->Cell(7, 5, 'NRO', 1, 0, 'C', 1);
$pdf->Cell(14, 5, 'DNI', 1, 0, 'C', 1);
$pdf->Cell(40, 5, 'NOMBRES', 1, 0, 'C', 1);
$pdf->Cell(31, 5, 'APE PATERNO', 1, 0, 'C', 1);
$pdf->Cell(31, 5, 'APE MATERNO', 1, 0, 'C', 1);
//$pdf->Cell(37, 5, utf8_decode('DIRECCIÓN'), 1, 0, 'C', 1);
$pdf->Cell(7, 5, 'EST', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'CSE-SISFOH', 1, 0, 'C', 1);
$pdf->Cell(27, 5, 'FECHA ENTREGA', 1, 0, 'C', 1);
$pdf->Cell(8, 5, 'PLAN', 1, 1, 'C', 1);
//$pdf->Cell(20, 5, 'CELULAR', 1, 1, 'C', 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);




$count = 1;
if ($result_familia->num_rows > 0) {
//	foreach ($result_familia->fetch_assoc() as $row){
	while ($row = $result_familia->fetch_assoc()) {

		$pdf->Cell(7, 5, utf8_decode(str_pad($count, 4, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode($row['dni']), 1, 0, 'C', 1);
		$pdf->Cell(40, 5, utf8_decode($row['nombres']), 1, 0, 'L', 1);
		$pdf->Cell(31, 5, utf8_decode($row['ape_pat']), 1, 0, 'L', 1);
		$pdf->Cell(31, 5, utf8_decode($row['ape_mat']), 1, 0, 'L', 1);
		$pdf->Cell(7, 5, utf8_decode($row['total_estudiante']), 1, 0, 'C', 1);
		$pdf->Cell(25, 5, utf8_decode($row['cse']), 1, 0, 'C', 1);
		if ($row['fecha_entrega'] != 0000) {
			$pdf->SetFillColor(97, 218, 215);
			$pdf->Cell(27, 5, utf8_decode( $row['fecha_entrega']), 1, 0, 'C', 1);
		}else{
			$pdf->Cell(27, 5, utf8_decode( 'Chip no entregado'), 1, 0, 'C', 1);
		}
		$pdf->SetFillColor(255, 255, 255);
		if (cel_plan($row['dni'], $conn) == 5) {
			$pdf->SetFillColor(97, 218, 215);
			$pdf->Cell(8, 5, utf8_decode(cel_plan($row['dni'], $conn)), 1, 1, 'C', 1);
		}elseif(cel_plan($row['dni'], $conn) == 2){
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(8, 5, utf8_decode(cel_plan($row['dni'], $conn)), 1, 1, 'C', 1);
		}else{
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(8, 5, utf8_decode(cel_plan($row['dni'], $conn)), 1, 1, 'C', 1);
		}
		$pdf->SetFillColor(255, 255, 255);
		$count++;
	}
}

//if ($resultpersona->num_rows > 0) {
//	while ($row = $resultpersona->fetch_assoc()) {
//		$pdf->Cell(10, 5, utf8_decode(str_pad($count, 6, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
//		$pdf->Cell(18, 5, utf8_decode($row['dni']), 1, 0, 'C', 1);
//		$pdf->Cell(40, 5, utf8_decode($row['nombres']), 1, 0, 'L', 1);
//		$pdf->Cell(25, 5, utf8_decode($row['ape_pat']), 1, 0, 'L', 1);
//		$pdf->Cell(25, 5, utf8_decode($row['ape_mat']), 1, 0, 'L', 1);
//		$pdf->Cell(18, 5, utf8_decode($row['fech_naci']), 1, 0, 'L', 1);
//		$pdf->Cell(18, 5, utf8_decode($row['sexo']), 1, 0, 'L', 1);
//		$pdf->Cell(18, 5, utf8_decode($row['nucleo_fam']), 1, 0, 'L', 1);
//		$pdf->Cell(20, 5, utf8_decode($row['celular']), 1, 1, 'L', 1);
//		$count++;
//	}
//}

$pdf->Output();


