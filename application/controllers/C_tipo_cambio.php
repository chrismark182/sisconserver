<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_tipo_cambio extends CI_Controller {
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

    public function index() 
	{   
        $this->_init();      
        
        $sql= "Exec TIPO_CAMBIO_LIS 0,0" ;
        $this->data['cambios'] = $this->M_crud->sql($sql);  
        $this->load->view('tipo_cambio/V_index', $this->data);

    }
    public function nuevo()
    {
        $this->load->view('tipo_cambio/V_nuevo', $this->data);
        $this->_init();
        
        
    }
    
    public function crear(){

                $sql = "Exec TIPO_CAMBIO_INS "      . $this->data['empresa']->EMPRES_N_ID .  ",'"
                                                . $this->input->post('fecha') . "',"
                                                . $this->input->post('monto'). ","
                                                . $this->data['session']->USUARI_N_ID ;
                
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos creados correctamente');
        redirect('cambios', 'refresh');   
    
    }
    
    public function eliminar($empresa,$cambio)
    {

        $sql = "Exec TIPO_CAMBIO_DEL "     . $empresa .","
                                        . $cambio.","
                                        .$this->data['session']->USUARI_N_ID ; 
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('cambios', 'refresh');       
    }  


}

