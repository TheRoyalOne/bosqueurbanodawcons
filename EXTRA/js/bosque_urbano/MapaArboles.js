//* Base*/
function abrirModal()
{
	if(document.getElementById("chkDomicilio").checked)
		{
			$('#modalColonias').modal('show');	
			$('#divDomicilio').attr('hidden', false);				
		}
		else
		{
			$('#divDomicilio').attr('hidden', true);				
		}
}
function inicializador()
{
	
}
inicializador();

function deleteMarkers() 
{
	clearMarkers();
	markers = [];
}
function clearMarkers() 
{
	setMapOnAll(null);
}
function setMapOnAll(map) 
{
	for (var i = 0; i < markers.length; i++) {
	  markers[i].setMap(map);
	}
}
var lastOpenedInfoWindow=null;
function addMarker(location,data) 
{	
	var contentString="";	
 
	switch($("#tipo").val())
	{								
		
		case "0":{
			
				var image = {
					//url: '../../Imagenes/arbol_vivob.png',
					url: '../../Imagenes/camiónb.png',
					// This marker is 20 pixels wide by 32 pixels high.
					size: new google.maps.Size(32, 32),
					// The origin for this image is (0, 0).
					origin: new google.maps.Point(0, 0),
					// The anchor for this image is the base of the flagpole at (0, 32).
				  //  anchor: new google.maps.Point(0, 32)
				  };
			
			
				contentString="<table><tr><td><b>Nombre de evento:</b>: "+data.VCH_NOMBREEVENTO+"</td></tr>"+
									 "<tr><td><b>Fecha de inicio:</b>: "+data.FEC_FECHAINICIO+"</td></tr>"+
									 "<tr><td><b>Fecha de termino:</b>: "+data.FEC_FECHAFIN+"</td></tr>"+
				"</table>";
				break;
				}
		case "1":{
			
				var image = {
					//url: '../../Imagenes/arbol_vivob.png',
					url: '../../Imagenes/camiónb.png',
					// This marker is 20 pixels wide by 32 pixels high.
					size: new google.maps.Size(32, 32),
					// The origin for this image is (0, 0).
					origin: new google.maps.Point(0, 0),
					// The anchor for this image is the base of the flagpole at (0, 32).
				  //  anchor: new google.maps.Point(0, 32)
				  };

			
				contentString="<table><tr><td><b>Nombre de evento:</b>: "+data.VCH_NOMBREEVENTO+"</td></tr>"+
									 "<tr><td><b>Fecha de inicio:</b>: "+data.FEC_FECHAINICIO+"</td></tr>"+
									 "<tr><td><b>Fecha de termino:</b>: "+data.FEC_FECHAFIN+"</td></tr>"+
				"</table>";
				break;
				}
		case "2":{
			
				

			
				contentString="<table><tr><td><b>QR:</b>: "+data.VCH_CODIGOQR+"</td></tr>"+
									 "<tr><td><b>Especie:</b>: "+data.VCH_NOMBRECOMUN+"</td></tr>"+
									 "<tr><td><b>Fecha de Adopcion:</b>: "+data.FEC_FECHA+"</td></tr>"+											 
									 "<tr><td><b>Estado:</b>: ";
									 if(data.VCH_ESTADO=="M")
									 {										 
										 var image = {
											url: '../../Imagenes/arbol_muertob.png',
											// This marker is 20 pixels wide by 32 pixels high.
											size: new google.maps.Size(32, 32),
											// The origin for this image is (0, 0).
											origin: new google.maps.Point(0, 0),
											// The anchor for this image is the base of the flagpole at (0, 32).
										  //  anchor: new google.maps.Point(0, 32)
										  };
										 
										 contentString+="Muerto";
									 }
									 else
									 {
										 contentString+="Vivo";
									 }
																			contentString+="</td></tr>"+											 									 
									 "<tr><td><b>Salud:</b>: ";
									if(data.VCH_SALUD=="E")
									{
										 var image = {
											url: '../../Imagenes/arbol_enfermob.png',
											// This marker is 20 pixels wide by 32 pixels high.
											size: new google.maps.Size(32, 32),
											// The origin for this image is (0, 0).
											origin: new google.maps.Point(0, 0),
											// The anchor for this image is the base of the flagpole at (0, 32).
										  //  anchor: new google.maps.Point(0, 32)
										  };
										contentString+="Enfermo";
									}
									else
									{
										var image = {
											url: '../../Imagenes/arbol_vivob.png',
											// This marker is 20 pixels wide by 32 pixels high.
											size: new google.maps.Size(32, 32),
											// The origin for this image is (0, 0).
											origin: new google.maps.Point(0, 0),
											// The anchor for this image is the base of the flagpole at (0, 32).
										  //  anchor: new google.maps.Point(0, 32)
										  };
										contentString+="Sano";
									}
									 contentString+="</td></tr>"+											 									
								     "<tr><td><b>Con etiqueta:</b>: ";
								     if(data.VCH_CON_ETIQUETA=="N")
									{
										contentString+="No";
									}
									else
									{
										contentString+="Si";
									}								     
								     contentString+="<tr><td><b>Plantado:</b>: ";
							        if(data.VCH_CONTENEDOR=="P")
									{
										contentString+="Plantado";
									}
									else
									{
										contentString+="Bolsa";
									}								     								     
								     contentString+="</td></tr>";	
								     contentString+="<tr><td><b>Acceso:</b>: ";	
								     if(data.VCH_ACCESO_AL_ARBOL=="R")
									{
										contentString+="Propiedad Privada";
									}
									else
									{
										contentString+="Via Publica";
									}								     
								    							     								     
								     contentString+="</td></tr>"+										     								     
									 
									 							 
				"</table>";
				break;
				}
		default:
			{
					var image = {
					url: '../../Imagenes/camiónb.png',
					// This marker is 20 pixels wide by 32 pixels high.
					size: new google.maps.Size(32, 32),
					// The origin for this image is (0, 0).
					origin: new google.maps.Point(0, 0),
					// The anchor for this image is the base of the flagpole at (0, 32).
				  //  anchor: new google.maps.Point(0, 32)
				  };

				
				contentString="<table><tr><td><b>Nombre de evento:</b>: "+data.VCH_NOMBREEVENTO+"</td></tr>"+
									 "<tr><td><b>Fecha de inicio:</b>: "+data.FEC_FECHAINICIO+"</td></tr>"+
									 "<tr><td><b>Fecha de termino:</b>: "+data.FEC_FECHAFIN+"</td></tr>"+
				"</table>";
				//console.log($("#Tipo").val());
			break;
			}
	}	
	
	
	

	var marker = new google.maps.Marker({
	  position: location,
	  map: map,
      icon: image
	});
	
	var infowindow = new google.maps.InfoWindow
	({
			content: contentString
    });                        
	marker.addListener('click', function() 
	{
  		  closeLastOpenedInfoWindow();
          infowindow.open(map, marker);
          lastOpenedInfoWindow=infowindow;
     });		
	markers.push(marker);
}


