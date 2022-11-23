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
				
				<?php		  $segments = array('BosqueUrbano', 'IframeAsignacionRecursoEvento',0);		  		  ?>
				<script>window.closeModal = function(){    $('#modalColonias').modal('hide');};
				window.alerta=function(mensaje) {bootbox.alert(mensaje);};
				var ID__EVENTO=0;
				</script>
				<iframe id="iframeTotal" src="<?=site_url($segments)?>" width="100%" height="790px;" style="overflow:hidden"></iframe>
		    				
				 
			</div>
		</div>
		
	</div>
  </div>
</div>
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>
<!--
<script type="text/javascript" src="<?=base_url()?>js/moment.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/bootstrap-datetimepicker.min.css"/>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-datetimepicker.js"></script>-->
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/EventosAsignarRecusosREAL.js"></script>
<script>
 $('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });
</script>

