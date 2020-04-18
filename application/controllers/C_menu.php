<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_menu extends CI_Controller {
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
        $sql = "Exec MENU_LIS ";
        $this->data['menus'] = $this->M_crud->sql($sql);  
        $this->load->view('menu/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->data['menus_padre'] = $this->M_crud->read('menu', array('MENU_PADRE_ID' => 0));  
        $this->load->view('menu/V_nuevo', $this->data);
    }
    public function editar($id)
    {  
        $this->data['menus_padre'] = $this->M_crud->read('menu', '', array('MENU_PADRE_ID' => 0));  
        $menus = $this->M_crud->read('menu','', array('MENU_ID' => $id));
        $this->data['menu'] = $menus[0];
        $this->load->view('menu/V_editar',$this->data);
    }
    public function crear()
    {
        $sql = "Exec MENU_INS '".$this->input->post('descripcion')."', '".$this->input->post('ruta')."', ".$this->input->post('mpadre').", ".$this->data['session']->USUARI_N_ID."";
        $this->M_crud->sql($sql);
		redirect('menus','refresh');   
    }
    public function actualizar($id)
    {
        $data = array(                        
                        'MENU_DESCRIPCION'      =>  $this->input->post('descripcion'),
                        'MENU_RUTA'             =>  $this->input->post('ruta'),
                        'MENU_PADRE_ID'         => $this->input->post('mpadre'),
                        'UPDATE_USUARI_ID' 	    =>  $this->data['session']->USUARI_ID,
					    'UPDATE_DATE'			=>  date('Y-m-d H:i:s')
                    );
        $this->M_crud->update('menu', $data, array('MENU_ID' => $id));      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('menus', 'refresh');       
    }  


}