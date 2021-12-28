<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Estu_observado extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->library('pagination');

		$this->load->helper('url');

		$this->load->library('ion_auth');

		$this->load->library('form_validation');

		$this->load->model('admin/estu_observado_model', 'estu_observado');

	}


	function index($id = 1)

	{

		$cond = "";

		$data['searchBy'] = '';

		$data['searchValue'] = '';

		$v_fields = $this->estu_observado->v_fields;

		$per_page_arr = array('8', '16', '32', '64', '128');


		if (isset($_GET['searchValue']) && isset($_GET['searchBy'])) {

			$data['searchBy'] = $_GET['searchBy'];

			$data['searchValue'] = $_GET['searchValue'];

			if (!empty($_GET['searchValue']) && $_GET['searchValue'] != "" && !empty($_GET['searchBy']) && $_GET['searchBy'] != "") {

				$cond = "true";

			}

		}


		$data['sortBy'] = '';

		$order_by = isset($_GET['sortBy']) && in_array($_GET['sortBy'], $v_fields) ? $_GET['sortBy'] : '';

		$order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'asc' : 'desc';

		$searchBy = isset($_GET['searchBy']) && in_array($_GET['searchBy'], $v_fields) ? $_GET['searchBy'] : null;

		$searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : '';

		$searchValue = addslashes($searchValue);


		if (isset($_GET['sortBy']) && $_GET['sortBy'] != '') {

			$data['sortBy'] = $_GET['sortBy'];

			if (isset($_GET['order']) && $_GET['order'] != '') {

				$_GET['order'] = $_GET['order'] == 'asc' ? 'desc' : 'asc';

			} else {

				$_GET['order'] = 'desc';

			}

		}


		$get_q = $_GET;

		foreach ($v_fields as $key => $value) {

			$get_q['sortBy'] = $value;

			$query_result = http_build_query($get_q);

			$data['fields_links'][$value] = current_url() . '?' . $query_result;

		}

		$data['csvlink'] = base_url() . 'admin/estu_observado/export/csv';

		$data['pdflink'] = base_url() . 'admin/estu_observado/export/pdf';

		$data['per_page'] = isset($_GET['per_page']) && in_array($_GET['per_page'], $per_page_arr) ? $_GET['per_page'] : "8";


		// PAGINATION

		$config = array();

		$config['suffix'] = '?' . $_SERVER['QUERY_STRING'];

		$config["base_url"] = base_url() . "admin/estu_observado/index";

		$total_row = $this->estu_observado->getCount('estu_observado', $searchBy, $searchValue);

		$config["first_url"] = base_url() . "admin/estu_observado/index" . '?' . $_SERVER['QUERY_STRING'];

		$config["total_rows"] = $total_row;

		$config["per_page"] = $per_page = $data['per_page'];

		$config["uri_segment"] = $this->uri->total_segments();

		$config['use_page_numbers'] = TRUE;

		$config['num_links'] = 3; //$total_row

		$config['cur_tag_open'] = '&nbsp;<a class="current">';

		$config['cur_tag_close'] = '</a>';

		$config['full_tag_open'] = "<ul class='pagination'>";

		$config['full_tag_close'] = "</ul>";

		$config['num_tag_open'] = '<li>';

		$config['num_tag_close'] = '</li>';

		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";

		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

		$config['next_tag_open'] = "<li>";

		$config['next_tagl_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";

		$config['prev_tagl_close'] = "</li>";

		$config['first_link'] = 'Primero';

		$config['first_tag_open'] = "<li>";

		$config['first_tagl_close'] = "</li>";

		$config['last_link'] = 'Ultimo';

		$config['last_tag_open'] = "<li>";

		$config['last_tagl_close'] = "</li>";

		$this->pagination->initialize($config);


		if ($this->uri->segment(2)) {

			$cur_page = $id;

			$pagi = array("cur_page" => ($cur_page - 1) * $per_page, "per_page" => $per_page, 'order' => $order, 'order_by' => $order_by);

		} else {

			$pagi = array("cur_page" => 0, "per_page" => $per_page);

		}


		$data["results"] = $result = $this->estu_observado->getList("estu_observado", $pagi);

		$str_links = $this->pagination->create_links();


		$data["links"] = $str_links;

		// ./ PAGINATION /.


		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		} else {

			$data['estu_observado'] = $this->estu_observado->getList('estu_observado');


			$this->load->view('admin/estu_observado/manage', $data);

		}

	}


	public function add()

	{

		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		$data = NULL;


		$this->form_validation->set_rules('codigo', 'Codigo Name', 'trim');
		$this->form_validation->set_rules('dni_f', 'Dni_f Name', 'trim');
		$this->form_validation->set_rules('nombres_f', 'Nombres_f Name', 'trim');
		$this->form_validation->set_rules('dni_e', 'Dni_e Name', 'trim');
		$this->form_validation->set_rules('nombres_e', 'Nombres_e Name', 'trim');
		$this->form_validation->set_rules('institucion', 'Institucion Name', 'trim');
		$this->form_validation->set_rules('nivel', 'Nivel Name', 'trim');
		$this->form_validation->set_rules('observations', 'Observations Name', 'trim');


		$data['errors'] = array();

		if ($this->form_validation->run() == FALSE) {

			$data["institucion"] = $this->estu_observado->getListTable("institucion");
			$data["nivel"] = $this->estu_observado->getListTable("nivel");


			$this->load->view('admin/estu_observado/add', $data);

		} else {

			$saveData['codigo'] = set_value('codigo');
			$saveData['dni_f'] = set_value('dni_f');
			$saveData['nombres_f'] = set_value('nombres_f');
			$saveData['dni_e'] = set_value('dni_e');
			$saveData['nombres_e'] = set_value('nombres_e');
			$saveData['institucion'] = set_value('institucion');
			$saveData['nivel'] = set_value('nivel');
			$saveData['observations'] = set_value('observations');


			$insert_id = $this->estu_observado->insert('estu_observado', $saveData);


			$this->session->set_flashdata('message', 'Estu_observado Added Successfully!');

			redirect('admin/estu_observado');

		}

	}


	function view($id)

	{


		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		if (isset($id) and !empty($id)) {

			$data = NULL;


			$this->form_validation->set_rules('codigo', 'Codigo Name', 'trim');
			$this->form_validation->set_rules('dni_f', 'Dni_f Name', 'trim');
			$this->form_validation->set_rules('nombres_f', 'Nombres_f Name', 'trim');
			$this->form_validation->set_rules('dni_e', 'Dni_e Name', 'trim');
			$this->form_validation->set_rules('nombres_e', 'Nombres_e Name', 'trim');
			$this->form_validation->set_rules('institucion', 'Institucion Name', 'trim');
			$this->form_validation->set_rules('nivel', 'Nivel Name', 'trim');
			$this->form_validation->set_rules('observations', 'Observations Name', 'trim');


			$data['errors'] = array();

			if ($this->form_validation->run() == FALSE) {

				$data["institucion"] = $this->estu_observado->getListTable("institucion");
				$data["nivel"] = $this->estu_observado->getListTable("nivel");


				$data['estu_observado'] = $this->estu_observado->getRow('estu_observado', $id);

				$this->load->view('admin/estu_observado/view', $data);

			} else {

				redirect('admin/estu_observado/view');

			}

		} else {

			$this->session->set_flashdata('message', ' Invalid Id !');

			redirect('admin/estu_observado/view');

		}

	}


	function edit($id)

	{

		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		if (isset($id) and !empty($id)) {

			$data = NULL;


			$this->form_validation->set_rules('codigo', 'Codigo Name', 'trim');
			$this->form_validation->set_rules('dni_f', 'DNI', 'required|exact_length[8]|numeric');
			$this->form_validation->set_rules('nombres_f', 'Nombres_f Name', 'trim');
			$this->form_validation->set_rules('dni_e', 'Dni_e Name', 'trim');
			$this->form_validation->set_rules('nombres_e', 'Nombres_e Name', 'trim');
			$this->form_validation->set_rules('institucion', 'Institucion Name', 'trim');
			$this->form_validation->set_rules('nivel', 'Nivel Name', 'trim');
			$this->form_validation->set_rules('observations', 'Observations Name', 'trim');

			$this->form_validation->set_rules('nombres', 'nombres', 'required');
			$this->form_validation->set_rules('ape_pat', 'Apellidos Paterno', 'required');
			$this->form_validation->set_rules('ape_mat', 'Apellidos Materno', 'required');
			$this->form_validation->set_rules('direccion', 'direccion', 'required');
			$this->form_validation->set_rules('celular', 'celular', 'required|exact_length[9]|numeric');


			$data['errors'] = array();

			if ($this->form_validation->run() == FALSE) {


				$data['estu_observado'] = $this->estu_observado->getRow('estu_observado', $id);

				$data["institucion"] = $this->estu_observado->getListTable("institucion");
				$data["nivel"] = $this->estu_observado->getListTable("nivel");

				$data['barrio'] = $this->estu_observado->getListTable("barrio");

				$this->load->view('admin/estu_observado/edit', $data);

			} else {

				$saveData['codigo'] = set_value('codigo');
				$saveData['dni_f'] = set_value('dni_f');
				$saveData['nombres_f'] = strtoupper(set_value('nombres')) .
					" " . strtoupper(set_value('ape_pat')) .
					" " . strtoupper(set_value('ape_pat')); //set_value('nombres_f');
				$saveData['dni_e'] = set_value('dni_e');
				$saveData['nombres_e'] = set_value('nombres_e');
				$saveData['institucion'] = set_value('institucion');
				$saveData['nivel'] = set_value('nivel');
				$saveData['observations'] = "DNI ACTUALIZADO";

				$this->estu_observado->updateData('estu_observado', $saveData, $id);


				//begin table familia

				date_default_timezone_set('America/Lima');

				$date_current = date("Y-m-d H:i:s");


				$DataFamilia['dni'] = $saveData['dni_f'];
				$DataFamilia['nombres'] = strtoupper(set_value('nombres'));
				$DataFamilia['ape_pat'] = strtoupper(set_value('ape_pat'));
				$DataFamilia['ape_mat'] = strtoupper(set_value('ape_mat'));
				$DataFamilia['direccion'] = strtoupper(set_value('direccion'));
				$DataFamilia['barrio'] = set_value('barrio');
				$DataFamilia['celular'] = set_value('celular');
				$DataFamilia['observations'] = $saveData['observations'];
				$DataFamilia['fecha_registro'] = $date_current;


				$dataCSE['dni_fammilia'] = $saveData['dni_f'];
				$dataCSE['cse'] = strtoupper("SIN VERIFICAR");
				$dataCSE['fecha'] = $date_current;


				$insert_id = $this->estu_observado->insert('familia', $DataFamilia);
				$insert_cse = $this->estu_observado->insert('db_cse', $dataCSE);


				//end table familia


				$dni_familia = $saveData['dni_f'];


				$this->session->set_flashdata('message', 'Se agregó correctamente los datos del observado!');

//				redirect('admin/estu_observado');
				redirect('admin/estudiante' . '/index/dni_familia/' . $dni_familia . '/1');

			}

		} else {

			$this->session->set_flashdata('message', ' Invalid Id !');

			redirect('admin/estu_observado');

		}

	}


	function delete($id = '')

	{

		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		if (isset($id) and !empty($id)) {

			$count = $this->estu_observado->getCount('estu_observado', 'estu_observado.codigo', $id);

			if (isset($count) and !empty($count)) {

				$this->estu_observado->delete('estu_observado', 'codigo', $id);

				$this->session->set_flashdata('message', ' Estu_observado Deleted Successfully !');

				echo "success";

				exit;

			} else {

				$this->session->set_flashdata('message', ' Invalid Id !');

			}

		} else {

			$this->session->set_flashdata('message', ' Invalid Id !');

		}

	}


	function deleteAll($id = '')

	{


		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		$all_ids = $_POST["allIds"];


		if (isset($all_ids) and !empty($all_ids)) {


			//$count=$this->estu_observado->getCount('estu_observado','estu_observado.id',$id);

			for ($a = 0; $a < count($all_ids); $a++) {

				if ($all_ids[$a] != "") {

					$this->estu_observado->delete('estu_observado', 'codigo', $all_ids[$a]);

					$this->session->set_flashdata('message', ' Estu_observado(s) Deleted Successfully !');

				}

			}


			echo "success";

			exit;

		} else {

			$this->session->set_flashdata('message', ' Invalid Id !');

		}

	}


	function export($filetype = 'csv')
	{


		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		$searchBy = '';

		$searchValue = '';

		$v_fields = array('codigo', 'dni_f', 'nombres_f', 'dni_e', 'nombres_e', 'institucion', 'nivel', 'observations');


		$data['sortBy'] = '';


		$order_by = isset($_GET['sortBy']) && in_array($_GET['sortBy'], $v_fields) ? $_GET['sortBy'] : '';

		$order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'asc' : 'desc';


		$searchBy = isset($_GET['searchBy']) && in_array($_GET['searchBy'], $v_fields) ? $_GET['searchBy'] : null;

		$searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : '';

		$searchValue = addslashes($searchValue);

		$pagi = array('order' => $order, 'order_by' => $order_by);


		$result = $this->estu_observado->getList("estu_observado");


		if ($filetype == 'csv') {

			header('Content-Type: application/csv');

			header('Content-Disposition: attachment; filename=estu_observado.csv');

			header('Pragma: no-cache');

			$csv = 'Sr. No,' . implode(',', $v_fields) . "\n";

			foreach ($result as $key => $value) {

				$line = ($key + 1) . ',';

				foreach ($v_fields as $field) {

					$line .= '"' . addslashes($value->$field) . '"' . ',';

				}

				$csv .= ltrim($line, ',') . "\n";

			}

			echo $csv;
			exit;

		} elseif ($filetype == 'pdf') {

			error_reporting(0);

			ob_start();

			$this->load->library('m_pdf');

			$table = '

			<html>

			<head><title></title>

			<style>

			table{

				border:1px solid;

			}

			tr:nth-child(even)

			{

			    background-color: rgba(158, 158, 158, 0.82);

			}

			</style>

			</head>

			<body>

			<h1 align="center">Estu_observado</h1>

			<table><tr>';

			$table .= '<th>Sr. No</th>';

			foreach ($v_fields as $value) {

				$table .= '<th>' . $value . '</th>';

			}

			$table .= '</tr>';

			foreach ($result as $key => $value) {

				$table .= '<tr><td>' . ($key + 1) . '</td>';

				foreach ($v_fields as $field) {

					$table .= '<td>' . $value->$field . '</td>';

				}

				$table .= '</tr>';

			}

			$table .= '</table></body></html>';

			ob_clean();

			$pdf = $this->m_pdf->load();

			$pdf->WriteHTML($table);

			$pdf->Output('estu_observado.pdf', "D");

			exit;

		} else {

			echo 'Invalid option';
			exit;

		}

	}


	function status($field, $id)

	{

		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		if (in_array($field, array())) {

			if (isset($id) && !empty($id)) {

				if (!is_null($estu_observado = $this->estu_observado->getRow('estu_observado', $id))) {

					$status = $estu_observado->$field;

					if ($status == 1) {

						$status = 0;

					} else {

						$status = 1;

					}

					$statusData[$field] = $status;

					$this->estu_observado->updateData('estu_observado', $statusData, $id);

					$this->session->set_flashdata('message', ucfirst($field) . ' Updated Successfully');

					if (isset($_GET['redirect']) && $_GET['redirect'] != '') {

						redirect($_GET['redirect']);

					} else {

						redirect('admin/estu_observado');

					}

				} else {

					$this->session->set_flashdata('error', 'Invalid Record Id!');

					redirect('admin/estu_observado');

				}

			} else {

				$this->session->set_flashdata('error', 'Invalid Record Id!');

				redirect('admin/estu_observado');

			}

		}

	}


}



