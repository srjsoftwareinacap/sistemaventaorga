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
                <i class="fa fa-bars"></i> <span>Nueva orden de Registro</span> 
              </a>
             
            </li>
        <li class="active treeview">
              <a href="<?php echo base_url().'Pagina/retiro';?>">
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
        
        <section class="content">
          
         <form class="form-inline" id="form12" action="<?php echo base_url().'Pagina/rutcliente';?>" method="post" >
  <div class="form-group">
  <button type="submit" form="form12" class="btn alert-success fa fa-search">Buscar por</button>  
  </div>
  <input type="text" class="form-control"  name="buscar_rutcliente" placeholder="rut cliente" onkeyup="sacargeneral(this)"  >
  
  <p style="color:#03a9f4;" ><?php echo $mensaje;?></p>
</form>
          <a class="btn" data-target="#modalordendecompra" id="gestiongestion2" href="javascript:abrirmodalordencompra()">
  <i class="fa fa-plus" aria-hidden="true"></i> Agregar nueva orden</a>   
            
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
  <th>agregar detalle</th>
  <th>Editar Orden</th>
  
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
    <a class="fa btn fa-plus-circle" aria-hidden="true"  data-target="#modalordendecompradetalle"  href="javascript:mostrardetalle_orden('<?php echo $valor->id_orden;?>')"></a>
     </td>
      <td><a class="fa btn fa-pencil-square-o" aria-hidden="true"  data-target="#mostraredicion_ordentrabajo"  href="javascript:mostraredicion_mo_orden('<?php echo $valor->id_orden;?>')"></a></td>
      
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
          
   





<div class="modal fade" id="modalordendecompra" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div id="idhee" class="modal-header alert-info">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="text-align: center"> Agregar nueva orden de trabajo</h2>      
        </div>
        <div class="modal-body">
        
    
<form action="javascript:almacenar_ordenreapracion()"  method="post" id="form1234" >
  <table class="table"> 
  <form class="form-inline">
 <div class="form-group">
   <tr>
              <td><label  for="psw"><span ></span> Nombre cliente</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtcliente" onkeyup="sacargeneral(this)"  placeholder="Nombre" maxlength="45" ></td>

              </tr>

              <tr>
             <td><label  for="psw"><span ></span> Rut de Cliente</label></td>       
            <td>  <input type="number" required="true" class="form-control"  id="txtRutregistrar" onkeyup="sacarletras(this)" onkeyup="sacarletras(this)"  placeholder="12345678" maxlength="45" ></td>
            <td>
                <input id="txtrutverificador" type="number"   placeholder="9" onblur="vereficarrut(this.value)" required="true" onkeyup="sacarletras(this)" class="form-control"  >
            </td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Direccion</label></td>       
              <td>  <textarea type="text" required="true" class="form-control"  id="txtdireccion" onkeyup="sacargeneral(this)"   placeholder="ingrese la direccion" maxlength="45" ></textarea></td>

              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Telefono</label></td>
                  <td><input type="number" required="true" class="form-control"  id="txttelefono" onkeyup="sacarletras(this)"   placeholder="ingrese telefono" maxlength="45" ></td>
              </tr>
              <tr>
                  <td><input type="text"  class="form-control"  id="txtmodelo" onkeyup="sacargeneral(this)"  placeholder="Modelo" maxlength="45" ></td>
                  <td><input type="text"  class="form-control"  id="txtmarca" onkeyup="sacargeneral(this)"  placeholder="Marca" maxlength="45" ></td>
                  <td><input type="text"  class="form-control"  id="txtcadena" onkeyup="sacargeneral(this)"  placeholder="Cadena" maxlength="45" ></td>
                  
              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Espada</label></td>
         <td><input type="text"  class="form-control"  id="txtespada" onkeyup="sacargeneral(this)"  placeholder="Espada" maxlength="45" ></td>         
              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Serie</label></td>
                  <td><input type="text" required="true" class="form-control"  id="txtserie" onkeyup="sacargeneral(this)"  placeholder="Serie" maxlength="45" ></td> 
              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Descripcion Falla</label></td>
                  <td><textarea id="txtdescrpcionfalla" required="true" placeholder="Defina Falla" ></textarea></td>
              </tr>

              
              
            </div>
      
   </form>
     
   </table>
   <button type="submit" id="btnguardarproducto" class="fa btn btn-success  fa-floppy-o" form="form1234" value="Submit">Guardar producto</button><br />
   <br />
