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
                              $contenido['proveedores']= $this->Modelo->adquerirproveedores()->result();
                        $this->load->view('administrador/ginventario/entradaproducto/header');
                        $this->load->view('administrador/ginventario/entradaproducto/content',$contenido);
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
        function cargarcodigo_proveedor(){
            $rut= $this->input->post("codigo");
            $verlista = $this->Modelo->verempresaespe($rut);
           $contenido['rut'] = $rut;
            foreach ($verlista->result() as $valor) {
             $contenido['nombre'] = $valor->nombre_empresa;
               $contenido['giro'] = $valor->giro;
               $contenido['telefono'] = $valor->telefono;
               $contenido['region'] = $valor->region;
               $contenido['provincia'] = $valor->provincia;
               $contenido['comuna'] = $valor->comuna;
               $contenido['calle'] = $valor->calle;
               $contenido['correo'] = $valor->correo_electronico;
            }
            $contenido['region'] = $this->Modelo->verregiones()->result();
            $this->load->view('administrador/ginventario/gestionproveedor/editarproveedor',$contenido);
            
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
        
        }
        $contenido['codigo_barra']=$codigo_barra;
        $contenido['nombre']=$nombre;
        $contenido['descripccion']=$descripccion;
        $contenido['idf_familia']= $idf_familia;
        
        $contenido['stock_minimo']= $stock_minimo;
        
        
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
            
            $stock_minimo = $this->input->post("stock_minimo");
            
            $codigo_viejo = $this->input->post("codigo_viejo");
            $mensaje="";
            
            $editar = array(
                "codigo_barra"=>$codigo_nuevo,
                "nombre"=>$nombre_nuevo,
                "descripcion"=>$descripcion,
                "idf_familia"=>$idf_familia,
                "stock_minimo"=>$stock_minimo
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
    $nombre_usuario = $this->session->userdata('nombre_u');
	$rut_empresa=$this->session->userdata('rut_empresa');
	date_default_timezone_set("America/Santiago");
	$fecha = date("Y-m-d");
        $tipo_oculto= "entrada";
        $guardar= array(
            "codigo_barra_producto_inventario" => $codigo_barra_producto,
            "fecha" => $fecha,
            "stock_actual" => $stock_ingresado,
            "nombre_usuario_registro" => $nombre_usuario,
            "rut_empresa_oculto" => $rut_empresa,
            "tipo_oculto"=>$tipo_oculto
        );
        $mensaje= $this->Modelo->registarentrada($codigo_barra_producto,$rut_empresa,$stock_ingresado,$fecha,$guardar,$nombre_usuario);
          echo json_encode(array("mensaj"=>$mensaje));

}
        function DesBloquiar_producto_empresar(){
	$codigo= $this->input->post("codigo");
	$this->Modelo->desbloquiar_producto_empresa($codigo);
    $data="xas";
    echo json_encode($data);
}
function DesBloquiar_proveedor(){
    $codigo= $this->input->post("codigo");
	$this->Modelo->desbloquiar_proveedor($codigo);
    $data="xas";
    echo json_encode($data);
}
        function vereficarinventario(){
	$codigoproducto= $this->input->post('codigos');
	$rut_empresa= $this->session->userdata('rut_empresa');
	$mensaje="";
	$nombre="";
	$descripcion="";
	$familia="";
	$stock_minimo=0;
        $precio_bruto=0;
	$cantidadmaxima=0;
	$mensaje="";
	$info= $this->Modelo->vareficcar_entrada_productoinventario($codigoproducto,$rut_empresa);
if($info=="Se ha encontrado producto"){
$ver12 = $this->Modelo->verificar_bloproductoinventario($codigoproducto,$rut_empresa);
		if($ver12=="activo"){
			$mensaje="Producto en registro";
			$dato = $this->Modelo->obtener_productoinventario2($codigoproducto,$rut_empresa);
			foreach ($dato->result() as $variable) {
		$nombre = $variable->nombre;
	$descripcion = $variable->descripcion;
	$familia = $variable->tipo_familia;
	$stock_minimo = $variable->stock_minimo;
        $precio_bruto = $variable->precio_bruto;
	}
	$inventario= $this->Modelo->selecionar_entrada_productoinventario($codigoproducto,$rut_empresa);
	foreach ($inventario->result() as $valor ) {
		$cantidadmaxima = $valor->stock_actual;
	}
		}else{
			$mensaje="Producto bloqueado";
		}
}else{
$mensaje=$info;
}
		echo json_encode(array(
		"m1"=>$mensaje,
		"nombre"=>$nombre,
		"descripcion"=>$descripcion,
		"familia"=>$familia,
		"stock_minimo"=>$stock_minimo,
                "precio_bruto"=>$precio_bruto,
		"stock_maximo"=>$cantidadmaxima
		));
}
function registrar_salida(){
    $codigo= $this->input->post("codigo_barra");
	$cantidad_salida= $this->input->post("stock_ingresado");
	$nombre_usuario = $this->session->userdata('nombre_u');
	$rut_empresa=$this->session->userdata('rut_empresa');
	date_default_timezone_set("America/Santiago");
	$fecha =date("Y-m-d");
 	$tipo="salida";
 	$estado="activo";
 	$guardar = array(
 		"codigo_barra_producto_inventario"=>$codigo,
 		"fecha"=>$fecha,
 		"stock_actual"=>$cantidad_salida,
 		"nombre_usuario_registro"=>$nombre_usuario,
 		"rut_empresa_oculto"=>$rut_empresa,
 		"tipo_oculto"=>$tipo
 		);
 	$info1=$this->Modelo->registrarsalida($codigo,$rut_empresa,$cantidad_salida,$fecha,$guardar,$nombre_usuario);
 	echo json_encode(array("mensaj"=>$info1));
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
	$estado= "activo";
     $stock_actual=0;
        
        $guardar= array(
	"codigo_barra"=>$codigo,
	"nombre"=>$nombre,
	"descripcion"=>$descripcion,
        "idf_familia"=>$familia,
        
        "stock_minimo"=>$stock,
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
