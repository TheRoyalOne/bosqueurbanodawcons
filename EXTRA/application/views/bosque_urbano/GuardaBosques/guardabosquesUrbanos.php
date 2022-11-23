<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script>
<style>.success {
  background-color: #dff0d8 !important;
}</style>
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
	  			<?php include('catalogoGuardaBosques.php'); ?>
			</div>
			<br>

			<div id="agregarModificar" hidden>
				  <div class="row">
				    <div class="col-lg-12">
				      <h2 class="page-header">
				        Formulario GuardaBosques
				      </h2>
				    </div>
				  </div>
				  <?php include('AgregarModificar.php'); ?>
			</div>
		</div>

		<div id="modalColonias" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h4 class="modal-title">Colonias</h4>
		      </div>
		      <div class="modal-body" style="padding-bottom: 50px;">
		       <?php		  $segments = array('general', 'buscadorColonias');		  		  ?>
				  <script>window.closeModal = function(){    $('#modalColonias').modal('hide');};</script>
				  <iframe src="<?=site_url($segments)?>" style="width:100%;height:500px;"></iframe>
				<!--< ?php include('buscadorColonias.php'); ?>-->
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
  </div>
</div>
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>

<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/GuardaBosques.js"></script>
<script>$('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });</script>
