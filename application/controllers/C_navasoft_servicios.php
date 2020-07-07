<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_navasoft_servicios extends CI_Controller {
    var $data = array();

    public function __construct()
    {
        parent::__construct();
		if($this->session->userdata('logged_in')):
			$this->load->library('EsandexAccesos');  
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
            $empresa = $this->M_crud->read('empresa', array('EMPRES_N_ID' => $this->session->userdata('empresa_id')));
            $this->data['empresa']=$empresa[0];      
		else:
			redirect(base_url(),'refresh');
		endif;
    }
    private function _init()
	{
		$this->output->set_template('siscon');
	}
    //Vistas
    public function index() 
	{         
        $this->_init();

        $clientes = "Exec  CLIENTE_ESCLIENTE_LIS 1,'1'";
        $this->data['clientes'] =$this->M_crud->sql($clientes);
        
        $sedes = 'Exec SEDE_LIS 0,0';
        $this->data['sedes'] = $this->M_crud->sql($sedes);

        $this->load->view('navasoft/servicios/V_index', $this->data);
    }

    //Procesos
    public function buscar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec LIQUIDACION_NAVASOFT_LIS {$data['empresa']}, '{$data['desde']}', '{$data['hasta']}', {$data['cliente']}, {$data['sede']}, '{$data['tipo']}', {$data['liquidacion']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function generar_dbf()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec LIQUIDACION_UPD_NAVASOFT {$data['empresa']}, {$data['liquidacion']}, {$data['usuario']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
}

