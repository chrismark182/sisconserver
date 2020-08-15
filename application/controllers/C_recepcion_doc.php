<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_recepcion_doc extends CI_Controller {
    var $data = array();

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')):
            $this->_init();
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
		           
		$this->load->view('recepcion_doc/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->_init();
        $this->data['clientes'] = $this->M_crud->sql("Exec CLIENTE_LIS {$this->data['empresa']->EMPRES_N_ID}, 0,'',''");
        $this->data['entidades'] = $this->M_crud->sql("Exec CLIENTE_ESCLIENTE_LIS {$this->data['empresa']->EMPRES_N_ID}, '1'");
        $this->data['tipo_documentos'] = $this->M_crud->sql("Exec TIPO_DOCUMENTO_RECIBIDO_LIS");
        
        $this->data['monedas'] = $this->M_crud->sql("Exec MONEDA_LIS");
        $this->load->view('recepcion_doc/V_nuevo', $this->data);        
	}
	public function editar($id)
	{
		$this->data["id"] = $id;
		$this->data['list_movimiento_edit'] = $this->M_crud->sql("Exec MOVIMIENTO_DOCUMENTO_EDIT_LIS  {$this->data['empresa']->EMPRES_N_ID},{$id}");
		$this->data['clientes'] = $this->M_crud->sql("Exec CLIENTE_LIS {$this->data['empresa']->EMPRES_N_ID}, 0,'',''");
        $this->data['entidades'] = $this->M_crud->sql("Exec CLIENTE_ESCLIENTE_LIS {$this->data['empresa']->EMPRES_N_ID}, '1'");
		$this->data['tipo_documentos'] = $this->M_crud->sql("Exec TIPO_DOCUMENTO_RECIBIDO_LIS");
		$this->load->view('recepcion_doc/V_editar', $this->data);
	}

	public function actualizar($empresa,$servicio)
    {
		$requiereos='0';
		$afectoigv='0';
		if($this->input->post('requiereos')=='on'):
		$requiereos='1';
		endif;
		if($this->input->post('afectoigv')=='on'):
			$afectoigv='1';
		endif;
		if(trim($this->input->post('descripcion')) != ''):
		$sql = "Exec SERVICIO_UPD "    . $empresa . ","
										. $servicio . ",'" 
										. $this->input->post('descripcion') . "','"
										.$requiereos. "','" 
										.$afectoigv. "',"
										. $this->data['session']->USUARI_N_ID;
										
					
		$this->M_crud->sql($sql);      
		$this->session->set_flashdata('message','Datos actualizados correctamente');
		redirect('servicios', 'refresh'); 
		
		else:
			$this->session->set_flashdata('message','No puede guardar en vacio');
			header("Location: editar");

		endif;
	} 

    public function reporte($id)
    {
        $sql= "Exec ALQUILER_LIS_REPORTE {$this->session->userdata('empresa_id')},{$id}";
        $result = $this->M_crud->sql($sql);
        ob_start();        
        require_once(APPPATH.'views/acuerdo/reporte/index.php');
        $html = ob_get_clean();
        $this->pdfgenerator->generate($html, "reporte.pdf");
	}
	
	public function eliminar($id)
    {
        $sql = "Exec MOVIMIENTO_DOCUMENTO_DEL {$this->data['empresa']->EMPRES_N_ID},{$id},{$this->data['session']->USUARI_N_ID}";    

        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('recepcion_doc', 'refresh');       
	}
	
	
}

