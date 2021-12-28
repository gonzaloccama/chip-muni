<?php
require_once ('application/models/admin/conn.php');

/// //////////////////////
///
/// //////////////////////

function select_from($conn, $table){
	$sql_student = "SELECT *FROM $table";
	return $result_student = $conn->query($sql_student);
}

function select_form_where($conn, $table, $critery, $id){
	$sql_student = "SELECT *FROM $table WHERE $critery = '$id'";
	return $result_student = $conn->query($sql_student);
}

function select_entregado($conn, $cri_id)
{
	$sql = "SELECT estudiante.dni
			FROM estudiante AS estudiante			
			LEFT JOIN familia As familia
			ON estudiante.dni_familia = familia.dni			
			WHERE familia.fecha_entrega != 0 AND estudiante.institucion = $cri_id";
	return $result_student = $conn->query($sql);
}
