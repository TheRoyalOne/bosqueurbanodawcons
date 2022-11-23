<div class="row form-horizontal">
<div class="col-md-6">
    <div class="form-group">
      <label class="control-label col-md-4">Estado:</label>
      <div class="col-md-8">
        <select type="text" class="form-control">
         <option>Colima</option>
         <option>Ciudad de México</option>
         <option>Jalisco</option>
       </select>
     </div>
   </div>
   <div class="form-group">
    <label class="control-label col-md-4">Ciudad:</label>
    <div class="col-md-8">
      <select type="text" class="form-control">
        <option>Villa de Alvarez</option>
        <option>Aragón</option>
        <option>Zapopan</option>
      </select>
    </div>
  </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label class="control-label col-md-4">Colonia:</label>
    <div class="col-md-8">
      <input type="text" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-4">Código Postal:</label>
    <div class="col-md-8">
      <input type="text" class="form-control">
    </div>
  </div>    
</div>
</div>
<div class="text-right">
      <button class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
      <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
</div><br><br>
<div class="row">
  <div class="col-md-offset-1 col-md-10">
   <?php 

   $datos=array("<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100',
     "<button type='button' class='btn btn-primary' onClick='seleccionarColonia();'><i class='fa fa-check-circle'></i> Seleccionar</button>",'Jalisco','Zapopan','zapopan centro','45100'); 
$template= array('table_open'=>"<table data-toggle='table' data-classes='table table-hover table-no-bordered' data-height='300' >",
                 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('','Estado','Ciudad','Colonia','Código Postal');
echo  $this->table->generate($this->table->make_columns($datos,5));

?>
</div><!--col-->
</div><!--row-->