<div class="row form-horizontal">
  <div class="col-lg-6">
      <div class="form-group">
        <label class="control-label col-lg-4">Especies:</label>
        <div class="col-lg-8">
          <select class="form-control" onchange="cargarPrecios(this.value)">
		   <option value="0">---</option>
           <?php
           foreach($especies as $especie)
           {
           ?>
           <option value="<?=$especie["ID__ESPECIE"]?>"><?=$especie["VCH_NOMBRECOMUN"]?></option>
           
		<?php
			}
		?>
          </select>
        </div>
      </div>
  </div>
</div>

  <div class="row form-horizontal">
    <div class="col-lg-6">
      <div class="form-group">
        <label class="control-label col-lg-6"> Meses / Precio Publico </label>
      </div>
    </div>
  </div>

<div class="row form-horizontal">
  <div class="col-lg-6">
      <div class="form-group">
        <label class="control-label col-lg-4">3:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p3" name="p3">
        </div>
        <br>
      </div>
    <div class="form-group">
        <label class="control-label col-lg-4">6:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p6" name="p6">
        </div>
    </div>    
    <div class="form-group">
      <label class="control-label col-lg-4">9:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p9" name="p9">
      </div> 
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">12:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p12" name="p12">
      </div> 
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">18:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p18" name="p18">
      </div> 
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">24:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p24" name="p24">
      </div> 
    </div>
  </div>

    <div class="col-lg-6">
      <div class="form-group">
        <label class="control-label col-lg-4">30:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p30" name="p30">
        </div>
      </div>
     <div class="form-group">
        <label class="control-label col-lg-4">36:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p36" name="p36">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">42:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p42" name="p42">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">48:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p48" name="p48">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">60:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p60" name="p60">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">72:</label>
        <div class="col-lg-8">
            <input type="number" min="0" class="form-control" id="p72" name="p72">
        </div>
      </div>
    </div>
</div>

  <div class="text-right">
    <button class="btn btn-primary" onclick="guardar()"> Guardar</button>
</div>
