function addVehiculo()
{
	if($("#vehiculoSelect").val()!=null)
	{
	$.ajax({
			  url: "../AsignarRecursoEventoVehiculo",
			  type: 'POST',
			  data:{					
					ID__EVENTO:parent.ID__EVENTO,		
					ID__VEHICULO: $("#vehiculoSelect").val(),
				  }						  
			}).always(function(val) 
			{													
//				console.log(val);
				document.location.reload();
			})
	}
}
function addPrestador()
{
	if($("#prestadorSelect").val()!=null)
	{
	$.ajax({
			  url: "../AsignarRecursoEventoPrestador",
			  type: 'POST',
			  data:{					
					ID__EVENTO:parent.ID__EVENTO,		
					ID__USUARIO: $("#prestadorSelect").val(),
				  }						  
			}).always(function(val) 
			{					
//				console.log(val);								
				document.location.reload();
			})
	}
}
function addSuministro()
{
	if(($("#HerSelect").val()!=null)&&($("#canther").val()!=""))
	{		
		$.ajax({
				  url: "../AsignarRecursoEventoSuministro",
				  type: 'POST',
				  data:{					
						ID__EVENTO:parent.ID__EVENTO,		
						HerSelect: $("#HerSelect").val(),
						canther: $("#canther").val(),
						descher: $("#descher").val()
					  }						  
				}).always(function(val) 
				{					
					//alert(val);
					console.log(val);								
//					document.location.reload();
				})
	}
	else
	{
		parent.alerta("Especifica la cantidad a llevar");
	}
}
function addUser()
{
	if($("#personalSelect").val()!=null)
	{
	$.ajax({
			  url: "../AsignarRecursoEventoPersonal",
			  type: 'POST',
			  data:{					
					ID__EVENTO:parent.ID__EVENTO,		
					ID__USUARIO: $("#personalSelect").val(),
				  }						  
			}).always(function(val) 
			{							
//				console.log(val);						
				document.location.reload();
			})
	}
}

function eliminarPrestador(cual)
{
	$.ajax({
			  url: "../EliminarRecursoEventoPrestador",
			  type: 'POST',
			  data:{					
					ID__EVENTO:parent.ID__EVENTO,		
					ID__USUARIO: cual,
				  }						  
			}).always(function(val) 
			{					
				console.log(val);								
				document.location.reload();
			})
}
function eliminarVehiculo(cual)
{
	$.ajax({
			  url: "../EliminarRecursoEventoVehiculo",
			  type: 'POST',
			  data:{					
					ID__EVENTO:parent.ID__EVENTO,		
					ID__USUARIO: cual,
				  }						  
			}).always(function(val) 
			{					
				console.log(val);								
				document.location.reload();
			})
}
function eliminarPersona(cual)
{
	$.ajax({
			  url: "../EliminarRecursoEventoPersonal",
			  type: 'POST',
			  data:{					
					ID__EVENTO:parent.ID__EVENTO,		
					ID__USUARIO: cual,
				  }						  
			}).always(function(val) 
			{					
				console.log(val);								
				document.location.reload();
			})
}
function eliminarHer(cual)
{
	$.ajax({
			  url: "../EliminarRecursoEventoHer",
			  type: 'POST',
			  data:{					
					ID__EVENTO:parent.ID__EVENTO,		
					ID_SUMHER: cual,
				  }						  
			}).always(function(val) 
			{					
				console.log(val);								
				document.location.reload();
			})
}

