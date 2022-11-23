//* Base*/
var ID__EVENTO=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;
var ID__EMPRESA=0;
var VCH_ESTATUS=0;
var empresa=null;
var cantidadEspecie={};
var cantidadActual=0;
var etiquetasGeneral=[];
var etiquetasGeneralA=[];
var mapSeguimiento=null;
var mapEvento=null;
var marcadorEvento=null;
var mapEventoReforestacion=null;
var marcadorEventoReforestacion=null;
var marcadoresSeguimiento=[];
var posicionInicial = {lat: 20.65712088188074, lng: -103.3976823091507};
var marcadores=[];
var arrayArboles=new Array();
var ultimocargado=0;

var TipoEvento="";

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

function cargarEtiquetas(cual)
{
			ultimocargado=cual;
			$.ajax({
				url: "seguimientoeti",
				type: 'POST',
				data:{					
					ID__EVENTO: cual				
				},
				success:function(datos)
				{					
					datosJson=JSON.parse(datos);					
					etiquetasGeneral=datosJson.etiquetas;

					getCodigosEspecie(cual);
					actualizaLabelsCodigos();
				},
				error:function(e1,e2,e3)
				{
					console.log(e1);
					console.log(e2);
					console.log(e3);
				}						  
			});
}

function inicializador()
{
	$("#AbtnQuitarCodigo").click(function () 
	{		
		$("#AselCodigosAgregados option:selected").remove().appendTo('#AselCodigos');		
	});
	
	$("#btnAgregar").click(function () 
	{
		$('#FNUM_ARBOLESSOLICITADOS').attr('readonly', false);				
		
		
		ID__EVENTO=0;
		$("#tablaespecies tr").removeClass("success");
		/*bootbox.prompt({
			title: "Seleccione el tipo de evento que desea agregar.",
			buttons:{
				confirm:{label:"Aceptar"},
				cancel:{label:"Cancelar"}
			},
			inputType: 'select',
			inputOptions: [
			{
				text: 'Adopción',
				value: '1',
			},
			{
				text: 'Reforestación',
				value: '2',
			}
			],
			callback: function (eleccion) 
			{
				switch(eleccion)
				{
					case "1":*/
					  TipoEvento=1;//Adopcion
					  
					  
					  
					  $('#agregarModificarReforestacion').hide();
					  $('#seguimiento').hide();
					  $('#agregarModificar').show();

					  var posicion = $("#agregarModificar").offset().top;
					  $("html, body").animate({
						scrollTop: posicion
					  }, 2000,function(){
								initMapEvento(20.65712088188074,-103.3976823091507);
						  })
					/*break;	

					case "2":
					{																					  
					  TipoEvento=2;//Reforestacion
					  $('#agregarModificar').hide();
					  $('#seguimiento').hide();
					  $('#agregarModificarReforestacion').show();					 
					  var posicion = $("#agregarModificarReforestacion").offset().top;
					  $("html, body").animate({
						scrollTop: posicion
					  }, 2000,function(){
								initMapEventoReforestacion(20.65712088188074,-103.3976823091507);
						  });
					 
						break;
					}

					default:
					{
						break;
					}
				}
			}
		});
		*/
		
	});
	$("#btnEditar").click(function () 
	{		
		$('#FNUM_ARBOLESSOLICITADOS').attr('readonly', true);
		//$('#FID__EMPRESA').attr('readonly', true);
		
		/*if( $('#'+ID__EVENTO+' td:nth-child(6)').text().trim!="")
		{
			
		}*/
		
		
		if(ID__EVENTO!=0)		
		{	
			if(VCH_ESTATUS=="Finalizado")
			{
				bootbox.alert("El evento ya se encuentra concluido");
				return;
			}
			/*
			if(TipoEvento==1)
			{*/
				$('#agregarModificarReforestacion').hide();
				$('#agregarModificar').show();	
				var posicion = $("#agregarModificar").offset().top;
				$("html, body").animate({
					scrollTop: posicion
				}, 2000,cargarDatos())
			/*}
			else
			{
				$('#agregarModificar').hide();	
				$('#agregarModificarReforestacion').show();
				var posicion = $("#agregarModificarReforestacion").offset().top;
				$("html, body").animate({
					scrollTop: posicion
				}, 2000,cargarDatosRef())
			}						*/				
		}
		else
		{
			bootbox.alert("Por favor selecciona el evento a modificar");
		}
	});
	$("#btnAdopcion").click(function () 
	{		          
		if(ID__EVENTO!=0)		
		{  
            $('#catalogoGuardaBosques').hide();
            $('#agregarModificar').hide();
			$('#seguimiento').hide();
			$('#AdopcionDeEvento').show();			
			$.ajax({
				url: "AdopcionOnline",
				type: 'POST',
				data:{					
					ID__EVENTO: ID__EVENTO					
				},
				success:function(datos)
				{					
					datosJson=JSON.parse(datos);                                        
					getEspeciesA(datosJson.arboles);
					etiquetasGeneralA=datosJson.etiquetas;
				},
				error:function(e1,e2,e3)
				{
					console.log(e1);
					console.log(e2);
					console.log(e3);
				}						  
			});
			initMapSeguimientoA();		
		}
		else
		{
			bootbox.alert("Por favor selecciona el evento sobre el cual adoptaran");
		}
	});
	$("#btnSeguimiento").click(function () 
	{		            
            $('#catalogoGuardaBosques').hide();
            $('#agregarModificar').hide();
			$('#AdopcionDeEvento').hide();
			$('#seguimiento').show();
			
			$.ajax({
				url: "seguimiento",
				type: 'POST',
				data:{					
					ID__EVENTO: ID__EVENTO					
				},
				success:function(datos)
				{					
					datosJson=JSON.parse(datos);
					//console.log(datosJson.arboles);                    
					getEspecies(datosJson.arboles);
					//etiquetasGeneral=datosJson.etiquetas;
				},
				error:function(e1,e2,e3)
				{
					console.log(e1);
					console.log(e2);
					console.log(e3);
				}						  
			});			

			initMapSeguimiento();		
	});
	$("#btnTerminar").click(function () 
	{
		if(ID__EVENTO!=0)		
		{
			if(VCH_ESTATUS=="Finalizado")
			{
				bootbox.alert("El evento ya se encuentra concluido");
				return;
			}
			if(TipoEvento==1)
			{
				finalizaevento();
				
				//$('#FinalizarModal').modal('show');	
			}
			else
			{
				bootbox.confirm
				({
						message: "Esto creara los registros de todos los arboles asignados, esta seguro?",
						callback: function (val) 
						{
							if(val)
							{
								$.ajax({
								  url: "FinalizarReforestacion",
								  type: 'POST',
								  data:{ID__EVENTO:ID__EVENTO}						  
								}).done(function(val) 
								{					
									alert(val)	 
									document.location.reload();
								});											
							}					
						}
				})	
			}
		}
		else
		{
			bootbox.alert("Por favor selecciona el evento a terminar");
		}
	});
	$("#btnRegresar").click(function () 
	{
		$('#agregarModificar').hide();
		var posicion = "0px";
		$("html, body").animate({
			scrollTop: posicion
		}, 0000)		
	});
	$("#btnRegresarReforestacion").click(function () 
	{
		$('#agregarModificarReforestacion').hide();
		var posicion = "0px";
		$("html, body").animate({
			scrollTop: posicion
		}, 0000)		
	});
	$("#tablaespecies").on('click', 'tr' , function (event) 
	{
		ID__EMPRESA=$(this).children()[1].id;
		empresa=$(this).children()[1].textContent;
		ID__EVENTO=$(this).attr('id');					
		VCH_ESTATUS=$(this).find("td:nth-child(6)")[0].innerText;		
		TipoEvento=1;				
	});
}
inicializador();


