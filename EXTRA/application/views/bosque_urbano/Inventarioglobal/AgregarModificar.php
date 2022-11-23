<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Procedencia:</label>
      <div class="col-lg-8">
		<select class="form-control" id="procedencia_id" name="procedencia_id" >
			<?php        
			foreach($Procedencias as $Procedencia)
			{?>     				
					<option value="<?=$Procedencia["procedencia_id"]?>"><?=$Procedencia["procedencia_nombre"]?></option>			
			<?php
			}
			?>
		</select>
        <!--<input type="text" class="form-control required" id="form_VCH_NOMBRE" name="form_VCH_NOMBRE">-->
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Fecha de germinado:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control required" id="FEC_FECHAGERMINACION" name="FEC_FECHAGERMINACION" readonly>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Ubicacion/Zona:</label>
      <div class="col-lg-8">
       <select class="form-control" id="ID__UBICACION" name="ID__UBICACION" >
			<?php        
			foreach($ubicaciones as $ubicacion)
			{?>     				
					<option value="<?=$ubicacion["ID__UBICACION"]?>"><?=$ubicacion["VCH_NOMBRE"]?></option>			
			<?php
			}
			?>
		</select>
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
          <input type="numeric" class="form-control required" id="NUM_CANTIDAD" name="NUM_CANTIDAD" min="1">
        </div>
      </div>
      <div class="form-group">
		  <label class="control-label col-lg-4">Tipo de bolsa:</label>
		  <div class="col-lg-8">
			  <select class="form-control" id="contenedor_id" name="contenedor_id" >
			<?php        
			foreach($contenedores as $contenedor)
			{?>     				
					<option value="<?=$contenedor["contenedor_id"]?>"><?=$contenedor["contenedor_nombre"]?></option>			
			<?php
			}
			?>  
			</select>  
		  </div>
		</div>
  </div><!--col--> 
</div><!--col-->

<div class="text-right">

    <button id="botonguardar" class="btn btn-primary" onclick="guardar()">Guardar</button>
    <button id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
