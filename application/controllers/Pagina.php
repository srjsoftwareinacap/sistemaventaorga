<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller {
	Public function __construct()
 {
 
 parent::__construct();

 $this->load->model('Modelo');
 
 }
	
	public function index()
	{
            
            if($this->session->userdata('login')==true){
                if($this->session->userdata('perfil')==100){
                    if($this->session->userdata('ir')==0){
                        $this->load->view('administrador/header');
                        $this->load->view('administrador/contentinicio');
                        $this->load->view('administrador/footer');
                    }
                }
            }else{
                $this->load->view('header');
                $this->load->view('content');
                $this->load->view('footer');
            }
		
	}
        function  validarusuario(){
        $rut= $this->input->post("rut");
	$contraseña= $this->input->post("contraseña");
       $respuesta= $this->Modelo->validarempresario($rut,$contraseña);
        if($respuesta=="empresa"){
            $ira=0;
                //sacarrutempresa
                $rut_empresas="";
                $nombre="";
                $sacar= $this->Modelo->consultarutempresa($rut);
                foreach ($sacar->result() as $valor){
          $rut_empresas= $valor->rut_empresa;
          $nombre= $valor->nombre_empresa;
      }
			$perfil= $this->Modelo->consultaPerfil($rut);
	     		$data['mensaj']="usuario valido";
                $vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
                    "ir"=>$ira
                );
        } else {
        if($respuesta=="usuario"){
        $ira=0;
	$rut_empresas="";
	$nombre="";
	$sacar= $this->Modelo->consultarutem($rut);
        foreach ($sacar->result() as $valor){
        $nombre= $valor->nombre_usuario;     	
        $rut_empresas= $valor->rut_empresa_peterneciente;
      }
	$perfil= $this->Modelo->consultaPerfilempresa($rut);
	 $data['mensaj']="usuario valido";
                $vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
                    "ir"=>$ira
                );	
        }else{
            $data['mensaj']="usuario no valido";
                $vector =array(
                  "usuario"=>"",
                  "rut_empresa"=>"",
                  "nombre_u"=>"",
                    "login"=>false,
                    "perfil"=>"",
                    "ir"=>""

                );
        }    
        }
        $this->session->set_userdata($vector);
        echo json_encode($data);
        }
       
}