function GeneraPass()
{
	alert("click");
}

function cargarDatos()
{		
	$.ajax({
		  url: "cargarEventoCatalogo",
		  type: 'POST',
		  data:{					
				ID__EVENTO: ID__EVENTO					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val)				
			if(objetoprevio[0])					
			{
				objetoprevio=objetoprevio[0];
			}
			ID__COLONIA=objetoprevio.ID__COLONIA;			
			ID__DOMICILIO=objetoprevio.ID__DOMICILIO;


			if(objetoprevio.VCH_ESTATUS==1)
			{
				$('#form-activoe').click();
			}
			else
			{
				$('#form-inactivoe').click();
			}
			
			
			$('#FVCH_TIPO').val(objetoprevio.VCH_TIPO);
			$('#FID__EMPRESA').val(objetoprevio.ID__EMPRESA);			
			$('#FVCH_NOMBREEVENTO').val(objetoprevio.VCH_NOMBREEVENTO);
			$('#FVCH_NOMBRELUGAR').val(objetoprevio.VCH_NOMBRELUGAR);
			$('#FVCH_OBSERVACIONES').val(objetoprevio.VCH_OBSERVACIONES);						
			$('#FNUM_COMPUTADORAS').val(objetoprevio.NUM_COMPUTADORAS);						
			$('#FNUM_ARBOLESSOLICITADOS').val(objetoprevio.NUM_ARBOLESSOLICITADOS);						
			$('#FFEC_FECHAINICIO').val(objetoprevio.FEC_FECHAINICIO);						
			$('#FFEC_FECHAFIN').val(objetoprevio.FEC_FECHAFIN);		
							
			//$('#VCH_LATITUD').val(objetoprevio.VCH_LATITUD);						
			//$('#VCH_LONGITUD').val(objetoprevio.VCH_LONGITUD);						
						
			$('#divDomicilio-estado').val(objetoprevio.estado);
			$('#divDomicilio-municipio').val(objetoprevio.municipio);
			$('#divDomicilio-cp').val(objetoprevio.VCH_CODIGOPOSTAL);
			$('#divDomicilio-colonia').val(objetoprevio.colonia);			
			$('#divDomicilio-calle').val(objetoprevio.VCH_CALLE);
			$('#divDomicilio-entre').val(objetoprevio.VCH_ENTRECALLE);
						
			if(ID__COLONIA!=null)
			{
				
				$( "#chkDomicilio" ).prop( "checked", true );
				$('#divDomicilio').attr('hidden', false);
			}
			else
			{
				$( "#chkDomicilio" ).prop( "checked", false );
				$('#divDomicilio').attr('hidden', true);
			}
			if(objetoprevio.VCH_ESTATUS==2)
			{
				$( "#buttguar" ).prop( "disabled", true );
			}
			else
			{
				$( "#buttguar" ).prop( "disabled", false );
			}
			initMapEvento(objetoprevio.VCH_LATITUD,objetoprevio.VCH_LONGITUD);
		});		
		

}

function cargarDatosRef()
{		
	$.ajax({
		  url: "cargarEventoCatalogoReforesta",
		  type: 'POST',
		  data:{					
				ID__EVENTO: ID__EVENTO					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val)				
			if(objetoprevio[0])					
			{
				objetoprevio=objetoprevio[0];
			}			
			$('#FVCH_NOMBREEVENTOREFORESTACION').val(objetoprevio.VCH_NOMBREEVENTO);
			$('#VCH_TIPOREFORESTA').val(objetoprevio.VCH_TIPOREFORESTA);			
			
			var empresas="";
			if(objetoprevio.VCH_EMPRESASREFOR!="")
			{
				empresas=JSON.parse(objetoprevio.VCH_EMPRESASREFOR);
			}			
			$('#selEmpresasParticipantes').empty();
			for(i=0;i<empresas.length;i++)
			{								
				$('#selEmpresasReforestacion').val(empresas[i]);
				$('#btnAgregarEmpresa').click();
			}

			$('#FFEC_FECHAINICIOREFORESTACION').val(objetoprevio.FEC_FECHAINICIO);						
			$('#FFEC_FECHAFINREFORESTACION').val(objetoprevio.FEC_FECHAFIN);		
			$('#VCH_PRERREQUISITOS').val(objetoprevio.VCH_PRERREQUISITOS);		
			$('#FNUM_ARBOLESSOLICITADOSREF').val(objetoprevio.NUM_ARBOLESSOLICITADOS);		
			$('#FVCH_OBSERVACIONESREF').val(objetoprevio.VCH_OBSERVACIONES);		
									
			if(objetoprevio.VCH_ESTATUS==1)
			{
				$('#form-activoc').click();
			}
			else
			{
				$('#form-inactivoc').click();
			}			
			initMapEventoReforestacion(objetoprevio.VCH_LATITUD,objetoprevio.VCH_LONGITUD);
		});				
}


