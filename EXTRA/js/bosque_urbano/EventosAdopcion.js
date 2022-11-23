//* Base*/
var ID__EVENTO=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;

$("#iptFotoEspecie0").fileinput({
    'showUpload': false
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
function inicializador()
{
	$("#btnAgregar").click(function () 
	{	
		$('#agregarModificar').show();
		var posicion = $("#agregarModificar").offset().top;
		$("html, body").animate({
			scrollTop: posicion
		}, 2000)	
	});
	$("#btnEditar").click(function () 
	{
		if(ID__EVENTO!=0)		
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

	$(".nav-tabs a").click(function () {
		$(this).tab('show');
	});

	function fechas()
	{
	if ($('#chkEvento').is(':checked') == true){
		document.getElementById("fechafin").disabled = false
		document.getElementById("fechaInicio").disabled = false
		
	}else{
		document.getElementById("fechaInicio").disabled = true
		document.getElementById("fechafin").disabled = true
	}
}
	
	$("#tablaespecies").on('click', 'tr' , function (event) 
	{		
		ID__EVENTO=$(this).attr('id');				
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
		  url: "cargarEventoAdopcion",
		  type: 'POST',
		  data:{					
				ID__EVENTO: ID__EVENTO					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val)				
					
			ID__DOMICILIO=objetoprevio.ID__DOMICILIO;			
			ID__COLONIA=objetoprevio.ID__COLONIA;
			$('#form_VCH_TELEFONO').val(objetoprevio.VCH_TELEFONO);
			$('#form_VCH_NOMBRE').val(objetoprevio.VCH_NOMBRE);			
			$('#form_VCH_APELLIDOPATERNO').val(objetoprevio.VCH_APELLIDOPATERNO); 			
			$('#form_VCH_APELLIDOMATERNO').val(objetoprevio.VCH_APELLIDOMATERNO);		
			$('#form_VCH_CORREO').val(objetoprevio.VCH_CORREO);								
			$('#form_VCH_TELEFONO').val(objetoprevio.VCH_TELEFONO);					
			$('#form_VCH_CELULAR').val(objetoprevio.VCH_CELULAR);								
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
	if($("input[name='optradio']:checked").val()==undefined)
	{
		valido=false;
	}	
	var urlMetodo;
	if(ID__EVENTO==0) 
	{
		urlMetodo="altaEventoAdopcion";	
	}
	else
	{		
		urlMetodo="editarEventoAdopcion";
	}	
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}
	else
	{
		$("#form_ID__EVENTO" ).val(ID__EVENTO);		
		$("#form_empaquetadoP").val(JSON.stringify(arrayTablaPatrocinios));
		$("#ID__DOMICILIO").val(ID__DOMICILIO);
		$("#ID__COLONIA").val(ID__COLONIA);
		
		$('#formguardar').attr('action', urlMetodo);	
		$("#formguardar" ).submit();	
	}	
	
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
					  url: "eliminarEventoAdopcion",
					  type: 'POST',
					  data:{ID__EVENTO:ID__EVENTO}						  
					}).done(function(val) 
					{					
						alert(val)	 
						document.location.reload();
					});											
				}					
			}
	})
}

var arrayTablaPatrocinios=[];	
var PatrociniosAuxiliarRows=0;
var indexfile=0;

function agregarTablaPatrocinios()
{		
	var objPatrocinios = 
		{
			VCH_NOMBREPATROCINADOR:$("#empresainstitucion").val(),		VCH_ARCHIVO:$("#iptFotoEspecie"+indexfile).val()
		};
	valido=true;	
	if($("#empresainstitucion").val()=='')
	{
		valido=false;
	}		
	if(valido)
	{
		$('#tablaPatrocinios').bootstrapTable('destroy');			
		$('#tablaPatrocinios').append('<tr><td>'+$("#empresainstitucion option:selected").text()+'</td><td>'+$("#iptFotoEspecie"+indexfile).val()+'</td></tr>');
		arrayTablaPatrocinios.push(objPatrocinios);		
		PatrociniosAuxiliarRows++;
		$('#tablaPatrocinios').bootstrapTable();		

		$("iptFotoEspecie"+indexfile).hide();
		$(".file-preview").hide();
		$("#inp"+indexfile).hide();				
		indexfile++;		
		$( "#divdeinputs" ).append( "<div id=\"inp"+indexfile+"\"><input id=\"iptFotoEspecie"+indexfile+"\" class=\"file\" type=\"file\"></div>" );							
		$("#iptFotoEspecie"+indexfile).fileinput({
			'showUpload': false
		});
		
	}		
	else
	{
		bootbox.alert("Favor de especificar almenos la empresa");
	}
}

