<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sede extends CI_Controller {
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
        $this->data['sedes'] = $this->M_crud->read('sede', array(), ' SEDE_N_ID
        ,SEDE_C_DESCRIPCION
        ,SEDE_C_DIRECCION
        ,SEDE_C_ABREVIATURA');  
        $this->load->view('sede/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->load->view('sede/V_nuevo', $this->data);
    }
    public function editar($id)
    {  
        $this->data['sedes'] = $this->M_crud->read('sede',  array('SEDE_N_ID' => $id));  
        $sede = $this->M_crud->read('sede','', array('SEDE_N_ID' => $id));
        $this->data['sedes'] = $sedes[0];
        $this->load->view('sede/V_editar',$this->data);
    }
    public function crear(){
    
        $data = array(
                        'SEDE_C_DESCRIPCION'    =>  $this->input->post('descripcion'),
                        'SEDE_C_DIRECCION'      =>  $this->input->post('direccion'),
                        'SEDE_C_ABREVIATURA'    =>  $this->input->post('abreviatura'),
                        'SEDE_C_ESTADO'         =>  '0',
                        'SEDE_C_USUARIO_REG' 	=>  $this->data['session']->USUARI_N_ID,
					    'SEDE_D_FECHA_REG'		=>  date('Y-m-d H:i:s')
                    );
        $this->M_crud->create('sede',$data);
		redirect('sedes','refresh');   
    }
    public function actualizar($id)
    {
        $data = array(                        
                        'SEDE_C_DESCRIPCION'    =>  $this->input->post('descripcion'),
                        'SEDE_C_DIRECCION'      =>  $this->input->post('direccion'),
                        'SEDE_C_ABREVIATURA'    =>  $this->input->post('abreviatura'),
                        'UPDATE_USUARI_ID' 	    =>  $this->data['session']->USUARI_ID,
					    'UPDATE_DATE'			=>  date('Y-m-d H:i:s')
                    );
        $this->M_crud->update('sede', $data, array('SEDE_N_ID' => $id));      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('sedes', 'refresh');       
    }  


}