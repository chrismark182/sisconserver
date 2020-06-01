<?php
/**
 * Esandex Accesos.
 *
 * Libreria creada para el manejo y control de accesos para CodeIgniter Web Framework.
 *
 * @category    Libraries
 * @version     1.2
 *
 * Author:            José Luis Rodriguez - Esandex EIRL
 * Author URI:        http://esandex.com
 *
**/
defined('BASEPATH') OR exit('No direct script access allowed');
class EsandexAccesos
{
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('M_crud');
    }
    public function session()
    {
        $user = $this->CI->M_crud->read('usuario', array('USUARI_N_ID' =>  $this->CI->session->userdata('id')));
        return $user[0];
    }
    public function accesos()
    {
        $user = $this->CI->M_crud->read('usuario', array('USUARI_N_ID' =>  $this->CI->session->userdata('id')));
        $menus = $this->CI->M_crud->sql("Exec ACCESO_MENU ". $this->CI->session->userdata('id'));
        $menu = array();
        $menu['padres'] = array(); 
        $menu['hijos'] = array(); 
        
        foreach($menus as $row):
            if($row->MENU_PADRE_ID == 0):
                array_push($menu['padres'], $row);
            else: 
                array_push($menu['hijos'], $row);
            endif;
        endforeach;       
        
        return $menu;
    }
 

}

?>