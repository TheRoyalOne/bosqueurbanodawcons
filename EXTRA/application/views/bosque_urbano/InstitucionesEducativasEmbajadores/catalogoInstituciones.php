  <form method="POST">
<div class="row form-horizontal" >
  <div class="col-lg-offset-1 col-lg-11 ">
    <div class="form-inline">
      <button type="button" id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button type="button" id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
      <button type="button" class="btn btn-primary" onclick="eliminar()"><i class="fa fa-trash"></i> Eliminar</button>
    </div>
  </div>
</div><!--row-->
<div class="row form-horizontal" style="padding-top:20px">

  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Institucion:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_NOMBRE" name="VCH_NOMBRE">
      </div>
    </div>    
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Contacto:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_PERSONACONTACTO" name="VCH_PERSONACONTACTO">
      </div>
    </div>   
  </div><!--col-->

</div><!--col-->

<div class="col-lg-12">
  <div class="text-right">
    <button type="submit"  class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
  </div>
</div><br> <br><br>

<div class="row">
  <div class="col-lg-offset-1 col-lg-11">
   <?php 
/*
   $datos=array('Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos', 
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos',
     'Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos');
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('Institucion','Contacto','Correo Electronico','Telefono','Observaciones y Seguimiento','Responsable','Estado','Municipio','C.P.','Colonia','Calle y numero','Entre Calles','# Embajadores', '# Embajadores Activos');
echo  $this->table->generate($this->table->make_columns($datos,14));*/
?>

			<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Institucion
				</th>
				<th>
					Contacto
				</th>
				<th>
					Correo Electronico
				</th>
				<th>
					Telefono
				</th>
				<th>
					Observaciones y Seguimiento
				</th>
				<th>
					Responsable
				</th>
				<th>
					Estado
				</th>
				<th>
					Municipio
				</th>
				<th>
					C.P.
				</th>				
				<th>
					Colonia
				</th>				
				<th>
					Calle y numero
				</th>				
				<th>
					Entre Calles
				</th>																
				<th>
					# Embajadores
				</th>																
				<th>
					# Embajadores Activos
				</th>																
			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($instituciones as $institucion)			
			{?>
			 <tr id="<?=$institucion["ID__INSTITUCION"]?>"  >
				 <td><?=$institucion["VCH_NOMBRE"]?></td>
				 <td><?=$institucion["VCH_PERSONACONTACTO"]?></td>				 
				 <td><?=$institucion["VCH_CORREO"]?></td>				
				 <td><?=$institucion["VCH_TELEFONO"]?></td>			
				 <td><?=$institucion["VCH_COMENTARIOS"]?></td>			
				 <td><?=$institucion["responsable"]?></td>				 				 
				 <td><?=$institucion["estado"]?></td>				 
				 <td><?=$institucion["municipio"]?></td>				 				 
				 <td><?=$institucion["VCH_CODIGOPOSTAL"]?></td>				 
				 <td><?=$institucion["colonia"]?></td>				 				 
				 <td><?=$institucion["VCH_CALLE"]?></td>			 
				 <td><?=$institucion["VCH_ENTRECALLE"]?></td>
				 <td><?=($institucion["inact"]+$institucion["act"])?></td>				 
				 <td><?=$institucion["act"]?></td>
								 				 									 
			 </tr>
			 <?php
			 }?>
			</table> 

</div><!--col-->
  </div><!--row-->
  </form>
