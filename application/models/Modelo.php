<?php
class Modelo extends CI_Model{
    function  validarempresario($rut,$contraseña){
        
        
        $this->db->select("*");
        $estado="activo";
        $this->db->where('rut_empresa',$rut);

        $this->db->where('estado',$estado);
        $resultado = $this->db->get('empresa');
        if($resultado->num_rows()==0){
             $this->db->select("*");
        $estado="activo";
        $this->db->where('rut_usuario',$rut);
        $this->db->where('contraseña',$contraseña);
        $this->db->where('estado',$estado);
        $resultado1 = $this->db->get('usuario_empresa');
        if($resultado1->num_rows()==0){
            $ver="error";
        }else{
            $ver="usuario";
        }
        }else{
            $ver="empresa";
        }
        return $ver;
    }
    function mosedi_producto($codigo){
  $this->db->select("*");
  $this->db->where('codigo_barra',$codigo);
  
        return $this->db->get('producto');
}

function VerUsuario($rutempresa){
    $perfil=50;
     $this->db->select("*");
  $this->db->where('rut_empresa_peterneciente',$rutempresa);
  $this->db->where('perfil_usuario',$perfil);
        return $this->db->get('usuario_empresa');
}
    function fetch_productos_admin($inicio,$limite,$rut_empresa){
    $query = $this->db->select("producto.codigo_barra,producto.nombre ,producto.descripcion,producto.stock_minimo,producto.precio_bruto,f.tipo_familia ,producto.estado");
     $query = $this->db->from("producto");
    $query = $this->db->join("familia f","f.id_familia = producto.idf_familia","inner");
      $query = $this->db->limit($limite, $inicio);
    $query = $this->db->get();
    return $query->result();      
  }
  function verentradas($rut_proveedor,$numero_factura){
      $this->db->select("*");
      $this->db->where("rut_proveedor",$rut_proveedor);
      $this->db->where("numero_factura",$rut_proveedor);
  $captar  =$this->db->get("entrada");
  if($captar->num_rows()==0){
      $mensaje="si";
  }else{
      $mensaje="no";
  }
  return $mensaje;
  }
          function  ver_proveedor($inicio,$limite,$rut_empresa){
      $ver ="proveedor";
      $query = $this->db->select("*");
      $query = $this->db->from("empresa");
      $query = $this->db->where('tipo_empresa',$ver);
      $query = $this->db->limit($limite, $inicio);
    $query = $this->db->get();
    return $query->result(); 
  }
  function ver_salidas($inicio,$limite){
      date_default_timezone_set("America/Santiago");
	$fecha =date("Y-m-d");
      $query = $this->db->select("p.codigo_barra, p.nombre,deesa.cantidad,em.nombre_empresa,DATE_FORMAT(sa.fecha, '%d-%m-%Y') as fecha");
      $query = $this->db->from("producto p");
    $query = $this->db->join("detalle_salida deesa ","deesa.codigo_barra_salida = p.codigo_barra","inner");
    $query = $this->db->join("salida sa","sa.id_salida = deesa.idf_salida","inner");
    $query = $this->db->join("empresa em","em.rut_empresa = sa.rut_proveedor","inner");
    $query =$this->db->order_by("sa.fecha",$fecha);
     $query= $this->db->limit($limite, $inicio);
     $query = $this->db->get();
    return $query->result();
  }
  
