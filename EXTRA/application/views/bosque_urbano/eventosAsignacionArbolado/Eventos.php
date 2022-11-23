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
				<script>window.closeModal = function(){    $('#modalColonias').modal('hide');};
				window.alerta=function(mensaje) {bootbox.alert(mensaje);};
				var ID__EVENTO=0;
				<?php	//	  $segments = array('BosqueUrbano', 'IframeAsignacionArboladoEvento',0);		  		  ?>
				</script>
				<iframe id="iframeTotal" src="" width="100%" height="1000px;"></iframe>
		    				
				 
			</div>
		</div>
		
	</div>
  </div>
  
  <div id="AsignacionModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Lista de etiquetas</h4>
		  </div>
		  <div class="modal-body text-center" >
			<div style="height300px;overflow:auto" class="text-center">
				<textarea rows="10" cols="30" class="form-control" style="width:200px" id="listaAsignaManual"></textarea>
			</div>
			<div class="row text-center" style="padding-top:10px">
				<button id="Asignac" class="btn btn-primary" onclick="AsignarEtiquetasAeventoManual()">Asignar</button>
				<button id="btnregresarLista" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		  </div>			  
		</div>
	  </div>
	</div>
  
  
  <div id="verListaModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Lista de etiquetas</h4>
		  </div>
		  <div class="modal-body" >
			<div style="height:200px;overflow:auto">
				<ul id="listaetiquetas">						
					<li>Coffee</li>
				</ul>
			</div>
		  </div>			  
		</div>
	  </div>
	</div>
</div>
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>


<div id="GenerarMiniEtiqueta" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-md">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title">Lista de etiquetas</h4>
		  </div>
		  <div class="modal-body" >
						
							<div class="row form-horizontal">
							  <div class="col-lg-6">
								<div class="form-group">
								  <label class="control-label col-lg-4">Patrocinador:</label>
								  <div class="col-lg-8">
									<select class="form-control" id="ID__EMPRESA" name="ID__EMPRESA" >
										<?php        
										foreach($empresas as $empresa)
										{?>     				
												<option value="<?=$empresa["ID__EMPRESA"]?>"><?=$empresa["VCH_NOMBREEMPRESA"]?></option>			
										<?php
										}
										?>
									</select>									
								  </div>
								</div>
							   
								<div class="form-group">
								  <label class="control-label col-lg-4">A&ntilde;o:</label>
								  <div class="col-lg-8">
									<input type="number" min="2015" max="2035" class="form-control requiredb" id="VCH_ANIO" name="VCH_ANIO">
								  </div>
								</div>								
								</div>
								<div class="col-lg-6">
								  <div class="form-group">
									<label class="control-label col-lg-4">Especie:</label>
									<div class="col-lg-8">
										 <select class="form-control" id="ID__ESPECIE" name="ID__ESPECIE" >
										<?php        
										foreach($especies as $especie)
										{?>     				
												<option value="<?=$especie["ID__ESPECIE"]?>"><?=$especie["VCH_NOMBRECOMUN"]?></option>			
										<?php
										}
										?>          
										</select>
									</div>
								  </div>
								  <div class="form-group">
									<label class="control-label col-lg-4">Cantidad:</label>
									<div class="col-lg-8">
									  <input type="number" min="1" max="5000" class="form-control requiredb" id="NUM_CANTIDAD" name="NUM_CANTIDAD">
									</div>
								  </div>      
							  </div><!--col--> 
							</div><!--col-->
					<div class="text-right">
						<button id="botonguardar" class="btn btn-primary" onclick="generar()">Crear</button>
						<button id="btnRegresar" class="btn btn-default" data-dismiss="modal">Regresar</button>
					</div>

				


		</div>			  
	</div>
  </div>
</div>

<script>
var direccion_AsignacionArbol="<?=site_url(array('BosqueUrbano', 'IframeAsignacionArboladoEvento',0))?>";
var direccion_AsignacionEtiqueta="<?=site_url(array('BosqueUrbano', 'IframeAsignacionEtiquetaEvento',0))?>";
</script>
<!--
<script type="text/javascript" src="<?=base_url()?>js/moment.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/bootstrap-datetimepicker.min.css"/>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-datetimepicker.js"></script>-->
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/EventosAsignarRecusos.js"></script>
<script>
 $('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });
</script>
<script>
function generar()
{
	var valido=true;
	$( ".requiredb" ).each(function() 
	{
		if($(this).val()=='')
		{
			valido=false;
		}		
	});		
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}
	
	$.ajax({
	  url: "etiquetasGenerar",
	  type: 'POST',
	  data:{		 
				ID__ESPECIE: $("#ID__ESPECIE").val(),		
				ID__EMPRESA:$("#ID__EMPRESA").val(),
				VCH_ANIO:$("#VCH_ANIO").val(),
				NUM_CANTIDAD:$("#NUM_CANTIDAD").val()
			}						  
	}).always(function(val) 
	{	
		bootbox.alert(val, function()
		{				
			$('#iframeTotal').attr("src", $('#iframeTotal').attr("src"));
		});
	});		
}


function AsignarEtiquetasAeventoManual()
{
	$("#listaAsignaManual").val($("#listaAsignaManual").val().replace(/\//g, '-'));	 
	$.ajax({
	  url: "AsignarEtiquetasAeventoManual",
	  type: 'POST',
	  data:{							
			JSON:JSON.stringify($("#listaAsignaManual").val()),
			ID__EVENTO:parent.ID__EVENTO,
		  }						  
	}).done(function(val) 
	{		
		var chain=JSON.parse(val);	
		if(chain.estatus=="Correcto")
		{
			bootbox.alert(chain.mensaje, function(){					
					$('#iframeTotal').attr("src", $('#iframeTotal').attr("src"));
					$("#btnregresarLista").click();
				 });											
		}
		else
		{
			parent.alerta(chain.mensaje);			
		}
		//cantidadEtiquetas=parseInt(val);								
	}).always(function(val) 
	{					
		console.log(val);					
	});		
}
</script>

