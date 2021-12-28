<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RegEn extends CI_Controller

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

		$config["base_url"] = base_url() . "admin/regen/index/$rel_field/$rel_id";

		$config["first_url"] = base_url() . "admin/regen/index/$rel_field/$rel_id" . '?' . $_SERVER['QUERY_STRING'];


		require_once ("application/models/admin/conn.php");

		$chip = $_GET['chip'];
		$plan = $_GET['plan'];


		date_default_timezone_set('America/Lima');

		$date_current = date('Y-m-d H:i:s');
		//echo $date_current;

		$sql = "UPDATE familia SET fecha_entrega ='$date_current' WHERE dni='$rel_id'";

		$conn->query($sql);

		include ('application/models/admin/Query_update_1.php');

		redirect("admin/estudiante/index/".$rel_field."/".$rel_id."/1");
	}

}
