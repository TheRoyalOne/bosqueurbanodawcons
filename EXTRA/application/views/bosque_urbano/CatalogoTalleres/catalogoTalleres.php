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
	  			<?php include('catalogoTalleresForm.php'); ?>
			</div>
			<br>

			<div id="agregarModificar" hidden>
				  <div class="row">
				    <div class="col-lg-12">
				      <h2 class="page-header">
				        Formulario Catalogo de Talleres
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
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/catalogoTalleres.js"></script>
<script>$('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });</script>
<?php
if(!empty($estado))
{
?>
	<script>
	bootbox.alert("<?=$estado?>");
	</script>
<?php
}
?>
