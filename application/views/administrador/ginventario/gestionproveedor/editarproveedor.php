<div id="vermodaleditarproveedor" class="modal-content ">

<div class="modal-header alert-info">

        <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="text-align: center" id="tituloeempresa" ><span class="fa fa-pencil-square-o"></span> Editar proveedor</h4>
</div>
        


    
     <div class="modal-body">
     <form id="form2423"  action="javascript:Editarproveedor()"  method="post" >


        <table class="table"> 
  <form class="form-inline">
      <div class="form-group">
          <tr>
              <td>
                  <label  for="psw"><span ></span> Rut de Proveedor</label>
              </td>
              <td>
                  <input id="txtrut" type="text"  readonly="readonly"   value="<?php echo $rut;?>"  required="true"  class="form-control"  >
              </td>
          </tr>
     <tr>
              <td>
                  <label  for="psw"><span ></span> Nombre</label>
              </td>
              <td>
                  <input id="txteditnombre" type="text"  value="<?php echo $nombre;?>"   required="true"  onkeyup="sacargeneral(this)" class="form-control"  >
              </td>
          </tr>
            <tr>
              <td>
                  <label  for="psw"><span ></span> Giro</label>
              </td>
              <td>
                  <input id="txteditgiro" type="text"  value="<?php echo $giro;?>"   required="true"  onkeyup="sacargeneral(this)" class="form-control"  >
              </td>
          </tr>
          <tr>
              <td>
                  <label  for="psw"><span ></span> Telefono</label>
              </td>
              <td>
                  <input id="txtedittelefono" type="text"  value="<?php echo $telefono;?>"   required="true"  onkeyup="sacargeneral(this)" class="form-control"  >
              </td>
          </tr>
          <tr>
              <td>
                  <label  for="psw"><span ></span>Region</label>
              </td>
              <td>
                 <select onchange="cargarproveditar(this.value)" class="form-control" id="regionseleccioada"  >
  <option  value="0" >  Seleccione Region</option>
 <?php foreach($region as $valor):?>
 
<option value="<?php echo $valor->region_id;?>" ><?php echo $valor->region_ordinal."    ".$valor->region_nombre;?>   </option>  

     <?php endforeach?>
</select> 
              </td>
          </tr>
           
    <tr id="cargarprovincia2">
                  
              </tr>
              <tr id="cargarcomuna2">
                  
              </tr>
        
          
         
    <br />
            <div class="row">
<div class="col-lg-4">
       
        
              </div>
              <div class="col-lg-8">
            <button type="submit" form="form2423" value="Submit" class="btn btn-primary" >Editar</button>
            
            </div>

 
      </div>

     	
     <div id="mesajemodaleditarproveedor"></div>
    </form>
   </div>
  </form>
        </table>
      </div>
     
      
     

    </div>
   