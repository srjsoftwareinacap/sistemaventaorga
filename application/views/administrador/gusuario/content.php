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
                <a href="#" style="color:white">
                <i class="fa fa-barcode"></i> <span>Gestion Usuario</span> 
               
              </a>
              
            </li>
           
        </ul>
        </section>
      </aside>
   
 <div id="contentgproducto" class="content-wrapper">
        
        <section class="content-header">
          <h1>
            
            <small>Gestión Usuario</small>
          </h1>
          <ol class="breadcrumb">
              <h4>  <li><a href="<?php echo base_url().'Pagina/volverinicio';?>"><i class="fa fa-reply-all"></i><strong>Volver a Inicio</strong> </a></li>
              </h4>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            
            
            
            <form class="form-inline" id="form12" action="<?php echo base_url().'Pagina/buscar_usuario_empresa';?>" method="post" >
  <div class="form-group">
  <button type="submit" form="form12" class="btn btn-primary fa fa-search">Buscar por</button>  
  </div>
  <input type="text" class="form-control"  name="buscar_usuario" placeholder="rut o por nombre" onkeyup="sacargeneral(this)"  >
  
  <p style="color:#03a9f4;" ><?php echo $mensaje;?></p>
</form>
          <a class="btn" data-target="#modalgestion_usuario" id="gestiongestion2" href="javascript:abrirmodalgusuario()">
  <i class="fa fa-plus" aria-hidden="true"></i> Agregar usuario</a>
            
     <div  id="tablaproveedor" class="box">
      <div   class="box-body">
          <table id="example2" class="table table-bordered table-hover" >
                   <th >Rut empresa</th>
  <th>Rut usuario</th>
  <th>Nombre Usuario</th>
  <th>Contraseña</th>
  <th>Perfil</th>
  <th>Seleccione</th>
  
  <?php foreach($lista as $valor):?>
   
    <tr>
      <td  > <?php echo $valor->rut_empresa_peterneciente;?> </td>  
      <td  > <?php echo $valor->rut_usuario;?> </td>
      <td  > <?php echo $valor->nombre_usuario;?> </td>
     
        <td  > **** </td>
        <?php if( $valor->perfil_usuario== "100") :?>
        <td  >
          Administrador
      </td>
        <?php else: ?>
      <td  >
          Vendedor / reparador
      </td>
        <?php endif;?>
      
      <td >
      <?php if( $valor->estado== "activo") :?>


      <a class="fa btn fa-pencil-square-o" aria-hidden="true"  data-target="#mostraredicion_mo_usuario"  href="javascript:mostraredicion_modal_usuario('<?php echo $valor->rut_usuario;?>')"></a>

      <a class="fa btn fa-lock" aria-hidden="true"  data-target="#mostrarm"  href="javascript:Bloquiarusuario('<?php echo $valor->rut_usuario;?>')"></a>
     <?php else: ?>
<a class="fa btn fa-repeat" aria-hidden="true"  data-target="#mostrarm"  href="javascript:DesBloquiarusuario('<?php echo $valor->rut_usuario;?>')"></a>
    
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
            <div id="mesajeusuario"></div>
      </div>
  </div>         
            
            
            
            
            
            
            <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="mostraredicion_mo_usuario">
  <div class="modal-dialog" role="document">
    
    
  </div>
</div>
            
            
            
            
            
            
            
            
            
            <div class="modal fade" id="modalgestion_usuario" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div id="idhee" class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="text-align: center"> Agregar nuevo usuario</h2>      
        </div>
        <div class="modal-body">
        
    
<form action="javascript:almacenar_usuario()"  method="post" id="form12345" >
  <table class="table"> 
   <tr>
              <td><label  for="psw"><span ></span> Rut de Usuario</label></td>       
            <td>  <input type="text" required="true" class="form-control"  id="txtRutusuario" onkeyup="sacarletras(this)" onkeyup="sacargeneral(this)"  placeholder="12345678" maxlength="45" ></td>
            <td>
                <input id="trificadorusuario" type="text"   placeholder="9" onblur="vereficarrutusuario(this.value)" required="true" onkeyup="sacarletras(this)" class="form-control"  >
            </td>
<td>*</td>
              </tr>
              <tr>
<td><label  for="psw"><span ></span> Nombre de Usuario</label></td>
<td>  <input type="text" required="true" class="form-control"  id="txtnombreusuario"  onkeyup="sacargeneral(this)"  placeholder=" ingrese nombre" maxlength="45" ></td>                  
              <td>*</td>
              </tr>
              <tr>
<td><label  for="psw"><span ></span>Contraseña</label></td>
<td>  <input type="text" required="true" class="form-control"  id="txtcontrasenausuario"  onkeyup="sacargeneral(this)"  placeholder="ingrese contraseña" maxlength="45" ></td>                  
<td>*</td>
              </tr>
  
   </table>
   <button type="submit" id="btnguardarfamilia" class="fa btn btn-primary  fa-floppy-o" form="form12345" value="Submit">Guardar usuario</button><br />
   <br />
<div id="mesajemodalgusuario"></div>
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
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Sistema Delta motosierras </strong> .
      </footer>

      
   
    </div>