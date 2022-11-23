


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
				<th class="text-center">
					Hora  <br/>evento
				</th>				
				<th class="text-center">
					Arboles <br/>Solicitdados
				</th>
				<th class="text-center">
					Arboles  <br/> asignados
				</th>												
				<th class="text-center">
				</th>												
				<th class="text-center">
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
				 <td class="text-center"><?=explode(" ",$evento["FEC_FECHAINICIO"])[0]?></td>				
				 <td class="text-center"><?=explode(" ",$evento["FEC_FECHAINICIO"])[1]?></td>										
				 <td class="text-center"><?=$evento["NUM_ARBOLESSOLICITADOS"]?></td>
				 <td class="text-center" id="totalasignados<?=$evento["ID__EVENTO"]?>"><?php 
					if(!empty($evento["asignados"]))
					{echo $evento["asignados"];}else{ echo 0;}?></td>									
				<td class="text-center">
					<?php if($evento["VCH_ESTADOASIGNACION"]==0)
					{
						if(in_array(25,$this->session->userdata('PERMISOS')))
						{						
						?>
					<a href="javascript:abrirAsignacion(<?=$evento["ID__EVENTO"]?>)">Asignar Arbolado</a>
					<?php
						}
					}?>
				</td>		
				<!--<td class="text-center"><?php if($evento["VCH_TIPO"]==1){?> <a href="javascript:abrirEtiquetado(<?=$evento["ID__EVENTO"]?>)">Asignar etiquetas</a> <?php }?></td>		-->
				<td class="text-center">
					<?php
					
				if($evento["VCH_TIPO"]==1)
				{
					 if($evento["VCH_ESTADOASIGNACION"]==1)
					{
						if(in_array(26,$this->session->userdata('PERMISOS')))
						{
						?>
					<a href="javascript:abrirEtiquetado(<?=$evento["ID__EVENTO"]?>)">Asignar etiquetas</a> 
					<?php 
						}
					}
				} ?>
					</td>		
					<td class="text-center">
						<?php
						 if($evento["VCH_ESTADOASIGNACION"]>0)
						{
						?>
							<button class="btn btn-primary" onclick="traerEspecies(<?=$evento["ID__EVENTO"]?>)">Ver Especies</button>    
						<?php
						}
						?>
					</td>
			 </tr>
			 <?php
			 }?>
		 </table>      
	</div><!--col-->
 </div><!--row-->
<div id="verListaModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Lista de arbolado asignado</h4>
	  </div>
	  <div class="modal-body" >
		<div style="height:200px;overflow:auto">
			<ul id="listaetiquetas">						
			</ul>
		</div>
	  </div>			  
	</div>
  </div>
</div>


