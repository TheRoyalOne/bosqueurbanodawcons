var ID__PATROCINIO=0;

function reset()
{
	ID__PATROCINIO=0;
	document.getElementById("form").reset();
}
function cargarDatos(cual)
{			
	ID__PATROCINIO=cual;
	$.ajax({
		  url: "cargarTipoPatrocinio",
		  type: 'POST',
		  data:{					
				ID__PATROCINIO: cual					
			  }						  
		}).done(function(val) 
		{	
			//console.log(val);
			objetoprevio=JSON.parse(val);				
			objetoprevio=objetoprevio[0];
			$('#VCH_TIPO').val(objetoprevio.VCH_TIPO);		
			$('#VCH_OBSERVACIONES').val(objetoprevio.VCH_OBSERVACIONES);									
		}).always(function(val)
		{
			console.log(val);
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
	if(ID__PATROCINIO==0) 
	{
		urlMetodo="altaTipoPatrocinio";	
	}
	else
	{		
		urlMetodo="editarTipoPatrocinio";
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
			ID__PATROCINIO:ID__PATROCINIO,			
			VCH_TIPO:$('#VCH_TIPO').val(),
			VCH_OBSERVACIONES:$('#VCH_OBSERVACIONES').val()			
			}						  
	}).always(function(val) 
	{	
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});
			
	});		
}
function Eliminar(cual)
{	
	if(ID__PATROCINIO!=0)
	{
		bootbox.confirm
		({
				message: "esta seguro que desea borrarlo?",
				callback: function (val) 
				{
					if(val)
					{
						$.ajax({
						  url: "eliminarTipoPatrocinio",
						  type: 'POST',
						  data:{ID__PATROCINIO:cual}						  
						}).done(function(val) 
						{					
							document.location.reload();
						});											
					}					
				}
		})
	}
	else
	{
		bootbox.alert("Favor de seleccionar el patrocinio");
	}
}
