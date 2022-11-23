<div id="page-wrapper">
  <div class="container-fluid">
   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header" style="font-size:30px">
         <?= $titulo?>
      </h2>
    </div>
  </div>

<div id="catalogoEspecies">
  <?php include('catalogoEspecies.php'); ?>
</div>

<div id="agregarModificar" hidden>
  <?php include('agregarModificar.php'); ?>
</div>


</div><!--container fluid-->
</div><!--page-wrapper-->
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>

<script type="text/javascript" src="<?=base_url()?>js/administrativo/especies.js"></script>
<script>
 $('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });
</script>
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
