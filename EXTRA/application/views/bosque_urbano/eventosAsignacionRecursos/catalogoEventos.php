


<div class="row">
  <div class="col-lg-offset-1 col-lg-11">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th class="text-center">
					Tipo
				</th>
				<th class="text-center">
					Nombre de evento
				</th>
				<th class="text-center">
					Lugar
				</th>
				<th class="text-center">
					Patrocinador
				</th>
				<th class="text-center">
					Fecha Evento
				</th>
				<!--<th class="text-center">
					Hora evento
				</th>				-->
				<th class="text-center">
					Personal
				</th>
				<th class="text-center">
					Servicio social
				</th>												
				<th class="text-center">
					Vehiculos
				</th>												
				<th class="text-center">
					Arboles que llevaran
				</th>												
				<th class="text-center">					
				</th>												
			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($eventos as $evento)			
			{?>
			 <tr id="<?=$evento["ID__EVENTO"]?>"  >
				<td class="text-center"><?php if($evento["VCH_TIPO"]==1){ echo "A"; } else { echo "R";}?></td>
				 <td class="text-center"><?=$evento["VCH_NOMBREEVENTO"]?></td>
				 <td class="text-center"><?=$evento["VCH_NOMBRELUGAR"]?></td>		
				 <td class="text-center"><?=$evento["VCH_NOMBREEMPRESA"]?></td>				 
				 <td class="text-center"><?=$evento["FEC_FECHAINICIO"]?></td>	
				 <!--<td class="text-center">< ?=explode(" ",$evento["FEC_FECHAINICIO"])[0]?></td>				
				 <td class="text-center">< ?=explode(" ",$evento["FEC_FECHAINICIO"])[1]?></td>					-->					
				 <td class="text-center"><?php 	if(!empty($evento["cantpersonal"])){echo $evento["cantpersonal"];}else{ echo 0;}?></td>
				 <td class="text-center"><?php 	if(!empty($evento["cantprestador"])){echo $evento["cantprestador"];}else{ echo 0;}?></td>
				 <td class="text-center"><?php 	if(!empty($evento["cantvehiculos"])){echo $evento["cantvehiculos"];}else{ echo 0;}?></td>
				 
				 <td class="text-center"><?php 	if(!empty($evento["NUM_ARBOLESSOLICITADOS"])){echo $evento["NUM_ARBOLESSOLICITADOS"];}else{ echo 0;}?></td>
				<td class="text-center">
			<?php if(($evento["VCH_ESTATUS"]!=2)&&($evento["VCH_ESTADOASIGNACION"]!=0))
				{
					if(in_array(24,$this->session->userdata('PERMISOS')))
                    {
			?>			
						<a href="javascript:abrirAsignacion(<?=$evento["ID__EVENTO"]?>)">asignar Recursos</a>
			<?php
					}
				}			
				?>
				</td>		
			 </tr>
			 <?php
			 }?>
		 </table>      
	</div><!--col-->
 </div><!--row-->

