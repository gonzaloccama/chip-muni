<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class EstudianteList extends CI_Controller

{

	function __construct()

	{

		parent::__construct();

		$this->load->library('pagination');

		$this->load->helper('url');

		$this->load->library('ion_auth');

		$this->load->library('form_validation');

		$this->load->model('admin/estudiantelist_model', 'estudiante');

	}


	function index($id = 1)

	{

		$cond = "";

		$data['searchBy'] = '';

		$data['searchValue'] = '';

		$v_fields = $this->estudiante->v_fields;

		$per_page_arr = array('8', '16', '32', '64', '124');


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

		$data['csvlink'] = base_url() . 'admin/estudiantelist/export/csv';

		$data['pdflink'] = base_url() . 'admin/estudiantelist/export/pdf';

		$data['per_page'] = isset($_GET['per_page']) && in_array($_GET['per_page'], $per_page_arr) ? $_GET['per_page'] : "10000";


		// PAGINATION

		$config = array();

		$config['suffix'] = '?' . $_SERVER['QUERY_STRING'];

		$config["base_url"] = base_url() . "admin/estudiantelist/index";

		$total_row = $this->estudiante->getCount('estudiante', $searchBy, $searchValue);

		$config["first_url"] = base_url() . "admin/estudiantelist/index" . '?' . $_SERVER['QUERY_STRING'];

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


		$data["results"] = $result = $this->estudiante->getList("estudiante", $pagi);

		$str_links = $this->pagination->create_links();


		$data["links"] = $str_links;

		// ./ PAGINATION /.


		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		} else {

			$data['estudiante'] = $this->estudiante->getList('estudiante');

			$this->load->view('admin/estudiantelist/manage', $data);

		}

	}


