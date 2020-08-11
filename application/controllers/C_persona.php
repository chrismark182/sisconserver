<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Persona extends CI_Controller {

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
    //Vistas
    public function index() 
	{              
		$this->load->view('persona/V_index', $this->data);
	}	
	public function nuevo() 
	{              
		$tipodocumento = "Exec TIPO_DOCUMENTO_PERSONAS_LIS";        
        $this->data['tdocumentos'] = $this->M_crud->sql($tipodocumento); 
        
        $clientes = "Exec  CLIENTE_ESCLIENTE_LIS 1,'1'";
		$this->data['clientes'] = $this->M_crud->sql($clientes); 
		
		$this->load->view('persona/V_nuevo', $this->data);

    }
	public function eliminar($id)
    {
		$sql = "Exec  PERSONA_DEL {$this->data['empresa']->EMPRES_N_ID} , {$id}, {$this->data['session']->USUARI_N_ID}";
		var_dump($sql);				
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('personas', 'refresh');       
    }  
}

