


//* Base*/
var ID__INSTITUCION=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;

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
function inicializador()
{
	$("#btnAgregar").click(function () 
	{		
		ID__INSTITUCION=0;
		$("#tablaespecies tr").removeClass("success");
		$('#agregarModificar').show();
		var posicion = $("#agregarModificar").offset().top;
		$("html, body").animate({
			scrollTop: posicion
		}, 2000)	
	});
	$("#btnEditar").click(function () 
	{

		if(ID__INSTITUCION!=0)		
		{
			cargarDatos();		
			$('#agregarModificar').show();	
			var posicion = $("#agregarModificar").offset().top;
			$("html, body").animate({
				scrollTop: posicion
			}, 2000)
		}
		else
		{
			bootbox.alert("Por favor selecciona el embajador a modificar");
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
	
	$("#tablaespecies").on('click', 'tr' , function (event) 
	{		
		ID__INSTITUCION=$(this).attr('id');				
	});
}
inicializador();

/*
function GeneraPass()
{
	alert("click");
}
*/
function cargarDatos()
{		
	$.ajax({
		  url: "cargarInstitucion",
		  type: 'POST',
		  data:{					
				ID__INSTITUCION: ID__INSTITUCION					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val)									
			objetoprevio=objetoprevio[0];
			
			try
			{
				ID__DOMICILIO=objetoprevio.ID__DOMICILIO;			
			}
			catch(e)
			{
				ID__DOMICILIO=0;
			}
			try
			{
				ID__COLONIA=objetoprevio.ID__COLONIA;
			}
			catch(e)
			{
				ID__COLONIA=0;
			}
			
			
			$('#form_VCH_NOMBRE').val(objetoprevio.VCH_NOMBRE);			
			$('#form_VCH_PERSONACONTACTO').val(objetoprevio.VCH_PERSONACONTACTO); 						
			$('#form_VCH_PUESTOCONTACTO').val(objetoprevio.VCH_PUESTOCONTACTO);		
			$('#form_VCH_CORREO').val(objetoprevio.VCH_CORREO);								
			$('#form_VCH_TELEFONO').val(objetoprevio.VCH_TELEFONO);											
			$('#form_ID__USUARIO').val(objetoprevio.ID__USUARIO);	
			$('#form_VCH_COMENTARIOS').val(objetoprevio.VCH_COMENTARIOS);														
			$('#divDomicilio-calle').val(objetoprevio.VCH_CALLE);
			$('#divDomicilio-entre').val(objetoprevio.VCH_ENTRECALLE);																	
			$('#divDomicilio-colonia').val(objetoprevio.colonia);
			$('#divDomicilio-cp').val(objetoprevio.VCH_CODIGOPOSTAL);																	
			$('#divDomicilio-municipio').val(objetoprevio.municipio);																	
			$('#divDomicilio-estado').val(objetoprevio.estado);					
			
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
	if(ID__INSTITUCION==0) 
	{
		urlMetodo="altaInstitucion";	
	}
	else
	{		
		urlMetodo="editarInstitucion";
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
			ID__INSTITUCION:ID__INSTITUCION,			
			ID__DOMICILIO:ID__DOMICILIO,
			VCH_NOMBRE:$('#form_VCH_NOMBRE').val(),
			VCH_PERSONACONTACTO:$('#form_VCH_PERSONACONTACTO').val(),
			VCH_PUESTOCONTACTO:$('#form_VCH_PUESTOCONTACTO').val(),			
			VCH_CORREO:$('#form_VCH_CORREO').val(),					
			VCH_TELEFONO:$('#form_VCH_TELEFONO').val(),							
			ID__USUARIO:$('#form_ID__USUARIO').val(),							
			VCH_COMENTARIOS:$('#form_VCH_COMENTARIOS').val(),							
			ID__COLONIA:ID__COLONIA,						
			VCH_CALLE:$('#divDomicilio-calle').val(),
			VCH_ENTRECALLE:$('#divDomicilio-entre').val()
			}						  
	}).always(function(val) 
	{	
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});
			//document.getElementById("embaja").reset();
	});		
	//$('#form-especie').attr('action', urlMetodo);	
	//$("#form-especie" ).submit();	
	
	
}
function eliminar()
{	
	bootbox.confirm
	({
			message: "esta seguro que desea borrarlo?",
			callback: function (val) 
			{
				if(val)
				{
					$.ajax({
					  url: "eliminarInstitucion",
					  type: 'POST',
					  data:{ID__INSTITUCION:ID__INSTITUCION}						  
					}).done(function(val) 
					{					
						alert(val)	 
						document.location.reload();
					});											
				}					
			}
	})
}
