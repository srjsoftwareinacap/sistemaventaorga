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
    function fetch_productos_admin($limit,$offsete,$rut_empresa){
    $query = $this->db->select("producto.codigo_barra,producto.nombre ,producto.descripcion,producto.stock_minimo,f.tipo_familia ,producto.estado");
     $query = $this->db->from("producto");
    $query = $this->db->join("familia f","f.id_familia = producto.idf_familia","inner");
      $query = $this->db->limit($limit, $offsete);
    $query = $this->db->get();
    return $query->result();
        
        
        
        
        
        
  }
  function adquerirfamilia(){
    $this->db->select("*");
        return $this->db->get('familia');
  }
    function total_productode_emresa($rut_empresa){
     $consulta ="select count(*) as datos from producto where rut_empresa_producto= '".$rut_empresa."' ";
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