 <div class="wrapper">

      <header id="modificar" class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          
          <span class="logo-mini"><b>A</b>LT</span>
          
          <span  style="color: white" class="logo-lg"><b>Sistema de Ventas</span>
        </a>
        
        <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
         
         <li   id="sessiones" >
                <a style="color: white" class="btn btn-info" href="<?php echo base_url().'Pagina/cerrar';?>">
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
            <li class="treeview">
              <a href="<?php echo base_url().'Pagina/R_entrada';?>">
                <i class="fa fa-plus"></i>
                <span>Entrada de Producto</span>
               
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
            <li style="color: red" class="active treeview">
                <a style="color: white" href="#">
                <i class="fa fa-info"></i>
                <strong><span>Reporte Salida</span></strong>
                
              </a>  
            </li>
            <li class="treeview">
              <a href="<?php echo base_url().'Pagina/ir_inventario';?>">
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
            
            <small>Reporte de salidas</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
           <form class="form-inline" id="form12" action="<?php echo base_url().'Pagina/buscar_salida';?>" method="post" >
  <div class="form-group">
  <button type="submit" form="form12" class="btn btn-primary fa fa-search">Buscar por</button>  
  </div>
  <input type="text" class="form-control"  name="buscar_salida" placeholder="codigo o por nombre" onkeyup="sacargeneral(this)"  >
  
  <p style="color:#03a9f4;" ><?php echo $mensaje;?></p>
</form>
         <div  id="tablaentrada" class="box">
  <div   class="box-body">

<table id="example2" class="table table-bordered table-hover" >
        <th >Codigo barra</th>
  <th>Nombre   producto</th>
  <th>Proveedor de Destino</th>
  <th>Cantidad salida</th>
  <th>Fecha</th>
  
  <?php foreach($salidas as $valor):?>
   
    <tr>
      <td  > <?php echo $valor->codigo_barra;?> </td>
      <td  > <?php echo $valor->nombre;?> </td>
      <td  > <?php echo $valor->nombre_empresa;?> </td>

      <td  > <?php echo $valor->cantidad;?> </td>
      <td> <?php echo $valor->fecha;?></td>
      
    </tr>
     <?php endforeach;?>
      </table>
       <ul class="pagination" id="numeros">
            <?php
                       
              echo $links
            ?>
            </ul>
      
</div> 
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     
      
   
    </div>