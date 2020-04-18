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
        $sql= "Exec SEDE_LIS 0,0" ;
        $this->data['sedes'] = $this->M_crud->sql($sql);  
        $this->load->view('sede/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->load->view('sede/V_nuevo', $this->data);
    }
    public function editar($id)
    {  
        $sedes = $this->M_crud->read('sede', array('SEDE_N_ID' => $id));
        $this->data['sede'] = $sedes[0];
        $this->load->view('sede/V_editar',$this->data);
    }
    public function crear(){
    
        $sql = "Exec SEDE_INS "     . $this->data['empresa']->EMPRES_N_ID . ",'"
                                    . $this->input->post('descripcion') . "','" 
                                    . $this->input->post('direccion') . "','" 
                                    . $this->input->post('abreviatura') . "', '0'," 
                                    . $this->data['session']->USUARI_N_ID;
                    
                                    echo $sql;
        $this->M_crud->sql($sql);
		redirect('sedes','refresh');   
    }
    public function actualizar($id)
    {
        $sql ="Exec SEDE_UPD"  $this->input->post('descripcion'),
                            $this->input->post('direccion'),
                          $this->input->post('abreviatura'),
                         $this->data['session']->USUARI_N_ID,
					      date('Y-m-d H:i:s')
                    );
        $this->M_crud->update($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('sedes', 'refresh');       
    }  
    public function eliminar($empresa, $sede)
    {
       $sql = "Exec SEDE_DEL "   .$empresa .","
                                .$sede;
        

        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('sedes', 'refresh');       
    }  


}