function guardar()
{
	var valido=true;
	$( ".required" ).each(function() 
	{
		if($(this).val()=='')
		{
			valido=false;
			console.log($(this));
		}		
	});
	if($("input[name='optradio']:checked").val()==undefined)
	{
		console.log($(this));
		valido=false;
	}
	
	var urlMetodo;
	if(ID__EVENTO==0) 
	{
		urlMetodo="altaEventoCatalogo";	
	}
	else
	{		
		urlMetodo="editarEventoCatalogo";
	}	
	
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}
		
	$.ajax({
	  url: urlMetodo,
	  type: 'POST',
	  data:{
			ID__EVENTO:ID__EVENTO,			
			ID__DOMICILIO:ID__DOMICILIO,
			ID__COLONIA:ID__COLONIA,
			VCH_ESTATUS:$("input[id=form-activoe]").is(":checked"),
			VCH_TIPO:$('#FVCH_TIPO').val(),
			ID__EMPRESA:$('#FID__EMPRESA').val(),			
			VCH_NOMBREEVENTO:$('#FVCH_NOMBREEVENTO').val(),
			VCH_NOMBRELUGAR:$('#FVCH_NOMBRELUGAR').val(),
			VCH_OBSERVACIONES:$('#FVCH_OBSERVACIONES').val(),						
			NUM_COMPUTADORAS:$('#FNUM_COMPUTADORAS').val(),						
			NUM_ARBOLESSOLICITADOS:$('#FNUM_ARBOLESSOLICITADOS').val(),						
			FEC_FECHAINICIO:$('#FFEC_FECHAINICIO').val(),						
			FEC_FECHAFIN:$('#FFEC_FECHAFIN').val(),						
			VCH_CALLE:$('#divDomicilio-calle').val(),
			VCH_ENTRECALLE:$('#divDomicilio-entre').val(),
			VCH_LATITUD:marcadorEvento.position.lat(),
			VCH_LONGITUD:marcadorEvento.position.lng()

			}						  
	}).always(function(val) 
	{	
			//console.log(val); return;
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});
			//document.getElementById("embaja").reset();
	});		
	//$('#form-especie').attr('action', urlMetodo);	
	//$("#form-especie" ).submit();			
}


function getEmpresasSeleccionadas()
{
	var arraye=[];
	$("#selEmpresasParticipantes option").each(function()
	{
		arraye.push($(this).val());		
	});
	return arraye;
}
function guardarREFOR()
{
	var valido=true;
	$( ".requiredc" ).each(function() 
	{
		if($(this).val()=='')
		{
			valido=false;			console.log($(this));
		}		
	});
	if($("input[name='optradioc']:checked").val()==undefined)
	{
		console.log($(this));		valido=false;
	}
	
	var urlMetodo;
	if(ID__EVENTO==0) 
	{
		urlMetodo="altaEventoReforCatalogo";	
	}
	else
	{		
		urlMetodo="editarEventoReforCatalogo";
	}		
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}		
	$.ajax({
	  url: urlMetodo,
	  type: 'POST',
	  data:{
			ID__EVENTO:ID__EVENTO,			
			VCH_NOMBREEVENTO:$('#FVCH_NOMBREEVENTOREFORESTACION').val(),
			EMPRESAS:JSON.stringify(getEmpresasSeleccionadas()),
			VCH_TIPOREFORESTA:$('#VCH_TIPOREFORESTA').val(),
			NUM_ARBOLESSOLICITADOS:$('#FNUM_ARBOLESSOLICITADOSREF').val(),					
			FEC_FECHAINICIO:$('#FFEC_FECHAINICIOREFORESTACION').val(),						
			FEC_FECHAFIN:$('#FFEC_FECHAFINREFORESTACION').val(),												
			VCH_ESTATUS:$("input[id=form-activoc]").is(":checked"),
			VCH_OBSERVACIONES:$('#FVCH_OBSERVACIONESREF').val(),	
			VCH_PRERREQUISITOS:$('#VCH_PRERREQUISITOS').val(),				
			
			/*
			ID__EMPRESA:$('#FID__EMPRESA').val(),						
			VCH_NOMBRELUGAR:$('#FVCH_NOMBRELUGAR').val(),					
			NUM_COMPUTADORAS:$('#FNUM_COMPUTADORAS').val(),										
			VCH_CALLE:$('#divDomicilio-calle').val(),
			VCH_ENTRECALLE:$('#divDomicilio-entre').val(),*/
			VCH_LATITUD:marcadorEventoReforestacion.position.lat(),
			VCH_LONGITUD:marcadorEventoReforestacion.position.lng()

			}						  
	}).always(function(val) 
	{	
			console.log(val);
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});			
	});			
}

function eliminar()
{	
	if(ID__EVENTO!=0)		
	{	
		if(VCH_ESTATUS=="Finalizado")
		{
			bootbox.alert("El evento ya se encuentra concluido");
			return;
		}
		
		bootbox.confirm
		({
				message: "¿Esta seguro que desea borrarlo?",
				callback: function (val) 
				{
					if(val)
					{
						$.ajax({
						  url: "eliminarEventoCatalogo",
						  type: 'POST',
						  data:{ID__EVENTO:ID__EVENTO}						  
						}).done(function(val) 
						{					
							alert(val)	 
							document.location.reload();
						});											
					}					
				}
		})
	}
	
	else
	{
		bootbox.alert("Por favor selecciona el evento");
	}
}

$('#FEC_FECHAINICIOCal').datetimepicker();
$('#FEC_FECHAFINcal').datetimepicker();
$('#FFEC_FECHAINICIOCal').datetimepicker();
$('#FFEC_FECHAFINcal').datetimepicker();
$('#FFEC_FECHAINICIOREFORESTACION').datetimepicker();
$('#FFEC_FECHAFINREFORESTACION').datetimepicker();

//-------------------Evento reforestación-------------------
$('#btnAgregarEmpresa').click(function()
{
	$.each($('#selEmpresasReforestacion > option'),function(index,codigo)
	{
		if(codigo.selected)
		{
			$('#selEmpresasParticipantes').append(codigo);
		}
	});
});

function initMapEventoReforestacion(lat,lon) 
{
		lat=parseFloat(lat);
		lon=parseFloat(lon);
		mapEventoReforestacion = new google.maps.Map(document.getElementById('mapEventoReforestacion'), {
			zoom: 12,
			center: {lat: lat, lng: lon}
		});
		marcadorEventoReforestacion=new google.maps.Marker({
				position: {lat: lat, lng: lon},
				map: mapEventoReforestacion,
				draggable:true,
				title: 'Ubicación del evento de reforestación'
			});
			
			
		var input = document.getElementById('pac-inputReforestacion');
		var searchBox = new google.maps.places.SearchBox(input);
		 mapEventoReforestacion.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		 
		 mapEventoReforestacion.addListener('bounds_changed', function() {
		   searchBox.setBounds(mapEventoReforestacion.getBounds());
		 });

			searchBox.addListener('places_changed', function() 
			{
				
			  var places = searchBox.getPlaces();	
			  var place;		 
			  if (places.length == 0) 
			  {
				return;
			  }
			  else
			  {
				   place=places[0];
			  }

			  // Clear out the old markers.			  
  			  marcadorEventoReforestacion.setMap(null);

			  // For each place, get the icon, name and location.
			  var bounds = new google.maps.LatLngBounds();
			  /*places.forEach(function(place) 
			  {*/
				if (!place.geometry) {
				  console.log("Returned place contains no geometry");
				  return;
				}
				/*var icon = {
				  url: place.icon,
				  size: new google.maps.Size(71, 71),
				  origin: new google.maps.Point(0, 0),
				  anchor: new google.maps.Point(17, 34),
				  scaledSize: new google.maps.Size(25, 25)
				};*/

				// Create a marker for each place.
				marcadorEventoReforestacion=new google.maps.Marker({				 
				  map: mapEventoReforestacion,
				  draggable:true,
				  title: 'Ubicación del evento',
				  position: place.geometry.location
				});

				if (place.geometry.viewport) {
				  // Only geocodes have viewport.
				  bounds.union(place.geometry.viewport);
				} else {
				  bounds.extend(place.geometry.location);
				}
			  //});
			  mapEventoReforestacion.fitBounds(bounds);
			});

}

