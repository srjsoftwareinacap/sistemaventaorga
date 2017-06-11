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
                            if($this->session->userdata('ir')==0){
                                $id_venta=0;
                                $data['medios']= $this->Modelo->aquerirmedio()->result();
                                $ver= $this->Modelo->verestableventa();
                                if($ver=="nuevaventa"){
                                  $maximo=  $this->Modelo->crearnuevaventa();
                                    foreach ($maximo->result() as $valor) {
            $id_venta = $valor->id_codigo_venta;
        }
        $data['empesar']="estable";
                                }else{
                                    if ($ver=="seleccionarmax"){
                                      $maximo2=  $this->Modelo->vermaximo();
                                    foreach ($maximo2->result() as $valor) {
            $id_venta = $valor->id_codigo_venta;
        }  
        $data['empesar']="estable";
                                    }else{
                                        $data['empesar']="error";
                                    }
     $data['detalle_venta']= $this->Modelo->verdetalle($id_venta);                           }
                                
              $data['idventa']=$id_venta;
              $data['sub_total']=0;
                                $this->load->view('administrador/gventas/ventas/header');
                        $this->load->view('administrador/gventas/ventas/content',$data);
                        $this->load->view('administrador/gventas/ventas/footer');
                            }else{
                                if($this->session->userdata('ir')==1){
                                   $this->load->view('administrador/gventas/cancel/header');
                        $this->load->view('administrador/gventas/cancel/content');
                        $this->load->view('administrador/gventas/cancel/footer');
                                }
                            }
                            
                            
                            
                            
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
                        $contenido['proveedores']= $this->Modelo->adquerirproveedores()->result();
                        $this->load->view('administrador/ginventario/entradaproducto/header');
                        $this->load->view('administrador/ginventario/entradaproducto/content',$contenido);
                        $this->load->view('administrador/ginventario/entradaproducto/footer');
                                   }else{
                                       //salida de producto
                                       if($this->session->userdata('ir')==2){
                       $contenido['proveedores']= $this->Modelo->adquerirproveedores()->result();                    
                        $this->load->view('administrador/ginventario/salidaproducto/header');
                        $this->load->view('administrador/ginventario/salidaproducto/content',$contenido);
                        $this->load->view('administrador/ginventario/salidaproducto/footer');
                                       }else{
                                           //reporte de entrada
                                           $this->load->library('pagination');
							$config['base_url'] = base_url().'Pagina/index';
							$rut_empresa=$this->session->userdata('rut_empresa');

							$cantidad=0;
							$consulta=$this->Modelo->total_entradas();
							foreach ($consulta->result() as $valor){
                                                            $cantidad= $valor->datos;
      							}

							$config['total_rows'] = $cantidad;
							$config['per_page'] = '15';
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
							$data['entradas']= $this->Modelo->ver_entradas( $offsete,$config['per_page']);
							$data['links']=$this->pagination->create_links();
                                     $data['mensaje']='';
                                       if($this->session->userdata('ir')==3){
                        $this->load->view('administrador/ginventario/reporteentrada/header');
                        $this->load->view('administrador/ginventario/reporteentrada/content',$data);
                        $this->load->view('administrador/ginventario/reporteentrada/footer');
                                       } else {
                                           //reporte salida
                                           if ($this->session->userdata('ir')==4){
                        $this->load->library('pagination');
							$config['base_url'] = base_url().'Pagina/index';
							$rut_empresa=$this->session->userdata('rut_empresa');

							$cantidad=0;
							$consulta=$this->Modelo->total_salidas();
							foreach ($consulta->result() as $valor){
                                                            $cantidad= $valor->datos;
      							}

							$config['total_rows'] = $cantidad;
							$config['per_page'] = '15';
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
							$data['salidas']= $this->Modelo->ver_salidas( $offsete,$config['per_page']);
							$data['links']=$this->pagination->create_links();
                        $data['mensaje']='';                       
                        $this->load->view('administrador/ginventario/reportesalida/header');
                        $this->load->view('administrador/ginventario/reportesalida/content',$data);
                        $this->load->view('administrador/ginventario/reportesalida/footer');
                                           }else{
                                 if ($this->session->userdata('ir')==5){
                                     //gestion proveedor
                                     $this->load->library('pagination');
							$config['base_url'] = base_url().'Pagina/index';
							$rut_empresa=$this->session->userdata('rut_empresa');

							$cantidad=0;
							$consulta=$this->Modelo->total_proveedor_($rut_empresa);
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
                                                         $data['region'] = $this->Modelo->verregiones()->result();
							$data['proveedores']= $this->Modelo->ver_proveedor( $offsete,$config['per_page'],$rut_empresa);
							$data['links']=$this->pagination->create_links();
                                     $data['mensaje']='';
                        $this->load->view('administrador/ginventario/gestionproveedor/header');
                        $this->load->view('administrador/ginventario/gestionproveedor/content',$data);
                        $this->load->view('administrador/ginventario/gestionproveedor/footer'); 
                                 }else{
                                     //inventario
                                        if ($this->session->userdata('ir')==6){
                                            $this->load->library('pagination');
							$config['base_url'] = base_url().'Pagina/index';
							$rut_empresa=$this->session->userdata('rut_empresa');

							$cantidad=0;
							$consulta=$this->Modelo->total_productos();
							foreach ($consulta->result() as $valor){
                                                            $cantidad= $valor->datos;
      							}

							$config['total_rows'] = $cantidad;
							$config['per_page'] = '15';
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
                                                         $data['suma']= $this->Modelo->sumatotaldeproductos();
							$data['productosin']= $this->Modelo->ver_productosexistentes( $offsete,$config['per_page']);
                                                        
                                                        $data['stock_minimo']=$this->Modelo->verretockminimo();
                                                        $recorrer= $this->Modelo->vercantidadestockminimo();
                                                        $lista=0;
                                                        foreach ($recorrer->result() as $valor){
                                                            $lista= $valor->datos;
      							}
                                                        $data['cantidadminimos']=$lista;
                                                        $data['limite']=0;
                                                        $data['variable']=0;
                                                        $data['fin']="</div>";
							$data['links']=$this->pagination->create_links();
                                     $data['mensaje']='';
                        $this->load->view('administrador/ginventario/inventario/header');
                        $this->load->view('administrador/ginventario/inventario/content',$data);
                        $this->load->view('administrador/ginventario/inventario/footer');  
                                        }
                                 }
                                           }  
                                       }   
                                       }
                                   }
                               }                               
                           }else{
                               //gestion odt
                               if($this->session->userdata('gestion')==3){
                                   
                               }else{
                                   //g ingreso de usuarios
                                   if($this->session->userdata('gestion')==4){
                                       $data['mensaje']= "";
                                       $rut_empresas = $this->session->userdata('rut_empresa');
                                       $data['lista']= $this->Modelo->VerUsuario($rut_empresas);
                                      
                                    $this->load->view('administrador/gusuario/header');
                                    $this->load->view('administrador/gusuario/content',$data);
                                    $this->load->view('administrador/gusuario/footer');  
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
        function gventas(){
           $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =0;
        $gestion=1;
	
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
        function V_canceladas(){
            $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =1;
        $gestion=1;
	
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
function ir_inventario(){
	$rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =6;
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
        function G_proveedor(){
           $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =5;
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
        
        
           ////////////////////////////seccion de cambio de gestion usuario///////////////////////////////////
           
        function gusuario(){
             $rut =	$this->session->userdata('usuario');
	$perfil = $this->session->userdata('perfil');
	$rut_empresas = $this->session->userdata('rut_empresa');
	$nombre= $this->session->userdata('nombre_u');
	$ira =1;
        $gestion=4;
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
        function anadirdetalles(){
            $codigo_barra= $this->input->post("codigo");
            $id_venta= $this->input->post("id_venta");
            $cantidad= $this->input->post("cantidad");
            $ver = $this->Modelo->versinosi($codigo_barra);
            $mensaje="";
            $precio="";
            $diferencia=0;
            $stock_minimo=0;
            $stock_actual=0;
            if($ver=="si"){
            $sacarproducto = $this->Modelo->sacarproductomisto($codigo_barra);
            foreach ($sacarproducto->result() as $valor) {
               $stock_minimo =$valor->stock_minimo;
               $precio=$valor->precio_bruto;
               $stock_actual=$valor->cantidad;
            }
            if($stock_actual>=$cantidad){
                $detalle_venta = array(
                    "codigo_detalle_venta"=>$id_venta,
                    "codigo_producto_detalle"=>$codigo_barra,
                    "cantidad"=>$cantidad,
                    "precio"=>$precio
                );
             $captar=   $this->Modelo->almacenardetalleventa($detalle_venta,$codigo_barra,$id_venta,$cantidad);
             $mensaje=$captar;
            }else{
                $mensaje="Error, la cantidad ingresada es superior al stock";
            }
            
            }else{
                $mensaje="Error, el producto no existe en inventario";
            }
            echo json_encode(array("m1"=>$mensaje));
        }
                function cargarcodigo_proveedor(){
            $rut= $this->input->post("codigo");
            $verlista = $this->Modelo->verempresaespe($rut);
           $contenido['rut'] = $rut;
            foreach ($verlista->result() as $valor) {
             $contenido['nombre'] = $valor->nombre_empresa;
               $contenido['giro'] = $valor->giro;
               $contenido['telefono'] = $valor->telefono;
               $contenido['calle'] = $valor->calle;
               $contenido['correo'] = $valor->correo_electronico;
            }
            $contenido['region'] = $this->Modelo->verregiones()->result();
            $this->load->view('administrador/ginventario/gestionproveedor/editarproveedor',$contenido);
            
        }
        function eliminnardetalleventa(){
            $codigo= $this->input->post("codigo");
            $this->Modelo->eliminardetalle($codigo);
            echo json_encode(array(
                "m1"=>"listo"
                ));
        }
        function cacelarventaproducto(){
            $codigo= $this->input->post("codigo");
            $this->Modelo->cancelarventas($codigo);
        }
                function actualizardetalle(){
            $id_detalle= $this->input->post("id_detalle");
            $cantidad_ingresada= $this->input->post("cantidad_ahora");
            $cantidad_anterior= $this->input->post("cantidad_anterior");
            $total_modificar =$this->input->post("total_modificar");
           $codigo_barra= $this->input->post("codigo_barra");
            $stock_ver=$total_modificar+$cantidad_anterior;
            $mensaje="";
           
            if($stock_ver>=$cantidad_ingresada){
                $stock_inventario= $stock_ver-$cantidad_ingresada;
                 
             $this->Modelo->editardetalle($id_detalle,$cantidad_ingresada,$stock_inventario,$codigo_barra); 
             $mensaje="listo";
            }else{
                $mensaje="Error, la cantidad es superior que el inventario";
            }           
            echo json_encode(array(
               "m1"=>$mensaje
            ));
        }
                function cargarcodigo_producto(){
            $codigo= $this->input->post("codigo");
            $rut_empresa=$this->session->userdata('rut_empresa');
	$contenido['familia']= $this->Modelo->adquerirfamilia()->result();
        
        $codigo_barra="";
        $nombre="";
        $descripccion="";
        $idf_familia="";
        
        $precio_bruto="";
        
        
        $resultado=$this->Modelo->mosedi_producto($codigo,$rut_empresa);
        foreach ($resultado->result() as $produ) {
        $codigo_barra= $produ->codigo_barra;
        $nombre= $produ->nombre;
        $descripccion= $produ->descripcion;
        $idf_familia= $produ->idf_familia;
        
        $stock_minimo= $produ->stock_minimo;
        $precio_bruto = $produ->precio_bruto;
        }
        $contenido['codigo_barra']=$codigo_barra;
        $contenido['nombre']=$nombre;
        $contenido['descripccion']=$descripccion;
        $contenido['idf_familia']= $idf_familia;
        
        $contenido['stock_minimo']= $stock_minimo;
        $contenido['precio_bruto']= $precio_bruto;
        
        $variable_minimo=0;
        $contenido['informacion']="";
        $variable = $this->Modelo->verinventariosio($codigo);
        if($variable=="si"){
        $resultado2=$this->Modelo->verinventario($codigo,$rut_empresa);
        foreach ($resultado2->result() as $valor) {
            if($valor->ver!=0){
               $contenido['informacion']="si";
               $variable_minimo= $valor->ver;
            }else{
               $contenido['informacion']="no"; 
               $variable_minimo= 0;
            }
        }
        }else{
            $contenido['informacion']="no";
            $variable_minimo= 0;
        }
            $contenido['minimo']=$variable_minimo;
            $this->load->view('administrador/ginventario/gestionproducto/editarproducto',$contenido);
	
    
        }
        function cargarcantidad_venta(){
            $codigo = $this->input->post("codigo");
            $recorrer['venta']= $this->Modelo->cargardetalle($codigo);
            $this->load->view('administrador/gventas/ventas/editarcantidad',$recorrer);
        }
                
        function editar_producto(){
            $codigo_nuevo = $this->input->post("codigo_barra_nuevo");
            $nombre_nuevo = $this->input->post("nombre_nuevo");
            $descripcion  = $this->input->post("descripcion");
            $idf_familia = $this->input->post("id_familia");
            
            $stock_minimo = $this->input->post("stock_minimo");
            
            $codigo_viejo = $this->input->post("codigo_viejo");
            $precio_bruto = $this->input->post("precio_bruto");
            $mensaje="";
            
            $editar = array(
                "codigo_barra"=>$codigo_nuevo,
                "nombre"=>$nombre_nuevo,
                "descripcion"=>$descripcion,
                "idf_familia"=>$idf_familia,
                "stock_minimo"=>$stock_minimo,
                "precio_bruto"=>$precio_bruto
            );
            if($codigo_nuevo==$codigo_viejo){
$captar=$this->Modelo->editarexistenteproductoempresa($codigo_nuevo,$codigo_viejo,$editar);

}else{
	$captar=$this->Modelo->editarproductoempresa($codigo_nuevo,$codigo_viejo,$editar);	
}
	
	
if($captar=="si"){
$mensaje="si";
}else{
	$mensaje="no";
}
echo json_encode(array("mensaj"=>$mensaje));
        }
function buscar_productosinventario(){
    $codigo= $this->input->post('buscar_inventario');
        if(isset($codigo) and !empty($codigo) ){      
$data['suma']= $this->Modelo->sumatotaldeproductos();
$data['productosin']= $this->Modelo->buscar_productosexistentes($codigo);                                                       
$data['stock_minimo']=$this->Modelo->verretockminimo();
$recorrer= $this->Modelo->vercantidadestockminimo();
 $lista=0;
foreach ($recorrer->result() as $valor){
$lista= $valor->datos;
 }
$data['cantidadminimos']=$lista;
$data['limite']=0;
$data['variable']=0;
$data['fin']="</div>";
$data['links']='';                                                   
$data['mensaje']='';
$this->load->view('administrador/ginventario/inventario/header');
$this->load->view('administrador/ginventario/inventario/content',$data);
$this->load->view('administrador/ginventario/inventario/footer');
}else{
    redirect(base_url());
}
}
                function buscar_producto_empresa(){
	$codigo= $this->input->post('buscar_producto');
        if(isset($codigo) and !empty($codigo) ){
        $data['mensaje']='Para volver, Presione el Boton Buscar';
        $rut_empresa= $this->session->userdata('rut_empresa');
        $data['familia']= $this->Modelo->adquerirfamilia()->result();
        $data['productos']= $this->Modelo->buscar_producto_empresa($codigo,$rut_empresa);
        $data['links']='';
        $this->load->view('administrador/ginventario/gestionproducto/header');
        $this->load->view('administrador/ginventario/gestionproducto/content',$data);
        $this->load->view('administrador/ginventario/gestionproducto/footer');
}else{
	redirect(base_url());
}
}
function buscar_entrada(){
    $codigo= $this->input->post('buscar_entrada');
    if(isset($codigo) and !empty($codigo) ){
 $data['mensaje']='Para volver, Presione el Boton Buscar';
        $rut_empresa= $this->session->userdata('rut_empresa');
        
        $data['entradas']= $this->Modelo->buscar_entrada_empresa($codigo,$rut_empresa);
        $data['links']='';
        $this->load->view('administrador/ginventario/reporteentrada/header');
        $this->load->view('administrador/ginventario/reporteentrada/content',$data);
        $this->load->view('administrador/ginventario/reporteentrada/footer');
        
    }else{
        redirect(base_url());
    }
}
function  buscar_salida(){
    $codigo= $this->input->post('buscar_salida');
    if(isset($codigo) and !empty($codigo) ){
        $data['salidas']= $this->Modelo->buscar_salidas_empresa($codigo);
        $data['mensaje']='Para volver, Presione el Boton Buscar';
        $data['links']='';
        $this->load->view('administrador/ginventario/reportesalida/header');
                        $this->load->view('administrador/ginventario/reportesalida/content',$data);
                        $this->load->view('administrador/ginventario/reportesalida/footer');
    }else{
        redirect(base_url());
    }
}
        function buscar_proveedor_empresa(){
    $codigo= $this->input->post('buscar_proveedor');
    if(isset($codigo) and !empty($codigo) ){
        $data['mensaje']='Para volver, Presione el Boton Buscar';
        $data['region'] = $this->Modelo->verregiones()->result();
        $data['proveedores']= $this->Modelo->buscar_proveedor($codigo);
        $data['links']='';
        $this->load->view('administrador/ginventario/gestionproveedor/header');
                        $this->load->view('administrador/ginventario/gestionproveedor/content',$data);
                        $this->load->view('administrador/ginventario/gestionproveedor/footer'); 
    }else{
        redirect(base_url());
    }
}
        function bloquiar_producto_empresa(){
	$codigo= $this->input->post("codigo");
	$this->Modelo->bloquiar_producto_empresa($codigo);
    $data="xas";
    echo json_encode($data);
}
function  bloquiar_proveedor(){
    $codigo= $this->input->post("codigo");
    $this->Modelo->bloquiar_proveedor($codigo);
    $data="xas";
    echo json_encode($data);
}
        function  verproducto(){
    $codigo= $this->input->post("codigo_barra");
    $captar=$this->Modelo->versiestabn($codigo);
    $mensaje =$captar;
    echo json_encode($data);
    
    
}

        function registrarinventario(){
    $codigo_barra_producto= $this->input->post('codigo_barra');
    $stock_ingresado = $this->input->post('stock_ingresado');
    $idf_entrada = $this->input->post('idf_entrada');
    $precio_neto = $this->input->post('precio_neto');
    $precio_bruto = $this->input->post('precio_bruto');
        $guardar= array(
            "idf_entrada"=>$idf_entrada,
            "codigo_barra_entrada"=>$codigo_barra_producto,
            "cantidad"=>$stock_ingresado,
            "precio_neto"=>$precio_neto
        );
        $mensaje= $this->Modelo->registarentrada($codigo_barra_producto,$idf_entrada,$stock_ingresado,$guardar,$precio_neto);
          echo json_encode(array("mensaj"=>$mensaje));

}
        function DesBloquiar_producto_empresar(){
	$codigo= $this->input->post("codigo");
	$this->Modelo->desbloquiar_producto_empresa($codigo);
    $data="xas";
    echo json_encode($data);
}
function almacenarfacturasalida(){
    $rut_proveedor=$this->input->post('rut_proveedor');
    $numero_factura =$this->input->post('numero_factura');
    $descripcion = $this->input->post('descripcion');
    date_default_timezone_set("America/Santiago");
    $fecha =date("Y-m-d");
    $guardar= array(
        "rut_proveedor"=>$rut_proveedor,
        "fecha"=>$fecha,
        "numero_factura_despacho"=>$numero_factura,
        "descripcion"=>$descripcion
    );
    $ver = $this->Modelo->almacenarsalida1($rut_proveedor,$numero_factura,$guardar);
     echo json_encode(array(
        "m1"=>$ver
    ));
}
        function DesBloquiar_proveedor(){
    $codigo= $this->input->post("codigo");
	$this->Modelo->desbloquiar_proveedor($codigo);
    $data="xas";
    echo json_encode($data);
}
        function vereficarinventario(){
	$rut_proveedor= $this->input->post('rut_proveedor');
        $numero_factura = $this->input->post('numero_factura');
        $codigo_barra = $this->input->post('codigo_barra');
	$ver=$this->Modelo->verentrada($numero_factura,$rut_proveedor);
        
	$mensaje="";
         $nombre="";
	$descripcion="";
	$familia="";
	$stock_minimo=0;
	$cantidadmaxima=0;
        $id_entrada=0;
        $precio_neto=0;
        $precio_bruto =0;
        $mensaje="";
        if($ver=="existe"){  
	$info= $this->Modelo->vareficcar_entrada_productoinventario($codigo_barra);
if($info=="Se ha encontrado Producto"){
$ver12 = $this->Modelo->verificar_bloproductoinventario($codigo_barra);
		if($ver12=="activo"){
			$mensaje="Producto en registro";
			$dato = $this->Modelo->obtener_productoinventario2($codigo_barra);
			foreach ($dato->result() as $variable) {
		$nombre = $variable->nombre;
	$descripcion = $variable->descripcion;
	$familia = $variable->tipo_familia;
	$stock_minimo = $variable->stock_minimo;
     $precio_bruto = $variable->precio_bruto;
	}
       $listaentrada = $this->Modelo->selleccionarentradaproveedor($rut_proveedor,$numero_factura);
       foreach ($listaentrada->result() as $valor ) {
           $id_entrada = $valor->id_entrada;
       }
	$inventario= $this->Modelo->selecionar_entrada_productoinventario($codigo_barra);
	foreach ($inventario->result() as $valor ) {
                $precio_neto = $valor->precio_neto;
                
		$cantidadmaxima = $valor->cantidad;
	}
		}else{
			$mensaje="Producto bloqueado";
		}
}else{
$mensaje=$info;
}
        }else{
            $mensaje="No hay de factura";
        }
	
		echo json_encode(array(
		"m1"=>$mensaje,
		"nombre"=>$nombre,
		"descripcion"=>$descripcion,
		"familia"=>$familia,
		"stock_minimo"=>$stock_minimo,
		"stock_maximo"=>$cantidadmaxima,
                "id_entrada"=>$id_entrada,
                "precio_neto"=>$precio_neto,
                "precio_bruto"=>$precio_bruto
		));
}
function verificarinventariosalida(){
    $codigo = $this->input->post("codigo"); 
    $rut_proveedor = $this->input->post("id_proveedor");
    $numero_factura = $this->input->post("numero_factura");
    $stock_minimo="";
    $nombre="";
    $descripcion="";
    $familia="";
    $precio_neto=0;
    $mensaje="";
    $cantidad=0;
    $id_salida=0;
    $ver= $this->Modelo->versalidas($rut_proveedor,$numero_factura);
    if($ver=="existe"){
        $info= $this->Modelo->vareficcar_entrada_productoinventario($codigo);
if($info=="Se ha encontrado Producto"){
    $vercantidad = $this->Modelo->vercantidad($codigo);
    if($vercantidad=="si"){
    $dato = $this->Modelo->obtener_productoinventario2($codigo);
			foreach ($dato->result() as $variable) {
		$nombre = $variable->nombre;
	$descripcion = $variable->descripcion;
	$familia = $variable->tipo_familia;
	$stock_minimo = $variable->stock_minimo;
	}
        $datos= $this->Modelo->obtenerinventario($codigo);
        foreach ($datos->result() as $valor) {
            $cantidad=$valor->cantidad;
        }
        $recorrer= $this->Modelo->obtenersalidas($rut_proveedor,$numero_factura);
        foreach ($recorrer->result() as $valor) {
            $id_salida= $valor->id_salida;
        }
        $mensaje="Se ha encontrado el producto";
        
        
    }else{
        $mensaje="Error, no existe registro de inventario";
    }
}else{
    $mensaje=$info;
}
    }else{
        $mensaje="Error, No existe factura";
    }
    echo json_encode(array(
        "m1"=>$mensaje,
        "nombre"=>$nombre,
        "descripcion"=>$descripcion,
        "familia"=>$familia,
        "stock_minimo"=>$stock_minimo,
        "cantidad"=>$cantidad,
        "id_salida"=>$id_salida
    ));
}
function almacenarsalidaproducto(){
    $idf_salida=$this->input->post("id_salida");
    $codigo_barra= $this->input->post("codigo_barra");
    $cantidad= $this->input->post("cantidad");
    $precio_neto = $this->input->post("precio_neto");
    $guardar = array(
        "idf_salida"=>$idf_salida,
        "codigo_barra_salida"=>$codigo_barra,
        "cantidad"=>$cantidad,
        "precio_neto"=>$precio_neto
    );
 $ver=$this->Modelo->registrarsalida($codigo_barra,$cantidad,$guardar,$idf_salida);   
 echo json_encode(array(
     "m1"=>$ver
 ));
}
function cargarproviencias(){
       $codigo= $this->input->post("codigo");
       $info1['provicias']= $this->Modelo->verprovincias($codigo)->result();
        
         $this->load->view('administrador/ginventario/gestionproveedor/cargarprovincias',$info1);
        
}
function cargarprovienciaseditar(){
    $codigo= $this->input->post("codigo");
       $info1['provicias']= $this->Modelo->verprovincias($codigo)->result();
        
         $this->load->view('administrador/ginventario/gestionproveedor/cargarprovincias2',$info1);
}
        function cargarcomunas(){
     $codigo= $this->input->post("codigo");
      $info1['comunas']= $this->Modelo->vercomunas($codigo)->result();
      $this->load->view('administrador/ginventario/gestionproveedor/cargarcomuna',$info1);
}
function cargarcodigo_inventario(){
    $codigo= $this->input->post("codigo");
    $data['inventario']= $this->Modelo->adquerirproductoinventario($codigo);
    $this->load->view('administrador/ginventario/inventario/editarinventario',$data);
}
function actualizar_inventario(){
    $codigo= $this->input->post("codigo_barra");
    $stockactual =$this->input->post("valor_ingresado");
    $informacion= $this->Modelo->actualizarinventario($codigo,$stockactual);
    echo json_encode(array(
        "m1"=>$informacion
        ));
    
}
        function almacenarentrada(){
    $rut_proveedor= $this->input->post("rut_proveedor");
    $numero_factura= $this->input->post("numero_factura");
    $descripcion = $this->input->post("descripcion");
    date_default_timezone_set("America/Santiago");
    $fecha =date("Y-m-d");
    $guardar = array(
        "rut_proveedor"=>$rut_proveedor,
        "fecha"=>$fecha,
        "numero_factura"=>$numero_factura,
        "descripcion"=>$descripcion
    );
    $ver= $this->Modelo->verentradas($rut_proveedor,$numero_factura);
    if($ver=="si"){
        $this->Modelo->alamacenarnetrada($guardar);
        $mensaje ="Factura registrada";
    }else{
        $mensaje="Error, La factura ya se encuentra registrada";
    }
    echo json_encode(array("mensaj"=>$mensaje));
    
}
        function ediarproveedor(){
    $rut= $this->input->post("rut");
       $nombre= $this->input->post("nombre");
        $giro= $this->input->post("giro");
         $telefono= $this->input->post("telefono");
          $id_region= $this->input->post("region_id");
          $id_provincia= $this->input->post("provincia");
           $comuna= $this->input->post("comuna");
            $calle= $this->input->post("calle");
             $correo_electronico= $this->input->post("correo");
          $nombreregion ="";
          $sacarregion= $this->Modelo->consulregion($id_region);
          foreach ($sacarregion->result() as $valor){
          $nombreregion =  $valor->region_ordinal." ".$valor->region_nombre;
      }
          
            $nombreprovincia=""; 
       $sacarprovincia= $this->Modelo->consulprovincia($id_provincia);
                foreach ($sacarprovincia->result() as $valor){
          $nombreprovincia = $valor->provincia_nombre;   
      }
  
      $editar = array(
          "nombre_empresa"=>$nombre,
          "giro"=>$giro,
          "telefono"=>$telefono,
          "region"=>$nombreregion,
          "provincia"=>$nombreprovincia,
          "comuna"=>$comuna,
          "calle"=>$calle,
          "correo_electronico"=>$correo_electronico
      );
      $mensaje="si";
      $this->Modelo->editarproveedor($editar,$rut);
       echo json_encode(array("mensaj"=>$mensaje));
} 

        function  almacenarprovedor(){
     $rut= $this->input->post("rut");
      $des = $this->input->post("des");
       $nombre= $this->input->post("nombre");
        $giro= $this->input->post("giro");
         $telefono= $this->input->post("telefono");
          $id_region= $this->input->post("region");
          $id_provincia= $this->input->post("provincia");
           $comuna= $this->input->post("comuna");
            $calle= $this->input->post("calle");
             $correo_electronico= $this->input->post("correo");
          $nombreregion ="";
          $sacarregion= $this->Modelo->consulregion($id_region);
          foreach ($sacarregion->result() as $valor){
          $nombreregion =  $valor->region_ordinal." ".$valor->region_nombre;
      }
          
            $nombreprovincia=""; 
       $sacarprovincia= $this->Modelo->consulprovincia($id_provincia);
                foreach ($sacarprovincia->result() as $valor){
          $nombreprovincia = $valor->provincia_nombre;   
      }
      $rute=$rut."-".$des;
      $validar = $this->Modelo->consulrutprove($rute);
      $tipo_oculto="proveedor";
      $estado="activo";
      $almacenar = array(
          "rut_empresa"=>$rute,
          "nombre_empresa"=>$nombre,
          "giro"=>$giro,
          "telefono"=>$telefono,
          "region"=>$nombreregion,
          "provincia"=>$nombreprovincia,
          "comuna"=>$comuna,
          "calle"=>$calle,
          "correo_electronico"=>$correo_electronico,
          "tipo_empresa"=>$tipo_oculto,
          "estado"=>$estado
      );
      $mensaje="";
	if($validar=="noexite"){
            $this->Modelo->almacenarproveedor($almacenar);
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
	$stock= $this->input->post("stock");
        $precio_bruto = $this->input->post("precio_bruto");
	$estado= "activo";
     $stock_actual=0;
        
        $guardar= array(
	"codigo_barra"=>$codigo,
	"nombre"=>$nombre,
	"descripcion"=>$descripcion,
        "idf_familia"=>$familia,
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
