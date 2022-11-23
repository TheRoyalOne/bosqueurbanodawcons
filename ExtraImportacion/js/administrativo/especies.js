var ID__ESPECIE=0;
function inicializador()
{
	$('#btnAgregarEspecie').click(function(){
		$('#catalogoEspecies').prop('hidden',true);
		$('#agregarModificar').prop('hidden',false);
	});
	$('#btnModificarEspecie').click(function()
	{	
		if(ID__ESPECIE!=0)		
		{
			cargarDatosEspecie();			
			$('#catalogoEspecies').prop('hidden',true);
			$('#agregarModificar').prop('hidden',false);
		}
		else
		{
			bootbox.alert("Por favor selecciona la especie a modificar");
		}
	});
	$('#btnCancelarEspecie').click(function(){
		$('#catalogoEspecies').prop('hidden',false);
		$('#agregarModificar').prop('hidden',true);
	});
	
	$("#tablaespecies").on('click', 'tr' , function (event) 
	{		
		ID__ESPECIE=$(this).attr('id');				
	});
}
inicializador();

var files;
$('input[type=file]').on('change', prepareUpload);
function prepareUpload(event)
{
  files = event.target.files;
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
	if(ID__ESPECIE==0) 
	{
		urlMetodo="altaEspecie";	
	}
	else
	{		
		urlMetodo="editarEspecie";
	}
	$("#idEspecie").val(ID__ESPECIE);	
			
	
	if(valido==false)
	{
		bootbox.alert("Favor de llenar los datos obligatorios");
		return;
	}		
	$('#form-especie').attr('action', urlMetodo);
	//bootbox.alert("Guardado exitosamente",function(){
		$("#form-especie" ).submit();	
		//});
	
	/*
	$.ajax({
	  url: urlMetodo,
	  type: 'POST',
	  
	  processData:false,contentType:false,
	  
	  data:{
			ID__ESPECIE:ID__ESPECIE,
			VCH_NOMBRECOMUN:$('#form_VCH_NOMBRECOMUN').val(),
			VCH_NOMBRECIENTIFICO:$('#form_VCH_NOMBRECIENTIFICO').val(),
			VCH_ESTATUS:$("input[name='optradio']:checked").val(),
			VCH_OBSERVACIONES:$('#form_VCH_OBSERVACIONES').val(),
			VCH_URLREFERENCIA:$('#form_VCH_URLREFERENCIA').val(), 
			NUM_PRIMERPERIODO:$('#form_NUM_PRIMERPERIODO').val(),
			NUM_SEGUNDOPERIODO:$('#form_NUM_SEGUNDOPERIODO').val(),
			NUM_TERCERPERIODO:$('#form_NUM_TERCERPERIODO').val(),
			NUM_CUARTOPERIODO:$("form_NUM_CUARTOPERIODO").val(),
						
			NUM_INVENTARIO:0,
			NUM_ADOPCIONES:0,
			VCH_FOTO:$('#iptFotoEspecie').val(),		
			file:files				
			
		   }						  
	}).done(function(val) 
	{		
		bootbox.alert(val, function()
		{
			console.log(val);
			return;
			$('#catalogoEspecies').prop('hidden',false);
			$('#agregarModificar').prop('hidden',true);
			document.getElementById("form-especie").reset()
			ID__ESPECIE=0;			
			inicializador();
		});
							
	});	*/
}
function eliminarEspecie()
{	
	bootbox.confirm
	({
			message: "esta seguro que desea borrarlo?",
			callback: function (val) 
			{
				if(val)
				{
					$.ajax({
					  url: "eliminarEspecie",
					  type: 'POST',
					  data:{ID__ESPECIE:ID__ESPECIE}						  
					}).done(function(val) 
					{					
						alert(val)	 
						document.location.reload();
					});											
				}					
			}
	})
}

function cargarDatosEspecie()
{	
	$.ajax({
		  url: "cargarEspecie",
		  type: 'POST',
		  data:{					
				ID__ESPECIE: ID__ESPECIE					
			  }						  
		}).done(function(val) 
		{					
			console.log(val)			;
			objetoprevio=JSON.parse(val)
						
			$('#form_VCH_NOMBRECOMUN').val(objetoprevio.VCH_NOMBRECOMUN);
			$('#form_VCH_NOMBRECIENTIFICO').val(objetoprevio.VCH_NOMBRECIENTIFICO);
			$('#form_VCH_OBSERVACIONES').val(objetoprevio.VCH_OBSERVACIONES);
			$('#form_VCH_URLREFERENCIA').val(objetoprevio.VCH_URLREFERENCIA);
			$('#form_NUM_PRIMERPERIODO').val(objetoprevio.NUM_PRIMERPERIODO); 
			$('#form_NUM_TERCERPERIODO').val(objetoprevio.NUM_TERCERPERIODO);
			$('#form_NUM_SEGUNDOPERIODO').val(objetoprevio.NUM_SEGUNDOPERIODO);
			$('#form_NUM_CUARTOPERIODO').val(objetoprevio.NUM_CUARTOPERIODO);									
			$('#form_VCH_FOTO').val(objetoprevio.VCH_FOTO);										
			
			if(objetoprevio.VCH_ESTATUS==1)
			{
				document.getElementById("form-activo").click();
			}
			else
			{					
				document.getElementById("form-inactivo").click();
			}																		
		});		
}
$("#iptFotoEspecie").fileinput({
    'showUpload': false
});


