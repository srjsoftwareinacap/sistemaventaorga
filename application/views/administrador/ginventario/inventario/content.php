 <div class="wrapper">

      <header id="modificar" class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          
          <span class="logo-mini"><b>A</b>LT</span>
          
          <span style="color: white" class="logo-lg"><b>Sistema de Ventas</span>
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
          
         
          <ul class="sidebar-menu">
              <li  style="color: white" class="header">Panel de Navegacion</li>
              
            <li   class="treeview">
              <a href="<?php echo base_url().'Pagina/G_producto';?>">
                <i class="fa fa-barcode"></i> <span>Gestion Producto</span> 
              </a>
              
            </li>
            <li  class="treeview">
              <a  href="<?php echo base_url().'Pagina/R_entrada';?>">
                <i class="fa fa-plus"></i>
                <strong><span>Entrada de Producto</span></strong>
               
              </a>
         
            </li>
            <li>
              <a href="<?php echo base_url().'Pagina/R_salida';?>">
                <i class="fa fa-reply"></i> <span>Salida de Producto</span> 
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url().'Pagina/L_entrada';?>">
                <i class="fa fa-info"></i>
                <span>Reporte Entrada</span>
                
              </a>  
            </li>
              <li class="treeview">
              <a href="<?php echo base_url().'Pagina/L_salida';?>">
                <i class="fa fa-info"></i>
                <span>Reporte Salida</span>
                
              </a>  
            </li>
            <li class="treeview">
              <a  style="color: white" href="#">
                <i class="fa fa-list-ol"></i>
                <span>Inventario</span>
                
              </a>  
            </li>
            
            
            <li class="treeview">
              <a href="<?php echo base_url().'Pagina/G_proveedor';?>">
                <i class="fa fa-shopping-cart"></i>
                <span>Gestion Proveedor</span>
              </a>  
            </li>
        </ul>
        </section>
      </aside>
   
 <div id="contentgproducto" class="content-wrapper">
        
        <section class="content-header">
          <h1>
            
            <small>Lista de inventario</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
           <?php if( $cantidadminimos>0) :?>
            <div class="alert alert-info" id="alertamensaje" role="alert">Alerta de stock minimo de productos, actualmente son  :   <strong><?php echo $cantidadminimos;?></strong>  </div>
            <?php endif;?>
        <?php if( $suma>0) :?>
            <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Reportes</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            <?php foreach($stock_minimo as $valor):?>
             <?php if($variable<=3) :?>
           <?php if($variable==0) :?>
            
             <div class="row">
                 <div id="achicar" class="col-md-3">
              <div class="box box-danger box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Nombre:  <?php echo $valor->nombre;?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   Stock actual : <?php echo $valor->cantidad;?><br />
                Descripcion:   <?php echo $valor->descripcion;?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
              <?php
                $limite=$limite+1;
?>      
       <?php if($limite==$cantidadminimos) :?>
                 <?php echo $fin;?>
                 <?php endif;?>
                <?php
                $variable=$variable+1;
?>    
      <?php else: ?>
         <?php if($variable==1) :?>  
            <div  class="col-md-3">
              <div class="box box-danger box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Nombre: <?php echo $valor->nombre;?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    Stock actual: <?php echo $valor->cantidad;?><br />
                  Descripcion: <?php echo $valor->descripcion;?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
             <?php
                $limite=$limite+1;
?>      
       <?php if($limite==$cantidadminimos) :?>
                 <?php echo $fin;?>
                 
                 <?php endif;?>
                <?php
                $variable=$variable+1;
?>    
      <?php else: ?>
           <?php if($variable==2) :?> 
                 <div class="col-md-3">
              <div class="box box-danger box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Nombre: <?php echo $valor->nombre;?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   Stock minimo <?php echo $valor->cantidad;?><br />
                 Descripcion <?php echo $valor->descripcion;?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
      <?php
                $limite=$limite+1;
?>      
       <?php if($limite==$cantidadminimos) :?>
                 <?php echo $fin;?>
                 <?php endif;?>
                <?php
                $variable=$variable+1;
?>    
          <?php else: ?>       
          <?php if($variable==3) :?> 
                 <div class="col-md-3">
              <div class="box box-danger box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Nombre: <?php echo $valor->nombre;?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                   Stock minimo <?php echo $valor->cantidad;?><br />
                Descripcion  <?php echo $valor->descripcion;?>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php echo $fin;?>
                 <?php if($limite==$cantidadminimos) :?>
               <?php echo $fin;?>
                 <?php endif;?>
                <?php
                $variable=0;
?>    
                 <?php endif;?>
                 <?php endif;?>
                 <?php endif;?>
<?php endif;?>
                 
                 <?php endif;?>
            
            <?php endforeach;?>
            
            
         </div><!-- /.box-body -->
              </div><!-- /.box -->    
            
            <?php if($cantidadminimos>=5) :?>
              <?php echo $fin;?>
            <?php endif;?>
            
           <form class="form-inline" id="form1fasdf24122" action="<?php echo base_url().'Pagina/buscar_productosinventario';?>" method="post" >
  <div class="form-group">
  <button type="submit" form="form1fasdf24122" class="btn btn-primary fa fa-search">Buscar por</button>  
  </div>
  <input type="text" class="form-control"  name="buscar_inventario" placeholder="codigo o por nombre" onkeyup="sacargeneral(this)"  >
  <p style="color:#03a9f4;" ><?php echo $mensaje;?></p>
</form> 
 <div  id="tablaproveedor" class="box">
      <div   class="box-body">
          <table id="example2" class="table table-bordered table-hover" >
                   <th >Codigo barra</th>
  <th>Nombre  producto </th>
  <th>Descripcion</th>
  <th>Tipo Familia</th>
  <th>Stock minimo</th>
  <th>Cantidad total</th>
  
  <th>Seleccione</th>
  
  <?php foreach($productosin as $valor):?>
   
    <tr>
      <td  > <?php echo $valor->codigo_barra;?> </td>
      <td  > <?php echo $valor->nombre;?> </td>
      <td  > <?php echo $valor->descripcion;?> </td>
        <td  > <?php echo $valor->tipo_familia;?> </td>
      <td  > <?php echo $valor->stock_minimo;?> </td>  
      <td  > <?php echo $valor->cantidad;?> </td>
      <td >
    


      <a class="fa btn fa-pencil-square-o" aria-hidden="true"  data-target="#mostraredicion_inventarioproducto"  href="javascript:mostraredicion_inventario('<?php echo $valor->codigo_barra;?>')"></a>

    
      </td>
    </tr>
  
     <?php endforeach;?>
          </table>
           <ul class="pagination" id="numeros">
            <?php
                       
              echo $links
            ?>
            </ul>
            <div id="mesajeproveedor"></div>
      </div>
  </div>           
             <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="mostraredicion_inventarioproducto">
  <div class="modal-dialog" role="document">
    
    
  </div>
</div>
            
            
            
             <?php else: ?>
            <div class="alert alert-info" role="alert">No hay inventario en su empresa</div>
           <?php endif;?> 
            
            
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
     

      
   
    </div>