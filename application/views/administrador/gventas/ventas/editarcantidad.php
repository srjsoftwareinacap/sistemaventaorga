<div id="vermodaleditar" class="modal-content ">
<div class="modal-header btn-primary">

        <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="text-align: center" id="tituloeempresa" ><span class="fa fa-pencil-square-o"></span> Editar Cantidad Venta</h4>
</div>
        
<?php foreach($venta as $valor):?>

    
     <div class="modal-body">
     <form id="form2423"  action="javascript:Editarventa()"  method="post" >



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
      
              <label for=""><span ></span>Cantidad actual</label>
              </div>
              <div class="col-lg-5">
             <input class="form-control" id="txtcantidadventa" type="text"  required="true" value="<?php echo $valor->cantidad_detalle;?>" onkeyup="sacarletras(this)" maxlength="45" >
             </div>
            </div>
    <input class="form-control hidden" id="txtcodigobarraventa" type="text"   value="<?php echo $valor->codigo_barra;?>"
         
    <br />
     <input class="form-control hidden" id="txtcantidadanterior" type="text"   value="<?php echo $valor->cantidad_detalle;?>"
            <div class="row">
                <input class="form-control hidden" id="txtproducotstolaninventario" type="text"   value="<?php echo $valor->cantidad;?>"
<div class="col-lg-4">
        <input class="form-control hidden" id="txtiddetalle" type="text"   value="<?php echo $valor->id_detalle;?>" >
       
        
        
        <?php endforeach;?>
        <br />
        <button type="submit" id="botoneditarcantidad" form="form2423" value="Submit" class="btn btn-primary" >Editar</button>       
             

 <div style="text-align: center" id="mesajemodaleditarcantidad"></div>
 </form>
      </div>
     
</div>
     	
     

  
      
     
      
         

    
