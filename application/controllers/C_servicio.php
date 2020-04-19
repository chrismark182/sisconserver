<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_servicio extends CI_Controller {

	var $data = array();

	public function __construct()
    {
        parent::__construct();
		$this->_init();
		if($this->session->userdata('logged_in')):
			$this->load->library('EsandexAccesos');  
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
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
		$sql = "Exec SERVICIO_LIS 0,0";
        $this->data['servicios'] = $this->M_crud->sql($sql);
        

		$this->load->view('servicio/V_index', $this->data);
	}
	public function nuevo(){
		
		$this->load->view('servicio/V_nuevo');
	
	}
	public function editar($empresa,$servicio)
    {  
        $sql = "Exec UBICACION_LIS "    .$empresa . ","
                                        .$servicio ;
                                        
        
         
        $servicios = $this->M_crud->sql($sql);
        $this->data['servicio'] = $ubicaciones[0];
        $this->load->view('servicio/V_editar',$this->data);
    }
    public function crear(){

		$sql = "Exec SERVICIO_INS "     . $this->data['empresa']->EMPRES_N_ID . ",'"
										. $this->input->post('descripcion') . "','0','0','0'"
										. $this->data['session']->USUARI_N_ID;

        $this->M_crud->sql($sql);
        redirect('servicios','refresh');   
               
          
    }
    public function actualizar($empresa,$sede,$id)
    {
        $sql = "Exec UBICACION_UPD "    . $empresa . ","
                                        . $sede . "," 
                                        . $id . ",'"  
                                        . $this->input->post('descripcion') . "'," 
                                        . $this->input->post('metro') ; 

                    
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('ubicaciones', 'refresh');       
    }  
    public function eliminar($empresa,$sede,$id)
    {
        $sql = "Exec UBICACION_DEL "     . $empresa .","
                                        . $sede . "," 
                                        . $id;
            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('ubicaciones', 'refresh');       
    }  
}
