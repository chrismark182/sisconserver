<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_home extends CI_Controller {
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
		$empresa = $this->M_crud->sql('Exec EMPRESA_LIS 0');
		if($empresa):
			redirect('login','refresh');   
		else:
			$this->load->view('empresa/index');
		endif; 
    }
}
