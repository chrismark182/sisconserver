<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_bloqueo extends CI_Controller {

	var $data = array();

	public function __construct()
    {
        parent::__construct();
		$this->_init();
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

	
	public function index(){

		$this->output->set_template('siscon');
        $this->load->view('bloqueo/V_index', $this->data);
	}

	public function nuevo()
    {
        $documento ="Exec TIPO_DOCUMENTO_PERSONAS_LIS";

		$this->data['tdocumentos'] = $this->M_crud->sql($documento);
		
		$this->load->view('bloqueo/V_nuevo', $this->data);
	
    }
    
}
