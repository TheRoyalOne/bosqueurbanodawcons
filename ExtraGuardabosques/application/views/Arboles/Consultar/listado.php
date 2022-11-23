<style>
	.paddtop
	{
		padding-top:13px !important;
	}
	.backg
	{
		background-color:#00A89C;
		color:white;
	}
</style>

<div class="row form-horizontal">	
				
				
	<div class="row">
	  <div class="col-lg-offset-1 col-lg-10">	  
	  <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th class="text-center">
					QR
				</th>				
				<th class="text-center">
					Puntos Obtenidos
				</th >
				<th class="text-center">
					Fecha
				</th >
				<th class="text-center">
					Detalle
				</th>														
			</tr>
			</thead>
			<tbody id="tbodyarchivos">	
			<?php
				foreach($du as $mich)
				{
			?>
				<tr>
					<td class="text-center">
						<?=$mich["VCH_QR"]?>
					</td>				
					<td class="text-center">
						<?=$mich["NUM_PUNTOS"]?>
					</td >
					<td class="text-center">
						<?=$mich["FEC_REGISTRO"]?>
					</td >
					<td class="text-center">
						<a href="#" onclick="loadDetallePuntos('<?=$mich["VCH_QR"]?>')">Detalle</a>
					</td>														
				</tr>
			<?php
				}
			?>
			</tbody>
		 </table>      
	   
	  </div><!--col-->
	</div><!--row-->
</div>
<div id="etiquetaPerdidaModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
	<div class="modal-content">
	  <div class="modal-header backg">
		<h4 class="modal-title">Detalle de puntos <b><label id="qretiqueta"></b> </label></h4>
	  </div>
	  <div class="modal-body" id="puntos">
		  		
	  </div>
	</div>
  </div>
</div>
<script type="text/javascript" src="<?=base_url()?>js/Arboles/Consultar.js"></script>
