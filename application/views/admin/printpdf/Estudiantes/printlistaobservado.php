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
		$this->Cell(277,0, '', 1,1,'C');
		$this->Image( 'accets/img/Escudo_de_Macusani.png', 10, 12, 15, 0, '' );
		$this->Image( 'accets/img/Escudo_de_Macusani.png', 272, 12, 15, 0, '' );
		$this->SetFont('Arial', '', 18);
		//$this->Cell(80);
		$this->Cell(277, 10, 'MUNICIPALIDAD PROVINCIAL DE CARABAYA', 0, 1, 'C');
		$this->SetFont('Arial', 'i', 14);
		//$this->Cell(80);
		$this->Cell(277, 7, utf8_decode('OFICINA DE EDUCACIÓN, CULTURA Y DEPORTE'), 0, 1, 'C');
		$this->SetFont('Arial', 'i', 7);
		//$this->Cell(80);
		$this->Cell(277, 5, utf8_decode('SUB-GERENCIA DE DESARROLLO SOCIAL'), 0, 1, 'C');
		$this->SetY(32);
		$this->Cell(277,0, '', 1,1,'C');
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

$sql_observado = "
			SELECT e.codigo, e.dni_f, e.nombres_f, e.dni_e, e.nombres_e, i.institucion, n.nivel, e.observations
			FROM estu_observado AS e
			INNER JOIN institucion AS i
				ON e.institucion = i.id_institucion
			INNER JOIN nivel AS n
				ON e.nivel = n.id_nivel
			
			ORDER BY n.nivel DESC, i.institucion ASC, e.dni_f ASC, e.nombres_f 
";
$result_observado = $conn->query($sql_observado);
//$sql_estudiante = "
//			SELECT e.dni, e.nombres, e.ape_pat, e.ape_mat, i.institucion, n.nivel, e.dni_familia
//			FROM estudiante as e
//			INNER JOIN institucion AS i
//				ON e.institucion = i.id_institucion
//			INNER JOIN nivel AS n
//				ON e.nivel = n.id_nivel
//			ORDER BY e.nivel ASC, i.institucion ASC, e.ape_pat ASC, e.ape_mat ASC
//";
//$result_estudiante = $conn->query($sql_estudiante);

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



$pdf = new PDF('L', 'mm', 'A4'); //'P','mm', array(210, 297)

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
if ($result_observado->num_rows > 0) {
	while ($row = $result_observado->fetch_assoc()) {
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(6, 5, utf8_decode(str_pad($count, 3, "0", STR_PAD_LEFT)), 1, 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode($row['codigo']), 1, 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode($row['dni_f']), 1, 0, 'C', 1);
		$pdf->Cell(53, 5, utf8_decode($row['nombres_f']), 1, 0, 'L', 1);
		$pdf->Cell(14, 5, utf8_decode($row['dni_e']), 1, 0, 'C', 1);
		$pdf->Cell(58, 5, utf8_decode($row['nombres_e']), 1, 0, 'L', 1);
		$pdf->Cell(48, 5, utf8_decode($row['institucion']), 1, 0, 'L', 1);
		$pdf->Cell(19, 5, utf8_decode($row['nivel']), 1, 0, 'L', 1);
		if	($row['observations'] == "DNI ACTUALIZADO"){
			$pdf->SetFillColor(0, 255, 0);
			$pdf->Cell(51, 5, utf8_decode($row['observations']), 1, 1, 'L', 1);
		}else
		{
			$pdf->Cell(51, 5, utf8_decode($row['observations']), 1, 1, 'L', 1);
		}


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

$pdf->ln(2);

$pdf->Cell(277, 5, '', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'IB', 13.5);
$pdf->Cell(55, 5, utf8_decode('CONSIDERACIONES:'), 0, 0, 'R');
//$pdf->Cell(190, 5, '', 0, 0, 'C');

//$pdf->Cell(277, 5, '', 0, 1, 'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'I', 13.5);
$pdf->Cell(200, 5, utf8_decode('Regularizar sus datos, comunicandose con sus representantes de sus instituciones correspondientes.'), 0, 1, 'L');
$pdf->Cell(190, 5, '', 0, 1, 'C');

$pdf->Output();


