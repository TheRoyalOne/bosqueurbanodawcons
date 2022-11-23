<div class="row">
    <div class="col-lg-offset-1 col-lg-11 form-group">
      <div class="form-inline">
        <button id="btnAgregarEspecie" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
        <button id="btnModificarEspecie" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
        <button id="btnEliminarEspecie" class="btn btn-primary" onclick="eliminarEspecie()"><i class="fa fa-trash"></i> Eliminar</button>
      </div>
    </div>
  </div><!--row-->

  <div class="row">
    <form class="col-lg-12 form-horizontal"  method="post">
        <div class="form-group">
          <label class="control-label col-lg-2">Nombre Común:</label>
          <div class="col-lg-4">
            <input type="text" class="form-control" name="VCH_NOMBRECOMUN">
          </div>
          
          <label class="control-label col-lg-3">Estatus:</label>
          <div class="col-lg-3">
           <select class="form-control" id="sel1" name="VCH_ESTATUS">
                 <option value="2">---</option>
                 <option value="1">Activo</option>
                 <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-offset-11 col-lg-1" >
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
          </div>
        </div>
    </form>
  </div><!--row-->

  <div class="row">
    <div class="col-lg-offset-1 col-lg-11">			
		 <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Código de árbol
				</th>
				<th>
					Nombre Común
				</th>
				<th>
					Nombre Cientifico
				</th>
				<th>
					Estatus
				</th>
				<th>
					Observaciones
				</th>
				<th>
					Url de Referencia
				</th>
				<th>
					Primer Período de Seguimiento
				</th>
				<th>
					Segundo Período de Seguimiento
				</th>
				<th>
					Tercer Período de Seguimiento
				</th>
				<th>
					Cuarto Período de Seguimiento'
				</th>				
			</tr>
			</thead>
			<?php
			foreach($especies as $especie)			
			{?>
			 <tr id="<?=$especie["ID__ESPECIE"]?>" data-estatus="<?=$especie['VCH_ESTATUS']?>" >
				 <td><?=$especie["ID__ESPECIE"]?></td>
				 <td><?=$especie["VCH_NOMBRECOMUN"]?></td>
				 <td><?=$especie["VCH_NOMBRECIENTIFICO"]?></td>
				 <td><?php
						if($especie["VCH_ESTATUS"]==1)
						{
							echo "Activo";
						}
						else
						{
							echo "Inactivo";
						}
					?></td>
				 <td><?=$especie["VCH_OBSERVACIONES"]?></td>
				 <td><?=$especie["VCH_URLREFERENCIA"]?></td>
				 <td><?=$especie["NUM_PRIMERPERIODO"]?></td>
				 <td><?=$especie["NUM_SEGUNDOPERIODO"]?></td>
				 <td><?=$especie["NUM_TERCERPERIODO"]?></td>
				 <td><?=$especie["NUM_CUARTOPERIODO"]?></td>
			 </tr>
			 <?php
			 }?>
		 </table>       
</div><!--col-->
</div><!--row-->
