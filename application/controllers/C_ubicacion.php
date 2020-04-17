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
        $this->data['ubicaciones'] = $this->M_crud->sql('SELECT  s.SEDE_C_DESCRIPCION, u.UBICAC_N_ID , t.TIPALM_C_DESCRIPCION,
         u.UBICAC_C_DESCRIPCION , u.UBICAC_N_M2 FROM UBICACION u
        INNER JOIN  SEDE S ON
        u.SEDE_N_ID = s.SEDE_N_ID 
        inner join TIPO_ALMACEN t on
        u.TIPALM_N_ID = t.TIPALM_N_ID'
    );  
        
        $this->load->view('ubicacion/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->data['sedes'] = $this->M_crud->read('sede', array());
        $this->data['talmacenes'] = $this->M_crud->read('tipo_almacen', array());
        $this->load->view('ubicacion/V_nuevo', $this->data);
        
    }
    public function editar($id)
    {  
        $sedes = $this->M_crud->read('ubicacion', array('UBICAC_N_ID' => $id));
        $this->data['ubicacion'] = $ubicaciones[0];
        $this->load->view('ubicacion/V_editar',$this->data);
    }
    public function crear(){

        $sql = "Exec UBICACION_INS "    . $this->data['empresa']->EMPRES_N_ID . ","
                                        . $this->input->post('sede') . "," 
                                        . $this->input->post('talmacen') . ",'" 
                                        . $this->input->post('descripcion') . "','" 
                                        . $this->input->post('metro') . "', '0'," 
                                        . $this->data['session']->USUARI_N_ID;

        $this->M_crud->sql($sql);
        redirect('ubicaciones','refresh');   
               
          
    }
    public function actualizar($id)
    {
        $data = array(                        
                        'TIPALM_N_ID'           =>  $this->input->post('talmacen'),
                        'UBICAC_C_DESCRIPCION'  =>  $this->input->post('descripcion'),
                        'UBICAC_C_M2'           =>  $this->input->post('metro'),
                        'UBICAC_C_USUARIO_REG' 	=>  $this->data['session']->USUARI_N_ID,
					    'UBICAC_D_FECHA_REG'	=>  date('Y-m-d H:i:s')
                    );
        $this->M_crud->update('ubicacion', $data, array('UBICAC_N_ID' => $id));      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('ubicaciones', 'refresh');       
    }  
    public function eliminar($id)
    {
        $data = array(
            'UBICAC_N_ID' => $id
        );
        $this->M_crud->delete('ubicacion', $data);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('ubicaciones', 'refresh');       
    }  


}

