<html>
	<head>
		<style>		
		#divFooter:after {
			counter-increment: page;
			content: counter(page);
		}
		
		@media screen {
		  div.divFooter {
			display: block;
		  }
		}
		@media print {
		  div.divFooter {
			position: fixed;
			bottom: 0;
		  }
		}
		.bordersub
		{
			 border-bottom-style: solid;border-bottom-color: #729572;
		}
		
		.rotate {

			/* Safari */
			-webkit-transform: rotate(-90deg);

			/* Firefox */
			-moz-transform: rotate(-90deg);

			/* IE */
			-ms-transform: rotate(-90deg);

			/* Opera */
			-o-transform: rotate(-90deg);

			/* Internet Explorer */
			filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);

			}
			.morris-hover{position:absolute;z-index:1000;}.morris-hover.morris-default-style{border-radius:10px;padding:6px;color:#666;background:rgba(255, 255, 255, 0.8);border:solid 2px rgba(230, 230, 230, 0.8);font-family:sans-serif;font-size:12px;text-align:center;}.morris-hover.morris-default-style .morris-hover-row-label{font-weight:bold;margin:0.25em 0;}
			.morris-hover.morris-default-style .morris-hover-point{white-space:nowrap;margin:0.1em 0;}
		</style>
		
		     <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
			 <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>			 

	</head>
	<body style="color:#000000">		
		<?php
			function fechahumana($valor)
			{			
				$diasemana=date("N",strtotime($valor));	
				$dia=date("j",strtotime($valor));	
				$anio=date("Y",strtotime($valor));	
				$mes=date("n",strtotime($valor));	
				switch($diasemana)
				{
					case 1:{
								$diasemana="Lunes";
								break;
							}
					case 2:{
								$diasemana="Martes";
								break;
							}
					case 3:{
								$diasemana="Miercoles";
								break;
							}
					case 4:{
								$diasemana="Jueves";
								break;
							}
					case 5:{
								$diasemana="Viernes";
								break;
							}
					case 6:{
								$diasemana="Sabado";
								break;
							}
					case 7:{
								$diasemana="Domingo";
								break;
							}
					Default :{
								$diasemana="Lummiernes";
								break;
							}					
				}
				switch($mes)
				{
					case 1:{
								$mes="de Enero de";
								break;
							}
					case 2:{
								$mes="de Febrero de";
								break;
							}
					case 3:{
								$mes="de Marzo de";
								break;
							}
					case 4:{
								$mes="de Abril de";
								break;
							}
					case 5:{
								$mes="de Mayo de";
								break;
							}
					case 6:{
								$mes="de Junio de";
								break;
							}
					case 7:{
								$mes="de Julio de";
								break;
							}
					case 8:{
								$mes="de Agosto de";
								break;
							}
					case 9:{
								$mes="de Septiembre de";
								break;
							}
					case 10:{
								$mes="de Octubre de";
								break;
							}
					case 11:{
								$mes="de Noviembre de";
								break;
							}
					case 12:{
								$mes="de Diciembre de";
								break;
							}
					Default :{
								$mes="de Togorio de";
								break;
							}					
				}
				return $diasemana.", ".$dia." ".$mes." ".$anio;
			}

				
		?>
		<table width="100%">
			 <thead>
				<tr>
					<td align="center">
						<table width="100%" >
							<tr>
								<td align="center">
									<img src="<?=base_url()?>Imagenes/extralogocolor.png" width="140px" >			
								</td>
							</tr>
						</table>
					</td>
				</tr>
			 </thead>			 
			<tbody>
			  <tr>
				<td>
					  <table width="100%">
						<tr>
							<td align="center" style="font-size:18px">
									<b>Reporte de talleres</b>
							</td>							 
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td align="center">
								<table>
									<tr>
										<td>Periodo Del <b><?=$del?></b> Al <b><?=$al?></b> </td>
										<td>Tipo de taller <b> <?=$dataeventos["nombretipotaller"]?></b></td>
									</tr>
									<tr>
										<td>Patrocinador <b><?=$dataeventos["nombreempresa"]?></b></td>										
									</tr>
								</table>
							</td>							 
						</tr>
					</table>					  
				</td> 
			 </tr>
			 <tr>
				 <td>&nbsp;</td>
			 </tr>
			 <tr>
				<td width="100%" align="center">
					  <table width="70%" border=0>
						<tr>
							<td align="left" colspan="2" class="bordersub">
								<b>Total de talleres</b>
							</td>						
							<td width="20px">
								<b><?=$dataeventos["totalTALLERES"]?></b>
							</td>	 
						</tr>
						<tr>
							<td width="50px">&nbsp;</td>
							<td class="bordersub">Total de patrocinadores</td>
							<td width="20px">
								<b><?=$dataeventos["totalPatrocinadores"]?></b>
							</td>	 
						</tr>
					</table>					  
				</td> 
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td  width="100%" align="center">
					  <table width="70%" border=0>						
						<tr>
							<td align="left" colspan="2" >
								<b>Talleres</b>
							</td>													
						</tr>
						<tr>
							<td width="50px">&nbsp;</td>
							<td >Patrocinador</td>
							<td >Nombre</td>
							<td class="bordersub">Fecha y hora</td>
							<td >Costo</td>							
							<td width="20px">
								<b>Asistentes</b>
							</td>	 
						</tr>
						<?php
						foreach($dataeventos["TALLERES"] as $dia)
						{
						?>
						<tr>
							<td  width="50px">&nbsp;</td>
							<td  class="bordersub"><?=$dia["VCH_NOMBREEMPRESA"]?></td>
							<td class="bordersub"><?=$dia["VCH_TALLER"]?></td>
							<td class="bordersub"><?=$dia["FEC_FECHA"];?> <?=$dia["VCH_HORA"]?> / <?=$dia["VCH_INSTALACIONES"]?> </td>
							<td >$<?=number_format($dia["VCH_PRECIO"],2)?></td>							
							<td width="20px">
								<b><?=$dia["INT_ASISTENCIA"]?></b>
							</td>	 
						</tr>
						<?php
						}
						?>					
					</table>					  
				</td> 
			</tr>
			
			
			</tbody>
			
			
			<tfoot>
				  <tr>
					  <td>
						  <table width="100%">
							<tr>
								<td>Reporte de talleres</td>
								 <td><?=date("d/m/Y h:i:s a", time());?></td>
								 <td>
									 
								</td>
							</tr>
						</table>
					  </td>					 
				  </tr>
			</tfoot>  		    
			
			
						
		</table>			
	</body>		
</html>
