<div id="vermodaleditar" class="modal-content ">

<div class="modal-header alert-info">

        <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="text-align: center" id="tituloeempresa" ><span class="fa fa-pencil-square-o"></span> Editar Cantidad inventario</h4>
</div>
        
<?php foreach($inventario as $valor):?>

    
     <div class="modal-body">
     <form id="form2423"  action="javascript:Editarinventario()"  method="post" >
<div >
<div class="row">
<div class="col-lg-4">
      
              <label for="usrname"><span ></span> Codigo de barra</label>
              </div>
              <div class="col-lg-5">
                  <input class="form-control" readonly="readonly" id="txtcodigo_barrainventario" type="text"   required="true" value="<?php echo $valor->codigo_barra;?>" onkeyup="sacargeneral(this)" >
             </div>
            </div>

            <div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Nombre producto</label>
              </div>
              <div class="col-lg-5">
                  <input class="form-control" id="txtnombree_nuevo" type="text" readonly="readonly" required="true" value="<?php echo $valor->nombre;?>" onkeyup="sacargeneral(this)" >
             </div>
            </div>
<div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Descripcion</label>
              </div>
              <div class="col-lg-5">
                  <textarea class="form-control" id="txtdescripcion_nuevo" type="text" readonly="readonly" required="true"  onkeyup="sacargeneral(this)" ><?php echo $valor->descripcion;?></textarea>
             </div>
            </div>
    <div class="row">
        <div class="col-lg-4">
      
              <label for=""><span ></span>Tipo familia</label>
              </div>
              <div class="col-lg-5">
                  <input class="form-control" id="tipofamilia" type="text" readonly="readonly"  required="true" value="<?php echo $valor->tipo_familia;?>"  maxlength="45" >
             </div>
    </div>
            <div class="row">
<div class="col-lg-4">
      
              <label for=""><span ></span>Cantidad actual</label>
              </div>
              <div class="col-lg-5">
             <input class="form-control" id="txtstockinventarionuevo" type="number"  required="true" value="<?php echo $valor->cantidad;?>" onkeyup="sacarletras(this)" maxlength="45" >
             </div>
            </div>
    
         
    <br />
            <div class="row">
<div class="col-lg-4">
        <input class="form-control hidden" id="txtstock_minimo" type="text"   value="<?php echo $valor->stock_minimo;?>" >
        
        <?php endforeach;?>
              </div>
              <div class="col-lg-8">
            <button type="submit" form="form2423" value="Submit" class="btn btn-primary" >Editar</button>
            
            </div>

 
      </div>

     	
     <div style="text-align: center" id="mesajemodaleditarinventario"></div>

  
      </div>
     
      
         </form>

    </div>
    </div>