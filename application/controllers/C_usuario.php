<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_usuario extends CI_Controller {

	var $data = array();
	var $usuario = null;

	public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('logged_in')){
        	//Carga de librerias 
        	$this->load->library('EsandexMenus');  
            //Carga de modelos
            $this->load->model('M_crud');
            //Carga de datos del usuario logueado
			$this->usuario = $this->M_crud->sql("EXEC Usuario_Lis 'L', '0', '{$this->session->userdata('username')}', '%', '%'");
			$this->data['session'] = $this->usuario[0];
			//Lista de menus
			$menus = $this->M_crud->sql("EXEC Acceso_Menu {$this->data['session']->USUARI_ID}, {$this->data['session']->GRUPO_ID}, {$this->data['session']->USUARI_RESPETA_GRUPO}, {$this->data['session']->USUARI_ADMINISTRADOR}");			
			$this->esandexmenus->menus($menus);
			$this->data['menu_padres'] = $this->esandexmenus->getPadres();	
			$this->data['menu_hijos'] = $this->esandexmenus->getHijos();	
			//Nivel de acceso
			$uri = $this->uri->uri_string();
			$found = $this->esandexmenus->permission_level($uri, $this->data['menu_hijos']);
			$this->data['permission_level'] = $found['NIVEL'];
        }else{redirect('login');}
    }

	public function index()
	{
		if($this->data['permission_level'] != null): 
			//Variables de pagina
			$this->data['usuarios'] = $this->M_crud->sql("EXEC Usuario_Lis 'L', '0', '%', '%', '%'");
			$this->data['count_result'] = count($this->data['usuarios']);
			//Carga de vistas
			$this->load->view('master_top', $this->data);	
			$this->load->view('usuario/V_index');
			$this->load->view('master_bottom');
		else:
			$this->load->view('master_top', $this->data);
			$this->load->view('errors/html/error_403');
			$this->load->view('master_bottom');
		endif;
	}
	public function nuevo(){
		$this->data['grupos'] = $this->M_crud->sql("EXEC Grupo_Lis 'L', 0, '%'");
		//Carga de vistas
		$this->load->view('master_top', $this->data);
		$this->load->view('usuario/V_nuevo');
		$this->load->view('master_bottom');	
	}
	public function edit($id){
		//Variables de pagina
        $usuario = $this->M_crud->sql("EXEC Usuario_Lis 'L', $id, '%', '%', '%'");
        $this->data['grupos'] = $this->M_crud->sql("EXEC Grupo_Lis 'L', 0, '%'");
        $this->data['usuario'] = $usuario[0];
        $this->data['respeta_grupo'] = '';
        $this->data['administrador'] = '';
        if($usuario[0]->USUARI_RESPETA_GRUPO){ $this->data['respeta_grupo'] =  "checked"; }
        if($usuario[0]->USUARI_ADMINISTRADOR){ $this->data['administrador'] =  "checked"; }
		//Carga de vistas
		$this->load->view('master_top', $this->data);
		$this->load->view('usuario/V_editar');
		$this->load->view('master_bottom');	
	}
	public function ver($id){
		//Variables de pagina
        $usuario = $this->M_crud->sql("EXEC Usuario_Lis 'L',$id, '%', '%', '%'");
        $this->data['usuario'] = $usuario[0];
        $this->data['u_menus'] = $this->M_crud->sql("EXEC Usuario_Menu_Lis 'L', $id");
        $this->data['u_menus_faltantes'] = $this->M_crud->sql("EXEC Usuario_Menu_Lis 'F', $id");
		//Carga de vistas
		$this->load->view('master_top', $this->data);
		$this->load->view('usuario/V_ver');
		$this->load->view('master_bottom');	
	}
	public function delete($id){
		$this->M_crud->sql("EXEC Usuario_Del	$id,
												'{$this->session->userdata('id')}',
												'{$_SERVER['REMOTE_ADDR']}'
								        ");	       
        $this->session->set_flashdata('message', 'Usuario eliminado correctamente');    
    	redirect('usuarios', 'refresh');
	}
	public function crear(){
		$rg = '0';
		$adm = '0';
		//Validación
        $existe = $this->M_crud->sql("EXEC Usuario_Lis 'V', 0, '{$this->input->post('username')}', '%', '%'");
        if (!$existe) {
        	$pass = md5($this->input->post('password'));
        	if($this->input->post('respeta_grupo')){$rg = '1';}
        	if($this->input->post('administrador')){$adm = '1';}

			$this->M_crud->sql("EXEC Usuario_Ins 	'{$this->input->post('username')}',
													'{$pass}',
													'{$this->input->post('nombre')}',
													'{$this->input->post('apellido')}',
													'{$this->input->post('email')}',
													{$this->input->post('grupo_id')},
													'{$rg}',
													'{$adm}',
													'{$this->session->userdata('id')}',
													'{$_SERVER['REMOTE_ADDR']}'
												");	       
	        $this->session->set_flashdata('message', 'Usuario creado correctamente');    
        	redirect('usuarios', 'refresh');
        }else{
        	$this->session->set_flashdata('message', 'El nombre de usuario ya se encuentra uso');    
			redirect('usuario/nuevo', 'refresh');        	
        }
	}
	public function update($id){
		//$this->output->enable_profiler(TRUE);
		$rg = '0';
		$adm = '0';
		$pass = '';
		if($this->input->post('respeta_grupo')){$rg = '1';}
        if($this->input->post('administrador')){$adm = '1';}
		if($this->input->post('password')){$pass = md5($this->input->post('password'));}		
	   	$this->M_crud->sql("EXEC Usuario_Upd 	$id,
							        			'{$this->input->post('alias')}',
							        			'{$pass}',
							        			'{$this->input->post('nombre')}',
							        			'{$this->input->post('apellido')}',
							        			'{$this->input->post('email')}',
							        			{$this->input->post('grupo_id')},
							        			'{$rg}',
												'{$adm}',
								        		{$this->usuario[0]->USUARI_ID},
								        		'{$_SERVER['REMOTE_ADDR']}'
								        ");	    	   
        $this->session->set_flashdata('message', 'Usuario actualizado correctamente'); 
    	//$pagina_anterior=$_SERVER['HTTP_REFERER'];  
    	redirect('usuarios', 'refresh');    
	}
	public function add_menu(){
		$this->M_crud->sql("EXEC Usuario_Menu_Ins	{$_POST['usuario_id']},
												{$_POST['menu_id']},
												{$_POST['permiso']},
												{$this->usuario[0]->USUARI_ID},
								        		'{$_SERVER['REMOTE_ADDR']}'
								        ");	 
		echo "Menú agregado correctamente";
	}
	public function update_menu(){
		$this->M_crud->sql("EXEC Usuario_Menu_Upd	{$_POST['usuario_id']},
													{$_POST['menu_id']},
													{$_POST['permiso']},
													{$this->usuario[0]->USUARI_ID},
								        			'{$_SERVER['REMOTE_ADDR']}'
								        ");	 
	}
}
