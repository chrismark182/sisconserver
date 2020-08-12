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
        
        $clientes = "Exec CLIENTE_ESTODOS_LIS {$this->data['empresa']->EMPRES_N_ID},'1'";
		$this->data['clientes'] = $this->M_crud->sql($clientes); 
		
		$this->load->view('persona/V_nuevo', $this->data);
	}
	
	public function editar($empresa,$persona)
    {  		
		$tipodocumento = "Exec TIPO_DOCUMENTO_PERSONAS_LIS";        
		$this->data['tdocumentos'] = $this->M_crud->sql($tipodocumento); 

		$clientes = "Exec CLIENTE_ESTODOS_LIS {$this->data['empresa']->EMPRES_N_ID},'1'";
		$this->data['clientes'] = $this->M_crud->sql($clientes); 
		
		$sql = "Exec PERSONA_LIS2 "  .$empresa. ","
                                    .$persona ;
        $personas = $this->M_crud->sql($sql);
        $this->data['personas'] = $personas[0];
       
        $this->load->view('persona/V_editar',$this->data);
	}
	
	public function crear()
	{
		$sql = "Exec PERSONA_INS "      . $this->data['empresa']->EMPRES_N_ID . ","
										. $this->input->post('cliente') . "," 
										. $this->input->post('tdocumento') . ",'" 
										. $this->input->post('ndocumento') . "','" 
										. $this->input->post('nombres') . "','" 
										. $this->input->post('apellidos') . "','" 
										. $this->input->post('foto') . "','" 
										. $this->input->post('scrt_ini') . "','" 
										. $this->input->post('scrt_fin') . "'," 
										. $this->data['session']->USUARI_N_ID ;
		
										$this->M_crud->sql($sql);
										$url = 'personas?n=' . $this->input->post('ndocumento'); 
										redirect($url,'refresh');
	}
	
	public function actualizar($empresa,$persona)
    {
        $sql = "Exec PERSONA_UPD "      .$empresa. ","
										.$persona. ",'" 
										. $this->input->post('nombres') . "','" 
										. $this->input->post('apellidos') . "','" 
										. $this->input->post('scrt_ini') . "','" 
										. $this->input->post('scrt_fin') . "'," 
										. $this->data['session']->USUARI_N_ID ;
		
										$this->M_crud->sql($sql);
										$url = 'personas?n=' . $this->input->post('ndocumento'); 
										redirect($url,'refresh');
	}
	
	public function eliminar($id)
    {
		$sql = "Exec PERSONA_DEL {$this->data['empresa']->EMPRES_N_ID} , {$id}, {$this->data['session']->USUARI_N_ID}";
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('personas', 'refresh');       
    }  
}

