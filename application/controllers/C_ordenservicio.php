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
            $this->load->library('pdfgenerator');   
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
        $clientes = "Exec  CLIENTE_ESCLIENTE_LIS 1,'1'";
        $sedes = 'Exec SEDE_LIS 0,0';
        $servicios = 'Exec SERVICIO_LIS_ORDEN_SERVICIO 0,0';   

        $this->data['clientes'] =$this->M_crud->sql($clientes);
        $this->data['sedes'] = $this->M_crud->sql($sedes);
        $this->data['servicios'] = $this->M_crud->sql($servicios);

        $this->load->view('ordenservicio/V_index', $this->data);
    }

    public function reporte($id)
    {
        $sql= "Exec ORDEN_SERVICIO_LIS_REPORTE {$this->session->userdata('empresa_id')},{$id}";
        $result = $this->M_crud->sql($sql);
        ob_start();        
        require_once(APPPATH.'views/ordenservicio/reporte/index.php');
        $html = ob_get_clean();
        $this->pdfgenerator->generate($html, "reporte.pdf");
    }

    public function nuevo()
    {
        $this->data['sedes'] = $this->M_crud->read('sede','SEDE_C_ESTADO = 1', array());
        $this->data['clientes'] = $this->M_crud->read('cliente','CLIENT_C_ESCLIENTE = 1 and CLIENT_C_ESTADO = 1', array());
        $this->data['servicios'] = $this->M_crud->read('servicio','SERVIC_C_REQUIERE_OS = 1 AND SERVIC_C_ESTADO = 1', array());
        $this->data['monedas'] = $this->M_crud->read('moneda', array());
        $this->load->view('ordenservicio/V_nuevo', $this->data);
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
                                       
        $ordenes = $this->M_crud->sql($sql);        
        $url = 'ordenes';
        redirect($url,'refresh');
    else:
        $this->session->set_flashdata('message','No puede guardar en vacio ');
        header("Location: nuevo");
    endif;
    }
    
    public function eliminar($empresa,$id)
    {
        $sql = "Exec ORDEN_SERVICIO_DEL "     . $empresa .","
                                        . $id.","
                                        . $this->data['session']->USUARI_N_ID; 
            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('ordenes', 'refresh');       
    }  
}

