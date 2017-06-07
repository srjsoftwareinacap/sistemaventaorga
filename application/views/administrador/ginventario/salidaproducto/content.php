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
        <td><label  for="psw"><span ></span>Nombre de Proveedor de Destino</label></td>
        <td>
            <select class="form-control" id="prooveedorseleccioado"  >
  <option  value="0" >  Seleccione proveedor</option>
 <?php foreach($proveedores as $valor):?>
 
<option value="<?php echo $valor->rut_empresa;?>" ><?php echo $valor->nombre_empresa;?></option>  

     <?php endforeach?>
</select>  
         </td>
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
     <td><label  for="psw"><span ></span>Numero de Factura de Despacho</label></td>
     <td><input type="number" required="true" class="form-control"  id="txtfacturasalida" onkeyup="sacarletras(this)"   placeholder="001" maxlength="45" ></td>
     <td>
          <a class="btn" data-target="#modalsalidaproducto" id="salidaproducto2" href="javascript:abrirmodalsalida()">
  <i class="fa fa-plus" aria-hidden="true"></i> Agregar nueva Factura de Despacho</a>
      </td>
     </tr>
   <tr>
              <td><label  for="psw"><span ></span> Codigo barra</label></td>       
              <td>  <input type="text" required="true" class="form-control"  onblur="vereficaridinventariosalida(this.value)" id="txtcodigosalida"   onkeyup="sacargeneral(this)" maxlength="45" placeholder="112234" >
            </td>

              </tr>

              <tr>
              
 <tr>
              <td><label  for="psw"><span ></span>Nombre</label></td>       
            <td>  <input type="text" required="true" class="form-control" readonly="readonly"  id="txtnombrecargarsalida"   placeholder="Se autocompletara el nombre" ></td>

              </tr>
              <tr>
              <td><label  for="psw"><span ></span>Descripcion</label></td>       
            <td>  <input type="text" required="true" class="form-control" readonly="readonly"  id="txtdescripcioncargarsalida"   placeholder="Se autocompletara la descripcion" ></td>

              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Familia</label></td>       
            <td>  <input type="text" required="true" class="form-control" readonly="readonly" id="txtfamiliacargarsalida"   placeholder="Se autocompletara el tipo de familia" ></td>

              </tr>
              <tr>
                  <td>
                    <label  for="psw"><span ></span>Precio venta Neto</label>  
                  </td>
                  <td>
                      <input type="text" required="true" onkeyup="sacarletras(this)" class="form-control"  id="txtprecionetosalida" placeholder="$"   >                 
                  </td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Stock de salida</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtstockcargarsalida" onkeyup="sacarletras(this)"   placeholder="ingrese el stock" maxlength="45" ></td>

              </tr>

              <input type="text" required="true" class="form-control hidden"  id="txtstock_minimosalida"    >
              <input type="text" required="true" class="form-control hidden"  id="txtstock_total_inventario1"    >
              <input type="text" required="true" class="hidden" id="txtidsalidaoculto"
            </div>
   </form>
   </table>
   
   <button type="submit" id="btnregistrarsalida"  class="fa btn btn-success" form="form54322" value="Submit">Registrar Salida</button>
   <br />
   <br />
   <div style="text-align: center" id="mensajegsalida"></div>

     
</form>
            
<div class="modal fade" id="modalsalidaproducto" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div id="idhee" class="modal-header alert-info">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="text-align: center"> Agregar nueva Factura de Despacho</h2>      
        </div>
        <div class="modal-body">
        
    
<form action="javascript:almacenar_facturasalida()"  method="post" id="form123456facturasalida" >
  <table class="table"> 
  <form class="form-inline">
 <div class="form-group">
   <tr>
              <td><label  for="psw"><span ></span> Seleccione Proveedor</label></td>       
            <td>  
                <select class="form-control" id="prooveedorseleccioadosalida"  >
  <option  value="0" >  Seleccione proveedor</option>
 <?php foreach($proveedores as $valor):?>
 
<option value="<?php echo $valor->rut_empresa;?>" ><?php echo $valor->nombre_empresa;?></option>  

     <?php endforeach?>
</select>  
            </td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Numero de Factura</label></td>       
            <td>  <input type="number" required="true" class="form-control"  id="txtnombresalida" onkeyup="sacarletras(this)"  placeholder="0001" maxlength="45" ></td>

              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Descripcion</label></td>       
              <td>  <textarea type="text" required="true" class="form-control"  id="txtdescripcion_salida" onkeyup="sacargeneral(this)"   placeholder="ingrese la descripcion" maxlength="45" ></textarea></td>

              </tr>
</div>
      
   </form>
     
   </table>
   <button type="submit" id="btnguardarsalidafactura" class="fa btn btn-success  fa-floppy-o" form="form123456facturasalida" value="Submit">Guardar Factura</button><br />
   <br />
<div style="text-align: center" id="mesajemodalnuevafacturasalida"></div>
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