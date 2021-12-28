<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Welcome_model extends CI_Model
{
	function __construct()

	{

		parent::__construct();

	}

	function countRows($table)
	{
		$query = $this->db->query("SELECT count(dni) AS num_of_time	FROM $table");
		return $query->result();
	}

	function countRowsEntega($table, $where)
	{
		$query = $this->db->query("SELECT count(dni) AS num_of_time	FROM $table WHERE $where != 0");
		return $query->result();
	}

	function countRowsFamilia($table)
	{
		$query = $this->db->query("SELECT count(familia.dni) AS num_of_time
		FROM familia AS familia
		INNER JOIN(SELECT familia.dni, count(estudiante.dni) total_estudiante
							FROM familia AS familia
							INNER JOIN estudiante AS estudiante
							ON familia.dni = estudiante.dni_familia
							GROUP BY familia.dni) AS num_estudiante
		ON familia.dni = num_estudiante.dni");

		return $query->result();
	}

	function countRowsEstudiante($table)
	{
		$query = $this->db->query("SELECT count(estudiante.dni) AS num_of_time
		FROM estudiante AS estudiante
		INNER JOIN familia AS familia
		ON estudiante.dni_familia = familia.dni		
		WHERE estudiante.dni_familia != ''
		");

		return $query->result();
	}
}
