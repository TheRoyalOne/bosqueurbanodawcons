<div id="page-wrapper">
  <div class="container-fluid">
   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">
        Bosque Urbano > <?= $titulo?>
      </h2>
    </div>
  </div>

<div id="altaVales">
  <?php include('formularioAltaVales.php'); ?>
</div>

</div><!--container fluid-->
</div><!--page-wrapper-->
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>

<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/evaluacion.js"></script>
<script type="text/javascript">
  $("#Fecha").datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
  });

</script>