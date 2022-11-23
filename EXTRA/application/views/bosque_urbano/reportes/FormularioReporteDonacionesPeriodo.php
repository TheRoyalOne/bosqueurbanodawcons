<div class="row" id="catalogo">  
</div><!--row-->
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Período:</label>
       <div class="col-lg-8">
        <select class="form-control">
			<option>Mensual</option>
			<option>Semestral</option>
			<option>Anual</option>
		</select>			
      </div>
    </div>    
    <div class="form-group">
      <label class="control-label col-lg-4">Estatus:</label>
       <div class="col-lg-8">
        <select class="form-control">
			<option>Activos</option>
			<option>Inactivos</option>			
		</select>			
      </div>
    </div>    
  </div><!--col-->
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Empresa/ Institución::</label>
      <div class="col-lg-8">
        <select class="form-control"></select>	
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

   $datos=array('
   <button onclick="cargarEmpresaAmodificar(1)" class="x-btn-text" type="button" style="position: relative; width: 172px; height: 22px;" tabindex="0" aria-describedby="x-auto-7104">
		Empresa/Institución
		<img 
		style="width: 16px; height: 16px; background: url(&quot;http://192.168.7.195/BosqueUrbano/com.extraac.Main/8AE1DDCED350416AECB1456B230951B4.cache.png&quot;) 
		-276px -29px no-repeat; position: absolute; left: 148px; top: 2px;" 
		></button>
   ','Dawcons','Victor rojas','33303070100','2','Anual','2016-05-19','2016-05-19','0','Efectivo',''); 
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('Ver detalles','Empresa','Contacto','Télefono','Donación periódica','Período','Fecha inicio','Fecha Fin','Total Donación','Forma pago','Otro tipo de donacion');
echo  $this->table->generate($this->table->make_columns($datos,11));

?>
</div><!--col-->
  </div><!--row-->
