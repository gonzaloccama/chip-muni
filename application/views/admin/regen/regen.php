<?php
require_once ("application/models/admin/conn.php");


date_default_timezone_set('America/Lima');

$date_current = date('Y-m-d H:i:s');
//echo $date_current;
$rel_id = $_GET['dni_familia'];

$sql = "UPDATE familia SET fecha_entrega ='$date_current' WHERE dni='$rel_id'";

if ($conn->query($sql) === TRUE) {
	header('Location: admin/estudiante/index/dni_familia/'.$rel_id.'/1');
}
