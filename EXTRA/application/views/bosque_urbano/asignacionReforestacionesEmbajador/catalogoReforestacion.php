<div class="row form-horizontal">
	<div class="col-lg-7">
        <div class="form-group">
            <label class="control-label col-lg-4">Evento de Reforestación:</label>
            <div class="col-lg-8">
                <input type="text" class="form-control">
            </div>                                            
        </div>
    </div>
    <div class="col-lg-2">
        <div class="col-lg-5">
            <button type="button" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
        </div>
    </div>
     <div class="row">
	  <div class="col-lg-offset-1 col-lg-10">
	   <?php 

	   $datos=array('ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad', 
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad',
	     'ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad'); 
	$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
	 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
	$this->table->set_template($template);
	$this->table->set_heading('ID de Evento','Nombre del Evento','Descripción','Fecha Inicio', 'Fecha Fin', 'Especie', 'Cantidad');
	echo  $this->table->generate($this->table->make_columns($datos,7));

	?>
	</div><!--col-->
	</div><!--row-->
	<br><br>
	<div class="col-lg-5">
	  <div class="form-group">
        <label class="control-label col-lg-4">Institución:</label>
        <div class="col-lg-8">
          <select class="form-control">
            <option>---</option>
          </select>
        </div>
      </div> 
	</div>
	<div class="col-lg-5">
	  <div class="form-group">
        <label class="control-label col-lg-4">Embajador:</label>
        <div class="col-lg-8">
          <select class="form-control">
            <option>---</option>
          </select>
        </div>
      </div> 
      <div class="text-right">
        <button type="button" class="col-offset-lg-10 btn btn-primary">Asignar</button>
      </div><br><br>
	</div>
	<div class="row">
	  <div class="col-lg-offset-1 col-lg-10">
	   <?php 

	   $datos=array('Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles',
	     'Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles');
	$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
	 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
	$this->table->set_template($template);
	$this->table->set_heading('Embajador','Id Evento','Nombre','Descripción','Fecha Inicio', 'Fecha Fin','Especie', 'Cantidad de Arboles');
	echo  $this->table->generate($this->table->make_columns($datos,8));

	?>
	</div><!--col-->
	</div><!--row-->
</div>