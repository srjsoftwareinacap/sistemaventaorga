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
    function  almacenar_producto(){
        var codigo= $("#txtcodigo").val();
  var nombre= $("#txtnombre").val();
  var descripcion= $("#txtdescripcion").val();
  var familia= $("#productoseleccioado").val();
  var stock= $("#txtstock").val();
  
  $.post(
    base_url+"Pagina/almacenar_producto",
    {codigo:codigo,nombre:nombre,descripcion:descripcion,familia:familia,stock:stock},
    function(datos){  
    if(datos.mensaje=="si"){
             $("#mesajemodalproducto").html("<p class='msj' >"+"Producto guardado Correctamente"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
     setTimeout("location.reload()",3000); 
 }else{
  $("#mesajemodalproducto").html("<p class='msjerror' >"+"!!Eroor ,El codigo ya existe"+"</p>").fadeIn(100).delay(600).fadeOut(3000);
  $("#txtcodigo").val('');
  $("#txtcodigo").focus();
     }       
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