<div id="vermodaleditar" class="modal-content modal-lg">
    <div class="modal-body">
        
   <div class="row">
  <div class="col-xs-6">.col-xs-6</div>
  <div class="col-xs-6">
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
  </div>
</div>
               

    </div>
</div>
