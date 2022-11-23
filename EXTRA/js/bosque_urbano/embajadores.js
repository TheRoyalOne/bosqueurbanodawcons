//* Base*/
var ID__EMBAJADOR=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;
var ID__NOMBREEMBAJADOR="";

var objetoprevio;

$('#verAsignados').on('shown.bs.modal', function()
{	
	$("#QuienB").html(ID__NOMBREEMBAJADOR);
	$("#asignadosBody").empty();
	$.ajax({
		  url: "getAsignados",
		  type: 'POST',
		  data:{		 
					ID__EMBAJADOR: ID__EMBAJADOR,						
				}						  
		}).always(function(val) 
		{	

			if(val!="[]")
			{

				objetoprevio=JSON.parse(val);				
				html="<table CLASS='table table-hover table-bordered'>";
/*				html+="<thead><tr>"+
						"<td width='200px' class='text-center'><b>Guardabosque</b></td>"+
						"<td width='100px' class='text-center'>&nbsp;</td>"+			
					"	</thead></tr>";*/
				for(i=0;i<objetoprevio.length;i++)														
				{				
				html+="<tr>"+
						"<td width='130px' class='text-center'>"+
							objetoprevio[i].nombre+
						"</td>"+						
						"<td width='50px' class='text-center'><button type='button' class='btn btn-primary' onclick='EliminarAsignado("+objetoprevio[i].ID__ASIGNACION+",  $(this))'>Eliminar</button>"+"</td>"+

					"	</tr>";
				}
				html+=" </table>";
				$("#asignadosBody").append(html);
			}						
		});			
});

