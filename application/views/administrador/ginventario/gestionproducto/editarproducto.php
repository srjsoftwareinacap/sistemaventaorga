<div id="vermodaleditar" class="modal-content ">

<div class="modal-header alert-info">

        <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="text-align: center" id="tituloeempresa" ><span class="fa fa-pencil-square-o"></span> Editar producto</h4>
</div>
        


    
     <div class="modal-body">
     <form id="form2423"  action="javascript:Editarproductoempresa()"  method="post" >
<div >
<div class="row">
<div class="col-lg-4">
      
              <label for="usrname"><span ></span> Codigo de barra</label>
              </div>
              <div class="col-lg-5">
                  <input class="form-control" readonly="readonly" id="txtcodigo_barra_nuevo" type="text"  required="true" value="<?php echo $codigo_barra;?>" onkeyup="sacargeneral(this)" >
             </div>
            </div>

            <div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Nombre producto</label>
              </div>
              <div class="col-lg-5">
             <input class="form-control" id="txtnombree_nuevo" type="text"  required="true" value="<?php echo $nombre;?>" onkeyup="sacargeneral(this)" >
             </div>
            </div>
<div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>descripcion</label>
              </div>
              <div class="col-lg-5">
                  <textarea class="form-control" id="txtdescripcion_nuevo" type="text"  required="true"  onkeyup="sacargeneral(this)" ><?php echo $descripccion;?></textarea>
             </div>
            </div>
            <div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Familia</label>
              </div>
              <div class="col-lg-5">
             <select class="form-control" id="productoseleccioado_modificar"  >
  <option   value="0" >  Seleccione familia</option>
 <?php foreach($familia as $variable):?>


<option  value="<?php echo $variable->id_familia;?>" ><?php echo $variable->tipo_familia;?></option>

     <?php endforeach?>
</select>
             </div>
            </div>
    
            <div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Stock minimo</label>
              </div>
              <div class="col-lg-5">
             <input class="form-control" id="txtstockminimonuevo" type="number"  required="true" value="<?php echo $stock_minimo;?>" onkeyup="sacarletras(this)" maxlength="45" >
             </div>
            </div>
          
         
    <br />
            <div class="row">
<div class="col-lg-4">
        <input class="form-control hidden" id="txtcodigo_viejooculto" type="text"   value="<?php echo $codigo_barra;?>" >
        <input class="form-control hidden" id="txtstockminimo_oculto" type="text"   value="<?php echo $minimo;?>"  >
      <input class="form-control hidden" id="informacion" type="text"   value="<?php echo $informacion;?>"  >
        
              </div>
              <div class="col-lg-8">
            <button type="submit" form="form2423" value="Submit" class="btn btn-primary" >Editar</button>
            
            </div>

 
      </div>

     	
     <div id="mesajemodaleditarfamilia"></div>

  
      </div>
     
      
         </form>

    </div>
    </div>