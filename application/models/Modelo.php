<?php
class Modelo extends CI_Model{
    function  validarempresario($rut,$contraseña){
        $ver="";
        $this->db->select("*");
        $estado="activo";
        $this->db->where('rut_empresa',$rut);
        $this->db->where('contraseña',$contraseña);
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
    function mosedi_producto($codigo,$rut_empresa){
  $this->db->select("*");
  $this->db->where('codigo_barra',$codigo);
  $this->db->where('rut_empresa_producto',$rut_empresa);
        return $this->db->get('producto');
}
    function fetch_productos_admin($inicio,$limite,$rut_empresa){
    $query = $this->db->select("producto.codigo_barra,producto.nombre ,producto.descripcion,producto.precio_neto,producto.stock_minimo,producto.precio_bruto,f.tipo_familia ,producto.estado");
     $query = $this->db->from("producto");
    $query = $this->db->join("familia f","f.id_familia = producto.idf_familia","inner");
      $query = $this->db->limit($limite, $inicio);
    $query = $this->db->get();
    return $query->result();      
  }
  function adquerirfamilia(){
    $this->db->select("*");
        return $this->db->get('familia');
  }
  function buscar_producto_empresa($codigo,$rut_empresa){
   $consulta = $this->db->select("producto.codigo_barra,producto.nombre ,producto.descripcion,producto.precio_neto,producto.stock_minimo,producto.precio_bruto,f.tipo_familia ,producto.estado");
     $consulta = $this->db->from("producto");
    $consulta = $this->db->join("familia f","f.id_familia = producto.idf_familia","inner");
   $consulta=  $this->db->like("producto.codigo_barra",$codigo);
    $consulta= $this->db->Or_like("producto.nombre",$codigo);
   $consulta=  $this->db->where('rut_empresa_producto',$rut_empresa);
    $consulta = $this->db->get();
    return $consulta->result(); 
}
  function editarexistenteproductoempresa($codigo,$codigo_oculto,$rut_empresa,$editar){
    $this->db->where('codigo_barra',$codigo_oculto);
   $this->db->where("rut_empresa_producto",$rut_empresa);
    $this->db->update("producto",$editar);
     $consulta = "update inventario set codigo_barra_producto_inventario='".$codigo."' where codigo_barra_producto_inventario='".$codigo_oculto."' ";
          $this->db->query($consulta);
          return $mandar="si"; 
  }
  function desbloquiar_producto_empresa($codigo){
  $estado="activo";
    $consulta = "update producto set estado='".$estado."' where codigo_barra='".$codigo."' ";
    $this->db->query($consulta);

}
  function bloquiar_producto_empresa($codigo){
   $estado="bloquiado";
    $consulta = "update producto set estado='".$estado."' where codigo_barra='".$codigo."' ";
    $this->db->query($consulta);
} 
function editarproductoempresa($codigo,$codigo_oculto,$rut_empresa,$editar){
$this->db->select("*");
  $this->db->where('codigo_barra',$codigo);
  $consulta1= $this->db->get('producto');
      $mandar="";
if($consulta1->num_rows()==0){
   $this->db->where('codigo_barra',$codigo_oculto);
   $this->db->where("rut_empresa_producto",$rut_empresa);
    $this->db->update("producto",$editar);
     $consulta = "update inventario set codigo_barra_producto_inventario='".$codigo."' where codigo_barra_producto_inventario='".$codigo_oculto."' ";
          $this->db->query($consulta);
          $mandar="si";
}else{
$mandar="no";
}
return $mandar;
} 
  function verinventario($codigo,$rut_empresa){ 
  $tipo="entrada";
    $consulta = "SELECT MIN(stock_actual) as ver from inventario where codigo_barra_producto_inventario='".$codigo."' and rut_empresa_oculto='".$rut_empresa."' and tipo_oculto='".$tipo."'  ";
   return $this->db->query($consulta);    
  }
    function total_productode_emresa($rut_empresa){
     $consulta ="select count(*) as datos from producto  ";
    return $this->db->query($consulta);
  }
    function consultarutempresa($rut){
    $this->db->select("*");
        $this->db->where('rut_empresa',$rut);
        return  $this->db->get('empresa');
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