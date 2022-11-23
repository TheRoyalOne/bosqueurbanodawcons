<form id="importacion" >
<div class="row form-horizontal">
	<div class="col-lg-6">
		<div class="form-group">
		      <label class="control-label col-md-4">Institución:</label>
		      <div class="col-md-8">
		        <select type="text" class="form-control" id="ID__INSTITUCION_IMPORTAR" name="ID__INSTITUCION_IMPORTAR">
		         <?php        
				foreach($instituciones as $institucion)
				{?>     				
							<option value="<?=$institucion["ID__INSTITUCION"]?>"><?=$institucion["VCH_NOMBRE"]?></option>			
				<?php
				}
				?>
		       </select>
		     </div>
	   </div>
	</div>
	<div class="col-lg-6">
		<div class="form-group">
		      <label class="control-label col-md-4">Archivo:</label>
		      <div class="col-md-8">
		        <input id="iptFotoEspecie" name="iptFotoEspecie" class="file" type="file">
		     </div>
	   </div>
	</div>
</div>
</form>
