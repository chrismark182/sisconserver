<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_categoria extends CI_Controller {
    var $data = array();

    public function __construct()
    {
        parent::__construct();
		$this->_init();
		if($this->session->userdata('logged_in')):
			$this->load->library('EsandexAccesos');  
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
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
        $sql= "Exec CATEGORIA_LIS 0" ;
        $this->data['results'] = $this->M_crud->sql($sql);  
        $this->load->view('categoria/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->load->view('categoria/V_nuevo', $this->data);
    }
    public function crear(){
    
        if($this->input->post('descripcion') != ''):
            $sql = "Exec CATEGORIA_INS '"   . $this->input->post('descripcion') . "'," 
                                            . $this->data['session']->USUARI_N_ID;
            $this->M_crud->sql($sql);
            $this->session->set_flashdata('message','Registro creado correctamente');
            redirect('categorias','refresh');   
        else: 
            $this->session->set_flashdata('message','No puede guardar en vacio');
            redirect('categoria/nuevo','refresh');   
        endif;
    }
    public function editar($id)
    {  
        $sql = "Exec CATEGORIA_LIS " .$id;
        $categorias = $this->M_crud->sql($sql);
        $this->data['categoria'] = $categorias[0];
        $this->load->view('categoria/V_editar',$this->data);
    }
    
    public function actualizar($id)
    {
        if($this->input->post('descripcion') != ''):
            $sql = "Exec CATEGORIA_UPD  {$id},
                                        '{$this->input->post('descripcion')}',
                                        '{$this->session->userdata('id')}'";
            echo $sql;
            $this->M_crud->sql($sql);      
            $this->session->set_flashdata('message','Datos actualizados correctamente');
            redirect('categorias', 'refresh');       
        else: 
            $this->session->set_flashdata('message','No puede guardar en vacio');
            redirect('categoria/'.$id.'/editar','refresh');   
        endif;
    }  
    public function eliminar($id)
    {
       $sql = "Exec CATEGORIA_DEL {$id}";        

        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('categorias', 'refresh');       
    }  


}