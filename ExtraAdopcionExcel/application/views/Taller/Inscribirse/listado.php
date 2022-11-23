
<style>
	.paddtop
	{
		padding-top:13px !important;
	}
</style>

<div class="form-group">
	<div class="col-lg-12 col-md-12 col-xs-12">
		<div id='calendar'></div>
	</div>
</div>
<div>
	<div class="row">&nbsp;
	</div>
</div>
<div class="row form-horizontal">	
	<div class="row">
	  <div class="col-lg-offset-1 col-lg-10">
	  
	  <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th class="text-right">
					Taller
				</th>				
				<th class="text-right">
					Fecha y hora
				</th >
				<th class="text-right">
					Precio base
				</th>
				<th class="text-right">
					Descuento a aplicar por realizar encuestas
				</th>
				<th class="text-right">
					Precio para mi
				</th>
				<th class="text-right">
					Opciones
				</th>				
														
			</tr>
			</thead>
			<?php			
			foreach($talleresTomados as $tallerTomado)			
			{?>
			 <tr>
				 <td><?=$tallerTomado["VCH_TALLER"]?></td>
				 <td><?php 
							$fechas=explode(",",$tallerTomado["fechas"]);
							$horas= explode(",",$tallerTomado["VCH_HORA"]);
							$posicion=0;
							foreach($fechas as $fecha)
							{
								if($posicion>0){echo ",<br/>";}
								echo $fecha." ".$horas[$posicion++];		
								
							}
							
				 ?></td>			
				 <td class="text-right">$<?=number_format((float)$tallerTomado["VCH_PRECIO"], 2, '.', '');?></td>		
				 <td class="text-center"><?=$encuestasDescuento?></td>		
				 <td class="text-right">$
					<?php							
							$precio= preg_replace("/[^0-9,.]/", "", $tallerTomado["VCH_PRECIO"]);
							switch ($encuestasDescuento)
							{
								case 0:
								{									
									break;
								}
								case 1:
								{
									$precio= ($precio*0.95);
									break;
								}
								case 2:
								{
									$precio=($precio*0.90);
									break;
								}
								case 3:
								{
									$precio=($precio*0.85);
									break;
								}
								case 4:
								{
									$precio= ($precio*0.80);
									break;
								}
								case 5:
								{
									$precio= ($precio*0.75);
									break;
								}
								default:
								{
									$precio= ($precio*0.70);
									break;
								}
							}
							echo number_format((float)$precio, 2, '.', '');
					?>
				 </td>
				 <td><?php
						echo "<a href='javascript:Inscribirse(".$tallerTomado["ID__CLAVETALLER"].")' style='cursor:pointer' target='_SELF'>Inscribirse</a>";
						?>
				  </td>		 
			 </tr>
			 <?php
			 }?>
		 </table>      
	   
	  </div><!--col-->
	</div><!--row-->
</div>

<script>
$(function() 
{ // document ready
	  
	$('#calendar').fullCalendar({
			header: {
				left: 'prev,next,today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay,listWeek'
				},
			events: [
						<?php
						foreach($talleresTomados as $tallerTomado)			
						{
							

							$fechas=explode(",",$tallerTomado["fechas"]);
							$horas= explode(",",$tallerTomado["VCH_HORA"]);
							$posicion=0;
							foreach($fechas as $fecha)
							{

								?>
								
								{
									title  : '<?=$tallerTomado["VCH_TALLER"]?>',
									start  : '<?=$fecha?>T<?php									 									 										
									 ?>',
									allDay : true // will make the time show
								},
								
								<?php
								//echo $fecha." ".$horas[$posicion++];		
								
							}																	

						}
						?>
					]	
		});
	  
});
</script>
<script type="text/javascript" src="<?=base_url()?>js/Taller/ListaTaller.js"></script>
