<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RegNen extends CI_Controller

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

		$config["base_url"] = base_url() . "admin/regnen/index/$rel_field/$rel_id";

		$config["first_url"] = base_url() . "admin/regnen/index/$rel_field/$rel_id" . '?' . $_SERVER['QUERY_STRING'];


		require_once ("application/models/admin/conn.php");


		date_default_timezone_set('America/Lima');
		$date_current = date('Y-m-d H:i:s');
		$date_current_null = "0000-00-00 00:00:00";
		//echo $date_current;

		$sql = "UPDATE familia SET fecha_entrega ='$date_current_null' WHERE dni='$rel_id'";

		$conn->query($sql);

		include ("application/models/admin/Query_update_2.php");

		redirect("admin/estudiante/index/".$rel_field."/".$rel_id."/1");
	}

}
