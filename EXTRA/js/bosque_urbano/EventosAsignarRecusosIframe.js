//* Base*/


if(!$('#FFEC_FECHAFINcal').data('datepicker'))
{
	var dateNow = new Date();
	dateNow.setHours(8);
	dateNow.setMinutes(0);
	$('#FFEC_FECHAFINcal').datetimepicker({
		defaultDate:dateNow
	});
}   
/*
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
					
				
				if(ubicaciones.length==0)
				{
					parent.alerta("No se encontro la especie en zonas de <b>Adopción, Reforestación, Adopción Especial</b>");
					return;
				}
					
					
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
					ID__EVENTO:parent.ID__EVENTO								
				  }						  
			}).done(function(val) 
			{	
				console.log(val);												
				var edades=JSON.parse(val);										
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
}*/
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
var peticion;
function guardar()
{
	var valido=true;
//	$("#ID__USUARIO").val()!=
	if($("#FFEC_FECHAFIN").val()=="")
	{
		valido=false;
	}
	if($("#NUM_CANTIDAD").val()=="")
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
	
	var indice=0;	
	var obj={};
	var arregloO=[];
	while($("#form"+indice).length==1)
	{					
  		 obj={};
  		 if($('#NUM_CANTIDAD'+indice).val()!="")  		 
  		 {
			 obj.ID__EVENTO=parent.ID__EVENTO;
			 obj.ID__USUARIO=$('#ID__USUARIO').val();
			 obj.FFEC_FECHAFIN=$('#FFEC_FECHAFIN').val();
			 obj.ID__ESPECIE=$('#ID__ESPECIE'+indice).val();
			 obj.ID__UBICACION=$('#ID__UBICACION'+indice).val();
			 obj.edad=$('#NUM_EDADMESES'+indice).val();
			 obj.contenedor_id=$('#contenedor_id'+indice).val();
			 obj.cantidadAsignar=$('#NUM_CANTIDAD'+indice).val();
			 arregloO.push(obj);
		  }
		indice++;			
	}	
	//console.log(arregloO);
	//return;
	

	$.ajax({
	  url: urlMetodo,
	  type: 'POST',
	  data:{		  
				paquete:JSON.stringify(arregloO)
			}						  
	}).always(function(val) 
	{	
			parent.alerta(val);
			setTimeout(function(){ location.reload();				}, 3000);
	});			
}

function Imprimir()
{
	window.open("../Imprimir?id="+parent.ID__EVENTO);	
}

function CargaStockEtiqueta(valor)
{		
	if(valor!=-1)
	{			
		$.ajax({
			  url: "../BusquedaInventarioEtiquetasDisponiblesConFiltro",
			  type: 'POST',
			  data:{					
					ID__ESPECIE:valor,
					ID__EVENTO:parent.ID__EVENTO,
				  }						  
			}).done(function(val) 
			{					
				cantidadEtiquetas=val;								
				//console.log(val);
				/*var recipientes=JSON.parse(val);
				console.log(val);
				document.getElementById("totaldisponiblesiframe").innerHTML="<b>"+recipientes[0].NUM_CANTIDAD+"</b>";
				inventarioActual=recipientes[0].NUM_CANTIDAD; // cuantos tenemos realmente
				$("#cantidadAsignar").prop('max',recipientes[0].NUM_CANTIDAD);				
				*/
			}).always(function(val) 
			{									
				console.log(val+"???");					
			});		
	}
	else
	{
		/*parent.alerta("Favor de seleccionar la especie");
		return;*/
	}
}


function AsignarEtiquetasAevento()
{		
	$("#AsignacionModal", window.parent.document).modal("show");	
}

function verEtiquetas(cual)
{
	$.ajax({
		  url: "../cargarListaEtiquetasDeEvento",
		  type: 'POST',
		  data:{					
				ID__ESPECIE:cual,
				ID__EVENTO:parent.ID__EVENTO,
			  }						  
		}).done(function(val) 
		{								
			objetoprevio=JSON.parse(val)										
			parent.$('#listaetiquetas').empty();
			for (var i=0; i<objetoprevio.length;i++)
			{
				console.log(objetoprevio[i]);
				parent.$("#listaetiquetas").append('<li>'+objetoprevio[i].VCH_QR+'</li>');
			}
			parent.$('#verListaModal').modal('show');				
		}).always(function(val) 
			{					
				console.log(val);					
			});	;		

}
function imprimirEtiquetas()
{
	
}
function GeneraArchivo()
{
	parent.window.open("../generaArchivo/?id="+parent.ID__EVENTO);
}

function AbrirGeneradorEtiquetas()
{
	$("#GenerarMiniEtiqueta", window.parent.document).modal("show");	
}

function CerrarGeneradorEtiquetas()
{
	$("#GenerarMiniEtiqueta", window.parent.document).modal("hide");	
}

function TerminaDeAsignar()
{
	parent.TerminaDeAsignar();
}
function TerminaDeEtiquetar()
{
	parent.TerminaDeEtiquetar();
}

function AutoGenerar(totales,ID__ESPECIE,ID__EVENTO)
{
	$.ajax({
		  url: "../AutoGenerarEtiquetasDeEvento",
		  type: 'POST',
		  data:{					
				ID__ESPECIE:ID__ESPECIE,
				ID__EVENTO:ID__EVENTO,
				totales:totales,
			  }						  
		}).done(function(val) 
		{								
			bootbox.alert({ 
			  size: "small",
			  message: val, 
			  callback: function(result){
				  location.reload()
				 }
			});
//			parent.alerta("Las etiquetas se han autogenerado exitosamente",location.reload());
		}).always(function(val) 
			{					
				console.log(val);					
			});	;		
}
function AutoAsignar(totales,ID__ESPECIE,ID__EVENTO)
{
	$.ajax({
		  url: "../AutoAsignarEtiquetasDeEvento",
		  type: 'POST',
		  data:{					
				ID__ESPECIE:ID__ESPECIE,
				ID__EVENTO:ID__EVENTO,
				totales:totales,
			  }						  
		}).done(function(val) 
		{					
			//console.log(val);
			bootbox.alert({ 
			  size: "small",
			  message: val, 
			  callback: function(result){
				  location.reload()
				 }
			});						
		}).always(function(val) 
			{					
				console.log(val);					
			});	;			
}
function ReiniciarAsignacion()
{
	var urlMetodo="../reiniciarAsignacion";	
	parent.bootbox.confirm("Esto reiniciara la asignacion de arbolado de este evento. <br/> esta de acuerdo?", function(result)
	{
		if(result)
		{
			$.ajax({
			  url: urlMetodo,
			  type: 'POST',
			  data:{		  
						ID__EVENTO:parent.ID__EVENTO,
					}						  
			}).always(function(val) 
			{	
					parent.alerta(val);
					setTimeout(function(){ location.reload();				}, 3000);
			});					
		}
	});
}
/*
(function($){
$.fn.serializeAny = function() {
    var ret = [];
    $.each( $(this).find(':input'), function() {
        ret.push( encodeURIComponent(this.name) + "=" + encodeURIComponent( $(this).val() ) );
    });

    return ret.join("&").replace(/%20/g, "+");
}
})(jQuery);*/

$.fn.exists = function(){
    return this.length > 0 ? this : false;
}
