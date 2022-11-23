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
	  			<?php include('catalogoAdopcion.php'); ?>
			</div>
			<br>

			<div id="agregarModificar" hidden>
				  <div class="row">
				    <div class="col-lg-12">
				      <h2 class="page-header">
				        Formulario Registros Adopción
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
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/RegistroAdopcion.js"></script>
<script type="text/javascript">
	$('#fechaInicio').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	});
	$('#fechafin').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	});
</script>