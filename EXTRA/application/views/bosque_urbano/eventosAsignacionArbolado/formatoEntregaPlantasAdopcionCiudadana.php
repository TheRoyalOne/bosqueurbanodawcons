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
								Adopcion Ciudadania
							</td>
						</tr>
						<tr>
							<td style="color:red;font-size:14px">
								<b>E-<?=sprintf('%06d', $JSONSALIDA["ID__GUARDABOSQUE"]);?></b>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			
			
			
			
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
										<td align="center" width="80px" style="border-bottom-width: 1px;">
											<?=date('Y-m-d')?>
										</td>
										<td align="right">
											Hora Entrada
										</td>
										<td align="center" style="border-bottom-width: 1px;">
											<?=date('h:i:s')?>
										</td>
										<td align="center">
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
							<td width="75%"  align="center" colspan="3" style="border-bottom-width: 1px;">
								<?=$solicitante?>
							</td>
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
										<td align="center" width="110px" style="border-bottom-width: 1px;">
											<?=$JSONSALIDA["guardabosque"]["VCH_TELEFONO"]." / ".$JSONSALIDA["guardabosque"]["VCH_CELULAR"]?>
										</td>
										<td align="right" width="50px">
											Email
										</td>
										<td align="center" style="border-bottom-width: 1px;" width="295px" >
											<?=$JSONSALIDA["guardabosque"]["VCH_CORREO"]?>
										</td>										
									</tr>
									<tr><td>&nbsp;</td></tr>
								</table>
							</td>
						</tr>
						
						<tr>
							<td width="25%"  align="left">Calle</td>
							<td width="75%"  align="center" colspan="3" style="border-bottom-width: 1px;">
							<?=$JSONSALIDA["guardabosque"]["VCH_CALLE"]?>
							
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Colonia</td>
							<td width="50%"  align="center" colspan="3" style="border-bottom-width: 1px;">
							<?=$colonia->colonia?>
							</td>
							<td width="25%"  align="left"> 
								<table>
									<tr>
										<td align="right">
											C.P.
										</td>
										<td style="border-bottom-width: 1px;" width="60px">
											<?=$colonia->VCH_CODIGOPOSTAL?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Municipio</td>
							<td width="35%"   align="center" colspan="3" style="border-bottom-width: 1px;"><?=$colonia->municipio?></td>
							<td width="40%"  align="left"> 
								<table>
									<tr>
										<td align="right">
											Estado
										</td>
										<td  align="center" style="border-bottom-width: 1px;" width="100px">
											<?=$colonia->estado?>
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
							<td width="75%"  align="center" colspan="3" style="border-bottom-width: 1px;">
							<?php
//								if(!empty($cargadores[0]))								{	echo explode(" ",$cargadores[0]["VCH_NOMBRE"]." ".$cargadores[0]["VCH_APELLIDOPATERNO"]." ".$cargadores[0]["VCH_APELLIDOMATERNO"])[1];																}
										echo $entrega
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
<!--							<td style="border:1px solid #ccc!important" align="center">Area de toma</td>-->
							<td style="border:1px solid #ccc!important" align="center">Aportacion</td>
						</tr>
						<?php 
						$i=0;
//						die(print_r($relarbolasignados));
						$totales=0;
						foreach($adopciones as $adopcion)
						{
						?>
						<tr>
							<td align="center"><?=$i?></td>							
							<td style="border:1px solid #ccc!important" align="center">1</td>
							<td style="border:1px solid #ccc!important" align="center"><?=$adopcion["especietxt"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$adopcion["zonatxt"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$adopcion["qr"]?></td>
<!--							<td style="border:1px solid #ccc!important" align="center"><?=$adopcion["VCH_NOMBRE"]?></td>-->
							<td style="border:1px solid #ccc!important" align="center"><?=$adopcion["precio"]?></td>
							<!--<td style="border:1px solid #ccc!important" align="center"><?=$adopcion["VCH_NOMBRE"]?></td>-->
						</tr>
						<!--<tr>
							<td align="right" style="color:green" width="20px"><?=$i?></td>							
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="left">&nbsp;$</td>							
						</tr>-->
						<?php
						$i++;
						$totales=$totales+$adopcion["precio"];
						}
						?>
						<tr>
							<td align="left"></td>							
							<td  style="border:1px solid #ccc!important"  align="center"><?=$i?></td>
							<td  align="center"></td>
							<td  align="center"></td>
							<td  align="center"></td>
<!--							<td  align="center"></td>-->
							<td style="border:1px solid #ccc!important" align="center">&nbsp;$<?=number_format("$totales",2)?></td>							
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
