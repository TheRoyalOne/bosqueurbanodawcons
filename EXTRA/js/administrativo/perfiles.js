	
    $('#tree').treeview({data: 	/*getTree()*/ cadenaPermisos, showIcon: false,
      showCheckbox: true});

	function eliminar(id,row)
	{
		tr=row;
		if(id==1)
		{
			bootbox.alert("Por su seguridad no es posible borrar el administrador principal");
			return;
		}
		bootbox.confirm
		({
				message: "esta seguro que desea borrarlo?",
				callback: function (val) 
				{
					if(val)
					{
						$.ajax({
						  url: "eliminarPerfil",
						  type: 'POST',
						  data:{ID__PERFIL:id}						  
						}).done(function(val) 
						{					
							alert(val)	 
							tr=row.remove();
						});
						
						
					}
					
				}
		})
	}
	var objetoprevio;
	function cargarmodificar(id,row)
	{		
		if(id==1)
		{
			bootbox.alert("Por su seguridad no es posible modificar el administrador principal");
			return;
		}
		$("#ID__PERFIL").val(id);
		$.ajax({
			  url: "cargarPerfil",
			  type: 'POST',
			  data:{					
					ID__PERFIL: id					
				  }						  
			}).done(function(val) 
			{								
				objetoprevio=JSON.parse(val)
				$("#VCH_NOMBRE").val(objetoprevio.general[0].VCH_NOMBRE);				
				if(objetoprevio.general[0].VCH_ESTATUS==1)
				{
					document.getElementById("activo").click();
				}
				else
				{					
					document.getElementById("inactivo").click();
				}	
				var permisosprevios=objetoprevio.Permisos;
				$('#tree').treeview('expandAll', { levels: 2, silent: true });
				$('#tree').treeview('uncheckAll', { silent: true });
				for(i=0; i< permisosprevios.length; i++)
				{					
					console.log(permisosprevios[i].ID__PERMISO);
					$("li[id__permiso=" + permisosprevios[i].ID__PERMISO +"]").children()[2].click();
				}
																		
			});		
		
		//alert(id);
	}
	
	/*
    function getTree() 
    {				 	
	  tree = [
      {
        text: "Administrativo",
        state: {expanded:false},
        nodes:[
        {text: "Perfiles"},
        {text: "Agregar Perfil"},
        {text: "Editar Perfil"},
        {text: "Eliminar Perfil"},
        {text: "Usuarios"},
        {text: "Eliminar Especies"},
        {text: "Editar Usuarios"},
        {text: "Eliminar Usuarios"},
        {text: "Especies"},
        {text: "Buscar Especies"},
        {text: "Agregar Especies"},
        {text: "Editar Especies"},
        {text: "Agregar Usuarios"}
        ]
    },
    {
        text: "Catalogos de Precios por Especies",
        state: {expanded:false},
        nodes:[
        {text: "Bosque Urbano"},
        {text: "Eventos de Adopci??n"},
        {text: "Buscar Eventos de Adopci??n"},
        {text: "Agregar Eventos de Adopci??n"},
        {text: "Editar Eventos de Adopci??n"},
        {text: "Eliminar Eventos de Adopci??n"},
        {text: "Guardabosque"},
        {text: "Buscar Guardabosque"},
        {text: "Agregar Guardabosque"},
        {text: "Editar Guardabosque"},
        {text: "Eliminar Guardabosque"},
        {text: "Generar Nueva Contrase??a Guardabosque"},
        {text: "Registro de Adopci??n"},
        {text: "Buscar Registro de Adopci??n"},
        {text: "Agregar Registro de Adopci??n"},
        {text: "Cambia Guardabosques al Registro de Adopci??n"},
        {text: "Eliminar Registro de Adopci??n"},
        {text: "Empresas/Instituciones"},
        {text: "Buscar Empresas/Instituciones"},
        {text: "Agregar Empresas/Instituciones"},
        {text: "Editar Empresas/Instituciones"},
        {text: "Eliminar Empresas/Instituciones"},
        {text: "Generar Nueva Contrase??a Empresas/Instituciones"},
        {text: "Instituciones Edicativas - Embajadores"},
        {text: "Buscar Instituciones Educativas"},
        {text: "Agregar Instituciones Educativas"},
        {text: "Editar Instituciones Educativas"},
        {text: "Eliminar Instituciones Educativas"},
        {text: "Embajadores"},
        {text: "Buscar Embajadores"},
        {text: "Agregar Embajadores"},
        {text: "Editar Embajadores"},
        {text: "Eliminar Embajadores"},
        {text: "Generar Nueva Contrase??a Embajadores"},
        {text: "Inventario"},
        {text: "Registrar ??rbol"},
        {text: "Asignaiones Adop/Adop-Mul/Reforestaciones"},
        {text: "Asignar Adopciones Embajador"},
        {text: "Asignar Adopciones M??ltiples Embajador"},
        {text: "Asignar Reforestaciones Embajador"},
        {text: "Blog"},
        {text: "Responder Preguntas del Blog"},
        {text: "Eventos de Reforestaci??n"},
        {text: "Agregar Eventos de Reforestaci??n"},
        {text: "Editar Eventos de Reforestaci??n"},
        {text: "Eliminar Eventos de Reforestaci??n"},
        {text: "Solicitudes de Adopci??n M??ltiple"},
        {text: "Agregar Solicitudes de Adopci??n M??ltiple"},
        {text: "Tipos de Patrocinio"},
        {text: "Agregar Tipos de Patrocinio"},
        {text: "Editar Tipos de Patrocinio"},
        {text: "Eliminar Tipos de Patrocinio"},
        {text: "Puntos Ganados"},
        {text: "Consultar Puntos Ganados"},
        {text: "Actualizar Ubicaci??n de los ??rboles"},
        {text: "Catalogos Baja de ??rboles"},
        {text: "Mapa de ??rboles"},
        {text: "Solicitudes de Adopci??n M??ltiple Guardabosque"},
        {text: "Patrocinador ??rbol"},
        {text: "Alta de vales"},
        {text: "Catalogos de Ubicaciones"}
        ]
    },
    {
        text: "Principal",
        state: {expanded:false},
        nodes:[
        {text: "Ver Avisos"},
        {text: "Avisos Seguimientos Empresa"},
        {text: "Avisos Donaciones Empresa"},
        {text: "Avisos Patrocinios Empresa"},
        {text: "Ver Detalle de Estad??sticas"},
        {text: "Ver Estad??sticas"},
        {text: "Editar Avisos"}
        ]
    },
    {
        text: "Reporte de Seguimiento a Adopciones",
        state: {expanded:false},
        nodes:[
        {text: "Reporte de Seguimiento a Adopciones"},
        {text: "Reporte de Inventario por Especie"},
        {text: "Reportes"},
        {text: "Reporte Adopciones por Patrocinador"},
        {text: "Reporte Patrocinios Empresa"},
        {text: "Rep. Seg. a Adop. M??ltiples y Reforestaciones"},
        {text: "Reporte de Adopciones por Empresa"}
        ]
    },
    ];
    return tree;
	}*/
	
	function getPermisosSeleccionados()
	{
		var arrayPermisos=[];
		var checkeds=$('#tree').treeview('getChecked');
		for(i=0; i<=checkeds.length-1;i++)
		{
			console.log(checkeds[i]);
			arrayPermisos.push(checkeds[i].ID__PERMISO);			
		}				
		return arrayPermisos;
	}
	
	
	
	function guardarPerfil()
	{	
		if(($("input[name=optradio]").is(":checked"))&&( $("#VCH_NOMBRE").val()!=''))
		{						
			$.ajax({
			  url: "guardarPerfil",
			  type: 'POST',
			  data:{
					permisos:getPermisosSeleccionados(),
					ID__PERFIL: $("#ID__PERFIL").val(),
					VCH_NOMBRE: $("#VCH_NOMBRE").val(),
					VCH_ESTATUS: $("input[id=activo]").is(":checked")
				  }						  
			}).done(function(val) 
			{					
				alert(val)	 			
			});					
		}	
		else
		{
			bootbox.alert("Faltan datos obligatorios");
		}								
	}

