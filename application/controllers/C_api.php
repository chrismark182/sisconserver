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
        $query = $this->M_crud->sql("SELECT * FROM TARIFARIO Where EMPRES_N_ID = " . $empresa . "And SEDE_N_ID = ". $sede ."And CLIENT_N_ID = ". $cliente ." And SERVIC_N_ID = " . $servicio);
        echo json_encode($query[0], true);
    }
}
