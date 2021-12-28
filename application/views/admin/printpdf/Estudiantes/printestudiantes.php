<?php

require_once ('application/models/admin/conn.php');
require ('application/views/admin/printpdf/fpdf/fpdf.php');

require_once ('application/models/admin/Query_select_chip.php');

date_default_timezone_set('America/Lima');

$date_current = date("Y-m-d H:i:s");
$date_current_code = date("Ymd");

$nombresape = "";
$dni_copy = "";

function date_spanish ($fecha) {
	$fecha = substr($fecha, 0, 10);
	$numeroDia = date('d', strtotime($fecha));
	$dia = date('l', strtotime($fecha));
	$mes = date('F', strtotime($fecha));
	$anio = date('Y', strtotime($fecha));
	$dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	$dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	$nombredia = str_replace($dias_EN, $dias_ES, $dia);
	$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
	$meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	$nombreMes = str_replace($meses_EN, $meses_ES, $mes);
	return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}


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
		$this->Ln(1);
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


function replace_($str_){
	$c = array("<ul>", "</ul>", "<li>", "</li>", "<h3>", "</h3>", "<h3 style=\"color:red;\">", "Posibles hermanos con");
	for ($i = 0; $i< count($c); $i++){
		if ($c[$i] == $c[3]){
			$str_ = str_replace($c[$i], ";", $str_);
		}
		if ($c[$i] == $c[4]){
			$str_ = str_replace($c[$i], "HERMANO: ", $str_);
		}
		if ($c[$i] == $c[5]){
			$str_ = str_replace($c[$i], ", ", $str_);
		}
		if ($c[$i] == $c[2]){
			$str_ = str_replace($c[$i], "", $str_);
		}else{
			$str_ = str_replace($c[$i], "", $str_);
		}
	}

	return $str_;
}


$id = 0;
$code = 0;

$sql_sol = "SELECT MAX(id_solicitud) id_solicitud FROM solicitud";

$sql_reg_en = "SELECT MAX(id_register_en) id_register_en FROM register_en WHERE dni_familia_f = '$rel_id'";
$result_reg_en = $conn->query($sql_reg_en);

$id_reg_ent = 0;
if ($result_reg_en->num_rows > 0){
	$id_reg_ent = $result_reg_en->fetch_assoc()['id_register_en'] + 0;
}





if ($conn->query($sql_sol)->num_rows > 0) {
	$id = $conn->query($sql_sol)->fetch_assoc()['id_solicitud'] + 1;
	$code = $date_current_code.'-'.str_pad($id, 5, "0", STR_PAD_LEFT);
	$sql_soli_ = "INSERT INTO solicitud (id_solicitud, fecha, code, id_register_en, dni_familia) values ('$id', '$date_current', '$code', '$id_reg_ent', '$rel_id')";
	$conn->query($sql_soli_);
}else{
	$id = 1;
	$code = $date_current.'-'.str_pad($id, 6, "0", STR_PAD_LEFT);
	$sql_soli_ = "INSERT INTO solicitud (id_solicitud, fecha, code, id_register_en, dni_familia) values ('$id', '$date_current', '$code', '$id_reg_ent', '$rel_id')";
	$conn->query($sql_soli_);
}


$count = 0;
if ($result = $conn->query("SELECT *FROM solicitud WHERE dni_familia = '$rel_id'")) {
	$count = $result->num_rows;
}
$sql_familia = "SELECT *FROM familia WHERE dni = '$rel_id'";
$result_familia = $conn->query($sql_familia);
$row_familia = $result_familia->fetch_assoc();

$sql_barrio = "
				SELECT b.barrio
				FROM familia AS f
				INNER JOIN barrio AS b
				ON f.barrio = b.id_barrio
				WHERE f.dni = '$rel_id'
";
$result_barrio = $conn->query($sql_barrio);
$row_barrio = $result_barrio->fetch_assoc();


