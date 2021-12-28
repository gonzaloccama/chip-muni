<?php
require_once ('application/models/admin/conn.php');

$sql_familia_cse = "SELECT *FROM db_cse 									
									WHERE dni_fammilia = '$rel_id'";
$result_familia_cse = $conn->query($sql_familia_cse);
$row_familia_cse = $result_familia_cse->fetch_assoc();
