<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ordenservicio extends CI_Controller {
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
        $sql = "Exec ORDEN_SERVICIO_LIS 0,0";
        $this->data['ordenes'] = $this->M_crud->sql($sql);        

        $this->load->view('ordenservicio/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->data['sedes'] = $this->M_crud->read('sede','SEDE_C_ESTADO = 1', array());
        $this->data['clientes'] = $this->M_crud->read('cliente','CLIENT_C_ESCLIENTE = 1 and CLIENT_C_ESTADO = 1', array());
        $this->data['servicios'] = $this->M_crud->read('servicio','SERVIC_C_REQUIERE_OS = 1 AND SERVIC_C_ESTADO = 1', array());
        $this->data['monedas'] = $this->M_crud->read('moneda', array());
        $this->load->view('ordenservicio/V_nuevo', $this->data);
        
    }
    public function editar($empresa,$id)
    {  
        $sql = "Exec ORDEN_SERVICIO_LIS "    .$empresa . ","
                                        .$id;
         
        $ordenes = $this->M_crud->sql($sql);
        $this->data['ordenes'] = $ordenes[0];
        $this->load->view('ordenservicio/V_editar',$this->data);
    }
    public function crear(){

        if( trim($this->input->post('sede')) != ''&&
            trim($this->input->post('cliente')) != ''&&
            trim($this->input->post('servicio')) != ''&&
            trim($this->input->post('horas')) != ''&&
            trim($this->input->post('tarifa')) != ''):

        $sql = "Exec ORDEN_SERVICIO_INS " . $this->data['empresa']->EMPRES_N_ID . ","
                                        . $this->input->post('sede') . "," 
                                        . $this->input->post('cliente') . "," 
                                        . $this->input->post('servicio') . ",'" 
                                        . $this->input->post('numerofisico') . "','" 
                                        . $this->input->post('solicitante') . "','" 
                                        . $this->input->post('codproyecto') . "'," 
                                        . $this->input->post('horas') . "," 
                                        . $this->input->post('tarifa') . "," 
                                        . $this->input->post('moneda') . "," 
                                        . $this->input->post('preciounitario') . "," 
                                        . $this->data['session']->USUARI_N_ID;
                                       

        $this->M_crud->sql($sql);
        redirect('ordenes','refresh');   
    else:
        $this->session->set_flashdata('message','No puede guardar en vacio ');
        header("Location: nuevo");
    endif;
    }
    public function actualizar($empresa,$id)
    {

        if( trim($this->input->post('descripcion')) != ''&&
            trim($this->input->post('metro')) != '' ):

        $sql = "Exec UBICACION_UPD "    . $empresa . ","
                                        . $sede . "," 
                                        . $id . ",'"  
                                        . $this->input->post('descripcion') . "'," 
                                        . $this->input->post('metro').","
                                        . $this->data['session']->USUARI_N_ID; 
            
                    
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('ordenes', 'refresh'); 
        
    else:
        $this->session->set_flashdata('message','No puede guardar en vacio ');
        header("Location: editar");    

    endif;
    }  
    public function eliminar($empresa,$sede,$id)
    {
        $sql = "Exec UBICACION_DEL "     . $empresa .","
                                        . $sede . "," 
                                        . $id.","
                                        . $this->data['session']->USUARI_N_ID; 
            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('ordenes', 'refresh');       
    }  
}