$sql_estudiante = "
					SELECT e.dni, e.nombres, e.ape_pat, e.ape_mat, i.institucion, n.nivel, e.observations, e.observations, e.fecha_registro, e.dni_familia
					FROM estudiante AS e
					INNER JOIN institucion AS i
					ON e.institucion = i.id_institucion
					INNER JOIN nivel AS n
					ON i.id_nivel = n.id_nivel					
					WHERE e.dni_familia = '$rel_id'
					";
$result_estudiante = $conn->query($sql_estudiante);





// = $result_estudiante->fetch_assoc();

//
//$sql_cs = "SELECT h.no_ficha, c.cse FROM hogar AS h INNER JOIN cse AS c ON h.cse = c.id_cse WHERE h.no_ficha = '$no_ficha_'";
//$cse_cse = $conn->query($sql_cs)->fetch_assoc()['cse'];
//
//$sql_cs = "SELECT h.no_ficha, c.ciudad FROM hogar AS h INNER JOIN ciudad AS c ON h.ciudad = c.id_ciudad WHERE h.no_ficha = '$no_ficha_'";
//$ciudad = $conn->query($sql_cs)->fetch_assoc()['ciudad'];
//
//$sql_cs = "SELECT h.no_ficha, b.barrio FROM hogar AS h INNER JOIN barrio AS b ON h.barrio = b.id_barrio WHERE h.no_ficha = '$no_ficha_'";
//$barrio = $conn->query($sql_cs)->fetch_assoc()['barrio'];
//
//
//$sql_c = "SELECT *FROM hogar";
//
//$resulthogar = $conn->query($sql_c);
//$hogar = $resulthogar->fetch_assoc();
//
//
//$sql_direc = "SELECT d.id_direccion, d.direccion, b.barrio, c.ciudad, d.fecha_registro, d.no_ficha
//									FROM direccion AS d
//									INNER JOIN barrio AS b
//										ON d.barrio = b.id_barrio
//									INNER JOIN ciudad AS c
//										ON d.ciudad = c.id_ciudad
//									WHERE d.no_ficha = '$no_ficha_'";
//
//$resultdirec = $conn->query($sql_direc);
//
//
//$sqlpersona = "SELECT p.dni, p.nombres, p.ape_pat, p.ape_mat, p.fech_naci, s.sexo, n.nucleo_fam, p.celular, p.observations
//                            FROM persona AS p
//                            INNER JOIN sexo AS s
//                            	ON p.sexo = s.id_sexo
//							INNER JOIN nucleo_fam AS n
//                            	ON p.nucleo_fam = n.id_nucleofam
//							WHERE p.no_ficha = '$no_ficha_'";
//
//$resultadoPersona = $conn->query($sqlpersona);
//
//$sqlp = "SELECT *FROM persona WHERE no_ficha = '$no_ficha_'";
//$resultp = $conn->query($sqlp);


$pdf = new PDF('P', 'mm', 'A4'); //'P','mm', array(210, 297)
$pdf->AddPage(); //'P', 'A4', 0
$pdf->AliasNbPages();

$pdf->Ln(2);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 8, 'ACTA DE ENTREGA CHIP INTERNET MOVIL', 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(44,9, utf8_decode('    REGISTRO DE ENTREGA N° : '), 0,0,'L');
$pdf->SetFont('Arial', 'i', 8);
$pdf->Cell(55,9, utf8_decode($code), 0,0,'L');
$pdf->Cell(86,9, utf8_decode($count), 0,1,'R');

$pdf->SetFont('Arial', '', 12);

//$pdf->SetFillColor(28, 132, 198);
//$pdf->SetTextColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
//$pdf->Ln(1);
//
$pdf->Cell(190, 8, '  1. ESTADO DE ENTREGA', 1, 1, 'l');
//$pdf->Cell(95, -8, '                                                        PLAN CHIP MOVIL: ', 0, 1, 'l');

