<div class="row" id="catalogo">  
</div><!--row-->
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Especie:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control">
      </div>
    </div>    
  </div><!--col-->
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Procedencia:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control">
      </div>
    </div>
    
    <div class="form-group">
      <div class="pull-right">
		<button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-save-file"></i> Crear reporte</button>
        <button type="button" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
      </div>
    </div>
  </div><!--col-->
</div><!--row-->

<div class="row">
  <div class="col-lg-offset-1 col-lg-10">
   <?php 

   $datos=array('TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98','TEST','LUGAR 1','100','98',); 
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('Nombre Comun','Procedencia','Cantidad Inventario','Cantidad adopciones');
echo  $this->table->generate($this->table->make_columns($datos,4));

?>
</div><!--col-->
  </div><!--row-->
