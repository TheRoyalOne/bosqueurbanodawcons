//* Base*/
var ID__INVENTARIO=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;


$("#cantidadMover").bind('keyup mouseup', function () 
{
	console.log($("#cantidadMover").val()+" vs "+ $("#cantidadMover").attr('max'))
	if(parseInt($("#cantidadMover").val())>parseInt($("#cantidadMover").attr('max')))
	{
		$("#cantidadMover").val($("#cantidadMover").attr('max'));
	}
});

$("#cantidadMerma").bind('keyup mouseup', function () 
{
	console.log($("#cantidadMerma").val()+" vs "+ $("#cantidadMerma").attr('max'))
	if(parseInt($("#cantidadMerma").val()) >parseInt($("#cantidadMerma").attr('max')))
	{
		$("#cantidadMerma").val($("#cantidadMerma").attr('max'));
	}
});

function transferirDe(cual,maximos)
{
	ID__INVENTARIO=cual;
/*	$( "#slider" ).slider( "option", "max", maximos );
	$( "#slider" ).slider( "option", "value", 0 );*/
//	$("#custom-handle").html(0);

	$("#cantidadMover").val(0);
	$("#cantidadMover").attr({
       "max" : maximos
    });

	$('#transferirModal').modal('show');	
}

function darDeBaja(cual,maximos)
{
	ID__INVENTARIO=cual;

	$("#cantidadMerma").val(0);
	$("#cantidadMerma").attr({
       "max" : maximos
    });
	$('#mermaModal').modal('show');	
}
function inicializador()
{
	$("#btnAgregar").click(function () 
	{		
		$("#agregarModificar :input").attr("disabled", false);
		ID__INVENTARIO=0;
		$('#agregarModificar').show();
		var posicion = $("#agregarModificar").offset().top;
		$("html, body").animate({
			scrollTop: posicion
		}, 2000)	
	});
	$("#btnEditar").click(function () 
	{
		if(ID__INVENTARIO!=0)		
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
		$("#agregarModificar :input").attr("disabled", false);
		ID__INVENTARIO=0;
		$('#agregarModificar').hide();
		var posicion = "0px";
		$("html, body").animate({
			scrollTop: posicion
		}, 0000)		
	});
	
	$("#tablaespecies").on('click', 'tr' , function (event) 
	{		
		ID__INVENTARIO=$(this).attr('id');				
	});
}
inicializador();


function GeneraPass()
{
	alert("click");
}

function editar(cual)
{
	$("#agregarModificar :input").attr("disabled", true);
	$("#FEC_FECHAGERMINACION").attr("disabled", false);
	$("#contenedor_id").attr("disabled", false);	
	$("#btnRegresar").attr("disabled", false);
	$("#botonguardar").attr("disabled", false);		
	
	cargarDatos(cual);		
	$('#agregarModificar').show();	

	var posicion = $("#agregarModificar").offset().top;
	$("html, body").animate({
		scrollTop: posicion
	}, 2000)		
}
function acomodarfechavista(cadena)
{
	cadena=cadena.split("-");
	return(cadena[2]+"/"+cadena[1]+"/"+cadena[0]);
}
function cargarDatos(cual)
{		
	$.ajax({
		  url: "cargarInventarioGlobal",
		  type: 'POST',
		  data:{					
				ID__INVENTARIO: cual					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val)				
			objetoprevio=objetoprevio[0];
			$('#procedencia_id').val(objetoprevio.procedencia_id);																	
			$('#FEC_FECHAGERMINACION').val(acomodarfechavista(objetoprevio.FEC_FECHAGERMINACION));
			$('#ID__UBICACION').val(objetoprevio.ID__UBICACION);																	
			$('#ID__ESPECIE').val(objetoprevio.ID__ESPECIE);	
			$('#NUM_CANTIDAD').val(objetoprevio.NUM_CANTIDAD);	
			$('#contenedor_id').val(objetoprevio.contenedor_id);																	
			
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
	if(ID__INVENTARIO==0) 
	{
		urlMetodo="altaInventarioGlobal";	
	}
	else
	{		
		urlMetodo="editarInventarioGlobal";
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
			ID__INVENTARIO:ID__INVENTARIO,			
			ID__UBICACION:$('#ID__UBICACION').val(),			
			ID__ESPECIE:$('#ID__ESPECIE').val(),
			procedencia_id:$('#procedencia_id').val(),
			contenedor_id:$('#contenedor_id').val(),
			FEC_FECHAGERMINACION:$('#FEC_FECHAGERMINACION').val(),			
			NUM_CANTIDAD:$('#NUM_CANTIDAD').val()		
			}						  
	}).always(function(val) 
	{	
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});		
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
					  url: "eliminarInventarioGlobal",
					  type: 'POST',
					  data:{ID__INVENTARIO:ID__INVENTARIO}						  
					}).done(function(val) 
					{					
						alert(val)	 
						document.location.reload();
					});											
				}					
			}
	})
}

function merma()
{	
	/*
	if($("#RazonMerma").val()=="")
	{
		bootbox.alert("Favor de especificar la razon de la merma");
		return;
	}
	
	if($("#cantidadMerma").val()>$("#cantidadMerma").attr('max'))
	{
		return;
	}	*/
	
	var cants=parseInt($("#cantidadMerma").val());
	var max=parseInt($("#cantidadMerma").attr('max'));
	if(cants>max)
	{
		console.log(cants+" "+max);
		bootbox.alert("La cantidad supera la existencia");
		return;
	}
	else
	{
		console.log(cants+" "+max);
		//return;
	}
	
	$.ajax({
	  url: "mermaInventarioGlobal",
	  type: 'POST',
	  data:{		 
			ID__INVENTARIO:ID__INVENTARIO,			
			NUM_CANTIDAD: $("#cantidadMerma").val(),  //$( "#slider" ).slider( "option", "value" ),
			RazonMerma:$( "#RazonMerma" ).val()
			}						  
	}).always(function(val) 
	{	
		bootbox.alert(val, function()
		{				
			document.location.reload();				
		});
	});		
}
function transferir()
{	
	var cant=parseInt($("#cantidadMover").val());
	var max=parseInt($("#cantidadMover").attr('max'));
	if(cant>max)
	{
		bootbox.alert("La cantidad supera la existencia");
		return;
	}
	
	$.ajax({
	  url: "transferenciaInventarioGlobal",
	  type: 'POST',
	  data:{		 
			ID__INVENTARIO:ID__INVENTARIO,			
			NUM_CANTIDAD: $("#cantidadMover").val(),  //$( "#slider" ).slider( "option", "value" ),
			ID__UBICACION:$( "#ID__INSTITUCION_IMPORTAR" ).val()
			}						  
	}).always(function(val) 
	{	
//		console.log(val); return;
		bootbox.alert(val, function()
		{				
			document.location.reload();				
		});
	});		
}
/*
var handle = $( "#custom-handle" );
$( "#slider" ).slider({
  create: function() 
  {
	handle.text( $( this ).slider( "value" ) );
  },
  slide: function( event, ui ) {
	handle.text( ui.value );
  }
});    
*/