//-------------------Agregar evento-------------------------
function initMapEvento(lat,lon) 
{
		$("#master").html('<input id="pac-input" class="controls" type="text" placeholder="Search Box"><div id="mapEvento" style="height:550px; width:100%;"></div>');		
		lat=parseFloat(lat);
		lon=parseFloat(lon);
//		console.log(lat+" "+lon);
		mapEvento = new google.maps.Map(document.getElementById('mapEvento'), 
		{
			zoom: 12,
			center: {lat: lat, lng: lon}
		});
		marcadorEvento=new google.maps.Marker({
				position: {lat: lat, lng: lon},
				map: mapEvento,
				draggable:true,
				title: 'Ubicación del evento'
			});
	
			
		var input = document.getElementById('pac-input');
		var searchBox = new google.maps.places.SearchBox(input);
		 mapEvento.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		 
		 mapEvento.addListener('bounds_changed', function() {
		   searchBox.setBounds(mapEvento.getBounds());
		 });

			searchBox.addListener('places_changed', function() 
			{
				
			  var places = searchBox.getPlaces();	
			  var place;		 
			  if (places.length == 0) 
			  {
				return;
			  }
			  else
			  {
				   place=places[0];
			  }
				console.log(place);
			  // Clear out the old markers.			  
  			  marcadorEvento.setMap(null);

			  // For each place, get the icon, name and location.
			  var bounds = new google.maps.LatLngBounds();
			  /*places.forEach(function(place) 
			  {*/
				if (!place.geometry) {
				  console.log("Returned place contains no geometry");
				  return;
				}
				/*var icon = {
				  url: place.icon,
				  size: new google.maps.Size(71, 71),
				  origin: new google.maps.Point(0, 0),
				  anchor: new google.maps.Point(17, 34),
				  scaledSize: new google.maps.Size(25, 25)
				};*/

				// Create a marker for each place.
				marcadorEvento=new google.maps.Marker({				 
				  map: mapEvento,
				  draggable:true,
				  title: 'Ubicación del evento',
				  position: place.geometry.location
				});

				if (place.geometry.viewport) {
				  // Only geocodes have viewport.
				  bounds.union(place.geometry.viewport);
				} else {
				  bounds.extend(place.geometry.location);
				}
			  //});
			  mapEvento.fitBounds(bounds);
			});
	console.log("free");
	
}

//-------------------Seguimiento----------------------------
//Se pobla el select con las especies de arbol relacionaras con el evento
function getEspecies(arboles)
{
	
	$.each(arboles,function(index,arbol)
	{
		if(Object.keys(cantidadEspecie).indexOf(arbol.ID__ESPECIE)<0)
		{
			$('#selEspecie').append("<option value='"+arbol.ID__ESPECIE+"'>"+arbol.especie+"</option>");
			cantidadEspecie[arbol.ID__ESPECIE]=parseInt(arbol.NUM_CANTIDAD);
		}
		else
			cantidadEspecie[arbol.ID__ESPECIE]+=parseInt(arbol.NUM_CANTIDAD);
	});
}
function getEspeciesA(arboles)
{
	
	$.each(arboles,function(index,arbol)
	{
		if(Object.keys(cantidadEspecie).indexOf(arbol.ID__ESPECIE)<0)
		{
			$('#AselEspecie').append("<option value='"+arbol.ID__ESPECIE+"'>"+arbol.especie+"</option>");
			cantidadEspecie[arbol.ID__ESPECIE]=parseInt(arbol.NUM_CANTIDAD);
		}
		else
			cantidadEspecie[arbol.ID__ESPECIE]+=parseInt(arbol.NUM_CANTIDAD);
	});
}

//Actualiza el contador de los códigos QE disponibles y agregados
function actualizaLabelsCodigos()
{
	var texto=$('#selCodigos > option').length+' QR disponible(s):';

	$('#lblDisponibles').text(texto);
    texto=$('#selCodigosAgregados > option').length+' QR agregado(s):';
    $('#lblAgregados').text(texto);
}
function AactualizaLabelsCodigos()
{
	var texto=$('#selCodigosA > option').length+' QR disponible(s):';

	$('#lblDisponiblesA').text(texto);
    texto=$('#selCodigosAgregadosA > option').length+' QR agregado(s):';
    $('#lblAgregadosA').text(texto);
}

//Busca y pobla el select con todas las etiquetas disponibles para la especie seleccionada
function getCodigosEspecie(especieID)
{
	$('#selCodigos').html('');
	$('#selCodigos').append("<option value='-1'>No lleva</option>");
	$.each(etiquetasGeneral,function(index,etiqueta)
	{
		if(etiqueta.ID__ESPECIE==especieID)
		  $('#selCodigos').append("<option value='"+etiqueta.ID__ETIQUETA+"'>"+etiqueta.VCH_QR+"</option>");
	});
}
function AgetCodigosEspecie(especieID)
{
//	console.log(etiquetasGeneralA);
	$('#AselCodigos').html('');
	$.each(etiquetasGeneralA,function(index,etiqueta)
	{
		console.log("3");	
		if(etiqueta.ID__ESPECIE==especieID)
		{
		  $('#AselCodigos').append("<option value='"+etiqueta.ID__ETIQUETA+"'>"+etiqueta.VCH_QR+"</option>");
		}
	});
}

//iniciar el mapa en las coordenadas predefinidas como centro
function initMapSeguimiento() {
	mapSeguimiento = new google.maps.Map(document.getElementById('mapSeguimiento'), {
		zoom: 12,
		center: posicionInicial
	});
}
function initMapSeguimientoA() {
	mapSeguimiento = new google.maps.Map(document.getElementById('mapSeguimientoA'), {
		zoom: 12,
		center: posicionInicial
	});
}

//Se agrega un marcador nuevo en el mapa en la posición predefinida con título acorde al código proporcionado 
function agregarMarcador(codigo)
{
	marcadoresSeguimiento.push(
		new google.maps.Marker({
			position: posicionInicial,
			map: mapSeguimiento,
			draggable:true,
			title: codigo
		})
		);
}

//El marcador con el código proporcionado es borrado del mapa y del array de marcadores
function quitarMarcador(codigo)
{
	var indice
	$.each(marcadoresSeguimiento,function(index,marcador)
	{
		console.log(marcador.title);
		if(marcador.title==codigo)
		{
			marcadoresSeguimiento[index].setMap(null);
			indice=index;
			return false;
		}

	});
	marcadoresSeguimiento.splice(indice,1);
}

