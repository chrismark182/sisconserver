<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_alquiler_indicadores extends CI_Controller {
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
    public function cliente() 
	{              
        $this->_init();
        $this->data['monedas'] = $this->M_crud->sql("Exec MONEDA_LIS");
        $this->load->view('acuerdo/indicadores/cliente/V_index', $this->data);
    }

    public function mes() 
	{              
        $this->_init();
        $this->data['monedas'] = $this->M_crud->sql("Exec MONEDA_LIS");
        $this->load->view('acuerdo/indicadores/mes/V_index', $this->data);
    }
}

