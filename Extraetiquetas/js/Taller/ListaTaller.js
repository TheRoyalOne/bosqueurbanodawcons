var ID__CVETALLER=0;
function evaluar(valor)
{
	ID__CVETALLER=valor;
	$("#etiquetaPerdidaModal").modal('show');	
}
function extractor($form)
{
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};
    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}
function mensaje(valor)
{	
	bootbox.alert("Favor de capturar todos los datos: "+valor,function(){
		 
		$("#etiquetaPerdidaModal").css("overflow","auto");		
	 });
}
function gestorParticipa(valor)
{
	if(valor==1)
	{
		$("#cualotro").show();
	}
	else
	{
		$("#cualotro").hide();
	}	
}
function gestorMedio(valor)
{
	if(valor==6)
	{
		$("#cualmedio").show();
	}
	else
	{
		$("#cualmedio").hide();
	}	
}
function contestarEncuesta()
{	
	if($("input[name='optradioPREPTEMA']:checked").val()==undefined)
	{
		mensaje("Preparacion del tema");
		return;
	}
	if($("input[name='optradioCLARIDAD']:checked").val()==undefined)
	{
		mensaje("Claridad del tema");
		return;
	}
	if($("input[name='optradioAPOYO']:checked").val()==undefined)
	{
		mensaje("Material de apoyo");
		return;
	}
	if($("input[name='optradioMANEJO']:checked").val()==undefined)
	{
		mensaje("Manejo del tiempo");
		return;
	}
	if($("input[name='optradioCONTENIDO']:checked").val()==undefined)
	{
		mensaje("Contenido del taller");
		return;
	}
	if($("input[name='optradioDUDAS']:checked").val()==undefined)
	{
		mensaje("Aclaración de dudas");
		return;
	}
	
	valido=true;
	$( ".required" ).each(function() 
	{		
		if(($(this).val()=='')&&(valido==true))
		{
			mensaje(" ");
			valido=false;
			return;
		}
		if(valido==false)
		{
			return true;
		}	
		//console.log($(this).name()+" - "+$(this).val());
		//console.log(index, $(elem).val());
	});
		
	var data=extractor($("#transferencia"));		
	$.ajax({
		  url: "EvaluarTaller",
		  type: 'POST',
		  data:{					
				data: data,
				ID__CVETALLER:ID__CVETALLER					
			  }						  
		}).done(function(val) 
		{	
			console.log(val);				
			bootbox.alert("Gracias!",function()
			{			 
				document.location.reload();
				console.log("reload");				
			});																	
			
		});	
}


//* Base*/


/*var ID__INVENTARIO=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;

function transferirDe(cual,maximos)
{
	ID__INVENTARIO=cual;
	$( "#slider" ).slider( "option", "max", maximos );
	$( "#slider" ).slider( "option", "value", 0 );
	$("#custom-handle").html(0);
	$('#transferirModal').modal('show');	
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
function transferir()
{	
	$.ajax({
	  url: "transferenciaInventarioGlobal",
	  type: 'POST',
	  data:{		 
			ID__INVENTARIO:ID__INVENTARIO,			
			NUM_CANTIDAD:$( "#slider" ).slider( "option", "value" ),
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

function devolverPopup()
{
	$('#devolverModal').modal('show');	
}
function perdidaPopup()
{
	$('#etiquetaPerdidaModal').modal('show');	
}
function cargarLista(ID__ESPECIE,ID__EMPRESA,VCH_ANIO)
{
	$.ajax({
		  url: "cargarListaEtiquetas",
		  type: 'POST',
		  data:{					
				ID__ESPECIE: ID__ESPECIE,		
				ID__EMPRESA:ID__EMPRESA,
				VCH_ANIO:VCH_ANIO
			  }						  
		}).done(function(val) 
		{					
//			console.log(val);
			objetoprevio=JSON.parse(val)										
			$('#listaetiquetas').empty();
			for (var i=0; i<objetoprevio.length;i++)
			{
				console.log(objetoprevio[i]);
				$("#listaetiquetas").append('<li>'+objetoprevio[i].VCH_QR+'</li>');
			}
			$('#verListaModal').modal('show');				
		});		

}
function generar()
{
	var valido=true;
	$( ".requiredb" ).each(function() 
	{
		if($(this).val()=='')
		{
			valido=false;
		}		
	});		
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}
	
	$.ajax({
	  url: "etiquetasGenerar",
	  type: 'POST',
	  data:{		 
				ID__ESPECIE: $("#ID__ESPECIE").val(),		
				ID__EMPRESA:$("#ID__EMPRESA").val(),
				VCH_ANIO:$("#VCH_ANIO").val(),
				NUM_CANTIDAD:$("#NUM_CANTIDAD").val()
			}						  
	}).always(function(val) 
	{	
		bootbox.alert(val, function()
		{				
			document.location.reload();				
		});
	});		
}


function descontar()
{
	if($("#VCH_QRDESCONTAR").val()=='')
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}			
	$.ajax({
	  url: "etiquetasDescontar",
	  type: 'POST',
	  data:{		 
				VCH_QR: $("#VCH_QRDESCONTAR").val(),						
			}						  
	}).always(function(val) 
	{	
		bootbox.alert(val, function()
		{				
			document.location.reload();				
		});
	});		
}


function recuperar()
{
	if($("#VCH_QRRECUPERAR").val()=='')
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}			
	$.ajax({
	  url: "etiquetasRecuperar",
	  type: 'POST',
	  data:{		 
				VCH_QR: $("#VCH_QRRECUPERAR").val(),						
			}						  
	}).always(function(val) 
	{	
		bootbox.alert(val, function()
		{				
			document.location.reload();				
		});
	});		
}
*/

function Inscribirse(ID__CVETALLER)
{
	var r = confirm("Reservar espacio en el curso?");
	if (r == true) 
	{
		$.ajax({
		  url: "InscribirseAction",
		  type: 'POST',
		  data:{		 
					ID__CVETALLER: ID__CVETALLER,						
				}						  
		}).always(function(val) 
		{	
			console.log(val);
			objetoprevio=JSON.parse(val);			
			if(objetoprevio.status=="exito")
			{
				bootbox.alert(objetoprevio.mensaje, function()
				{				
					document.location.reload();				
				});				
			}
			else			
			{
				if(objetoprevio.status=="Lleno")
				{
					bootbox.alert(objetoprevio.mensaje, function()
					{				
						//document.location.reload();				
					});				
				}				
				else
				{
					if(objetoprevio.status=="Participante")
					{
						bootbox.alert(objetoprevio.mensaje, function()
						{				
							//document.location.reload();				
						});				
					}				
					else
					{
					}
				}
			}
			/*
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});*/
		});		
	} else 
	{
		txt = "You pressed Cancel!";
	}			
}

