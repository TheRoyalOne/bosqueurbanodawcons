  <div class="row">
    <div class="col-lg-offset-1 col-lg-11 form-group">
      <div class="form-inline">
        <button id="btnAgregarUsuario" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
        <button id="btnModificarUsuario" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
        <button class="btn btn-primary" onclick="eliminarUsuario()"><i class="fa fa-trash"></i> Eliminar</button>
      </div>
    </div>
  </div>
  <div class="row">
    <form class="form-horizontal">
    <div class="col-lg-6">
      
        <div class="form-group">
          <label class="control-label col-lg-4">Nombre:</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="BUSQUEDA_VCH_NOMBRE">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-4">Apellido Paterno:</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="BUSQUEDA_VCH_APELLIDOPATERNO">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-4">Apellido Materno:</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="BUSQUEDA_VCH_APELLIDOMATERNO">
          </div>
        </div>
    </div>

    <div class="col-lg-6">
      
        <div class="form-group">
          <label class="control-label col-lg-4">Puesto:</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="BUSQUEDA_VCH_PUESTO">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-4">Estatus:</label>
          <div class="col-lg-8">
            <select class="form-control" id="BUSQUEDA_VCH_ESTATUS">
                 <option value="2">---</option>
                 <option value="1">Activo</option>
                 <option value="0">Inactivo</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="pull-right" style="padding-right:15px">
            <button type="button" class="btn btn-primary" onclick="realizaBusqueda()"><i class="fa fa-search"></i> Buscar</button>
          </div>
        </div>
    </div>
    </form>
  </div><!--row-->
  <div class="row">
    <div class="col-lg-offset-1 col-lg-11">
       <?php 
			$datos=array();
			//die(print_r(get_defined_vars()));
			foreach($usuarios as $usuario)
			{
				array_push($datos,1,$usuario["VCH_NOMBRE"],$usuario["VCH_APELLIDOPATERNO"],$usuario["VCH_APELLIDOMATERNO"],$usuario["perfil"],$usuario["VCH_CORREO"],$usuario["VCH_TELEFONO"],$usuario["VCH_CELULAR"],$usuario["VCH_PUESTO"],$usuario["VCH_ESTATUS"],$usuario["VCH_OBSERVACIONES"]);								
			}

          $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
                           'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
          $this->table->set_template($template);
          $this->table->set_heading('Nombre','Apellido Paterno','Apellido Materno','Perfil','Correo Electrónico','Telefono Casa','Celular','Puesto','Estatus','Observaciones');          
		  
         ?>
         
         <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaus" name="tablausuarios" >
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
					Perfil
				</th>
				<th>
					Correo Electrónico
				</th>
				<th>
					Telefono Casa
				</th>
				<th>
					Celular
				</th>
				<th>
					Puesto
				</th>
				<th>
					Estatus
				</th>
				<th>
					Observaciones
				</th>
			</tr>
			</thead>
			<?php
			foreach($usuarios as $usuario)
			{?>
			 <tr id="<?=$usuario["ID__USUARIO"]?>" data-ID__DOMICILIO="<?=$usuario["ID__DOMICILIO"]?>">
				 <td><?=$usuario["VCH_NOMBRE"]?></td>
				 <td><?=$usuario["VCH_APELLIDOPATERNO"]?></td>
				 <td><?=$usuario["VCH_APELLIDOMATERNO"]?></td>
				 <td><?=$usuario["perfil"]?></td>
				 <td><?=$usuario["VCH_CORREO"]?></td>
				 <td><?=$usuario["VCH_TELEFONO"]?></td>
				 <td><?=$usuario["VCH_CELULAR"]?></td>
				 <td><?=$usuario["VCH_PUESTO"]?></td>
				 <td><?=$usuario["VCH_ESTATUS"]?></td>
				 <td><?=$usuario["VCH_OBSERVACIONES"]?></td>
			 </tr>
			 <?php
			 }?>
		 </table>
    </div><!--col-->
  </div><!--row-->  
