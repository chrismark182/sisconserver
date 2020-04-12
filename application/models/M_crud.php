<?php  if ( ! defined('BASEPATH')) exit();

class M_crud extends CI_Model
{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	/* Guardar */
	public function create($tabla,$datos){
		//$this->output->enable_profiler(TRUE);
		$rs = $this->db->insert($tabla, $datos);
		if ($rs) {
			//$r = $this->read($tabla, NULL,  array($tabla.'_id' => $this->db->insert_id()));
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
	}
	/*
	 *
	 */
	public function read($tabla, $datos, $orden = ''){
		$this->output->enable_profiler(TRUE);
		$this->db->select('*');
		$this->db->from($tabla);
		$this->db->where($datos);
		$this->db->order_by($orden);
		$query = $this->db->get();
		$rs = $query->result();
		
		if ($rs) {
			return $rs;
		}else{
			return FALSE;
		}
	}
	/*
	 *
	 */
	public function update($tabla, $datos, $donde){
		//$this->output->enable_profiler(TRUE);
		$this->db->where($donde);
		if ($this->db->update($tabla, $datos)) {

			$r = $this->read($tabla, $donde);
			return $r[0];
		}else{
			return FALSE;
		}
	}


	public function delete($tabla, $datos){
		//$this->output->enable_profiler(TRUE);
		$rs = $this->read($tabla, NULL, $datos);

		if ($rs) {
			$this->db->where($datos);

			if ($this->db->delete($tabla)) {
				return $rs;
			}else{
				return FALSE;
			}

		}else{
			return FALSE;
		}
	}
	public function sql($sql){
		$query = $this->db->query($sql);
		return $query->result();
	}

}