//Construye el objeto JSON que se enviara al controlador para guardar los datos del formulario
function construirJson()
{	
	var cadenaJson={	ID__EVENTO:0,	                guardabosque:{},	                adopciones:[]	               };	               

	cadenaJson["guardabosque"]=		{
										VCH_NOMBRE:$('#txtNombre').val(),
										VCH_APELLIDOPATERNO:$('#txtApellidoPaterno').val(),
										VCH_APELLIDOMATERNO:$('#txtApellidoMaterno').val(),
										VCH_TELEFONO:$('#txtTelefono').val(),
										VCH_CELULAR:$('#txtCelular').val(),
										ID__COLONIA:$('#selColonia').val(),
										VCH_CALLE:$('#txtCalle').val(),
										VCH_ENTRECALLE:$('#txtReferencia').val(),
										VCH_CORREO:$('#txtCorreo').val()
									};
									
	for(i=0; i<=arregloArbolesAdoptar.length-1;i++)
	{
		cadenaJson['adopciones'][i]=
		{
			edad:arregloArbolesAdoptar[i].edad,
			especie:arregloArbolesAdoptar[i].especie,
			gratis:arregloArbolesAdoptar[i].gratis,
			qr:arregloArbolesAdoptar[i].qr,
			zona:arregloArbolesAdoptar[i].zona,			
       		VCH_LATITUD:marcadoresSeguimiento[i].position.lat(),
       		VCH_LONGITUD:marcadoresSeguimiento[i].position.lng()
       };
	}																			      
	return cadenaJson;
}
//Construye el objeto JSON que se enviara al controlador para guardar los datos del formulario
function construirJsonAdopcion()
{	
	var cadenaJson={
		            ID__EVENTO:ID__EVENTO,
	                etiquetas:[],
	                adopciones:[]
	               };	
	$.each($('#AselCodigosAgregados > option'),function(index,option)
	{
       cadenaJson['etiquetas'][index]=
       {
       	ID__ETIQUETA:option.value,
       	VCH_QR:option.text,
       	ID__ESPECIE:$('#AselEspecie').val(),
       	especie:$('#AselEspecie > option:selected').text(),
       	ID__EMPRESA:ID__EMPRESA,
       	empresa:empresa,
       	usada:0
       };

       cadenaJson['adopciones'][index]=
       {
       	arbol:
       	{
       		ID__ESPECIE:$('#AselEspecie').val(),
       		NUM_EDAD:0,
       		VCH_CODIGOQR:option.text,
       		VCH_CODIGOQRFINAL:option.text,
       		NUM_CANTIDAD:1,
       		VCH_LATITUD:marcadoresSeguimiento[index].position.lat(),
       		VCH_LONGITUD:marcadoresSeguimiento[index].position.lng()
       	},
       	guardabosque:
       	{
       		VCH_NOMBRE:$('#AtxtNombre').val(),
       		VCH_APELLIDOPATERNO:$('#AtxtApellidoPaterno').val(),
       		VCH_APELLIDOMATERNO:$('#AtxtApellidoMaterno').val(),
       		VCH_TELEFONO:$('#AtxtTelefono').val(),
       		VCH_CELULAR:$('#AtxtCelular').val(),
       		ID__COLONIA:$('#AselColonia').val(),
       		VCH_CALLE:$('#AtxtCalle').val(),
       		VCH_ENTRECALLE:$('#AtxtReferencia').val(),
       		VCH_CORREO:$('#AtxtCorreo').val()
       	}
       };
	});

	return cadenaJson;
}

//Valida que todos los campos hayan sido llenados
function validarFormulario()
{
	if(
		$('#selEspecie').val() < 0 ||
		//$('#selCodigosAgregados > option').length < 1 ||
		$('#txtNombre').val().length === 0 ||
		$('#txtApellidoPaterno').val().length === 0 ||
		$('#txtApellidoMaterno').val().length === 0 ||
		$('#txtTelefono').val().length === 0 ||
		$('#txtCelular').val().length === 0 ||
		$('#txtCorreo').val().length === 0 ||
		$('#selEstado').val() < 0 ||
		$('#selMunicipio').val() < 0 ||
		$('#selColonia').val() < 0 ||
		$('#txtCalle').val().length ===  0 //||		$('#txtReferencia').val().length === 0
		)
		return false;
	else
		return true;
}
function validarFormularioAdopcion()
{
	if(
		$('#AselEspecie').val() < 0 ||
		$('#AselCodigosAgregados > option').length < 1 ||
		$('#AtxtNombre').val().length === 0 ||
		$('#AtxtApellidoPaterno').val().length === 0 ||
		$('#AtxtApellidoMaterno').val().length === 0 ||
		$('#AtxtTelefono').val().length === 0 ||
		$('#AtxtCelular').val().length === 0 ||
		$('#AtxtCorreo').val().length === 0 ||
		$('#AselEstado').val() < 0 ||
		$('#AselMunicipio').val() < 0 ||
		$('#AselColonia').val() < 0 ||
		$('#AtxtCalle').val().length === 0 // ||		$('#AtxtReferencia').val().length === 0
		)
		return false;
	else
		return true;	
}

function limpiarFormulario()
{
	$('#selEspecie').val(-1);
	$('#selCantidad').html("<option value='-1'></option>");
	$('#selCodigos').html('');
	$('#selCodigosAgregados').html('');

    var texto='QR disponible(s):';

	$('#lblDisponibles').text(texto);
    texto='QR agregado(s):';
    $('#lblAgregados').text(texto);

	$.each(marcadoresSeguimiento,function(index,marcador)
	{
		marcador.setMap(null);			
	});
	marcadoresSeguimiento=[];
	mapSeguimiento.setCenter(posicionInicial);
    mapSeguimiento.setZoom(12);

	$('#txtNombre').val('');
	$('#txtApellidoPaterno').val('');
	$('#txtApellidoMaterno').val('');
	$('#txtTelefono').val('');
	$('#txtCelular').val('');
	$('#txtCorreo').val('');
	$('#txtCalle').val('');
	$('#txtReferencia').val('');
	$('#selEstado').val('-1');
	$('#selMunicipio').html("<option value='-1'></option>");
	$('#selColonia').html("<option value='-1'></option>");
    
    $("html, body").animate({ scrollTop: "0px"});
}

