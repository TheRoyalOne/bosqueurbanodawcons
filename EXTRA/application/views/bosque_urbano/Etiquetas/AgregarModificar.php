<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Patrocinador:</label>
      <div class="col-lg-8">
		<select class="form-control" id="ID__EMPRESA" name="ID__EMPRESA" >
			<?php        
			foreach($empresas as $empresa)
			{?>     				
					<option value="<?=$empresa["ID__EMPRESA"]?>"><?=$empresa["VCH_NOMBREEMPRESA"]?></option>			
			<?php
			}
			?>
		</select>
        <!--<input type="text" class="form-control required" id="form_VCH_NOMBRE" name="form_VCH_NOMBRE">-->
      </div>
    </div>
   
    <div class="form-group">
      <label class="control-label col-lg-4">A&ntilde;o:</label>
      <div class="col-lg-8">
		<input type="number" min="2015" max="2035" class="form-control requiredb" id="VCH_ANIO" name="VCH_ANIO">
      </div>
    </div>
    <!--<div class="form-group">
      <label class="control-label col-lg-4">Correo Electrónico:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control required" id="form_VCH_CORREO" name="form_VCH_CORREO">
      </div>
    </div>-->
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label class="control-label col-lg-4">Especie:</label>
        <div class="col-lg-8">
			 <select class="form-control" id="ID__ESPECIE" name="ID__ESPECIE" >
			<?php        
			foreach($especies as $especie)
			{?>     				
					<option value="<?=$especie["ID__ESPECIE"]?>"><?=$especie["VCH_NOMBRECOMUN"]?></option>			
			<?php
			}
			?>          
			</select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Cantidad:</label>
        <div class="col-lg-8">
          <input type="number" min="1" max="5000" class="form-control requiredb" id="NUM_CANTIDAD" name="NUM_CANTIDAD">
        </div>
      </div>      
  </div><!--col--> 
</div><!--col-->

<div class="text-right">
    <button id="botonguardar" class="btn btn-default" onclick="generar()">Crear</button>
    <button id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
