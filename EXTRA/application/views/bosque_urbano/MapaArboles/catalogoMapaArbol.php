<div class="row form-horizontal">
	<div class="col-lg-6">
		<div class="form-group">
        	<label class="control-label col-lg-4">Fecha Inicio:</label>
        	<div class="col-lg-8">
          		<input type="text" class="form-control" id="fechaInicio" onkeypress="return false;" onpaste="return false;">
        	</div>
      	</div>
      	<div class="form-group">
        	<label class="control-label col-lg-4">Fecha Fin:</label>
        	<div class="col-lg-8">
          		<input type="text" class="form-control" id="fechafin" onkeypress="return false;" onpaste="return false;">
        	</div>
      	</div>
      	<!--<div class="form-group">
        	<label class="control-label col-lg-4">QR:</label>
        	<div class="col-lg-8">
          		<input type="text" class="form-control" id="QR">
        	</div>
      	</div>-->
      	<div class="form-group">
        	<label class="control-label col-lg-4">Tipo:</label>
        	<div class="col-lg-8">
          		<select id="tipo"  class="form-control" id="Tipo">
					<option value="0">Eventos de Adopcion</option>
					<option value="1">Eventos de Reforestacion</option>
					<option value="2">Adopcion Ciudadana</option>
					
          		</select>
        	</div>
      	</div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
        	<label class="control-label col-lg-4">Patrocinador:</label>
        	<div class="col-lg-8">
          		<select class="form-control" id="empresa">
            		<option value="-1">---</option>
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
        	<label class="control-label col-lg-4">Especies:</label>
        	<div class="col-lg-8">
          		<select class="form-control" id="especie">
            		<option value="-1">---</option>
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
      	
<!--      	<div class="form-group">
        	<label class="control-label col-lg-4">Estatus:</label>
        	<div class="col-lg-8">
          		<select class="form-control">
            		<option>---</option>
          		</select>
        	</div>
      	</div>-->
      	<!--<div class="form-group">
        	<label class="control-label col-lg-4">Eventos de Adopción:</label>
        	<div class="col-lg-8">
          		<select class="form-control" id="evento">
            		<option value="-1">---</option>
            		<?php        
						foreach($eventos as $evento)
						{?>     				
								<option value="<?=$evento["ID__EVENTO"]?>"><?=$evento["VCH_NOMBREEVENTO"]?></option>			
						<?php
						}
						?>
          		</select>
        	</div>
      	</div>-->
        <div class="text-right">
          <button type="button" class="col-offset-lg-10 btn btn-primary" onclick="busqueda()"><i class="fa fa-search"></i> Buscar</button>
      </div>
	</div>
</div><br>
<div id="map" style="height:550px; width:100%;"></div>
<script type="text/javascript">
	$('#fechaInicio').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	});
	$('#fechafin').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	});
	
	var map;
    var markers = [];
    var markerCluster=null;
    var geocoder;
    
	function initMap() 
	{
        var gdl = {lat: 20.6603089, lng: -103.3952507};
		  map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: gdl
        });      
        geocoder = new google.maps.Geocoder;
      }
</script>

<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/MapaArboles.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/Mapsclusterer.js"></script>

	
