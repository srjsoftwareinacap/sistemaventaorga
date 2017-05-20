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
                <a style="color: white" class="btn btn-info  " href="<?php echo base_url().'Pagina/cerrar';?>">
  <i class="fa fa-sign-out  btn-info pull-left"></i> Cerrar session</a>
             
              </li>
        </nav>
      </header>
      
     <aside id ="menu" class="main-sidebar">
      
        <section class="sidebar">
          
         
          <ul class="sidebar-menu">
              <li  style="color: white" class="header">Panel de Navegacion</li>
              
            <li   class="active treeview">
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
              <a style="color: red" href="<?php echo base_url().'Pagina/R_salida';?>">
                  <i class="fa fa-reply"></i> <strong> <span>Salida de Producto</span></strong> 
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url().'Pagina/L_entrada';?>">
                <i class="fa fa-info"></i>
                <span>Reporte Entrada</span>
                
              </a>  
            </li>
              <li class="treeview">
                  <a   href="<?php echo base_url().'Pagina/G_producto';?>">
                <i class="fa fa-info"></i>
                <span>Reporte Salida</span>
                
              </a>  
            </li>
        </ul>
        </section>
      </aside>
   
 <div id="contentgproducto" class="content-wrapper">
        
        <section class="content-header">
          <h1>
            
            <small>Salida  de Productos</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
           <form action="javascript:registrar_salidaproducto_inventario()"  method="post" id="form54322" >
               <table id="centrarsalida" class="table"> 
  <form class="form-inline">
 <div class="form-group">


   <tr>
              <td><label  for="psw"><span ></span> Codigo barra</label></td>       
              <td>  <input type="text" required="true" class="form-control" autofocus="true" onblur="vereficaridinventario12(this.value)" id="txtcodigo"   onkeyup="sacargeneral(this)" maxlength="45" placeholder="112234" >
            </td>

              </tr>

              <tr>
              
 <tr>
              <td><label  for="psw"><span ></span>Nombre</label></td>       
            <td>  <input type="text" required="true" class="form-control" readonly="readonly"  id="txtnombrecargar"   placeholder="Se autocompletara el nombre" ></td>

              </tr>
              <tr>
              <td><label  for="psw"><span ></span>Descripcion</label></td>       
            <td>  <input type="text" required="true" class="form-control" readonly="readonly"  id="txtdescripcioncargar"   placeholder="Se autocompletara la descripcion" ></td>

              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Familia</label></td>       
            <td>  <input type="text" required="true" class="form-control" readonly="readonly" id="txtfamiliacargar"   placeholder="Se autocompletara el tipo de familia" ></td>

              </tr>
              <tr>
                  <td>
                    <label  for="psw"><span ></span>Precio Bruto</label>  
                  </td>
                  <td>
     <input type="text" required="true" class="form-control" readonly="readonly" id="txtprecionetocargar"   placeholder="Se autocompletara el precio de venta" >                 
                  </td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Stock de salida</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtstockcargar" onkeyup="sacarletras(this)"   placeholder="ingrese el stock" maxlength="45" ></td>

              </tr>

              <input type="text" required="true" class="form-control hidden"  id="txtstock_minimo"    >
              <input type="text" required="true" class="form-control hidden"  id="txtstock_total"    >
            </div>
   </form>
   </table>
   
   <button type="submit" id="btnregistrarentrada"  class="fa btn btn-success" form="form54322" value="Submit">Registrar Salida</button>
   <br />
   <br />
   <div id="mensajegsalida"></div>

     
</form>
            
            
            
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Sistema Delta motosierras </strong> .
      </footer>

      
   
    </div>