//	public function studentslist()
//	{
//		// POST data
//		$postData = $this->input->post();
//
//		// Get data
//		$data = $this->EstudianteList_model->getstudentslist($postData);
//
//		echo json_encode($data);
//	}


	public function add()

	{

		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		$data = NULL;


		$this->form_validation->set_rules('dni', 'Dni Name', 'required|exact_length[8]|numeric');
		$this->form_validation->set_rules('nombres', 'Nombres Name', 'required');
		$this->form_validation->set_rules('ape_pat', 'Ape_pat Name', 'required');
		$this->form_validation->set_rules('ape_mat', 'Ape_mat Name', 'required');
		$this->form_validation->set_rules('institucion', 'Institucion Name', 'required');
		$this->form_validation->set_rules('nivel', 'Nivel Name', 'trim');
		$this->form_validation->set_rules('observations', 'Observations Name', 'trim');
		$this->form_validation->set_rules('fecha_registro', 'Fecha_registro Name', 'trim');
		$this->form_validation->set_rules('dni_familia', 'Dni_familia Name', 'required');


		$data['errors'] = array();

		if ($this->form_validation->run() == FALSE) {

			$data["institucion"] = $this->estudiante->getListTable("institucion");
			$data["nivel"] = $this->estudiante->getListTable("nivel");
			$data["familia"] = $this->estudiante->getListTable("familia");


			$this->load->view('admin/estudiantelist/add', $data);

		} else {

			$institucion_id = set_value('institucion');
			$data_ = $this->estudiante->getRowInsti('institucion', $institucion_id);


			$saveData['dni'] = set_value('dni');
			$saveData['nombres'] = set_value('nombres');
			$saveData['ape_pat'] = set_value('ape_pat');
			$saveData['ape_mat'] = set_value('ape_mat');
			$saveData['institucion'] = set_value('institucion');
			$saveData['nivel'] = $data_->id_nivel;// set_value('nivel');
			$saveData['observations'] = set_value('observations');
			$saveData['fecha_registro'] = set_value('fecha_registro');
			$saveData['dni_familia'] = set_value('dni_familia');


			$insert_id = $this->estudiante->insert('estudiante', $saveData);


			$this->session->set_flashdata('message', 'Estudiante agregado exitosamente!');

			redirect('admin/estudiantelist');

		}

	}


	function view($id)

	{


		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		if (isset($id) and !empty($id)) {

			$data = NULL;


			$this->form_validation->set_rules('dni', 'Dni Name', 'required|exact_length[8]|numeric');
			$this->form_validation->set_rules('nombres', 'Nombres Name', 'required');
			$this->form_validation->set_rules('ape_pat', 'Ape_pat Name', 'required');
			$this->form_validation->set_rules('ape_mat', 'Ape_mat Name', 'required');
			$this->form_validation->set_rules('institucion', 'Institucion Name', 'required');
			$this->form_validation->set_rules('nivel', 'Nivel Name', 'trim');
			$this->form_validation->set_rules('observations', 'Observations Name', 'trim');
			$this->form_validation->set_rules('fecha_registro', 'Fecha_registro Name', 'trim');
			$this->form_validation->set_rules('dni_familia', 'Dni_familia Name', 'required');


			$data['errors'] = array();

			if ($this->form_validation->run() == FALSE) {

				$data["institucion"] = $this->estudiante->getListTable("institucion");
				$data["nivel"] = $this->estudiante->getListTable("nivel");
				$data["familia"] = $this->estudiante->getListTable("familia");


				$data['estudiante'] = $this->estudiante->getRow('estudiante', $id);

				$this->load->view('admin/estudiantelist/view', $data);

			} else {

				redirect('admin/estudiantelist/view');

			}

		} else {

			$this->session->set_flashdata('message', ' Identificación invalida !');

			redirect('admin/estudiantelist/view');

		}

	}


	function edit($id)

	{

		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		if (isset($id) and !empty($id)) {

			$data = NULL;


			$this->form_validation->set_rules('dni', 'Dni Name', 'required|exact_length[8]|numeric');
			$this->form_validation->set_rules('nombres', 'Nombres Name', 'required');
			$this->form_validation->set_rules('ape_pat', 'Ape_pat Name', 'required');
			$this->form_validation->set_rules('ape_mat', 'Ape_mat Name', 'required');
			$this->form_validation->set_rules('institucion', 'Institucion Name', 'required');
			$this->form_validation->set_rules('nivel', 'Nivel Name', 'trim');
			$this->form_validation->set_rules('observations', 'Observations Name', 'trim');
			$this->form_validation->set_rules('fecha_registro', 'Fecha_registro Name', 'trim');
			$this->form_validation->set_rules('dni_familia', 'Dni_familia Name', 'required');


			$data['errors'] = array();

			if ($this->form_validation->run() == FALSE) {


				$data['estudiante'] = $this->estudiante->getRow('estudiante', $id);

				$data["institucion"] = $this->estudiante->getListTable("institucion");
				$data["nivel"] = $this->estudiante->getListTable("nivel");
				$data["familia"] = $this->estudiante->getListTable("familia");

				$this->load->view('admin/estudiantelist/edit', $data);

			} else {


				$institucion_id = set_value('institucion');
				$data_ = $this->estudiante->getRowInsti('institucion', $institucion_id);

				$saveData['dni'] = set_value('dni');
				$saveData['nombres'] = set_value('nombres');
				$saveData['ape_pat'] = set_value('ape_pat');
				$saveData['ape_mat'] = set_value('ape_mat');
				$saveData['institucion'] = set_value('institucion');
				$saveData['nivel'] = $data_->id_nivel; //set_value('nivel');
				$saveData['observations'] = set_value('observations');
				$saveData['fecha_registro'] = set_value('fecha_registro');
				$saveData['dni_familia'] = set_value('dni_familia');


				$this->estudiante->updateData('estudiante', $saveData, $id);


				$this->session->set_flashdata('message', 'Estudiante actualizado con éxito!');

				redirect('admin/estudiantelist');

			}

		} else {

			$this->session->set_flashdata('message', ' Identificación invalida !');

			redirect('admin/estudiantelist');

		}

	}


	function delete($id = '')

	{

		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		if (isset($id) and !empty($id)) {

			$count = $this->estudiante->getCount('estudiante', 'estudiante.dni', $id);

			if (isset($count) and !empty($count)) {

				$this->estudiante->delete('estudiante', 'dni', $id);

				$this->session->set_flashdata('message', ' Estudiante eliminado con éxito !');

				echo "success";

				exit;

			} else {

				$this->session->set_flashdata('message', ' Identificación invalida !');

			}

		} else {

			$this->session->set_flashdata('message', ' Identificación invalida !');

		}

	}


	function deleteAll($id = '')

	{


		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		$all_ids = $_POST["allIds"];


		if (isset($all_ids) and !empty($all_ids)) {


			//$count=$this->estudiante->getCount('estudiante','estudiante.id',$id);

			for ($a = 0; $a < count($all_ids); $a++) {

				if ($all_ids[$a] != "") {

					$this->estudiante->delete('estudiante', 'dni', $all_ids[$a]);

					$this->session->set_flashdata('message', ' Estudiante (s) eliminado con éxito !');

				}

			}


			echo "success";

			exit;

		} else {

			$this->session->set_flashdata('message', ' Identificación invalida !');

		}

	}


	function export($filetype = 'csv')
	{


		if (!$this->ion_auth->logged_in()) {

			redirect('/auth/login/');

		}


		$searchBy = '';

		$searchValue = '';

		$v_fields = array('dni', 'nombres', 'ape_pat', 'ape_mat', 'institucion', 'nivel', 'observations', 'fecha_registro', 'dni_familia');


		$data['sortBy'] = '';


		$order_by = isset($_GET['sortBy']) && in_array($_GET['sortBy'], $v_fields) ? $_GET['sortBy'] : '';

		$order = isset($_GET['order']) && $_GET['order'] == 'asc' ? 'asc' : 'desc';


		$searchBy = isset($_GET['searchBy']) && in_array($_GET['searchBy'], $v_fields) ? $_GET['searchBy'] : null;

		$searchValue = isset($_GET['searchValue']) ? $_GET['searchValue'] : '';

		$searchValue = addslashes($searchValue);

		$pagi = array('order' => $order, 'order_by' => $order_by);


		$result = $this->estudiante->getList("estudiante");


		if ($filetype == 'csv') {

			header('Content-Type: application/csv');

			header('Content-Disposition: attachment; filename=estudiante.csv');

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

			<h1 align="center">Estudiante</h1>

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

			$pdf->Output('estudiante.pdf', "D");

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

				if (!is_null($estudiante = $this->estudiante->getRow('estudiante', $id))) {

					$status = $estudiante->$field;

					if ($status == 1) {

						$status = 0;

					} else {

						$status = 1;

					}

					$statusData[$field] = $status;

					$this->estudiante->updateData('estudiante', $statusData, $id);

					$this->session->set_flashdata('message', ucfirst($field) . ' Actualizado con éxito');

					if (isset($_GET['redirect']) && $_GET['redirect'] != '') {

						redirect($_GET['redirect']);

					} else {

						redirect('admin/estudiantelist');

					}

				} else {

					$this->session->set_flashdata('error', 'Invalid Record Id!');

					redirect('admin/estudiantelist');

				}

			} else {

				$this->session->set_flashdata('error', 'Invalid Record Id!');

				redirect('admin/estudiantelist');

			}

		}

	}


}



