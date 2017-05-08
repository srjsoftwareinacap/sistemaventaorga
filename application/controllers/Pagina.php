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
                    //inicio
                    if($this->session->userdata('gestion')==0){
                        if($this->session->userdata('ir')==0){
                            $this->load->view('administrador/header');
                        $this->load->view('administrador/contentinicio');
                        $this->load->view('administrador/footer');
                        }
                        
                    }else{
                        //gestion venta
                        if($this->session->userdata('gestion')==1){
                            
                        }else{
                            //gestion inventario
                           if($this->session->userdata('gestion')==2){
                               //gestion producto
                               if($this->session->userdata('ir')==0){
                                   $this->load->library('pagination');
							$config['base_url'] = base_url().'Pagina/index';
							$rut_empresa=$this->session->userdata('rut_empresa');

							$cantidad=0;
							$consulta=$this->Modelo->total_productode_emresa($rut_empresa);
							foreach ($consulta->result() as $valor){
                        $cantidad= $valor->datos;
      							}

							$config['total_rows'] = $cantidad;
							$config['per_page'] = '8';
    						$config['num_links']=3;

    						$config['full_tag_open']="<ul class='pagination'>";
							$config['full_tag_close']='</ul>';
							 $config['num_tag_open'] = '<li>';
							    $config['num_tag_close'] = '</li>';
							    $config['cur_tag_open'] = "<li class='disabled'><li class='active' ><a href='#''>";
							    $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
							$config['next_tag_open'] = "<li>";
							    $config['next_tagl_close'] = "</li>";
							    $config['prev_tag_open'] = "<li>";
							    $config['prev_tagl_close'] = "</li>";
							    $config['first_tag_open'] = "<li>";
							    $config['first_tagl_close'] = "</ li>";
							    $config['last_tag_open'] = "<li>";
							    $config['last_tagl_close'] = "<li>";

							 $this->pagination->initialize($config);
							$data['productos']= $this->Modelo->fetch_productos_admin($config['per_page'] ,$this->uri->segment(3),$rut_empresa);
							$data['links']=$this->pagination->create_links();
                                   $data['mensaje']='';
                                  $data['familia']= $this->Modelo->adquerirfamilia()->result();
                        $this->load->view('administrador/ginventario/gestionproducto/header');
                        $this->load->view('administrador/ginventario/gestionproducto/content',$data);
                        $this->load->view('administrador/ginventario/gestionproducto/footer');
                               }else{
                                   //entrada de producto
                          if ($this->session->userdata('ir')==1){
                        $this->load->view('administrador/ginventario/entradaproducto/header');
                        $this->load->view('administrador/ginventario/entradaproducto/content');
                        $this->load->view('administrador/ginventario/entradaproducto/footer');
                                   }else{
                                       //salida de producto
                                       if($this->session->userdata('ir')==2){
                        $this->load->view('administrador/ginventario/salidaproducto/header');
                        $this->load->view('administrador/ginventario/salidaproducto/content');
                        $this->load->view('administrador/ginventario/salidaproducto/footer');
                                       }else{
                                           //reporte de entrada
                                       if($this->session->userdata('ir')==3){
                        $this->load->view('administrador/ginventario/reporteentrada/header');
                        $this->load->view('administrador/ginventario/reporteentrada/content');
                        $this->load->view('administrador/ginventario/reporteentrada/footer');
                                       } else {
                                           //reporte salida
                                           if ($this->session->userdata('ir')==4){
                        $this->load->view('administrador/ginventario/reportesalida/header');
                        $this->load->view('administrador/ginventario/reportesalida/content');
                        $this->load->view('administrador/ginventario/reportesalida/footer');
                                           }  
                                       }   
                                       }
                                   }
                               }                               
                           }else{
                               //gestion odt
                               if($this->session->userdata('gestion')==3){
                                   
                               }else{
                                   //g ingreso de soporte
                                   if($this->session->userdata('gestion')==4){
                                       
                                   }
                               }
                           } 
                        }
                    }
                }
            }else{
                $this->load->view('header');
                $this->load->view('content');
                $this->load->view('footer');
            }
		
	}
        
        function volverinicio(){
        $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =0;
        $gestion=0;
	
	$vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
            "gestion"=>$gestion,
                    "ir"=>$ira
                );
	
	$this->session->set_userdata($vector);
	redirect(base_url());    
        }


        ////////////////////////////seccion de cambio de gestion venta///////////////////////////////////
        ////////////////////////////////////////////////////////////////////////////////////////////////
        
        ////////////////////////////seccion de cambio de gestion inventario///////////////////////////////////
        	function ginventario(){
	$rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =0;
        $gestion=2;
	
	$vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
            "gestion"=>$gestion,
                    "ir"=>$ira
                );
	
	$this->session->set_userdata($vector);
	redirect(base_url());
	
	}
        function G_producto(){
        $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =0;
        $gestion=2;
	$vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
            "gestion"=>$gestion,
                    "ir"=>$ira
                );	
	$this->session->set_userdata($vector);
	redirect(base_url());     
        }
                function R_entrada(){
        $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =1;
        $gestion=2;
	$vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
                    "gestion"=>$gestion,
                    "ir"=>$ira
                );	
	$this->session->set_userdata($vector);
	redirect(base_url());    
        }
        function R_salida(){
        $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =2;
        $gestion=2;
	$vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
                    "gestion"=>$gestion,
                    "ir"=>$ira
                );	
	$this->session->set_userdata($vector);
	redirect(base_url());    
        }
        function L_entrada(){
        $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =3;
        $gestion=2;
	$vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
                    "gestion"=>$gestion,
                    "ir"=>$ira
                );	
	$this->session->set_userdata($vector);
	redirect(base_url());    
        }
        function L_salida(){
        $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =4;
        $gestion=2;
	$vector =array(
                  "usuario"=>$rut,
                  "rut_empresa"=>$rut_empresas,
                  "nombre_u"=>$nombre,
                    "login"=>true,
                    "perfil"=>$perfil,
                    "gestion"=>$gestion,
                    "ir"=>$ira
                );	
	$this->session->set_userdata($vector);
	redirect(base_url());    
        }
        ///////////////////////////////////////////////////fin de cambio/////////////////////////////////////////////   
        
        
           ////////////////////////////seccion de cambio de gestion orden de trabajo///////////////////////////////////
        /////////////////////////////////////////////fin de cambio///////////////////////////////////////////////////
        
        
           ////////////////////////////seccion de cambio de gestion soporte///////////////////////////////////
        ///////////////////////////////////////////////fin de cambio/////////////////////////////////////////////////
        
        
        
        	function cerrar(){
		$this->session->sess_destroy();
          redirect(base_url());    
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
                $gestion=0;
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
                    "gestion"=>$gestion,
                    "ir"=>$ira
                );
        } else {
        if($respuesta=="usuario"){
        $ira=0;
	$rut_empresas="";
	$nombre="";
        $gestion=0;
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
                    "gestion"=>$gestion,
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
                    "gestion"=>"",
                    "ir"=>""

                );
        }    
        }
        $this->session->set_userdata($vector);
        echo json_encode($data);
        }
        function almacenar_producto(){
        $rut_empresa= $this->session->userdata('rut_empresa');
        $codigo= $this->input->post("codigo");
	$nombre= $this->input->post("nombre");
	$descripcion= $this->input->post("descripcion");
	$familia= $this->input->post("familia");
	$stock= $this->input->post("stock");
	$estado= "activo";
        
        $guardar= array(
	"codigo_barra"=>$codigo,
	"nombre"=>$nombre,
	"descripcion"=>$descripcion,
        "stock_minimo"=>$stock,
	"idf_familia"=>$familia,
	"rut_empresa_producto"=>$rut_empresa,
	"estado"=>$estado
	);
$captar= $this->Modelo->guardarproducto($codigo,$guardar);
$mensaje="";	
if($captar=="si"){
$mensaje="si";
}else{
	$mensaje="no";
}
echo json_encode(array("mensaj"=>$mensaje));
        }
}
