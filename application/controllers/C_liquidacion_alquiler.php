<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_liquidacion_alquiler extends CI_Controller {
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
            $this->load->library('pdfgenerator');
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
        $clientes = "Exec  CLIENTE_ESCLIENTE_LIS 1,'1'";
        $this->data['clientes'] =$this->M_crud->sql($clientes);        
        $sedes = 'Exec SEDE_LIS 0,0';
        $this->data['sedes'] = $this->M_crud->sql($sedes);
        $this->load->view('liquidacion/alquiler/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->_init();
        $this->data['sedes'] = $this->M_crud->read('sede','SEDE_C_ESTADO = 1', array());
        $this->data['clientes'] = $this->M_crud->read('cliente','CLIENT_C_ESCLIENTE = 1 and CLIENT_C_ESTADO = 1', array());
        $this->data['servicios'] = $this->M_crud->read('servicio','SERVIC_C_REQUIERE_OS = 1 AND SERVIC_C_ESTADO = 1', array());
        $this->data['monedas'] = $this->M_crud->read('moneda', array());

        $this->load->view('liquidacion/alquiler/V_nuevo', $this->data);        
    }
    public function editar($empresa,$id)
    {  
        $sql = "Exec ORDEN_SERVICIO_LIS "    .$empresa . ","
                                            .$id;
         
        $ordenes = $this->M_crud->sql($sql);
        $this->data['ordenes'] = $ordenes[0];
        $this->load->view('ordenservicio/V_editar',$this->data);
    }
    //Reporte 
    public function reporte($id)
    {
        $sql= "Exec LIQUIDACION_SERVICIOS_LIS_REPORTE {$this->session->userdata('empresa_id')},{$id}";
        $result = $this->M_crud->sql($sql);
        $sql= "Exec LIQUIDACION_SERVICIOS_LIS_REPORTE_RESUMEN {$this->session->userdata('empresa_id')},{$id}";
        $result2 = $this->M_crud->sql($sql);
        ob_start();        
        require_once(APPPATH.'views/liquidacion/servicios/reporte/index.php');
        $html = ob_get_clean();
        $this->pdfgenerator->generate($html, "reporte.pdf");
    }
    
}

