var Marker;

function Seguimiento(qr,id,VCH_LATITUD,VCH_LONGITUD)
{
	$("#etiquetaPerdidaModal").modal('show');
	$("#qretiqueta").html(qr);
	
	$("#ID__ARBOL").val(id);
	$("#QR").val(qr);		
	
	
	$("#VCH_LATITUD").val(VCH_LATITUD);
	$("#VCH_LONGITUD").val(VCH_LONGITUD);				
}

function contestarEncuesta()
{
	valido=true;
	if($("input[name='optradioVCH_ESTADO']:checked").val()==undefined)
	{
		valido=false;
	}
	if($("input[name='optradioVCH_SALUD']:checked").val()==undefined)
	{
		valido=false;
	}
	if($("input[name='optradioVCH_CON_ETIQUETA']:checked").val()==undefined)
	{
		valido=false;
	}
	if($("input[name='optradioVCH_CONTENEDOR']:checked").val()==undefined)
	{
		valido=false;
	}
	if($("input[name='optradioVCH_UBICACION_REPORTADA']:checked").val()==undefined)
	{
		valido=false;
	}
	if($("input[name='optradioVCH_ACCESO_AL_ARBOL']:checked").val()==undefined)
	{
		valido=false;
	}		
	if(valido==false)
	{
		bootbox.alert("Por favor llena los campos requeridos");
	}
	if(valido==true)
	{
		if(Marker)
		{
			$("#VCH_LATITUD").val(Marker.getPosition().lat());
			$("#VCH_LONGITUD").val(Marker.getPosition().lng());	
		}
		
		$("#transferencia").submit();
	}
}			
	$('input[name=optradioVCH_UBICACION_REPORTADA]:radio').change(abrirmapa);	
	function abrirmapa() 
	{
		var val = $("input[name=optradioVCH_UBICACION_REPORTADA]:checked").val();
		if (val == 'T') 
		{
			$("#divmapa").show();
			initMap();
			
		}
		else
		{
				$("#divmapa").hide();
		}		
	}		
	
	
	function initMap() 
	{
		latP=parseFloat($("#VCH_LATITUD").val());
		lngP=parseFloat($("#VCH_LONGITUD").val());
		
	  var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 11,
		center: {lat:latP, lng: lngP}
	  });

	 // var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
	  Marker = new google.maps.Marker({
		//position: {lat: 20.890, lng: -103.274},
		position: {lat: latP, lng:lngP},
		map: map,
		draggable: true,
		//icon: image
	  });
	}
