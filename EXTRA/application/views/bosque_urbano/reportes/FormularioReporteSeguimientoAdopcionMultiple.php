<div class="row" id="catalogo">  
</div><!--row-->
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Guardabosques:</label>
       <div class="col-lg-8">
        <select class="form-control">
			
		</select>			
      </div>
    </div>    
    <div class="form-group">
      <label class="control-label col-lg-4">Embajador:</label>
       <div class="col-lg-8">
        <select class="form-control">				
		</select>			
      </div>
    </div>    
  </div><!--col-->
  <div class="col-lg-6">
    <div class="form-group">
      
       <div class="checkbox col-lg-offset-4 col-lg-12">
          <label class="checkbox-inline"><input id="chkEvento" type="checkbox" value="" onclick="fechas()">Fechas de seguimiento</label> 
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-lg-4">Fecha Inicio:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control" id="fechaInicio" >
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Fecha Fin:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control" id="fechafin" >
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

   $datos=array(); 
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('Fecha','Embajador','Folio Solicitud/ ID Evento','Especie','Vivos','Reubicados','Enfermos','Observaciones','Seguimiento');
echo  $this->table->generate($this->table->make_columns($datos,4));

?>
</div><!--col-->
  </div><!--row-->
