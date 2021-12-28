<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PrintEstudiantes extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->library('pagination');

		$this->load->helper('url');

		$this->load->library('ion_auth');

	}


	function index($rel_field = '', $rel_id = '', $id = 1)

	{

		$cond = "";



		$config = array();

		$config['suffix'] = '?' . $_SERVER['QUERY_STRING'];

		$config["base_url"] = base_url() . "admin/printestudiantes/index/$rel_field/$rel_id";

		$config["first_url"] = base_url() . "admin/printestudiantes/index/$rel_field/$rel_id" . '?' . $_SERVER['QUERY_STRING'];

		include ("application/views/admin/printpdf/Estudiantes/printestudiantes.php");

	}

}

