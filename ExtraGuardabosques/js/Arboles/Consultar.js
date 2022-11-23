var QR="";
var puntos=0;
var objetoprevio;
$('#etiquetaPerdidaModal').on('shown.bs.modal', function()
{	
	$("#qretiqueta").html(QR);
	puntos=0;
	$("#puntos").empty();
	$.ajax({
		  url: "BuscarPuntosQR",
		  type: 'POST',
		  data:{		 
					BusquedaQr: QR,						
				}						  
		}).always(function(val) 
		{	
			if(val!="[]")
			{
				objetoprevio=JSON.parse(val);				
				html="<table CLASS='table table-hover table-no-bordered'>";
				html+="<thead><tr>"+
						"<td width='130px' class='text-center'>FECHA</td>"+			
//						"<td width='130px' class='text-center'>QR</td>"+						
						"<td width='200px' class='text-center'>CONCEPTO</td>"+
						"<td width='50px' class='text-center'>PUNTOS GANADOS</td>"+
			
					"	</thead></tr>";
				for(i=0;i<objetoprevio.length;i++)														
				{
					puntos=puntos+parseInt(objetoprevio[i].NUM_PUNTOS);
				html+="<tr>"+
						"<td width='130px' class='text-center'>"+
							objetoprevio[i].FEC_REGISTRO+
						"</td>"+						
/*						"<td width='130px' class='text-center'>"+
							objetoprevio[i].VCH_QR+
						"</td>"+*/
						"<td width='200px' class='text-center'>"+
							objetoprevio[i].VCH_CONCEPTO+
						"</td>"+
						"<td width='50px' class='text-center'>"+
							objetoprevio[i].NUM_PUNTOS+
						"</td>"+

					"	</tr>";
				}
				html+="<tr>"+
						"<td width='130px'>&nbsp;</td>"+
					//	"<td width='130px'>&nbsp;</td>"+	
						"<td width='200px' class='text-right'>TOTAL:</td>"+
						"<td width='50px' class='text-center'><b>"+puntos +"</b></td>"+
											
					"</tr>";

				html+=" </table>";
				$("#puntos").append(html);
			}						
		});			
});

function loadDetallePuntos(qr)
{
	QR=qr;
	$("#etiquetaPerdidaModal").modal('show');
}