//* Base*/
/*$('#FFEC_FECHAFINcal').datetimepicker();

function CargaZonas(valor)
{
	if(valor!=-1)
	{
	$.ajax({
			  url: "../UbicacionesConEspecie",
			  type: 'POST',
			  data:{					
					ID__ESPECIE:valor			
				  }						  
			}).done(function(val) 
			{													
				var ubicaciones=JSON.parse(val);						
//				console.log(val);
//				return;
				$('#ID__UBICACION').empty();				
				$('#ID__UBICACION').append($('<option>',
					 {
						value: -1,
						text : "Seleccione"
					}));	
				for (i=0; i<ubicaciones.length;i++)
				{
					$('#ID__UBICACION').append($('<option>',
					 {
						value: ubicaciones[i].ID__UBICACION,
						text : ubicaciones[i].VCH_NOMBRE
					}));	
				}
			})
	}
	else
	{
		$('#ID__UBICACION').empty();				
		$('#ID__UBICACION').append($('<option>',
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
			  url: "../EdadesdeEspecieEnZona",
			  type: 'POST',
			  data:{					
					ID__ESPECIE:$("#ID__ESPECIE").val(),
					ID__UBICACION:$("#ID__UBICACION").val(),
								
				  }						  
			}).done(function(val) 
			{													
				var edades=JSON.parse(val);						
				console.log(val);
//				return;
				$('#edad').empty();				
				$('#edad').append($('<option>',
					 {
						value: -1,
						text : "Seleccione"
					}));	
				for (i=0; i<edades.length;i++)
				{
					$('#edad').append($('<option>',
					 {
						value: edades[i].edad,
						text : edades[i].edad
					}));	
				}
			})
	}
	else
	{
		$('#edad').empty();				
		$('#edad').append($('<option>',
			 {
				value: -1,
				text : "Seleccione"
			}));
	}
}
function cargaRecipientesConEdadEnZonaEspecie(valor)
{
	if(valor!=-1)
	{
		$.ajax({
			  url: "../BusquedaRecipientesConEdadEnZonaEspecie",
			  type: 'POST',
			  data:{					
					ID__ESPECIE:$("#ID__ESPECIE").val(),
					ID__UBICACION:$("#ID__UBICACION").val(),
					edad:$("#edad").val(),								
				  }						  
			}).done(function(val) 
			{							
//				console.log(val);				return;						
				var recipientes=JSON.parse(val);						
//				console.log(val);
//				return;
				$('#contenedor_id').empty();				
				$('#contenedor_id').append($('<option>',
					 {
						value: -1,
						text : "Seleccione"
					}));	
				for (i=0; i<recipientes.length;i++)
				{
					$('#contenedor_id').append($('<option>',
					 {
						value: recipientes[i].contenedor_id,
						text : recipientes[i].contenedor_nombre
					}));	
				}
			})
	}
	else
	{
		$('#contenedor_id').empty();				
		$('#contenedor_id').append($('<option>',
			 {
				value: -1,
				text : "Seleccione"
			}));
	}
}
function getDisponibles(valor)
{
	if(valor!=-1)
	{
		$.ajax({
			  url: "../BusquedaInventarioDisponiblesConFiltro",
			  type: 'POST',
			  data:{					
					ID__ESPECIE:$("#ID__ESPECIE").val(),
					ID__UBICACION:$("#ID__UBICACION").val(),
					edad:$("#edad").val(),						
					contenedor_id:		$("#contenedor_id").val(),
				  }						  
			}).done(function(val) 
			{													
				console.log(val);
				var recipientes=JSON.parse(val);
				console.log(val);
				document.getElementById("totaldisponiblesiframe").innerHTML="<b>"+recipientes[0].NUM_CANTIDAD+"</b>";
				inventarioActual=recipientes[0].NUM_CANTIDAD; // cuantos tenemos realmente
				$("#cantidadAsignar").prop('max',recipientes[0].NUM_CANTIDAD);				
//				console.log(val);
//				return;
			})
	}
	else
	{
	}
}



















var inventarioActual=0;
function guardar()
{
	var valido=true;
//	$("#ID__USUARIO").val()!=
	if($("#FFEC_FECHAFIN").val()=="")
	{
		valido=false;
	}
	if($("#ID__ESPECIE").val()=="-1")
	{
		valido=false;
	}
	if($("#ID__UBICACION").val()=="-1")
	{
		valido=false;
	}
	if($("#edad").val()=="")
	{
		valido=false;
	}
	if($("#contenedor_id").val()=="-1")
	{
		valido=false;
	}
	if($("#cantidadAsignar").val()=="")
	{
		valido=false;
	}
	else
	{
		if(parseInt($("#cantidadAsignar").val())>maximosrequeridos)
		{
			parent.alerta("La cantidad introducida es mayor a la cantidad de requeridos")
			valido=false;
			return;
		}
		if(parseInt($("#cantidadAsignar").val())>inventarioActual)
		{
			parent.alerta("La cantidad introducida es mayor a la cantidad del inventario")
			valido=false;
			return;
		}
	}
	
	
	var urlMetodo="../AsignaArboladoEvento";	
	if(valido==false)
	{
		parent.alerta("Favor de llenar los datos obligatorios");
		return;
	}
		
	$.ajax({
	  url: urlMetodo,
	  type: 'POST',
	  data:{		  
  		    ID__EVENTO:parent.ID__EVENTO,
		  	ID__USUARIO:$('#ID__USUARIO').val(),
			FFEC_FECHAFIN:$('#FFEC_FECHAFIN').val(),
			ID__ESPECIE:$('#ID__ESPECIE').val(),
			ID__UBICACION:$('#ID__UBICACION').val(),
			edad:$('#edad').val(),
			contenedor_id:$('#contenedor_id').val(),
			cantidadAsignar:$('#cantidadAsignar').val()
			}						  
	}).always(function(val) 
	{	
//		console.log(val);
			parent.alerta(val);
			setTimeout(function(){ parent.location.reload();				}, 3000);
			
			/*
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});
	});			
}

function Imprimir()
{
	window.open("../Imprimir?id="+parent.ID__EVENTO);
	
}*/
