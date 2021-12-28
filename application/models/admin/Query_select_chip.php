<?php
require_once ('application/models/admin/conn.php');

$sql_id_service_chip = "SELECT MAX(id_service_chip) id_service_chip FROM service_chip WHERE dni_familia_f = '$rel_id'";
$sql_id_service_chip = $conn->query($sql_id_service_chip);
$id_service_chip = $sql_id_service_chip->fetch_assoc()['id_service_chip'];

$sql_service_chip = "SELECT *FROM service_chip WHERE id_service_chip = '$id_service_chip'";
$sql_service_chip = $conn->query($sql_service_chip);
$row_service_chip = $sql_service_chip->fetch_assoc();
