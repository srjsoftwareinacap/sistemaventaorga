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
                 $("#mesajemodalfamilia").html("<p class='msj' >"+"Tipo Familia Almacenada  Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000);
             }else{
                $("#mesajemodalfamilia").html("<p class='msjerror' >"+"!!Eroor ,El codigo ya existe"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
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
  var precioneto= $("#txtprecioneto").val();
  var preciobruto= $("#txtpreciobruto").val();
  var stock= $("#txtstock").val();
  var mensaje="";
  var precio_bruto= parseInt(precioneto)*0.19 +parseInt(precioneto);
  if(familia==0){
      $("#mesajemodalproducto").html("<p class='msjerror' >"+"!!Eroor , Tipo de familia no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  }else{
      if( parseInt(stock)>=1){
          var estimarpreciobruto= parseInt(precioneto)*0.19 +parseInt(precioneto);
          if(parseInt(preciobruto) >= parseInt(estimarpreciobruto)  ){
             $.post(
    base_url+"Pagina/almacenar_producto",
    {codigo:codigo,nombre:nombre,descripcion:descripcion,familia:familia,precioneto:precioneto,stock:stock,precio_bruto:preciobruto},
    function(datos){  
    if(datos.mensaj=="si"){
             $("#mesajemodalproducto").html("<p class='msj' >"+"Producto guardado Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000); 
 }else{
  $("#mesajemodalproducto").html("<p class='msjerror' >"+"!!Error ,El codigo ya existe"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtcodigo").val('');
  $("#txtcodigo").focus();
     }       
    },
    'json'
    ); 
          }else{
              $("#mesajemodalproducto").html("<p class='msjerror' >"+"!!Error ,El Precio Bruto no es rentable"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtpreciobruto").val('');
  $("#txtpreciobruto").focus();
          }
      }else{
          $("#mesajemodalproducto").html("<p class='msjerror' >"+"!!Error ,El Stock minimo Insuficiente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
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
    function Editarproductoempresa(){
        var codigo_barra_nuevo =$("#txtcodigo_barra_nuevo").val();
        var nombre_nuevo= $("#txtnombree_nuevo").val();
        var descripcion = $("#txtdescripcion_nuevo").val();
        var id_familia = $("#productoseleccioado_modificar").val();
        var precio_neto = $("#txtprecionetonuevo").val();
        var stock_minimo = $("#txtstockminimonuevo").val();
        var precio_bruto = $("#txtpreciobrutonuevo").val();
        var codigo_viejo = $("#txtcodigo_viejooculto").val();
        var stock_oculto= $("#txtstockminimo_oculto").val();
        var informacion= $("#informacion").val();
        var precio_brutoestimado = parseInt(precio_neto) + parseInt(precio_neto)*0.19;
        
        if(informacion=="no"){
        if(id_familia!=0){
         if(parseInt(precio_bruto) >= parseInt(precio_brutoestimado)){
             
        $.post(
    base_url+"Pagina/editar_producto",
    {codigo_barra_nuevo:codigo_barra_nuevo,nombre_nuevo:nombre_nuevo,descripcion:descripcion,id_familia:id_familia,precio_neto:precio_neto,stock_minimo:stock_minimo,precio_bruto:precio_bruto,codigo_viejo:codigo_viejo},
    function(datos){  
           if(datos.mensaj=="si"){
               $("#mesajemodaleditarfamilia").html("<p class='msj' >"+"Producto editado Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000); 
           }else{
                 $("#mesajemodaleditarfamilia").html("<p class='msjerror' >"+"!! Error, El codigo ya existe "+"</p>").fadeIn(100).delay(600).fadeOut(3000);
                 $("#txtcodigo_barra_nuevo").val('');
                 $("#txtcodigo_barra_nuevo").focus();
           }   
    },
    'json'
    );     
         }else{
  $("#mesajemodaleditarfamilia").html("<p class='msjerror' >"+"!!Error ,El Precio Bruto no es rentable"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtpreciobrutonuevo").val('');
  $("#txtpreciobrutonuevo").focus();
         }   
     }else{
          $("#mesajemodaleditarfamilia").html("<p class='msjerror' >"+"!!Eroor , Tipo de familia no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     }
 }else{
     if(parseInt(stock_minimo) <= parseInt(stock_oculto)){
     if(id_familia!=0){
         if(parseInt(precio_bruto) >= parseInt(precio_brutoestimado)){
             
        $.post(
    base_url+"Pagina/editar_producto",
    {codigo_barra_nuevo:codigo_barra_nuevo,nombre_nuevo:nombre_nuevo,descripcion:descripcion,id_familia:id_familia,precio_neto:precio_neto,stock_minimo:stock_minimo,precio_bruto:precio_bruto,codigo_viejo:codigo_viejo},
    function(datos){  
           if(datos.mensaj=="si"){
               $("#mesajemodaleditarfamilia").html("<p class='msj' >"+"Producto editado Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000); 
           }else{
                 $("#mesajemodaleditarfamilia").html("<p class='msjerror' >"+"!! Error, El codigo ya existe "+"</p>").fadeIn(100).delay(600).fadeOut(3000);
                 $("#txtcodigo_barra_nuevo").val('');
                 $("#txtcodigo_barra_nuevo").focus();
           }   
    },
    'json'
    );     
         }else{
  $("#mesajemodaleditarfamilia").html("<p class='msjerror' >"+"!!Error ,El Precio Bruto no es rentable"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtpreciobrutonuevo").val('');
  $("#txtpreciobrutonuevo").focus();
         }   
     }else{
          $("#mesajemodaleditarfamilia").html("<p class='msjerror' >"+"!!Eroor , Tipo de familia no seleccionada"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     }
 }else{
     $("#mesajemodaleditarfamilia").html("<p class='msjerror' >"+"!!Error ,El stock sobrepasa el stock de el inventario"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtstockminimonuevo").val('');
  $("#txtstockminimonuevo").focus();
 }
 }
    }
    function vereficaridinventario12(codigos,$codigo_barra){
        
  $.post(
    base_url+"Pagina/vereficarinventario",
    {codigos:codigos},
    function(datos){
        if(datos.m1=="Producto en registro"){
      $("#mensajegentrada").html("<p class='msj' >"+datos.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
      $("#txtnombrecargar").val(datos.nombre);
      $("#txtdescripcioncargar").val(datos.descripcion);
      $("#txtfamiliacargar").val(datos.familia);
      $("#txtstock_minimo").val(datos.stock_minimo);
      $("#txtprecionetocargar").val(datos.precio_bruto); 
      $("#txtstock_total").val(datos.stock_maximo);
  }else{
      $("#mensajegentrada").html("<p class='msjerror' >"+datos.m1+"</p>").fadeIn(100).delay(600).fadeOut(3000);
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
    
    
    alert("hola");
    if(nombre.trim().length > 0){
    if(parseInt(stock_actual) ==0){
        if(parseInt(stock_ingresado) >= parseInt(stock_minimo)){
            
          $.post(
    base_url+"Pagina/registrarinventario",
    {codigo_barra:codigo_barra,stock_ingresado:stock_ingresado},
    function(pagina){  
              $("#mensajegentrada").html("<p class='msj' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(1000);
    },
    'json'
    );  
        }else{
        $("#mensajegentrada").html("<p class='msjerror' >"+"Error!!!, No cumple con el stock minimo"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
         $("#txtstockcargar").val('');
        $("#txtstockcargar").focus();  
        }
    }else{
        //ver con stock
        $.post(
    base_url+"Pagina/registrarinventario",
    {codigo_barra:codigo_barra,stock_ingresado:stock_ingresado},
    function(pagina){  
              $("#mensajegentrada").html("<p class='msj' >"+pagina.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(1000);
    },
    'json'
    ); 
    }    
    }else{
        $("#mensajegentrada").html("<p class='msjerror' >"+"Error!!!, El producto no esta registrado"+"</p>").fadeIn(100).delay(600).fadeOut(1000);
        $("#txtcodigo").val('');
        $("#txtcodigo").focus();
    }
        
    
    
}
    
    
    function Bloquiarproductoempresa(codigo){
  $.post(
    base_url+"Pagina/bloquiar_producto_empresa",
    {codigo:codigo},
    function(vector){  
    var mes="";
              mes="El producto ha sido bloqueado  correctamente";
              $("#mesajefds").html("<p class='msj' >"+mes+"</p>").fadeIn(100).delay(600).fadeOut(1000);  
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
              $("#mesajefds").html("<p class='msj' >"+mes+"</p>").fadeIn(100).delay(600).fadeOut(1000);  
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
             $("#mesaje").html("<p class='msj' >"+vector.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",2000);  
         }else{
 $("#mesaje").html("<p class='msjerror' >"+vector.mensaj+"</p>").fadeIn(100).delay(600).fadeOut(3000);
             ejecutarefecto1();
           return false;
             
         }  
    },
    'json'
    );

     
 
    
    
    

}