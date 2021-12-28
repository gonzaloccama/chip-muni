<?php

//require_once ('application/models/admin/conn.php');
require_once ('application/helpers/fpdf/fpdf.php');

class PDF_helper extends fpdf
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
