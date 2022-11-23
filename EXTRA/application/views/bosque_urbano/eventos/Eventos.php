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
	  			<?php include('catalogoEventos.php'); ?>
			</div>
			<br>

			<div id="agregarModificar" hidden>
				  <div class="row">
				    <div class="col-lg-12">
				      <h2 class="page-header">
				        Formulario Alta de eventos
				      </h2>
				    </div>
				  </div>
				  <?php include('AgregarModificar.php'); ?>
			</div>
			
			<div id="agregarModificarReforestacion" hidden>
				  <div class="row">
				    <div class="col-lg-12">
				      <h2 class="page-header">
				        Formulario Alta de eventos de reforestación
				      </h2>
				    </div>
				  </div>
				  <?php include('AgregarModificarReforestacion.php'); ?>
			</div>

			<div id="seguimiento" hidden>
	  			<?php include('seguimiento.php'); ?>
			</div>
			<div id="AdopcionDeEvento" hidden>
	  			<?php include('AdopcionDeEvento.php'); ?>
			</div>
		</div>
			<div id="FinalizarModal" class="modal fade" role="dialog">
			<form id="formFinalizar" action="<?=site_url(array('bosqueUrbano', 'LiberarEVENTO'))?>" method="post" enctype="multipart/form-data" >
			  <div class="modal-dialog modal-md">
				<div class="modal-content">
				  <div class="modal-header">
					<h4 class="modal-title">Finalizar evento</h4>
				  </div>
				  <div class="modal-body">
						<div class="row form-horizontal">
							<div class="col-lg-12">
								<div class="form-group">
									  <label class="control-label col-md-3">Archivo EXO:</label>
									  <div class="col-md-8">
										<input type="file" class="form-control requiredb" id="VCH_QRDESCONTAR" name="VCH_QRDESCONTAR" >
										<input type="hidden" class="form-control requiredb" id="idevent" name="idevent" >
									 </div>
							   </div>
							</div>						
						</div>						
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" onclick="finalizaevento()">Finalizar Evento</button>
				  </div>
				</div>
			  </div>
		    </form>
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
<?php
	//die(print_r($estado));
	if(!empty($mensaje))
	{
		?>
		<script>bootbox.alert('<?=$mensaje?>');	</script>
	<?php
	}
?>
<script type="text/javascript" src="<?=base_url()?>js/moment.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/bootstrap-datetimepicker.min.css"/>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/Eventos.js"></script>
<script>$('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });
 $( document ).ready(function() 
 {
	 if('<?=$AdopcionVivero?>'=='1')
	 {
		 $("#btnSeguimiento").click();
	 }
 });
 </script>
