<div class="row form-horizontal">
	<div class="col-lg-10" >
		<form id="form">
		<div class="form-group">
          <label class="control-label col-lg-4">Tipo de Patrocinio:</label>
          <div class="col-lg-8">
            <input type="text" class="form-control required" id="VCH_TIPO" name="VCH_TIPO">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-4">Observaciones:</label>
          <div class="col-lg-8">
            <textarea style="resize: none;" class="form-control required" id="VCH_OBSERVACIONES" name="VCH_OBSERVACIONES"></textarea>
          </div>
        </div>
        </form>
	</div>
	<div class=" pull-right">
       	<button class="btn btn-primary" onclick="reset()"><i class="fa fa-close"></i> Cancelar</button>
        <button class="btn btn-primary" onclick="guardar()"><i class="fa fa-plus-circle"></i> Agregar</button>
    </div>
	<div class="row">
	  <div class="col-lg-offset-1 col-lg-11">
	   <?php 
/*
	   $datos=array('Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>',
	     'Tipo Patrocinio','Observaciones','<i class="fa fa-pencil"></i>', '<i class="fa fa-close"></i>');
	$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
	 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
	$this->table->set_template($template);
	$this->table->set_heading('Tipo Patrocinio','Observaciones','Editar', 'Eliminar');
	echo  $this->table->generate($this->table->make_columns($datos,4));
*/
	?>
	<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Tipo Patrocinio
				</th>
				<th>
					Observaciones
				</th>
				<th>
					Editar
				</th>
				<th>
					Eliminar
				</th>
			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($tiposPatrocinios as $tiposPatrocinio)			
			{?>
			 <tr id="<?=$tiposPatrocinio["ID__PATROCINIO"]?>">
				 <td><?=$tiposPatrocinio["VCH_TIPO"]?></td>
				 <td><?=$tiposPatrocinio["VCH_OBSERVACIONES"]?></td>				 
				 <td><a href="javascript:cargarDatos(<?=$tiposPatrocinio["ID__PATROCINIO"]?>)">Editar</a></td>
				 <td><a href="javascript:Eliminar(<?=$tiposPatrocinio["ID__PATROCINIO"]?>)">Eliminar</a></td>
			 </tr>
			 <?php
			 }?>
		 </table>      
	</div><!--col-->
	</div><!--row-->
</div>
