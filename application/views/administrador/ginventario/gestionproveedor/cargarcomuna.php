<td><label  for="psw"><span ></span> Comuna</label></td>       
              <td>
                  <select  class="form-control" id="comunaseleccioada"  >
  <option  value="0" >  Seleccione la Comuna</option>
 <?php foreach($comunas as $valor):?>
 
<option value="<?php echo $valor->comuna_nombre;?>" ><?php echo $valor->comuna_nombre;?>   </option>  

     <?php endforeach?>
</select> 
              </td>