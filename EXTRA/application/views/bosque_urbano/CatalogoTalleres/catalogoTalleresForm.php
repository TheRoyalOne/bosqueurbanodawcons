<div class="row form-horizontal" >
  <div class="col-lg-11 col-lg-offset-1">
    <div class="form-inline">
      <button id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
    </div>
  </div>
</div><!--row-->
<form id="formaltaus" method="POST">
<div class="row form-horizontal" style="padding-top:20px">
	<div class="col-lg-10">
		<div class="form-group">
	      <label class="control-label col-lg-4">Nombre del Taller:</label>
	      <div class="col-lg-8">
	        <input type="text" class="form-control" id="VCH_NOMBRE_Busqueda" name="VCH_NOMBRE_Busqueda">
	      </div>
   		</div>
	</div>
	<div class="col-lg-2">
	    <button type="submit" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
	</div>
</div>
</form>
<div class="row">
  <div class="col-lg-offset-1 col-lg-11">
   <?php 
/*
   $datos=array('No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion',
     'No.','Nombre del Taller','Descripcion');
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('No.','Nombre del Taller','Descripcion');
echo  $this->table->generate($this->table->make_columns($datos,3));
*/
?>

<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
	<thead style='background-color:#00A89C; color:#fff;' >
	<tr>
		<th>
			No.
		</th>
		<th>
			Nombre del Taller
		</th>
		<th>
			Descripcion
		</th>
	</tr>
	</thead>
	<?php			
	//die(print_r($guardabosques)."?");
	foreach($talleres as $taller)			
	{?>
	 <tr id="<?=$taller["ID__TALLER"]?>"  >
		 <td><?=$taller["ID__TALLER"]?></td>
		 <td><?=$taller["VCH_NOMBRE"]?></td>				 
		 <td><?=$taller["VCH_DESCRIPCION"]?></td>				
	 </tr>
	 <?php
	 }?>
	</table>      
</div><!--col-->
  </div><!--row-->
