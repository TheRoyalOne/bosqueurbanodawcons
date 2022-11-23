<form id="formaltaus" method="POST">
<div class="row form-horizontal" >
  <div class="col-lg-11 col-lg-offset-1">
    <div class="form-inline">
      <button type="button" id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button type="button" id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
    </div>
  </div>
</div><!--row-->

<div class="row form-horizontal" style="padding-top:20px">
	<div class="col-lg-6">
		<div class="form-group">
	      <label class="control-label col-lg-4">Nombre:</label>
	      <div class="col-lg-8">
	        <input type="text" class="form-control" id="BUSQUEDA_VCH_NOMBRE" name="BUSQUEDA_VCH_NOMBRE">
	      </div>
   		</div>
		<div class="form-group">
	      <label class="control-label col-lg-4">Uso:</label>
	      <div class="col-lg-8">
	        <select class="form-control" id="BUSQUEDA_INT_USO" name="BUSQUEDA_INT_USO">
	        
	          <option value="-1">---</option>
	          <option value="1">Evento Adopción</option>
	          <option value="2">Crecimiento</option>
	          <option value="3">Producción</option>
	          <option value="4">Recuperación</option>
	          <option value="5">Stock</option>
	          <option value="6">Trasplante</option>
	          <option value="7">Reforestación</option>
	          <option value="8">Evento Adopción Especial</option>
	          <option value="9">Cuarentena</option>
	        </select>
	      </div>
    	</div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
	      <label class="control-label col-lg-4">Estatus:</label>
	      <div class="col-lg-8">
	        <select class="form-control" id="BUSQUEDA_INT_ESTATUS" name="BUSQUEDA_INT_ESTATUS">
	          <option value="-1">---</option>
	          <option value="1">Activo</option>
	          <option value="0">Inactivo</option>
	        </select>
	      </div>
    	</div>
    	<div class="text-right">
		    <button type="submit" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
		</div>
	</div>
</div>

<div class="row">
  <div class="col-lg-offset-1 col-lg-11">
   <?php 
   /*
   $datos=array('No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones',
     'No.','Nombre Ubicación','Estatus','Uso','Observaciones');
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('No.','Nombre Ubicación','Estatus','Uso','Observaciones');
echo  $this->table->generate($this->table->make_columns($datos,5));
*/?>

<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
	<thead style='background-color:#00A89C; color:#fff;' >
	<tr>
		<th>
			No.
		</th>
		<th>
			Nombre Ubicación
		</th>
		<th>
			Estatus
		</th>
		<th>
			Uso
		</th>
		<th>
			Observaciones
		</th>													
	</tr>
	</thead>
	<?php			
	//die(print_r($guardabosques)."?");
	foreach($ubicaciones as $ubicacion)			
	{?>
	 <tr id="<?=$ubicacion["ID__UBICACION"]?>"  >
		 <td><?=$ubicacion["ID__UBICACION"]?></td>
		 <td><?=$ubicacion["VCH_NOMBRE"]?></td>				 
		 <td><?php if($ubicacion["INT_ESTATUS"]==1){echo "Activa";} else{echo "Inactiva";}?></td>				
		 <td><?php 
		 switch($ubicacion["INT_USO"])
		 {
			 case 1:
			 {
				  echo "Evento Adopción"; break;
			 }
			 case 2:
			 {
				 echo "Crecimiento"; break;
			 }
			 case 3:
			 {
				echo "Producción"; break;
			 }
			 case 4:
			 {
				echo "Recuperación"; break;
			 }
			 case 5:
			 {
				echo "Stock"; break;
			 }
			 case 6:
			 {
				echo "Trasplante"; break;
			 }
			 case 7:
			 {
				echo "Reforestación"; break;
			 }
			 case 8:
			 {
				echo "Evento Adopción Especial"; break;
			 }
			 case 9:
			 {
				echo "Cuarentena"; break;
			 }
			 dafault:
			 {
				echo "default"; break;
			 }
		 }
			 ?></td>			
		 <td><?=$ubicacion["VCH_OBSERVACIONES"]?></td>								 				 							 
	 </tr>
	 <?php
	 }?>
	</table>      
</div><!--col-->
  </div><!--row-->
</form>
