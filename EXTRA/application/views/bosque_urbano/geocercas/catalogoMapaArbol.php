
<div id="page-wrapper">
  <div class="container-fluid">
   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header" style="font-size:30px">
        <?= $titulo?>
      </h1>
    </div>
  </div>

<div class="row form-horizontal">
	<div class="col-lg-5">
		<div class="form-group">
        	<label class="control-label col-lg-4">Estado</label>
        	<div class="col-lg-8">
          		<select class="form-control" id="estado" onchange="traerMunicipios()">            		
            		  <?php        
						foreach($estados as $estado)
						{?>     				
							<option value="<?=$estado["ID__ESTADO"]?>"><?=$estado["VCH_NOMBRE"]?></option>			
						<?php
						}
						?>
          		</select>
        	</div>
      	</div>
	</div>
	<div class="col-lg-5">
		<div class="form-group">
        	<label class="control-label col-lg-4">Municipio</label>
        	<div class="col-lg-8">
          		<select class="form-control" id="municipio">
            		<option value="-1">Todo el estado</option>            		 
          		</select>
        	</div>
      	</div>        	
        <div class="text-right">
			<button type="button" class="col-offset-lg-10 btn btn-primary" onclick="Definicion()"><i class="fa fa-search"></i> Definir</button>
          <button type="button" class="col-offset-lg-10 btn btn-primary" onclick="busqueda()"><i class="fa fa-search"></i> Buscar</button>
      </div>
	</div>
</div><br>
<div id="map" style="height:550px; width:100%;"></div>
<script type="text/javascript">
	var myPolygon;
	function initMap() 
	{
        var gdl = {lat: 20.6603089, lng: -103.3952507};
		  map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: gdl
        });      


		 /*var triangleCoords = [
			new google.maps.LatLng(20.6803089, -103.3852507),
			new google.maps.LatLng(20.6603089, -103.3052507),
			new google.maps.LatLng(20.7603089, -103.3952507)
		  ];// Styling & Controls
		  */
		  /*myPolygon = new google.maps.Polygon({
			paths: triangleCoords,
			draggable: true, // turn off if it gets annoying
			editable: true,
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#FF0000',
			fillOpacity: 0.35
		  });

		  myPolygon.setMap(map);
		  */		  
		  
		 // google.maps.event.addListener(myPolygon.getPath(), "insert_at", getPolygonCoords);		  
		//  google.maps.event.addListener(myPolygon.getPath(), "set_at", getPolygonCoords);


      }
      
</script>
</div>
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/geocercas.js"></script>

	
