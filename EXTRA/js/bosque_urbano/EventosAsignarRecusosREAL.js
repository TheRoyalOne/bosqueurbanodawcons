//* Base*/

function abrirAsignacion(cual)
{	
			var src= document.getElementById("iframeTotal").src;
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
