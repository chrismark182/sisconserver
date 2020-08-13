<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_revision_doc extends CI_Controller {
    var $data = array();

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')):
            $this->_init();
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
        $this->load->view('revision_doc/V_index', $this->data);
    }

    public function aceptar($id)
    {
        $sql = "Exec MOVIMIENTO_DOCUMENTO_UPD_ACEPTAR 1,"
                                        . $id .","
                                        .$this->data['session']->USUARI_N_ID ;  
                                        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos grabados correctamente');
        redirect('revision_doc', 'refresh');       
    }  

    public function rechazar($id)
    {
        $sql = "Exec MOVIMIENTO_DOCUMENTO_UPD_RECHAZAR 1,"
                                        . $id .","
                                        .$this->data['session']->USUARI_N_ID ;  
                                        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos grabados correctamente');
        redirect('revision_doc', 'refresh');       
    }  
}

