<form id="frmAdopcionDeEvento" method="POST" ACTION="ordenSalidaOnline" target="_BLANK">
	<div class="row form-horizontal">
		<div class=" col-lg-offset 3 col-md-offset-3 col-sm-offset-3 col-lg-5 col-md-5 col-sm-5 text-center">
			<div class="form-group">
				<label class="control-label col-lg-4">Escaneo:</label>
				<div class="col-lg-8 col-md-8 col-sm-8 text-center">
					<input type="text" class="form-control" id="Ascaneo">
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
					<select class="form-control" id="AselEspecie">
						<option value="-1" >---</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-4" id="AlblDisponibles">QR disponible(s):</label>
				<div class="col-lg-8 col-lg-offset-4 input-group">
					<select class="form-control" id="AselCodigos" multiple></select>
					<span class="input-group-addon" id="AbtnAgregarCodigo">
						<i class="fa fa-plus-circle"></i>
					</span>
				</div>
			</div> 

		</div><!--div primera columna-->

		<div class="col-lg-7">
			<!--<div class="form-group">
				<label class="control-label col-lg-2">Cantidad:</label>
				<div class="col-lg-8">
					<select class="form-control" id="selCantidad" name="cantidad">
						<option value="-1" >---</option>
					</select>
				</div>
			</div>-->
			<div class="form-group">
				<label class="control-label col-lg-2" id="AlblAgregados">QR seleccionado(s):</label>
				<div class="col-lg-8 input-group" >
					<select class="form-control" id="AselCodigosAgregados"></select>
					<span class="input-group-addon" id="AbtnQuitarCodigo">
						<i class="fa fa-minus-circle"></i>
					</span>
				</div>
			</div>
		</div><!--col-->
	</div><!--row-->
	
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
					<input class="form-control" id="AtxtNombre">
				</div>
			</div>   
			<div class="form-group">
				<label class="control-label col-lg-4">Apellido paterno:</label>
				<div class="col-lg-8">
					<input class="form-control" id="AtxtApellidoPaterno">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Apellido materno:</label>
				<div class="col-lg-8">
					<input class="form-control" id="AtxtApellidoMaterno">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Telefono fijo:</label>
				<div class="col-lg-8">
					<input class="form-control" id="AtxtTelefono">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Telefono celular:</label>
				<div class="col-lg-8">
					<input class="form-control" id="AtxtCelular">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-4">Correo electrónico:</label>
				<div class="col-lg-8">
					<input class="form-control" id="AtxtCorreo">
				</div>
			</div>

		</div><!--div primera columna-->

		<div class="col-lg-6">
			<div class="form-group">
				<label class="control-label col-lg-2">Estado:</label>
				<div class="col-lg-8">
					<select class="form-control" id="AselEstado">
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
					<select class="form-control" id="AselMunicipio">
						<option value="0" >---</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Colonia:</label>
				<div class="col-lg-8">
					<select class="form-control" id="AselColonia">
						<option value="0" >---</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Calle:</label>
				<div class="col-lg-8">
					<input class="form-control" id="AtxtCalle">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Referencia:</label>
				<div class="col-lg-8">
					<input class="form-control" id="AtxtReferencia">
				</div>
			</div>   
		</div><!--col-->
	</div><!--row-->
	<!--Datos guardabosques ^ -->
	<div id="mapSeguimientoA" style="height:550px; width:100%;"></div>
	<div class="row">
		<div class="col-lg-3 col-lg-offset-9">
			<button class="btn btn-default" id="AbtnRegresarSeguimiento" type="button">Regresar</button>
			<button class="btn btn-primary" id="AbtnGuardarSeguimiento" type="button">Guardar</button>
		</div>
	</div><!--row-->
	<input type="hidden" name="AJSONSALIDA" id="AJSONSALIDA" >
</form>
