
//* Base*/
var ID__EMPRESA=0;
var ID__COLONIA=0;
var ID__DOMICILIO=0;
var ID__DATA__PATROCINIO=0;
var ID__DONACION=0;
var ID__SEGUIMIENTO=0;

$("#iptFotoEspecie").fileinput({
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
	$(".nav-tabs a").click(function () {
		$(this).tab('show');
	});

	$("#btnAgregar").click(function () 
	{
		$("#tablaespecies tr").removeClass("success");
		ID__EMPRESA=0;
		
		document.getElementById("btnGeneraPass").disabled=true;
		$('#agregarModificar').show();
		var posicion = $("#agregarModificar").offset().top;
		$("html, body").animate({
			scrollTop: posicion
		}, 2000)	
	});
	$("#btnEditar").click(function () 
	{
		if(ID__EMPRESA!=0)		
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
		ID__EMPRESA=$(this).attr('id');				
	});
}

function inicializadorPatrocinios()
{
	$("#tablaPatrocinios").on('click', 'tr' , function (event) 
	{				
		ID__DATA__PATROCINIO=$(this).attr('id');					
		for (var index = 0; index < arrayTablaPatrocinios.length; ++index) 
		{			
			if("rowpatrocinador"+arrayTablaPatrocinios[index].ID_ROW==ID__DATA__PATROCINIO)
			{				
				$("#fechaInicioPatrocinio").val(arrayTablaPatrocinios[index].FEC_FECHAINICIO);
				$("#fechafinPatrocinio").val(arrayTablaPatrocinios[index].FEC_FECHAFIN);				
				$("#cantidadPatrocinio").val(arrayTablaPatrocinios[index].NUM_CANTIDAD);	
				$("#tipoPatrocinio").val(arrayTablaPatrocinios[index].ID__PATROCINIO);		
				
				
				$("#tipoPatrocinioDesc").val(arrayTablaPatrocinios[index].ID__PATROCINIO);
				$("#tipoDonacion").val(arrayTablaPatrocinios[index].VCH_TIPOPERIODO);
				$("#formapagoDonacion").val(arrayTablaPatrocinios[index].VCH_FORMAPAGO);
				$("#tipoSeguimiento").val(arrayTablaPatrocinios[index].VCH_TIPOSEGUIMIENTO);
				$("#responsableSeguimiento").val(arrayTablaPatrocinios[index].ID__USUARIO_RESPONSABLE);
				//objPatrocinios.ID_textoPatrocinio=$("#tipoPatrocinio option:selected").text();
			}			
		}
	});
}
function inicializadorDonacion()
{
	$("#tablaDonacion").on('click', 'tr' , function (event) 
	{				
		ID__DONACION=$(this).attr('id');					
		for (var index = 0; index < arraytablaDonacion.length; ++index) 
		{			
			if("rowdonacion"+arraytablaDonacion[index].ID_ROW==ID__DONACION)
			{												
				$("#tipoDonacion").val(arraytablaDonacion[index].VCH_TIPOPERIODO)
				$("#formapagoDonacion").val(arraytablaDonacion[index].VCH_FORMAPAGO);		
				$("#periodicaDonacion").val(arraytablaDonacion[index].VCH_DONACIONPERIODICA);
				$("#economicaDonacion").val(arraytablaDonacion[index].NUM_TOTALDONACION);		
				$("#InicioDonacion").val(arraytablaDonacion[index].FEC_FECHAINICIO);
				$("#FinDonacion").val(arraytablaDonacion[index].FEC_FECHAINICIO);
				$("#otrosDonacion").val(arraytablaDonacion[index].VCH_OTROTIPO);															
			}			
		}
	});
}
function inicializadorSeguimiento()
{
	$("#tablaSeguimiento").on('click', 'tr' , function (event) 
	{				
		ID__SEGUIMIENTO=$(this).attr('id');					
		for (var index = 0; index < arraytablaSeguimiento.length; ++index) 
		{			
			if("rowSeguimiento"+arraytablaSeguimiento[index].ID_ROW==ID__SEGUIMIENTO)
			{				
				$("#observacionesSeguimiento").val(arraytablaSeguimiento[index].VCH_ACUERDOS);
				$("#FechaSeguimiento").val(arraytablaSeguimiento[index].FEC_FECHA);				
				$("#responsableSeguimiento").val(arraytablaSeguimiento[index].ID__USUARIO);	
				$("#tipoSeguimiento").val(arraytablaSeguimiento[index].VCH_TIPO);					
			}			
		}
	});
}

inicializador();
inicializadorPatrocinios();
inicializadorDonacion();
inicializadorSeguimiento();


function GeneraPass()
{
	alert("click");
}

function cargarDatos()
{			
	$.ajax({
		  url: "cargarEmpresaInstitucion",
		  type: 'POST',
		  data:{					
				ID__EMPRESA: ID__EMPRESA					
			  }						  
		}).done(function(val) 
		{					
			console.log(val);
			objetoprevio=JSON.parse(val);				
			
			var empresa=objetoprevio.empresa[0];
			var empaquetadoP=objetoprevio.empaquetadoP;
			var empaquetadoD=objetoprevio.empaquetadoD;
			var empaquetadoS=objetoprevio.empaquetadoS;
			
		
			try
			{
				ID__DOMICILIO=empresa.ID__DOMICILIO;			
			}
			catch(e)
			{
				ID__DOMICILIO=0;			
			}			
			try
			{
			ID__COLONIA=empresa.ID__COLONIA;						
			}
			catch(e)
			{
				ID__COLONIA=0;						
			}
			
			$('#form_VCH_NOMBREEMPRESA').val(empresa.VCH_NOMBREEMPRESA);
			$('#form_VCH_RFC').val(empresa.VCH_RFC);
			$('#form_VCH_PERSONACONTACTO').val(empresa.VCH_PERSONACONTACTO);			
			$('#form_VCH_PUESTOCONTACTO').val(empresa.VCH_PUESTOCONTACTO);			
			$('#form_VCH_CORREO').val(empresa.VCH_CORREO);
			$('#form_VCH_TELEFONO').val(empresa.VCH_TELEFONO);			
			$('#form_VCH_GIROEMPRESA').val(empresa.VCH_GIROEMPRESA);			
			$('#form_VCH_CELULAR').val(empresa.VCH_CELULAR);
			$('#form_NUM_EMPLEADOS').val(empresa.NUM_EMPLEADOS);			
			$('#form_VCH_COMENTARIOS').val(empresa.VCH_COMENTARIOS);			
			$('#divDomicilio-calle').val(empresa.VCH_CALLE);
			$('#divDomicilio-entre').val(empresa.VCH_ENTRECALLE);	
			$('#divDomicilio-estado').val(empresa.estado);
			$('#divDomicilio-municipio').val(empresa.municipio);	
			$('#divDomicilio-cp').val(empresa.VCH_CODIGOPOSTAL);
			$('#divDomicilio-colonia').val(empresa.colonia);	
			
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
			
			PatrociniosAuxiliarRows=0;						
			$('#tablaPatrocinios').bootstrapTable('destroy');				
			$("#tablaPatrocinios tbody").children().remove()
			for(i=0;i<empaquetadoP.length;i++)
			{
				empaquetadoP[i].ID_ROW=PatrociniosAuxiliarRows;
				empaquetadoP[i].FEC_FECHAINICIO=empaquetadoP[i].FEC_FECHAINICIO.split(" ")[0];
				empaquetadoP[i].FEC_FECHAINICIO=acomodarfechavista(empaquetadoP[i].FEC_FECHAINICIO);
				empaquetadoP[i].FEC_FECHAFIN=empaquetadoP[i].FEC_FECHAFIN.split(" ")[0];
				empaquetadoP[i].FEC_FECHAFIN=acomodarfechavista(empaquetadoP[i].FEC_FECHAFIN);
				empaquetadoP[i].VCH_DESCRIPCION=empaquetadoP[i].VCH_DESCRIPCION;
				
/*				empaquetadoP[i].VCH_TIPOPERIODO=$("#tipoDonacion").val();
				empaquetadoP[i].VCH_FORMAPAGO=$("#formapagoDonacion").val();
				empaquetadoP[i].VCH_TIPOSEGUIMIENTO=$("#tipoSeguimiento").val();
				empaquetadoP[i].ID__USUARIO_RESPONSABLE=$("#responsableSeguimiento").val();
				
				aca*/
				$('#tablaPatrocinios').append('<tr id="rowpatrocinador'+PatrociniosAuxiliarRows+'" ><td>'+empaquetadoP[i].ID_textoPatrocinio+'</td><td>'+empaquetadoP[i].VCH_DESCRIPCION+'</td><td>'+empaquetadoP[i].NUM_CANTIDAD+'</td><td>'+empaquetadoP[i].FEC_FECHAINICIO+'</td><td>'+empaquetadoP[i].FEC_FECHAFIN+'</td></tr>');
				PatrociniosAuxiliarRows++;
			}			
			setTimeout(function(){
					$('#tablaPatrocinios').bootstrapTable();	 
			}, 1000);
			arrayTablaPatrocinios=empaquetadoP;
						
						

						
			
			DonacionAuxiliarRows=0;
			$('#tablaDonacion').bootstrapTable('destroy');	
			$("#tablaDonacion tbody").children().remove()
			for(i=0;i<empaquetadoD.length;i++)
			{
				empaquetadoD[i].ID_ROW=DonacionAuxiliarRows;
				empaquetadoD[i].FEC_FECHAINICIO=empaquetadoD[i].FEC_FECHAINICIO.split(" ")[0];
				empaquetadoD[i].FEC_FECHAINICIO=acomodarfechavista(empaquetadoD[i].FEC_FECHAINICIO);
				empaquetadoD[i].FEC_FECHAFIN=empaquetadoD[i].FEC_FECHAFIN.split(" ")[0];
				empaquetadoD[i].FEC_FECHAFIN=acomodarfechavista(empaquetadoD[i].FEC_FECHAFIN);
				$('#tablaDonacion').append('<tr id="rowdonacion'+DonacionAuxiliarRows+'" ><td>'+empaquetadoD[i].VCH_DONACIONPERIODICA+'</td><td>'+empaquetadoD[i].VCH_TIPOPERIODO+'</td><td>'+empaquetadoD[i].NUM_TOTALDONACION+'</td><td>'+empaquetadoD[i].FEC_FECHAINICIO+'</td><td>'+empaquetadoD[i].VCH_FORMAPAGO+'</td><td>'+empaquetadoD[i].VCH_OTROTIPO+'</td></tr>');
				DonacionAuxiliarRows++;
			}		
			setTimeout(function(){
				$('#tablaDonacion').bootstrapTable();	
			}, 1000);
			arraytablaDonacion=empaquetadoD;

			;


			
			SeguimientoAuxiliarRows=0;
			$('#tablaSeguimiento').bootstrapTable('destroy');	
			$("#tablaSeguimiento tbody").children().remove()			
			for(i=0;i<empaquetadoS.length;i++)
			{
				empaquetadoS[i].ID_ROW=SeguimientoAuxiliarRows;												
				empaquetadoS[i].FEC_FECHA=empaquetadoS[i].FEC_FECHA.split(" ")[0];
				empaquetadoS[i].FEC_FECHA=acomodarfechavista(empaquetadoS[i].FEC_FECHA);
				
				$('#tablaSeguimiento').append('<tr id="rowSeguimiento'+SeguimientoAuxiliarRows+'" ><td>'+empaquetadoS[i].VCH_ACUERDOS+'</td><td>'+empaquetadoS[i].VCH_TIPO+'</td><td>'+empaquetadoS[i].responsable+'</td><td>'+empaquetadoS[i].FEC_FECHA+'</td></tr>');
				SeguimientoAuxiliarRows++;
			}					
			setTimeout(function(){
					$('#tablaSeguimiento').bootstrapTable();	
			}, 1000);
			arraytablaSeguimiento=empaquetadoS;
												
																
		});		
}
function acomodarfechavista(cadena)
{
	cadena=cadena.split("-");
	return(cadena[2]+"/"+cadena[1]+"/"+cadena[0]);
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
	if(ID__EMPRESA==0) 
	{
		urlMetodo="altaEmpresaInstitucion";	
	}
	else
	{		
		urlMetodo="editarEmpresaInstitucion";
	}	
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}
	

	$("#empaquetadoP").val(JSON.stringify(arrayTablaPatrocinios));
	$("#empaquetadoD").val(JSON.stringify(arraytablaDonacion));	
	$("#empaquetadoS").val(JSON.stringify(arraytablaSeguimiento));
	$("#ID__COLONIA").val(ID__COLONIA);
	
	$("#ID__EMPRESA").val(ID__EMPRESA);
	$("#ID__DOMICILIO").val(ID__DOMICILIO);		
	
	$('#formGeneralEmpresa').attr('action', urlMetodo);	
	$("#formGeneralEmpresa" ).submit();			
}
function eliminar()
{	
	if(ID__EMPRESA!=0)
	{
		bootbox.confirm
		({
				message: "esta seguro que desea borrarlo?",
				callback: function (val) 
				{
					if(val)
					{
						$.ajax({
						  url: "eliminarEmpresaInstitucion",
						  type: 'POST',
						  data:{ID__EMPRESA:ID__EMPRESA}						  
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
		bootbox.alert("Por favor selecciona la empresa o institucion");
	}
	
}

var arrayTablaPatrocinios=[];	//arrayTablaPatrocinios=[{"ID__PATROCINIO":"Caoba","NUM_CANTIDAD":"1","FEC_FECHAINICIO":"02/05/2017","FEC_FECHAFIN":"31/05/2017","ID_ROW":0},{"ID__PATROCINIO":"Economico","NUM_CANTIDAD":"2","FEC_FECHAINICIO":"02/05/2017","FEC_FECHAFIN":"31/05/2017","ID_ROW":1},{"ID__PATROCINIO":"---","NUM_CANTIDAD":"3","FEC_FECHAINICIO":"02/05/2017","FEC_FECHAFIN":"31/05/2017","ID_ROW":2}]
var PatrociniosAuxiliarRows=0;
function agregarTablaPatrocinios()
{	
	var objPatrocinios = 
		{
			ID__PATROCINIO:"",		NUM_CANTIDAD:"",	FEC_FECHAINICIO:"",		FEC_FECHAFIN:"",		
			ID_textoPatrocinio:"", VCH_DESCRIPCION:"",
			VCH_TIPOPERIODO:"",VCH_FORMAPAGO:"",VCH_TIPOSEGUIMIENTO:"",ID__USUARIO_RESPONSABLE:"",
			ID_ROW:"" //Usare este identificador para hacer match con la tabla
		};
	valido=true;
	
	$( ".requiredPatrocinios" ).each(function() 
	{
		if($(this).val()=='')
		{
			valido=false;
		}		
	});
	
	if(valido)
	{			
		if(ID__DATA__PATROCINIO!=0)
		{			
			$('#tablaPatrocinios').bootstrapTable('destroy');	
			$('#'+ID__DATA__PATROCINIO).remove();	
			$('#tablaPatrocinios').bootstrapTable();	
									
			for (var index = 0; index < arrayTablaPatrocinios.length; ++index) 
			{			
				if("rowpatrocinador"+arrayTablaPatrocinios[index].ID_ROW==ID__DATA__PATROCINIO)
				{				
					arrayTablaPatrocinios.splice(index, 1);									
				}			
			}			
		}
		
												
		$('#tablaPatrocinios').bootstrapTable('destroy');	
		objPatrocinios.FEC_FECHAINICIO=$("#fechaInicioPatrocinio").val();
		objPatrocinios.FEC_FECHAFIN=$("#fechafinPatrocinio").val();				
		objPatrocinios.NUM_CANTIDAD=$("#cantidadPatrocinio").val();	
		objPatrocinios.ID__PATROCINIO=$("#tipoPatrocinio").val();				//este es aparentemente el tipo de patrocinio...										
		objPatrocinios.ID_textoPatrocinio=$("#tipoPatrocinio option:selected").text();
		objPatrocinios.VCH_DESCRIPCION=$("#tipoPatrocinioDesc").val();
		
		objPatrocinios.VCH_TIPOPERIODO=$("#tipoDonacion").val();
		objPatrocinios.VCH_FORMAPAGO=$("#formapagoDonacion").val();
		objPatrocinios.VCH_TIPOSEGUIMIENTO=$("#tipoSeguimiento").val();
		objPatrocinios.ID__USUARIO_RESPONSABLE=$("#responsableSeguimiento").val();
		
		objPatrocinios.ID_ROW=PatrociniosAuxiliarRows;
		
		$('#tablaPatrocinios').append('<tr id="rowpatrocinador'+PatrociniosAuxiliarRows+'" ><td>'+$("#tipoPatrocinio option:selected").text()+'</td><td>'+$("#tipoPatrocinioDesc").val()+'</td><td>'+$("#cantidadPatrocinio").val()+'</td><td>'+$("#fechaInicioPatrocinio").val()+'</td><td>'+$("#fechafinPatrocinio").val()+'</td></tr>');
		arrayTablaPatrocinios.push(objPatrocinios);		
		PatrociniosAuxiliarRows++;
		$('#tablaPatrocinios').bootstrapTable();	
		
		ID__DATA__PATROCINIO=0;		
		document.getElementById("formPatrocinios").reset();
	}
	
	
}

var arraytablaDonacion=[];
var DonacionAuxiliarRows=0;
function agregartablaDonacion()
{
	var objDonacion = 
		{
			ID__DONACION:"",		VCH_TIPOPERIODO:"", VCH_FORMAPAGO:"" ,VCH_DONACIONPERIODICA:"",NUM_TOTALDONACION:"",
			FEC_FECHAINICIO:"",		FEC_FECHAFIN:"",					VCH_OTROTIPO:"", 
			tipoperiodo_texto:"",formapago_texto:"",
			
			ID_ROW:"" //Usare este identificador para hacer match con la tabla
		};
	valido=true;
	
	$( ".requiredDonacion" ).each(function() 
	{
		if($(this).val()=='')
		{
			valido=false;
		}		
	});
	
	if(valido)
	{			
		if(ID__DONACION!=0)
		{			
			$('#tablaDonacion').bootstrapTable('destroy');	
			$('#'+ID__DONACION).remove();	
			$('#tablaDonacion').bootstrapTable();	
									
			for (var index = 0; index < arraytablaDonacion.length; ++index) 
			{			
				if("rowdonacion"+arraytablaDonacion[index].ID_ROW==ID__DONACION)
				{				
					arraytablaDonacion.splice(index, 1);									
				}			
			}			
		}														
		$('#tablaDonacion').bootstrapTable('destroy');	
		objDonacion.VCH_TIPOPERIODO=$("#tipoDonacion").val();
		objDonacion.VCH_FORMAPAGO=$("#formapagoDonacion").val();		
		objDonacion.VCH_DONACIONPERIODICA=$("#periodicaDonacion").val();
		objDonacion.NUM_TOTALDONACION=$("#economicaDonacion").val();		
		objDonacion.FEC_FECHAINICIO=$("#InicioDonacion").val();
		objDonacion.FEC_FECHAFIN=$("#FinDonacion").val();
		objDonacion.VCH_OTROTIPO=$("#otrosDonacion").val();							
		objDonacion.ID_ROW=DonacionAuxiliarRows;		
		$('#tablaDonacion').append('<tr id="rowdonacion'+DonacionAuxiliarRows+'"><td>'+$("#periodicaDonacion").val()+'</td><td>'+$("#tipoDonacion option:selected").text()+'</td><td>'+$("#economicaDonacion").val()+'</td><td>'+$("#InicioDonacion").val()+'</td><td>'+$("#formapagoDonacion option:selected").text()+'</td><td>'+$("#otrosDonacion").val()+'</td></tr>');
		arraytablaDonacion.push(objDonacion);		
		DonacionAuxiliarRows++;
		$('#tablaDonacion').bootstrapTable();	
		
		ID__DONACION=0;		
		document.getElementById("formDonaciones").reset();
	}
}

var arraytablaSeguimiento=[];
var SeguimientoAuxiliarRows=0;
function agregartablaSeguimiento()
{
	var objSeguimiento = 
		{
			ID__USUARIO:"",			VCH_ACUERDOS:"",		VCH_TIPO:"",		FEC_FECHA:"",
			ID_ROW:"" //Usare este identificador para hacer match con la tabla
		};
	valido=true;
	
	$( ".requiredSeguimiento" ).each(function() 
	{
		if($(this).val()=='')
		{
			valido=false;
		}		
	});
	
	if(valido)
	{			
		if(ID__SEGUIMIENTO!=0)
		{			
			$('#tablaSeguimiento').bootstrapTable('destroy');	
			$('#'+ID__SEGUIMIENTO).remove();	
			$('#tablaSeguimiento').bootstrapTable();	
									
			for (var index = 0; index < arraytablaSeguimiento.length; ++index) 
			{			
				if("rowSeguimiento"+arraytablaSeguimiento[index].ID_ROW==ID__SEGUIMIENTO)
				{				
					arraytablaSeguimiento.splice(index, 1);									
				}			
			}			
		}
		
												
		$('#tablaSeguimiento').bootstrapTable('destroy');	
				
		objSeguimiento.VCH_ACUERDOS=$("#observacionesSeguimiento").val();			
		objSeguimiento.FEC_FECHA=$("#FechaSeguimiento").val();			
		objSeguimiento.ID__USUARIO=$("#responsableSeguimiento").val();
		objSeguimiento.VCH_TIPO=$("#tipoSeguimiento").val();				
		objSeguimiento.ID_ROW=SeguimientoAuxiliarRows;

		$('#tablaSeguimiento').append('<tr id="rowSeguimiento'+SeguimientoAuxiliarRows+'" ><td>'+$("#observacionesSeguimiento").val()+'</td><td>'+$("#tipoSeguimiento option:selected").text()+'</td><td>'+$("#responsableSeguimiento option:selected").text()+'</td><td>'+$("#FechaSeguimiento").val()+'</td></tr>');
		arraytablaSeguimiento.push(objSeguimiento);		
		SeguimientoAuxiliarRows++;
		$('#tablaSeguimiento').bootstrapTable();	
		
		ID__SEGUIMIENTO=0;		
		document.getElementById("formSeguimiento").reset();
	}
}

