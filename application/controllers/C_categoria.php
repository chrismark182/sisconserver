<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_categoria extends CI_Controller {
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
        $sql= "Exec CATEGORIA_LIS 0" ;
        $this->data['results'] = $this->M_crud->sql($sql);  
        $this->load->view('categoria/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->load->view('categoria/V_nuevo', $this->data);
    }
    public function crear(){
    
        $sql = "Exec CATEGORIA_INS '"   . $this->input->post('descripcion') . "',"                                    
                                        . $this->data['session']->USUARI_N_ID;                    

        $this->M_crud->sql($sql);
		redirect('categorias','refresh');   
    }
    public function editar($empresa,$sede)
    {  
        $sql = "Exec SEDE_LIS "     .$empresa. ","
                                    .$sede ;

        $sedes = $this->M_crud->sql($sql);
        $this->data['sede'] = $sedes[0];
        $this->load->view('sede/V_editar',$this->data);
    }
    
    public function actualizar($empresa,$id)
    {
        $sql = "Exec SEDE_UPD "  .$empresa. ","
                                .$id. ",'"
                                .$this->input->post('descripcion'). "','"
                                .$this->input->post('direccion')."','"
                                .$this->input->post('abreviatura')."'";
                                

        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('sedes', 'refresh');       
    }  
    public function eliminar($empresa, $id)
    {
       $sql = "Exec SEDE_DEL "   .$empresa.","
                                .$id;
        

        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('sedes', 'refresh');       
    }  


}