//Se pobla el select de cantidad, dependiendo de la especie que se seleccione
$('#selEspecie').change(function()
{
	cargarEtiquetas($("#selEspecie").val());
	//$('#selCantidad').html("<option value='-1'>---</option>");
	if($(this).val()>0)
	{
	   for(i=1;i<=cantidadEspecie[$(this).val()];i++)
       {
		 if(i>15){break;}
		 $('#selCantidad').append("<option value='"+i+"'>"+i+"</option>");
	   }
	}
	
});
$('#AselEspecie').change(function()
{
//	$('#selCantidad').html("<option value='-1'>---</option>");
/*	if($(this).val()>0)
	{
	   for(i=1;i<=cantidadEspecie[$(this).val()];i++)
       {		  
		 if(i>15){break;}
		 $('#AselCantidad').append("<option value='"+i+"'>"+i+"</option>");
	   }
	}
*/
//console.log("1");
	AgetCodigosEspecie($(this).val());
	AactualizaLabelsCodigos();
});

$('#selCantidad').focus(function()
{
	cantidadActual=$(this).val();
});

/*
$('#selCantidad').change(function()
{
	if($(this).val()>$('#selCodigos > option').length)
	{
		bootbox.alert('No puede asignar una cantidad de códigos mayor a la de códigos disponibles');
		$(this).val(cantidadActual);
	}
		
	else
	{
	  if(($(this).val() < $('#selCodigosAgregados > option').length)) //&& ($('#selCodigosAgregados > option').length > 0))
      {
	   bootbox.alert('No puede asignar una cantidad menor a los códigos ya agregados');
	   $(this).val(cantidadActual);
      }
      else
     	cantidadActual=$(this).val();
    }
});

//Al presionar enter con el select de códigos disponibles en focus, se agrega el o los códigos seleccionados
$('#selCodigos').keypress(function(e)
{
   if(e.charCode==13)
   	  $('#btnAgregarCodigo').trigger('click');
});*/

//Agregar código(s) a seleccionados
$('#btnAgregarCodigo').click(function()
{
	/*
	if($('#selCantidad').val()>0)
	{*/
		var seleccionados=0;
		$.each($('#selCodigos > option'),function(index,codigo)
		{
			if(codigo.selected)
				seleccionados++;
		});
/*
		if((seleccionados+$('#selCodigosAgregados > option').length) <= $('#selCantidad').val())
		{
			if($('#selCantidad').val() > $('#selCodigosAgregados > option').length )
			{*/
				$.each($('#selCodigos > option'),function(index,codigo)
				{
					if(codigo.selected)
					{
						$('#selCodigosAgregados').append(codigo);
						agregarMarcador(codigo.text);
					}
						
				});
				actualizaLabelsCodigos();
			/*}
			else
				bootbox.alert('Ya fueron agregados todos los códigos necesarios');
		}
		else
			bootbox.alert('La cantidad de códigos que pretende agregar excede el límite establecido');
		
	}
	else
		bootbox.alert('Debe indicar una cantidad fija antes de agregar códigos.');*/
});
$('#AbtnAgregarCodigo').click(function()
{
		var seleccionados=0;
		$.each($('#AselCodigos > option'),function(index,codigo)
		{
			if(codigo.selected)
				seleccionados++;
		});

				$.each($('#AselCodigos > option'),function(index,codigo)
				{
					if(codigo.selected)
					{
						$('#AselCodigosAgregados').append(codigo);
						agregarMarcador(codigo.text);
					}
						
				});
				AactualizaLabelsCodigos();			
});

//Regresar código seleccionado a disponible(s)
$('#btnQuitarCodigo').click(function()
{
	if($('#selCodigosAgregados > option').length > 0)
	{
		bootbox.confirm({
			message:'¿Esta seguro que desea regresar el código '+$('option:selected',$('#selCodigosAgregados')).text()+' a los disponibles?.',
			confirm:{label:"Aceptar"},
			cancel:{label:"Cancelar"},
			callback:function(resultado){
				if(resultado)
				{
					quitarMarcador($('#selCodigosAgregados > option:selected').text());
					$('#selCodigos').append($('option:selected',$('#selCodigosAgregados')));
					actualizaLabelsCodigos();
				}
			}
		});
	}
	else
		bootbox.alert('No hay ningún código para eliminar.');
});





$( document ).ready(function() 
{


	//Poblar el select municipio tras seleccionar estado
	$('#selEstado').change(function(){

		$('#selMunicipio').html('<option value=-1>---</option>');
		$('#selColonia').html('<option value=-1>---</option>');

		$.ajax({
			  url: "../General/getCiudades",
			  type: 'POST',
			  data:{					
					ID__ESTADO: $(this).val()					
				  },
			  success:function(ciudades)
			  {
				$.each(JSON.parse(ciudades),function(index,ciudad)
				{
					$('#selMunicipio').append("<option value='"+ciudad.ID__MUNICIPIO+"'>"+ciudad.VCH_NOMBRE+"</option>");
				});
				
			  },
			  error:function(e1,e2,e3)
			  {
				console.log(e1);
				console.log(e2);
				console.log(e3);
			  }						  
		});		
	});
	$('#AselEstado').change(function(){

		$('#AselMunicipio').html('<option value=-1>---</option>');
		$('#AselColonia').html('<option value=-1>---</option>');

		$.ajax({
			  url: "../General/getCiudades",
			  type: 'POST',
			  data:{					
					ID__ESTADO: $(this).val()					
				  },
			  success:function(ciudades)
			  {
				$.each(JSON.parse(ciudades),function(index,ciudad)
				{
					$('#AselMunicipio').append("<option value='"+ciudad.ID__MUNICIPIO+"'>"+ciudad.VCH_NOMBRE+"</option>");
				});
				
			  },
			  error:function(e1,e2,e3)
			  {
				console.log(e1);
				console.log(e2);
				console.log(e3);
			  }						  
		});		
	});


	//Poblar el select colonia tras seleccionar municipio
	$('#selMunicipio').change(function(){

		$('#selColonia').html("<option value=-1>---</option>");

		$.ajax({
			  url: "../General/getColonias",
			  type: 'POST',
			  data:{					
					ID__MUNICIPIO: $(this).val()					
				  },
			  success:function(colonias)
			  {
				$.each(JSON.parse(colonias),function(index,colonia)
				{
					$('#selColonia').append("<option value='"+colonia.ID__COLONIA+"'>"+colonia.VCH_CODIGOPOSTAL+" - "+colonia.colonia+"</option>");
				});
				
			  },
			  error:function(e1,e2,e3)
			  {
				console.log(e1);
				console.log(e2);
				console.log(e3);
			  }						  
			});
	});
	$('#AselMunicipio').change(function(){

		$('#AselColonia').html("<option value=-1>---</option>");

		$.ajax({
			  url: "../General/getColonias",
			  type: 'POST',
			  data:{					
					ID__MUNICIPIO: $(this).val()					
				  },
			  success:function(colonias)
			  {
				$.each(JSON.parse(colonias),function(index,colonia)
				{
					$('#AselColonia').append("<option value='"+colonia.ID__COLONIA+"'>"+colonia.colonia+"</option>");
				});
				
			  },
			  error:function(e1,e2,e3)
			  {
				console.log(e1);
				console.log(e2);
				console.log(e3);
			  }						  
			});
	});
});

