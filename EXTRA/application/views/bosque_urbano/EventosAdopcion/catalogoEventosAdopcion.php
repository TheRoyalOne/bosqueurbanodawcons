<form method="POST">
<div class="row form-horizontal" style="padding-left:20px">
  <div class="col-lg-12 form-group">
    <div class="form-inline">
      <button type="button" id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button type="button" id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
      <button type="button" class="btn btn-primary"><i class="fa fa-trash"></i> Eliminar</button>
      <button type="button" class="btn btn-default"><i class="fa fa-file-pdf-o"></i> Reporte en PDF</button>
      <button type="button" class="btn btn-default"><i class="fa fa-file-excel-o"></i> Reporte en Excel</button>
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
    <div class="form-group">
        <div class="checkbox col-lg-offset-3 col-lg-12">
          <label class="checkbox-inline"><input id="chkEvento" type="checkbox" value="" onclick="fechas()">Fechas del Evento</label>
        </div>
    </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Fecha Inicio:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control" id="fechaInicio" name="fechaInicio" disabled>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Fecha Fin:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control" id="fechafin" name="fechafin" disabled>
        </div>
      </div>
  </div>
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
  </div><!--col-->
</div><!--col-->

<div class="col-lg-12">
  <div class="text-right">
    <button type="submit" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
  </div>
</div><br> <br><br>

<div class="row">
  <div class="col-lg-offset-1 col-lg-10">
   <?php 
/*
   $datos=array('Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico',
     'Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico');
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('Nombre','Descripcion','Lugar','Fecha Inicio','Fecha Fin','Campaña Publicitaria','Cantidad de Arboles','Estatus','Contacto','Cargo','Telefono','Celular','Correo Electronico');
echo  $this->table->generate($this->table->make_columns($datos,13));*/
?>

<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
<thead style='background-color:#00A89C; color:#fff;' >
<tr>
	<th>
		Nombre
	</th>
	<th>
		Descripcion
	</th>
	<th>
		Lugar
	</th>
	<th>
		Fecha Inicio
	</th>
	<th>
		Fecha Fin
	</th>
	<th>
		Campaña Publicitaria
	</th>
	<th>
		Cantidad de Arboles
	</th>
	<th>
		Estatus
	</th>
	<th>
		Contacto
	</th>				
	<th>
		Cargo
	</th>				
	<th>
		Telefono
	</th>				
	<th>
		Celular
	</th>				
	<th>
		Correo Electronico
	</th>															
</tr>
</thead>
<?php			
foreach($eventosadopcion as $eventoAdopcion)			
{?>		
 <tr id="<?=$eventoAdopcion["ID__EVENTO"]?>">
	 <td><?=$eventoAdopcion["VCH_NOMBRE"]?></td>
	 <td><?=$eventoAdopcion["VCH_DESCRIPCION"]?></td>	 
	 <td><?=$eventoAdopcion["VCH_LUGAR"]?></td>
	 <td><?=$eventoAdopcion["FEC_FECHAINICIO"]?></td>	 
	 <td><?=$eventoAdopcion["FEC_FECHAFIN"]?></td>
	 <td><?=$eventoAdopcion["VCH_COMPANIAPUBLICITARIA"]?></td>
	 <td><?=$eventoAdopcion["NUM_CANTIDADARBOLES"]?></td>	 		 			
	 <td><?php
			if($eventoAdopcion["VCH_ESTATUS"]==1)
			{
				echo "Activo";
			}
			else
			{
				echo "Inactivo";
			}
		?></td>
	 <td><?=$eventoAdopcion["VCH_CONTACTO"]?></td>			
	 <td><?=$eventoAdopcion["VCH_CARGOCONTACTO"]?></td>	
	 <td><?=$eventoAdopcion["VCH_TELEFONOCONTACTO"]?></td>			
	 <td><?=$eventoAdopcion["VCH_CELULARCONTACTO"]?></td>			
	 <td><?=$eventoAdopcion["VCH_CORREOCONTACTO"]?></td>			
 </tr>
 <?php
 }?>
</table>      
</div><!--col-->
  </div><!--row-->
</form>
