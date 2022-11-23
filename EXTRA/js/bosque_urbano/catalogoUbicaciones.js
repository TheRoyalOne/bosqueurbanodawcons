//* Base*/
var ID__UBICACION=0;
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
		ID__UBICACION=0;
		$("#tablaespecies tr").removeClass("success");
		$('#agregarModificar').show();
		var posicion = $("#agregarModificar").offset().top;
		$("html, body").animate({
			scrollTop: posicion
		}, 2000)	
	});
	$("#btnEditar").click(function () 
	{
		if(ID__UBICACION!=0)		
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
			bootbox.alert("Por favor selecciona la ubicacion");
		}
	});
	$("#btnInventario").click(function () 
	{
		if(ID__UBICACION!=0)		
		{
			document.location='Inventarios/'+ID__UBICACION;			
		}
		else
		{
			bootbox.alert("Por favor selecciona la ubicacion");
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
		ID__UBICACION=$(this).attr('id');				
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
		  url: "cargarUbicacion",
		  type: 'POST',
		  data:{					
				ID__UBICACION: ID__UBICACION					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val)				

			if(objetoprevio[0])
			{				
				objetoprevio=objetoprevio[0];
			}
			ID__DOMICILIO=objetoprevio.ID__DOMICILIO;			
			ID__COLONIA=objetoprevio.ID__COLONIA;
			$('#VCH_NOMBRE').val(objetoprevio.VCH_NOMBRE);
			$('#INT_USO').val(objetoprevio.INT_USO);			

			if(objetoprevio.INT_ESTATUS==1)
			{
				document.getElementById("act").checked=true;
			}
			else
			{
				document.getElementById("inact").checked=true;
			}


			$('#VCH_OBSERVACIONES').val(objetoprevio.VCH_OBSERVACIONES); 			
			$('#divDomicilio-calle').val(objetoprevio.VCH_CALLE);
			$('#divDomicilio-entre').val(objetoprevio.VCH_ENTRECALLE);																	
			$('#divDomicilio-colonia').val(objetoprevio.colonia);
			$('#divDomicilio-cp').val(objetoprevio.VCH_CODIGOPOSTAL);																	
			$('#divDomicilio-municipio').val(objetoprevio.municipio);																	
			$('#divDomicilio-estado').val(objetoprevio.estado);																	
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
	if(ID__UBICACION==0) 
	{
		urlMetodo="altaUbicacion";	
	}
	else
	{		
		urlMetodo="editarUbicacion";  
	}	
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}
		/*
	$.ajax({
	  url: urlMetodo,
	  type: 'POST',
	  data:{
			ID__UBICACION:ID__UBICACION,			
			ID__DOMICILIO:ID__DOMICILIO,
			VCH_NOMBRE:$('#form_VCH_NOMBRE').val(),
			VCH_APELLIDOPATERNO:$('#form_VCH_APELLIDOPATERNO').val(),
			VCH_APELLIDOMATERNO:$('#form_VCH_APELLIDOMATERNO').val(),			
			VCH_TELEFONO:$('#form_VCH_TELEFONO').val(),
			VCH_CELULAR:$('#form_VCH_CELULAR').val(),
			VCH_CORREO:$('#form_VCH_CORREO').val(),						
			ID__COLONIA:ID__COLONIA,
			VCH_CALLE:$('#divDomicilio-calle').val(),
			VCH_ENTRECALLE:$('#divDomicilio-entre').val()
			}						  
	}).always(function(val) 
	{	
			console.log(val); return;
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});
			//document.getElementById("embaja").reset();
	});		*/
	
	$('#ID__UBICACION').val(ID__UBICACION); 
	$('#ID__COLONIA').val(ID__UBICACION); 
	$('#ID__DOMICILIO').val(ID__DOMICILIO); 
	$('#form-especie').attr('action', urlMetodo);	
	$("#form-especie" ).submit();	
	
	
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
					  url: "eliminarUbicacion",
					  type: 'POST',
					  data:{ID__UBICACION:ID__UBICACION}						  
					}).done(function(val) 
					{					
						alert(val)	 
						document.location.reload();
					});											
				}					
			}
	})
}

$("#iptFotoEspecie").fileinput({
    'showUpload': false
});
