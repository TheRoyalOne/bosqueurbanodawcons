<html>
	<head></head>
	<body >
		<table>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
		
			<tr>
				<td align="center" width="50%">
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
								Patrocinadores Y Eventos
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
			<tr><td>&nbsp;</td>
				<td>
					<table >
								<tr>
									<td>
										<table width="120px">
											<tr>
												<td style="line-height:20px">Reforestacion</td>											
												
												<td><img src="<?=base_url()?>Imagenes/circle.png"  width="20px"></td>
											</tr>
										</table>																																										
										
									</td>
									<td>
										<table width="80px">
											<tr>
												<td style="line-height:20px">Adopcion</td>											
												
												<td><img src="<?=base_url()?>Imagenes/circleb.png"  width="20px"></td>
											</tr>
										</table>																																										
										
									</td>
								</tr>
					</table>
				</td>
			</tr>
			
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
							<td width="25%"  align="left">Patrocinador / Empresa</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"><?=$data["VCH_NOMBREEMPRESA"]?></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Nombre Evento</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"><?=$data["VCH_NOMBREEVENTO"]?></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Fecha Evento</td>
							<td width="25%"  align="left" style="border-bottom-width: 1px;" ><?=explode(" ",$data["FEC_FECHAINICIO"])[0]?></td>
							<td width="25%"  align="center">Hora Evento</td>
							<td width="25%"  align="center" style="border-bottom-width: 1px;"><?=explode(" ",$data["FEC_FECHAINICIO"])[1]?></td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="center">Direccion Evento</td>
							<td width="75%"  align="left" colspan="3" >
								<!--< ?=$data["VCH_NOMBRELUGAR"]?>-->
								<table>
									<tr>
										<td>
											<table>
												<tr>
													<td  align="right">
														Calle
													</td>
													<td align="center" style="border-bottom-width: 1px;">
														<?=@explode(" ",$domicilio["VCH_CALLE"])[0]?>
													</td>
												</tr>
												<tr>
													<td  align="right">
														Colonia
													</td>
													<td align="center" style="border-bottom-width: 1px;">
														<?=@$domicilio["colonia"]?>
													</td>
												</tr>												
												<tr>
													<td  align="right">
														Municipio
													</td>
													<td align="center" style="border-bottom-width: 1px;">
														<?=@$domicilio["municipio"]?>
													</td>
												</tr>												
											</table>
										</td>
										<td>
											<table>
												<tr>
													<td align="right">
														Numero
													</td>
													<td  align="center" style="border-bottom-width: 1px;">
														<?=@explode(" ",$domicilio["VCH_CALLE"])[1]?>
													</td>
												</tr>
												<tr>
													<td  align="right">
														C.P.
													</td>
													<td align="center" style="border-bottom-width: 1px;">
														<?=@$domicilio["VCH_CODIGOPOSTAL"]?>
													</td>
												</tr>												
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="center">Contacto</td>
							<td width="75%"  align="left" colspan="3" >
								<!--< ?=$data["VCH_NOMBRELUGAR"]?>-->
								<table>
									<tr>
										<td>
											<table>
												<tr>
													<td  align="right">
														Nombre
													</td>
													<td style="border-bottom-width: 1px;">
														&nbsp;
													</td>
												</tr>
												<tr>
													<td  align="right">
														Tel/Cel
													</td>
													<td style="border-bottom-width: 1px;">
														&nbsp;
													</td>
												</tr>												
											</table>
										</td>
										<td>
											<table>
												<tr>
													<td align="right">
														Cargo
													</td>
													<td style="border-bottom-width: 1px;">
														&nbsp;
													</td>
												</tr>
												<tr>
													<td  align="right">
														e-mail
													</td>
													<td style="border-bottom-width: 1px;">
														&nbsp;
													</td>
												</tr>												
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						
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
						
						<!--
						<tr>
							<td width="25%"  align="left">Nombre del solicitante</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"><?=$solicitante?></td>
						</tr>-->
						<tr><td>&nbsp;</td></tr>
						<tr>
							<td width="25%"  align="left">Nombre</td>
							<td width="75%"  align="left" colspan="3" style="border-bottom-width: 1px;"></td>
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
						$i=1;
//						die(print_r($relarbolasignados));
						$totales=0;
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
						$totales=$totales+$relarbolasignado["NUM_CANTIDAD"];
						}
						?>
						<tr>
							<td align="center">Total</td>												
							<td style="border:1px solid #ccc!important" align="center"><?=$totales?></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
							<td style="border:1px solid #ccc!important" align="center"></td>
						</tr>	
					</table>				
				</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<?php 
//			die(print_r($relPersonal));
			if(count($relPersonal)>0)
			{
			?>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table>
						<tr>
							<td style="border:1px solid #ccc!important;" align="center">---Personal---</td>							
						</tr>
						<?php 						
//						die(print_r($relarbolasignados));
						foreach($relPersonal as $rel)			
						{
						?>
						<tr>
							<td style="border:1px solid #ccc!important" align="center"><?=$rel["nombre"]?></td>
						</tr>						
						<?php						
						}
						?>
					</table>				
				</td>
			</tr>
			<?php 
			}
			if(count($relServicioSocial)>0)
			{
			?>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table>
						<tr>
							<td style="border:1px solid #ccc!important" align="center">---Servicio social---</td>							
						</tr>
						<?php 
						$i=0;
//						die(print_r($relarbolasignados));
						foreach($relServicioSocial as $rel)			
						{
						?>
						<tr>
							<td style="border:1px solid #ccc!important" align="center"><?=$rel["nombre"]?></td>
						</tr>						
						<?php						
						}
						?>
					</table>				
				</td>
			</tr>
			<?php 
			}
			if(count($relVehiculo)>0)
			{
			?>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table>
						<tr>
							<td colspan="2" style="border:1px solid #ccc!important" align="center">---Vehiculo---</td>							
						</tr>
						<?php 
						foreach($relVehiculo as $rel)			
						{
						?>
						<tr>
							<td style="border:1px solid #ccc!important" align="center"><?=$rel["VCH_DESCRIPCION"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$rel["VCH_MATRICULA"]?></td>
						</tr>						
						<?php						
						}
						?>
					</table>				
				</td>
			</tr>
			<?php 
			}
			if(count($relHerramientas)>0)
			{
			?>
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
			<tr>
				<td colspan="2" align="left" width="100%">
					<table>
						<tr>
							<td colspan="3" style="border:1px solid #ccc!important" align="center">---Herramientas---</td>							
						</tr>
						<?php 
						$i=0;
						foreach($relHerramientas as $rel)			
						{
						?>
						<tr>
							<td style="border:1px solid #ccc!important" align="center"><?=$rel["VCH_NOMBRE"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$rel["VCH_CANTIDAD"]?></td>
							<td style="border:1px solid #ccc!important" align="center"><?=$rel["VCH_DESCRIPCION"]?></td>
						</tr>						
						<?php
						$i++;
						}
						?>
					</table>				
				</td>
			</tr>
			<?php 
			}
			?>
			
			
			<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
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
						
			
			<tr><td>&nbsp;</td></tr>
			
			<tr><td colspan="2" align="center" style="color:#9ABB84">Horario de entregas 8:00 a 14:00 - Las solicitudes tienen que estar autorizadas por dirección o jefe de vivero.</td></tr>
			
		</table>
	
	</body>
</html>
