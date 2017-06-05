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
            <li  class="treeview">
                <a  href="<?php echo base_url().'Pagina/L_salida';?>">
                <i class="fa fa-info"></i>
                <strong><span>Reporte Salida</span></strong>
                
              </a>  
            </li>
            <li  class="active treeview">
              <a style="color: red" href="#">
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
            
            <small>Gestion proveedor</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <form class="form-inline" id="form1fasdf24122" action="<?php echo base_url().'Pagina/buscar_proveedor_empresa';?>" method="post" >
  <div class="form-group">
  <button type="submit" form="form1fasdf24122" class="btn alert-success fa fa-search">Buscar por</button>  
  </div>
  <input type="text" class="form-control"  name="buscar_proveedor" placeholder="codigo o por nombre" onkeyup="sacargeneral(this)"  >
  
  <p style="color:#03a9f4;" ><?php echo $mensaje;?></p>
</form>
<a class="btn" data-target="#modalproveedor" id="gestiongestionproveedor" href="javascript:abrirmodalproveedor()">
  <i class="fa fa-plus" aria-hidden="true"></i> Agregar Proveedor</a>
  
  <div  id="tablaproveedor" class="box">
      <div   class="box-body">
          <table id="example2" class="table table-bordered table-hover" >
                   <th >rut empresa</th>
  <th>Nombre  proveedor </th>
  <th>Giro</th>
  <th>Telefono</th>
  <th>Region</th>
  <th>Provincia</th>
  <th>comuna</th>
  <th>calle</th>
  <th>Correo electronico</th> 
  <th>Seleccione</th>
  
  <?php foreach($proveedores as $valor):?>
   
    <tr>
      <td  > <?php echo $valor->rut_empresa;?> </td>
      <td  > <?php echo $valor->nombre_empresa;?> </td>
      <td  > <?php echo $valor->giro;?> </td>
        <td  > <?php echo $valor->telefono;?> </td>
      <td  > <?php echo $valor->region;?> </td>
      <td  > <?php echo $valor->provincia;?> </td>
      <td  > <?php echo $valor->comuna;?> </td>
      <td  > <?php echo $valor->calle;?> </td>
      <td  > <?php echo $valor->correo_electronico;?> </td>
      <td >
      <?php if( $valor->estado== "activo") :?>


      <a class="fa btn fa-pencil-square-o" aria-hidden="true"  data-target="#mostraredicion_mo_proveedor"  href="javascript:mostraredicion_mo_proveedor('<?php echo $valor->rut_empresa;?>')"></a>

      <a class="fa btn fa-lock" aria-hidden="true"  data-target="#mostrarm"  href="javascript:Bloquiarprovedor('<?php echo $valor->rut_empresa;?>')"></a>
     <?php else: ?>
<a class="fa btn fa-repeat" aria-hidden="true"  data-target="#mostrarm"  href="javascript:DesBloquiarprovedor('<?php echo $valor->rut_empresa;?>')"></a>
    
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
            <div id="mesajeproveedor"></div>
      </div>
  </div>
            
  <div class="modal fade" id="modalproveedor" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div  id="modalcontentprovee" class="modal-content">
        <div id="idhee" class="modal-header alert-info">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="text-align: center"> Agregar nuevo Proveedor</h2>      
        </div>
        <div class="modal-body">
        
    
<form action="javascript:almacenar_proveedor()"  method="post" id="form36adad18736" >
  <table class="table"> 
  <form class="form-inline">
 <div class="form-group">
   <tr>
              <td><label  for="psw"><span ></span> Rut de Empresa</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtRutregistrar" onkeyup="sacarletras(this)" onkeyup="sacargeneral(this)"  placeholder="12345678" maxlength="45" ></td>
            <td>
                <input id="txtrutverificador" type="number"   placeholder="9" onblur="vereficarrut(this.value)" required="true" onkeyup="sacarletras(this)" class="form-control"  >
            </td>

              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Nombre de Empresa</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtnombre" onkeyup="sacargeneral(this)"  placeholder="Ingrese el Nombre" maxlength="45" ></td>

              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Giro</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtgiro" onkeyup="sacargeneral(this)"   placeholder="Ingrese el Giro" maxlength="45" ></td>

              </tr>
              <tr>
              <td><label  for="psw"><span ></span>Telefono</label></td>       
              <td>  <input type="number" required="true" class="form-control"  id="txttelefono" onkeyup="sacarletras(this)"   placeholder="12345678" maxlength="45" ></td>
              </tr>
              
             <tr>
              <td><label  for="psw"><span ></span> Region</label></td>       
              <td>
                  <select onchange="cargarprov(this.value)" class="form-control" id="regionseleccioada"  >
  <option  value="0" >  Seleccione Region</option>
 <?php foreach($region as $valor):?>
 
<option value="<?php echo $valor->region_id;?>" ><?php echo $valor->region_ordinal."    ".$valor->region_nombre;?>   </option>  

     <?php endforeach?>
</select> 
              </td>
              </tr>
              <tr id="cargarprovincia">
                  
              </tr>
              <tr id="cargarcomuna">
                  
              </tr>
              <tr>
               <td><label  for="psw"><span ></span> Calle</label></td>
               <td>
                   <input type="text" required="true" class="form-control"  id="txtcalle" onkeyup="sacargeneral(this)"   placeholder="av" maxlength="45" >
               </td>
              </tr>
              <tr>
              <td><label  for="psw"><span ></span>Correo electronico</label></td>       
              <td>  <input type="email" required="true" class="form-control"  id="txtcorreo"   placeholder="@" maxlength="45" ></td>
              </tr>
            </div>
      
   </form>
     
   </table>
   <button type="submit" id="btnguardarproveedor" class="fa btn btn-success  fa-floppy-o" form="form36adad18736" value="Submit">Guardar proveedor</button><br />
   <br />
<div id="mesajemodalproveedor"></div>
     <br />
     <br />
     <br />
     
</form>
     
        </div>
        
      </div>
    </div>
  </div>
            
                 <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="mostraredicion_mo_proveedor">
  <div class="modal-dialog" role="document">
    
    
  </div>
</div>
            
         
            
            
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      

      
   
    </div>