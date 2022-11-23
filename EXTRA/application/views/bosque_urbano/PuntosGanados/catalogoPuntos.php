<div class="row form-horizontal">
	<div class="col-lg-8">
		<div class="form-group">
            <label class="control-label col-md-4">Subir Puntos:</label>
            <div class="col-md-8">
            	<input id="iptFotoEspecie" class="file" type="file">
            </div>         
        </div>
		<div class="form-group">
        <label class="control-label col-lg-4">GuardaBosque Urbano:</label>
        <div class="col-lg-8">
          <select class="form-control">
            <option>---</option>
          </select>
        </div>
      </div>
	</div>
	<div class="col-lg-4">
       	<button type="button" class="col-offset-lg-10 btn btn-default"><i class="fa fa-file-excel-o"></i> Exportar a Excel</button>
        <button type="button" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
    </div>
	<div class="row">
	  <div class="col-lg-offset-1 col-lg-10">
	   <?php 

	   $datos=array('GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta',
	     'GuardaBosque','Fecha','Pregunta');
	$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
	 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
	$this->table->set_template($template);
	$this->table->set_heading('GuardaBosque','Fecha','Pregunta');
	echo  $this->table->generate($this->table->make_columns($datos,3));

	?>
	</div><!--col-->
	</div><!--row-->
</div>