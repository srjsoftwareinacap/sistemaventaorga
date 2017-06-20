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
                <a  href="<?php echo base_url().'Pagina/ordentrabajo';?>">
                <i class="fa fa-bars"></i> <span>Nueva orden de Registro</span> 
              </a>
             
            </li>
        <li class="active treeview">
              <a  style="color: red" href="#">
                <i class="fa fa-bars"></i> <span>Retiro</span> 
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
            
            <small>Panel de Control</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <form class="form-inline" id="form12" action="<?php echo base_url().'Pagina/rutclientereirp';?>" method="post" >
  <div class="form-group">
  <button type="submit" form="form12" class="btn alert-success fa fa-search">Buscar por</button>  
  </div>
  <input type="text" class="form-control"  name="buscar_rutclienteretiro" placeholder="rut cliente" onkeyup="sacargeneral(this)"  >
  
  <p style="color:#03a9f4;" ><?php echo $mensaje;?></p>
</form>
           
            
 <div  id="tablaorden" class="box">
      <div   class="box-body">
          <table id="example2" class="table table-bordered table-hover" >
  <th >Numero Orden de trabajo</th>
  <th>Fecha recepcion</th>   
  <th>Nombre Cliente</th>
  <th>Rut Cliente </th>
  <th>Direccion</th>
  <th>Telefono</th>
  <th>Modelo</th>
  <th>Marca</th>
  <th>Serie</th>
  <th>Descripcion de falla</th> 
 
  <th>Imprimir</th>
  <?php foreach($orden_reparacion as $valor):?>
   
    <tr>
      <td  > <?php echo $valor->id_orden;?> </td>
      <td  > <?php echo $valor->fecha;?> </td>
      <td  > <?php echo $valor->nombre_cliente;?> </td>
        <td  > <?php echo $valor->rut;?> </td>
      <td  > <?php echo $valor->direccion;?> </td>
      <td  > <?php echo $valor->telefono;?> </td>
      <td  > <?php echo $valor->modelo;?> </td>
      <td  > <?php echo $valor->marca;?> </td>
      <td  > <?php echo $valor->serie;?> </td>
      <td><?php echo $valor->descripcion_falla;?></td>
      <td>
   <form class="form-inline" id="form1231313" action="<?php echo base_url().'Pagina/imprimirpedido';?>" method="post" >
  <div class="form-group">
  <button type="submit" form="form1231313" class="btn alert-success fa fa-print">Imprimir</button>  
  </div>
       <input type="text" class="hidden" name="imprimirregistro"  value="<?php echo $valor->id_orden;?>" placeholder="rut cliente" onkeyup="sacargeneral(this)"  >

</form>
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