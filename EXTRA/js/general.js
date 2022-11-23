//prellenado de datos e importante para interaccion con otros componentes
function seleccionarColonia(idcolonia,estado,municipio,colonia,cp)
{		
	parent.ID__COLONIA=idcolonia;
	if(parent.document.getElementById("divDomicilio-estado")!=null)
	{
		parent.document.getElementById("divDomicilio-estado").value=estado;	
	}			
	if(parent.document.getElementById("divDomicilio-municipio")!=null)
	{
		parent.document.getElementById("divDomicilio-municipio").value=municipio;	
	}	
	if(parent.document.getElementById("divDomicilio-cp")!=null)
	{
		parent.document.getElementById("divDomicilio-cp").value=cp;	
	}		
	if(parent.document.getElementById("divDomicilio-colonia")!=null)
	{
		parent.document.getElementById("divDomicilio-colonia").value=colonia;	
	}			
	window.parent.closeModal();
}

function cambiaAagregar()
{
	
/*	$('#buscadorColonias').prop('hidden',true);
	$('#agregarColonia').prop('hidden',false);		
	$('#agregarColonia').removeAttr("hidden");*/
	
	$('#buscadorColonias').hide();
	$('#agregarColonia').show();
}
var ciudades;
function cargaciudades(id,select)
{
	$.ajax({
			  url: "getCiudades",
			  type: 'POST',
			  data:{					
					ID__ESTADO:id			
				  }						  
			}).done(function(val) 
			{									
				ciudades=JSON.parse(val);		
				
				if(select==0)
				{
					$('#buscadorColonias-ciudad').empty();				
					for (i=0; i<ciudades.length;i++)
					{
						$('#buscadorColonias-ciudad').append($('<option>',
						 {
							value: ciudades[i].ID__MUNICIPIO,
							text : ciudades[i].VCH_NOMBRE
						}));	
					}
				}
				if(select==1)
				{
					$('#agregarColonias-ciudad').empty();				
					for (i=0; i<ciudades.length;i++)
					{
						$('#agregarColonias-ciudad').append($('<option>',
						 {
							value: ciudades[i].ID__MUNICIPIO,
							text : ciudades[i].VCH_NOMBRE
						}));	
					}
				}
			});			
}
function altaColonia()
{	
	if( $('#agregarColonias-ciudad').val()=='' || $('#agregarColonias-colonia').val()=='' || $('#agregarColonias-cp').val()=='' )
	{
		bootbox.alert("Por favor llena todos los datos");
		return;
	}
	//$('#agregarColonias-estado').val();
	$.ajax({
	  url: "altaColonia",
	  type: 'POST',
	  data:{
			ID__MUNICIPIO:$('#agregarColonias-ciudad').val(),
			VCH_NOMBRE:$('#agregarColonias-colonia').val(),
			VCH_CODIGOPOSTAL:$('#agregarColonias-cp').val()
			}						  
	}).done(function(val) 
	{	
		$('#buscadorColonias').show();
		$('#agregarColonia').hide();
		
		/*
		$('#agregarColonia').prop('hidden',true);				
		$('#buscadorColonias').prop('hidden',false);*/
		
	});
}
function buscarColonia()
{			
	$.ajax({
	  url: "buscadorColonias",
	  type: 'POST',
	  data:{
				ID__ESTADO:$('#buscadorColonias-estado').val(),
				ID__MUNICIPIO:$('#buscadorColonias-ciudad').val(),
				VCH_NOMBRE:$('#buscadorColonias-colonia').val(),
				VCH_CODIGOPOSTAL:$('#buscadorColonias-cp').val()
			}						  
	}).done(function(val) 
	{	
		$("#masivo").html(val);	
		$('[data-toggle="table"]').bootstrapTable();														
	});	
}
function cancelaraltaColonia()
{
	$('#buscadorColonias').show();
	$('#agregarColonia').hide();
	/*
	$('#agregarColonia').prop('hidden',true);				
	$('#buscadorColonias').prop('hidden',false);*/
}
//$('#agregarColonia').prop('hidden',true);	
$('#agregarColonia').hide();
