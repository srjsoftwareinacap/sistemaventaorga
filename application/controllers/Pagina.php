<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller {

	
	public function index()
	{
            
            if($this->session->userdata('login')==true){
                if($this->session->userdata('perfil')==100){
                    
                }
            }else{
                $this->load->view('header');
                $this->load->view('content');
                $this->load->view('footer');
            }
		
	}
       
}
