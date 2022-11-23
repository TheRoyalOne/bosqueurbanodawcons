<div id="page-wrapper">
  <div class="container-fluid">
   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">
        Reporte Supervivencia de Reforestacion
      </h2>
    </div>
  </div>

<div id="catalogoEmbajadores">
  <?php include('FormularioReporteAdopcion.php'); ?>
</div>

<br>

</div><!--container fluid-->
</div><!--page-wrapper-->
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>

<!--<script type="text/javascript" src="< ?=base_url()?>js/Reportes/embajadores.js"></script>-->
<script type="text/javascript">
$('#fechaInicio').datepicker({
    format: 'dd/mm/yyyy',
    dateFormat: 'dd/mm/yyyy',
    language: 'esp'
  });
  $('#fechafin').datepicker({
    format: 'dd/mm/yyyy',
    dateFormat: 'dd/mm/yyyy',
    language: 'esp'
  });
  function generar()
  {
	  if($('#fechaInicio').val()=='' ||$('#fechafin').val()=='' )
	  {
		  bootbox.alert("Seleccione las fechas para el filtrado");
		  return;
	  }    
	  $("#form").submit();
   }
</script>