function EliminarAsignado(val,row)
{
	$.ajax({
		  url: "EliminarGuardabosqueAsignado",
		  type: 'POST',
		  data:{		 
					ID__ASIGNACION: val,						
				}						  
		}).always(function(val) 
		{	
			bootbox.alert(val, function()
			{				
				row.closest ('tr').remove();
			});			
		});			
}	
		
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
var expansion;
function inicializador()
{
	$("#btnAgregarEmbajador").click(function () 
	{
		$("#tablaespecies tr").removeClass("success");
		ID__EMBAJADOR=0;
		document.getElementById("btnGeneraPass").disabled=true;
		$('#agregarModificar').show();	
		var posicion = $("#agregarModificar").offset().top;
		$("html, body").animate({
			scrollTop: posicion
		}, 2000)
	});
	$("#btnEditarEmbajador").click(function () 
	{
		if(ID__EMBAJADOR!=0)		
		{
			document.getElementById("btnGeneraPass").disabled=false;
			cargarDatosEmbajador();		
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
	$("#btnRegresarCatUsuarios").click(function () 
	{
		$('#agregarModificar').hide();
		var posicion = "0px";
		$("html, body").animate({
			scrollTop: posicion
		}, 0000)		
	});
	$("#btnImportar").click(function() {
		$('#subirEmbajadores').modal('show');	
	});
	
	$("#tablaespecies").on('click', 'tr' , function (event) 
	{		
		try
		{
			ID__NOMBREEMBAJADOR=nombre=$(this)[0].cells[0].innerText+" "+$(this)[0].cells[1].innerText+" "+$(this)[0].cells[2].innerText;
		}
		catch(e)
		{
			ID__NOMBREEMBAJADOR="";
		}
		ID__EMBAJADOR=$(this).attr('id');				
	});
	$("#btnAsignacion").click(function () 
	{
		if(ID__EMBAJADOR!=0)		
		{			
			transferirDe();
		}
		else
		{
			bootbox.alert("Por favor selecciona el embajador al cual asignarle guardabosques");
		}
	});
	
	
	
	 $('#tablaespecies').DataTable
	 ({  
		"bLengthChange": false,
		"bFilter": false,
		"bInfo": false,
		"bAutoWidth": false ,
		scrollY:        "500px",
		scrollX:        true
	});
}
inicializador();


function GeneraPass()
{
	$.ajax({
		  url: "setClaveembajador",
		  type: 'POST',
		  data:{					
				ID__EMBAJADOR: ID__EMBAJADOR					
			  }						  
		}).done(function(val) 
		{	console.log(val);
			alert("La nueva contraseña ha sido enviada al correo");
		});		
}

function cargarDatosEmbajador()
{		
	$.ajax({
		  url: "cargarEmbajador",
		  type: 'POST',
		  data:{					
				ID__EMBAJADOR: ID__EMBAJADOR					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val)				
					
			ID__DOMICILIO=objetoprevio.ID__DOMICILIO
			$('#form_VCH_NUMGAFETE').val(objetoprevio.VCH_NUMGAFETE);
			$('#form_VCH_TELEFONO').val(objetoprevio.VCH_TELEFONO);
			$('#form_VCH_NOMBRE').val(objetoprevio.VCH_NOMBRE);
			$('#form_VCH_CELULAR').val(objetoprevio.VCH_CELULAR);
			$('#form_VCH_APELLIDOPATERNO').val(objetoprevio.VCH_APELLIDOPATERNO); 
			$('#form_ID__INSTITUCION').val(objetoprevio.ID__INSTITUCION);
			$('#form_VCH_APELLIDOMATERNO').val(objetoprevio.VCH_APELLIDOMATERNO);
			$('#form_VCH_CORREO').val(objetoprevio.VCH_CORREO);				
			ID__COLONIA=objetoprevio.ID__COLONIA;	
			
			if(objetoprevio.FEC_FECHAINICIO!="0000-00-00 00:00:00")
				$('#form_FEC_FECHAINICIO').val(objetoprevio.FEC_FECHAINICIO);													
			if(objetoprevio.FEC_FECHAFIN!="0000-00-00 00:00:00")
				$('#form_FEC_FECHAFIN').val(objetoprevio.FEC_FECHAFIN);										
			$('#form_VCH_SEMESTRE').val(objetoprevio.VCH_SEMESTRE);																
			$('#form_VCH_CARRERA').val(objetoprevio.VCH_CARRERA);				
			
			
			$('#form_VCH_TIPO').val(objetoprevio.VCH_ESTATUS);										
			/*if(objetoprevio.VCH_ESTATUS==1)
			{
				document.getElementById("tecnico").click();
			}
			else
			{					
				document.getElementById("practicante").click();
			}*/	
						
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
	if(ID__EMBAJADOR==0) 
	{
		urlMetodo="altaEmbajador";	
	}
	else
	{		
		urlMetodo="editarEmbajador";
	}
	//$("#idEspecie").val(ID__ESPECIE);		
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}
		
	$.ajax({
	  url: urlMetodo,
	  type: 'POST',
	  data:{
			ID__EMBAJADOR:ID__EMBAJADOR,
			ID__INSTITUCION:$('#form_ID__INSTITUCION').val(),
			ID__DOMICILIO:ID__DOMICILIO,
			VCH_NOMBRE:$('#form_VCH_NOMBRE').val(),
			VCH_APELLIDOPATERNO:$('#form_VCH_APELLIDOPATERNO').val(),
			VCH_APELLIDOMATERNO:$('#form_VCH_APELLIDOMATERNO').val(),
			VCH_TELEFONO:$('#form_VCH_TELEFONO').val(),
			VCH_CELULAR:$('#form_VCH_CELULAR').val(),
			VCH_CORREO:$('#form_VCH_CORREO').val(),
			//VCH_TIPO:$("input[name='optradio']:checked").val(),
			VCH_TIPO:$('#form_VCH_TIPO').val(),
			VCH_NUMGAFETE:$('#form_VCH_NUMGAFETE').val(),
			VCH_SEMESTRE:$('#form_VCH_SEMESTRE').val(),
			VCH_CARRERA:$('#form_VCH_CARRERA').val(),
			FEC_FECHAINICIO:$('#form_FEC_FECHAINICIO').val(),
			FEC_FECHAFIN:$('#form_FEC_FECHAFIN').val(),
			VCH_ESTATUS:0,						
			ID__COLONIA:ID__COLONIA,
			VCH_CALLE:$('#divDomicilio-calle').val(),
			VCH_ENTRECALLE:$('#divDomicilio-entre').val()
			}						  
	}).always(function(val) 
	{	
//			console.log(val); return;
			bootbox.alert(val, function()
			{				
				document.location.reload();				
			});
			//document.getElementById("embaja").reset();
	});		
	//$('#form-especie').attr('action', urlMetodo);	
	//$("#form-especie" ).submit();	
	
	
}
function eliminarEmbajador()
{	
	if(ID__EMBAJADOR!=0)
	{
		bootbox.confirm
		({
				message: "esta seguro que desea borrarlo?",
				callback: function (val) 
				{
					if(val)
					{
						$.ajax({
						  url: "eliminarEmbajador",
						  type: 'POST',
						  data:{ID__EMBAJADOR:ID__EMBAJADOR}						  
						}).done(function(val) 
						{					
							alert(val)	 
							document.location.reload();
						});											
					}					
				}
		})
	}
	else
	{
		bootbox.alert("Favor de seleccionar el embajador");
	}
	
	
}

function importar()
{
	
	var fd = new FormData(document.getElementById("importacion"));
            //fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "importarEmbajadores",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) 
            {
                bootbox.alert(data);
            });
            return false;
	
	return;
	
	var file_data = $("#iptFotoEspecie").prop("files")[0];   
    var form_data = new FormData();                  
    //form_data.append("file", file_data)    
    form_data.append('files[]', $('#iptFotoEspecie').get(0).files[0]);
    
    
    $.ajax({
                url: "importarEmbajadores",                               
                type: 'POST',
          data: formData,
          async: false,
          cache: false,
          contentType: false,
          processData: false,
     }).always(function(val) 
					{					
						alert(val)	 						
					});	;
}

$("#iptFotoEspecie").fileinput({
    'showUpload': false
});


function transferir()
{
	if($("#AsignarCantidad").val()=='')
	{
		bootbox.alert("Por favor elige la cantidad a asignar", function()
		{							
			$("#AsignarCantidad").focus();
		});
		return;
	}
	
			
	$.ajax({
	  url: "AsignarGuardabosqueAembajador",
	  type: 'POST',
	  data:{		 
			ID__EMBAJADOR:ID__EMBAJADOR,			
			AsignarAntiguedad:$("#AsignarAntiguedad").val(),
			AsignarPatrocinador:$("#AsignarPatrocinador").val(),
			AsignarEspecie:$("#AsignarEspecie").val(),
			AsignarEstado:$("#AsignarEstado").val(),
			AsignarMunicipio:$("#AsignarMunicipio").val(),
			AsignaColonia:$("#AsignaColonia").val(),
			NUM_CANTIDAD:$("#AsignarCantidad").val()
			}						  
	}).always(function(val) 
	{			
		bootbox.alert(val, function()
		{							
			document.location.reload();				
		});
	});		
}

function transferirDe()
{
	$("#Quien").html(ID__NOMBREEMBAJADOR);
	$( "#slider" ).slider( "option", "max", maximos );
	$( "#slider" ).slider( "option", "value", 0 );
	$("#custom-handle").html(0);
	$('#transferirModal').modal('show');	
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



var ciudades;
function cargaciudadeseMB(id)
{
	cargacoloniaseMB(0);
	$.ajax({
			  url: "getCiudades",
			  type: 'POST',
			  data:{					
					ID__ESTADO:id			
				  }						  
			}).done(function(val) 
			{									
				ciudades=JSON.parse(val);										
				$('#AsignarMunicipio').empty();				
				
				$('#AsignarMunicipio').append($('<option>',
					 {
						value: "-1",
						text : "---"
					}));	
				
				for (i=0; i<ciudades.length;i++)
				{
					$('#AsignarMunicipio').append($('<option>',
					 {
						value: ciudades[i].ID__MUNICIPIO,
						text : ciudades[i].VCH_NOMBRE
					}));	
				}
							
			});			
}
var colonias;
function cargacoloniaseMB(id)
{
	$.ajax({
			  url: "getColonias",
			  type: 'POST',
			  data:{					
					ID__MUNICIPIO:id			
				  }						  
			}).done(function(val) 
			{									
				colonias=JSON.parse(val);										
				$('#AsignaColonia').empty();		
				$('#AsignaColonia').append($('<option>',
					 {
						value: "-1",
						text : "---"
					}));			
				for (i=0; i<colonias.length;i++)
				{
					$('#AsignaColonia').append($('<option>',
					 {
						value: colonias[i].ID__COLONIA,
						text : colonias[i].colonia
					}));	
				}
								
			});			
}
