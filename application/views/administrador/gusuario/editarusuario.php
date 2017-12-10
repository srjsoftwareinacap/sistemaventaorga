<div id="vermodaleditar" class="modal-content ">

<div class="modal-header alert-info">

        <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="text-align: center" id="tituloeempresa" ><span class="fa fa-pencil-square-o"></span> Editar usuario</h4>
</div>
        


    
     <div class="modal-body">
     <form id="form2423"  action="javascript:Editarusuarioempresa()"  method="post" >
<div >
<div class="row">
<div class="col-lg-4">
      
              <label for="usrname"><span ></span> Rut usuario</label>
              </div>
              <div class="col-lg-5">
                  <input class="form-control" readonly="readonly" id="txteditar_usuario" type="text"  required="true" value="<?php echo $rut;?>" onkeyup="sacargeneral(this)" >
             </div>
            </div>

            <div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Nombre usuario</label>
              </div>
              <div class="col-lg-5">
             <input class="form-control" id="txteditar_nombre" type="text"  required="true" value="<?php echo $nombre_usuario;?>" onkeyup="sacargeneral(this)" >
             </div>
                <div class="col-lg-3">
      
              <label for=""><span ></span>*</label>
              </div>
            </div>
<div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Contraseña</label>
              </div>
              <div class="col-lg-5">
             <input class="form-control" id="txteditar_contraseña" type="text"  required="true" value="<?php echo $contraseña;?>" onkeyup="sacargeneral(this)" >
             </div>
    <div class="col-lg-3">
      
              <label for=""><span ></span>*</label>
              </div>
            </div>
            <div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Perfil usuario</label>
              </div>
              <div class="col-lg-5">
             <select class="form-control" id="perfil_editar"  >
  <option   value="0" >  Seleccione perfil</option>
 


<option  value="<?php echo 100;?>" >Administrador</option>
<option  value="<?php echo 50;?>" >Operador /reparador</option>
     
</select>
             </div>
                <div class="col-lg-3">
      
              <label for=""><span ></span>*</label>
              </div>
            </div>
    
            
    
         
    <br />
            <div class="row">
<div class="col-lg-4">
        <input class="form-control hidden" id="txtcodigo_rut_oculto" type="text"   value="<?php echo $rut_usuario;?>" >
        
              </div>
              <div class="col-lg-8">
            <button type="submit" form="form2423" value="Submit" class="btn btn-primary" >Editar usuario</button>
            
            </div>

 
      </div>

     	
     <div style="text-align: center" id="mesajemodaleditarusuario"></div>

  
      </div>
     
      
         </form>

    </div>
    </div>