//$pdf->SetFont('Arial', '', 12);
//$pdf->Cell(25,7, '');
//$pdf->Cell(95, 7, utf8_decode('DNI DEL RESPONSABLE: '), 0, 0, 'L');
//$pdf->SetTextColor(20, 91, 139);
//$pdf->SetFont('Arial', 'i', 12);
//$pdf->Cell(45, 7, utf8_decode($row_familia['dni'] ), 0, 1, 'R');
//$pdf->Cell(190,-7, '', 1,1);

//$pdf->Cell(2,7, '', 0, 1);
//$pdf->Cell(190,8, '', 0, 1);
$pdf->Cell(2,7, '');
$pdf->SetTextColor(7, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 7, utf8_decode('ESTADO: '), 0, 0, 'L');
$pdf->SetTextColor(20, 91, 139);
$pdf->SetFont('Arial', 'ib', 9);
$pdf->Cell(27, 7, utf8_decode($row_familia['fecha_entrega'] != 0000 ? "Chip entregado" : "Chip no entregado aún"), 0, 0, 'L');


//$pdf->Cell(5,7, '', 0, 0);

$pdf->Cell(20,7, '');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(17, 7, utf8_decode('N° DE CHIP: '), 0, 0, 'L');
$pdf->SetTextColor(20, 91, 139);
$pdf->SetFont('Arial', 'ib', 9);
$pdf->Cell(22, 7, utf8_decode($row_service_chip['numero_chip'] == 0 ? "No registra" : $row_service_chip['numero_chip']), 0, 0, 'R');
//$pdf->Cell(190,-7, '', 1,0);

//$pdf->Cell(7,7, '', 0, 0);

//$pdf->Cell(3,7, '');
//$pdf->SetTextColor(0, 0, 0);
//$pdf->SetFont('Arial', '', 9);
//$pdf->Cell(10, 7, utf8_decode('PLAN: '), 0, 0, 'L');
//$pdf->SetTextColor(20, 91, 139);
//$pdf->SetFont('Arial', 'ib', 9);
//$pdf->Cell(15, 7, utf8_decode($row_service_chip['plan'] == 0 ? "Sin plan" : $row_service_chip['plan']." meses"), 0, 0, 'R');
//$pdf->Cell(190,-7, '', 1,0);


//$pdf->Cell(2,7, '', 0, 0);

$pdf->Cell(17,7, '');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(31, 7, utf8_decode('FECHA DE ENTREGA: '), 0, 0, 'L');
$pdf->SetTextColor(20, 91, 139);
$pdf->SetFont('Arial', 'ib', 9);
$pdf->Cell(35, 7, utf8_decode($row_familia['fecha_entrega'] != 0000 ? $row_familia['fecha_entrega'] : "No registra"), 0, 1, 'R');

$pdf->Cell(190,-7, '', 1,1);
//$pdf->Cell(190,-7, '', 1,1);

$pdf->Ln(1);


$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(8);

