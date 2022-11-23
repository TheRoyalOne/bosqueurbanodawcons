var Marker;
var arr=[];
var index=0;
var objetodatos;
var ID__GUARDABOSQUE;
function Seguimiento(idGuarda)
{
	ID__GUARDABOSQUE=idGuarda;
	$.ajax({
		  url: "GetDatosGuardabosque",
		  type: 'POST',
		  data:{								
				ID__GUARDABOSQUE:idGuarda					
			  }						  
		}).done(function(val) 
		{	
			objetodatos=JSON.parse(val);	
			objetodatos=objetodatos[0];
			
			var html=" <table width='100%' class='table table-hover table-bordered'>"+			
					 "<tr>"+
						"<td width='100px'><b>Nombre: </b> "+objetodatos.nombre+"</td>"+					
					 "</tr>"+			
					 "<tr>"+
						"<td width='100px'><b>Telefono: </b>"+objetodatos.VCH_TELEFONO+"</td>"+					
					 "</tr>"+			
					 "<tr>"+
						"<td width='100px'><b>Celular: </b>"+objetodatos.VCH_CELULAR+"</td>"+					
					 "</tr>"+			
 				    "</table>";
				$("#datosGuardabosque").html(html);	
				$("#verListaModal").modal("show");
		});	
}
function seguimientoContesto()
{	
	$.ajax({
		  url: "GetArbolesParaSeguimiento",
		  type: 'POST',
		  data:{								
				ID__GUARDABOSQUE:ID__GUARDABOSQUE					
			  }						  
		}).done(function(val) 
		{	
			//DatosPlanta
			console.log(val);			
			objetodatos=JSON.parse(val);
			arr=objetodatos;
									
			$("#qretiqueta").html(objetodatos[0].VCH_CODIGOQR);						
			$('#guardarEval').removeAttr('onclick');
			$('#guardarEval').attr('onClick', 'contestarEncuesta('+objetodatos[0].ID__ARBOL+')');
					
			var html=" <table  class='table table-hover table-bordered'>"+			
					 "<tr>"+
						"<td width='200px'><b>ETIQUETA/QR: </b> </td><td>"+objetodatos[0].VCH_CODIGOQR+"</td>"+					
					 "</tr>"+			
					 "<tr>"+
						"<td width='200px'><b>ESPECIE: </b></td><td>"+objetodatos[0].VCH_NOMBRECOMUN+"</td>"+					
					 "</tr>"+			
 				    "</table>";
 				    
			$("#DatosPlanta").html(html);												
			$("#etiquetaPerdidaModal").modal('show');	
											
			$("#ID__ARBOL").val(objetodatos[0].ID__ARBOL);
			$("#QR").val(objetodatos[0].VCH_CODIGOQR);					
			
			/*,,
			$("#VCH_LATITUD").val(Marker.getPosition().lat());
			$("#VCH_LONGITUD").val(Marker.getPosition().lng());			*/
			$("#VCH_LATITUD").val(objetodatos[0].VCH_LATITUD);
			$("#VCH_LONGITUD").val(objetodatos[0].VCH_LONGITUD);			
			
		});	
}
function ContinuaIntenando()
{		
	bootbox.alert("Por favor intenta denuevo mas tarde!",function()
	{			 		
		$("#verListaModal").modal("hide");
	});		
}
function MarcarEquivocado()
{		
	bootbox.confirm("Marcar el contacto como equivocado?", function(result) 
	{
		if(result)
		{
			$.ajax({
			  url: "SetEquivocado",
			  type: 'POST',
			  data:{								
					ID__GUARDABOSQUE:ID__GUARDABOSQUE					
				  }						  
			}).done(function(val) 
			{				
				bootbox.alert("El numero se ha marcado como : <b>DATOS DE CONTACTO ERRONEOS</b>",function()
				{			 		
					$("#verListaModal").modal("hide");
					document.location.reload();
				});		
			});	
		}
	}); 
}



function getFormData($form)
{
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
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
		
		$("#VCH_LATITUD").val(Marker.getPosition().lat());
		$("#VCH_LONGITUD").val(Marker.getPosition().lng());
		
		var form = $("#transferencia");
		data=getFormData(form);
		$.ajax({
			  url: "ReporteEstadoAccion",
			  type: 'POST',
			  data:data				  						  
			}).done(function(val) 
			{				
				console.log(val);
				index++;
				if(arr[index]!=undefined)
				{															
					bootbox.alert("Registro Guardado, pasando al siguiente </b>",function()
					{
						
							//var options = {};$( "#datosGuardabosque" ).effect( "Slide", options, 500, callback );	
							$( "#DatosPlanta" ).effect( "slide");		
							$("#qretiqueta").html(arr[index].VCH_CODIGOQR);						
							$('#guardarEval').removeAttr('onclick');
							$('#guardarEval').attr('onClick', 'contestarEncuesta()');
									
							var html=" <table  class='table table-hover table-bordered'>"+			
									 "<tr>"+
										"<td width='200px'><b>ETIQUETA/QR: </b> </td><td>"+arr[index].VCH_CODIGOQR+"</td>"+					
									 "</tr>"+			
									 "<tr>"+
										"<td width='200px'><b>ESPECIE: </b></td><td>"+arr[index].VCH_NOMBRECOMUN+"</td>"+					
									 "</tr>"+			
									"</table>";
							
							 //marker.setMap(null);	
							
								
							$("#DatosPlanta").html(html);	
							$("#ID__ARBOL").val(arr[index].ID__ARBOL);
							$("#QR").val(arr[index].VCH_CODIGOQR);			 		
							$("#VCH_LATITUD").val(arr[index].VCH_LATITUD);
							$("#VCH_LONGITUD").val(arr[index].VCH_LONGITUD);												
							 initMap();
					});		
				}
				else
				{
					bootbox.alert("Todos los arboles del guardabosques han sido registrados!",function()
					{	
						document.location.reload();
					});		
				}
			});	
	}
}
function subirPics(cual)
{
	$("#form"+cual).submit();
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
	/*console.log("??");
	console.log($("#VCH_LATITUD").val());
	console.log($("#VCH_LONGITUD").val());*/
	
	
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
	
