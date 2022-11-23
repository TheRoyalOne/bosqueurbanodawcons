//* Base*/

function abrirAsignacion(cual)
{	
			var src= direccion_AsignacionArbol;//document.getElementById("iframeTotal").src;
			var rest = src.substring(0, src.lastIndexOf("/") + 1);
			document.getElementById("iframeTotal").src=rest+cual;
			
			$('#agregarModificar').attr('hidden', false);				
						
			var posicion = $("#agregarModificar").offset().top;
			$("html, body").animate({
				scrollTop: posicion
			}, 2000)	
			
			ID__EVENTO=cual;
}
function abrirEtiquetado(cual)
{	
			var src= direccion_AsignacionEtiqueta;//document.getElementById("iframeTotal").src;
			var rest = src.substring(0, src.lastIndexOf("/") + 1);
			document.getElementById("iframeTotal").src=rest+cual;
			
			$('#agregarModificar').attr('hidden', false);				
						
			var posicion = $("#agregarModificar").offset().top;
			$("html, body").animate({
				scrollTop: posicion
			}, 2000)	
			
			ID__EVENTO=cual;
}
/*
$('#FEC_FECHAINICIOCal').datetimepicker();
$('#FEC_FECHAFINcal').datetimepicker();
$('#FFEC_FECHAINICIOCal').datetimepicker();
$('#FFEC_FECHAFINcal').datetimepicker();

*/

function TerminaDeAsignar()
{
	bootbox.confirm("Esto cerrara la asignacion de arbolado y permitira continuar con el proceso de etiquetado.<br/> esta seguro?", function(result)
	{ 		
		if(result)
		{			
			$.ajax({
			  url: "AsignacionArbolesTerminar",
			  type: 'POST',
			  data:
			  {					
					ID__EVENTO:parent.ID__EVENTO,
			  }						  
			}).done(function(val) 
			{					
				bootbox.alert({
					message: "Alta de arbolado completa!",
					callback: function () 
					{
						parent.location.reload();
					}
				})
			});			
		}
	});		
}

function TerminaDeEtiquetar()
{
	bootbox.confirm("Esto cerrara el etiquetado y permitira continuar con el proceso de orden de salida.<br/> esta seguro?", function(result)
	{ 		
		if(result)
		{			
			$.ajax({
			  url: "EtiquetadoArbolesTerminar",
			  type: 'POST',
			  data:
			  {					
					ID__EVENTO:parent.ID__EVENTO,
			  }						  
			}).done(function(val) 
			{					
				bootbox.alert({
					message: "Etiquetado completo!",
					callback: function () 
					{
						parent.location.reload();
					}
				})
			});			
		}
	});		
}


function traerEspecies(cual)
{
	$.ajax({
		  url: "cargarListaEspecies",
		  type: 'POST',
		  data:{					
				ID__EVENTO:cual,
			  }						  
		}).done(function(val) 
		{		
			console.log(val);			
			objetoprevio=JSON.parse(val)										
			$('#listaetiquetas').empty();
			for (var i=0; i<objetoprevio.length;i++)
			{
				console.log(objetoprevio[i]);
				$("#listaetiquetas").append('<li>'+objetoprevio[i].VCH_NOMBRECOMUN+' ('+objetoprevio[i].sumatoria+')</li>');
			}
			$('#verListaModal').modal('show');				
		});		
}
