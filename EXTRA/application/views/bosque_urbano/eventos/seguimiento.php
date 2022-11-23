<style>
.bigcheck
{
  transform: scale(2.2);
}
</style>
<form id="frmSeguimiento" method="POST" ACTION="ordenSalidaCiudadana" target="_BLANK">
	<div class="row form-horizontal">
		<div class=" col-lg-offset 3 col-md-offset-3 col-sm-offset-3 col-lg-5 col-md-5 col-sm-5 text-center">
			<div class="form-group">
				<label class="control-label col-lg-4">Escaneo:</label>
				<div class="col-lg-8 col-md-8 col-sm-8 text-center">
					<input type="text" class="form-control" id="scaneo">
				</div>
			</div>
		</div>
	</div>
	
	<!--Datos árbol v -->
	<div class="row page-header">
		<h4 class="col-lg-12 col-md-12 col-sm-12">Datos árbol:</h4>
	</div>
	
	
	<div class="row form-horizontal">
		<div class="col-lg-5">
			<div class="form-group">
				<label class="control-label col-lg-4">Especie:</label>
				<div class="col-lg-8">
					<select class="form-control" id="selEspecie" onchange="CargaZonas(this.value)">
						<option value="-1" >Seleccione</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-lg-5 ">
			<div class="form-group">
				<label class="control-label col-lg-4" id="lblDisponibles">QR:</label>
				<div class="col-lg-8 text-center">
					<select class="form-control" id="selCodigos"> 
						<option value="-1" >No lleva</option>
					</select>					
				</div>
			</div> 
		</div>		
	</div>	
	<div class="row form-horizontal">		
		<div class="col-lg-5">
			<div class="form-group">
				<label class="control-label col-lg-4">Zona:</label>
				<div class="col-lg-8">
					<select class="form-control" id="selZona" onchange="CargaEdades(this.value)" >
						<option value="-1" >Seleccione</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Cantidad:</label>
				<div class="col-lg-8">
					<select class="form-control" id="selCantidadAr" >
						<?php
						$i=1;
						while($i<10000)
						{
						?>
							<option value="<?=$i?>"><?=$i?></option>
						<?php		
							$i++;				
						}
						?>
					</select>
				</div>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="form-group">
				<label class="control-label col-lg-4">Edad:</label>
				<div class="col-lg-8">
					<select class="form-control" id="selEdad">
						<option value="-1" >Seleccione</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row form-horizontal">				
		<div class="col-lg-5 col-lg-offset-5">
			<div class="form-group">
				<label class="control-label col-lg-4">&nbsp;</label>
				<div class="col-lg-8 text-right">
					<button class="btn btn-primary" id="btnAgregarArbolAtabla" type="button">Agregar</button>
			</div>
		</div>
	</div>
	
<!--	<div class="row form-horizontal">
						
	</div>-->
	<div class="row form-horizontal">
		<div class="col-lg-9 col-lg-offset-1 ">
			<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='200' id="tablaAdoptar" name="tablaAdoptar" >
				<thead style='background-color:#00A89C; color:#fff;' >
				<tr>
					<th class="text-center">
						Especie
					</th>
					<th class="text-center">
						QR
					</th>
					<th class="text-center">
						Zona
					</th>
					<th class="text-center">
						Edad
					</th>																					
					<th class="text-center">
						Precio
					</th>																					
					<th class="text-center">
						Gratuito
					</th>																					
					<th class="text-center">
						Borrar
					</th>																					
				</tr>
				</thead>			
				<tbody>
				</tbody>		 
			 </table>      
		</div>						
	</div>
	
	<div class="row form-horizontal">
			
		<div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-5 col-lg-5 col-md-5 col-sm-5 text-right">		
				<label class="control-label">Costo total:</label>							
				<label style="font-weight:normal" id="costo">Costo total:</label>							
		</div>
	</div>	
	<!--row-->
	
	<!--Datos árbol ^ -->

	<!--Datos guardabosques v -->
	<div class="row page-header">
		<h4 class="col-lg-12">Datos GuardaBosque:</h4>
	</div><!--row-->
	<div class="row form-horizontal">
		<div class="col-lg-6">
			<div class="form-group">
				<label class="control-label col-lg-4">Nombre(s):</label>
				<div class="col-lg-8">
					<input class="form-control" id="txtNombre">
				</div>
			</div>   
			<div class="form-group">
				<label class="control-label col-lg-4">Apellido paterno:</label>
				<div class="col-lg-8">
					<input class="form-control" id="txtApellidoPaterno">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Apellido materno:</label>
				<div class="col-lg-8">
					<input class="form-control" id="txtApellidoMaterno">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Telefono fijo:</label>
				<div class="col-lg-8">
					<input class="form-control" id="txtTelefono">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Telefono celular:</label>
				<div class="col-lg-8">
					<input class="form-control" id="txtCelular">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Correo electrónico:</label>
				<div class="col-lg-8">
					<input class="form-control" id="txtCorreo">
				</div>
			</div>

		</div><!--div primera columna-->

		<div class="col-lg-6">
			<div class="form-group">
				<label class="control-label col-lg-2">Estado:</label>
				<div class="col-lg-8">
					<select class="form-control" id="selEstado">
						<option value="0" >---</option>
						<?php
						foreach($this->General_model->get_estados() as $estado)
							{?>
						<option value="<?= $estado['ID__ESTADO']?>"><?=$estado['VCH_NOMBRE']?></option>
						<?php }	?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Municipio:</label>
				<div class="col-lg-8">
					<select class="form-control" id="selMunicipio">
						<option value="0" >---</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Colonia:</label>
				<div class="col-lg-8">
					<select class="form-control" id="selColonia">
						<option value="0" >---</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Calle:</label>
				<div class="col-lg-8">
					<input class="form-control" id="txtCalle">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Referencia:</label>
				<div class="col-lg-8">
					<input class="form-control" id="txtReferencia">
				</div>
			</div>   
		</div><!--col-->
	</div><!--row-->
	<!--Datos guardabosques ^ -->
	<div id="mapSeguimiento" style="height:550px; width:100%;"></div>
	<div class="row">
		<div class="col-lg-3 col-lg-offset-9">
			<button class="btn btn-warning" id="btnReimprimir" type="button" style="display:none">Reeimprimir</button>
			<button class="btn btn-default" id="btnRegresarSeguimiento" type="button">Regresar</button>
			<button class="btn btn-primary" id="btnGuardarSeguimiento" type="button">Guardar</button>
		</div>
	</div><!--row-->
	<input type="hidden" name="JSONSALIDA" id="JSONSALIDA" >
</form>
</div><!--sabe, pero no se lo quites-->
