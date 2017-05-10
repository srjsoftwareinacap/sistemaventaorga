<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller {
	Public function __construct()
 {
 
 parent::__construct();

 $this->load->model('Modelo');
 
 }
	
	public function index($offsete= False)
	{
            $inicio=0;
          if(!is_null($offsete))
    {
        $offsete = $this->uri->segment(3);
    }
             
            
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
							$config['per_page'] = '10';
    						$config['num_links']=3;

    						$config['full_tag_open']="<ul class='pagination'>";
							$config['full_tag_close']='</ul>';
							 $config['num_tag_open'] = '<li>';
							    $config['num_tag_close'] = '</li>';
							    $config['cur_tag_open'] = "<li class='disabled'><li class='active' ><a href='#''>";
							    $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
                                                            $config['next_tag_open'] = "<li>";
							    $config['next_tagl_close'] = "</li>";
                                                            $config['use_page_numbers'] = TRUE;
                                                            $config['first_link'] = "Primero";
                                                            $config['prev_link'] = "<< Atras";
                                                            $config['next_link'] = "Siguiente >>";
                                                            $config['last_link'] = "Last";
							    $config['prev_tag_open'] = "<li>";
							    $config['prev_tagl_close'] = "</li>";
							    $config['first_tag_open'] = "<li>";
							    $config['first_tagl_close'] = "</ li>";
							    $config['last_tag_open'] = "<li>";
							    $config['last_tagl_close'] = "<li>";

							 $this->pagination->initialize($config);
							$data['productos']= $this->Modelo->fetch_productos_admin( $offsete,$config['per_page'],$rut_empresa);
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
        function  almacenarfamilia(){
            $tipo_familia =$this->input->post("tipo_familia");
            $guardar = array("tipo_familia"=>$tipo_familia);
            $captar= $this->Modelo->guardarfamilia($tipo_familia,$guardar);
            $mensaje="";	
if($captar=="si"){
$mensaje="si";
}else{
	$mensaje="no";
}
echo json_encode(array("mensaj"=>$mensaje));
        }
        
        function cargarcodigo_producto(){
            $codigo= $this->input->post("codigo");
            $rut_empresa=$this->session->userdata('rut_empresa');
	$contenido['familia']= $this->Modelo->adquerirfamilia()->result();
        
        $codigo_barra="";
        $nombre="";
        $descripccion="";
        $idf_familia="";
        $precio_neto="";
        $stock_minimo="";
        $precio_bruto="";
        
        
        $resultado=$this->Modelo->mosedi_producto($codigo,$rut_empresa);
        foreach ($resultado->result() as $produ) {
        $codigo_barra= $produ->codigo_barra;
        $nombre= $produ->nombre;
        $descripccion= $produ->descripcion;
        $idf_familia= $produ->idf_familia;
        $precio_neto= $produ->precio_neto;
        $stock_minimo= $produ->stock_minimo;
        $precio_bruto= $produ->precio_bruto;
        }
        $contenido['codigo_barra']=$codigo_barra;
        $contenido['nombre']=$nombre;
        $contenido['descripccion']=$descripccion;
        $contenido['idf_familia']= $idf_familia;
        $contenido['precio_neto']= $precio_neto;
        $contenido['stock_minimo']= $stock_minimo;
        $contenido['precio_bruto']= $precio_bruto;
        
        $variable_minimo=0;
        $contenido['informacion']="";
        $resultado2=$this->Modelo->verinventario($codigo,$rut_empresa);
        foreach ($resultado2->result() as $valor) {
            if($valor->ver!=0){
               $contenido['informacion']="si";
               $variable_minimo= $valor->ver;
            }else{
               $contenido['informacion']="no"; 
               $variable_minimo= $valor->ver;
            }
            $contenido['minimo']=$variable_minimo;
            $this->load->view('administrador/ginventario/gestionproducto/editarproducto',$contenido);
	
}    
        }
        
        function editar_producto(){
            $codigo_nuevo = $this->input->post("codigo_barra_nuevo");
            $nombre_nuevo = $this->input->post("nombre_nuevo");
            $descripcion  = $this->input->post("descripcion");
            $idf_familia = $this->input->post("id_familia");
            $rut_empresa = $this->session->userdata('rut_empresa');
            $precio_neto = $this->input->post("precio_neto");
            $stock_minimo = $this->input->post("stock_minimo");
            $precio_bruto = $this->input->post("precio_bruto");
            $codigo_viejo = $this->input->post("codigo_viejo");
            $mensaje="";
            
            $editar = array(
                "codigo_barra"=>$codigo_nuevo,
                "nombre"=>$nombre_nuevo,
                "descripcion"=>$descripcion,
                "idf_familia"=>$idf_familia,
                "rut_empresa_producto"=>$rut_empresa,
                "precio_neto"=>$precio_neto,
                "stock_minimo"=>$stock_minimo,
                "precio_bruto"=>$precio_bruto
            );
            if($codigo_nuevo==$codigo_viejo){
$captar=$this->Modelo->editarexistenteproductoempresa($codigo_nuevo,$codigo_viejo,$rut_empresa,$editar);

}else{
	$captar=$this->Modelo->editarproductoempresa($codigo_nuevo,$codigo_viejo,$rut_empresa,$editar);	
}
	
	
if($captar=="si"){
$mensaje="si";
}else{
	$mensaje="no";
}
echo json_encode(array("mensaj"=>$mensaje));
        }
                function almacenar_producto(){
        $rut_empresa= $this->session->userdata('rut_empresa');
        $codigo= $this->input->post("codigo");
	$nombre= $this->input->post("nombre");
	$descripcion= $this->input->post("descripcion");
	$familia= $this->input->post("familia");
        $precioneto= $this->input->post("precioneto");
	$stock= $this->input->post("stock");
        $precio_bruto= $this->input->post("precio_bruto");
	$estado= "activo";
     $stock_actual=0;
        
        $guardar= array(
	"codigo_barra"=>$codigo,
	"nombre"=>$nombre,
	"descripcion"=>$descripcion,
        "idf_familia"=>$familia,
        "rut_empresa_producto"=>$rut_empresa,
            "precio_neto"=>$precioneto,
        "stock_minimo"=>$stock,
            "precio_bruto"=>$precio_bruto,
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
