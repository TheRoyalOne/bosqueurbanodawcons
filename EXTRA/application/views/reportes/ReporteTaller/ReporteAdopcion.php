<div id="page-wrapper">
  <div class="container-fluid">
   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">
       <?= $titulo?>
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
  
   
   
   
var ciudades;
function cargaciudades(id)
{
	$('#ID__MUNICIPIO').empty();	
	$('#ID__MUNICIPIO').append($('<option>',
	 {
		value: -1,
		text : "Todo"
	}));	
	if(id==-1)
	{
		return;	
	}
	
	$.ajax({
			  url: "getCiudadesLiberadas",
			  type: 'POST',
			  data:{					
					ID__ESTADO:id			
				  }						  
			}).done(function(val) 
			{									
				ciudades=JSON.parse(val);																
				for (i=0; i<ciudades.length;i++)
				{
					$('#ID__MUNICIPIO').append($('<option>',
					 {
						value: ciudades[i].ID__MUNICIPIO,
						text : ciudades[i].VCH_NOMBRE
					}));	
				}
							
			}).always(function(val)
			{
				console.log(val);
			});			
}
</script>
