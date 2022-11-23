var ID__USUARIO=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;

function inicializador()
{
	$('#btnAgregarUsuario').click(function()
	{	
		$('#buscarUsuarios').prop('hidden',true);
		$('#catalogoUsuarios').prop('hidden',false);
	});
	$('#agregarColoniab').click(function()
	{	
		$('#buscadorColonias').prop('hidden',true);
		$('#agregarColonia').prop('hidden',false);
		
		$('#agregarColonia').removeAttr("hidden");
	});
	$('#buscarColoniab').click(function()
	{					
		buscarColonia();
	});
	$('#btnModificarUsuario').click(function()
	{	
		if(ID__USUARIO!=0)		
		{
			cargarDatosUsuario();			
			$('#buscarUsuarios').prop('hidden',true);
			$('#catalogoUsuarios').prop('hidden',false);
		}
		else
		{
			bootbox.alert("Por favor selecciona el usuario a modificar");
		}
	});
	

	$('#chkDomicilio').click(function(){
		if($(this).is(':checked')){
		  $('#catalogoUsuarios').prop('hidden',true);
		  $('#buscadorColonias').prop('hidden',false);
		  $('#divDomicilio').prop('hidden',false);
	   }
	   else
		  $('#divDomicilio').prop('hidden',true);
	});

	$('#btnRegresarCatUsuarios').click(function(){
		$('#buscarUsuarios').prop('hidden',false);
		$('#catalogoUsuarios').prop('hidden',true);
	});
	/*
	$('table #tablaus').on('click', 'tr' , function (event) 
	{
		ID__USUARIO=$(this).attr('id');		
		ID__DOMICILIO=$(this).attr('data-ID__DOMICILIO');						
	});*/
	$("#tablaus").on('click', 'tr' , function (event) 
	{		
		ID__USUARIO=$(this).attr('id');		
		ID__DOMICILIO=$(this).attr('data-ID__DOMICILIO');						
	});
	
}
inicializador();

