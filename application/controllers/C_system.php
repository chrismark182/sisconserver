<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_system extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('git');
        $this->load->library('EsxProcess');        
	}

    public function sync()
    {
        //$repo = Git::open(dirname(__FILE__) . '../../../');
        $repo = Git::open('./');
      
        $repo->run('fetch origin');
        $repo->run('pull origin master');           
        $message = 'Se actualizó el sistema correctamente';
           
        $jsonMessage = json_encode(array('message' => $message), JSON_FORCE_OBJECT);
        echo $jsonMessage;
    }
    public function log()
    {
        $repo = Git::open('./');
        $mystring = $repo->run("log -1 --date=iso");
        $mystring = trim($mystring); 
        $findme = "Date";
        $pos = strpos($mystring, $findme);
        $originalDate = substr($mystring, ((int)$pos + 6), 27);
        $newDate = date("Y.m.d.H.i.s", strtotime($originalDate));
        echo 'v'.$newDate;

    }
    public function revisar()
    {
        $repo = Git::open('./');
        $repo->run('fetch origin');
        $mystring = $repo->run('status');
        $findme = "git pull";
        $pos = strpos($mystring, $findme);
        $result = array();
        $action = 0;
        if ($pos === false):
            $message = 'Sistema actualizado';
        else:
            $action = 1;
            $message = 'Se encontró una actualización del sistema';
        endif;

        $jsonMessage = json_encode(array('action' => $action, 'message' => $message ), JSON_FORCE_OBJECT);
        echo $jsonMessage;
    }
    public function proceso()
    {
        echo $this->esxprocess->pull();     
    }
}
