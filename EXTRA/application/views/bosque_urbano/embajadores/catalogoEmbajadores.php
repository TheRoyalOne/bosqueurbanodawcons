
<form id="formaltaus" method="POST">
<div class="row" id="catalogo">
  <div class="col-lg-offset-1 col-lg-11 form-group">
    <div class="form-inline">
      <button type="button" id="btnAgregarEmbajador" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button type="button" id="btnEditarEmbajador" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
      <button type="button" class="btn btn-primary" onclick="eliminarEmbajador()"><i class="fa fa-trash" ></i> Eliminar</button>
      <button type="button" id="btnImportar" class="btn btn-primary"><i class="fa fa-upload"></i> Importar Embajadores</button>
      <button type="button" id="btnAsignacion" class="btn btn-primary"><i class="fa fa-child"></i> Asignar guardabosques</button>
    </div>
  </div>
</div><!--row-->
<?php
//echo "<pre>";die(print_r(get_defined_vars()));
?>
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_NOMBRE" name="VCH_NOMBRE">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Apellido Paterno:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_APELLIDOPATERNO" name="VCH_APELLIDOPATERNO">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Apellido Materno:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_APELLIDOMATERNO" name="VCH_APELLIDOMATERNO">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Correo Electrónico:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_CORREO" name="VCH_CORREO">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Colonia:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_NOMBRECOLONIA" name="VCH_NOMBRECOLONIA">
      </div>
    </div>

  </div><!--col-->
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Estatus:</label>
      <div class="col-lg-8">
        <select class="form-control" id="VCH_ESTATUS" name="VCH_ESTATUS">
          <option value="2">---</option>
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Institución Educativa:</label>
      <div class="col-lg-8">
        <select class="form-control" id="ID__INSTITUCION" name="ID__INSTITUCION">
			<option value="-1">---</option>
          <?php
          
			foreach($instituciones as $institucion)
			{?>     				
				<option value="<?=$institucion["ID__INSTITUCION"]?>"><?=$institucion["VCH_NOMBRE"]?></option>
				
			<?php
			}
			?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Tipo:</label>
      <div class="col-lg-8">
        <select class="form-control" name="VCH_TIPO" id="VCH_TIPO">
          <option value="-1">---</option>
           <?php
		   foreach($tiposEmbajador as $tipo)
		   {
		   ?>
				<option value="<?=$tipo["ID__TIPO"]?>"><?=$tipo["VCH_TEXTOTIPO"]?></option>
		   <?php
			}
		   ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="pull-right" style="padding-right:13px">
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
      </div>
    </div>
  </div><!--col-->
</div><!--row-->

<div class="row">
  <div class="col-lg-offset-1 col-lg-11" height="300px" style="overflow:auto" >
   
			<table class="display" cellspacing="0" width="100%" id="tablaespecies" name="tablaespecies"  >
			<!--<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >-->
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
					Institucón Educativa
				</th>
				<th>
					Tipo de Embajador
				</th>
				<th>
					Teléfono Casa
				</th>
				<th>
					Celular
				</th>
				<th>
					Correo Electrónico
				</th>
				<th>
					Período Activo
				</th>				
				<th>
					Semestre
				</th>				
				<th>
					Carrera
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
					Código Postal
				</th>				
				<th>
					Calle y Número
				</th>				
				<th>
					Estatus
				</th>																
				<th>
					&nbsp;
				</th>																
			</tr>
			</thead>
			<?php			
			foreach($embajadores as $embajador)			
			{?>
			 <tr id="<?=$embajador["ID__EMBAJADOR"]?>" data-estatus="<?=$embajador['VCH_ESTATUS']?>" >
				 <td><?=$embajador["VCH_NOMBRE"]?></td>
				 <td><?=$embajador["VCH_APELLIDOPATERNO"]?></td>
				 
				 <td><?=$embajador["VCH_APELLIDOMATERNO"]?></td>
				 <td><?=$embajador["institucion"]?></td>				 
				 <td><?php
						if($embajador["VCH_TIPO"]==1)
						{
							echo "Técnico";
						}
						else
						{
							echo "Practicante";
						}
					?></td>
				 <td><?=$embajador["VCH_TELEFONO"]?></td>			
				 <td><?=$embajador["VCH_CELULAR"]?></td>			
				 <td><?=$embajador["VCH_CORREO"]?></td>
				 <td><?=$embajador["FEC_FECHAINICIO"]."-".$embajador["FEC_FECHAFIN"]?></td>
				 <td><?=$embajador["VCH_SEMESTRE"]?></td>
				 <td><?=$embajador["VCH_CARRERA"]?></td>	
				  
				 <td><?=$embajador["estado"]?></td>			 
				 <td><?=$embajador["municipio"]?></td>
				 <td><?=$embajador["colonia"]?></td>				 
				 <td><?=$embajador["VCH_CODIGOPOSTAL"]?></td>
				 <td><?=$embajador["VCH_CALLE"]?></td>				 				 					
				 <td><?php
						if($embajador["VCH_ESTATUS"]==1)
						{
							echo "Activo";
						}
						else
						{
							echo "Inactivo";
						}
					?></td>
					<td>
						<button type="button" id="btnAsignacion" class="btn btn-primary" onclick="$('#verAsignados').modal('show');	"><i class="fa fa-child"></i> Ver asignados</button>						
					</td>
			 </tr>
			 <?php
			 }?>
		 </table>      
</div><!--col-->
  </div><!--row-->
</form>
