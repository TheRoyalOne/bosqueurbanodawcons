
var ID__COLONIA=0;
var ID__DOMICILIO=0;
var ID__CVETALLER=0;

$("#tablaespecies").on('click', 'tr' , function (event) 
	{		
		ID__CVETALLER=$(this).attr('id');				
	});

$("#btnAgregar").click(function () 
{
	$("#tablaespecies tr").removeClass("success");
	$("#ID__CVETALLER").val(0);
	ID__CVETALLER=0;
	resetf();
	$('#agregarModificar').show();	
	var posicion = $("#agregarModificar").offset().top;
    $("html, body").animate({
        scrollTop: posicion
    }, 2000);    
    
    
});

$("#btnEditar").click(function () 
{
	resetf();
	if(ID__CVETALLER!=0)		
		{
			cargarDatosTallerRegistro();		
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

$("#btnRegresar").click(function () {
	$('#agregarModificar').hide();
	var posicion = "0px";
    $("html, body").animate({
        scrollTop: posicion
    }, 0000)	
});

$(".nav-tabs a").click(function () {
	$(this).tab('show');
});

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

function setCampos()
{
	$( "#datasesiones" ).empty();	
	for(i=1;i<=$( "#NUM_SESIONES" ).val();i++)
	{
		$( "#datasesiones" ).append('<div class="form-group"><div class="col-lg-6"><div class="form-group"><label class="control-label col-lg-4">Dia Sesion '+i+':</label>'+
						'<div class="col-lg-8">'
							+'<input type="text" class="form-control fec" id="fechaInicio" name="FEC_FECHA'+i+'"></div>'+
						'</div>'+
						'<div class="form-group">'+
							'<label class="control-label col-lg-4">Hora Sesion '+i+':</label>'+
							'<div class="col-lg-8">'+
								'<input type="text" class="form-control" name="VCH_HORA'+i+'">'+
							'</div>'+
						'</div>'+
					'</div>'+
					'<div class="col-lg-6">'+
						'<div class="form-group">'+
							'<label class="control-label col-lg-4">Asistencia '+i+':</label>'+
							'<div class="col-lg-8">'+
								'<input type="text" class="form-control" name="INT_ASISTENCIA'+i+'">'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>     ');
	
	}
	$('.fec').datepicker({
		format: 'dd/mm/yyyy',
		language: 'esp'
	  });
}


var arrobjtallerista=[];
var arrobjembajadores=[];
var arrobjasistentes=[];
function armarModelos(cual)
{
	switch(cual)
	{
		case 1:
		{
			return JSON.stringify(arrobjtallerista)
//			break;
		}
		case 2:
		{			
			return JSON.stringify(arrobjembajadores)
		}
		case 3:
		{
			return JSON.stringify(arrobjasistentes)			
			break;
		}
	}
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
		
	var urlMetodo="GuardarRegistroTaller";		
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}	
	
	
	var $form = $("#agregarmodificar");
	var data = getFormData($form);
	
	$.ajax({
		  url: "GuardarRegistroTaller",
		  type: 'POST',
		  data:{					
				data: data,
				talleristas:armarModelos(1),
				embajadores:armarModelos(2),
				asistentes:armarModelos(3),
				ID__COLONIA:ID__COLONIA,
				ID__DOMICILIO:ID__DOMICILIO				
			  }						  
		}).done(function(val) 
		{		
			//console.log(val);			
			bootbox.alert("Guardado Exitosamente",function(){ document.location.reload() });
			
			//resetf();
			//console.log(val);																				
		})
		.always(function(val) 
		{	
			console.log(val); 
			return;		
		});					
}
function cancelarTallerista()
{
	$("#talleristaselect").val(-1);
}

var talleristaindex=0;
function agregarTallerista()
{
	if($("#talleristaselect").val()!=-1)
	{
		arrobjtallerista.push($("#talleristaselect option:selected").text());		
		$('#tablatalleristas').bootstrapTable('destroy');
		$('#tablatalleristas').append('<tr><td>'+$("#talleristaselect option:selected").text()+'</td></tr>');
		$('#tablatalleristas').bootstrapTable();	
		talleristaindex++;
		cancelarTallerista();
	}	
}
function cancelarEmbajador()
{
	$("#embajadoresselect").val(-1);
}

var Embajadorindex=0;
function agregarEmbajador()
{
	if($("#embajadoresselect").val()!=-1)
	{
		arrobjembajadores.push($("#embajadoresselect  option:selected").text());		
		$('#tablaembajador').bootstrapTable('destroy');
		$('#tablaembajador').append('<tr><td>'+$("#embajadoresselect option:selected").text()+'</td></tr>');
		$('#tablaembajador').bootstrapTable();	
		Embajadorindex++;
		cancelarEmbajador();
	}	
}
var Asistenteindex=0;
function cancelarAsistente()
{
	$("#VCH_NOMBREASISTENTE").val("");
	$("#VCH_CORREOASISTENTE").val("");
	$("#VCH_TELEFONOASISTENTE").val("");	
	$("#VCH_CLAVE").val("");		
}
function agregarAsistente()
{
	if(  $("#ID__GUARDABOSQUE").val()!='')
	{
		arrobjasistentes.push({ID__GUARDABOSQUE:$("#ID__GUARDABOSQUE").val(),PAGADO:0});
		$('#tablaasistente').bootstrapTable('destroy');
		$('#tablaasistente').append('<tr><td>'+$('#ID__GUARDABOSQUE option:selected').html()+'</td><td align="right" id="TDPAGADO'+$("#ID__GUARDABOSQUE").val()+'"><button type="button" class="btn btn-primary"  onclick="MarcaPagado('+$("#ID__GUARDABOSQUE").val()+')"><i class="fa fa-plus-circle"></i> Marcar Pagado</button></td></tr>');
		$('#tablaasistente').bootstrapTable();			
		Asistenteindex++;		
		//cancelarAsistente();
	}	
}

function cargarDatosTallerRegistro()
{
	$('#tablatalleristas').bootstrapTable('destroy');
	$('#tablaembajador').bootstrapTable('destroy');
	$('#tablaasistente').bootstrapTable('destroy');
	$("#tablatalleristas > tbody").empty();
	$("#tablaembajador > tbody").empty();
	$("#tablaasistente > tbody").empty();
	$("#ID__CVETALLER").val(ID__CVETALLER)
	$.ajax({
		  url: "cargarTallerRegistro",
		  type: 'POST',
		  data:{					
				ID__CVETALLER: ID__CVETALLER					
			  }						  
		}).done(function(val) 
		{					
			//console.log(val);
			objetoprevio=JSON.parse(val)				
			ID__DOMICILIO=objetoprevio.registrotalleres[0].ID__DOMICILIO;			

			mapeo(objetoprevio.registrotalleres[0]);		
			setCampos();
			if(objetoprevio.convocadortalleres.length>0)
			{
				for(var i=1;i<objetoprevio.convocadortalleres.length+1;i++)
				{					
					//console.log("[name=FEC_FECHA"+i+"]");
					$("[name=FEC_FECHA"+i+"]").val(objetoprevio.convocadortalleres[i-1].FEC_FECHA);
					$("[name=INT_ASISTENCIA"+i+"]").val(objetoprevio.convocadortalleres[i-1].INT_ASISTENCIA);
					$("[name=VCH_HORA"+i+"]").val(objetoprevio.convocadortalleres[i-1].VCH_HORA);
				}
			}													
			if(objetoprevio.talleristas.length>0)
			{
				for(var i=0;i<objetoprevio.talleristas.length;i++)
				{	
					arrobjtallerista.push(objetoprevio.talleristas[i].VCH_NOMBRE);
					addRowT("tablatalleristas",'<tr><td>'+objetoprevio.talleristas[i].VCH_NOMBRE+'</td></tr>', false);				
				}
			}
			if(objetoprevio.embajadores.length>0)
			{
				for(var i=0;i<objetoprevio.embajadores.length;i++)
				{
					arrobjembajadores.push(objetoprevio.embajadores[i].VCH_NOMBRE);
					addRowT("tablaembajador",'<tr><td>'+objetoprevio.embajadores[i].VCH_NOMBRE+'</td></tr>', false);				
				}
			}
			if(objetoprevio.asistentes.length>0)
			{
				console.log(objetoprevio.asistentes);
				for(var i=0;i<objetoprevio.asistentes.length;i++)
				{					
					arrobjasistentes.push({ID__GUARDABOSQUE:objetoprevio.asistentes[i].ID__GUARDABOSQUE,PAGADO:objetoprevio.asistentes[i].PAGADO});
					if(objetoprevio.asistentes[i].PAGADO!="1")
					{
						var html='<tr><td>'+objetoprevio.asistentes[i].VCH_NOMBRE+'</td><td ID="TDPAGADO'+objetoprevio.asistentes[i].ID__GUARDABOSQUE+'"><button type="button" class="btn btn-primary"  onclick="MarcaPagado('+objetoprevio.asistentes[i].ID__GUARDABOSQUE+')">Marcar Pagado</button></td><tr>';
					}
					else
					{
						var html='<tr><td>'+objetoprevio.asistentes[i].VCH_NOMBRE+'</td><td>PAGADO</td></tr>';
					}
					addRowT("tablaasistente",html, false);				
				}
			}

			
			
/*
			$('#form_VCH_NUMGAFETE').val(objetoprevio.VCH_NUMGAFETE);

			$('#form_VCH_NUMGAFETE').val(objetoprevio.VCH_NUMGAFETE);
			if(objetoprevio.FEC_FECHAINICIO!="0000-00-00 00:00:00")
				$('#form_FEC_FECHAINICIO').val(objetoprevio.FEC_FECHAINICIO);													
			$('#divDomicilio-estado').val(objetoprevio.estado);																	
*/			
			$('#tablatalleristas').bootstrapTable();			
			$('#tablaembajador').bootstrapTable();			
			$('#tablaasistente').bootstrapTable();			
			
			return;
		});		
}


/* FUNCION SERIALIZA TODO*/
function getFormData($form)
{
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
/* FUNCION SERIALIZA TODO*/

/* function mapea data */
function mapeo(objeto) 
{
	for(var propertyName in objeto) 
	{
			$("[name="+propertyName+"]").val(objeto[propertyName]);
	}
}
function addRowT(idTabla,row,refresh)
{
	if(refresh)
	{
		$('#'+idTabla).bootstrapTable('destroy');
	}

	$('#'+idTabla).append(row);
	
	if(refresh)
	{
		$('#'+idTabla).bootstrapTable();			
	}
}
/* function mapea data	 */

function resetf()
{	
	$('#tablatalleristas').bootstrapTable('destroy');
	$('#tablaembajador').bootstrapTable('destroy');
	$('#tablaasistente').bootstrapTable('destroy');
	$("#tablatalleristas > tbody").empty();
	$("#tablaembajador > tbody").empty();
	$("#tablaasistente > tbody").empty();
	
	document.getElementById("agregarmodificar").reset();	
	arrobjtallerista=[];
	arrobjembajadores=[];
	arrobjasistentes=[];
	talleristaindex=0;
	Embajadorindex=0;
	Asistenteindex=0;
	
	$('#tablatalleristas').bootstrapTable();			
	$('#tablaembajador').bootstrapTable();			
	$('#tablaasistente').bootstrapTable();
}
function BuscarGuardabosque()
{	
	$.ajax({
		  url: "BuscarGuardabosque",
		  type: 'POST',
		  data:{									
				VCH_NOMBREASISTENTE:$("#VCH_NOMBREASISTENTE").val(),
				VCH_APELLIDOPATERNO:$("#VCH_APELLIDOPATERNO").val(),
				VCH_CORREOASISTENTE:$("#VCH_CORREOASISTENTE").val()				
			  }						  
		}).done(function(val) 
		{		
			objetoprevio=JSON.parse(val)	
			$('#ID__GUARDABOSQUE').empty();
			for(var i=0; i<objetoprevio.length;i++)
			{				
				$('#ID__GUARDABOSQUE').append("<option value="+objetoprevio[i].ID__GUARDABOSQUE+">"+objetoprevio[i].VCH_APELLIDOPATERNO+" "+objetoprevio[i].VCH_APELLIDOMATERNO+" "+objetoprevio[i].VCH_NOMBRE +"</option>");
			}									
			
			console.log(val);
		})
		.always(function(val) 
		{	
			return;		
		});			
}

function MarcaPagado(cual)
{
	if(ID__CVETALLER==0)
	{
		bootbox.alert("Antes de marcar como pagado debes crear el taller");
	}
	else
	{
		bootbox.confirm(
		{
			message: "Marcar como pagado?",
			buttons: {
				confirm: {
					label: 'Si',
					className: 'btn-primary'
				},
				cancel: {
					label: 'No',
					className: 'btn-default'
				}
			},
			callback: function (result) 
			{
				if(result)
				{
					$.ajax({
					  url: "MarcarPagado",
					  type: 'POST',
					  data:{									
							ID__GUARDABOSQUE:cual,			
							ID__CLAVETALLER:ID__CVETALLER
						  }						  
					}).done(function(val) 
					{					
						$("#TDPAGADO"+cual).html("PAGADO");
						for(var i=0;i<arrobjasistentes.length;i++)
						{								
							console.log("BUSCO");				
							if(arrobjasistentes[i].ID__GUARDABOSQUE==cual)
							{
								console.log("SETEADO");
								arrobjasistentes[i].PAGADO="1";
							}						
						}
						
					})
					.always(function(val) 
					{	
						console.log(val);
						return;		
					});			
				}
			}
		});
		
		
		
	}
}
