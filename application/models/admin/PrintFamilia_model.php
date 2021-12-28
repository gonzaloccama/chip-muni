<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class PrintFamilia_model extends CI_Model
{
	public $v_fields = array('dni', 'nombres', 'ape_pat', 'ape_mat', 'direccion', 'barrio.barrio', 'celular', 'fecha_entrega', 'observations', 'fecha_registro');


	function __construct()

	{

		parent::__construct();

	}

	function getListTable($table)
	{

		$this->db->select("$table.*  , db_cse.cse as cse, count(estudiante.dni) total_estudiante");

		$this->db->from($table);

		$this->db->join("estudiante", "estudiante.dni_familia = familia.dni", "left");
		$this->db->join("db_cse", "familia.dni = db_cse.dni_fammilia");

		$this->db->group_by("familia.dni");

		$this->db->order_by("familia.fecha_entrega", "DESC");
		$this->db->order_by("familia.ape_pat", "ASC");
		$this->db->order_by("familia.ape_mat", "ASC");

		$query = $this->db->get();

		return $result = $query->result();

	}

	function getListFamilia($table, $having)
	{
		$this->db->select("familia.dni, familia.nombres, familia.ape_pat, familia.ape_mat, 
		count(estudiante.dni) total_estudiante, db_cse.cse,  
		familia.fecha_entrega, service_chip.plan, service_chip.numero_chip

			FROM familia AS familia
			
			LEFT JOIN(SELECT s1.id_service_chip, s1.dni_familia_f, s1.numero_chip, s1.plan 
					FROM service_chip AS s1
						INNER JOIN(SELECT MAX(id_service_chip) id_service_chip, dni_familia_f, plan
						FROM service_chip
						GROUP BY dni_familia_f) AS s2
					ON s1.id_service_chip = s2.id_service_chip 
					AND s1.dni_familia_f = s2.dni_familia_f) AS service_chip
			ON familia.dni = service_chip.dni_familia_f
			
			");
		$this->db->join("estudiante", "estudiante.dni_familia = familia.dni", "LEFT");
		$this->db->join("db_cse", "familia.dni = db_cse.dni_fammilia", "INNER");

		$this->db->group_by("familia.dni");

		$this->db->having($having);

		$this->db->order_by("familia.fecha_entrega", "DESC");
		$this->db->order_by("familia.ape_pat", "ASC");
		$this->db->order_by("familia.ape_mat", "ASC");

		$query = $this->db->get();

		return $result = $query->result();
	}

	function  getFamiliaInstitucion($id)
	{
		$this->db->distinct();
		$this->db->select("familia.dni, familia.nombres, familia.ape_pat, familia.ape_mat, institucion.institucion, nivel.nivel, service_chip.numero_chip, familia.fecha_entrega
						FROM familia AS familia
						LEFT JOIN(SELECT s1.id_service_chip, s1.dni_familia_f, s1.numero_chip, s1.plan 
											FROM service_chip AS s1
												INNER JOIN(SELECT MAX(id_service_chip) id_service_chip, dni_familia_f, plan
												FROM service_chip
												GROUP BY dni_familia_f) AS s2
											ON s1.id_service_chip = s2.id_service_chip 
											AND s1.dni_familia_f = s2.dni_familia_f) AS service_chip
						ON familia.dni = service_chip.dni_familia_f
			
			");
		$this->db->join("estudiante", "familia.dni = estudiante.dni_familia", "LEFT");
		$this->db->join("institucion", "estudiante.institucion = institucion.id_institucion", "INNER");
		$this->db->join("nivel", "institucion.id_nivel = nivel.id_nivel", "INNER");

		if ($id != '')
			$this->db->where("estudiante.institucion = $id");

		$this->db->order_by("institucion.id_institucion", "ASC");
		$this->db->order_by("familia.ape_pat", "ASC");
		$this->db->order_by("familia.ape_mat", "ASC");

		$query = $this->db->get();

		return $result = $query->result();
	}

	function getListEstudiante($table, $having)
	{
		$this->db->select("$table.*  , institucion.institucion as institucion, nivel.nivel as nivel, 
		IF(estudiante.dni_familia = familia.dni, estudiante.dni_familia,'') as exist,
		concat(familia.nombres,' ', familia.ape_pat,' ',familia.ape_mat) as responsable, 
		familia.fecha_entrega as fecha_entrega, familia.celular as celular");

		$this->db->from($table);

		$this->db->join("institucion", "estudiante.institucion = institucion.id_institucion", "LEFT");
		$this->db->join("nivel", "institucion.id_nivel = nivel.id_nivel", "LEFT");
		$this->db->join("familia", "estudiante.dni_familia = familia.dni", "LEFT");

		$this->db->having($having);

		$this->db->order_by("institucion.id_institucion", "ASC");
		$this->db->order_by("responsable", "ASC");

		$query = $this->db->get();

		return $result = $query->result();
	}

	function getListObservados($table)
	{
		$this->db->select("$table.*  , institucion.institucion as institucion, nivel.nivel as nivel");

		$this->db->from($table);

		$this->db->join("institucion", "estu_observado.institucion = institucion.id_institucion");
		$this->db->join("nivel", "estu_observado.nivel = nivel.id_nivel");

		$this->db->where("estu_observado.observations != 'DNI ACTUALIZADO' and estu_observado.institucion >= 5 
		and estu_observado.institucion <= 13");

		$this->db->order_by("institucion.id_institucion", "ASC");

		$query = $this->db->get();

		return $result = $query->result();
	}

	function getContactoFamilia($table)
	{
		$this->db->select("$table.*  , barrio.barrio as barrio, count(estudiante.dni) total_estudiante");

		$this->db->from($table);

		$this->db->join("barrio", "$table.barrio = barrio.id_barrio", "left");
		$this->db->join("estudiante", "estudiante.dni_familia = $table.dni", "LEFT");

		$this->db->group_by("$table.dni");

		$this->db->having("total_estudiante > 0");

		$this->db->order_by("$table.ape_pat", "ASC");
		$this->db->order_by("$table.ape_mat", "ASC");
		$this->db->order_by("$table.nombres", "ASC");

		$query = $this->db->get();

		return $result = $query->result();
	}

	function familiaSinEstudiantes($table)
	{
		$this->db->select("familia.dni, familia.nombres, familia.ape_pat, familia.ape_mat, count(estudiante.dni) total_estudiante, db_cse.cse,  familia.fecha_entrega, service_chip.plan

			FROM familia AS familia
			
			LEFT JOIN(SELECT s1.id_service_chip, s1.dni_familia_f, s1.numero_chip, s1.plan 
					FROM service_chip AS s1
						INNER JOIN(SELECT MAX(id_service_chip) id_service_chip, dni_familia_f, plan
						FROM service_chip
						GROUP BY dni_familia_f) AS s2
					ON s1.id_service_chip = s2.id_service_chip 
					AND s1.dni_familia_f = s2.dni_familia_f) AS service_chip
			ON familia.dni = service_chip.dni_familia_f
			
			");
		$this->db->join("estudiante", "estudiante.dni_familia = familia.dni", "LEFT");
		$this->db->join("db_cse", "familia.dni = db_cse.dni_fammilia", "INNER");

		$this->db->group_by("familia.dni");

		$this->db->having("total_estudiante = 0");

		$this->db->order_by("familia.fecha_entrega", "DESC");
		$this->db->order_by("familia.ape_pat", "ASC");
		$this->db->order_by("familia.ape_mat", "ASC");

		$query = $this->db->get();

		return $result = $query->result();
	}

//	function countRows($table)
//	{
//		$query = $this->db->query("SELECT count(dni) AS num_of_time	FROM $table");
//		return $query->result();
//	}
//
//	function countRowsEntega($table, $where)
//	{
//		$query = $this->db->query("SELECT count(dni) AS num_of_time	FROM $table WHERE $where != 0");
//		return $query->result();
//	}
//
//	function countRowsFamilia($table)
//	{
//		$query = $this->db->query("SELECT count(familia.dni) AS num_of_time
//		FROM familia AS familia
//		INNER JOIN(SELECT familia.dni, count(estudiante.dni) total_estudiante
//							FROM familia AS familia
//							INNER JOIN estudiante AS estudiante
//							ON familia.dni = estudiante.dni_familia
//							GROUP BY familia.dni) AS num_estudiante
//		ON familia.dni = num_estudiante.dni");
//
//		return $query->result();
//	}
//
//	function countRowsEstudiante($table)
//	{
//		$query = $this->db->query("SELECT count(estudiante.dni) AS num_of_time
//		FROM estudiante AS estudiante
//		INNER JOIN familia AS familia
//		ON estudiante.dni_familia = familia.dni
//		WHERE estudiante.dni_familia != ''");
//
//		return $query->result();
//	}

}
