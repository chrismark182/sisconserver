<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_api extends CI_Controller {

	var $data = array();

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')):
            $this->load->model('M_crud');
            $empresa = $this->M_crud->read('empresa', array('EMPRES_N_ID' => $this->session->userdata('empresa_id')));
            $this->data['empresa']=$empresa[0];           
		else:
			redirect(base_url(),'refresh');
		endif;
	}

    public function tarifa($empresa, $sede, $cliente, $servicio)
    {
        $sql = "Exec TARIFARIO_LIS_ORDEN_SERVICO "  .$empresa . ","
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

    public function ubicacion()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "Exec UBICACION_LIS {$data['empresa']},{$data['sede']}, {$data['ubicacion']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function tarifaValidar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec TARIFARIO_VALIDAR {$data['empresa']}, {$data['sede']},{$data['cliente']},{$data['servicio']},{$data['moneda']}";
        $query = $this->M_crud->sql($sql);
        $respons = array($sql, $query);
        echo json_encode($query, true);
    }

    public function clienteValidar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec CLIENTE_VAL {$data['empresa']} ,{$data['tdocumento']},'{$data['ndocumento']}'";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
    
    public function acuerdos_periodos()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec ALQUILER_DETALLE_LIS {$data['empresa']}, {$data['acuerdo']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
    public function acuerdos_periodos_guardar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec ALQUILER_DETALLE_INS {$data['empresa']}, {$data['acuerdo']}, {$data['area']}, {$data['precio']}, {$data['usuario']}";
        echo $sql;
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
    
    
}
