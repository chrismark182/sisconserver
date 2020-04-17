<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cliente extends CI_Controller {
    var $data = array();

    public function __construct()
    {
        parent::__construct();
		$this->_init();
		if($this->session->userdata('logged_in')):
			$this->load->library('EsandexAccesos');  
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
            $empresa = $this->M_crud->read('empresa', array());
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
        $sql = "Exec CLIENTE_LIS 0,0" 
                                    
        ;
        $this->data['clientes'] = $this->M_crud->sql($sql);
        $this->load->view('cliente/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->data['tdocumentos'] = $this->M_crud->read('tipo_documento', array());
        $this->load->view('cliente/V_nuevo', $this->data);
        
    }
    public function editar($empresa,$cliente)
    {  
        $sql = "Exec CLIENTE_LIS "    .$empresa . ","
                                        .$cliente ;
        
         
        $ubicaciones = $this->M_crud->sql($sql);
        $this->data['cliente'] = $clientes[0];
        $this->load->view('cliente/V_editar',$this->data);
    }
    public function crear(){

        $sql = "Exec CLIENTE_INS "      . $this->data['empresa']->EMPRES_N_ID . ","
                                        . $this->input->post('t_documento') . ",'" 
                                        . $this->input->post('ndocumento') . "','" 
                                        . $this->input->post('razon_social') . "','" 
                                        . $this->input->post('direccion') . "', '0','0','0','0','0','0'," 
                                        . $this->data['session']->USUARI_N_ID ;

        $this->M_crud->sql($sql);
        redirect('clientes','refresh');   
               
          
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

