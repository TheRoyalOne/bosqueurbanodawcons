<div id="page-wrapper">
  <div class="container-fluid">
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row">
			    <div class="col-lg-12">
			      <h2 class="page-header">
			        Bosque Urbano > <?= $titulo?>
			      </h2>
			    </div>
	  		</div>

	  		<div id="catalogoGuardaBosques">
	  			<?php include('catalogoEventoReforestacion.php'); ?>
			</div>
			<br>

			<div id="agregarModificar" hidden>
				  <div class="row">
				    <div class="col-lg-12">
				      <h2 class="page-header">
				        Formulario Eventos Reforestación
				      </h2>
				    </div>
				  </div>
				  <?php include('AgregarModificar.php'); ?>
			</div>
		</div>
	</div>
  </div>
</div>
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/EventosReforestacion.js"></script>
<script type="text/javascript">
	$('#fechaInicio').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	});
	$('#fechafin').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	});
	$('#fechaInicio1').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	});
	$('#fechafin1').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	});
</script>