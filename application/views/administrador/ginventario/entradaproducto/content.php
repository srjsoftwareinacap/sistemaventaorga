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
            <li  class="active treeview">
              <a style="color: white" href=#"">
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
            
            <small>Entrada de Productos</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
           <form action="javascript:registrar_producto_inventario()"  method="post" id="form54321" >
               <table id="centrarentradadeproductos" class="table"> 
  <form class="form-inline">
 <div class="form-group">

     
     <tr>
         <td><label  for="psw"><span ></span>Nombre proveedor </label></td>
         <td>
            <select class="form-control" id="prooveedorseleccioado"  >
  <option  value="0" >  Seleccione proveedor</option>
 <?php foreach($proveedores as $valor):?>
 
<option value="<?php echo $valor->rut_empresa;?>" ><?php echo $valor->nombre_empresa;?></option>  

     <?php endforeach?>
</select>  
         </td>
         <td>*</td>
         <td>
     <li id="sacarpunto" >
              <a href="<?php echo base_url().'Pagina/G_proveedor';?>">
                <i class="fa fa-shopping-cart"></i>
                <span>Agregar Nuevo Proveedor</span>
              </a>  
            </li>
         </td>
     </tr>
     <tr>
    
      <td><label  for="psw"><span ></span>Ingrese numero de factura</label></td>       
      <td>
          <input class="form-control" required="true" type="text" id="txtcodigofacturaver" onkeyup="sacargeneral(this)" maxlength="45" placeholder="671827"   >
      </td>
      <td>*</td>
      <td>
          <a class="btn" data-target="#modalentradaproducto" id="entradaproducto2" href="javascript:abrirmodalentrada()">
  <i class="fa fa-plus" aria-hidden="true"></i> Agregar nueva Factura</a>
      </td>
     </tr>
     <tr>
         
     </tr>
   <tr>
              <td><label  for="psw"><span ></span> Codigo barra</label></td>       
              <td>  <input type="text" required="true" class="form-control"  onblur="vereficaridinventario12(this.value)" id="txtcodigoentrada"   onkeyup="sacargeneral(this)" maxlength="45" placeholder="112234" >
            <td>*</td>
              </td>

              </tr>

             
              
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
                    <label  for="psw"><span ></span>Precio venta neto</label>  
                  </td>
                  <td>
     <input type="text" required="true" class="form-control"  id="txtptrcioneto"   placeholder="$" >                 
                  </td>
                  <td>*</td>
              </tr>
              <tr>
                  <td>
                    <label  for="psw"><span ></span>Precio venta Bruto</label>  
                  </td>
                  <td>
                      <input type="text" required="true" class="form-control"  readonly="readonly" id="txtpreciobruto"   placeholder="$" >                 
                  </td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Stock</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtstockingresado" onkeyup="sacarletras(this)"   placeholder="ingrese el stock" maxlength="45" ></td>
<td>*</td>
              </tr>

              <input type="text" required="true" class="form-control hidden"  id="txtstock_minimo"    >
              <input type="text" required="true" class="form-control hidden"  id="txtstock_total"    >
              <input type="text" required="true" class="form-control hidden"  id="txtidentrada"    >
            </div>
   </form>
   </table>
   
   <button type="submit" id="btnregistrarentrada"  class="fa btn btn-primary" form="form54321" value="Submit">Registrar Entrada</button>
   <br />
   <br />
   

     
</form>
            <div style="text-align: center" id="mensajegregistarentrada"></div>   
            
             <div class="modal fade" id="modalentradaproducto" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div id="idhee" class="modal-header alert-info">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="text-align: center"> Agregar nueva Factura</h2>      
        </div>
        <div class="modal-body">
<form action="javascript:almacenar_facturaentrada()"  method="post" id="form123456facturaentrada" >
  <table class="table"> 
  <form class="form-inline">
 <div class="form-group">
   <tr>
              <td><label  for="psw"><span ></span> Seleccione Proveedor</label></td>       
            <td>  
                <select class="form-control" id="prooveedorseleccioadoentrada"  >
  <option  value="0" >  Seleccione proveedor</option>
 <?php foreach($proveedores as $valor):?>
<option value="<?php echo $valor->rut_empresa;?>" ><?php echo $valor->nombre_empresa;?></option>  
     <?php endforeach?>
</select>  
            </td>
            <td>*</td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Numero de Factura</label></td>       
              <td>  <input type="text" required="true" class="form-control"  id="txtnombre" onkeyup="sacarletras(this)"  placeholder="0001" maxlength="45" ></td>
<td>*</td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Descripcion</label></td>       
              <td>  <textarea type="text" required="true" class="form-control"  id="txtdescripcion_entrada" onkeyup="sacargeneral(this)"   placeholder="ingrese la descripcion" maxlength="45" ></textarea></td>
<td>*</td>
              </tr>
            </div>
      
   </form>
     
   </table>
   <button type="submit" id="btnguardarentradafactura" class="fa btn btn-primary  fa-floppy-o" form="form123456facturaentrada" value="Submit">Guardar Factura</button><br />
   <br />
<div style="text-align: center" id="mesajemodalnuevafactura"></div>
     <br />
     <br />
     <br />
     
</form>
     
        </div>
        
      </div>
    </div>
  </div>
            
        </section><!-- /.content -->
        
      </div><!-- /.content-wrapper -->
     

      
   
    </div>