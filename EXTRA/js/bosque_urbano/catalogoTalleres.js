//* Base*/
var ID__TALLER=0;
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
		ID__TALLER=0;
		$("#tablaespecies tr").removeClass("success");
		$('#agregarModificar').show();
		var posicion = $("#agregarModificar").offset().top;
		$("html, body").animate({
			scrollTop: posicion
		}, 2000)	
	});
	$("#btnEditar").click(function () 
	{
		if(ID__TALLER!=0)		
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
		if(ID__TALLER!=0)		
		{
			document.location='Inventarios/'+ID__TALLER;			
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
		ID__TALLER=$(this).attr('id');				
	});
}
inicializador();


function cargarDatos()
{		
	$.ajax({
		  url: "cargarCatalogoTaller",
		  type: 'POST',
		  data:{					
				ID__TALLER: ID__TALLER					
			  }						  
		}).done(function(val) 
		{					
			//console.log(val);
			objetoprevio=JSON.parse(val)				
			
			$('#VCH_NOMBRE').val(objetoprevio.taller[0].VCH_NOMBRE);
			$('#VCH_MATERIAL').val(objetoprevio.taller[0].VCH_MATERIAL);
			$('#VCH_DESCRIPCION').val(objetoprevio.taller[0].VCH_DESCRIPCION);			
			
			$('#tablaarchivos').bootstrapTable('destroy');	
			$('#tablaarchivos tbody').remove();
						
			for (var i=0; i < objetoprevio.archivos.length ; i++)	
			{								
				$('#tablaarchivos').append('<tr id="rowcatalogoTalleres'+catalogoTalleresAUXILIAR+'"><td>'+objetoprevio.archivos[i].VCH_NOMBRE+'</td><td>'+objetoprevio.archivos[i].VCH_URL_ARCHIVO+'</td></tr>');	
			}
			
			$('#tablaarchivos').bootstrapTable();	
																	
		})
		.always(function(val) 
		{	
			//console.log(val); return;		
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
	if(ID__TALLER==0) 
	{
		urlMetodo="altaCatalogoTalleres";	
	}
	else
	{		
		urlMetodo="editarCatalogoTalleres";  
	}	
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}	
	$("#CompiladoNombresFiles").val(JSON.stringify(arrayNombreFiles));
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
	
	$('#ID__TALLER').val(ID__TALLER); 	
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

$("#VCH_URL_ARCHIVOFile0").fileinput({
    'showUpload': false
});

function ManejadorFiles()
{
	$("iptFotoEspecie"+indexfile).hide();
	$(".file-preview").hide();
	$("#inp"+indexfile).hide();				
	indexfile++;		
	$( "#divdeinputs" ).append( "<div  id=\"inp"+indexfile+"\"><input name=\"VCH_URL_ARCHIVOFile"+indexfile+"\" id=\"VCH_URL_ARCHIVOFile"+indexfile+"\" class=\"file\" type=\"file\"></div>" );							
	$("#VCH_URL_ARCHIVOFile"+indexfile).fileinput({
		'showUpload': false
	});
}



var indexfile=0;
function resetArchivo()
{
	$('#VCH_NOMBREFile').val(''); 
	$('#VCH_URL_ARCHIVOFile'+indexfile).val(''); 
}

var arrayNombreFiles=[];	
var catalogoTalleresAUXILIAR=0;
function agregarArrayFile()
{	
	catalogoTalleresAUXILIAR++;	//preincrementa antes de crear row, en caso de que tomes el row
	
	if( $("#VCH_NOMBREFile").val()=="") 
	{
		bootbox.alert("Favor de introducir un nombre para el archivo");
		return;
	}

	if( document.getElementById("VCH_URL_ARCHIVOFile"+indexfile).files.length == 0 ) 
	{
		bootbox.alert("Favor de seleccionar el archivo");
		return;
	}	
		
	$('#tablaarchivos').bootstrapTable('destroy');			
	var fileurl=$('#VCH_URL_ARCHIVOFile'+indexfile).val().split('\\')
	fileurl=fileurl[fileurl.length-1];
	
	$('#tablaarchivos').append('<tr id="rowcatalogoTalleres'+catalogoTalleresAUXILIAR+'"><td>'+$('#VCH_NOMBREFile').val()+'</td><td>'+fileurl+'</td></tr>');	
/*	setTimeout(function()
	{*/
					$('#tablaarchivos').bootstrapTable();	 
/*	}, 500);*/
	
	arrayNombreFiles.push($("#VCH_NOMBREFile").val());
	$("#VCH_NOMBREFile").val('');			
	ManejadorFiles();
}
