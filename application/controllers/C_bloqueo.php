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

	
	public function index()
	{
		$this->load->view('bloqueo/V_index', $this->data);		
	}

	public function nuevo()
    {
		$this->data['misdoc'] = $this->M_crud->sql("Exec TIPO_DOCUMENTO_PERSONAS_LIS");
		$this->data['datos_bloqueo'] = $this->M_crud->sql("Exec PERSONA_BLOQUEO_LIS '%','%','%','%'");
		$this->load->view('bloqueo/V_nuevo', $this->data);		
	}
	
	public function crea_bloqueo(){

		echo "<script> alert('Hola Mundo desde php') </script>";

		
		$this->M_crud->sql("EXEC INSERCION_BLOQUEO_USUARIO 0, 0, '{$this->input->post('username')}',''");

		$this->load->view('bloqueo/V_nuevo',$this->data);		
 	}
}
