<div id="page-wrapper">
  <div class="container-fluid">
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row">
			    <div class="col-lg-12">
			      <h1 class="page-header" style="font-size:30px">
			       <?= $titulo?>
			      </h2>
			    </div>
	  		</div>

	  		<div id="catalogoGuardaBosques">
	  			<?php include('catalogoInventarios.php'); ?>
			</div>
			<br>

			<div id="agregarModificar" hidden>
				  <div class="row">
				    <div class="col-lg-12">
				      <h2 class="page-header">
				        Formulario Inventario
				      </h2>
				    </div>
				  </div>
				  <?php include('AgregarModificar.php'); ?>
			</div>
		</div>		
		<div id="transferirModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">Transferir de zona</h4>
			  </div>
			  <div class="modal-body">
				<form id="transferencia" >
					<div class="row form-horizontal">
						<div class="col-lg-6">
							<div class="form-group">
								  <label class="control-label col-md-4">Zona destino:</label>
								  <div class="col-md-8">
									<select type="text" class="form-control" id="ID__INSTITUCION_IMPORTAR" name="ID__INSTITUCION_IMPORTAR">
									<?php        
									foreach($ubicaciones as $ubicacion)
									{?>     				
											<option value="<?=$ubicacion["ID__UBICACION"]?>"><?=$ubicacion["VCH_NOMBRE"]?></option>			
									<?php
									}
									?>
								   </select>
								 </div>
						   </div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								  <label class="control-label col-md-4 col-lg-4 col-sm-4">Cantidad:</label>
								 <div class="col-md-8">
								  <input type="number" class="form-control col-md-8 col-lg-8 col-sm-8" id="cantidadMover" name="cantidadMover" min="1">
								 </div>
								 <!-- <div id="slider" class="col-md-6 col-lg-6 col-sm-6"  style="padding-top:25px">
									  <div id="custom-handle" class="ui-slider-handle"></div>
								  </div>-->
						   </div>
						</div>
					</div>
					</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" onclick="transferir()">Transferir</button>
			  </div>
			</div>
		  </div>
		  		  
		</div>
		<div id="mermaModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">Merma de zona</h4>
			  </div>
			  <div class="modal-body">
				<form id="transferencia" >
					<div class="row form-horizontal">
						<div class="col-lg-6">
							<div class="form-group">
								  <label class="control-label col-md-4">Razon:</label>
								  <div class="col-md-8">									
									<input type="text" class="form-control col-md-8 col-lg-8 col-sm-8" id="RazonMerma" name="RazonMerma" >
								 </div>
						   </div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								  <label class="control-label col-md-4 col-lg-4 col-sm-4">Cantidad:</label>
								 <div class="col-md-8">
								  <input type="number" class="form-control col-md-8 col-lg-8 col-sm-8" id="cantidadMerma" name="cantidadMerma" min="1">
								 </div>								 
						   </div>
						</div>
					</div>
					</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" onclick="merma()">Descontar</button>
			  </div>
			</div>
		  </div>
	</div>
  </div>
</div>
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>
<style>
  #custom-handle {
	width:30px;
    height: 1.8em;
    top: 50%;
    margin-top: -.9em;
    text-align: center;
  }
  </style>
<script>
	$('#FEC_FECHAGERMINACION').datepicker({
    format: 'dd/mm/yyyy',
    language: 'esp'
	});

</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/jqueryslider.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/inventarioglobal.js"></script>