function closeLastOpenedInfoWindow() 
{
    if (lastOpenedInfoWindow) {
        lastOpenedInfoWindow.close();
    }
}
function busqueda()
{			
	$.ajax({
		  url: "traerArboles",
		  type: 'POST',
		  data:{										
				fechaInicio: $("#fechaInicio").val(),
				fechafin: $("#fechafin").val(),				
				empresa: $("#empresa").val(),				
				ID__ESPECIE: $("#especie").val(),
				Tipo: $("#tipo").val()					
			  }						  
		}).done(function(val) 
		{								 
			console.log(val);						
			objetoprevio=JSON.parse(val);				
			deleteMarkers();

			for (i=0; i<objetoprevio.length;i++)
			{				
				//console.log(objetoprevio[i]);
				addMarker({lat: parseFloat(objetoprevio[i].VCH_LATITUD), lng: parseFloat(objetoprevio[i].VCH_LONGITUD)},objetoprevio[i]); 
				//coordenadadomicilio({lat: parseFloat(objetoprevio[i].VCH_LATITUD), lng: parseFloat(objetoprevio[i].VCH_LONGITUD)});
			}
			if(markerCluster!=null)
			{
				markerCluster.clearMarkers();
			}
			markerCluster = new MarkerClusterer(map, markers,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
			return;																												
		})
		.always(function(val) 
		{								 
			console.log(val);
		});		
}


var resultadoconsulta;
function coordenadadomicilio(punto)
{		
	geocoder.geocode({'location': punto}, function(results, status) 
	{
	  if (status === 'OK') 
	  {
		if (results[1]) 
		{
			//resultadoconsulta.address_components.length
			resultadoconsulta.address_components;
			//resultadoconsulta=results[1];
			//results[1].formatted_address
			console.log(results[1].formatted_address);
		} 
		else 
		{
		  window.alert('No results found');
		}
	  } 
	  else 
	  {
		window.alert('Geocoder failed due to: ' + status);
	  }
	});
}