          function ver_entradas($inicio,$limite){
              date_default_timezone_set("America/Santiago");
	$fecha =date("Y-m-d");
      $query = $this->db->select("p.codigo_barra, p.nombre, p.descripcion,t.tipo_familia,dee.cantidad,DATE_FORMAT(en.fecha, '%d-%m-%Y') as fecha");
      $query = $this->db->from("producto p");
    $query = $this->db->join("familia t","t.id_familia = p.idf_familia","inner");
    $query = $this->db->join("detalle_entrada dee","dee.codigo_barra_entrada = p.codigo_barra","inner");
    $query = $this->db->join("entrada en","en.id_entrada = dee.idf_entrada","inner");
   $query = $this->db->order_by("en.fecha",$fecha);
     $query= $this->db->limit($limite, $inicio);
     $query = $this->db->get();
    return $query->result(); 
  }
  function buscar_entrada_empresa($codigo,$rut_empresa){
      $query = $this->db->select("p.codigo_barra, p.nombre, p.descripcion,t.tipo_familia,dee.cantidad,DATE_FORMAT(en.fecha, '%d-%m-%Y') as fecha");
      $query = $this->db->from("producto p");
    $query = $this->db->join("familia t","t.id_familia = p.idf_familia","inner");
    $query = $this->db->join("detalle_entrada dee","dee.codigo_barra_entrada = p.codigo_barra","inner");
    $query = $this->db->join("entrada en","en.id_entrada = dee.idf_entrada","inner");
    $query = $this->db->like('p.codigo_barra',$codigo);
    $query= $this->db->Or_like("p.nombre",$codigo);
     $query = $this->db->get();
    return $query->result();
  }
  function buscar_salidas_empresa($codigo){
      $query = $this->db->select("p.codigo_barra, p.nombre,deesa.cantidad,em.nombre_empresa,DATE_FORMAT(sa.fecha, '%d-%m-%Y') as fecha");
      $query = $this->db->from("producto p");
    $query = $this->db->join("detalle_salida deesa ","deesa.codigo_barra_salida = p.codigo_barra","inner");
    $query = $this->db->join("salida sa","sa.id_salida = deesa.idf_salida","inner");
    $query = $this->db->join("empresa em","em.rut_empresa = sa.rut_proveedor","inner");
  $query = $this->db->like('p.codigo_barra',$codigo);
    $query= $this->db->Or_like("p.nombre",$codigo);
     $query = $this->db->get();
    return $query->result();
  }
          function buscar_proveedor($codigo){
      $ver ="proveedor";
      $query = $this->db->select("*");
      $query = $this->db->from("empresa");
      $query = $this->db->like('rut_empresa',$codigo);
    $query= $this->db->Or_like("nombre_empresa",$codigo);
     $query = $this->db->where('tipo_empresa',$ver);
    $query = $this->db->get();
    return $query->result(); 
  }
          function adquerirfamilia(){
    $this->db->select("*");
        return $this->db->get('familia');
  }
  function adquerirproveedores(){
      $ver ="proveedor";
      $this->db->select("*");
      $this->db->where('tipo_empresa',$ver);
      return $this->db->get('empresa');
  }
          function buscar_producto_empresa($codigo,$rut_empresa){
   $consulta = $this->db->select("producto.codigo_barra,producto.nombre ,producto.descripcion,producto.stock_minimo,producto.precio_bruto,f.tipo_familia ,producto.estado");
     $consulta = $this->db->from("producto");
    $consulta = $this->db->join("familia f","f.id_familia = producto.idf_familia","inner");
   $consulta=  $this->db->like("producto.codigo_barra",$codigo);
    $consulta= $this->db->Or_like("producto.nombre",$codigo);
    $consulta = $this->db->get();
    return $consulta->result(); 
}
function obtener_productoinventario2($codigoproducto){
    $consulta = $this->db->select("producto.codigo_barra,producto.nombre ,producto.descripcion,producto.stock_minimo,producto.precio_bruto,f.tipo_familia ,producto.estado");
     $consulta = $this->db->from("producto");
    $consulta = $this->db->join("familia f","f.id_familia = producto.idf_familia","inner");
   $consulta=  $this->db->where('producto.codigo_barra',$codigoproducto);
    $consulta = $this->db->get();
    return $consulta; 
  }
  function selecionar_entrada_productoinventario($codigoproducto){
    $this->db->select("*");
    $this->db->where("codigo_barra_entrada",$codigoproducto);
    return $this->db->get("detalle_entrada");
  }
  
