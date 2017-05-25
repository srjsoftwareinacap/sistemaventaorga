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
    function abrirmodalentrada(){
        $("#modalentradaproducto").modal({
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
  
  var stock= $("#txtstock").val();
  var mensaje="";
  
  if(familia==0){
      $("#mesajemodalproducto").html("<p class='alert alert-danger' role='alert' >"+"!!Eroor , Tipo de familia no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  }else{
      if( parseInt(stock)>=1){
          
             $.post(
    base_url+"Pagina/almacenar_producto",
    {codigo:codigo,nombre:nombre,descripcion:descripcion,familia:familia,stock:stock},
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
        var informacion= $("#informacion").val();
       
        
        if(informacion=="no"){
        if(id_familia!=0){
        
             
        $.post(
    base_url+"Pagina/editar_producto",
    {codigo_barra_nuevo:codigo_barra_nuevo,nombre_nuevo:nombre_nuevo,descripcion:descripcion,id_familia:id_familia,stock_minimo:stock_minimo,codigo_viejo:codigo_viejo},
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
    {codigo_barra_nuevo:codigo_barra_nuevo,nombre_nuevo:nombre_nuevo,descripcion:descripcion,id_familia:id_familia,precio_neto:precio_neto,stock_minimo:stock_minimo,precio_bruto:precio_bruto,codigo_viejo:codigo_viejo},
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
    function vereficaridinventario12(codigos,$codigo_barra){
        
  $.post(
    base_url+"Pagina/vereficarinventario",
    {codigos:codigos},
    function(datos){
        if(datos.m1=="Producto en registro"){
      $("#mensajegentrada").html("<p class='alert alert-success' role='alert' >"+datos.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      $("#txtnombrecargar").val(datos.nombre);
      $("#txtdescripcioncargar").val(datos.descripcion);
      $("#txtfamiliacargar").val(datos.familia);
      $("#txtstock_minimo").val(datos.stock_minimo);
      $("#txtprecionetocargar").val(datos.precio_bruto); 
      $("#txtstock_total").val(datos.stock_maximo);
  }else{
      $("#mensajegentrada").html("<p class='alert alert-danger' role='alert' >"+datos.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      $("#txtcodigo").val('');
  $("#txtcodigo").focus();
  }
    },
    'json'
    );

}
function  registrar_producto_inventario(){
    
    var codigo_barra = $("#txtcodigo").val();
    var stock_actual = $("#txtstock_total").val();
    var stock_minimo = $("#txtstock_minimo").val();
    var stock_ingresado = $("#txtstockcargar").val();
    var nombre = $("#txtnombrecargar").val();
    var suma = parseInt(stock_actual) + parseInt(stock_ingresado);
    
    
   
    if(nombre.trim().length > 0){
    if(parseInt(stock_actual) ==0){
        if(parseInt(stock_ingresado) >= parseInt(stock_minimo)){
            
          $.post(
    base_url+"Pagina/registrarinventario",
    {codigo_barra:codigo_barra,stock_ingresado:stock_ingresado},
    function(pagina){  
              $("#mensajegentrada").html("<p class='alert alert-success' role='alert' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(1000);
    },
    'json'
    );  
        }else{
        $("#mensajegentrada").html("<p class='alert alert-danger' role='alert' >"+"Error!!!, No cumple con el stock minimo"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
         $("#txtstockcargar").val('');
        $("#txtstockcargar").focus();  
        }
    }else{
        //ver con stock
        $.post(
    base_url+"Pagina/registrarinventario",
    {codigo_barra:codigo_barra,stock_ingresado:stock_ingresado},
    function(pagina){  
              $("#mensajegentrada").html("<p class='alert alert-success' role='alert' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(1000);
    },
    'json'
    ); 
    }    
    }else{
        $("#mensajegentrada").html("<p class='alert alert-danger' role='alert' >"+"Error!!!, El producto no esta registrado"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
        $("#txtcodigo").val('');
        $("#txtcodigo").focus();
    }
        
    
    
}
 function  registrar_salidaproducto_inventario(){
    var codigo_barra = $("#txtcodigo").val();
    var stock_actual = $("#txtstock_total").val();
    var stock_minimo = $("#txtstock_minimo").val();
    var stock_ingresado = $("#txtstockcargar").val();
    var nombre = $("#txtnombrecargar").val();
    var diferencia=parseInt(stock_actual)-parseInt(stock_ingresado);
    $.post(
    base_url+"Pagina/verproducto",
    {codigo_barra:codigo_barra},
    function(vector){  
    if(vector.mensaje=="si"){
        if(nombre.trim().length > 0){
        if(parseInt(stock_actual)>0){
        if(parseInt(diferencia) >= stock_minimo){
            $.post(
    base_url+"Pagina/registrar_salida",
    {codigo_barra:codigo_barra,stock_ingresado:stock_ingresado},
    function(data){       
         
        $("#mensajegsalida").html("<p class='alert alert-success' role='alert' >"+data.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(3000);
          setTimeout("location.reload()",1000);  
    },
    'json'
    );
            
        }else{
            $("#mensajegsalida").html("<p class='alert alert-danger' role='alert' >"+"Error , la cantidad ingresada sobrepasa al stock real"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
            $("#txtstockcargar").val('');
        }
        
        
    }else{
        $("#mensajegsalida").html("<p class='alert alert-danger' role='alert' >"+"Error , no hay stock en el inventario"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
    }
        
    }else{
        $("#mensajegsalida").html("<p class='alert alert-danger' role='alert'' >"+"Error , no se ha encontrado registro"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
        $("#txtcodigo").val('');
    }
        
        
    }else{
        $("#mensajegsalida").html("<p class='alert alert-danger' role='alert' >"+"Error ,codigo no valido"+"</p>").fadeIn(100).delay(600).fadeOut(1000); 
    }
              
           
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