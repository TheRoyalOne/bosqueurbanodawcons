    <form id="agregarCol">
    <div class="row form-horizontal">
        <div class="col-lg-6">
          <div class="form-group">
            <label class="control-label col-lg-4">Estado:</label>
            <div class="col-lg-8">
              <select type="text" class="form-control" onchange="cargaciudades(this.value,1)" id="agregarColonias-estado">
                <?php
					foreach($estados as $estado)
					{
					?>
						<option value="<?=$estado["ID__ESTADO"]?>"><?=$estado["VCH_NOMBRE"]?></option>
					<?php 
					}
					?>					
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Ciudad:</label>
            <div class="col-lg-8">
              <select type="text" class="form-control" id="agregarColonias-ciudad">				
			  </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Colonia:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="agregarColonias-colonia">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Código Postal:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="agregarColonias-cp">
            </div>
          </div>
          <div class="row">
			<div class="pull-right form-inline">
			
			<button  type="button" class="btn btn-primary" id="agregarColonia" onclick="altaColonia()"><i class="fa fa-plus-circle"></i> Agregar</button>
			<button id="btnRegresarCatUsuarios" type="button" class="btn btn-default form-control" onclick="cancelaraltaColonia()">Regresar</button>
            </div>
          </div>
          
				
          
          
    </div><!--row-->
	</form>   
    
