<td><label  for="psw"><span ></span> Provincia</label></td>       
              <td>
                  <select onchange="cargarcomuna(this.value)" class="form-control" id="provinciaseleccioada"  >
  <option  value="0" >  Seleccione la Provincia</option>
 <?php foreach($provicias as $valor):?>
 
<option value="<?php echo $valor->provincia_id;?>" ><?php echo $valor->provincia_nombre;?>   </option>  

     <?php endforeach?>
</select> 
              </td>
              