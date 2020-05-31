<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_contacto extends CI_Controller {

	var $data = array();

	public function __construct()
    {
        parent::__construct();
		
		if($this->session->userdata('logged_in')):
            $this->load->library('EsandexAccesos');  
           
			$this->data['session'] = $this->esandexaccesos->session();
            $this->data['accesos'] = $this->esandexaccesos->accesos();
            $empresa = $this->M_crud->read('empresa', array('EMPRES_N_ID' => $this->session->userdata('empresa_id')));
            $this->data['empresa']=$empresa[0];
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
        $this->_init();
        $sql = "Exec CONTACTO_LIS 0,0,0";        
        $this->data['contactos'] = $this->M_crud->sql($sql); 
        $this->load->view('contacto/V_index', $this->data);
        
	}
	public function nuevo(){
        $this->_init();
        $this->data['tdocumentos'] = $this->M_crud->read('tipo_documento', array());
        $this->data['clientes'] = $this->M_crud->read('cliente', array());
		$this->load->view('contacto/V_nuevo',$this->data);
	
	}
	public function editar($empresa,$cliente,$contacto)
    {  
        $this->_init();
        $sql = "Exec CONTACTO_LIS "    .$empresa . ","
                                        .$cliente. ","
                                        .$contacto ;
                                        
        
         
        $this->data['tdocumentos'] = $this->M_crud->read('tipo_documento', array());
        $this->data['clientes'] = $this->M_crud->read('cliente', array());
        $contactos = $this->M_crud->sql($sql);
        $this->data['contacto'] = $contactos[0];
        $this->load->view('contacto/V_editar',$this->data);
    }
    public function crear(){
  
            $data = json_decode(file_get_contents('php://input'), true);
            $sql= "Exec CONTACTO_INS {$data['empresa']}, {$data['cliente']}, {$data['t_documento']}, '{$data['ndocumento']}', '{$data['nombres']}', {$data['usuario']}";
            //echo $sql;
            $query = $this->M_crud->sql($sql);
            echo json_encode($query, true);
          
    }
    public function actualizar($empresa,$cliente,$contacto)
    {

        if(
            trim($this->input->post('ndocumento')) != '' &&
            trim($this->input->post('nombres')) != ''
        ):

        $sql = "Exec CONTACTO_UPD "     . $empresa . ","
                                        . $cliente   . ","
                                        . $contacto . ",'"
                                        .$this->input->post('ndocumento') . "','" 
                                        .$this->input->post('nombres') . "'," 
                                       . $this->data['session']->USUARI_N_ID ;
                                        

        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('contactos', 'refresh'); 
       
        else:

            $this->session->set_flashdata('message','No puede guardar en vacio');
            header("Location: editar");
            //redirect('visita/'.$empresa.'/'.$visita.'/editar','refresh');
        endif;

    }  
    public function eliminar($empresa,$cliente,$contacto)
    {
        $sql = "Exec CONTACTO_DEL "     . $empresa .","
                                        . $cliente. ","
                                        . $contacto. ","
                                        . $this->data['session']->USUARI_N_ID ;
                                       
            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('contactos', 'refresh');       
    }  
}
