<div id="vermodaleditarproveedor" class="modal-content ">

<div class="modal-header alert-info">

        <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="text-align: center" id="tituloeempresa" ><span class="fa fa-pencil-square-o"></span> Editar Orden</h4>
</div>
        


    
     <div class="modal-body">
     <form id="jñkjhuo8"  action="javascript:Editarordendetrabajo()"  method="post" >
<?php foreach($lista as $valor):?>

      <table class="table"> 
  <form class="form-inline">
 <div class="form-group">
   <tr>
              <td><label  for="psw"><span ></span> Nombre cliente</label></td>       
              <td>  <input type="text" required="true" class="form-control" value="<?php echo $valor->nombre_cliente;?>"  id="txtcliente1" onkeyup="sacargeneral(this)"  placeholder="Nombre" maxlength="45" ></td>
<td>*</td>
              </tr>

              <tr>
             <td><label  for="psw"><span ></span> Rut de Cliente</label></td>       
             <td>  <input type="number" required="true" class="form-control" value="<?php echo $valor->rut;?>" readonly="readonly"  id="txtRutregistrar1" onkeyup="sacarletras(this)" onkeyup="sacarletras(this)"  placeholder="12345678" maxlength="45" ></td>
            <td>*</td>
              </tr>

              <tr>
              <td><label  for="psw"><span ></span>Direccion</label></td>       
              <td>  <textarea type="text" required="true" class="form-control"  id="txtdireccion1" onkeyup="sacargeneral(this)"    placeholder="ingrese la direccion" maxlength="45" ><?php echo $valor->direccion;?></textarea></td>
<td>*</td>
              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Telefono</label></td>
                  <td><input type="number" required="true" class="form-control" value="<?php echo $valor->telefono;?>"  id="txttelefono1" onkeyup="sacarletras(this)"   placeholder="ingrese telefono" maxlength="45" ></td>
              <td>*</td>
              </tr>
              <tr>
                  <td><input type="text"  class="form-control"  id="txtmodelo1" onkeyup="sacargeneral(this)"  value="<?php echo $valor->modelo;?>"  placeholder="Modelo" maxlength="45" ></td>
                  <td><input type="text"  class="form-control"  id="txtmarca1" onkeyup="sacargeneral(this)" value="<?php echo $valor->marca;?>"  placeholder="Marca" maxlength="45" ></td>
                  <td><input type="text"  class="form-control"  id="txtcadena1" onkeyup="sacargeneral(this)" value="<?php echo $valor->cadena;?>"  placeholder="Cadena" maxlength="45" ></td>
                  
              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Espada</label></td>
                  <td><input type="text"  class="form-control"  id="txtespada1" onkeyup="sacargeneral(this)" value="<?php echo $valor->espada;?>"  placeholder="Espada" maxlength="45" ></td>         
              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Serie</label></td>
                  <td><input type="text" required="true" class="form-control"  id="txtserie1" onkeyup="sacargeneral(this)" value="<?php echo $valor->serie;?>"  placeholder="Serie" maxlength="45" ></td> 
              <td>*</td>
              </tr>
              <tr>
                  <td><label  for="psw"><span ></span>Descripcion Falla</label></td>
                  <td><textarea id="txtdescrpcionfalla1" required="true" placeholder="Defina Falla" ><?php echo $valor->descripcion_falla;?></textarea></td>
              <td>*</td>
              </tr>
              <tr>
                  <td> <input type="text" required="true" class="hidden"  id="txtidediarid"  onkeyup="sacargeneral(this)" value="<?php echo $valor->id_orden;?>"  maxlength="45" ></td>
                  <td><button type="submit" id="btnguardarproducto" class="fa btn btn-primary  fa-floppy-o" form="jñkjhuo8" value="Submit">Editar Orden</button></td>
              </tr>
              
              
            </div>
      
   </form>
<?php endforeach?>     
   </table>
         <div id="mesajemodaleditarproveedor"></div>
           </form>

      </div>
     
      
     

    </div>
