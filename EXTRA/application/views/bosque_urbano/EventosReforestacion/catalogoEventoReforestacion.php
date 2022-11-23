<div class="row form-horizontal" style="padding-left:20px">
  <div class="col-lg-12 form-group">
    <div class="form-inline">
      <button id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
      <button class="btn btn-primary"><i class="fa fa-trash"></i> Eliminar</button>
    </div>
  </div>
</div><!--row-->

<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
        <label class="control-label col-lg-4">ID Evento:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Nombre:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Tipo:</label>
        <div class="col-lg-8">
          <select class="form-control">
            <option>---</option>
          </select>
        </div>
      </div> 
  </div>
  <div class="col-lg-6">
    <div class="form-group">
          <div class="checkbox col-lg-offset-3">
            <label class="checkbox-inline"><input id="chkEvento" type="checkbox" value="" onclick="fechas()">Fechas del Evento</label>
          </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Fecha Inicio:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control" id="fechaInicio" disabled>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Fecha Fin:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control" id="fechafin" disabled>
        </div>
      </div>
      <div class="text-right">
        <button type="button" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
      </div>
  </div>
</div>

 <div class="row">
  <div class="col-lg-offset-1 col-lg-10">
   <?php 

   $datos=array('ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes',
     'ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes');
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('ID','Nombre Evento','Descripcion','Contacto','Celular','Correo Electronico','Prerrequisitos','Fecha Inicio','Fecha Fin', 'Tipo de Evento', 'Empresa/Institucion', 'Estimado de Asistentes', 'Total de asistentes');
echo  $this->table->generate($this->table->make_columns($datos,13));

?>
</div><!--col-->
</div><!--row-->