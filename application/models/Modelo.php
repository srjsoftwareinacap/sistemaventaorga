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
    function verusuariomodificado($rutcaptar,$perfil_cokie){
        $this->db->select("*");
        $this->db->where('rut_usuario',$rutcaptar);
        $resultado1 = $this->db->get('usuario_empresa');
        if($resultado1->num_rows()==0){
            $mensaje="destruir";
            session_destroy();
            redirect(base_url());
        }else{
            $perfil=0;
            foreach ($resultado1->result() as $valor) {
                $perfil = $valor->perfil_usuario;
            }
            if($perfil!=$perfil_cokie){
                $mensaje="destruir";
                session_destroy();
                redirect(base_url());
            }
            
        }
        return mensaje;
    }
            function mosedi_producto($codigo){
  $this->db->select("*");
  $this->db->where('codigo_barra',$codigo);
  
        return $this->db->get('producto');
}
function total_ordendeentrada(){
    $this->db->select("count(*) as datos");
    $this->db->where('estado',"pendiente");
     return $this->db->get('orden_reparacion');
}
function total_usuario(){
    $perfil=50;
    $this->db->select("count(*) as datos");
    $this->db->where('perfil_usuario',$perfil);
  return $this->db->get('usuario_empresa');
}
        function aquerirmedio(){
     $this->db->select("*");
     return $this->db->get('medio_pago');
}

        function VerUsuario($inicio,$limite){
    
    $query = $this->db->select("*"); 
     $query = $this->db->from("usuario_empresa");

$query = $this->db->limit($limite, $inicio);
$query = $this->db->get();
  return $query->result(); 
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
      $this->db->where("numero_factura",$numero_factura);
  $captar  =$this->db->get("entrada");
  if($captar->num_rows()==0){
      $mensaje="si";
  }else{
      $mensaje="no";
  }
  return $mensaje;
  }
  function verestableventa($rut){
    $estado="pendiente";
    $this->db->select("*");
    $this->db->where('rut_vendedor',$rut);
    $this->db->where('estado',$estado);
    $captar= $this->db->get('venta');
    $mensaje="";
    if($captar->num_rows()==0){
        $mensaje="nuevaventa";
    }else{
        if($captar->num_rows()==1){
        $mensaje="seleccionarmax";    
        }else{
            if($captar->num_rows()>=2){
                $mensaje="error";
            }
        }
        
    }
    return  $mensaje;
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
  function sacarusurios(){
      $query = $this->db->select("*");
      $query = $this->db->from("usuario_empresa");
      $query = $this->db->get();
      return $query;
  }
          function  adqueridetallerordenproducto($codigo){
     $query = $this-> db->select("dere.id_detalle_reparacion,dere.idf_orden,pro.nombre,dere.precio_bruto,dere.cantidad");
     $query=$this->db->from("detalle_reparacion dere");
     $query = $this->db->join("producto pro","pro.codigo_barra = dere.codigof_producto","inner");
     $query = $this->db->where("dere.idf_orden",$codigo);
     $query = $this->db->get();
     return $query->result();
  }
  function adquerirusuariosgrafico1($codigo){
      $año =date("Y");
      $primero = "SET lc_time_names = 'es_cl'";
      $this->db->query($primero);
      $consulta ="SELECT SUM(venta.total) as venta ,MONTHNAME(venta.fecha) as mes, usuario_empresa.nombre_usuario,MONTH(venta.fecha)  from venta INNER JOIN usuario_empresa on venta.rut_vendedor= usuario_empresa.rut_usuario where venta.fecha like '".$año."-%-%'   GROUP by usuario_empresa.nombre_usuario, mes,MONTH(venta.fecha) ORDER by MONTH(venta.fecha)";
return $this->db->query($consulta)->result();
  }
  function adquerirusuariosgrafico2($codigo){
      $año =date("Y");
      $primero = "SET lc_time_names = 'es_cl'";
      $this->db->query($primero);
      $consulta ="SELECT SUM(venta.total) as venta,MONTHNAME(venta.fecha) as mes,MONTH(venta.fecha) as numero from venta where venta.fecha like '".$año."-%-%' GROUP by mes,numero ORDER by numero";
return $this->db->query($consulta)->result();
  }
  function adquerorusuariosgrafico3($codigo){
      $año =date("Y");
      $primero = "SET lc_time_names = 'es_cl'";
      $this->db->query($primero);
      $consulta ="SELECT SUM(orden_reparacion.total) as total, MONTHNAME(orden_reparacion.fecha_entrega) as mes,usuario_empresa.nombre_usuario, MONTH(orden_reparacion.fecha_entrega) as numero FROM orden_reparacion INNER JOIN usuario_empresa on orden_reparacion.rut_vendedor = usuario_empresa.rut_usuario WHERE orden_reparacion.fecha_entrega LIKE '".$año."-%-%' AND orden_reparacion.estado = 'imprimir' GROUP by usuario_empresa.nombre_usuario,mes, numero ORDER by numero";
return $this->db->query($consulta)->result();
  }
  function adquerorusuariosgrafico3buscar($codigo){
      $año =date("Y");
      $primero = "SET lc_time_names = 'es_cl'";
      $this->db->query($primero);
      $consulta ="SELECT SUM(orden_reparacion.total) as total, MONTHNAME(orden_reparacion.fecha_entrega) as mes,usuario_empresa.nombre_usuario, MONTH(orden_reparacion.fecha_entrega) as numero FROM orden_reparacion INNER JOIN usuario_empresa on orden_reparacion.rut_vendedor = usuario_empresa.rut_usuario WHERE orden_reparacion.fecha_entrega LIKE '".$año."-%-%' AND orden_reparacion.estado = 'imprimir' and orden_reparacion.rut_vendedor ='".$codigo."' GROUP by usuario_empresa.nombre_usuario,mes, numero ORDER by numero";
return $this->db->query($consulta)->result();
  }
  function adquerorusuariosgrafico4($codigo){
      $año =date("Y");
      $primero = "SET lc_time_names = 'es_cl'";
      $this->db->query($primero);
      $consulta ="SELECT SUM(orden_reparacion.total) as venta,MONTHNAME(orden_reparacion.fecha_entrega) as mes,MONTH(orden_reparacion.fecha_entrega) as numero from orden_reparacion where orden_reparacion.fecha_entrega like '".$año."-%-%' and orden_reparacion.estado='imprimir' GROUP by mes,numero ORDER BY numero";
return $this->db->query($consulta)->result();
  }
          function adquerirusuariosgraficobuscar($codigo){
              $año =date("Y");
      $primero = "SET lc_time_names = 'es_cl'";
      $this->db->query($primero);
      $consulta ="SELECT SUM(venta.total) as venta ,MONTHNAME(venta.fecha) as mes, usuario_empresa.nombre_usuario,MONTH(venta.fecha)  from venta INNER JOIN usuario_empresa on venta.rut_vendedor= usuario_empresa.rut_usuario where venta.fecha like '".$año."-%-%' and venta.rut_vendedor ='".$codigo."'  GROUP by usuario_empresa.nombre_usuario, mes,MONTH(venta.fecha) ORDER by MONTH(venta.fecha)";
return $this->db->query($consulta)->result();
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
  function obtenerorden($inicio,$limite){
      date_default_timezone_set("America/Santiago");
	$fecha =date("Y-m-d");
      $estado="pendiente";
      $query = $this->db->select("id_orden,DATE_FORMAT(fecha_recepcion, '%d-%m-%Y') as fecha,nombre_cliente,rut,direccion,telefono,modelo,marca,serie,descripcion_falla");
      $query = $this->db->from("orden_reparacion");
      $query = $this->db->where("estado",$estado);
      $query =$this->db->order_by("fecha_recepcion",$fecha);
      $query= $this->db->limit($limite, $inicio);
     $query = $this->db->get();
    return $query->result();
  }
function obtenerordenimprimir($inicio,$limite){
  date_default_timezone_set("America/Santiago");
	$fecha =date("Y-m-d");
      $estado="imprimir";
      $query = $this->db->select("id_orden,DATE_FORMAT(fecha_recepcion, '%d-%m-%Y') as fecha,nombre_cliente,rut,direccion,telefono,modelo,marca,serie,descripcion_falla");
      $query = $this->db->from("orden_reparacion");
      $query = $this->db->where("estado",$estado);
      $query =$this->db->order_by("fecha_recepcion",$fecha);
      $query= $this->db->limit($limite, $inicio);
     $query = $this->db->get();
    return $query->result();  
}
          function obtenerordenbuscar($rut){
      $query = $this->db->select("id_orden,DATE_FORMAT(fecha_recepcion, '%d-%m-%Y') as fecha,nombre_cliente,rut,direccion,telefono,modelo,marca,serie,descripcion_falla");
      $query = $this->db->from("orden_reparacion");
      
      $query = $this->db->like('rut',$rut);
     $query = $this->db->get();
    return $query->result();
  }
  function obtenerordenbuscarretiro($codigo){
      $query = $this->db->select("id_orden,DATE_FORMAT(fecha_recepcion, '%d-%m-%Y') as fecha,nombre_cliente,rut,direccion,telefono,modelo,marca,serie,descripcion_falla");
      $query = $this->db->from("orden_reparacion");
      
      $query = $this->db->like('rut',$codigo);
     $query = $this->db->get();
    return $query->result();
  }
  function verordenimprimir($codigo){
      date_default_timezone_set("America/Santiago");
	$fecha =date("Y-m-d");
      $estado="imprimir";
      $query = $this->db->select("id_orden,DATE_FORMAT(fecha_recepcion, '%d-%m-%Y') as fecha_recepcion,DATE_FORMAT(fecha_entrega, '%d-%m-%Y') as fecha_entrega,nombre_cliente,rut,direccion,telefono,modelo,marca,cadena,serie,descripcion_falla,mano_de_obra,descripcion,total,descuento_especial");   
      $query = $this->db->from("orden_reparacion");
      $query = $this->db->where("id_orden",$codigo);
     $query = $this->db->get();
    return $query;  
  }
          function sumatotaldeproductos(){
      $this->db->select("SUM(cantidad)");
  return $this->db->get("stock_inventario")->result();
  }
          function ver_productosexistentes($inicio,$limite){
      $query = $this->db->select("p.codigo_barra,p.nombre,p.descripcion,f.tipo_familia,p.stock_minimo,sto.cantidad");
      $query = $this->db->from("producto p");
      $query = $this->db->join("familia f ","f.id_familia = p.idf_familia","inner");
      $query = $this->db->join("stock_inventario sto ","sto.codigo_barra = p.codigo_barra","inner");
      $query= $this->db->limit($limite, $inicio);
     $query = $this->db->get();
    return $query->result();
  }
  function buscar_usuario_empresa($codigo,$rut_empresa){
        $query = $this->db->select("*"); 
     $query = $this->db->from("usuario_empresa");
     $query = $this->db->like('usuario_empresa.rut_usuario',$codigo);
    $query= $this->db->Or_like("usuario_empresa.nombre_usuario",$codigo);
     $query = $this->db->get();
    return $query->result();
  }
  
          function buscar_productosexistentes($codigo){
      $query = $this->db->select("p.codigo_barra,p.nombre,p.descripcion,f.tipo_familia,p.stock_minimo,sto.cantidad");
      $query = $this->db->from("producto p");
      $query = $this->db->join("familia f ","f.id_familia = p.idf_familia","inner");
      $query = $this->db->join("stock_inventario sto ","sto.codigo_barra = p.codigo_barra","inner");
      $query = $this->db->like('sto.codigo_barra',$codigo);
    $query= $this->db->Or_like("p.nombre",$codigo);
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
  function adquerirdetalle($codigo){
      $query = $this->db->select("p.nombre,d.cantidad,d.precio_bruto");
      $query = $this->db->from("producto p");
      $query = $this->db->join("detalle_reparacion d","d.codigof_producto = p.codigo_barra","inner");
      $query = $this->db->where("d.idf_orden",$codigo);
      $query = $this->db->get();
    return $query;
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
      $this->db->where('estado',"activo");
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
  function editarusuario($rut,$Editar){
      $this->db->where("rut_usuario",$rut);
      $this->db->update("usuario_empresa",$Editar);
      return "listo";
  }
          
  function editarproveedor($editar,$rut){
      $this->db->where('rut_empresa',$rut);
   
    $this->db->update("empresa",$editar); 
  }
  function actualizarinventario($codigo,$stockactual){
      $datoeditar['cantidad']= $stockactual;
      $this->db->where('codigo_barra',$codigo);
      $this->db->update("stock_inventario",$datoeditar);
      return "si";
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
    function  almacenardetalleventa($detalle_venta,$codigo_barra,$id_venta,$cantidad){
         $this->db->select("*");
         $this->db->where('codigo_detalle_venta',$id_venta);
         $this->db->where('codigo_producto_detalle',$codigo_barra);
         $verificar =$this->db->get('detalle_venta');
         $mensaje="";
         if($verificar->num_rows()==0){
             $this->db->insert("detalle_venta",$detalle_venta);
             $mensaje=" Producto registrado";
         }else{
             $this->db->select("*");
         $this->db->where('codigo_detalle_venta',$id_venta);
         $this->db->where('codigo_producto_detalle',$codigo_barra);
         $sacar =$this->db->get('detalle_venta');
         $cantidad_detalle = 0;
         $suma=0;
         $id_detalle=0;
         foreach ($sacar->result() as $fila ) {
             $id_detalle= $fila->id_detalle;
     $cantidad_detalle= $fila->cantidad;   
     
         }
         $data['cantidad']=$cantidad+$cantidad_detalle;
         $this->db->where('id_detalle',$id_detalle);
         $this->db->where('codigo_detalle_venta',$id_venta);
         $this->db->where('codigo_producto_detalle',$codigo_barra);
         $this->db->update('detalle_venta',$data);
         $mensaje="se ha sumado producto";
         }
         $this->db->where('codigo_barra',$codigo_barra);
         $ob =$this->db->get('stock_inventario');
         foreach ($ob->result() as $fila ) {
     $cantidad_stock= $fila->cantidad;   
         }
         $variable['cantidad']= $cantidad_stock-$cantidad;
         $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update('stock_inventario',$variable);
         
         return $mensaje;
    }
            function crearnuevaventa($rut){
        $crear = array( 
            "fecha"=>"",
            "rut_vendedor"=>$rut,
            "idf_medio"=>"",
            "rut_comprador"=>"",
            "sub_total"=>"",
            "iva"=>"",
            "descuento"=>"",
            "total"=>"",
            "estado"=>"pendiente"
            );
        $this->db->insert("venta",$crear);
        
        $estado="pendiente";
        $this->db->where('rut_vendedor',$rut);
        $this->db->where('estado',$estado);
        return $this->db->get("venta");
    }
    
            function vermaximo($rut){
        $estado="pendiente";
        $this->db->where('rut_vendedor',$rut);
        $this->db->where('estado',$estado);
        return $this->db->get("venta");
    }
    function guardarorden($guardar){
        $this->db->insert("orden_reparacion",$guardar);
        return "listo";
    }
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
    function eliminardetalleodt($codigo){
        $this->db->where('id_detalle_reparacion',codigo);
        $restar= $this->db->get("detalle_reparacion");
        $codigo_barra="";
        $cantidad=0;
        $stock_inventario=0;
        foreach ($restar->result() as $valor) {
            $codigo_barra = $valor->codigof_producto;
            $cantidad= $valor->cantidad;
        }
        $this->db->where('codigo_barra',$codigo_barra);
        $sacar= $this->db->get("stock_inventario");
        foreach ($sacar->result() as $valor) {
            $stock_inventario = $valor->cantidad;
        }
        $datomodificar['cantidad'] = $stock_inventario+$cantidad;
        $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update('stock_inventario',$datomodificar);
        
        $this->db->where('id_detalle_reparacion',$codigo);
        $this->db->delete("detalle_reparacion");
    }
            function eliminardetalle($codigo){
        $this->db->where('id_detalle',$codigo);
        $restar= $this->db->get("detalle_venta");
        $codigo_barra="";
        $cantidad=0;
        $stock_inventario=0;
        foreach ($restar->result() as $valor) {
            $codigo_barra = $valor->codigo_producto_detalle;
            $cantidad= $valor->cantidad;
        }
        $this->db->where('codigo_barra',$codigo_barra);
        $sacar= $this->db->get("stock_inventario");
        foreach ($sacar->result() as $valor) {
            $stock_inventario = $valor->cantidad;
        }
        $datomodificar['cantidad'] = $stock_inventario+$cantidad;
        $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update('stock_inventario',$datomodificar);
        
        $this->db->where('id_detalle',$codigo);
        $this->db->delete("detalle_venta");
        
    }
    
    function agregardetalle($guardar,$codigo_barra,$id_orden,$cantidad){
        $this->db->where('codigo_barra',$codigo_barra);
        $sacar= $this->db->get("stock_inventario");
        $mensaje="";
        foreach ($sacar->result() as $valor) {
            $stock_inventario = $valor->cantidad;
        }
        if($sacar->num_rows()==0){
            $mensaje= "Error, producto no existe";
        }else{
        if($stock_inventario>=$cantidad){
        $datomodificar2['cantidad'] = $stock_inventario-$cantidad;
        $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update('stock_inventario',$datomodificar2);
        $this->db->where('idf_orden',$id_orden);
        $this->db->where('codigof_producto',$codigo_barra);
        $restar= $this->db->get("detalle_reparacion");
        if($restar->num_rows()==0){
            $this->db->insert("detalle_reparacion",$guardar);
            $mensaje="listo";
        }else{
        foreach ($restar->result() as $valor) {
            $cantidad1= $valor->cantidad;
        }
        $datoeditar['cantidad']=$cantidad+$cantidad1;
        $this->db->where('idf_orden',$id_orden);
        $this->db->where('codigof_producto',$codigo_barra);
        $this->db->update("detalle_reparacion",$datoeditar);
        $mensaje="listo";
        }
    }else{
        $mensaje= "Error, Sin stock";
    }    
        }
        return $mensaje;
    
    }
    function adquerirorden($codigo){
        $this->db->where('id_orden',$codigo);
        return $this->db->get("orden_reparacion");
    }
            function actualizarort($id_detalle,$descripcion,$descuento,$mano,$fecha){
        $this->db->where('idf_orden',$id_detalle);
        $recorrer=$this->db->get("detalle_reparacion");
       $total=0;
        foreach ($recorrer->result() as $valor) {
           $total = $total+ ($valor->cantidad*$valor->precio_bruto);
        }
        $totaldef= $total;
        
        $datomo['fecha_entrega']=$fecha;
        $datomo['mano_de_obra']=$mano;
        $datomo['descripcion']=$descripcion;
        $datomo['total']=$totaldef;
        $datomo['descuento_especial']=$descuento;
        $datomo['estado']="imprimir";
        $this->db->where('id_orden',$id_detalle);
        $this->db->update("orden_reparacion",$datomo);
        
        return "listo";
    }
            
    function cancelardetalle($codigo){
    $this->db->where('idf_orden',$codigo);
        $descartar= $this->db->get("detalle_reparacion");
         $codigo_barra="";
        $cantidad=0;
        $stock_inventario=0;
        if($descartar->num_rows()==0){
             $this->db->where('id_orden',$codigo);
        $this->db->delete('orden_reparacion');
        }else{
            foreach ($descartar->result() as $valor) {
          $codigo_barra=  $valor->codigof_producto;
          $cantidad= $valor->cantidad;
        $this->db->where('codigo_barra',$codigo_barra);
        $sacar= $this->db->get("stock_inventario");
        foreach ($sacar->result() as $fila) {
            $stock_inventario = $fila->cantidad;
        }
          $data['cantidad']= $stock_inventario+$cantidad;
          $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update('stock_inventario',$data);
        }
         $this->db->where('idf_orden',$codigo);
        $this->db->delete('detalle_reparacion');
        
        $this->db->where('id_orden',$codigo);
        $this->db->delete('orden_reparacion');
        }
        
        
        
        
        
       
        return "listo";    
    }
            function cancelarventas($codigo){
        $this->db->where('codigo_detalle_venta',$codigo);
        $descartar= $this->db->get("detalle_venta");
         $codigo_barra="";
        $cantidad=0;
        $stock_inventario=0;
        foreach ($descartar->result() as $valor) {
            
          $codigo_barra=  $valor->codigo_producto_detalle;
          $cantidad= $valor->cantidad;
        $this->db->where('codigo_barra',$codigo_barra);
        $sacar= $this->db->get("stock_inventario");
        foreach ($sacar->result() as $fila) {
            $stock_inventario = $fila->cantidad;
        }
          $data['cantidad']= $stock_inventario+$cantidad;
          $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update('stock_inventario',$data);
          
        }
        $enviar['estado']="cancelado";
        $this->db->where('id_codigo_venta',$codigo);
        $this->db->update('venta',$enviar); 
        return "listo";
    }
    function editarorden($guardar,$id_orden){
        $this->db->where('id_orden',$id_orden);
        $this->db->update("orden_reparacion",$guardar);
        return "editado correctamente";
    }
    function editardetalleodt($id_detalle,$cantidad_ingresada,$stock_inventario,$codigo_barra){
        $data['cantidad']=$stock_inventario;
        $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update("stock_inventario",$data);
        
        $cambiar['cantidad']= $cantidad_ingresada;
        $this->db->where('id_detalle_reparacion',$id_detalle);
        $this->db->update("detalle_reparacion",$cambiar);
        
    }
            function editardetalle($id_detalle,$cantidad_ingresada,$stock_inventario,$codigo_barra){
        $data['cantidad']=$stock_inventario;
        $this->db->where('codigo_barra',$codigo_barra);
        $this->db->update("stock_inventario",$data);
        
        
        $cambiar['cantidad']= $cantidad_ingresada;
        $this->db->where('id_detalle',$id_detalle);
        $this->db->update("detalle_venta",$cambiar);
    }
    function editarventa($id_venta,$actualizar){
        $this->db->where('id_codigo_venta',$id_venta);
        $this->db->update("venta",$actualizar);
        return "listo";
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
  function  verproducto($codigo_barra){
      $this->db->select("*");
    $this->db->where("codigo_barra",$codigo_barra);
      return $this->db->get("producto");
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
  function almacenarusuario($rute,$guardar){
     $this->db->select("*");
    $this->db->where("rut_usuario",$rute);
    $captarinformacion= $this->db->get("usuario_empresa");
    $mensaje="";
    if($captarinformacion->num_rows()==0){
        $this->db->insert("usuario_empresa",$guardar);
        $mensaje="Usuario almacenado correctamente";
    }else{
        $mensaje="Error, Rut de usuario ya existe";
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
function bloquiar_usuario_empresa($codigo){
    $estado="bloquiado";
    $consulta = "update usuario_empresa set estado='".$estado."' where rut_usuario='".$codigo."' ";
    $this->db->query($consulta);
}
function desbloquiar_usuario_empresa($codigo){
    $estado="activo";
    $consulta = "update usuario_empresa set estado='".$estado."' where rut_usuario='".$codigo."' ";
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
function versinosi($codigo_barra){
        $this->db->select("*");
  $this->db->where('codigo_barra',$codigo_barra);
  $consulta1= $this->db->get('stock_inventario');
  if($consulta1->num_rows()==0){
      $mandar="no";
  }else{
      $this->db->select("*");
  $this->db->where('codigo_barra',$codigo_barra);
  $this->db->where('estado',"activo");
  $consulta2= $this->db->get('producto');
  if($consulta2->num_rows()==0){
      $mandar="no";
  }else{
  $mandar="si";    
  }
      
  }
  return $mandar;
}

        function sacarproductomisto($codigo_barra){
    $query = $this->db->select("p.stock_minimo,p.precio_bruto,si.cantidad");
$query = $this->db->from("producto p");
      $query = $this->db->join("stock_inventario si","si.codigo_barra = p.codigo_barra","inner");
      $query= $this->db->where("p.codigo_barra",$codigo_barra);
     $query = $this->db->get();
    return $query;
    }
function adquerirproductoinventario($codigo){
    $query = $this->db->select("p.codigo_barra,p.nombre,p.descripcion,f.tipo_familia,p.stock_minimo,sto.cantidad");
      $query = $this->db->from("producto p");
      $query = $this->db->join("familia f ","f.id_familia = p.idf_familia","inner");
      $query = $this->db->join("stock_inventario sto ","sto.codigo_barra = p.codigo_barra","inner");
      $query= $this->db->where("p.codigo_barra",$codigo);
     $query = $this->db->get();
    return $query->result();
}
function verdetalle($id_venta){
     $query= $this->db->select("deta.id_detalle,p.nombre,deta.cantidad,deta.precio");
     $query = $this->db->from("detalle_venta deta");
     $query = $this->db->join("producto  p ","p.codigo_barra = deta.codigo_producto_detalle","inner");
     $query= $this->db->where("deta.codigo_detalle_venta",$id_venta);
     $query = $this->db->get();
    return $query->result();
    }
    function vernombresdetrabajadores($mes){
        $año=Date("y");
        $sql="SELECT SUM(venta.total) as total ,MONTHNAME(venta.fecha) as mes, usuario_empresa.nombre_usuario  from venta INNER JOIN usuario_empresa on venta.rut_vendedor= usuario_empresa.rut_usuario where venta.fecha like '2017-".$mes."-%' GROUP by usuario_empresa.nombre_usuario, mes ORDER by mes";
        return $this->db->query($sql);
    }
    function versumadetrabajadores($mes){
        $año=Date("y");
        $sql="select SUM(venta.total) as totaldeusuario from venta INNER join usuario_empresa on venta.rut_vendedor = usuario_empresa.rut_usuario where venta.fecha like '".$año."-".$mes."-%' GROUP by usuario_empresa.rut_usuario";
        return $this->db->query($sql);
    }
            function cargardetalleort($codigo){
        $query = $this->db->select("dere.id_detalle_reparacion,p.codigo_barra,p.nombre,dere.cantidad as cantidad_detalle,dere.precio_bruto,p.stock_minimo,si.cantidad,dere.idf_orden");
        $query = $this->db->from("detalle_reparacion dere");
     $query = $this->db->join("producto  p ","p.codigo_barra = dere.codigof_producto","inner");
     $query = $this->db->join("stock_inventario  si ","si.codigo_barra = dere.codigof_producto","inner");
     $query= $this->db->where("dere.id_detalle_reparacion",$codigo);
     $query = $this->db->get();
    return $query->result();
    }
            function cargardetalle($codigo){
        $query= $this->db->select("deta.id_detalle,p.codigo_barra,p.nombre,deta.cantidad as cantidad_detalle,deta.precio,p.stock_minimo,si.cantidad");
     $query = $this->db->from("detalle_venta deta");
     $query = $this->db->join("producto  p ","p.codigo_barra = deta.codigo_producto_detalle","inner");
     $query = $this->db->join("stock_inventario  si ","si.codigo_barra = deta.codigo_producto_detalle","inner");
     $query= $this->db->where("deta.id_detalle",$codigo);
     $query = $this->db->get();
    return $query->result();
    }
            function verinventario($codigo){ 
    $consulta = "SELECT cantidad as ver from stock_inventario where codigo_barra='".$codigo."'  ";
   return $this->db->query($consulta);    
  }
    function total_productode_emresa($rut_empresa){
     $consulta ="select count(*) as datos from producto";
    return $this->db->query($consulta);
  }
  
  function vercantidadestockminimo(){
      $consulta ="select count(*) as datos from stock_inventario JOIN producto on producto.codigo_barra= stock_inventario.codigo_barra where stock_inventario.cantidad<= producto.stock_minimo ";
      return $this->db->query($consulta);
  }
  function verretockminimo(){
      $consulta="select si.codigo_barra, p.nombre, p.descripcion,p.stock_minimo,si.cantidad from producto p join stock_inventario si on si.codigo_barra = p.codigo_barra where si.cantidad<= p.stock_minimo ";
      return $this->db->query($consulta)->result();
  }
          function total_entradas(){
      $consulta = "select count(*) as datos from detalle_entrada";
      return $this->db->query($consulta);
  }
  function total_productos(){
    $consulta = "select count(*) as datos from stock_inventario";
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
  function verusuarioeditar($rut){
      $this->db->select("*");   
      $this->db->where('rut_usuario',$rut);
        return  $this->db->get('usuario_empresa');
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