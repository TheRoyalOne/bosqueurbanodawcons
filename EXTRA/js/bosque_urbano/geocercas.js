//* Base*/



var ciudades;
function traerMunicipios()
{
	
	$.ajax({
			  url: "../general/getCiudades",
			  type: 'POST',
			  data:{					
					ID__ESTADO:$("#estado").val()			
				  }						  
			}).done(function(val) 
			{									
				ciudades=JSON.parse(val);														
				$('#municipio').empty();			
				$('#municipio').append($('<option>',
					 {
						value: -1,
						text : "Todo el estado"
					}));		
				for (i=0; i<ciudades.length;i++)
				{
					$('#municipio').append($('<option>',
					 {
						value: ciudades[i].ID__MUNICIPIO,
						text : ciudades[i].VCH_NOMBRE
					}));	
				}
				
			});			
}
function busqueda()
{			
	$.ajax({
		  url: "traerGeocercas",
		  type: 'POST',
		  data:{					
				ID__ESTADO: $("#estado").val(),
				ID__MUNICIPIO: $("#municipio").val()							
			  }						  
		}).done(function(val) 
		{								 
			try
			{
				objetoprevio=JSON.parse(JSON.parse(val)[0].GEOCERCA);				
			}
			catch(e)
			{
				objetoprevio=null;
			}
			if(myPolygon)
			{
				myPolygon.setMap(null);
			}
			myPolygon=null;			
																								
			var polyg = [];			
			
			if(objetoprevio!=null)//en caso de no existir, poner un triangulo base por default
			{
				for(i=0;i<objetoprevio.length;i++)
				{
					objetoprevio[i]=objetoprevio[i].split(",");
					objetoprevio[i][0]=parseFloat(objetoprevio[i][0].replace("(","").trim());
					objetoprevio[i][1]=parseFloat(objetoprevio[i][1].replace(")","").trim());
					polyg.push(new google.maps.LatLng(objetoprevio[i][0], objetoprevio[i][1]));
					//new google.maps.LatLng(20.6803089, -103.3852507),				
				}
			}
			else
			{
			  polyg = [
				new google.maps.LatLng(20.6803089, -103.3852507),
				new google.maps.LatLng(20.6603089, -103.3052507),
				new google.maps.LatLng(20.7603089, -103.3952507)
			  ];
			}
			  myPolygon = new google.maps.Polygon({
				paths: polyg,
				draggable: true, // turn off if it gets annoying
				editable: true,
				strokeColor: '#00793C',
				strokeOpacity: 0.8,
				strokeWeight: 2,
				fillColor: '#00793C',
				fillOpacity: 0.35
			  });
			  myPolygon.setMap(map);			
			  
			google.maps.event.addListener(myPolygon.getPath(), "insert_at", getPolygonCoords);		  
			google.maps.event.addListener(myPolygon.getPath(), "set_at", getPolygonCoords);			

		}).always(function(val) 
		{								 
				console.log(val);		
		});				
}
function Definicion()
{	    
  bootbox.confirm("Esta seguro de reemplazar la geocerca?", function(result)
  {
	if(result)
	{		
		var arr=[];
		myPolygon.getPath().forEach(function(latLng)
		{
					arr.push(latLng.toString()); 
					//console.log( latLng.lat() )				
		})						
		$.ajax({
			  url: "crearGeocercas",
			  type: 'POST',
			  data:{					
					ID__ESTADO: $("#estado").val(),
					ID__MUNICIPIO: $("#municipio").val(),							
					arr:JSON.stringify(arr)
				  }						  
			}).done(function(val) 
			{								 
					bootbox.alert(val);
			})
			.always(function(val) 
			{								 
					console.log(val);		
			});		
	}
 });
	
   
}

//Display Coordinates below map
function getPolygonCoords() 
{
  var len = myPolygon.getPath().getLength();
  var htmlStr = "";
  for (var i = 0; i < len; i++) 
  {
    //htmlStr += "new google.maps.LatLng(" + myPolygon.getPath().getAt(i).toUrlValue(5) + "), ";
   
  }
  //document.getElementById('info').innerHTML = htmlStr;
}
function copyToClipboard(text) 
{
  window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}