//Guardar la información enviando los datos del formulario a BD 
$('#btnGuardarSeguimiento').click(function()
{
	$( "#btnGuardarSeguimiento" ).prop( "disabled", true );
	if(validarFormulario())
	{
		$.ajax({

			url:'AdopcionCiudadana',
			data:{ 
				json:JSON.stringify(construirJson())
			},
			type:'POST',
			success:function(respuesta)
			{
				respuesta=JSON.parse(respuesta);
				
				
				console.log(respuesta);
				bootbox.alert("Registro guardado exitosamente.");
				
				var cadenajson=construirJson();
				cadenajson["ID__GUARDABOSQUE"]=respuesta.ID__GUARDABOSQUE;
				cadenajson=JSON.stringify(cadenajson);																				
				$("#JSONSALIDA").val(cadenajson);				
				$("#frmSeguimiento").submit();
								
				$("#btnReimprimir").show();
				$("#btnReimprimir").click(function () 
									{
										//window.open("./extra//adopcionviveropdfs/"+respuesta);
										$("#frmSeguimiento").submit();
									});
				//limpiarFormulario();				
			},
			error:function(e1,e2,e3){
				console.log(e1);
				console.log(e2);
				console.log(e3);
			}
		}).always(function(val) 
	{
			$( "#btnGuardarSeguimiento" ).prop( "disabled", false );	
			console.log(val);			
	});		
	}
	else
	{
		$( "#btnGuardarSeguimiento" ).prop( "disabled", false );	
		bootbox.alert('Aún hay datos necesarios faltantes');
	}
});


$('#AbtnGuardarSeguimiento').click(function()
{
	if(validarFormularioAdopcion())
	{
		$.ajax({

			url:'finalizarEvento',
			data:{ 
				json:JSON.stringify(construirJsonAdopcion())
			},
			type:'POST',
			success:function(respuesta)
			{
				bootbox.alert("Registro guardado exitosamente.");
				var json=JSON.stringify(construirJsonAdopcion());
				$("#AJSONSALIDA").val(json);
				$("#frmAdopcionDeEvento").submit();
				//limpiarFormulario();				
			},
			error:function(e1,e2,e3){
				console.log(e1);
				console.log(e2);
				console.log(e3);
			}
		}).always(function(val) 
	{	
			console.log(val);			
	});		;
	}
	else
	{
		$( "#btnGuardarSeguimiento" ).prop( "disabled", false );	
		bootbox.alert('Aún hay datos necesarios faltantes');
	}
});

$('#btnRegresarSeguimiento').click(function()
{
	$("html, body").animate({ scrollTop: "0px"});
	$('#catalogoGuardaBosques').show();	
	$('#seguimiento').hide();
	
});
$('#AbtnRegresarSeguimiento').click(function()
{
	$("html, body").animate({ scrollTop: "0px"});
	$('#catalogoGuardaBosques').show();	
	$('#AdopcionDeEvento').hide();
	
});

function finalizaevento()
{
	$("#idevent").val(ID__EVENTO);
	$("#formFinalizar").submit();
}

/*
 $( "#datepicker" ).datepicker();
  $( "#datepicker" ).datepicker();
FFEC_FECHAINICIO
FEC_FECHAINICIO
FFEC_FECHAFIN
FEC_FECHAFIN
*/

$("#scaneo").on('keyup', function (e) 
{
    if (e.keyCode == 13) 
    {
		var escaneo=$("#scaneo").val();
					$("#scaneo").val("");					
			if(escaneo.split("-").length==3)			
			{
				escaneo=escaneo.split("-");
			}
			else
			{
				if(escaneo.split("/").length==3)			
				{
					escaneo=escaneo.split("/");
				}
				else
				{
					bootbox.alert('La etiqueta escaneada no parece tener el formato correcto. </br>Intenta con otra.');
					return;
				}
			}			
			$("#selEspecie").val(parseInt(escaneo[1]));
			
if(ultimocargado!=$("#selEspecie").val())
{
			cargarEtiquetas($("#selEspecie").val());
}
			//getCodigosEspecie($("#selEspecie").val());			
			CargaZonas($("#selEspecie").val());

			agregarMarcador(escaneo[0]+"-"+escaneo[1]+"-"+escaneo[2]);
			$('#selCodigos').val($('#selCodigos option:contains('+escaneo[0]+"-"+escaneo[1]+"-"+escaneo[2]+')').val())
			
			//$('#selCodigosAgregados').append($("#selCodigos").find("option:contains('"+escaneo[0]+"-"+escaneo[1]+"-"+escaneo[2]+"')"));			
			//actualizaLabelsCodigos();
			
			
    }
});

$("#Ascaneo").on('keyup', function (e) 
{
    if (e.keyCode == 13) 
    {
		var escaneo=$("#Ascaneo").val();
					$("#Ascaneo").val("");					
			if(escaneo.split("-").length==3)			
			{
				escaneo=escaneo.split("-");
			}
			else
			{
				if(escaneo.split("/").length==3)			
				{
					escaneo=escaneo.split("/");
				}
				else
				{
					bootbox.alert('La etiqueta escaneada no parece tener el formato correcto. </br>Intenta con otra.');
					return;
				}
			}
			$("#AselEspecie").val(escaneo[1]);
			
			AgetCodigosEspecie($("#AselEspecie").val());
			
			agregarMarcador(escaneo[0]+"-"+escaneo[1]+"-"+escaneo[2]);
			$('#AselCodigosAgregados').append($("#AselCodigos").find("option:contains('"+escaneo[0]+"-"+escaneo[1]+"-"+escaneo[2]+"')"));
			AactualizaLabelsCodigos()
			
    }
});



function Imprimir(ID__EVENTO)
{
	window.open("Imprimir?id="+ID__EVENTO);
	
}


function GeneraArchivo(ID__EVENTO)
{
	parent.window.open("generaArchivo/?id="+ID__EVENTO);
}

function addRowT(idTabla,row,refresh)
{
	if(refresh)
	{
		$('#'+idTabla).bootstrapTable('destroy');
	}

	$('#'+idTabla).append(row);
	
	if(refresh)
	{
		$('#'+idTabla).bootstrapTable();			
	}
}


