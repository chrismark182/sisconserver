<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ordenservicio extends CI_Controller {
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

    public function index() 
	{    
        $this->_init();     
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
        $this->_init();
        $this->data['sedes'] = $this->M_crud->read('sede','SEDE_C_ESTADO = 1', array());
        $this->data['clientes'] = $this->M_crud->read('cliente','CLIENT_C_ESCLIENTE = 1 and CLIENT_C_ESTADO = 1', array());
        $this->data['servicios'] = $this->M_crud->read('servicio','SERVIC_C_REQUIERE_OS = 1 AND SERVIC_C_ESTADO = 1', array());
        $this->data['monedas'] = $this->M_crud->read('moneda', array());
        $this->load->view('ordenservicio/V_nuevo', $this->data);
    }

    public function crear(){
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec ORDEN_SERVICIO_INS {$data['empresa']}, {$data['sede']}, {$data['cliente']}, {$data['servicio']}, '{$data['numerofisico']}', '{$data['solicitante']}', '{$data['codproyecto']}', {$data['horas']}, {$data['tarifa']}, {$data['moneda']}, {$data['preciounitario']}, {$data['usuario']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
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

