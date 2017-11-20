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
            
              <a id="moverperfilusuario"  aria-hidden="true"  data-target="#mostraredicion_usuario"  href="javascript:mostraredicionusuarioperfil('<?php echo $rut;?>')">Perfil usuario<i class="fa fa-user"></i></a>    
                 
            <li   id="sessiones2" >
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
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Inicio</span> <i class="fa fa-angle-left pull-right"></i>
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
          
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>Gestión</h3>
                  <h4>Ventas</h4>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-cart"></i>
                </div>
                <a href="<?php echo base_url().'Pagina/gventas';?>" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
           
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>Gestion</h3>
                  <h4>Orden de Trabajo</h4>
                </div>
                  <div  class="icon">
                  <i class="ion ion-hammer"></i>
                </div>
                <a href="<?php echo base_url().'Pagina/ordentrabajo';?>" class="small-box-footer">Ir<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
     
          </div><!-- /.row -->
          <!-- Main row -->
          <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="mostraredicion_usuario">
  <div class="modal-dialog" role="document">
    
    
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