var arregloArbolesAdoptar=[];
var contadorArboles=0;
$('#btnAgregarArbolAtabla').click(function()
{	
	$( "#btnAgregarArbolAtabla" ).prop( "disabled", true );
	if((  $("#selEspecie").val()!=-1 )&&(  $("#selZona").val()!=-1 ) && ( $("#selEdad").val()!=-1 ))
	{					
		if(($("#selCantidadAr").val()!=1)&&($("#selCodigos").val()!=-1))
		{
			bootbox.alert("Seleccionaste una etiqueta para muchos arboles,  <br/>Cambia el QR a 'no lleva' o la cantidad a 1 ");		
			$( "#btnAgregarArbolAtabla" ).prop( "disabled", false );
			return;
		}	
			
		$.ajax({

			url:'traerPrecioEdadEspecie',
			data:{ 
				selEspecie:$("#selEspecie").val(),
				selZona:$("#selZona").val(),
				selEdad:$("#selEdad").val()
			},
			type:'POST',
			success:function(respuesta)
			{
				cuantos=$("#selCantidadAr").val();				
				for(var i=1;i<=cuantos;i++)
				{
					addRowT("tablaAdoptar",'<tr id="row'+contadorArboles+'"><td align="center">'+$("#selEspecie option:selected").text()+'</td><td align="center">'+$("#selCodigos option:selected").text()+'</td><td align="center">'+$("#selZona option:selected").text()+'</td><td align="center">'+$("#selEdad option:selected").text()+'</td><td align="center">$'+respuesta+'</td><td align="center"><input type="checkbox" class="bigcheck" onclick="checkGratis('+contadorArboles+')" id="checkbox'+contadorArboles+'"/></td><td><button class="btn btn-primary" onclick="cancelar('+contadorArboles+')" type="button">Borrar</button></td></tr>', true);						
					var arbol={
								indice:contadorArboles,
								especie:$("#selEspecie").val(),
								qr:$("#selCodigos option:selected").text(),
								zona:$("#selZona").val(),
								edad:$("#selEdad").val(),
								gratis:0,
								precio:respuesta
								};
					arregloArbolesAdoptar.push(arbol);
					contadorArboles++;				
					agregarMarcador($("#selCodigos option:selected").text()+" - "+$("#selEspecie option:selected").text());		
				}										
				recalcularPrecio();	
				
			},
			error:function(e1,e2,e3){
			}
		}).always(function(val) 
		{	
				console.log(val);	
				$( "#btnAgregarArbolAtabla" ).prop( "disabled", false );		
		});													
	}
	else
	{
		bootbox.alert("Favor de seleccionar los datos obligatorios");		
		$( "#btnAgregarArbolAtabla" ).prop( "disabled", false );
	}				
});

function cancelar(cual)
{
//	arregloArbolesAdoptar.splice(cual-1, 1);		
	for (var i = arregloArbolesAdoptar.length - 1; i >= 0; --i) 
	{
		if (arregloArbolesAdoptar[i].indice == cual) 
		{
			arregloArbolesAdoptar.splice(i,1);
		}
	}					
	$('#tablaAdoptar').bootstrapTable('destroy');		
		$('#row'+cual).remove();
	$('#tablaAdoptar').bootstrapTable();					
	recalcularPrecio();			
}

function checkGratis(cual)
{
	for(i=0; i<=arregloArbolesAdoptar.length-1;i++)
	{
		if(arregloArbolesAdoptar[i].indice==cual)
		{
			if($('#checkbox'+cual).is(':checked'))
			{
				arregloArbolesAdoptar[i].gratis=1;
			}
			else
			{
				arregloArbolesAdoptar[i].gratis=0;
			}
		}		
	}
	recalcularPrecio();
}



function CargaZonas(valor)
{
	if(valor!=-1)
	{
	$.ajax({
			  url: "UbicacionesConEspecie",
			  type: 'POST',
			  data:{					
					ID__ESPECIE:valor			
				  }						  
			}).done(function(val) 
			{													
				var ubicaciones=JSON.parse(val);						
				$('#selZona').empty();				
				$('#selZona').append($('<option>',
					 {
						value: -1,
						text : "Seleccione"
					}));	
				for (i=0; i<ubicaciones.length;i++)
				{
					$('#selZona').append($('<option>',
					 {
						value: ubicaciones[i].ID__UBICACION,
						text : ubicaciones[i].VCH_NOMBRE
					}));	
				}
			})
	}
	else
	{
		$('#selZona').empty();				
		$('#selZona').append($('<option>',
			 {
				value: -1,
				text : "Seleccione"
			}));
	}
}
function CargaEdades(valor)
{	
	if(valor!=-1)
	{
		$.ajax({
			  url: "EdadesdeEspecieEnZonaAdopCiudadana",
			  type: 'POST',
			  data:{					
					ID__ESPECIE:$("#selEspecie").val(),
					ID__UBICACION:$("#selZona").val(),
					ID__EVENTO:parent.ID__EVENTO								
				  }						  
			}).done(function(val) 
			{	
				console.log(val);												
				var edades=JSON.parse(val);										
				$('#selEdad').empty();				
				$('#selEdad').append($('<option>',
					 {
						value: -1,
						text : "Seleccione"
					}));	
				for (i=0; i<edades.length;i++)
				{
					$('#selEdad').append($('<option>',
					 {
						value: edades[i].edad,
						text : edades[i].edad
					}));	
				}
			})
	}
	else
	{
		$('#selEdad').empty();				
		$('#selEdad').append($('<option>',
			 {
				value: -1,
				text : "Seleccione"
			}));
	}
}
function recalcularPrecio()
{	
	var precio=0;
	for(i=0; i<=arregloArbolesAdoptar.length-1;i++)
	{
		if(arregloArbolesAdoptar[i].gratis=="0")
		{
			precio=precio+parseFloat(arregloArbolesAdoptar[i].precio);
		}		
	}
	precio="$"+precio.toFixed(2)+"M.N";
	$("#costo").html(precio);
}



/*! Loading Overlay - v1.0.2 - 2014-02-19
* http://jgerigmeyer.github.io/jquery-loading-overlay/
* Copyright (c) 2014 Jonny Gerig Meyer; Licensed MIT */
!function(a){"use strict";var b={init:function(b){var c=a.extend({},a.fn.loadingOverlay.defaults,b),d=a(this).addClass(c.loadingClass),e='<div class="'+c.overlayClass+'"><p class="'+c.spinnerClass+'"><span class="'+c.iconClass+'"></span><span class="'+c.textClass+'">'+c.loadingText+"</span></p></div>";return d.data("loading-overlay")||d.prepend(a(e)).data("loading-overlay",!0),d},remove:function(b){var c=a.extend({},a.fn.loadingOverlay.defaults,b),d=a(this).data("loading-overlay",!1);return d.find("."+c.overlayClass).detach(),d.hasClass(c.loadingClass)?d.removeClass(c.loadingClass):d.find("."+c.loadingClass).removeClass(c.loadingClass),d},exposeMethods:function(){return b}};a.fn.loadingOverlay=function(c){return b[c]?b[c].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof c&&c?void a.error("Method "+c+" does not exist on jQuery.loadingOverlay"):b.init.apply(this,arguments)},a.fn.loadingOverlay.defaults={loadingClass:"loading",overlayClass:"loading-overlay",spinnerClass:"loading-spinner",iconClass:"loading-icon",textClass:"loading-text",loadingText:"loading"}}(jQuery);