$pdf->Cell(190, 8,  utf8_decode('  2. INFORMACIÓN DEL RESPONSABLE'), 1, 1, 'l');
//$pdf->Cell(190,0, '', 1,1,'C');
$pdf->Cell(190,19, '', 1,1,'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20,0, '', 0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(55, -31, utf8_decode('DNI'), 0, 0, 'l');
$pdf->Cell(10, -31, utf8_decode(':'), 0, 0, 'l');
$pdf->SetFont('Arial', 'ib', 9);
$pdf->SetTextColor(40, 91, 139);
$pdf->Cell(50, -31, isset($row_familia['dni']) ? utf8_decode($dni_copy = $row_familia['dni']) :
	utf8_decode("No registra DNI aún"), 0, 1, 'l');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20,0, '', 0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(55, 39, utf8_decode('NOMBRES Y APELLIDOS'), 0, 0, 'l');
$pdf->Cell(10, 39, utf8_decode(':'), 0, 0, 'l');
$pdf->SetFont('Arial', 'ib', 9);
$pdf->SetTextColor(50, 91, 139);
$pdf->Cell(50, 39, isset($row_familia['nombres']) ? utf8_decode($nombresape = $row_familia['nombres']." ".$row_familia['ape_pat']." ".$row_familia['ape_mat']) :
	utf8_decode("No registra nombres y apellidos "), 0, 1, 'l');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20,0, '', 0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(55, -31, utf8_decode('CELULAR'), 0, 0, 'l');
$pdf->Cell(10, -31, utf8_decode(':'), 0, 0, 'l');
$pdf->SetFont('Arial', 'ib', 9);
$pdf->SetTextColor(20, 91, 139);
$pdf->Cell(50, -31, $row_familia['celular'] != 0  ? utf8_decode($row_familia['celular']) :
	utf8_decode("No registra celular "), 0, 1, 'l');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20,0, '', 0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(55, 39, utf8_decode('FECHA DE REGISTRO'), 0, 0, 'l');
$pdf->Cell(10, 39, utf8_decode(':'), 0, 0, 'l');
$pdf->SetFont('Arial', 'ib', 9);
$pdf->SetTextColor(50, 91, 139);
$pdf->Cell(50, 39, isset($row_familia['fecha_registro']) ? utf8_decode($row_familia['fecha_registro']) :
	utf8_decode("No registra fecha de registro "), 0, 1, 'l');

$pdf->Cell(20,-14, '', 0,1,'C');
//$pdf->Ln(1);


$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 8,  utf8_decode('  3. DIRECCIÓN'), 1, 1, 'l');
//$pdf->Cell(190,0, '', 1,1,'C');
$pdf->Cell(190,10, '', 1,1,'C');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20,0, '', 0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(55, -14, utf8_decode('DIRECCIÓN'), 0, 0, 'l');
$pdf->Cell(10, -14, utf8_decode(':'), 0, 0, 'l');
$pdf->SetFont('Arial', 'ib', 9);
$pdf->SetTextColor(20, 91, 139);
$pdf->Cell(50, -14, $row_familia['direccion'] != "" ? utf8_decode($row_familia['direccion']) :
	utf8_decode("No registra dirección aún"), 0, 1, 'l');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(20,0, '', 0,0,'C');
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(55, 23, utf8_decode('BARRIO'), 0, 0, 'l');
$pdf->Cell(10, 23, utf8_decode(':'), 0, 0, 'l');
$pdf->SetFont('Arial', 'ib', 9);
$pdf->SetTextColor(20, 91, 139);
$pdf->Cell(50, 23, isset($row_barrio['barrio']) ? utf8_decode($row_barrio['barrio']) :
	utf8_decode("No registra barrio aún "), 0, 1, 'l');
$pdf->Ln(1);


$pdf->Cell(20,-8, '', 0,1,'C');

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(190, 8,  utf8_decode('  4. ESTUDIANTES BENEFICIARIOS'), 1, 1, 'l');
//$pdf->Cell(190,0, '', 1,1,'C');
//$pdf->Cell(190,20, '', 1,1,'C');
//$pdf->Cell(190,2, '', 1,1,'C');
$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', '', 7.5);
//$pdf->Cell(10, 5, 'N°', 1, 0, 'C', 1);
$pdf->Cell(15, 5, 'DNI', 1, 0, 'C', 1);
$pdf->Cell(38, 5, 'NOMBRES', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'APE PATERNO', 1, 0, 'C', 1);
$pdf->Cell(25, 5, 'APE MATERNO', 1, 0, 'C', 1);
$pdf->Cell(41, 5, utf8_decode('INSTITUCIÓN'), 1, 0, 'C', 1);
$pdf->Cell(20, 5, 'NIVEL', 1, 0, 'C', 1);
$pdf->Cell(26, 5, 'FECHA REGISTRO', 1, 1, 'C', 1);
//$pdf->Cell(20, 5, 'CELULAR', 1, 1, 'C', 1);
//$pdf->Cell(56, 5, 'OBSERVACIONES', 1, 1, 'C', 1);


