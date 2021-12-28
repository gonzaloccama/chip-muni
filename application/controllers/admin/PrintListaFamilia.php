<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class PrintListaFamilia extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->library('pagination');

		$this->load->helper('url');

		$this->load->library('ion_auth');

	}



	function index($id=1)

	{

		$cond="";

		$config = array();

		$config['suffix']='?'.$_SERVER['QUERY_STRING'];

		$config["base_url"] = base_url() . "admin/printlistafamilia/index/familias";

		//$total_row = $this->estudiante->getCount('estudiante', $searchBy, $searchValue);

		$config["first_url"] = base_url()."admin/printlistafamilia/index/familias".'?'.$_SERVER['QUERY_STRING'];

		include ("application/views/admin/printpdf/Familia/printlistafamilia.php");
	}

}

