<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ubicacion extends CI_Controller {
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
        $sql = "Exec UBICACION_LIS 0,0,0";
        $this->data['ubicaciones'] = $this->M_crud->sql($sql);
        

        $this->load->view('ubicacion/V_index', $this->data);
    }
    public function nuevo()
    {
        $this->_init();
        $sede = "Exec SEDE_LIS 0,0";
        $this->data['sedes'] = $this->M_crud->sql($sede);
        $this->data['talmacenes'] = $this->M_crud->read('tipo_almacen', array());
        $this->load->view('ubicacion/V_nuevo', $this->data);
        
    }
    public function editar($empresa,$sede,$id)
    {  
        $this->_init();
        $sql = "Exec UBICACION_LIS "    .$empresa . ","
                                        .$sede . ","
                                        .$id;

        $this->data['sedes'] = $this->M_crud->read('sede', array());
        $this->data['talmacenes'] = $this->M_crud->read('tipo_almacen', array());
        $ubicaciones = $this->M_crud->sql($sql);
        $this->data['ubicacion'] = $ubicaciones[0];
        $this->load->view('ubicacion/V_editar',$this->data);
    }
    public function crear(){

        $data = json_decode(file_get_contents('php://input'), true);
        $sql= "Exec UBICACION_INS {$data['empresa']}, {$data['sede']}, {$data['talmacen']}, '{$data['descripcion']}', {$data['metro']}, {$data['usuario']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);

    }
    public function actualizar($empresa,$sede,$id)
    {

        if( trim($this->input->post('descripcion')) != ''&&
            trim($this->input->post('metro')) != '' ):

        $sql = "Exec UBICACION_UPD "    . $empresa . ","
                                        . $sede . "," 
                                        . $id . ",'"  
                                        . $this->input->post('descripcion') . "'," 
                                        . $this->input->post('metro').","
                                        . $this->data['session']->USUARI_N_ID; 
            
                    
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos actualizados correctamente');
        redirect('ubicaciones', 'refresh'); 
        
    else:
        $this->session->set_flashdata('message','No puede guardar en vacio ');
        header("Location: editar");    

    endif;
    }  
    public function eliminar($empresa,$sede,$id)
    {
        $sql = "Exec UBICACION_DEL "     . $empresa .","
                                        . $sede . "," 
                                        . $id.","
                                        . $this->data['session']->USUARI_N_ID; 
            
        $this->M_crud->sql($sql);      
        $this->session->set_flashdata('message','Datos eliminados correctamente');
        redirect('ubicaciones', 'refresh');       
    }  


}

