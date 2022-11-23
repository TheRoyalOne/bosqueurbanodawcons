<form id="formaltaus" method="POST">
<div class="row form-horizontal" style="padding-left:20px">
  <div class="col-lg-12 form-group">
    <div class="form-inline">
      <button type="button" id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Generar </button>    
      <button type="button" onclick="devolverPopup()" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Recuperar etiqueta </button>    
      <button type="button" onclick="perdidaPopup()" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Etiqueta perdida</button>    
    </div>
  </div>
</div><!--row-->



<div class="row">
  <div class="col-lg-offset-1 col-lg-10">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >			
			<tr>					
				<th>
					Especie
				</th>
				<th>
					Generada para
				</th>
				<th>
					Año del evento
				</th>
				<th>
					Cantidad disponible
				</th>
				<th>
					
				</th>
			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($etiquetas as $etiqueta)			
			{?>
			 <tr>				 
				 
				 <td><?=$etiqueta["VCH_NOMBRECOMUN"]?></td>				 
				 <td><?=$etiqueta["VCH_NOMBREEMPRESA"]?></td>				
				 <td><?=$etiqueta["VCH_ANIO"]?></td>			
				 <td><?=$etiqueta["cuantas"]?></td>	
				 <td><a href="javascript:cargarLista('<?=$etiqueta["ID__ESPECIE"]?>','<?=$etiqueta["ID__EMPRESA"]?>','<?=$etiqueta["VCH_ANIO"]?>')">Ver lista</a> </td>				 				 				 				 									 			 				 
			 </tr>
			 <?php
			 }?>
		 </table>      
	</div><!--col-->
</div><!--row-->





</form>