function seleccionarColonia(idcolonia,estado,municipio,colonia,cp)
{
	//alert(ID__USUARIO);
	ID__COLONIA=idcolonia;
	$("#divDomicilio-estado").val(estado);	
	$("#divDomicilio-municipio").val(municipio);	
	$("#divDomicilio-cp").val(colonia);	
	$("#divDomicilio-colonia").val(cp);		
	
	$('#catalogoUsuarios').prop('hidden',false);
	$('#buscadorColonias').prop('hidden',true);
	//alert(ID__USUARIO);
	//ID__USUARIO=0;
	
}
function realizaBusqueda()
{
	
	$("#buscarUsuarios").html();	
	$.ajax({
			  url: "usuarios",
			  type: 'POST',
			  data:{					
					VCH_NOMBRE			:$("#BUSQUEDA_VCH_NOMBRE").val(),
					VCH_APELLIDOPATERNO:$("#BUSQUEDA_VCH_APELLIDOPATERNO").val(),
					VCH_APELLIDOMATERNO:$("#BUSQUEDA_VCH_APELLIDOMATERNO").val(),
					VCH_PUESTO:$("#BUSQUEDA_VCH_PUESTO").val(),
					VCH_ESTATUS:$("#BUSQUEDA_VCH_ESTATUS").val()			
				  }						  
			}).done(function(val) 
			{					
				$("#buscarUsuarios").html(val);	
				$('[data-toggle="table"]').bootstrapTable();												
				inicializador();
			});			
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
function eliminarUsuario(row)
{
	if(ID__USUARIO!=0)		
	{
		bootbox.confirm
		({
				message: "esta seguro que desea borrarlo?",
				callback: function (val) 
				{
					if(val)
					{
						$.ajax({
						  url: "eliminarUsuario",
						  type: 'POST',
						  data:{ID__USUARIO:ID__USUARIO}						  
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
		bootbox.alert("Por favor selecciona el usuario");
	}	
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
		$('#agregarColonia').prop('hidden',true);				
		$('#buscadorColonias').prop('hidden',false);
		
	});
}
function buscarColonia()
{	
	
	
	$.ajax({
	  url: "buscaColonia",
	  type: 'POST',
	  data:{
				ID__ESTADO:$('#buscadorColonias-estado').val(),
				ID__MUNICIPIO:$('#buscadorColonias-ciudad').val(),
				VCH_NOMBRE:$('#buscadorColonias-colonia').val(),
				VCH_CODIGOPOSTAL:$('#buscadorColonias-cp').val()
			}						  
	}).done(function(val) 
	{	
		$("#buscadorColonias").html(val);	
		$('[data-toggle="table"]').bootstrapTable();												
		inicializador();
		//$('#agregarColonia').prop('hidden',true);				
		//$('#buscadorColonias').prop('hidden',false);		
	});	
}
function cancelaraltaColonia()
{
	$('#agregarColonia').prop('hidden',true);				
	$('#buscadorColonias').prop('hidden',false);
}
function AltaUsuario()
{
	var valido=true;
	$( ".required" ).each(function() 
	{
		if($(this).val()=='')
		{
			valido=false;
		}
		//console.log($(this).name()+" - "+$(this).val());
		//console.log(index, $(elem).val());
	});
	
	if($("input[name='optradio']:checked").val()==undefined)
	{
		valido=false;
	}
	
	var urlMetodo;
	if(ID__USUARIO==0) 
	{
		urlMetodo="altaUsuarioPerfil";
	}
	else
	{
		urlMetodo="editarUsuarioPerfil";
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
			ID__USUARIO:ID__USUARIO,
			ID__PERFIL:$('#Form_ID__PERFIL').val(),
			VCH_NOMBRE:$('#Form_VCH_NOMBRE').val(),
			VCH_APELLIDOPATERNO:$('#Form_VCH_APELLIDOPATERNO').val(),
			VCH_APELLIDOMATERNO:$('#Form_VCH_APELLIDOMATERNO').val(),
			VCH_CORREO:$('#Form_VCH_CORREO').val(), 
			VCH_TELEFONO:$('#Form_VCH_TELEFONO').val(),
			VCH_CELULAR:$('#Form_VCH_CELULAR').val(),
			VCH_PUESTO:$('#Form_VCH_PUESTO').val(),
			VCH_ESTATUS:$("input[name='optradio']:checked").val(),
			VCH_USUARIO:$('#Form_VCH_USUARIO').val(),
			VCH_PASSWORD:$('#Form_VCH_PASSWORD').val(),
			VCH_OBSERVACIONES:$('#Form_VCH_OBSERVACIONES').val(),			
			ID__DOMICILIO:ID__DOMICILIO,
			
			VCH_CALLE:$('#divDomicilio-calleynumero').val(),
			VCH_ENTRECALLE:$('#divDomicilio-VCH_ENTRECALLE').val(),			
			ID__COLONIA:ID__COLONIA
		   }						  
	}).done(function(val) 
	{		
		console.log(val);				
		if(val==1)
		{
			bootbox.alert("El usuario se guardo exitosamente", function()
			{
				$('#buscarUsuarios').prop('hidden',false);
				$('#catalogoUsuarios').prop('hidden',true);
				
				document.getElementById("formaltaus").reset()
				ID__USUARIO=0;
				ID__COLONIA=0;
				ID__DOMICILIO=0;
				inicializador();
			});
			
		}
		if(val==2)
		{
			bootbox.alert("el usuario ya existe");
		}
	});	
}
var objetoprevio;
function cargarDatosUsuario()
{	
	$.ajax({
		  url: "cargarUsuario",
		  type: 'POST',
		  data:{					
				ID__USUARIO: ID__USUARIO					
			  }						  
		}).done(function(val) 
		{					
			console.log(val)			;
			objetoprevio=JSON.parse(val)
			
			
			$('#Form_ID__PERFIL').val(objetoprevio.ID__PERFIL);
			$('#Form_VCH_NOMBRE').val(objetoprevio.VCH_NOMBRE);
			$('#Form_VCH_APELLIDOPATERNO').val(objetoprevio.VCH_APELLIDOPATERNO);
			$('#Form_VCH_APELLIDOMATERNO').val(objetoprevio.VCH_APELLIDOMATERNO);
			$('#Form_VCH_CORREO').val(objetoprevio.VCH_CORREO); 
			$('#Form_VCH_TELEFONO').val(objetoprevio.VCH_TELEFONO);
			$('#Form_VCH_CELULAR').val(objetoprevio.VCH_CELULAR);
			$('#Form_VCH_PUESTO').val(objetoprevio.VCH_PUESTO);						
			$('#Form_VCH_USUARIO').val(objetoprevio.VCH_USUARIO);			
			$('#Form_VCH_OBSERVACIONES').val(objetoprevio.VCH_OBSERVACIONES);			
			ID__DOMICILIO=objetoprevio.ID__DOMICILIO;
			
			$('#divDomicilio-calleynumero').val(objetoprevio.VCH_CALLE);
			$('#divDomicilio-VCH_ENTRECALLE').val(objetoprevio.VCH_ENTRECALLE);			
			ID__COLONIA=objetoprevio.ID__COLONIA;
						
			
			if(objetoprevio.VCH_ESTATUS==1)
			{
				document.getElementById("Form_Activo").click();
			}
			else
			{					
				document.getElementById("Form_Inactivo").click();
			}																		
		});		
}
