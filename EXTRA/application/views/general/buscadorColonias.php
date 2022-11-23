<div id="masivo">

<div id="buscadorColonias">
<div class="row form-horizontal">
  <div class="col-lg-6 col-md-8 col-sm-10">
    <div class="form-group">
      <label class="control-label col-lg-4 col-md-6 col-sm-4">Estado:</label>
      <div class="col-lg-8 col-md-6 col-sm-8">		  
        <select type="text" class="form-control" onchange="cargaciudades(this.value,0)" id="buscadorColonias-estado">
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
    <label class="control-label col-lg-4 col-md-6 col-sm-4">Ciudad:</label>
    <div class="col-lg-8 col-md-6 col-sm-8">
      <select type="text" class="form-control" id="buscadorColonias-ciudad">       
      </select>
    </div>
  </div>
</div>
<div class="col-lg-6 col-md-8 col-sm-10">
  <div class="form-group">
    <label class="control-label col-lg-4 col-md-6 col-sm-4">Colonia:</label>
    <div class="col-lg-8 col-md-6 col-sm-8">
      <input type="text" class="form-control" id="buscadorColonias-colonia">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-4 col-md-6 col-sm-4">Código Postal:</label>
    <div class="col-lg-8 col-md-6 col-sm-8">
      <input type="text" class="form-control" id="buscadorColonias-cp">
    </div>
  </div>
  <div class="form-group">
    <div class="pull-right">
      <button class="btn btn-primary"  onclick="buscarColonia()"><i class="fa fa-search"></i> Buscar</button>
      <button class="btn btn-primary" onclick="cambiaAagregar()"><i class="fa fa-plus-circle"></i> Agregar</button>
    </div>
  </div>
</div>
</div><!--row-->
<div class="row">
  <div class="col-lg-offset-1 col-lg-10">
   <?php 
	$datos=array();		
	foreach($colonias as $colonia)
	{	
		array_push($datos,"<button type=\"button\" class=\"btn btn-primary\" onClick=\"seleccionarColonia('".$colonia["ID__COLONIA"]."','".$colonia["estado"]."','".$colonia["municipio"]."','".$colonia["colonia"]."','".$colonia["VCH_CODIGOPOSTAL"]."')\"><i class=\"fa fa-check-circle\"></i> Seleccionar</button>",$colonia["estado"],$colonia["municipio"],$colonia["colonia"],$colonia["VCH_CODIGOPOSTAL"]);
	}

 $template= array('table_open'=>"<table data-toggle='table' data-classes='table table-hover table-no-bordered' data-height='500' >",
                 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('','Estado','Ciudad','Colonia','Código Postal');
echo  $this->table->generate($this->table->make_columns($datos,5));

?>
</div><!--col-->
</div><!--row-->
</div><!--principal de buscadorColonias-->

<div id="agregarColonia">
	<form id="agregarCol">
    <div class="row form-horizontal">
        <div class="col-lg-6 col-md-8 col-sm-10">
          <div class="form-group">
            <label class="control-label col-lg-4 col-md-6 col-sm-4">Estado:</label>
             <div class="col-lg-8 col-md-6 col-sm-8">
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
            <label class="control-label col-lg-4 col-md-6 col-sm-4">Ciudad:</label>
             <div class="col-lg-8 col-md-6 col-sm-8">
              <select type="text" class="form-control" id="agregarColonias-ciudad">				
			  </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4 col-md-6 col-sm-4">Colonia:</label>
             <div class="col-lg-8 col-md-6 col-sm-8">
              <input type="text" class="form-control" id="agregarColonias-colonia">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4 col-md-6 col-sm-4">Código Postal:</label>
             <div class="col-lg-8 col-md-6 col-sm-8">
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
</div>
<script type="text/javascript" src="<?=base_url()?>js/general.js"></script>
</div>
</div>
