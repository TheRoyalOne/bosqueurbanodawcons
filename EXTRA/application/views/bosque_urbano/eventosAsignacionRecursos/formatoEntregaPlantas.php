<html>
	<head></head>
	<body>
		<table>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="center">
					<img src="http://bosqueurbanoextra.org.mx/wp-content/themes/bosqueurbano/img/logo.png" >				
				</td>
			</tr>
			<tr>
				<td align="center" width="50%">
					<img src="http://bosqueurbanoextra.org.mx/wp-content/themes/bosqueurbano/img/logo.png" >				

				</td>
				<td align="center">
					<img src="http://bosqueurbanoextra.org.mx/wp-content/themes/bosqueurbano/img/logo.png" >				
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%" >
					<table cellspacing="1">
						<tr>
							<td width="75%" style="font-size:18px;background-color:#00A89C;color:white ; " align="center"><b>formato de entrega de plantas</b></td>
							<td width="25%" style="font-size:16px"  align="center"  ><?=sprintf('%06d', $data["ID__EVENTO"]);?></td>
						</tr>
						<tr>
							<td  width="75%" style="font-size:18px;background-color:#00A89C;color:white; " align="center"><b>solicitud empresas y eventos</b></td>
						</tr>
					</table>				
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table >
						<tr>
							<td width="25%"  align="left">Patrocinador / Empresa</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"><?=$data["VCH_NOMBREEMPRESA"]?></td>
						</tr>
						<tr>
							<td width="25%"  align="left">Nombre Evento</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"><?=$data["VCH_NOMBREEVENTO"]?></td>
						</tr>
						<tr>
							<td width="25%"  align="left">Fecha Evento</td>
							<td width="25%"  align="left" style="border-bottom-width: 1px;" ><?=explode(" ",$data["FEC_FECHAINICIO"])[0]?></td>
							<td width="25%"  align="center">Hora Evento</td>
							<td width="25%"  align="center" style="border-bottom-width: 1px;"><?=explode(" ",$data["FEC_FECHAINICIO"])[1]?></td>
						</tr>
						<tr>
							<td width="25%"  align="left">Direccion Evento</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"><?=$data["VCH_NOMBRELUGAR"]?></td>
						</tr>
						<tr>
							<td width="25%"  align="left">Fecha Carga</td>
							<td width="25%"  align="left" style="border-bottom-width: 1px;" >
								
								<?php
								if(!empty($cargadores[0]))
								{
									echo explode(" ",$cargadores[0]["FEC_FECHAYHORACARGA"])[0];								
								}
								?>
							</td>
							<td width="25%"  align="center">Hora Carga</td>
							<td width="25%"  align="center" style="border-bottom-width: 1px;">								
								<?php
								
								if(!empty($cargadores[0]))
								{
									echo explode(" ",$cargadores[0]["FEC_FECHAYHORACARGA"])[1];								
								}
								?>
							</td>
						</tr>
						<tr>
							<td width="25%"  align="left">Nombre del solicitante</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"><?=$solicitante?></td>
						</tr>
						<tr>
							<td width="25%"  align="left">Nombre quien Carga</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;">
							<?php
								if(!empty($cargadores[0]))
								{																		   									
									echo explode(" ",$cargadores[0]["VCH_NOMBRE"]." ".$cargadores[0]["VCH_APELLIDOPATERNO"]." ".$cargadores[0]["VCH_APELLIDOMATERNO"])[1];								
								}
								?></td>
						</tr>
						<tr>
							<td width="25%"  align="left">Vehiculo empleado</td>
							<td width="25%"  align="left"  style="border-bottom-width: 1px;"><?=$data["vehiculodesc"]?></td>
							<td width="25%"  align="center">Placas</td>
							<td width="25%"  align="center" style="border-bottom-width: 1px;"><?=$data["vehiculos"]?></td>
						</tr>
						<tr>
							<td width="25%"  align="left">Observaciones</td>
							<td width="75%"  align="left" style="border-bottom-width: 1px;"><?=$data["VCH_NOMBRELUGAR"]?></td>
						</tr>
					</table>				
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table>
						<tr>
							<td align="center">No.</td>							
							<td style="border:1px solid #ccc!important" align="center">Cantidad Entregar.</td>
							<td style="border:1px solid #ccc!important" align="center">Especie</td>
							<td style="border:1px solid #ccc!important" align="center">Talla cm.</td>
							<td style="border:1px solid #ccc!important" align="center">Bolsa tipo</td>
							<td style="border:1px solid #ccc!important" align="center">Area toma</td>
							<td style="border:1px solid #ccc!important" align="center">Cantidad retoma</td>
							<td style="border:1px solid #ccc!important" align="center">Recibe retorno</td>
						</tr>
						<?php 
						$i=0;
//						die(print_r($relarbolasignados));
						foreach($relarbolasignados as $relarbolasignado)			
						{
						?>
						<tr>
							<td align="center"><?=$i?></td>							
							<td style="border:1px solid #ccc!important" align="center"><?=$relarbolasignado["NUM_CANTIDAD"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$relarbolasignado["VCH_NOMBRECOMUN"]?></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$relarbolasignado["contenedor_nombre"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$relarbolasignado["VCH_NOMBRE"]?></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>

						</tr>						
						<?php
						$i++;
						}
						?>
					</table>				
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table>
						<tr>
							<td width="25%"  align="center">Autorizacion por</td>
							<td width="25%" align="center" style="border-bottom-width: 1px;"></td>
							<td width="50%"  align="center">&nbsp;</td>
						</tr>

					</table>				
				</td>
			</tr>
		</table>
	
	</body>
</html>
