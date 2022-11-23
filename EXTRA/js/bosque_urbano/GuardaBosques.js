//* Base*/
var ID__GUARDABOSQUE=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;

function abrirModal()
{
	if(document.getElementById("chkDomicilio").checked)
		{
			$('#modalColonias').modal('show');	
			$('#divDomicilio').show();	
			//$('#divDomicilio').attr('hidden', false);				
		}
		else
		{			
			$('#divDomicilio').hide();	
		}
}
function inicializador()
{
	$("#btnAgregar").click(function () 
	{
		$("#tablaespecies tr").removeClass("success");
		ID__GUARDABOSQUE=0;
		document.getElementById("btnGeneraPass").disabled=true;
		$('#agregarModificar').show();
		var posicion = $("#agregarModificar").offset().top;
		$("html, body").animate({
			scrollTop: posicion
		}, 2000)	
	});
	$("#btnEditar").click(function () 
	{
		if(ID__GUARDABOSQUE!=0)		
		{
			document.getElementById("btnGeneraPass").disabled=false;
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
		ID__GUARDABOSQUE=$(this).attr('id');				
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
		  url: "setClaveGuardabosque",
		  type: 'POST',
		  data:{					
				ID__GUARDABOSQUE: ID__GUARDABOSQUE					
			  }						  
		}).done(function(val) 
		{	
			alert("La nueva contraseña ha sido enviada al correo");
		});		
	
}

function cargarDatos()
{		
	$.ajax({
		  url: "cargarGuardabosque",
		  type: 'POST',
		  data:{					
				ID__GUARDABOSQUE: ID__GUARDABOSQUE					
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
			
			if((ID__DOMICILIO!=0)&&(ID__DOMICILIO!=undefined))
			{
				$("#divDomicilio").show();
				$('#chkDomicilio').prop('checked', true);
			}	
			else
			{
				$("#divDomicilio").hide();
				$('#chkDomicilio').prop('checked', false);
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
	if(ID__GUARDABOSQUE==0) 
	{
		urlMetodo="altaGuardabosque";	
	}
	else
	{		
		urlMetodo="editarGuardabosque";
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
			ID__GUARDABOSQUE:ID__GUARDABOSQUE,			
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
				if(objetoprevio.status=="repetido")
				{
					bootbox.alert(objetoprevio.mensaje, function()
					{				
						//document.location.reload();				
					});				
				}				
			}
			

			console.log(val); return;

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
					  url: "eliminarGuardabosques",
					  type: 'POST',
					  data:{ID__GUARDABOSQUE:ID__GUARDABOSQUE}						  
					}).done(function(val) 
					{					
						alert(val)	 
						document.location.reload();
					});											
				}					
			}
	})
}
