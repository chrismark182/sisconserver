<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_acuerdo extends CI_Controller {
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
        $this->load->view('acuerdo/V_index', $this->data);
    }
    public function nuevo()
    {
        $id = $this->M_crud->sql("Select isnull(max(ALQUIL_N_ID),0) + 1 As ID From ALQUILER Where EMPRES_N_ID = {$this->data['empresa']->EMPRES_N_ID}");
        $this->data['nextId'] = $id[0]->ID;
        $this->data['clientes'] = $this->M_crud->sql("Exec CLIENTE_ESCLIENTE_LIS {$this->data['empresa']->EMPRES_N_ID}, '1'");
        $this->data['sedes'] = $this->M_crud->sql("Exec SEDE_LIS {$this->data['empresa']->EMPRES_N_ID}, 0");
        $this->data['monedas'] = $this->M_crud->sql("Exec MONEDA_LIS");
        $this->load->view('acuerdo/V_nuevo', $this->data);        
    }
    public function editar($empresa,$cliente)
    {  
        
        $sql = "Exec CLIENTE_LIS2 "  .$empresa. ","
                                    .$cliente ;
        
        $this->data['tdocumentos'] = $this->M_crud->read('tipo_documento', array());
        $clientes = $this->M_crud->sql($sql);
        $this->data['cliente'] = $clientes[0];
       
        $this->load->view('cliente/V_editar',$this->data);
    }
    public function crear()
    {
        $sql = "Exec CLIENTE_INS "      . $this->data['empresa']->EMPRES_N_ID . ","
                                        . $this->input->post('tdocumento') . ",'" 
                                        . $this->input->post('ndocumento') . "','" 
                                        . $this->input->post('razon_social') . "','" 
                                        . $this->input->post('direccion') . "','" 
                                        . $esclient . "','"
                                        . $esproveedor . "','"
                                        . $estransportista . "','"
                                        . $ordencompra . "',"
                                        . $this->data['session']->USUARI_N_ID ;
        $this->M_crud->sql($sql);
        redirect('acuerdos','refresh');   
    }
    public function actualizar($empresa,$cliente)
    {
        $sql = "Exec CLIENTE_UPD "      . $empresa. ","
                                        . $cliente. ",'" 
                                        . $this->input->post('t_documento')."','"
                                        . $this->input->post('ndocumento') . "','" 
                                        . $this->input->post('razon_social') ."','"
                                        . $this->input->post('direccion')."','"
                                        . $esclient . "','"
                                        . $esproveedor . "','"
                                        . $estransportista . "','"
                                        . $ordencompra . "',"
                                        .$this->data['session']->USUARI_N_ID ; 
        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        $url = 'clientes?n=' . $this->input->post('ndocumento');
        redirect($url, 'refresh');     
    }
    public function eliminar($empresa,$cliente)
    {

        $sql = "Exec CLIENTE_DEL "     . $empresa .","
                                        . $cliente.","
                                        .$this->data['session']->USUARI_N_ID ; 
                                        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('clientes', 'refresh');       
    }  


}