  function editarproveedor($editar,$rut){
      $this->db->where('rut_empresa',$rut);
   
    $this->db->update("empresa",$editar); 
  }
          function editarexistenteproductoempresa($codigo,$codigo_oculto,$editar){
    $this->db->where('codigo_barra',$codigo_oculto);
   
    $this->db->update("producto",$editar);
     $consulta = "update detalle_entrada set codigo_barra_entrada='".$codigo."' where codigo_barra_entrada='".$codigo_oculto."' ";
          $this->db->query($consulta);
          return $mandar="si"; 
  }
  function desbloquiar_producto_empresa($codigo){
  $estado="activo";
    $consulta = "update producto set estado='".$estado."' where codigo_barra='".$codigo."' ";
    $this->db->query($consulta);

}
function desbloquiar_proveedor($codigo){
    $estado="activo";
    $consulta = "update empresa set estado='".$estado."' where rut_empresa='".$codigo."' ";
    $this->db->query($consulta);
}
        function  versiestabn($codigo){
    $this->db->select("*");
    $this->db->where("codigo_barra",$codigo);
    $captarinventario= $this->db->get("producto");
    if($captarinventario->num_rows()==0){
      $mensaje="si";
    }else{
      $mensaje="no";
    
    }
    return $mensaje;
}
// function registrarsalida($codigo,$rut_empresa,$cantidad_salida,$fecha,$guardar,$nombre_usuario){
//    $tipo="entrada";
//    $this->db->select("cantidad");
//   $this->db->where('codigo_barra_producto_inventario',$codigo);
//   $this->db->where('rut_empresa_oculto',$rut_empresa);
//   $this->db->where('tipo_oculto',$tipo);     
//   $captar1= $this->db->get('inventario')->result();
//   $stock= 0;
//   foreach ($captar1 as $fila ) {
//     $stock= $fila->cantidad;
//   }
//   $datoinventario['fecha']=$fecha;
//   $datoinventario['cantidad']=$stock-$cantidad_salida;
//   $datoinventario['nombre_usuario_registro']=$nombre_usuario;
//   $this->db->where('codigo_barra_producto_inventario',$codigo);
//   $this->db->where('rut_empresa_oculto',$rut_empresa);
//   $this->db->where('tipo_oculto',$tipo);
//   $this->db->update('inventario',$datoinventario);
//   $mensaje="Producto Retirado Exitosamente";
//
//   $this->db->insert("inventario",$guardar);
//return $mensaje;
//  }
    function registrarsalida($codigo_barra,$cantidad,$guardar,$idf_salida){
        $this->db->insert("detalle_salida",$guardar);
        
        $this->db->where('codigo_barra',$codigo_barra);
        $restar= $this->db->get("stock_inventario");
        $stock=0;
        foreach ($restar->result() as $valor) {
            $stock = $valor->cantidad;
        }
        $datomodificar['cantidad'] = $stock-$cantidad;
        $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update('stock_inventario',$datomodificar);
        return "se a registrado salida de Producto";
    }
            function versalidas($rut_proveedor,$numero_factura){
   $this->db->select("*");
   $this->db->where('rut_proveedor',$rut_proveedor);
   $this->db->where('numero_factura_despacho',$numero_factura);     
   $captar1= $this->db->get('salida');
   $mensaje="";
 if($captar1->num_rows()==0){
     $mensaje="no existe";
 }else{
     $mensaje="existe";
 }
 return $mensaje;
  }
  function  vercantidad($codigo){
    $mensaje="";
    $this->db->select("*");
    $this->db->where("codigo_barra",$codigo);
    $captarinventario= $this->db->get("stock_inventario");
    if($captarinventario->num_rows()==0){
        $mensaje="no";
    }else{
        $mensaje="si";
    }
    return $mensaje;
  }
  function obtenerinventario($codigo){
       $this->db->select("*");
    $this->db->where("codigo_barra",$codigo);
     return $this->db->get("stock_inventario");
  }
  function obtenersalidas($rut_proveedor,$numero_factura){
      $this->db->select("*");
    $this->db->where("rut_proveedor",$rut_proveedor);
    $this->db->where("numero_factura_despacho",$numero_factura);
     return $this->db->get("salida");
  }
          function vareficcar_entrada_productoinventario($codigoproducto){ 
    $mensaje="";
    $this->db->select("*");
    $this->db->where("codigo_barra",$codigoproducto);
    $captarinventario= $this->db->get("producto");
    if($captarinventario->num_rows()==0){
      $mensaje="El registro de Producto no existe";
    }else{
      $mensaje="Se ha encontrado Producto";
    }
    return $mensaje;
  }
  function almacenarsalida1($rut_proveedor,$numero_factura,$guardar){
      $this->db->select("*");
    $this->db->where("rut_proveedor",$rut_proveedor);
    $this->db->where("numero_factura_despacho",$numero_factura);
    $captarsalidas= $this->db->get("salida");
    $mensaje="";
    if($captarsalidas->num_rows()==0){
        $this->db->insert("salida",$guardar);
        $mensaje="Factura Registrada";
    }else{
        $mensaje="Error, Factura no Registrada";
    }
    return $mensaje;
  }
          function registarentrada($codigo_barra_producto,$idf_entrada,$stock_ingresado,$guardar,$precio_neto){
   $this->db->select("*");
   $this->db->where('codigo_barra',$codigo_barra_producto);
   $captar= $this->db->get('stock_inventario');
   $mensaje="";
   $guardar2= array(
       "codigo_barra"=>$codigo_barra_producto,
       "cantidad"=>$stock_ingresado
   );
   if($captar->num_rows()==0){
    $this->db->insert("stock_inventario",$guardar2);
    $mensaje="Se registro nuevo inventario";
   }else{
     
    $this->db->select("*");
   $this->db->where('codigo_barra',$codigo_barra_producto);   
   $captar1= $this->db->get('stock_inventario')->result();
   $id_codigo=0;
   $stock= 0;
   foreach ($captar1 as $fila ) {
       $id_codigo= $fila->id_codigo;
     $stock= $fila->cantidad;
   }

   
   $datoinventario['cantidad']=$stock+$stock_ingresado;
   $this->db->where('id_codigo',$idf_entrada);
   $this->db->where('codigo_barra',$codigo_barra_producto);
   $this->db->update('stock_inventario',$datoinventario);
   $mensaje="Se registro  inventario";
   }
   $this->db->insert("detalle_entrada",$guardar);
   return $mensaje;
  }
function verificar_bloproductoinventario($codigo){
    $estado="activo";
   $this->db->select("*");
   $this->db->where('codigo_barra',$codigo);
   $this->db->where('estado',$estado);
   $captar= $this->db->get('producto');
   $mensaje="";
   if($captar->num_rows()==0){
    $mensaje="bloquiado";
   }else{
    $mensaje="activo";
   }
   return $mensaje;
  }
          function bloquiar_producto_empresa($codigo){
   $estado="bloquiado";
    $consulta = "update producto set estado='".$estado."' where codigo_barra='".$codigo."' ";
    $this->db->query($consulta);
} 
function bloquiar_proveedor($codigo){
    $estado="bloquiado";
    $consulta = "update empresa set estado='".$estado."' where rut_empresa='".$codigo."' ";
    $this->db->query($consulta);
}
        function consulrutprove($rute){
    $this->db->select("*");
  $this->db->where('rut_empresa',$rute);
  $consulta1= $this->db->get('empresa');
   $mandar="";
  if($consulta1->num_rows()==0){
       $mandar="noexite";
  }else{
      $mandar="siexiste";
  }
  return $mandar;
}
        function editarproductoempresa($codigo,$codigo_oculto,$editar){
$this->db->select("*");
  $this->db->where('codigo_barra',$codigo);
  $consulta1= $this->db->get('producto');
      $mandar="";
if($consulta1->num_rows()==0){
   $this->db->where('codigo_barra',$codigo_oculto);
    $this->db->update("producto",$editar);
    
     $consulta = "update detalle_entrada set codigo_barra_entrada='".$codigo."' where codigo_barra_entrada='".$codigo_oculto."' ";
          $this->db->query($consulta);
          $mandar="si";
}else{
$mandar="no";
}
return $mandar;
} 
function verinventariosio($codigo){
    $this->db->select("*");
  $this->db->where('codigo_barra',$codigo);
  $consulta1= $this->db->get('stock_inventario');
  if($consulta1->num_rows()==0){
      $mandar="no";
  }else{
      $mandar="si";
  }
  return $mandar;
}
        function verinventario($codigo){ 
    $consulta = "SELECT cantidad as ver from stock_inventario where codigo_barra='".$codigo."'  ";
   return $this->db->query($consulta);    
  }
    function total_productode_emresa($rut_empresa){
     $consulta ="select count(*) as datos from producto";
    return $this->db->query($consulta);
  }
  function total_entradas(){
      $consulta = "select count(*) as datos from detalle_entrada";
      return $this->db->query($consulta);
  }
  function total_salidas(){
      $consulta = "select count(*) as datos from detalle_salida";
      return $this->db->query($consulta); 
  }
          function  total_proveedor_($rut_empresa){
      $tipo_empresa ="proveedor";
      $consulta = "select count(*) as datos from empresa where tipo_empresa ='".$tipo_empresa."'";
      return $this->db->query($consulta);
  }
          function consultarutempresa($rut){
    $this->db->select("*");
        $this->db->where('rut_empresa',$rut);
        return  $this->db->get('empresa');
  }
  function verempresaespe($rut){
      $this->db->select("*");   
      $this->db->where('rut_empresa',$rut);
        return  $this->db->get('empresa');
  }
          function  verregiones(){
      $this->db->select("*");    
        return  $this->db->get('regiones');
  }
  function verprovincias($codigo){
      $this->db->select("*");
      $this->db->where('regionf_id',$codigo);
      return $this->db->get("provincias");
  }
  function  consulprovincia($codigo){
      $this->db->select("*");
      $this->db->where('provincia_id',$codigo);
      return $this->db->get("provincias");
  }
  function consulregion($id_region){
      $this->db->select("*");
      $this->db->where('region_id',$id_region);
      return $this->db->get("regiones");
  }
          function  vercomunas($codigo){
      $this->db->select("*");
      $this->db->where('provinciaf_id',$codigo);
      return $this->db->get("comunas");
  }
          function consultaPerfil($rut){
    	  	  $this->db->select("perfil");
      $this->db->where('rut_empresa',$rut);
      $respuesta = $this->db->get("empresa");
      foreach ($respuesta->result() as $valor){
          $perfil= $valor->perfil;
      }
      return $perfil;
    }
    function almacenarproveedor($almacenar){
         $this->db->insert("empresa",$almacenar);
    }
 function   alamacenarnetrada($guardar){
     $this->db->insert("entrada",$guardar);
 }
            function guardarproducto($codigo,$guardar){
        $this->db->select("*");
   $this->db->where('codigo_barra',$codigo);     
        $resultado= $this->db->get('producto');
        $mandar="";
if($resultado->num_rows()==0){
  $this->db->insert("producto",$guardar);
 $mandar="si";
}else{
   $mandar="no";
}
return $mandar;
  
    }
    function  selleccionarentradaproveedor($rut_proveedor,$numero_factura){
        $this->db->select("*");
   $this->db->where('rut_proveedor',$rut_proveedor);
   $this->db->where('numero_factura',$numero_factura);
        return $this->db->get('entrada');
    }
            function verentrada($numero_factura,$rut_proveedor){
       $this->db->select("*");
   $this->db->where('rut_proveedor',$rut_proveedor);
   $this->db->where('numero_factura',$numero_factura);
        $resultado= $this->db->get('entrada');
        $mandar="";
        if($resultado->num_rows()==0){
            $mandar="no existe";
        }else{
            $mandar="existe";
        }
        return $mandar;
    } 
    function guardarfamilia($tipo_familia,$guardar){
        $this->db->select("*");
   $this->db->where('tipo_familia',$tipo_familia);     
        $resultado= $this->db->get('familia');
        $mandar="";
        if($resultado->num_rows()==0){
          $this->db->insert("familia",$guardar);
 $mandar="si";  
        }else{
            $mandar="no";
        }
        return $mandar;
    }
            function consultarutem($rut){
     $this->db->select("*");
        $this->db->where('rut_usuario',$rut);
        return  $this->db->get('usuario_empresa');  
    }
    function consultaPerfilempresa($rut){
     $this->db->select("perfil_usuario");
      $this->db->where('rut_usuario',$rut);
      $respuesta = $this->db->get("usuario_empresa");
      foreach ($respuesta->result() as $valor){
          $perfil= $valor->perfil_usuario;
      }
      return $perfil; 
    }
}