<div style="text-align: center" id="mesajemodalproveedor"></div>
     <br />
     <br />
     <br />
     
</form>
     
        </div>
        
      </div>
    </div>
  </div>
            
            
            
            
            
            
            
            
           <div class="modal fade" id="modalordendecompradetalle" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div id="idhee" class="modal-header alert-info">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="text-align: center"> Agregar detalle orden de trabajo</h2>      
        </div>
        <div class="modal-body">
        
    
<form action="javascript:almacenar_detalleort()"  method="post" id="form123dwe24" >
  <table class="table"> 
  <form class="form-inline">
 <div class="form-group">
     
   <tr>
              <td><label  for="psw"><span ></span> Numero de orden </label></td>       
              <td>  <input type="text" required="true" class="form-control" readonly="readonly"  id="txtdetallenumero" onkeyup="sacargeneral(this)"  placeholder="Nombre" maxlength="45" ></td>
              </tr>
<tr>
         
         
              <td><label  for="psw"><span ></span> Editar detalle de productos </label></td>       
              <td> <a class="fa btn  fa-list-alt fa-4x" aria-hidden="true"  data-target="#modalordendecompradetalleproductos"  href="javascript:mostrardetalle_ordenproductos()"></a> </td>
              
              </tr>
              <tr>
             <td><label  for="psw"><span ></span> Cantidad</label></td>       
            <td>  <input type="number"  class="form-control"  id="txtcantidaddetalleor" onkeyup="sacarletras(this)" onkeyup="sacarletras(this)"  placeholder="0 = 1" maxlength="45" ></td>
            
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Codigo barra</label></td>       
              <td><input type="text"  class="form-control"   id="txtdetallecodigo" onkeyup="sacargeneral(this)" onblur="ingresardetalleorden(this.value)"  placeholder="534353656" maxlength="45" ></td>

              </tr>
              <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  
              </tr>
              <tr>
                   
                  <td><label  for="psw"><span ></span>mano de obra</label></td>
                  <td><input type="number" required="true" class="form-control"  id="txtmano" onkeyup="sacarletras(this)"   placeholder="$" maxlength="45" ></td>
              </tr>
              <tr>
                    <tr>
              <td><label  for="psw"><span ></span>Descuento especial</label></td>       
              <td><input type="text" required="true" class="form-control"   id="txtdescuento" onkeyup="sacargeneral(this)"  placeholder="$" maxlength="45" ></td>
              </tr>
              <tr>
          <td><label  for="psw"><span ></span>descripcion</label></td>       
          <td><textarea class="form-control" id="txtdescripciondetalle"></textarea></td>        
              </tr>
              <tr>
                  <td>
                      <label  for="psw"><span ></span>Una ves de que acepte reparacion  tiene que ir a retiro de producto</label>
                  </td>
              </tr>

              
              
            </div>
      
   </form>
     
   </table>
   <button type="submit" id="btnguardardetalle" class="fa btn btn-success  fa-floppy-o" form="form123dwe24" value="Submit">Guardar detalle</button><br />
   <br />
<div style="text-align: center" id="mesajemodalproveedor"></div>
     <br />
     <br />
     <br />
     
</form>
     
        </div>
        
      </div>
    </div>
  </div> 
    
            
  <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="mostraredicion_ordentrabajo">
  <div class="modal-dialog" role="document">
    
    
  </div>
</div>  
            <!-- modal de detalle productos -->
      <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="modalordendecompradetalleproductos">
  <div class="modal-dialog " role="document">
    
    
  </div>
</div>      
            
        </section>

        
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Sistema Delta motosierras </strong> .
      </footer>

     
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->