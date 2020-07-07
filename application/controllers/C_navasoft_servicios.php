<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_navasoft_servicios extends CI_Controller {
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
    //Vistas
    public function index() 
	{         
        $this->_init();

        $clientes = "Exec  CLIENTE_ESCLIENTE_LIS 1,'1'";
        $this->data['clientes'] =$this->M_crud->sql($clientes);
        
        $sedes = 'Exec SEDE_LIS 0,0';
        $this->data['sedes'] = $this->M_crud->sql($sedes);

        $this->load->view('navasoft/servicios/V_index', $this->data);
    }

    //Procesos
    public function buscar()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = "Exec LIQUIDACION_NAVASOFT_LIS {$data['empresa']}, '{$data['desde']}', '{$data['hasta']}', {$data['cliente']}, {$data['sede']}, '{$data['tipo']}', {$data['liquidacion']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }

    public function generar_dbf()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        // $sql = "Exec LIQUIDACIONES_LIS_PARANAVASOFT 1, {$data['empresa']}, {$data['liquidacion']}, {$data['usuario']}";

        // $resultSet = $this->M_crud->sql($sql);
        
        // $cabecera = array(
        //                 'numerodocu'    => $resultSet[0]['NUMERODOCU'], 
        //                 'guiahija'      => $resultSet[0]['GUIAHIJA'], 
        //                 'peso'          => $resultSet[0]['PESO'],
        //                 'bultos'        => $resultSet[0]['BULTOS'],
        //                 'manifiesto'    => $resultSet[0]['MANIFIESTO'],
        //                 'numseriado'    => $resultSet[0]['NUMSERIADO'],
        //                 'idtipodocu'    => $resultSet[0]['IDTIPODOCU'],
        //                 'fecemision'    => $resultSet[0]['FECEMISION'],
        //                 'idmoneda'      => $resultSet[0]['IDMONEDA'],
        //                 'idcliente'     => $resultSet[0]['IDCLIENTE'],
        //                 'idaduana'      => $resultSet[0]['IDADUANA'],
        //                 'numcheque'     => $resultSet[0]['NUMCHEQUE'],
        //                 'idbancoseg'    => $resultSet[0]['IDBANCOSEG'],
        //                 'conversion'    => $resultSet[0]['CONVERSION'],
        //                 'montoafect'    => $resultSet[0]['MONTOAFECT'],
        //                 'montoexone'    => $resultSet[0]['MONTOEXONE'],
        //                 'montoigv'      => $resultSet[0]['MONTOIGV'],
        //                 'total'         => $resultSet[0]['TOTAL'],
        //                 'usuario'       => $resultSet[0]['USUARIO'],
        //                 'status'        => $resultSet[0]['STATUSS'],
        //                 'flag'          => $resultSet[0]['FLAG'],
        //                 'fectra'        => $resultSet[0]['FECTRA'],
        //                 'iddespacha'    => $resultSet[0]['IDDESPACHA'],
        //                 'tipocambio'    => $resultSet[0]['TIPOCAMBIO'],
        //                 'guiaremisi'    => $resultSet[0]['GUIAREMISI'],
        //                 'observacio'    => $resultSet[0]['OBSERVACIO'],
        //                 'numdoc'        => $resultSet[0]['NUMDOC'],
        //                 'seriedoc'      => $resultSet[0]['SERIEDOC'],
        //                 'fechadoc'      => $resultSet[0]['FECHADOC'],
        //                 'impexp'        => $resultSet[0]['IMPEXP'],
        //                 'facespecie'    => $resultSet[0]['FACESPECIE'],
        //                 'contenido'     => $resultSet[0]['CONTENIDO'],
        //                 'idtipdocnc'    => $resultSet[0]['IDT'],
        //                 'facturadoa'    => $resultSet[0]['FACTURADOA'],
        //                 'tipopago'      => $resultSet[0]['TIPOPAGO'],
        //                 'idagenciac'    => $resultSet[0]['IDAGENCIAC'],
        //                 'feccalculo'    => $resultSet[0]['FECCALCULO'],
        //                 'diasestadi'    => $resultSet[0]['DIASESTADI'],
        //                 'numvolante'    => $resultSet[0]['NUMVOLANTE'],
        //                 'posicion'      => $resultSet[0]['POSICION'],
        //                 'dua'           => $resultSet[0]['DUA'],
        //                 'fecllegada'    => $resultSet[0]['FECLLEGADA'],
        //                 'nomdespach'    => $resultSet[0]['NOMDESPACH'],
        //                 'codd'          => $resultSet[0]['CODD'],
        //                 'nrod'          => $resultSet[0]['NROD'],
        //                 'origen'        => $resultSet[0]['ORIGEN']
        //             );
        // $result = (object) null;
        
        
        // $this->m_dbf->create('docterminal', $cabecera, 0);



        $sql= "Exec LIQUIDACION_UPD_NAVASOFT {$data['empresa']}, {$data['liquidacion']}, {$data['usuario']}";
        $query = $this->M_crud->sql($sql);
        echo json_encode($query, true);
    }
}

