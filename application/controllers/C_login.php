<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

	var $data = array();

    public function __construct()
    {
        parent::__construct();
		$this->_init();
		$this->load->model('M_crud');
    }
    private function _init()
	{
		$this->output->set_template('siscon');
    }
    
    public function index()
    {
		$empresas = $this->M_crud->sql('Exec EMPRESA_LIS 0');
		if($empresas):
			$this->data['empresas'] = $empresas;
            $users = $this->M_crud->sql("Exec USUARIO_LIS 0, '', ''");
            if($users):
                $this->load->view('login/V_index', $this->data);                
            else:
                $this->load->view('login/V_create', $this->data);
            endif;
        else:
            redirect('dashboard','refresh');
        endif;
    }
	public function userpass(){
		$pass = md5($this->input->post('password'));
		$sql = "Exec USUARIO_LIS ".$this->input->post('empresa').",'".$this->input->post('username')."', '".$pass."'";
		$existe = $this->M_crud->sql($sql);
		$existe = $existe[0];
		 if($existe): 
			$session = array(	'id'			=> $existe->USUARI_N_ID,
								'username' 		=> $existe->USUARI_C_USERNAME,
								'empresa_id'	=> $existe->EMPRES_N_ID,
								'logged_in'	=> TRUE	);
			$this->session->set_userdata($session);
			redirect(base_url(),'refresh');
		else:
			$this->session->set_flashdata('error','Usuario o contraseña erroneos');				 
			redirect(base_url().'login', 'refresh');
		 endif; 			
 	}
	public function logout()
    {
        $session = array('logged_in' => FALSE);
		$this->session->set_userdata($session);
        redirect(base_url(), 'refresh');
    }
	public function create()
	{
		$rol = array(
						'CATEGO_N_ID' 				=> 1,
						'CATEGO_C_DESCRIPCION' 		=> 'ADMINISTRADOR',
					  	'REGISTER_USUARI_N_ID' 	=> 1, 
					  	'UPDATE_USUARI_N_ID' 		=> 1,
					  	'UPDATE_DATE'			=> date('Y-m-d H:i:s')
					);
		$this->M_crud->create('CATEGORIA', $rol);		

		
		$data = array('USUARI_C_USERNAME' 		=> $this->input->post('username'),
					  'USUARI_C_PASSWORD' 		=> md5($this->input->post('password')),
					  'CATEGO_N_ID'				=> 1,
					  'REGISTER_USUARI_N_ID' 	=> 1, 
					  'REGISTER_DATE'			=> date('Y-m-d H:i:s'),
					  'UPDATE_USUARI_N_ID' 		=> 1,
					  'UPDATE_DATE'				=> date('Y-m-d H:i:s')
					);
					$this->M_crud->create('usuario', $data);
					
		$data = array(	'MENU_DESCRIPCION' 		=> 'Mantenimientos',
						'MENU_RUTA'				=> '#',
                        'MENU_TIPO'				=> 1,
                        'MENU_PADRE_ID'			=> 0,
						'MENU_ESTADO' 	        => 1, 
						'REGISTER_USUARI_N_ID' 	=> 1, 
						'REGISTER_DATE'			=> date('Y-m-d H:i:s'),
						'UPDATE_USUARI_N_ID' 		=> 1,
						'UPDATE_DATE'				=> date('Y-m-d H:i:s')
					);
		$this->M_crud->create('MENU', $data);

		$data = array(	'MENU_DESCRIPCION' 		=> 'Menus',
						'MENU_RUTA'				=> 'menus',
						'MENU_TIPO'				=> 2,
						'MENU_PADRE_ID'			=> 1,
						'MENU_ESTADO' 			=> 1, 
						'REGISTER_USUARI_N_ID' 	=> 1, 
						'REGISTER_DATE'			=> date('Y-m-d H:i:s'),
						'UPDATE_USUARI_N_ID' 		=> 1,
						'UPDATE_DATE'				=> date('Y-m-d H:i:s')
					);
		$this->M_crud->create('MENU', $data);

		$session = array(	'id'		=> '1',
							'username' 	=> $this->input->post('username'),
							'logged_in'	=> TRUE	);
		$this->session->set_userdata($session);
		redirect(base_url(),'refresh');
	}
}
