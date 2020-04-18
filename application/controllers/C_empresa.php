<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_empresa extends CI_Controller {
	var $data = array();

	public function __construct()
    {
        parent::__construct();
		$this->load->model('M_crud');
		$this->_init();
		if($this->session->userdata('logged_in')):
			redirect(base_url().'dashboard','refresh');
        endif;
        
    }
	private function _init()
	{
		$this->output->set_template('simple');
	}
	
	public function index()
	{
        $empresa = $this->M_crud->read('empresa', array());
		if($empresa):
			redirect('login','refresh');   
		else:
			$this->load->view('empresa/index');
		endif;
    }
    public function crear()
    {           
        $data = array(
                        'EMPRES_C_RUC'            => $this->input->post('ruc'),
                        'EMPRES_C_RAZON_SOCIAL'   =>$this->input->post('razon_social')
					);
		$sql = "Exec EMPRESA_INS '".$this->input->post('ruc')."', '".$this->input->post('razon_social')."'";
        $this->M_crud->sql($sql);
        
		redirect('dashboard','refresh');   
    }
}
