<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_api extends CI_Controller {

	var $data = array();

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')):
            $this->load->model('M_crud');
            $empresa = $this->M_crud->read('empresa', array('EMPRES_N_ID' => $this->session->userdata('id')));
            $this->data['empresa']=$empresa[0];           
		else:
			redirect(base_url(),'refresh');
		endif;
	}

    public function tarifa($empresa, $sede, $cliente, $servicio)
    {
        $sql = "Exec TARIFARIO_LIS_ORDEN_SERVICO " .$empresa . ","
                                        .$sede . ","
                                        .$cliente . ","
                                        .$servicio;
        $query = $this->M_crud->sql($sql);
        echo json_encode($query[0], true);
    }
    public function clientes()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "Exec CLIENTE_LIS 0,0, '{$data['numero_documento']}%', '{$data['razon_social']}%'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
}
