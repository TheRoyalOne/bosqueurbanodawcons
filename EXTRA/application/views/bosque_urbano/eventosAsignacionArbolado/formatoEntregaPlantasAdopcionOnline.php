<html>
	<head></head>
	<body >
		<table>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<!--<tr>
				<td colspan="2" align="center">
					<img src="http://bosqueurbanoextra.org.mx/wp-content/themes/bosqueurbano/img/logo.png" >				
				</td>
			</tr>-->
			<tr>
				<td align="center" width="50%">
					<!--<img src="http://bosqueurbanoextra.org.mx/wp-content/themes/bosqueurbano/img/logo.png" >				-->
					<img src="<?=base_url()?>Imagenes/logo.png" >
				</td>
				<td align="center" >
					<table style="font-size:12px">
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td>
								Salida de árbol
							</td>
						</tr>
						<tr>
							<td>
								Adopcion Online
							</td>
						</tr>
						<tr>
							<td style="color:red;font-size:14px">
								<b>E-<?=sprintf('%06d', $data["ID__EVENTO"]);?></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			
			
			<!--<tr>
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
			</tr>-->
			
			
			<tr>
				<td colspan="2" align="left" width="100%">
					<table >
						<tr>
							<td width="100%">
								<table>
									<tr>
										<td width="50px">
											Fecha											
										</td>
										<td width="80px" style="border-bottom-width: 1px;">
											&nbsp;
										</td>
										<td align="right">
											Hora Entrada
										</td>
										<td style="border-bottom-width: 1px;">
											&nbsp;
										</td>
										<td align="right">
											Hora Salida									
										</td>
										<td style="border-bottom-width: 1px;">
											&nbsp;
										</td>
									</tr>
									<tr><td>&nbsp;</td></tr>
								</table>
							</td>
						</tr>
						<tr>
							<td width="25%"  align="left">Nombre solicitante</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Empresa / Institución</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="100%" colspan="2">
								<table border=1>
									<tr>
										<td width="50px">
											Tel / Cel				
										</td>
										<td width="110px" style="border-bottom-width: 1px;">
											&nbsp;
										</td>
										<td align="right" width="50px">
											Email
										</td>
										<td style="border-bottom-width: 1px;" width="295px" >
											&nbsp;
										</td>										
									</tr>
									<tr><td>&nbsp;</td></tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<td width="25%"  align="left">Calle</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Colonia</td>
							<td width="50%"  align="left" colspan="3" style="border-bottom-width: 1px;"></td>
							<td width="25%"  align="left"> 
								<table>
									<tr>
										<td align="right">
											C.P.
										</td>
										<td style="border-bottom-width: 1px;" width="60px">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Municipio</td>
							<td width="35%"  align="left" colspan="3" style="border-bottom-width: 1px;"></td>
							<td width="40%"  align="left"> 
								<table>
									<tr>
										<td align="right">
											Estado
										</td>
										<td style="border-bottom-width: 1px;" width="100px">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Vehiculo</td>
							<td width="35%"  align="left" colspan="3" style="border-bottom-width: 1px;"></td>
							<td width="40 %"  align="left"> 
								<table>
									<tr>
										<td align="right">
											Placas
										</td>
										<td style="border-bottom-width: 1px;" width="100px">
											&nbsp;
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
																
						
						<tr>
							<td width="25%"  align="left">Nombre quien Entrega</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;">
							<?php
								if(!empty($cargadores[0]))
								{																		   									
									echo explode(" ",$cargadores[0]["VCH_NOMBRE"]." ".$cargadores[0]["VCH_APELLIDOPATERNO"]." ".$cargadores[0]["VCH_APELLIDOMATERNO"])[1];								
								}
								?></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						
						<tr>
							<td width="25%"  align="left">Nombre del vigilante</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;">
							<?php
								if(!empty($cargadores[0]))
								{																		   									
									echo explode(" ",$cargadores[0]["VCH_NOMBRE"]." ".$cargadores[0]["VCH_APELLIDOPATERNO"]." ".$cargadores[0]["VCH_APELLIDOMATERNO"])[1];								
								}
								?></td>
						</tr>						
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Fecha Carga</td>
							<td width="25%"  align="left"  style="border-bottom-width: 1px;"><?=$data["vehiculodesc"]?></td>
							<td width="25%"  align="center">Hora Carga</td>
							<td width="25%"  align="center" style="border-bottom-width: 1px;"><?=$data["vehiculos"]?></td>
						</tr><!--
						<tr>
							<td width="25%"  align="left">Nombre del solicitante</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"><?=$solicitante?></td>
						</tr>-->
						<tr><td>&nbsp;</td></tr>
						
						<tr>
							<td width="25%"  align="left">Observaciones</td>
							<td width="75%"  align="left" style="border-bottom-width: 1px;"><?=$data["VCH_NOMBRELUGAR"]?></td>
						</tr>						
												<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">&nbsp;</td>
							<td width="75%"  align="left" style="border-bottom-width: 1px;"></td>
						</tr>						
												<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">&nbsp;</td>
							<td width="75%"  align="left" style="border-bottom-width: 1px;"></td>
						</tr>
					</table>				
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table>
						<tr>
							<td align="center" width="20px">&nbsp;</td>							
							<td style="border:1px solid #ccc!important" align="center">Cantidad</td>
							<td style="border:1px solid #ccc!important" align="center">Especie</td>
							<td style="border:1px solid #ccc!important" align="center">Zona</td>
							<td style="border:1px solid #ccc!important" align="center">QR <br/> S/N</td>
							<td style="border:1px solid #ccc!important" align="center">Area de toma</td>
							<td style="border:1px solid #ccc!important" align="center">Aportacion</td>
						</tr>
						<?php 
						$i=0;
//						die(print_r($relarbolasignados));
						while($i<16)
						{
						?><!--
						<tr>
							<td align="center"><?=$i?></td>							
							<td style="border:1px solid #ccc!important" align="center"><?=$relarbolasignado["NUM_CANTIDAD"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$relarbolasignado["VCH_NOMBRECOMUN"]?></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$relarbolasignado["contenedor_nombre"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$relarbolasignado["VCH_NOMBRE"]?></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>

						</tr>-->						
						<tr>
							<td align="right" style="color:green" width="20px"><?=$i?></td>							
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="left">&nbsp;$</td>							
						</tr>
						<?php
						$i++;
						}
						?>
						<tr>
							<td align="left"></td>							
							<td  style="border:1px solid #ccc!important"  align="center"></td>
							<td  align="center"></td>
							<td  align="center"></td>
							<td  align="center"></td>
							<td  align="center"></td>
							<td style="border:1px solid #ccc!important" align="left">&nbsp;$</td>							
						</tr>
					</table>				
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table>
						<tr>
							<td width="25%"  align="center">Autorizacion por</td>
							<td width="50%" align="center" style="border-bottom-width: 1px;"></td>
							<td width="25%"  align="center">&nbsp;</td>
						</tr>
						<tr>
							<td width="25%"  align="center">&nbsp;</td>
							<td width="50%" align="center" >Nombre y Firma</td>
							<td width="25%"  align="center">&nbsp;</td>
						</tr>

					</table>				
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			
			<tr><td colspan="2" align="left" style="color:#9ABB84">Horario de entregas 8:00 a 14:00 <br/>- Las solicitudes tienen que estar autorizadas por dirección o jefe de vivero.
			</td></tr>
			
		</table>
	
	</body>
</html>
