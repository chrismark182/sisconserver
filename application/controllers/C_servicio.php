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
        
		$sql = "Exec SERVICIO_LIS 0,0";
        $this->data['servicios'] = $this->M_crud->sql($sql);  

		$this->load->view('servicio/V_index', $this->data);
	}
	public function nuevo(){
		
		$this->load->view('servicio/V_nuevo',$this->data);
	
	}
	public function editar($empresa,$servicio)
    {  

        $sql = "Exec SERVICIO_LIS "    .$empresa . ","
                                        .$servicio ;
                                        
        
         
        $servicios = $this->M_crud->sql($sql);
        $this->data['servicio'] = $servicios[0];
        $this->load->view('servicio/V_editar',$this->data);
    }
    public function crear(){

$requiereos='0';
$afectoigv='0';
if($this->input->post('requiereos')=='on'):
$requiereos='1';
endif;
if($this->input->post('afectoigv')=='on'):
    $afectoigv='1';
endif;

        if(trim($this->input->post('descripcion')) != ''):
            
		$sql = "Exec SERVICIO_INS "     . $this->data['empresa']->EMPRES_N_ID . ",'"
                                        . $this->input->post('descripcion') . "','"
                                        .$requiereos. "','"
                                        .$afectoigv. "',"
										. $this->data['session']->USUARI_N_ID;
            
            
        $this->M_crud->sql($sql);
        redirect('servicios','refresh');   

        else:

        $this->session->set_flashdata('message','No puede guardar en vacio');
        header("Location: nuevo");
        endif;       
          
    }
    public function actualizar($empresa,$servicio)
    {

$requiereos='0';
$afectoigv='0';
if($this->input->post('requiereos')=='on'):
$requiereos='1';
endif;
if($this->input->post('afectoigv')=='on'):
    $afectoigv='1';
endif;
        if(trim($this->input->post('descripcion')) != ''):
        $sql = "Exec SERVICIO_UPD "    . $empresa . ","
                                        . $servicio . ",'" 
                                        . $this->input->post('descripcion') . "','"
                                        .$requiereos. "','" 
                                        .$afectoigv. "',"
                                        . $this->data['session']->USUARI_N_ID;
                                        
                    
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('servicios', 'refresh'); 
        
        else:

            $this->session->set_flashdata('message','No puede guardar en vacio');
            header("Location: editar");

        endif;

    }  
    public function eliminar($empresa,$servicio)
    {
        $sql = "Exec SERVICIO_DEL "     . $empresa .","
                                        . $servicio.","
                                        .$this->data['session']->USUARI_N_ID;

            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('servicios', 'refresh');       
    }  
}
