<div class="container">
  <h2 class="hidden">Modal Login Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-primary btn-lg hidden" id="myBtn">Login</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal_login" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary" style="padding:35px 50px;">
          
          <h4 id="color"><span class="glyphicon glyphicon-lock"></span> Iniciar Session</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
            <form role="form" method="post" action="javascript:verificarusuario()">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Usuario</label>
              <input type="text" class="form-control" required="true" id="usrname" placeholder="nombre usuario">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Contraseña</label>
              <input type="text" class="form-control" required="true" id="psw" placeholder="****">
            </div>
            
              <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          
         
        </div>
      </div>
      
    </div>
  </div> 
</div>
 
</div>
