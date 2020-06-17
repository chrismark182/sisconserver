<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_acuerdo extends CI_Controller {
    var $data = array();

    public function __construct()
    {
        parent::__construct();
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
    //Vistas
    public function index() 
	{              
        $this->_init();
        $this->load->view('acuerdo/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->_init();
        $id = $this->M_crud->sql("Select isnull(max(ALQUIL_N_ID),0) + 1 As ID From ALQUILER Where EMPRES_N_ID = {$this->data['empresa']->EMPRES_N_ID}");
        $this->data['nextId'] = $id[0]->ID;
        $this->data['clientes'] = $this->M_crud->sql("Exec CLIENTE_ESCLIENTE_LIS {$this->data['empresa']->EMPRES_N_ID}, '1'");
        $this->data['sedes'] = $this->M_crud->sql("Exec SEDE_LIS {$this->data['empresa']->EMPRES_N_ID}, 0");
        $this->data['monedas'] = $this->M_crud->sql("Exec MONEDA_LIS");
        $this->load->view('acuerdo/V_nuevo', $this->data);        
    }
    //Procesos
    public function buscar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec ALQUILER_LIS {$data['empresa']}, {$data['acuerdo']}, '{$data['cliente']}', '{$data['sede']}', '{$data['fecha_desde']}', '{$data['fecha_hasta']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
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
        $facturable = '0';
        if($this->input->post('facturable') == 'on'):
            $facturable = '1';
        endif;
        $sql = "Exec ALQUILER_INS   {$this->data['empresa']->EMPRES_N_ID}, 
                                    {$this->input->post('sede')}, 
                                    {$this->input->post('ubicacion')},
                                    {$this->input->post('cliente')}, 
                                    '{$facturable}',
                                    '{$this->input->post('fecha_inicio')}', 
                                    '{$this->input->post('fecha_termino')}', 
                                    {$this->input->post('area')}, 
                                    '{$this->input->post('observaciones')}', 
                                    {$this->input->post('moneda')}, 
                                    {$this->input->post('precio')}, 
                                    {$this->data['session']->USUARI_N_ID}";
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
    public function eliminar($empresa,$acuerdo)
    {

        $sql = "Exec ALQUILER_DEL "     . $empresa .","
                                        . $acuerdo; 
                                      /*   .","
                                        .$this->data['session']->USUARI_N_ID ;  */
                                        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('acuerdos', 'refresh');       
    }  
    public function cerrar($empresa,$acuerdo)
    {

        $sql = "Exec ALQUILER_CERRAR "      . $empresa .","
                                            . $acuerdo; 
                                      /*   .","
                                        .$this->data['session']->USUARI_N_ID ;  */
                                        
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Registro cerrado correctamente');
        redirect('acuerdos', 'refresh');       
    }  


}

