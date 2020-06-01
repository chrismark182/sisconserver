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
            $users = $this->M_crud->sql("Exec USUARIO_LIS 0, 0,'', ''");
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
		$sql = "Exec USUARIO_LIS ".$this->input->post('empresa').", 0, '".$this->input->post('username')."', '".$pass."'";
		$existe = $this->M_crud->sql($sql);
		if($existe): 
			$existe = $existe[0];
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
		if($this->input->post('username') != '' && $this->input->post('password') != ''):
			$categoria = "Exec CATEGORIA_INS 'ADMINISTRADOR', 1";
			$this->M_crud->sql($categoria);		
			
			$usuario = "Exec USUARIO_INS '".$this->input->post('username')."','".md5($this->input->post('password'))."', 1, 1, 1"; 
			$this->M_crud->sql($usuario);
						
			$menu = "Exec MENU_INS 'Seguridad', '#', 0, 1";
			$this->M_crud->sql($menu);

			$menu = "Exec MENU_INS 'Usuarios', 'usuarios', 1, 1";
			$this->M_crud->sql($menu);

			$menu = "Exec MENU_INS 'Opciones del sistema', 'menus', 1, 1";
			$this->M_crud->sql($menu);

			$menu = "Exec MENU_INS 'Categorías', 'categorias', 1, 1";
			$this->M_crud->sql($menu);

			$menu = "Exec MENU_INS 'Mantenimientos', '#', 0, 1";
			$this->M_crud->sql($menu);

			$menu = "Exec MENU_INS 'Clientes', 'clientes', 5, 1";
			$this->M_crud->sql($menu);

			$menu = "Exec MENU_INS 'Sedes', 'sedes', 5, 1";
			$this->M_crud->sql($menu);
			
			$menu = "Exec MENU_INS 'Ubicaciones', 'ubicaciones', 5, 1";
			$this->M_crud->sql($menu);

			$menu = "Exec MENU_INS 'Servicios', 'servicios', 5, 1";
			$this->M_crud->sql($menu);

			$session = array(	'id'			=> '1',
								'username' 		=> $this->input->post('username'),
								'empresa_id'	=> '1',
								'logged_in'	=> TRUE	);
			$this->session->set_userdata($session);
		endif;
		redirect(base_url(),'refresh');
	}
}
