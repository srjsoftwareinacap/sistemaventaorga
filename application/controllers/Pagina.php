<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller {

	
	public function index()
	{
		$this->load->view('header');
                $this->load->view('content');
                $this->load->view('footer');
	}
        function cargarcontent(){
              if($this->session->userdata('login')==false){
$data['mensaje']="abrirmodal";
              }else{
                $data['mensaje']="cerrarmodal";
              }
              echo json_encode($data);
            
        }
}
