<div  class="container">
  <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url()?>"><b>Acceso de Usuario</b></a>
      </div><!-- /.login-logo -->
      <div id="efecto" class="login-box-body">
        <p class="login-box-msg">Ingrese sus datos para iniciar session</p>
        <form id="form1" action="javascript:verificarusuario()" method="post">
          <div class="form-group has-feedback">
              <input type="text" id="rut" class="form-control" placeholder="Rut" autofocus="true" required="true">
            
          </div>
          <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Contraseña" required="true">
            
          </div>
          
       
             <div class="row">
            <div class="col-xs-8">
             
            </div><!-- /.col -->
            <div class="col-xs-4">
                   <button type="submit" form="form1" class="btn btn-primary btn-block btn-flat">Acceder</button>
            </div><!-- /.col -->
          </div>
         
        </form>

        

       

      </div>
      <br />
        <div id="mesaje"></div>
    </div>

   
    <script src="<?php echo base_url()?>../plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script> 
</div>
 

