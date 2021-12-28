<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PrintPDF extends CI_Controller
{
	function __construct()

	{

		parent::__construct();

		$this->load->library('pagination');

		$this->load->helper('url');

		$this->load->helper('PDF_helper');

		$this->load->helper('PDFLAND_helper');

		$this->load->model('admin/PrintFamilia_model', 'familia');

		$this->load->library('ion_auth');

		$this->load->library('form_validation');

	}

	function index()
	{
		$data = NULL;

		$this->form_validation->set_rules('printpdf', 'Seleccione una opción', 'required');

		$data['errors'] = array();

		if ($this->form_validation->run() == FALSE) {

			$this->session->set_flashdata('message', 'Seleccione una opción para imprimir!');

			redirect('admin/familia/index');

		} else {

			$saveData['printpdf'] = set_value('printpdf');
			redirect('admin/PrintPDF/' . $saveData['printpdf']);

		}
	}

	function entrega_familia()
	{
		$data["title"] = 'FAMILIAS CON ESTUDIANTES BENEFICIADOS CON INTERNET';
		$data["familia"] = $this->familia->getListFamilia('familia', 'total_estudiante > 0');
		$data["pdf"] = new PDF_helper('P', 'mm', 'A4');

		$this->load->view('admin/printpdf/Familia/familia', $data);
	}

	function familia_institucion($id = '')
	{
		if ($id == '')
			$data["title"] = 'INTERNET CHIP ENTREGADO A FAMILIAS POR INSTITUCIONES';
		else
			$data["title"] = 'INTERNET CHIP ENTREGADO A FAMILIAS DE ';
			$data["insti"] = $_GET['insti'];

		$data["familia"] = $this->familia->getFamiliaInstitucion($id);
		$data["pdf"] = new PDF_helper('P', 'mm', 'A4');

		$this->load->view('admin/printpdf/Familia/familia_institucion', $data);
	}

	function entrega_estudiante()
	{
		$data["title"] = 'LISTA DE ENTREGA DE CHIP POR ESTUDIANTE';

		$data["estudiante"] = $this->familia->getListEstudiante('estudiante', "exist != ''");
		$data["pdf"] = new PDFLAND_helper('L', 'mm', 'A4');

		$this->load->view('admin/printpdf/Estudiantes/entregado_estudiante', $data);

	}


	function reserva()
	{
		$this->db->select("table.*  , institucion.institucion as institucion, nivel.nivel as nivel, 
		IF(estudiante.dni_familia = familia.dni, estudiante.dni_familia,'') as exist,
		concat(familia.nombres,' ', familia.ape_pat,' ',familia.ape_mat) as responsable, 
		familia.fecha_entrega as fecha_entrega, service_chip.numero_chip as celular
		
		FROM table AS table
		
		LEFT JOIN(SELECT s1.id_service_chip, s1.dni_familia_f, s1.numero_chip, s1.plan 
											FROM service_chip AS s1
												INNER JOIN(SELECT MAX(id_service_chip) id_service_chip, dni_familia_f, plan
												FROM service_chip
												GROUP BY dni_familia_f) AS s2
											ON s1.id_service_chip = s2.id_service_chip 
											AND s1.dni_familia_f = s2.dni_familia_f) AS service_chip
						ON estudiante.dni_familia = service_chip.dni_familia_f");

		//$this->db->from($table);

		$this->db->join("institucion", "estudiante.institucion = institucion.id_institucion", "LEFT");
		$this->db->join("nivel", "institucion.id_nivel = nivel.id_nivel", "LEFT");
		$this->db->join("familia", "estudiante.dni_familia = familia.dni", "LEFT");

		$this->db->where("
		familia.fecha_entrega != 0 and
		(institucion.id_institucion = 2 
		or institucion.id_institucion > 4 and institucion.id_institucion < 28 
		or institucion.id_institucion = 30
		or institucion.id_institucion = 48 
		or institucion.id_institucion = 57 
		or institucion.id_institucion = 60)");
		//$this->db->where("");
		$this->db->having("having");

		$this->db->order_by("institucion.id_institucion", "ASC");
		$this->db->order_by("responsable", "ASC");

		$query = $this->db->get();

		return $result = $query->result();
	}


	function observados()
	{
		$data["observados"] = $this->familia->getListObservados('estu_observado');
		$data["pdf"] = new PDFLAND_helper('L', 'mm', 'A4');

		$this->load->view('admin/printpdf/Estudiantes/observados', $data);
	}

	function contacto_familia()
	{

		$data["familia"] = $this->familia->getContactoFamilia('familia');
		$data["pdf"] = new PDF_helper('P', 'mm', 'A4');

		$this->load->view('admin/printpdf/Familia/familia_contacto', $data);
	}

	function sin_estudiante_familia()
	{
		$data["title"] = 'LISTA DE FAMILIAS SIN ESTUDIANTES ASOCIADOS';

		$data["familia"] = $this->familia->getListFamilia('familia', 'total_estudiante = 0');;
		$data["pdf"] = new PDF_helper('P', 'mm', 'A4');

		$this->load->view('admin/printpdf/Familia/familia', $data);
	}

	function sin_familia_estudiantes()
	{
		$data["title"] = 'LISTA DE ESTUDIANTES NO ASOCIADOS A UN RESPONSABLE';

		$data["estudiante"] = $this->familia->getListEstudiante('estudiante', "exist = ''");
		$data["pdf"] = new PDFLAND_helper('L', 'mm', 'A4');

		$this->load->view('admin/printpdf/Estudiantes/entregado_estudiante', $data);

	}

}
