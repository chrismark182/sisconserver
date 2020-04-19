<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ubicacion extends CI_Controller {
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
        $sql = "Exec UBICACION_LIS 0,0,0";
        $this->data['ubicaciones'] = $this->M_crud->sql($sql);
        

        $this->load->view('ubicacion/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->data['sedes'] = $this->M_crud->read('sede', array());
        $this->data['talmacenes'] = $this->M_crud->read('tipo_almacen', array());
        $this->load->view('ubicacion/V_nuevo', $this->data);
        
    }
    public function editar($empresa,$sede,$id)
    {  
        $sql = "Exec UBICACION_LIS "    .$empresa . ","
                                        .$sede . ","
                                        .$id;
        
         
        $ubicaciones = $this->M_crud->sql($sql);
        $this->data['ubicacion'] = $ubicaciones[0];
        $this->load->view('ubicacion/V_editar',$this->data);
    }
    public function crear(){

        if($this->input->post('sede') != ''&&
            $this->input->post('talmacen') != ''&&
            $this->input->post('descripcion') != ''&&
            $this->input->post('metro') != ''):

        $sql = "Exec UBICACION_INS "    . $this->data['empresa']->EMPRES_N_ID . ","
                                        . $this->input->post('sede') . "," 
                                        . $this->input->post('talmacen') . ",'" 
                                        . $this->input->post('descripcion') . "','" 
                                        . $this->input->post('metro') . "','0'," 
                                        . $this->data['session']->USUARI_N_ID;
                                        echo $sql;

        $this->M_crud->sql($sql);
        redirect('ubicaciones','refresh');   
    else:
        $this->session->set_flashdata('message','No puede guardar en vacio');
        header("Location: nuevo");
       

    endif;
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