$pdf->SetFont('Arial', '', 7.5);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$count = 1;
if ($result_estudiante->num_rows > 0) {
	while ($row = $result_estudiante->fetch_assoc()) {
		//$pdf->Cell(20, 5, utf8_decode($count), 1, 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode($row['dni']), 1, 0, 'C', 1);
		$pdf->Cell(38, 5, utf8_decode($row['nombres']), 1, 0, 'L', 1);
		$pdf->Cell(25, 5, utf8_decode($row['ape_pat']), 1, 0, 'L', 1);
		$pdf->Cell(25, 5, utf8_decode($row['ape_mat']), 1, 0, 'L', 1);
		$pdf->Cell(41, 5, utf8_decode($row['institucion']), 1, 0, 'L', 1);
		$pdf->Cell(20, 5, utf8_decode($row['nivel']), 1, 0, 'L', 1);
		$pdf->Cell(26, 5, utf8_decode($row['fecha_registro']), 1, 1, 'L', 1);
		//$count++;
	}
}
else{
	$pdf->Cell(190, 5, utf8_decode("¡No hay estudiantes registrados!"), 1, 1, 'C', 1);
}

//$pdf->Cell(190,2, '', 1,1,'C');

$pdf->Ln(1);

$pdf->Cell(20,1, '', 0,1,'C');

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(190, 8,  utf8_decode('  5. OBSERVACIONES'), 1, 1, 'l');

//$pdf->Cell(190,2, '', 1,1,'C');
$pdf->SetFillColor(28, 132, 198);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', '', 7.5);
//$pdf->Cell(10, 5, 'N°', 1, 0, 'C', 1);
$pdf->Cell(20, 5, 'DNI', 1, 0, 'C', 1);
$pdf->Cell(170, 5, 'OBSERVACIONES', 1, 1, 'C', 1);


$pdf->SetFont('Arial', '', 7.5);

$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(20, 5, utf8_decode($row_familia['dni']), 1, 0, 'C', 1);
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(170, 5, $row_familia['observations'] != "" ?	 utf8_decode(replace_($row_familia['observations'])) : utf8_decode("Sin observaciones.") , 1, 1, 'L', 1);

$sql_est = "SELECT *FROM estudiante WHERE dni_familia = '$rel_id'";
$result_est = $conn->query($sql_est);
//$row_est = $result_est->fetch_assoc();

