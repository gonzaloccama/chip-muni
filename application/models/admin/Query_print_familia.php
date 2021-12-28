<?php
require_once ('application/models/admin/conn.php');

//$sql_familia = "
//	SELECT f.dni, f.nombres, f.ape_pat, f.ape_mat, f.direccion, f.barrio, f.celular, f.fecha_entrega, f.observations, f.fecha_registro, c.cse
//	FROM familia AS f
//	INNER JOIN db_cse AS c
//				ON f.dni = c.dni_fammilia
//	ORDER BY f.fecha_registro DESC
//";
//$result_familia = $conn->query($sql_familia);


//$sql_familia = "SELECT *FROM familia";
//$result_familia = $conn->query($sql_familia);



$sql_familia = "SELECT f.*, c.cse, count(e.dni) total_estudiante
	FROM familia AS f
			LEFT JOIN estudiante AS e
				ON e.dni_familia = f.dni
			INNER JOIN db_cse AS c
				ON f.dni = c.dni_fammilia
#	WHERE f.fecha_entrega != 0000
	GROUP BY f.dni
	ORDER BY fecha_entrega DESC, c.cse DESC, f.ape_pat ASC, f.ape_mat ASC";
$result_familia = $conn->query($sql_familia);

function cel_plan($dni, $conn){

	$sql_id_service_chip = "SELECT MAX(id_service_chip) id_service_chip FROM service_chip WHERE dni_familia_f = '$dni'";
	$sql_id_service_chip = $conn->query($sql_id_service_chip);
	$id_service_chip = $sql_id_service_chip->fetch_assoc()['id_service_chip'];

	$sql_service_chip = "SELECT *FROM service_chip WHERE id_service_chip = '$id_service_chip'";
	$sql_service_chip = $conn->query($sql_service_chip);
	return $sql_service_chip->fetch_assoc()['plan'];

}
