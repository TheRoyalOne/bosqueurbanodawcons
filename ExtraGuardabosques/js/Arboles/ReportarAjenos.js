var objetoprevio;
var Marker;


function timeConverter(UNIX_timestamp)
{
  var a = new Date(UNIX_timestamp);
  console.log(a);
  var months = ['01','02','03','04','05','06','07','08','09','10','11','12'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  if(date<10)
  {
	  date="0"+date;
 }
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time = year+"-"+month + '-' +date;
  return time;
}
function Busqueda()
{
	$.ajax({
		  url: "BuscarQR",
		  type: 'POST',
		  data:{		 
					BusquedaQr: $("#BusquedaQr").val(),						
				}						  
		}).always(function(val) 
		{	
			if(val!="[]")
			{
				objetoprevio=JSON.parse(val);										
				objetoprevio=objetoprevio[0];					
				if(objetoprevio.FEC_FECHA_SEGUIMIENTO==null)
				{
					objetoprevio.FEC_FECHA_SEGUIMIENTO="";
				}
				var html="";				
								
				html="<tr><td>"+objetoprevio.VCH_CODIGOQR+"</td>"+
					 "<td>"+objetoprevio.VCH_NOMBRECOMUN+"</td>"+
					 "<td>"+objetoprevio.FEC_FECHA_SEGUIMIENTO+"</td>"+				 				
					 "<td>";					 					 
					 if(objetoprevio.FEC_FECHA_SEGUIMIENTO=="")
					 {
						 html+="<button class=\"btn btn-primary\" onclick=\"Seguimiento('"+objetoprevio.VCH_CODIGOQR+"','"+objetoprevio.ID__ARBOL+"','"+objetoprevio.VCH_LATITUD+"','"+objetoprevio.VCH_LONGITUD+"')\">Dar seguimiento</button>";
					 }					   
					 else
					 {						 
						 var d = new Date();
						 var ProxSeguimiento=d.setMonth(d.getMonth() + 3);
						 var actual = new Date();
						 actual=actual.setMonth(actual.getMonth() + 0);
						 if(ProxSeguimiento <= actual)
						 {
							 html+="<button class=\"btn btn-primary\" onclick=\"Seguimiento('"+objetoprevio.VCH_CODIGOQR+"','"+objetoprevio.ID__ARBOL+"','"+objetoprevio.VCH_LATITUD+"','"+objetoprevio.VCH_LONGITUD+"')\">Dar seguimiento</button>";
						 }
						 else
						 {
							 html+="<b>Proximo Seguimiento desde: </b>"+timeConverter(ProxSeguimiento);
						  }
					 }
				html+="</td></tr>";
				$('#tablaespecies').bootstrapTable('destroy');
				$('#tbodyarchivos').empty();
				$('#tablaespecies').append(html);
				$('#tablaespecies').bootstrapTable();	
				//$('#tablaespecies tbody').append(html);	
			}
			else
			{
					bootbox.alert("No se encontro la etiqueta registrada.");	
			}
			$('#tablaespecies').bootstrapTable();	
		});		
}

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
	
	if(document.getElementById("VCH_RUTA_FOTO_SOLOETIQUETA").files.length ==0)
	{
		bootbox.alert("Como estas reportando un arbol ajeno por favor introduce la foto de la etiqueta");
		return;
	}
	
	if(valido==true)
	{
		$("#VCH_LATITUD").val(Marker.getPosition().lat());
		$("#VCH_LONGITUD").val(Marker.getPosition().lng());	
		
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
	
