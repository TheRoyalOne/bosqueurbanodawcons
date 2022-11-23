<form id="formaltaus" method="POST">
<div class="row form-horizontal" >
  <div class="col-lg-offset-1 col-lg-11 ">
    <div class="form-inline">
      <button type="button" id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button type="button" id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
      <button type="button" class="btn btn-primary" onclick="eliminar()"><i class="fa fa-trash" ></i> Eliminar</button>
    </div>
  </div>
</div><!--row-->
<div class="row form-horizontal" style="padding-top:20px">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_NOMBREEMPRESA" name="VCH_NOMBREEMPRESA">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">RFC:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_RFC" name="VCH_RFC">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Contacto:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_PERSONACONTACTO" name="VCH_PERSONACONTACTO">
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Giro:</label>
      <div class="col-lg-8">
        <select class="form-control" id="VCH_GIROEMPRESA" name="VCH_GIROEMPRESA">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
        </select>
      </div>
    </div>    
  </div><!--col-->
</div><!--col-->

<div class="col-lg-12">
  <div class="text-right">
    <button type="submit" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
    
  </div>
</div><br> <br><br>

<div class="row">
  <div class="col-lg-offset-1 col-lg-11">
   <?php 
/*
   $datos=array('Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles',
     'Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles');
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('Empresa/Institucion','RFC','Contacto','Cargo','Correo Electronico','Telefono','Celular','Giro de la Empresa','# Empleados','Comentarios','Estado','Municipio','C.P.', 'Colonia', 'Calle y Numero', 'Entre Calles');
echo  $this->table->generate($this->table->make_columns($datos,16));*/
			 
?>
			<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Patrocinador
				</th>
				<th>
					RFC
				</th>
				<th>
					Contacto
				</th>
				<th>
					Cargo
				</th>
				<th>
					Correo Electronico
				</th>
				<th>
					Telefono
				</th>
				<th>
					Celular
				</th>
				<th>
					Giro del Patrocinador
				</th>
				<th>
					# Empleados
				</th>				
				<th>
					Comentarios
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
					Calle y Numero
				</th>																
				<th>
					Entre Calles
				</th>																
			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($empresas as $empresa)			
			{?>
			 <tr id="<?=$empresa["ID__EMPRESA"]?>"  >
				 <td><?=$empresa["VCH_NOMBREEMPRESA"]?></td>
				 <td><?=$empresa["VCH_RFC"]?></td>				 
				 <td><?=$empresa["VCH_PERSONACONTACTO"]?></td>				
				 <td><?=$empresa["VCH_PUESTOCONTACTO"]?></td>			
				 <td><?=$empresa["VCH_CORREO"]?></td>			
				 <td><?=$empresa["VCH_TELEFONO"]?></td>				 				 
				 <td><?=$empresa["VCH_CELULAR"]?></td>				 
				 <td><?=$empresa["VCH_GIROEMPRESA"]?></td>				 				 
				 <td><?=$empresa["NUM_EMPLEADOS"]?></td>				 
				 <td><?=$empresa["VCH_COMENTARIOS"]?></td>				 				 
				 <td><?=$empresa["estado"]?></td>			 
				 <td><?=$empresa["municipio"]?></td>
				 <td><?=$empresa["colonia"]?></td>				 
				 <td><?=$empresa["VCH_CODIGOPOSTAL"]?></td>
				 <td><?=$empresa["VCH_CALLE"]?></td>				 				 					
				 <td><?=$empresa["VCH_ENTRECALLE"]?></td>				 				 									 
			 </tr>
			 <?php
			 }?>
			</table> 
</div><!--col-->
  </div><!--row-->
</form>
