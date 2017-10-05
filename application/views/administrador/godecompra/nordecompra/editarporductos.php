<div id="vermodaleditar" class="modal-content modal-lg">
    <div class="modal-header alert-info">

        <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="text-align: center" id="tituloeempresa" ><span class="fa fa-pencil-square-o"></span> Detalle Prosupuesto</h4>
</div>
    <div class="modal-body">
        
   <div class="row">
  <div class="col-xs-4">
      <table class="table">
          <tr>
              <td><label  for="psw"><span ></span>Cantidad</label></td>       
              <td>  <input type="number" required="true" class="form-control"  id="txtCantidaddetallepro" onkeyup="sacarletras(this)"  placeholder="0 = 1" maxlength="45" ></td>
              </tr>
              <tr>
              <td><label  for="psw"><span ></span>Codigo</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtCodigoddetallepro" onkeyup="sacargeneral(this)"  placeholder="Codigo" maxlength="45" ></td>
              </tr>
              <tr>
                  <td>  <br />
              </td>
            
      </tr>
              <tr>
              <td><label  for="psw"><span ></span>Mano de obra</label></td>       
              <td>  <input type="number" required="true" class="form-control"  id="txtmanodeobraddetallepro" onkeyup="sacarletras(this)"  placeholder="$ precio" maxlength="45" ></td>
              </tr>
              <tr>
              <td><label  for="psw"><span ></span>Descuento especial</label></td>       
            <td>  <input type="number" required="true" class="form-control"  id="txtdescuentoespecialdetallepro" onkeyup="sacarletras(this)"  placeholder="descuento" maxlength="45" ></td>
              </tr>
      </table>
          
  </div>
       
       
       
       
  <div class="col-xs-8">
     <table id="tbaladetallereparacion" class="table table-bordered table-hover" >
        <th >N° Orden</th>
  <th>Nombre Producto</th>
  <th>Precio</th>
  <th>Cantidad</th>
<th>Sub total</th>
 
  <th>Seleccione</th>
  <?php foreach($lista as $valor):?>
   
    <tr>
         
      <td  > <?php echo $valor->idf_orden;?> </td>
      <td  > <?php echo $valor->nombre;?> </td>
      <td  > <?php echo $valor->precio_bruto;?> </td>
      <td  > <?php echo $valor->cantidad;?> </td>
      <td  > <?php echo $valor->cantidad*$valor->precio_bruto;?> </td>
      <td><a class="fa btn fa-pencil-square-o" aria-hidden="true"  data-target="#mostraredicion_mo_venta"  href="javascript:mostraredicion_modetalle_reparacion('<?php echo $valor->id_detalle_reparacion;?>')"></a>
      <a class="fa btn fa-times" aria-hidden="true"    href="javascript:eliminarrpoductomodetalle_reparacion('<?php echo $valor->id_detalle_reparacion;?>')"></a>
      </td>
        <?php
                $sub_total = $sub_total + ($valor->cantidad*$valor->precio_bruto);
?>    
    
      
    </tr>
    
     <?php endforeach;?>
      </table>
            <div id="roetotal" class="row">

  <div class="col-md-1"><strong><h4>Sub_total</h4></strong></div>
  <div class="col-md-11"><input id="txtsuntotal"  value="<?php echo $sub_total;?>" readonly="readonly" class="form-control"></div>
</div>
      
      <div  id="rowbotones" class="row">
  <div class="col-md-1"></div>
  <div class="col-md-2"><form action="<?php echo base_url().'Pagina/cacelarventaproducto';?>" method="post" id="formcancel12341" >
          <input id="txtidventacancelar" name="codigo" value="<?php echo $idventa;?>" class="hidden">
                        
                        <button type="submit" id="btncancelarprosupuesto"  class="fa btn btn-danger" form="formcancel12341" >Cancelar venta</button>
                    </form> </div>
  <div class="col-md-2">
      <form action="javascript:realizarrventa()" method="post" id="formrelizar3455" >
                        <input id="txtidventarealizar" value="<?php echo $idventa;?>" class="hidden">
                        
                        <button type="submit" id="btndetalleprosupuesto"  class="fa btn btn-success" form="formrelizar3455" >Confirmar venta</button>
                    </form>  </div>
</div>
  </div>
</div>
               

    </div>
</div>