if ($result_est->num_rows > 0) {
	while ($row = $result_est->fetch_assoc()) {
		$pdf->SetFont('Arial', '', 7.5);
		$pdf->Cell(20, 5, utf8_decode($row['dni']), 1, 0, 'C', 1);
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(170, 5, $row['observations'] != "" ?	 utf8_decode($row['observations']) : utf8_decode("Sin observaciones."), 1, 1, 'j', 1);
	}
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(2, 4, '', 0, 0, 'C', 1);
$pdf->Cell(20, 4, utf8_decode("COMPROMISO: "), 0, 0, 'L', 1);

$pdf->SetFont('Arial', 'I', 7);
$pdf->Cell(95, 4, utf8_decode("El servicio de Internet entregado por la Municipalidad Provincial de 
Carabaya mediante Plan Chip Movil es para fines educativos, y en beneficio de"), 0, 1, 'FJ', 1);

$pdf->Cell(22, 4, '', 0, 0, 'C', 1);

$pdf->Cell(95, 4, utf8_decode("los estudiantes de su familia."), 0, 1, 'L', 1);

//$pdf->SetFont('Arial', 'B', 6);
//$pdf->Cell(2, 4, '', 0, 0, 'C', 1);
//$pdf->Cell(23, 4, utf8_decode("CONSIDERACIONES: "), 0, 0, 'L', 1);
//
//$pdf->SetFont('Arial', 'I', 6);
//$pdf->Cell(95, 4, utf8_decode("El servicio de Internet entregado por la Municipalidad Provincial de
//Carabaya mediante Plan Chip Movil es para fines educativos, y en beneficio de los estudiantes de su familia."), 0, 1, 'L', 1);

$pdf->Ln(4);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 5, '', 0, 0, 'C', 1);
$pdf->Cell(95, 5, utf8_decode("Macusani, ".date_spanish($date_current)), 0, 1, 'R', 1);

$pdf->Ln(7);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 25, '', 0, 0, 'C', 1);
$pdf->Cell(75, 25, utf8_decode('__________________________________'), 0, 0, 'C', 1);

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(23, 25, '', 1, 1, 'r', 1);

$pdf->Cell(90, 0, '', 0, 0, 'C', 1);
$pdf->Cell(75, -17, utf8_decode($nombresape), 0, 1, 'C');
$pdf->Cell(90, 0, '', 0, 0, 'C', 1);
$pdf->Cell(75, 24, utf8_decode("DNI: " . $dni_copy), 0, 1, 'C');

$pdf->Cell(90, 0, '', 0, 0, 'C', 1);
$pdf->Cell(75, -17, utf8_decode("RECIBÍ CONFORME"), 0, 1, 'C');

//$pdf->Cell(190,2, '', 1,1,'C');

//$pdf->Cell(190,-10, '', 0,1,'C');
//$pdf->SetFont('Arial', 'B', 12);
//$pdf->Cell(190, -10, '  MIEMBROS DE HOGAR', 1, 1, 'l');
//$pdf->Ln(10);
//$pdf->Cell(190,5, '', 1,1,'C');
//
//
//$pdf->Cell(190,0, '', 0,1,'C');
//
//$pdf->SetFillColor(28, 132, 198);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->SetFont('Arial', '', 7.5);
//$pdf->Cell(20, 5, 'DNI', 1, 0, 'C', 1);
//$pdf->Cell(40, 5, 'NOMBRES', 1, 0, 'C', 1);
//$pdf->Cell(25, 5, 'APE PATERNO', 1, 0, 'C', 1);
//$pdf->Cell(25, 5, 'APE MATERNO', 1, 0, 'C', 1);
//$pdf->Cell(20, 5, 'FECHA NAC.', 1, 0, 'C', 1);
//$pdf->Cell(20, 5, 'SEXO', 1, 0, 'C', 1);
//$pdf->Cell(20, 5, 'NUCLEO', 1, 0, 'C', 1);
//$pdf->Cell(20, 5, 'CELULAR', 1, 1, 'C', 1);
////$pdf->Cell(56, 5, 'OBSERVACIONES', 1, 1, 'C', 1);
//
//$pdf->SetFont('Arial', '', 7.5);
//
//$pdf->SetFillColor(255, 255, 255);
//$pdf->SetTextColor(0, 0, 0);
//
//if ($resultadoPersona->num_rows > 0) {
//
//	while ($row = $resultadoPersona->fetch_assoc()) {
//		$pdf->Cell(20, 5, utf8_decode($row['dni']), 1, 0, 'C', 1);
//		$pdf->Cell(40, 5, utf8_decode($row['nombres']), 1, 0, 'L', 1);
//		$pdf->Cell(25, 5, utf8_decode($row['ape_pat']), 1, 0, 'L', 1);
//		$pdf->Cell(25, 5, utf8_decode($row['ape_mat']), 1, 0, 'L', 1);
//		$pdf->Cell(20, 5, utf8_decode($row['fech_naci']), 1, 0, 'L', 1);
//		$pdf->Cell(20, 5, utf8_decode($row['sexo']), 1, 0, 'L', 1);
//		$pdf->Cell(20, 5, utf8_decode($row['nucleo_fam']), 1, 0, 'L', 1);
//		$pdf->Cell(20, 5, utf8_decode($row['celular']), 1, 1, 'L', 1);
//		//$pdf->Cell(56, 5, $row['observations'], 1, 1, 'L', 1);
//	}
//}
//$pdf->Cell(190,5, '', 1,1,'C');
//
//$pdf->SetFont('Arial', 'B', 12);
//$pdf->Cell(190, 10, '  OBSERVACIONES', 1, 1, 'l');
////$pdf->Ln(10);
//
//$pdf->Cell(190,4*($resultp->num_rows + 2), '', 1,1,'C');
//$pdf->Cell(190,-4*($resultp->num_rows + 1), '', 0,1,'C');
//
//if ($resultp->num_rows > 0) {
//	while ($row = $resultp->fetch_assoc()) {
//		$pdf->SetFont('Arial', 'B', 7.5);
//		$pdf->Cell(5, 4, "", 0, 0, 'C', 1);
//		$pdf->Cell(12, 4, $row['dni'], 0, 0, 'C', 1);
//		$pdf->SetFont('Arial', '', 6);
//		$pdf->Cell(5, 4, "", 0, 0, 'L', 1);
//		$pdf->Cell(160, 4, empty($row['observations']) ? utf8_decode("No registra observaciones") : utf8_decode($row['observations']), 0, 1, 'L', 1);
//	}
//}
//
//
//$pdf->Cell(190,4, '',0 ,1,'C');
//$pdf->SetFont('Arial', 'B', 12);
//$pdf->Cell(190, 10, '  MAS DATOS DE DOMICILIO', 1, 1, 'l');
//$pdf->Ln(10);
//$pdf->Cell(190,-10, '',0 ,1,'C');
//$pdf->Cell(190,5, '', 1,1,'C');
//
//$pdf->Cell(190,0, '', 0,1,'C');
//
//$pdf->SetFillColor(28, 132, 198);
//$pdf->SetTextColor(255, 255, 255);
//$pdf->SetFont('Arial', '', 8);
//$pdf->Cell(10, 5, 'NRO', 1, 0, 'C', 1);
//$pdf->Cell(60, 5, utf8_decode('DIRECCIÓN'), 1, 0, 'C', 1);
//$pdf->Cell(40, 5, 'BARRIO', 1, 0, 'C', 1);
//$pdf->Cell(30, 5, 'CIUDAD', 1, 0, 'C', 1);
//$pdf->Cell(30, 5, 'FECH REGIS', 1, 0, 'C', 1);
//$pdf->Cell(20, 5, 'NRO FICHA', 1, 1, 'C', 1);
//
//$pdf->SetFillColor(255, 255, 255);
//$pdf->SetTextColor(0, 0, 0);
//
//$i = 0;
//if ($resultdirec->num_rows > 0){
//	while ($row = $resultdirec->fetch_assoc()) {
//		$i++;
//		$pdf->Cell(10, 5, $i, 1, 0, 'C', 1);
//		$pdf->Cell(60, 5, utf8_decode($row['direccion']), 1, 0, 'L', 1);
//		$pdf->Cell(40, 5, utf8_decode($row['barrio']), 1, 0, 'L', 1);
//		$pdf->Cell(30, 5, utf8_decode($row['ciudad']), 1, 0, 'L', 1);
//		$pdf->Cell(30, 5, utf8_decode($row['fecha_registro']), 1, 0, 'L', 1);
//		$pdf->Cell(20, 5, utf8_decode($row['no_ficha']), 1, 1, 'L', 1);
//		//$pdf->Cell(56, 5, $row['observations'], 1, 1, 'L', 1);
//	}
//
//}else{
//	$pdf->Cell(190, 5, utf8_decode("No hay más domicilios registrados"), 1, 1, 'C', 1);
//}

//$pdf->Cell(190,5, '', 1,1,'C');

$pdf->Output();
