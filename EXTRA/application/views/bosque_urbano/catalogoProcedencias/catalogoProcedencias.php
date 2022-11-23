<form id="formaltaus" method="POST">
<div class="row form-horizontal" style="padding-left:20px">
  <div class="col-lg-12 form-group">
    <div class="form-inline">
      <button type="button" id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button type="button" id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
      <button type="button" class="btn btn-primary" onclick="eliminar()"><i class="fa fa-trash" ></i> Eliminar</button>
    </div>
  </div>
</div><!--row-->
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_NOMBRE" name="VCH_NOMBRE">
      </div>
    </div>
    
  </div><!--col-->
</div><!--col-->

<div class="col-lg-12">
  <div class="text-right">
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
  </div>
</div><br> <br><br>

<div class="row">
  <div class="col-lg-offset-1 col-lg-10">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Nombre
				</th>
				<th>
					Apellido Paterno
				</th>
				<th>
					Apellido Materno
				</th>
				<th>
					Telefono de Casa

				</th>
				<th>
					Celular
				</th>
				<th>
					Correo Electronico
				</th>
				<th>
					Estado
				</th>
				<th>
					Municipio
				</th>
				<th>
					Colonia
				</th>				
				<th>
					C.P.
				</th>				
				<th>
					Calle y Numero
				</th>				
				<th>
					Entre Calles
				</th>																
			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($guardabosques as $guardabosque)			
			{?>
			 <tr id="<?=$guardabosque["ID__GUARDABOSQUE"]?>"  >
				 <td><?=$guardabosque["VCH_NOMBRE"]?></td>
				 <td><?=$guardabosque["VCH_APELLIDOPATERNO"]?></td>				 
				 <td><?=$guardabosque["VCH_APELLIDOMATERNO"]?></td>				
				 <td><?=$guardabosque["VCH_TELEFONO"]?></td>			
				 <td><?=$guardabosque["VCH_CELULAR"]?></td>			
				 <td><?=$guardabosque["VCH_CORREO"]?></td>				 
				 <td><?=$guardabosque["estado"]?></td>			 
				 <td><?=$guardabosque["municipio"]?></td>
				 <td><?=$guardabosque["colonia"]?></td>				 
				 <td><?=$guardabosque["VCH_CODIGOPOSTAL"]?></td>
				 <td><?=$guardabosque["VCH_CALLE"]?></td>				 				 					
				 <td><?=$guardabosque["VCH_ENTRECALLE"]?></td>				 				 					
				 
			 </tr>
			 <?php
			 }?>
		 </table>      
</div><!--col-->
  </div><!--row-->
</form>
