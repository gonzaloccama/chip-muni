<?php
require_once ('application/models/admin/conn.php');
require ('application/views/admin/printpdf/fpdf/fpdf.php');


date_default_timezone_set('America/Lima');

$date_current = date("Y-m-d");

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

$sql_estudiante = "
			SELECT e.dni, e.nombres, e.ape_pat, e.ape_mat, i.institucion, n.nivel, e.dni_familia
			FROM estudiante as e
			INNER JOIN institucion AS i
				ON e.institucion = i.id_institucion
			INNER JOIN nivel AS n
				ON i.id_nivel = n.id_nivel
			ORDER BY e.nivel ASC, i.institucion ASC, e.ape_pat ASC, e.ape_mat ASC
";
$result_estudiante = $conn->query($sql_estudiante);

//$sql_persona = "SELECT p.dni, p.nombres, p.ape_pat, p.ape_mat, p.fech_naci, s.sexo, n.nucleo_fam, p.celular, p.observations
//                            FROM persona AS p
//                            INNER JOIN sexo AS s
//                            	ON p.sexo = s.id_sexo
//							INNER JOIN nucleo_fam AS n
//                            	ON p.nucleo_fam = n.id_nucleofam
//							ORDER BY p.ape_pat ASC , p.ape_mat ASC;
//							";
//
//$resultpersona = $conn->query($sql_persona);

//$sql_hogar = "SELECT *FROM hogar";
//$resulthogar = $conn->query($sql_hogar);



$pdf = new PDF('P', 'mm', 'A4'); //'P','mm', array(210, 297)

$pdf->AddPage(); //'P', 'A4', 0
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);

//$pdf->SetFillColor(28, 132, 198);
$pdf->Cell(190, 5, '', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 16);
$pdf->Cell(190, 5, 'LISTA DE ESTUDIANTES BENEFICIARIOS CON INTERNET', 0, 1, 'C');
$pdf->Cell(190, 5, '', 0, 1, 'C');

$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', '', 7.5);
$pdf->Cell(8, 5, 'NRO', 1, 0, 'C', 1);
$pdf->Cell(15, 5, 'DNI', 1, 0, 'C', 1);
$pdf->Cell(39, 5, 'NOMBRES', 1, 0, 'C', 1);
$pdf->Cell(26, 5, 'APE PATERNO', 1, 0, 'C', 1);
$pdf->Cell(27, 5, 'APE MATERNO', 1, 0, 'C', 1);
$pdf->Cell(40, 5, utf8_decode('INSTITUCIÓN'), 1, 0, 'C', 1);
$pdf->Cell(19, 5, 'NIVEL', 1, 0, 'C', 1);
$pdf->Cell(16, 5, 'DNI FAMILIA', 1, 1, 'C', 1);
//$pdf->Cell(20, 5, 'CELULAR', 1, 1, 'C', 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$count = 1;
if ($result_estudiante->num_rows > 0) {
	while ($row = $result_estudiante->fetch_assoc()) {
		$pdf->Cell(8, 5, utf8_decode(str_pad($count, 4, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode($row['dni']), 1, 0, 'C', 1);
		$pdf->Cell(39, 5, utf8_decode($row['nombres']), 1, 0, 'L', 1);
		$pdf->Cell(26, 5, utf8_decode($row['ape_pat']), 1, 0, 'L', 1);
		$pdf->Cell(27, 5, utf8_decode($row['ape_mat']), 1, 0, 'L', 1);
		$pdf->Cell(40, 5, utf8_decode($row['institucion']), 1, 0, 'L', 1);
		$pdf->Cell(19, 5, utf8_decode($row['nivel']), 1, 0, 'L', 1);
		$pdf->Cell(16, 5, $row['dni_familia'], 1, 1, 'C', 1);
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


