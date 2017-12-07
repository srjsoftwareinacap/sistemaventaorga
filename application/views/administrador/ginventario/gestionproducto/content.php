 <div class="wrapper">

      <header id="modificar" class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          
          <span class="logo-mini"><b>A</b>LT</span>
          
          <span class="logo-lg" id="titulo"><b>Sistema de Ventas</span>
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
              <a style="color: white" href="#">
                  <i class="fa fa-barcode"></i> <strong><span>Gestion Producto</span> </strong>
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
            
            <small>Gestion de Productos</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            
         <form class="form-inline" id="form12" action="<?php echo base_url().'Pagina/buscar_producto_empresa';?>" method="post" >
  <div class="form-group">
  <button type="submit" form="form12" class="btn btn-primary fa fa-search">Buscar por</button>  
  </div>
  <input type="text" class="form-control"  name="buscar_producto" placeholder="codigo o por nombre" onkeyup="sacargeneral(this)"  >
  
  <p style="color:#03a9f4;" ><?php echo $mensaje;?></p>
</form>
          <a class="btn" data-target="#modalproducto_suempresa" id="gestiongestion2" href="javascript:abrirmodalproduempresa()">
  <i class="fa fa-plus" aria-hidden="true"></i> Agregar Producto</a>
            
  <div  id="tablaproducto" class="box">
  <div   class="box-body">

<table id="example2" class="table table-bordered table-hover" >
        <th >Codigo barra</th>
  <th>Nombre   producto</th>
  <th>Descripccion</th>
  <th>Tipo Familia</th>

  <th>Stock minimo</th>
  <th>Precio_bruto</th>
  <th>Seleccione</th>
  <?php foreach($productos as $valor):?>
   
    <tr>
      <td  > <?php echo $valor->codigo_barra;?> </td>
      <td  > <?php echo $valor->nombre;?> </td>
      <td  > <?php echo $valor->descripcion;?> </td>
     
        <td  > <?php echo $valor->tipo_familia;?> </td>
     
    
      <td  > <?php echo $valor->stock_minimo;?> </td>
      <td> <?php echo $valor->precio_bruto;?></td>
      <td >
      <?php if( $valor->estado== "activo") :?>


      <a class="fa btn fa-pencil-square-o" aria-hidden="true"  data-target="#mostraredicion_mo_producto"  href="javascript:mostraredicion_mo_producto('<?php echo $valor->codigo_barra;?>')"></a>

      <a class="fa btn fa-lock" aria-hidden="true"  data-target="#mostrarm"  href="javascript:Bloquiarproductoempresa('<?php echo $valor->codigo_barra;?>')"></a>
     <?php else: ?>
<a class="fa btn fa-repeat" aria-hidden="true"  data-target="#mostrarm"  href="javascript:DesBloquiarproductoempresa('<?php echo $valor->codigo_barra;?>')"></a>
    
      </td>
    </tr>
    <?php endif;?>
     <?php endforeach;?>
      </table>
       <ul class="pagination" id="numeros">
            <?php
                       
              echo $links
            ?>
            </ul>
      <div  style="text-align: center" id="mesajefds"></div>
</div> 
       </div>     
 
            <div class="modal fade" id="modalproducto_suempresa" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div id="idhee" class="modal-header alert-info">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="text-align: center"> Agregar nuevo Producto</h2>      
        </div>
        <div class="modal-body">
        
    
<form action="javascript:almacenar_producto()"  method="post" id="form1234" >
  <table class="table"> 
  <form class="form-inline">
 <div class="form-group">
   <tr>
              <td><label  for="psw"><span ></span> Codigo barra</label></td>       
              <td>
                  
                  <input type="text" required="true" class="form-control"  id="txtcodigo" onkeyup="sacargeneral(this)"  placeholder="112234  " maxlength="45" ></td>
              <td>*</td>

              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Nombre producto</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtnombre" onkeyup="sacargeneral(this)"  placeholder="ingrese el nombre" maxlength="45" ></td>
<td>*</td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Descripcion</label></td>       
              <td>  <textarea type="text" required="true" class="form-control"  id="txtdescripcion" onkeyup="sacargeneral(this)"   placeholder="ingrese la descripcion" maxlength="45" ></textarea></td>
              <td>*</td>
<td>
    <a class="btn" style="color: white" data-target="#modalfamiala" id="agregarfamiliamodal" href="javascript:abrirmodalfamiliaycerrardeproducto()">
        <i style="color: white" class="fa fa-plus" aria-hidden="true"></i> Agregar nueva Familia</a>
</td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span> Familia</label></td>       
            <td> <select  class="form-control" id="productoseleccioado"  >
  <option  value="0" >  Seleccione familia</option>
 <?php foreach($familia as $valor):?>
 
<option value="<?php echo $valor->id_familia;?>" ><?php echo $valor->tipo_familia;?></option>  

     <?php endforeach?>
</select> </td>
<td>*</td>
              </tr>
             
              

              <tr>
              <td><label  for="psw"><span ></span>Stock minimo</label></td>       
              <td>  <input type="number" required="true" class="form-control"  id="txtstock" onkeyup="sacarletras(this)"   placeholder="ingrese stock minimo " maxlength="45" ></td>
<td>*</td>
              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Precio venta Bruto</label></td>       
              <td>  <input type="number" required="true" class="form-control"  id="txtpreciobrutoproducto" onkeyup="sacarletras(this)"   placeholder="ingrese su precio $" maxlength="45" ></td>
              <td>*</td>
              </tr>
            </div>
      
   </form>
     
   </table>
   <button type="submit" id="btnguardarproducto" class="fa btn btn-primary  fa-floppy-o" form="form1234" value="Submit">Guardar producto</button><br />
   <br />
<div style="text-align: center" id="mesajemodalproducto"></div>
     <br />
     <br />
     <br />
     
</form>
     
        </div>
        
      </div>
    </div>
  </div>
            
            
            
            
            <div class="modal fade" id="modalfamiala" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div id="idhee" class="modal-header alert-danger">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="text-align: center"> Agregar nueva familia</h2>      
        </div>
        <div class="modal-body">
        
    
<form action="javascript:almacenar_familia()"  method="post" id="form12345" >
  <table class="table"> 
  <form class="form-inline">
 <div class="form-group">
   <tr>
              <td><label  for="psw"><span ></span> Nombre Tipo de Familia</label></td>       
              <td>  <input type="text" required="true" autofocus="true" class="form-control"  id="txttipofamilia" onkeyup="sacargeneral(this)"  placeholder="Ingrese familia" maxlength="45" ></td>
<td>*</td>
              </tr>
            </div>
   </form>
   </table>
   <button type="submit" id="btnguardarfamilia" class="fa btn btn-success  fa-floppy-o" form="form12345" value="Submit">Guardar Tipo de familia</button><br />
   <br />
<div style="text-align: center" id="mesajemodalfamilia"></div>
     <br />
     <br />
     <br />
</form>
     
        </div>
        
      </div>
    </div>
  </div>
            
            
            
            
            <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="mostraredicion_mo_producto">
  <div class="modal-dialog" role="document">
    
    
  </div>
</div>
            
            
            
      
        </section><!-- /.content -->
       
      </div><!-- /.content-wrapper -->
      

      
   
    </div>
<div class="control-sidebar-bg"></div>