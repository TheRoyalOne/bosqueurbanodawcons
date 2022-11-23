	
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
        {text: "Eventos de Adopción"},
        {text: "Buscar Eventos de Adopción"},
        {text: "Agregar Eventos de Adopción"},
        {text: "Editar Eventos de Adopción"},
        {text: "Eliminar Eventos de Adopción"},
        {text: "Guardabosque"},
        {text: "Buscar Guardabosque"},
        {text: "Agregar Guardabosque"},
        {text: "Editar Guardabosque"},
        {text: "Eliminar Guardabosque"},
        {text: "Generar Nueva Contraseña Guardabosque"},
        {text: "Registro de Adopción"},
        {text: "Buscar Registro de Adopción"},
        {text: "Agregar Registro de Adopción"},
        {text: "Cambia Guardabosques al Registro de Adopción"},
        {text: "Eliminar Registro de Adopción"},
        {text: "Empresas/Instituciones"},
        {text: "Buscar Empresas/Instituciones"},
        {text: "Agregar Empresas/Instituciones"},
        {text: "Editar Empresas/Instituciones"},
        {text: "Eliminar Empresas/Instituciones"},
        {text: "Generar Nueva Contraseña Empresas/Instituciones"},
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
        {text: "Generar Nueva Contraseña Embajadores"},
        {text: "Inventario"},
        {text: "Registrar Árbol"},
        {text: "Asignaiones Adop/Adop-Mul/Reforestaciones"},
        {text: "Asignar Adopciones Embajador"},
        {text: "Asignar Adopciones Múltiples Embajador"},
        {text: "Asignar Reforestaciones Embajador"},
        {text: "Blog"},
        {text: "Responder Preguntas del Blog"},
        {text: "Eventos de Reforestación"},
        {text: "Agregar Eventos de Reforestación"},
        {text: "Editar Eventos de Reforestación"},
        {text: "Eliminar Eventos de Reforestación"},
        {text: "Solicitudes de Adopción Múltiple"},
        {text: "Agregar Solicitudes de Adopción Múltiple"},
        {text: "Tipos de Patrocinio"},
        {text: "Agregar Tipos de Patrocinio"},
        {text: "Editar Tipos de Patrocinio"},
        {text: "Eliminar Tipos de Patrocinio"},
        {text: "Puntos Ganados"},
        {text: "Consultar Puntos Ganados"},
        {text: "Actualizar Ubicación de los Árboles"},
        {text: "Catalogos Baja de Árboles"},
        {text: "Mapa de Árboles"},
        {text: "Solicitudes de Adopción Múltiple Guardabosque"},
        {text: "Patrocinador Árbol"},
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
        {text: "Ver Detalle de Estadísticas"},
        {text: "Ver Estadísticas"},
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
        {text: "Rep. Seg. a Adop. Múltiples y Reforestaciones"},
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

