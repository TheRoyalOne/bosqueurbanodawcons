//* Base*/
var id_especie=0;
var id_especieprecio=0;
function cargarPrecios(cual)
{		
	id_especie=cual;
	$.ajax({
		  url: "cargarPreciosEspecie",
		  type: 'POST',
		  data:{					
				id_especie: id_especie					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val);
			if(objetoprevio[0])				
			{
				objetoprevio=objetoprevio[0];
				id_especieprecio=objetoprevio.especieprecio_id;
				$('#p3').val(objetoprevio.MES_TRES); 
				$('#p6').val(objetoprevio.MES_SEIS); 			
				$('#p9').val(objetoprevio.MES_NUEVE); 
				$('#p12').val(objetoprevio.MES_DOCE); 			
				$('#p18').val(objetoprevio.MES_DIECIOCHO); 
				$('#p24').val(objetoprevio.MES_VEINTICUATRO); 			
				$('#p30').val(objetoprevio.MES_TREINTA); 
				$('#p36').val(objetoprevio.MES_TREINTAYSEIS); 			
				$('#p42').val(objetoprevio.MES_CUARENTAYDOS); 
				$('#p48').val(objetoprevio.MES_CUARENTAYOCHO); 			
				$('#p60').val(objetoprevio.MES_SESENTA); 
				$('#p72').val(objetoprevio.MES_SETENTAYDOS); 			
			}					
			else
			{
				id_especieprecio=0;
				$('#p3').val(0); 
				$('#p6').val(0); 			
				$('#p9').val(0); 
				$('#p12').val(0); 			
				$('#p18').val(0); 
				$('#p24').val(0); 			
				$('#p30').val(0); 
				$('#p36').val(0); 			
				$('#p42').val(0); 
				$('#p48').val(0); 			
				$('#p60').val(0); 
				$('#p72').val(0); 			
			}
			
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
		}		
	});
	
	
	var urlMetodo;
	if(id_especieprecio==0) 
	{
		urlMetodo="altaPrecioEspecie";	
	}
	else
	{		
		urlMetodo="editarPrecioEspecie";
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
			id_especieprecio:id_especieprecio,
			ID__ESPECIE:id_especie,						
			MES_TRES:$('#p3').val(),
			MES_SEIS:$('#p6').val(),
			MES_NUEVE:$('#p9').val(),
			MES_DOCE:$('#p12').val(),
			MES_DIECIOCHO:$('#p18').val(),
			MES_VEINTICUATRO:$('#p24').val(),
			MES_TREINTA:$('#p30').val(),
			MES_TREINTAYSEIS:$('#p36').val(),			
			MES_CUARENTAYDOS:$('#p42').val(),
			MES_CUARENTAYOCHO:$('#p48').val(),
			MES_SESENTA:$('#p60').val(),			
			MES_SETENTAYDOS:$('#p72').val(),
			}						  
	}).always(function(val) 
	{	console.log(val)		;
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});			
	});		
	
	
}
