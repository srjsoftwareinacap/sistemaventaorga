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


   
    cargarContent();
});
function cargarContent(){
   $.post(
        base_url+"pagina/cargarcontent",{},
        function(vector){
            if(vector.mensaje=="abrirmodal"){
$("#myModal_login").modal({
        show:true,
        backdrop: 'static'
      });
            }else{
              $("#myModal_login").modal('hide');
              $.post(
                 base_url+"Controlador/cargarredireccionar",{},{}
                );
          
            }
            
            

            
        },
        'json'
    );
}