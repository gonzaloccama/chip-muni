<?php
require_once ('application/models/admin/conn.php');

$dni_familia_ = $rel_id;//$_GET['dni_familia'];


$sql_familia = "SELECT *FROM familia 									
									WHERE dni = '$dni_familia_'";

$result_familia = $conn->query($sql_familia);
$row_familia = $result_familia->fetch_assoc();


$sql_barrio = "
				SELECT b.barrio
				FROM familia AS f
				INNER JOIN barrio AS b
				ON f.barrio = b.id_barrio
				WHERE f.dni = '$dni_familia_'
";
$result_barrio = $conn->query($sql_barrio);
$row_barrio = $result_barrio->fetch_assoc();

$row_e = null;

if ($result_est = $conn->query("SELECT *FROM estudiante WHERE dni_familia = '$dni_familia_'")) {

	/* determinar el número de filas del resultado */
	$row_e = $result_est->num_rows;
}






