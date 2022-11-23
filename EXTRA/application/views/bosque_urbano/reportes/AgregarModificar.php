<!--Botones que abriran los divs-->
<div class="form-horizontal" style="padding-bottom:50px;">
  <div class="">
    <div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#datosEmpresa">Datos Empresa</a></li>
        <li><a data-toggle="tab" href="#datosPatrocios">Patrocinios</a></li>
        <li><a data-toggle="tab" href="#datosDonaciones">Donaciones</a></li>
        <li><a data-toggle="tab" href="#datosSeguimiento">Seguimiento</a></li>
    </ul>
    <div class="panel panel-default" style="padding-bottom:50px;">
      <div class="tab-content">
        <!-- Div Datos Empresa -->
          <div class="tab-pane in active" id="datosEmpresa">
            <div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
                  <div class="page-header">
                      <h4>
                          <b>Datos Empresa</b>
                      </h4>
                  </div>
              <div class="col-lg-10">
                <div class="form-group">
                  <label class="control-label col-lg-4">Empresa/Institucion:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control ">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">RFC:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Contacto:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Cargo:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4">CorreoElectronico:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Telefono:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Giro Empresa:</label>
                  <div class="col-lg-8">
                   <select class="form-control">
                    <option>---</option>
                    <option>Desarrollo</option>
                    <option>Produccion</option>
                   </select>
                 </div>
              </div>
              <div class="form-group">
                    <label class="control-label col-md-4">Institución:</label>
                    <div class="col-md-8">
                      <input id="iptFotoEspecie" class="file" type="file">
                   </div>
               </div>
            </div><!--col-->
            <div class="col-lg-6">
                <div class="form-group">        
                  <div class="col-lg-12">
                    <button class="btn btn-primary"><i class="fa fa-key"></i> Nueva Contraseña</button>  
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Celular:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Empreados:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control">
                  </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="form-group">
                  <label class="control-label col-lg-4">Comentarios:</label>
                  <div class="col-lg-8">
                    <textarea style="resize: none;" class="form-control"></textarea>
                  </div>
                </div>
            </div>
                <div class="form-group">
                    <div class="checkbox col-lg-offset-2 col-lg-10">
                      <label class="checkbox-inline"><input id="chkDomicilio" type="checkbox" value="" onclick="abrirModal()">Domicilio</label>
                    </div>
                </div>
          </div>
          <!-- Div Patrocinios -->
          <div  class="tab-pane" id="datosPatrocios">
            <div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
                  <div class="page-header">
                      <h4>
                          <b>Datos Patrocinios</b>
                      </h4>
                  </div>
              <div class="col-lg-6">
                    <div class="form-group">
                    <label class="control-label col-lg-4">Fecha Inicio:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="fechaInicio">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Fecha Fin:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="fechafin">
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="control-label col-lg-4">Cantidad:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Tipo Patrocinio:</label>
                    <div class="col-lg-8">
                     <select class="form-control">
                      <option>---</option>
                      <option>Caoba</option>
                      <option>Economico</option>
                     </select>
                   </div>
                </div>
                </div>
                <div class="text-right">
                  <button class="btn btn-primary"><i class="fa fa-close"></i> Cancelar</button>
                  <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
                </div><br><br>

                <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                   <?php 

                   $datos=array('Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','',
                     'Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','');
                    $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
                     'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
                    $this->table->set_template($template);
                    $this->table->set_heading('Tipo Patrocinio','Cantidad','Fecha Inicio','Fecha Fin','','');
                    echo  $this->table->generate($this->table->make_columns($datos,6));

                  ?>
                </div><!--col-->
              </div>
          </div>
           <!-- Div Donaciones -->
          <div  class="tab-pane" id="datosDonaciones">
            <div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
                  <div class="page-header">
                      <h4>
                          <b>Datos Donaciones</b>
                      </h4>
                  </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4">Tipo Periodo:</label>
                  <div class="col-lg-8">
                   <select class="form-control">
                    <option>---</option>
                    <option>Mensual</option>
                    <option>Semestral</option>
                   </select>
                 </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-lg-4">Forma de Pago:</label>
                  <div class="col-lg-8">
                   <select class="form-control">
                    <option>---</option>
                    <option>Efectivo</option>
                    <option>Tarjeta de Credito</option>
                   </select>
                 </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-lg-4">Donacion Periodica:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-lg-4">Total donacion Economica:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" disabled>
                  </div>
              </div>
            </div>
             <div class="col-lg-6">
              <div class="form-group">
                  <label class="control-label col-lg-4">Periodo Donacion:</label>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Inicio:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="Inicio">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Fin:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="Fin">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Otro tipo de Donación:</label>
                  <div class="col-lg-8">
                    <textarea style="resize: none;" class="form-control"></textarea>
                  </div>
                </div>
             </div>
            <div class="text-right">
                <button class="btn btn-primary"><i class="fa fa-close"></i> Cancelar</button>
                <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
            </div><br><br>

            <div class="row">
              <div class="col-lg-offset-1 col-lg-10">
                 <?php 

                 $datos=array('Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '',
                   'Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '');
                  $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
                   'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
                  $this->table->set_template($template);
                  $this->table->set_heading('Donacion Periodica','Tipo de Periodo','Total Donacion Economica','Fecha Inicio', 'Forma de Pago', 'Otro tipo de Donacion', '', '');
                  echo  $this->table->generate($this->table->make_columns($datos,8));

                ?>
              </div><!--col-->
            </div>
          </div>
          <!-- Div Seguimiento -->
          <div  class="tab-pane" id="datosSeguimiento">
            <div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
                  <div class="page-header">
                      <h4>
                          <b>Datos Seguimiento</b>
                      </h4>
                  </div>
              <div class="col-lg-10">
                <div class="form-group">
                <label class="control-label col-lg-4">Acuerdos/Observaciones:</label>
                <div class="col-lg-8">
                  <textarea style="resize: none;" class="form-control"></textarea>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="control-label col-lg-4">Fecha:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" id="Fecha">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Tipo de Seguimiento:</label>
                <div class="col-lg-8">
                 <select class="form-control">
                  <option>---</option>
                  <option>Visita</option>
                  <option>Llamada</option>
                 </select>
               </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="control-label col-lg-4">Responsable:</label>
                <div class="col-lg-8">
                 <select class="form-control">
                  <option>---</option>
                  <option>Administrador</option>
                  <option>Empleado</option>
                 </select>
               </div>
              </div>
              <div class="text-right">
                <button class="btn btn-primary"><i class="fa fa-close"></i> Cancelar</button>
                <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
              </div>
            </div><br><br>

            <div class="row">
            <div class="col-lg-offset-1 col-lg-10">
               <?php 

               $datos=array('Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','',
                 'Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','');
                $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
                 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
                $this->table->set_template($template);
                $this->table->set_heading('Acuerdos/Observaciones','Tipo Seguimiento','Responsable','Fecha','','');
                echo  $this->table->generate($this->table->make_columns($datos,6));

              ?>
            </div><!--col-->
          </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</div><!--row-->

<div class="text-right">   
    <button class="btn btn-primary">Guardar</button>
    <button id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
