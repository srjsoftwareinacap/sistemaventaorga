$(document).ready(function(){
    $("#mensaje").dialog({
       autoOpen:false,
       modal:true,
       buttons:{
           Ok: function(){
               $(this).dialog("close");
           }
       }
   });

});
function volvernormal() {
      setTimeout(function() {
        $( "#efecto" ).removeAttr( "style" ).hide().fadeIn();
      }, 1000 );
    };
    function ejecutarefecto1() {
      // get effect type from
      var selectedEffect = "shake";
 
      // Most effect types need no options passed by default
      var options = {};
      // some effects have required parameters
      if ( selectedEffect === "scale" ) {
        options = { percent: 50 };
      } else if ( selectedEffect === "transfer" ) {
        options = { to: "#button", className: "ui-effects-transfer" };
      } else if ( selectedEffect === "size" ) {
        options = { to: { width: 200, height: 60 } };
      }
 
      // Run the effect
      $( "#efecto" ).effect( selectedEffect, options, 500, volvernormal );
    };
    function  abrirmodalproduempresa(){
        $("#modalproducto_suempresa").modal({
        show:true
      });
    }
    
    function abrirmodalgusuario(){
        $("#modalgestion_usuario").modal({
        show:true
      });
    }
    function abrirmodalordencompra(){
        $("#modalordendecompra").modal({
        show:true
      });
    }
    function Editarordendetrabajo(){
        var nombre_cliente= $("#txtcliente1").val();
        var rut = $("#txtRutregistrar1").val();
        var direccion = $("#txtdireccion1").val();
        var telefono = $("#txttelefono1").val();        
        var serie = $("#txtserie1").val();
        var descripcionfalla = $("#txtdescrpcionfalla1").val();
        var id =$("#txtidediarid").val();
        if($("#txtmodelo1").val().trim().length==0){
        var modelo = "no aplica";    
        }else{
        var modelo = $("#txtmodelo1").val();    
        }
        if($("#txtmarca1").val().trim().length==0){
        var marca= "no aplica";    
        }else{
        var marca= $("#txtmarca1").val();    
        }
        if($("#txtcadena1").val().trim().length>0){
        var cadena= $("#txtcadena1").val();    
        }else{
        var cadena="no aplica";    
        }
        if($("#txtespada1").val().trim().length==0){
            var espada="no aplica";
        }else{
            var espada = $("#txtespada1").val();
        }
  $.post(
    base_url+"Pagina/editar_ordentrabajo",
    {nombre_cliente:nombre_cliente,rut:rut,direccion:direccion,telefono:telefono,modelo:modelo,marca:marca,cadena:cadena,espada:espada,serie:serie,descripcionfalla:descripcionfalla,id_orden:id},
    function(pagina){  
      if(pagina.m1=="editado correctamente"){
         setTimeout("location.reload()",1); 
      }       
    },'json'
    );   
    }
    function almacenar_ordenreapracion(){
        var nombre_cliente= $("#txtcliente").val();
        var rut = $("#txtRutregistrar").val();
        var des = $("#txtrutverificador").val();
        var direccion = $("#txtdireccion").val();
        var telefono = $("#txttelefono").val();        
        var serie = $("#txtserie").val();
        var descripcionfalla = $("#txtdescrpcionfalla").val();
        if($("#txtmodelo").val().trim().length==0){
        var modelo = "no aplica";    
        }else{
        var modelo = $("#txtmodelo").val();    
        }
        if($("#txtmarca").val().trim().length==0){
        var marca= "no aplica";    
        }else{
        var marca= $("#txtmarca").val();    
        }
        if($("#txtcadena").val().trim().length>0){
        var cadena= $("#txtcadena").val();    
        }else{
        var cadena="no aplica";    
        }
        if($("#txtespada").val().trim().length==0){
            var espada="no aplica";
        }else{
            var espada = $("#txtespada").val();
        }
  $.post(
    base_url+"Pagina/almacenar_ordentrabajo",
    {nombre_cliente:nombre_cliente,rut:rut,des:des,direccion:direccion,telefono:telefono,modelo:modelo,marca:marca,cadena:cadena,espada:espada,serie:serie,descripcionfalla:descripcionfalla},
    function(pagina){  
      if(pagina.m1=="Almacenado correctamente"){
         setTimeout("location.reload()",1); 
      }       
    },'json'
    );      
    }
    
    function  imprimir(codigo){
    $.post(
    base_url+"Pagina/imprimirpedido",
    {codigo:codigo},
    function(pagina){  
             
    }
    );    
    }
    function almacenar_detalleort(){
        var mano=$("#txtmanodeobratrabajooo").val();
        var descuento = $("#txtdescuentoparaorden").val();
        var descripcion = $("#txtdescripciondetalletrabajo").val();
        var id_detalle = $("#txtidf_orden").val();
        
    if($("#txtmanodeobratrabajooo").val().trim().length==0  || $("#txtdescuentoparaorden").val().trim().length==0 || $("#txtdescripciondetalletrabajo").val().trim().length==0){
        $("#mesajemodalpresupuesto").html("<p class='alert alert-danger' role='alert' >"+"Error, se debe tener los descuentos, mano de obra y descripcion para completar la orden de trabajo"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
        $("#txtmanodeobratrabajooo").val('');
        $("#txtdescuentoparaorden").val('');
        $("#txtdescripciondetalletrabajo").val('');
        $("#txtmanodeobratrabajooo").focus();
    }else{
        if(parseInt(mano)==0){
        $("#mesajemodalpresupuesto").html("<p class='alert alert-danger' role='alert' >"+"Se requiere que la mano de obra sea mayor que 0"+"</p>").fadeIn(100).delay(600).fadeOut(3000);    
        $("#txtmanodeobratrabajooo").val('');
        $("#txtmanodeobratrabajooo").focus();
        
            }else{
             $.post(
    base_url+"Pagina/ordendt",
    {id_detalle:id_detalle,descuento:descuento,descripcion:descripcion,mano:mano},
    function(pagina){  
             if(pagina.m1=="listo"){
                setTimeout("location.reload()",1);
             }
    },'json'
    );   
            }
    }    
       
        
    
    
    }
    function mostrardetalle_ordenproductos(codigo){
      $.post(
    base_url+"Pagina/editardetalleortrabajproductos",
    {codigo:codigo},
    function(pagina){  
          $("#modalordendecompradetalleproductos").html(pagina);
          $("#txtdetallenumero").val(codigo);
      $("#modalordendecompradetalleproductos").modal({
        show:true
      });   
    }
    );
  }
    function ingresardetalleorden(codigo_barra){
        var id_orden =$("#txtdetallenumero").val();
        if($("#txtcantidaddetalleor").val().trim().length==0){
             var cantidad=1;
        }else{
        var cantidad=$("#txtcantidaddetalleor").val();    
        }
         $.post(
    base_url+"Pagina/ingresardetalleortrabaj",
    {codigo_barra:codigo_barra,id_orden:id_orden,cantidad:cantidad},
    function(pagina){  
             if(pagina.m1=="listo"){
                 $("#txtcantidaddetalleor").val('');
                 $("#txtdetallecodigo").val('');
                 $("#txtcantidaddetalleor").focus();
                 $("#modalordendecompradetalleproductos").modal({
        show:false
      });
      $.post(
    base_url+"Pagina/cargareditardetalleortrabajproductos",
    {id_orden:id_orden},
    function(pagina){
        $("#modalordendecompradetalleproductos").html(pagina);
          $("#txtdetallenumero").val(id_orden);
            $("#modalordendecompradetalleproductos").modal({
        show:true
      });
    }
    );
             }else{
                 $("#txtcantidaddetalleor").val('');
                 $("#txtdetallecodigo").val('');
                 $("#txtcantidaddetalleor").focus();
                 $("#mesajemodalpresupuesto").html("<p class='alert alert-danger' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
             }
             
    },'json'
    );
    }   
    function abrirmodalentrada(){
        $("#modalentradaproducto").modal({
        show:true
      });
    }
    function abrirmodalsalida(){
        $("#modalsalidaproducto").modal({
        show:true
      });
    }
    function  abrirmodalproveedor(){
        $("#modalproveedor").modal({
        show:true
      });
    }
    function  abrirmodalfamiliaycerrardeproducto(){
          $("#modalproducto_suempresa").modal('hide');
          $("#modalfamiala").modal({
        show:true
      });
    }
    function sacarletras(input){
  var restringir = /[^0-9]/gi;
  input.value = input.value.replace(restringir,"");
}
function sacargeneral(input){
  var restringir = /[^a-z 0-9]/gi;
  input.value = input.value.replace(restringir,"");
}
function sacarnumero(input){
  var restringir = /[^a-z]/gi;
  input.value = input.value.replace(restringir,"");
}
function almacenar_familia(){
    var tipo_familia =$("#txttipofamilia").val();
     $.post(
    base_url+"Pagina/almacenarfamilia",
    {tipo_familia:tipo_familia},
    function(vector){  
             if(vector.mensaj=="si"){
                 $("#mesajemodalfamilia").html("<p class='alert alert-success' role='alert' >"+"Tipo Familia Almacenada  Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000);
             }else{
                $("#mesajemodalfamilia").html("<p class='alert alert-danger' role='alert' >"+"!!Eroor ,El codigo ya existe"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txttipofamilia").val('');
  $("#txttipofamilia").focus(); 
             }
    },
    'json'
    );
}
    function  almacenar_producto(){
  var codigo= $("#txtcodigo").val();
  var nombre= $("#txtnombre").val();
  var descripcion= $("#txtdescripcion").val();
  var familia= $("#productoseleccioado").val();
  var precio_bruto = $("#txtpreciobrutoproducto").val();
  
  var stock= $("#txtstock").val();
  var mensaje="";
  if(parseInt(stock)==0){
      $("#mesajemodalproducto").html("<p class='alert alert-danger' role='alert' >"+"!!Eroor , Precio de venta no Puede ser 0"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      ("#txtpreciobrutoproducto").val('');
      ("#txtpreciobrutoproducto").focus();
  }else{
      
  
  if(familia==0){
      $("#mesajemodalproducto").html("<p class='alert alert-danger' role='alert' >"+"!!Eroor , Tipo de familia no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  }else{
      if( parseInt(stock)>=1){
          
             $.post(
    base_url+"Pagina/almacenar_producto",
    {codigo:codigo,nombre:nombre,descripcion:descripcion,familia:familia,stock:stock,precio_bruto:precio_bruto},
    function(datos){  
    if(datos.mensaj=="si"){
             $("#mesajemodalproducto").html("<p class='alert alert-success' role='alert' >"+"Producto guardado Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000); 
 }else{
  $("#mesajemodalproducto").html("<p class='alert alert-danger' role='alert' >"+"!!Error ,El codigo ya existe"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtcodigo").val('');
  $("#txtcodigo").focus();
     }       
    },
    'json'
    ); 
          
      }else{
          $("#mesajemodalproducto").html("<p class='alert alert-danger' role='alert' >"+"!!Error ,El Stock minimo Insuficiente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtstock").val('');
  $("#txtstock").focus();
      }
    
  }
    }
   
    }
    
    function imprimirorden(codigo){
        
        $.post(
    base_url+"Pagina/imprimirpedido",
    {codigo:codigo},
    function(pagina){  
        window.location.replace("http://localhost/sistemaventaorga/index.php/Pagina/imprimirpedido/"+codigo+"");
            
    }
    );
    }
    function mostraredicion_mo_orden(codigo){
        $.post(
    base_url+"Pagina/cargareditarorden",
    {codigo:codigo},
    function(pagina){  
        $("#mostraredicion_ordentrabajo").html(pagina);
      $("#mostraredicion_ordentrabajo").modal({
        show:true
      });      
    }
    );
    }
   function mostraredicioncantidad_modetalle_reparacion(codigo){
      $("#modalordendecompradetalleproductos").modal('hide'); 
       $.post(
    base_url+"Pagina/mostraredicioncantidad_modetalle_reparacionodt",
    {codigo:codigo},
    function(pagina){  
        $("#modalordendecompradetalleproductos").html(pagina);
        $("#modalordendecompradetalleproductos").modal({
        show:true
      });      
    }
    );
   }
    function mostraredicion_mo_cantidad(codigo){
        $.post(
    base_url+"Pagina/cargarcantidad_venta",
    {codigo:codigo},
    function(pagina){  
        $("#mostraredicion_mo_venta").html(pagina);
      $("#mostraredicion_mo_venta").modal({
        show:true
      });      
    }
    );
    }
    
    function eliminarrpoductoventa(codigo){
        $.post(
    base_url+"Pagina/eliminnardetalleventa",
    {codigo:codigo},
    function(pagina){  
          if(pagina.m1=="listo"){
              setTimeout("location.reload()",1);
          }   
    },'json'
    );
    }
    function eliminarrpoductomodetalle_reparacion(codigo){
       var codigo_ordenf = $("#txtidf_orden").val();
       
        
        $.post(
    base_url+"Pagina/eliminnardetalleodt",
    {codigo:codigo},
    function(pagina){  
          if(pagina.m1=="listo"){
              $("#modalordendecompradetalleproductos").modal('hide');
              mostrardetalle_ordenproductos(codigo_ordenf);
          }   
    },'json'
    );
    }
    function ingresarmanodeobraydescuento(descuento_especial){
        var mano_obra = $("#txtmanodeobratrabajooo").val();
        var sub_total = $("#txtsuntotal").val();
       if($("#txtdescuentoparaorden").val().trim().length==0){
            descuento_especial =0;
       }else{
           if(parseInt(descuento_especial)>= parseInt(sub_total) || parseInt(descuento_especial)>= parseInt(sub_total)+parseInt(mano_obra) ){
            $("#mesajemodalpresupuesto").html("<p class='alert alert-danger' role='alert' >"+"!! Error, el descuento no puede ser mayor que el sub_total"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
            $("#txtmanodeobratrabajooo").val('');
               $("#txtdescuentoparaorden").val('');
               $("#txtmanodeobratrabajooo").focus();
               $("#txtversiguardar").val("no");
           }else{
               
               if($("#txtsuntotal").val().trim().length==0){
 $("#mesajemodalpresupuesto").html("<p class='alert alert-danger' role='alert' >"+"!! Error, agregue productos para la reparacion"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
 $("#txtmanodeobratrabajooo").val('');
               $("#txtdescuentoparaorden").val('');
               $("#txtcantidaddetalleor").focus();
               $("#txtversiguardar").val("no");
               }else{
                   var mostrar =parseInt(sub_total)+parseInt(mano_obra)-parseInt(descuento_especial)
                   $("#txtversiguardar").val("si");
                   $("#modificarordendelalledeinformacion").html("<p class='alert alert-success' role='alert' >"+"En Total son: "+mostrar+"</p>");
               }
           }
       }
    }
    function Editarodtdetallecantidad(){
        var id_detalles = $("#txtiddetalleodt").val();
        var cantidad_anterior = $("#txtcantidadanteriorodt").val();
        var cantidad_ahora = $("#txtcantidadventaodt").val();
        var total_cantidad = $("#txtproducotstolaninventarioodt").val();
        var codigo_barra = $("#txtcodigobarraodtdetalle").val();
        var codigoid = $("#txtidorden").val();
        if(parseInt(cantidad_ahora)==0){
  $("#mesajemodaleditarcantidadodt").html("<p class='alert alert-danger' role='alert' >"+"!! Error, la cantidad no puede ser 0"+"</p>").fadeIn(100).delay(600).fadeOut(1000);          
        }else{
            if(parseInt(cantidad_ahora)>=1){
             $.post(
    base_url+"Pagina/actualizardetalleodtcantidad",
    {id_detalle:id_detalles,cantidad_ahora:cantidad_ahora,cantidad_anterior:cantidad_anterior,total_modificar:total_cantidad,codigo_barra:codigo_barra},
    function(pagina){  
        if(pagina.m1=="listo"){
            $("#mostraredicion_mo_cantidadordenproducto").modal('hide');
            mostrardetalle_ordenproductos(codigoid);
            
        }else{
$("#mesajemodaleditarcantidadodt").html("<p class='alert alert-danger' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(1000);            
        }      
    },
    'json'
    );   
            }else{
                $("#mesajemodaleditarcantidadodt").html("<p class='alert alert-danger' role='alert' >"+"!! Error, la cantidad no puede ser negativo"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
            }
 
    
            
        }
    } 
    function Editarventa(){
        var id_detalles = $("#txtiddetalle").val();
        var cantidad_anterior = $("#txtcantidadanterior").val();
        var cantidad_ahora =    $("#txtcantidadventa").val();
        var total_cantidad =    $("#txtproducotstolaninventario").val();
        var codigo_barra = $("#txtcodigobarraventa").val();
        if(parseInt(cantidad_ahora)==0){
  $("#mesajemodaleditarcantidad").html("<p class='alert alert-danger' role='alert' >"+"!! Error, la cantidad no puede ser 0"+"</p>").fadeIn(100).delay(600).fadeOut(1000);          
        }else{
            if(parseInt(cantidad_ahora)>=1){
             $.post(
    base_url+"Pagina/actualizardetalle",
    {id_detalle:id_detalles,cantidad_ahora:cantidad_ahora,cantidad_anterior:cantidad_anterior,total_modificar:total_cantidad,codigo_barra:codigo_barra},
    function(pagina){  
        if(pagina.m1=="listo"){
            setTimeout("location.reload()",1);
        }else{
$("#mesajemodaleditarcantidad").html("<p class='alert alert-danger' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(1000);            
        }      
    },
    'json'
    );   
            }else{
                $("#mesajemodaleditarcantidad").html("<p class='alert alert-danger' role='alert' >"+"!! Error, la cantidad no puede ser negativo"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
            }
 
    
            
        }
        
    }
    function mostraredicion_mo_producto(codigo){
        $.post(
    base_url+"Pagina/cargarcodigo_producto",
    {codigo:codigo},
    function(pagina){  
        $("#mostraredicion_mo_producto").html(pagina);
      $("#mostraredicion_mo_producto").modal({
        show:true
      });      
    }
    );
    }
    function mostraredicion_inventario(codigo){
        $.post(
    base_url+"Pagina/cargarcodigo_inventario",
    {codigo:codigo},
    function(pagina){  
        $("#mostraredicion_inventarioproducto").html(pagina);
      $("#mostraredicion_inventarioproducto").modal({
        show:true
      });      
    }
    );
    }
    function redireccionar(){
  location.href="http://localhost:57030/index.aspx";
} 
    function realizarrventa(){
        
        var id_venta = $("#txtidventarealizar").val();
        var medio_pago = $("#txtmedioselecionado").val();
        var descuento = $("#txtdescuento").val();
       var sub_total =  $("#txtsuntotal").val();
       if(descuento.trim().length==0){
          descuento =0;
       }
       
       if($("#txtmedioselecionado").val()==0){
     $("#txtmensajeventas").html("<p class='alert alert-danger' role='alert' >"+"!! Error, seleccione un medio de pago"+"</p>").fadeIn(100).delay(600).fadeOut(3000);      
       }else{
       if(sub_total!=0){
 $.post(
    base_url+"Pagina/registarventas",
    {id_venta:id_venta,medio_pago:medio_pago,descuento:descuento,sub_total:sub_total},
    function(pagina){  
        if(pagina.m1=="listo"){
        setTimeout ("redireccionar()", 1);    
        }
              
    },'json'
    );  
       }else{
        $("#txtmensajeventas").html("<p class='alert alert-danger' role='alert' >"+"!! Error,no hay ventas registradas"+"</p>").fadeIn(100).delay(600).fadeOut(3000);   
       }    
       }
       
       
       
       
    }
    function mostraredicion_modal_usuario(codigo){
        $.post(
    base_url+"Pagina/cargarcodigo_usuario",
    {codigo:codigo},
    function(pagina){  
        $("#mostraredicion_mo_usuario").html(pagina);
      $("#mostraredicion_mo_usuario").modal({
        show:true
      });      
    }
    );
    } 
    function mostraredicion_mo_proveedor(codigo){
        $.post(
    base_url+"Pagina/cargarcodigo_proveedor",
    {codigo:codigo},
    function(pagina){  
        $("#mostraredicion_mo_proveedor").html(pagina);
      $("#mostraredicion_mo_proveedor").modal({
        show:true
      });      
    }
    );
    }
    function Editarinventario(){
        var codigo_barra= $("#txtcodigo_barrainventario").val();
        var valor_ingresado= $("#txtstockinventarionuevo").val();
        var stock_minimo = $("#txtstock_minimo").val();
        if(parseInt(valor_ingresado)>0){
        if(parseInt(valor_ingresado)>=parseInt(stock_minimo)){
            $.post(
    base_url+"Pagina/actualizar_inventario",
    {codigo_barra:codigo_barra,valor_ingresado:valor_ingresado},
    function(pagina){  
             if(pagina.m1=="si"){
                 $("#mesajemodaleditarinventario").html("<p class='alert alert-success' role='alert' >"+"!! Inventario actualizado"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
                 setTimeout("location.reload()",3000); 
             }else{
             $("#mesajemodaleditarinventario").html("<p class='alert alert-danger' role='alert' >"+"!! Error"+"</p>").fadeIn(100).delay(600).fadeOut(3000);    
             }
    },
    'json'
    );
        }else{
            $("#mesajemodaleditarinventario").html("<p class='alert alert-danger' role='alert' >"+"!! Error,El stock ingresado es menor que el stock minimo"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
        }
    }else{
         $("#mesajemodaleditarinventario").html("<p class='alert alert-danger' role='alert' >"+"!! Error,El stock ingresado no puede ser 0 o menor"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
    }
    }
    function  Editarusuarioempresa(){
        var rut= $("#txteditar_usuario").val();
        var nombre= $("#txteditar_nombre").val();
        var contraseña = $("#txteditar_contraseña").val();
        var perfil = $("#perfil_editar").val();
        if(perfil==0){
            $("#mesajemodaleditarusuario").html("<p class='alert alert-danger' role='alert' >"+"!! Error,Seleccione un perfil"+"</p>").fadeIn(100).delay(600).fadeOut(2000);
        }else{
        $.post(
    base_url+"Pagina/editar_usuario_empresa",
    {rut:rut,nombre:nombre,contraseña:contraseña,perfil:perfil},
    function(pagina){  
              if(pagina.m1=="listo"){
               $("#mesajemodaleditarusuario").html("<p class='alert alert-success' role='alert' >"+"Usuario editado correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(2000);
               setTimeout("location.reload()",3000);
              }
    },
      'json'      
    );    
        }
    }
    function Editarproveedor(){
        var rut = $("#txtrut").val();
        var nombre = $("#txteditnombre").val();
        var giro = $("#txteditgiro").val();
        var telefono = $("#txtedittelefono").val();
        var region_id = $("#regionseleccioadaedir").val();
        var provincia = $("#provinciaseleccioada").val();
        var comuna = $("#comunaseleccioada").val();
        var calle = $("#txteditcalle").val();
        var correo = $("#txteditcorreo").val();
        if(region_id==0){
             $("#mesajemodaleditarproveedor").html("<p class='alert alert-danger' role='alert' >"+"!! Error, Region no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
        }else{
            if(provincia==0){
 $("#mesajemodaleditarproveedor").html("<p class='alert alert-danger' role='alert' >"+"!! Error, Provincia no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);               
            }else{
                if(comuna == 0 || comuna.trim().length==0){
 $("#mesajemodaleditarproveedor").html("<p class='alert alert-danger' role='alert' >"+"!! Error, Comuna no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);                   
                }else{
                 $.post(
    base_url+"Pagina/ediarproveedor",
    {rut:rut,nombre:nombre,giro:giro,telefono:telefono,region_id:region_id,provincia:provincia,comuna:comuna,calle:calle,correo:correo},
    function(pagina){  
             
             if(pagina.mensaj=="si"){
                 $("#mesajemodaleditarproveedor").html("<p class='alert alert-success' role='alert' >"+"Se ha editado el proveedor correspondiente"+"</p>").fadeIn(100).delay(600).fadeOut(2000);
                 setTimeout("location.reload()",3000); 
             }else{
                 $("#mesajemodaleditarproveedor").html("<p class='alert alert-danger' role='alert' >"+"Error, No es poblible hacer conecxion a la base de datos"+"</p>").fadeIn(100).delay(600).fadeOut(2000);
             }
             
    },
    'json'
    );   
                    
                    
                    
                    
                }
            }
        }
        
        
        
    }
    function Editarproductoempresa(){
        var codigo_barra_nuevo =$("#txtcodigo_barra_nuevo").val();
        var nombre_nuevo= $("#txtnombree_nuevo").val();
        var descripcion = $("#txtdescripcion_nuevo").val();
        var id_familia = $("#productoseleccioado_modificar").val();
       
        var stock_minimo = $("#txtstockminimonuevo").val();
      
        var codigo_viejo = $("#txtcodigo_viejooculto").val();
        var stock_oculto= $("#txtstockminimo_oculto").val();
        var precio_bruto = $("#txtpreciobrutoeditar").val();
        var informacion= $("#informacion").val();
       
        if(precio_bruto!=0){
            
        
        if(informacion=="no"){
        if(id_familia!=0){
        $.post(
    base_url+"Pagina/editar_producto",
    {codigo_barra_nuevo:codigo_barra_nuevo,nombre_nuevo:nombre_nuevo,descripcion:descripcion,id_familia:id_familia,stock_minimo:stock_minimo,codigo_viejo:codigo_viejo,precio_bruto:precio_bruto},
    function(datos){  
           if(datos.mensaj=="si"){
               $("#mesajemodaleditarfamilia").html("<p class='alert alert-success' role='alert' >"+"Producto editado Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000); 
           }else{
                 $("#mesajemodaleditarfamilia").html("<p class='alert alert-danger' role='alert' >"+"!! Error, El codigo ya existe "+"</p>").fadeIn(100).delay(600).fadeOut(3000);
                 $("#txtcodigo_barra_nuevo").val('');
                 $("#txtcodigo_barra_nuevo").focus();
           }   
    },
    'json'
    );     
          
     }else{
          $("#mesajemodaleditarfamilia").html("<p class='alert alert-danger' role='alert' >"+"!!Eroor , Tipo de familia no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     }
 }else{
     if(parseInt(stock_minimo) <= parseInt(stock_oculto)){
     if(id_familia!=0){    
        $.post(
    base_url+"Pagina/editar_producto",
    {codigo_barra_nuevo:codigo_barra_nuevo,nombre_nuevo:nombre_nuevo,descripcion:descripcion,id_familia:id_familia,stock_minimo:stock_minimo,codigo_viejo:codigo_viejo,precio_bruto:precio_bruto},
    function(datos){  
           if(datos.mensaj=="si"){
               $("#mesajemodaleditarfamilia").html("<p class='alert alert-success' role='alert' >"+"Producto editado Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000); 
           }else{
                 $("#mesajemodaleditarfamilia").html("<p class='alert alert-danger' role='alert' >"+"!! Error, El codigo ya existe "+"</p>").fadeIn(100).delay(600).fadeOut(3000);
                 $("#txtcodigo_barra_nuevo").val('');
                 $("#txtcodigo_barra_nuevo").focus();
           }   
    },
    'json'
    );     
          
     }else{
          $("#mesajemodaleditarfamilia").html("<p class='alert alert-danger' role='alert' >"+"!!Eroor , Tipo de familia no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     }
 }else{
     $("#mesajemodaleditarfamilia").html("<p class='alert alert-danger' role='alert' >"+"!!Error ,El stock sobrepasa el stock de el inventario"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtstockminimonuevo").val('');
  $("#txtstockminimonuevo").focus();
 }
 }
    }else{
  $("#mesajemodaleditarfamilia").html("<p class='alert alert-danger' role='alert' >"+"!!Error ,El precio bruto no puede ser 0"+"</p>").fadeIn(100).delay(600).fadeOut(3000);      
    }
    }
    
    function vereficarrutusuario(des){
        var rut=$("#txtRutusuario").val();
        if (des.trim().length==0 || rut.trim().length==0) {
        $("#txtRutusuario").val('');
        $("#trificadorusuario").val('');
        $("#txtRutusuario").focus();
        $("#mesajemodalgusuario").html("<p class='alert alert-danger' role='alert' >"+"Complete Los campos correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
    }else{
        if (dv(rut)!= des) {
        $("#txtRutusuario").val('');
        $("#trificadorusuario").val('');
        $("#txtRutusuario").focus();
        $("#mesajemodalgusuario").html("<p class='alert alert-danger' role='alert' >"+"Error !! Rut Invalido"+"</p>").fadeIn(100).delay(600).fadeOut(3000);    
        }else{
        $("#mesajemodalgusuario").html("<p class='alert alert-success' role='alert' >"+"Rut Valido"+"</p>").fadeIn(100).delay(600).fadeOut(3000);        
        }
    }
    }
    
    function vereficarrut(des){
          var rut1 = $("#txtRutregistrar").val();
        if(des.trim().length==0 || rut1.trim().length==0 ){
            $("#txtRutregistrar").val('');
            $("#txtrutverificador").val('');
            $("#txtRutregistrar").focus();
        $("#mesajemodalproveedor").html("<p class='alert alert-danger' role='alert' >"+"Complete Los campos correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
        }else{
      
        if(dv(rut1)!=des){
            $("#txtRutregistrar").val('');
            $("#txtrutverificador").val('');
            $("#txtRutregistrar").focus();
        $("#mesajemodalproveedor").html("<p class='alert alert-danger' role='alert' >"+"Rut no valido"+"</p>").fadeIn(100).delay(600).fadeOut(3000);    
        }else{
            $("#mesajemodalproveedor").html("<p class='alert alert-success' role='alert' >"+"Rut valido"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
        }
    }
        
    }
    function  cargarprov(codigo){
    
          $.post(
    base_url+"Pagina/cargarproviencias",
    {codigo:codigo},
    function(pagina,datos){  
             $("#cargarprovincia").html(pagina,datos);
             $("#mesajemodalproveedor").html("<p class='alert alert-success' role='alert' >"+"Provincias encontradas"+"</p>").fadeIn(100).delay(600).fadeOut(2000);
    }
    );  
    }
    function anadirdetalle(codigo){
        var cantidad = $("#txtcantidad").val();
        var id_venta =$("#txtidventarealizar").val();
        var mandarcantidad=0;
        if(parseInt(cantidad)==0){
            mandarcantidad =1;
        }else{
           if(cantidad.trim().length==0){
            mandarcantidad =1;   
           }else{
               mandarcantidad= cantidad;
           }
        }
       
     $.post(
    base_url+"Pagina/anadirdetalles",
    {codigo:codigo,id_venta:id_venta,cantidad:mandarcantidad},
    function(pagina){  
           if(pagina.m1=="Error, la cantidad ingresada es superior al stock"){
    $("#txtmensajeventas").html("<p class='alert alert-danger' role='alert' >"+pagina.m1+"</p>").fadeIn(300).delay(800).fadeOut(2000);           
           }else{
               if(pagina.m1=="Error, el producto no existe en inventario"){
$("#txtmensajeventas").html("<p class='alert alert-danger' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(2000);                   
               }else{
                   setTimeout("location.reload()",1);
               }
           }
             
    },
    'json'
    );
    }
    function almacenar_facturasalida(){
       var rut_proveedor =$("#prooveedorseleccioadosalida").val();
        var numero_factura = $("#txtnombresalida").val();
        var descripcion = $("#txtdescripcion_salida").val();
        if(rut_proveedor!=0){
        $.post(
    base_url+"Pagina/almacenarfacturasalida",
    {rut_proveedor:rut_proveedor,numero_factura:numero_factura,descripcion:descripcion},
    function(pagina){  
        if(pagina.m1=="Factura Registrada"){
     $("#mesajemodalnuevafacturasalida").html("<p class='alert alert-success' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(2000);
     setTimeout("location.reload()",3000);
        }else{
     $("#mesajemodalnuevafacturasalida").html("<p class='alert alert-danger' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(2000);       
        }     
    },
    'json'
    );    
        }else{
            $("#mesajemodalnuevafacturasalida").html("<p class='alert alert-danger' role='alert' >"+"Error, Seleccione Proveedor "+"</p>").fadeIn(100).delay(600).fadeOut(2000);
        }
    }
    function almacenar_usuario(){
        var rut= $("#txtRutusuario").val();
        var des = $("#trificadorusuario").val();
        var nombre = $("#txtnombreusuario").val();
        var contrasena = $("#txtcontrasenausuario").val();
         $.post(
    base_url+"Pagina/almacenaruser",
    {rut:rut,des:des,nombre:nombre,contrasena:contrasena},
    function(pagina){  
         if(pagina.mensaj=="Usuario almacenado correctamente"){
             $("#mesajemodalgusuario").html("<p class='alert alert-success' role='alert' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(2000);
             setTimeout("location.reload()",1500);
         }else{
             $("#mesajemodalgusuario").html("<p class='alert alert-danger' role='alert' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(2000);
             $("#txtRutusuario").val('');
             $("#trificadorusuario").val('');
             $("#txtRutusuario").focus();
         }    
    },'json'
    ); 
    }
    function almacenar_facturaentrada(){
        var rut_proveedor =$("#prooveedorseleccioadoentrada").val();
        var numero_factura = $("#txtnombre").val();
        var descripcion = $("#txtdescripcion_entrada").val();
        if(rut_proveedor==0){
            $("#mesajemodalnuevafactura").html("<p class='alert alert-danger' style='text-align: center' role='alert' >"+"Seleccione Proveedor"+"</p>").fadeIn(100).delay(600).fadeOut(2000);
        }else{
       $.post(
    base_url+"Pagina/almacenarentrada",
    {rut_proveedor:rut_proveedor,numero_factura:numero_factura,descripcion:descripcion},
    function(pagina){
        if(pagina.mensaj=="Factura registrada"){
             $("#mesajemodalnuevafactura").html("<p class='alert alert-success' role='alert' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(2000);
        setTimeout("location.reload()",3000); 
        }else{
        $("#mesajemodalnuevafactura").html("<p class='alert alert-danger' role='alert' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(2000);
        }
        },
        'json'
    ); 
        }  
    } 
    function cargarproveditar(codigo){
        $.post(
    base_url+"Pagina/cargarprovienciaseditar",
    {codigo:codigo},
    function(pagina,datos){  
             $("#cargarprovincia2").html(pagina,datos);
             
             $("#mesajemodaleditarproveedor").html("<p class='alert alert-success' role='alert' >"+"Provincias encontradas"+"</p>").fadeIn(100).delay(600).fadeOut(2000);
    }
    );  
    }
    function almacenar_proveedor(){
       
        var rut = $("#txtRutregistrar").val();
        var des = $("#txtrutverificador").val();
        var nombre = $("#txtnombre").val();
        var giro = $("#txtgiro").val();
        var telefono = $("#txttelefono").val();
        var region = $("#regionseleccioada").val();
        var provincia = $("#provinciaseleccioada").val();
        var comuna = $("#comunaseleccioada").val();
        var calle = $("#txtcalle").val();
        var correo = $("#txtcorreo").val();
        if(region==0){
             $("#mesajemodalproveedor").html("<p class='alert alert-danger' role='alert' >"+"Selecione la Region"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
        }else{
            if(provincia==0){
   $("#mesajemodalproveedor").html("<p class='alert alert-danger' role='alert' >"+"Selecione la Provincia"+"</p>").fadeIn(100).delay(600).fadeOut(3000);             
            }else{
                if(comuna == 0 || comuna.trim().length==0){
                    $("#mesajemodalproveedor").html("<p class='alert alert-danger' role='alert' >"+"Selecione la Comuna"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
                }else{
                    //mandar informacion
                $.post(
    base_url+"Pagina/almacenarprovedor",
    {rut:rut,des:des,nombre:nombre,giro:giro,telefono:telefono,region:region,provincia:provincia,comuna:comuna,calle:calle,correo:correo},
    function(pagina){  
        if(pagina.mensaj=="si"){
            $("#mesajemodalproveedor").html("<p class='alert alert-success' role='alert' >"+"Proveedor almacenado correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
             setTimeout("location.reload()",3000); 
        }else{
              $("#mesajemodalproveedor").html("<p class='alert alert-danger' role='alert' >"+"Error,El proveedor ya existe" +"</p>").fadeIn(100).delay(600).fadeOut(3000);
              $("#txtRutregistrar").val('');
       $("#txtrutverificador").val('');
       $("#txtRutregistrar").focus();
      
        }
        
        
             $("#cargarcomuna").html(pagina,datos);
             $("#mesajemodalproveedor").html("<p class='alert alert-success' role='alert' >"+"Comunas encontradas "+"</p>").fadeIn(100).delay(600).fadeOut(3000);
    },
    'json'
    );      
                    
                }
            }
        }
        
        
        
    }
    function cargarcomuna(codigo){
        $.post(
    base_url+"Pagina/cargarcomunas",
    {codigo:codigo},
    function(pagina,datos){  
             $("#cargarcomuna").html(pagina,datos);
             $("#mesajemodalproveedor").html("<p class='alert alert-success' role='alert' >"+"Comunas encontradas "+"</p>").fadeIn(100).delay(600).fadeOut(3000);
    }
    );   
    } 
    function cargarcomunaediatar(codigo){
            $.post(
    base_url+"Pagina/cargarcomunas",
    {codigo:codigo},
    function(pagina,datos){  
             $("#cargarcomuna2").html(pagina,datos);
             $("#mesajemodaleditarproveedor").html("<p class='alert alert-success' role='alert' >"+"Comunas encontradas "+"</p>").fadeIn(100).delay(600).fadeOut(3000);
    }
    ); 
    }
    function dv(rut){
  var M=0,S=1;
  for(;rut;rut=Math.floor(rut/10))
S=(S+rut%10*(9-M++%6))%11;
return S?S-1:'k';
}
    function vereficaridinventario12(codigos){
        var rut_proveedor = $("#prooveedorseleccioado").val();
        var numero_factura = $("#txtcodigofacturaver").val();
        var codigo_barra = $("#txtcodigoentrada").val();
        if(rut_proveedor==0){
             $("#mensajegregistarentrada").html("<p class='alert alert-danger' role='alert' >"+"Error, Seleccione Proveedor"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
        }else{
            if(numero_factura.trim().length==0){
               $("#mensajegregistarentrada").html("<p class='alert alert-danger' role='alert' >"+"Error, Inserte numero de Factura"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
               $("#txtcodigofacturaver").val('');
               $("#txtcodigofacturaver").focus();
            }else{
                if(codigo_barra.trim().length==0){
               $("#mensajegregistarentrada").html("<p class='alert alert-danger' role='alert' >"+"Error, Inserte el codigo de barra"+"</p>").fadeIn(100).delay(600).fadeOut(3000);     
                $("#txtcodigoentrada").val('');
                
                }else{
      $.post(
    base_url+"Pagina/vereficarinventario",
    {rut_proveedor:rut_proveedor,numero_factura:numero_factura,codigo_barra:codigo_barra},
    function(datos){
        if(datos.m1=="Producto en registro"){
            if(datos.precio_neto>0){
                 $("#mensajegregistarentrada").html("<p class='alert alert-success' role='alert' >"+datos.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      $("#txtnombrecargar").val(datos.nombre);
      $("#txtdescripcioncargar").val(datos.descripcion);
      $("#txtfamiliacargar").val(datos.familia);
      $("#txtstock_minimo").val(datos.stock_minimo);
      $("#txtpreciobruto").val(datos.precio_bruto);
      $("#txtstock_total").val(datos.stock_maximo);
      $("#txtidentrada").val(datos.id_entrada);
      $("#txtptrcioneto").val(datos.precio_neto);
      $("#txtstockingresado").focus();
            }else{
              $("#mensajegregistarentrada").html("<p class='alert alert-success' role='alert' >"+datos.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      $("#txtnombrecargar").val(datos.nombre);
      $("#txtdescripcioncargar").val(datos.descripcion);
      $("#txtfamiliacargar").val(datos.familia);
      $("#txtstock_minimo").val(datos.stock_minimo);
      $("#txtstock_total").val(datos.stock_maximo);
      $("#txtidentrada").val(datos.id_entrada);
      $("#txtptrcioneto").val('');
      $("#txtpreciobruto").val(datos.precio_bruto);
      $("#txtptrcioneto").focus();
            }
            
            
     
  }else{
      $("#mensajegregistarentrada").html("<p class='alert alert-danger' role='alert' >"+datos.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      $("#txtcodigo").val('');
  $("#txtcodigo").focus();
  }
    },
    'json'
    );                }
            }
        }
}
function  vereficaridinventariosalida(codigo){
    var id_proveedor = $("#prooveedorseleccioado").val();
    var numero_factura = $("#txtfacturasalida").val();
    if(id_proveedor !=0){
        if(numero_factura!=0){
      $.post(
    base_url+"Pagina/verificarinventariosalida",
    {codigo:codigo,id_proveedor:id_proveedor,numero_factura:numero_factura},
    function(pagina){  
      if(pagina.m1=="Se ha encontrado el producto"){
          $("#txtnombrecargarsalida").val(pagina.nombre);
          $("#txtdescripcioncargarsalida").val(pagina.descripcion);
          $("#txtfamiliacargarsalida").val(pagina.familia);
          $("#txtstock_minimosalida").val(pagina.stock_minimo);
          $("#txtstock_total_inventario1").val(pagina.cantidad);
          $("#txtidsalidaoculto").val(pagina.id_salida);
          $("#txtprecionetosalida").focus();
          $("#mensajegsalida").html("<p class='alert alert-success' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      }else{
          $("#mensajegsalida").html("<p class='alert alert-danger' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      }
    },
    'json'
    );      
        }
    }
}
function  registrar_producto_inventario(){
    var codigo_barra = $("#txtcodigoentrada").val();
    var stock_actual = $("#txtstock_total").val();
    var stock_minimo = $("#txtstock_minimo").val();
    var stock_ingresado = $("#txtstockingresado").val();
    var nombre = $("#txtnombrecargar").val();
    var idf_entrada = $("#txtidentrada").val();
    var precio_neto = $("#txtptrcioneto").val();
    var precio_bruto = $("#txtpreciobruto").val();
    var suma = parseInt(stock_actual) + parseInt(stock_ingresado);
   var rentable = parseInt(precio_neto)+ (parseInt(precio_neto)*0.19);
   if(idf_entrada!=0){
    if(nombre.trim().length > 0){
    if(parseInt(stock_actual) ==0){
        if(parseInt(stock_ingresado) >= parseInt(stock_minimo)){         
          $.post(
    base_url+"Pagina/registrarinventario",
    {codigo_barra:codigo_barra,stock_ingresado:stock_ingresado,idf_entrada:idf_entrada,precio_neto:precio_neto},
    function(pagina){ 
              $("#mensajegregistarentrada").html("<p class='alert alert-success' role='alert' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(1000);
              $("#txtcodigoentrada").val('');
              setTimeout("location.reload()",1000);
              
    },
    'json'
    );  
        }else{
        $("#mensajegregistarentrada").html("<p class='alert alert-danger' role='alert' >"+"Error!!!, No cumple con el stock minimo"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
         $("#txtstockcargar").val('');
        $("#txtstockcargar").focus();  
        }
    }else{
        //ver con stock
        
        $.post(
    base_url+"Pagina/registrarinventario",
    {codigo_barra:codigo_barra,stock_ingresado:stock_ingresado,idf_entrada:idf_entrada,precio_neto:precio_neto},
    function(pagina){  
              $("#mensajegregistarentrada").html("<p class='alert alert-success' role='alert' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(1000);
            setTimeout("location.reload()",1000);
    },
    'json'
    ); 
    
    
    }    
    }else{
        $("#mensajegregistarentrada").html("<p class='alert alert-danger' role='alert' >"+"Error!!!, El producto no esta registrado"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
       
    }
}else{
 $("#mensajegregistarentrada").html("<p class='alert alert-danger' role='alert' >"+"Error!!!, Factura no registrada"+"</p>").fadeIn(100).delay(600).fadeOut(1000);   
}    

    
    
}
 function  registrar_salidaproducto_inventario(){
    var codigo_barra = $("#txtcodigosalida").val();
    var stock_actual = $("#txtstock_total_inventario1").val();
    var stock_minimo = $("#txtstock_minimosalida").val();
    var precio_neto = $("#txtprecionetosalida").val();
    var stock_ingresado = $("#txtstockcargarsalida").val();
    var nombre = $("#txtnombrecargarsalida").val();
    var id_salida = $("#txtidsalidaoculto").val();
    var diferencia=parseInt(stock_actual)-parseInt(stock_ingresado);
    if(nombre.trim().length!=0){
    if(parseInt(diferencia)>=stock_minimo){
        if(precio_neto!=0){
            if(stock_ingresado!=0){
        $.post(
    base_url+"Pagina/almacenarsalidaproducto",
    {id_salida:id_salida,codigo_barra:codigo_barra,cantidad:stock_ingresado,precio_neto:precio_neto},
    function(pagina){  
  $("#mensajegsalida").html("<p class='alert alert-success' role='alert' >"+pagina.m1+"</p>").fadeIn(100).delay(600).fadeOut(1000);
  setTimeout("location.reload()",1000); 
    },
    'json'
    );        
                
                
            }else{
                $("#mensajegsalida").html("<p class='alert alert-danger' role='alert' >"+"Error, stock invalido"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
                $("#txtstockcargarsalida").val('');
                $("#txtstockcargarsalida").focus();
            }
        }else{
         $("#mensajegsalida").html("<p class='alert alert-danger' role='alert' >"+"Error, precio neto no valido"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
         $("#txtprecionetosalida").val('');
         $("#txtprecionetosalida").focus()
        }
    }else{
      $("#mensajegsalida").html("<p class='alert alert-danger' role='alert' >"+"Error ,Sobrepasa el stock minimo"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
      $("#txtstockcargarsalida").val('');
      $("#txtstockcargarsalida").focus();
    }    
    }else{
        $("#mensajegsalida").html("<p class='alert alert-danger' role='alert' >"+"Error, Registros no encontrados"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
    }
 }
 function DesBloquiarusuario(codigo){
     $.post(
    base_url+"Pagina/desbloquiar_usuario",
    {codigo:codigo},
    function(vector){  
    var mes="";
              mes="El usuario ha sido desbloqueado  correctamente";
              $("#mesajeusuario").html("<p class='alert alert-success' role='alert' >"+mes+"</p>").fadeIn(100).delay(600).fadeOut(1000);  
     setTimeout("location.reload()",1000);        
    },
    'json'
    );
 }
 function Bloquiarusuario(codigo){
     $.post(
    base_url+"Pagina/bloquiar_usuario",
    {codigo:codigo},
    function(vector){  
    var mes="";
              mes="El usuario ha sido bloqueado  correctamente";
              $("#mesajeusuario").html("<p class='alert alert-success' role='alert' >"+mes+"</p>").fadeIn(100).delay(600).fadeOut(1000);  
     setTimeout("location.reload()",1000);        
    },
    'json'
    );
 }
    function Bloquiarprovedor(codigo){
        $.post(
    base_url+"Pagina/bloquiar_proveedor",
    {codigo:codigo},
    function(vector){  
    var mes="";
              mes="El Proveedor ha sido bloqueado  correctamente";
              $("#mesajeproveedor").html("<p class='alert alert-success' role='alert' >"+mes+"</p>").fadeIn(100).delay(600).fadeOut(1000);  
     setTimeout("location.reload()",1000);        
    },
    'json'
    );
    }
    
    function Bloquiarproductoempresa(codigo){
  $.post(
    base_url+"Pagina/bloquiar_producto_empresa",
    {codigo:codigo},
    function(vector){  
    var mes="";
              mes="El producto ha sido bloqueado  correctamente";
              $("#mesajefds").html("<p class='alert alert-success' role='alert' >"+mes+"</p>").fadeIn(100).delay(600).fadeOut(1000);  
     setTimeout("location.reload()",1000);        
    },
    'json'
    );
}
function DesBloquiarprovedor(codigo){
     $.post(
    base_url+"Pagina/DesBloquiar_proveedor",
    {codigo:codigo},
    function(pagina){  
      var mes="";
              mes="El Proveedor  ha sido desbloqueado  correctamente";
              $("#mesajeproveedor").html("<p class='alert alert-success' role='alert'  >"+mes+"</p>").fadeIn(100).delay(600).fadeOut(1000);  
     setTimeout("location.reload()",1000);      
    },
    'json'
    );
}
function DesBloquiarproductoempresa(codigo){
  $.post(
    base_url+"Pagina/DesBloquiar_producto_empresar",
    {codigo:codigo},
    function(pagina){  
      var mes="";
              mes="El producto  ha sido desbloqueado  correctamente";
              $("#mesajefds").html("<p class='alert alert-success' role='alert' >"+mes+"</p>").fadeIn(100).delay(600).fadeOut(1000);  
     setTimeout("location.reload()",1000);      
    },
    'json'
    );
}
function verificarusuario(){
    
    var rut= $("#rut").val();
    var contraseña=$("#contraseña").val();
    $.post(
    base_url+"Pagina/validarusuario",
    {rut:rut,contraseña:contraseña},
    function(vector){  
         if(vector.mensaj=="usuario valido"){
             $("#mesaje").html("<div class='alert alert-success' role='alert' >"+vector.mensaj+"</div>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",2000);  
         }else{
 $("#mesaje").html("<div class='alert alert-danger' role='alert' >"+vector.mensaj+"</div>").fadeIn(100).delay(600).fadeOut(3000);
             ejecutarefecto1();
           return false;
             
         }  
    },
    'json'
    );

     
 
    
    
    

}