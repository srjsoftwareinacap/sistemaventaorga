 <div class="wrapper">

      <header id="modificar" class="main-header">
       
        <a href="#" class="logo">
        
          <span class="logo-mini"><b>A</b>LT</span>
          
          <span class="logo-lg" id="titulo"><b>Sistema de </b>Ventas</span>
        </a>
        
        <nav class="navbar navbar-static-top" role="navigation">
       
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
            <li   id="sessiones" >
                <a style="color: white" class="btn btn-info  " href="<?php echo base_url().'Pagina/cerrar';?>">
  <i class="fa fa-sign-out  btn-info pull-left"></i> Cerrar session</a>
             
              </li>
        </nav>
         
      </header>
      
      <aside id ="menu" class="main-sidebar">
        
        <section class="sidebar">
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
              <li style="color: white" class="header">Panel de Navegación</li>
            <li class="active treeview">
                <a style="color: red" href="#">
                    <i class="fa fa-shopping-cart"></i> <span>Realizar ventas</span>
              </a>
             
            </li>
        <li class="treeview">
              <a href="<?php echo base_url().'Pagina/V_canceladas';?>">
                <i class="fa fa-bar-chart"></i>
                <span>Reporte de ventas</span>
                
              </a>  
            </li>
          </ul>
        </section>
       
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            
            <small>Realizar ventas</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
          <div  style="text-align: center" id="txtmensajeventas"></div>  
        </section>

        <!-- Main content -->
        <section class="content">
            
            
            <?php if($empesar=="estable") :?>  
            
            <div id="contenido">
                <div class="row">
                    <div  class="col-xs-2" >
                        <strong>Cantidad :</strong>
                    </div> 
                    <div class="col-xs-2">
                     <input type="number"  id="txtcantidad" class="form-control" onkeyup="sacarletras(this)" placeholder="cantidad 0 = 1" >    
                    </div>  
                </div>
                <br />
                 <div class="row">
                     <div  class="col-xs-2" >
                        <strong>Codigo de barra</strong>
                    </div> 
                    <div class="col-xs-2">
                        <input type="text"  id="txtcodigobarra" onkeyup="sacargeneral(this)" class="form-control" placeholder="76543212345" onblur="anadirdetalle(this.value)" >    
                    </div>  
                </div>
                <br />
                <div class="row">
                    <div class="col-xs-2" >
                        <strong> Medio de pago</strong>
                    </div>
                    <div class="col-xs-2" >
                    <select  class="form-control" id="txtmedioselecionado"  >
  <option  value="0" >  Seleccione</option>
 <?php foreach($medios as $valor):?>
 
<option value="<?php echo $valor->id_medio;?>" ><?php echo $valor->nombre_medio?>   </option>  

     <?php endforeach?>
</select>    
                    </div>
                </div>
                <br />
                <div class="row">
                   <div  class="col-xs-2" >
                        <strong>Descuento</strong>
                    </div> 
                    <div class="col-xs-2">
    <input type="text"  id="txtdescuento" class="form-control" placeholder="$" >                    
                    </div>
                </div> 
                <div  id="rowbotones" class="row">
  <div class="col-md-1"></div>
  <div class="col-md-2"><form action="<?php echo base_url().'Pagina/cacelarventaproducto';?>" method="post" id="formcancel12341" >
          <input id="txtidventacancelar" name="codigo" value="<?php echo $idventa;?>" class="hidden">
                        
                        <button type="submit" id="btncancelarventa"  class="fa btn btn-danger" form="formcancel12341" >Cancelar venta</button>
                    </form> </div>
  <div class="col-md-2">
      <form action="javascript:realizarrventa()" method="post" id="formrelizar3455" >
                        <input id="txtidventarealizar" value="<?php echo $idventa;?>" class="hidden">
                        
                        <button type="submit" id="btnralizarventa"  class="fa btn btn-success" form="formrelizar3455" >Confirmar venta</button>
                    </form>  </div>
</div>
                
               
                
            </div>
            <div id="paratabla">
               <div   class="box">
  <div   class="box-body">

<table id="example2" class="table table-bordered table-hover" >
        <th >Nombre</th>
  <th>Precio</th>
  <th>Cantidad</th>
  <th>Sub cantidad</th>

 
  <th>Seleccione</th>
  <?php foreach($detalle_venta as $valor):?>
   
    <tr>
         
      <td  > <?php echo $valor->nombre;?> </td>
      <td  > <?php echo $valor->precio;?> </td>
      <td  > <?php echo $valor->cantidad;?> </td>
      <td  > <?php echo $valor->cantidad*$valor->precio;?> </td>
      <td><a class="fa btn fa-pencil-square-o" aria-hidden="true"  data-target="#mostraredicion_mo_venta"  href="javascript:mostraredicion_mo_cantidad('<?php echo $valor->id_detalle;?>')"></a>
      <a class="fa btn fa-times" aria-hidden="true"    href="javascript:eliminarrpoductoventa('<?php echo $valor->id_detalle;?>')"></a>
      </td>
        <?php
                $sub_total = $sub_total + ($valor->cantidad*$valor->precio);
?>    
    
      
    </tr>
    
     <?php endforeach;?>
      </table>
     
</div> 
       </div>
                <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="mostraredicion_mo_venta">
  <div class="modal-dialog" role="document">
    
    
  </div>
</div>
            </div>
            <div id="roetotal" class="row">
  <div class="col-md-1"></div>
  <div class="col-md-4"><strong><h4>Sub_total</h4></strong></div>
  <div class="col-md-4"><input id="txtsuntotal"  value="<?php echo $sub_total;?>" readonly="readonly" class="form-control"></div>
</div>
<?php else: ?>
            <div class="alert alert-danger" role="alert">Hay mas de dos ventas pendientes</div>
            <?php endif;?>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Sistema Delta motosierras </strong> .
      </footer>

     
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->