<form id="formaltaus" method="POST">
<div class="row form-horizontal" style="padding-top:20px">
	<div class="col-lg-10">
		<div class="form-group">
	      <label class="control-label col-lg-4">IDs de los eventos:</label>
	      <div class="col-lg-8">
	        <input type="text" class="form-control" id="cadena" name="cadena">
	      </div>
   		</div>
	</div>
	<div class="col-lg-2">
	    <button type="submit" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
	</div>
</div>
</form>
<div class="row">
  <div class="col-lg-offset-1 col-lg-11">

<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
	<thead style='background-color:#00A89C; color:#fff;' >
	<tr>
		<th>
			Id Evento
		</th>
		<th>
			Fecha
		</th>
		<th>
			Nombre de evento
		</th>
		<th>
			Arboles
		</th>
		<th>
			Fotos
		</th>
		<th>
			Participantes
		</th>
	</tr>
	</thead>
	<?php			
	if(is_array($datos))
	{
		foreach($datos as $dato)			
		{?>
	 <tr >
		 <td><?=$dato["ID__EVENTO"]?></td>
		 <td><?=substr($dato["FEC_FECHAINICIO"],0,10)?></td>				 
		 <td><?=$dato["VCH_NOMBREEVENTO"]?></td>				
	     <td><?=$dato["Arboles_dados"]?></td>				
	     <td><?=$dato["Cantidad_fotos"]?></td>	
	     <td><?=$dato["partici"]?></td>			
	 </tr>
	 <?php
		}
	 }?>
	</table>      
</div><!--col-->
  </div><!--row-->
