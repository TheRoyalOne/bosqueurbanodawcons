<!--Botones que abriran los divs-->
<div class="form-horizontal" style="padding-bottom:10px;">
  <div class="">
    <div class="tabbable">
    	<ul class="nav nav-tabs">
	        <li class="active"><a data-toggle="tab" href="#Genera">Datos Generales</a></li>
	        <li><a data-toggle="tab" href="#Especies">Especies</a></li>
	        <li><a data-toggle="tab" href="#Patrocinadores">Patrocinadores</a></li>
	        <li><a data-toggle="tab" href="#GuardaBosqueUrbano">GuardaBosqueUrbano</a></li>
    	</ul>
	    <div class="panel panel-default" style="padding-bottom:30px; padding-right:20px;">
	    	<div class="tab-content">
	    		<!-- Div Datos Generales -->
	    		<div class="tab-pane in active" id="Genera">
	    			<div class="col-lg-1 col-md-1 col-xs-12">
              &nbsp;
            </div>
            <div class="page-header">
              <h4>
                <b>Datos Generales</b>
              </h4>
            </div>
            <div class="form-group">
                <div class="col-lg-10">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Id del Evento:</label>
                      <div class="col-lg-8">
                        <input type="text" class="form-control ">
                      </div>
                    </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Nombre:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control ">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Descripción:</label>
                    <div class="col-lg-8">
                      <textarea style="resize: none;" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Contacto:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control ">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Prerrequisitos:</label>
                    <div class="col-lg-8">
                      <textarea style="resize: none;" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Lugar del Evento:</label>
                    <div class="col-lg-8">
                      <textarea style="resize: none;" class="form-control"></textarea>
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Fecha Inicio:</label>
                      <div class="col-lg-8">
                        <input type="text" class="form-control" id="fechaInicio1">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-4">foto del Mapa:</label>
                      <div class="col-md-8">
                        <input id="iptFotoEspecie" class="file" type="file">
                     </div>
                  </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Fecha Fin:</label>
                      <div class="col-lg-8">
                        <input type="text" class="form-control" id="fechafin1">
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Tipo Patrocinio:</label>
                      <div class="col-lg-8">
                         <select class="form-control">
                          <option>---</option>
                         </select>
                     </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Estimado de Interes:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control ">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Total de Asistentes:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control ">
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Evaluación y seguimiento:</label>
                      <div class="col-lg-8">
                        <textarea style="resize: none;" class="form-control"></textarea>
                      </div>
                   </div>
                  </div>
            </div>           
          </div>
	    		<!-- Div Especies -->
          <div  class="tab-pane" id="Especies">
            <div class="col-lg-1 col-md-1 col-xs-12">
              &nbsp;
            </div>
            <div class="page-header">
              <h4>
                <b>Especies</b>
              </h4>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Especie:</label>
                      <div class="col-lg-8">
                         <select class="form-control">
                          <option>---</option>
                         </select>
                     </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <label class="control-label col-lg-4">Total de Asistentes:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control ">
                    </div>
                  </div>                                   
                </div>
                <div class="col-lg-12" style="padding-bottom:20px;">
                    <div class="text-right">
                      <button class="btn btn-primary"><i class="fa fa-close"></i> Cancelar</button>
                      <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
                  </div> 
                </div><br><br>
                <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                   <?php 

                   $datos=array('Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','',
                     'Especie','Cantidad','','');
                    $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
                     'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
                    $this->table->set_template($template);
                    $this->table->set_heading('Especie','Cantidad','','');
                    echo  $this->table->generate($this->table->make_columns($datos,4));

                  ?>
                </div><!--col-->
              </div>
            </div>
          </div>   
          	<!-- Div Especies -->
          	<div  class="tab-pane" id="Patrocinadores">
          		<div class="col-lg-1 col-md-1 col-xs-12">
                &nbsp;
            	</div>
              <div class="page-header">
                <h4>
                  <b>Patrocinadores</b>
                </h4>
              </div>
              <div class="form-group">
                <div class="col-lg-6">
                  <div class="form-group">
                      <label class="control-label col-lg-4">Especie:</label>
                      <div class="col-lg-8">
                         <select class="form-control">
                          <option>---</option>
                         </select>
                     </div>
                    </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="control-label col-md-4">Institución:</label>
                    <div class="col-md-8">
                      <input id="iptFotoEspecie" class="file" type="file">
                   </div>
                  </div>
                </div>
                <div class="col-lg-12" style="padding-bottom:20px;">
                    <div class="text-right">
                      <button class="btn btn-primary"><i class="fa fa-close"></i> Cancelar</button>
                      <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
                  </div> 
                </div><br><br>
                <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                   <?php 

                   $datos=array('Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','',
                     'Patrocinador','Archivo','','','');
                    $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
                     'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
                    $this->table->set_template($template);
                    $this->table->set_heading('Patrocinador','Archivo','','','');
                    echo  $this->table->generate($this->table->make_columns($datos,5));

                  ?>
                </div><!--col-->
              </div>
              </div>
          	</div>
          	<!-- Div Guarda Bosques -->
          	<div  class="tab-pane" id="GuardaBosqueUrbano">
          		<div class="col-lg-1 col-md-1 col-xs-12">
                &nbsp;
            	</div>
              <div class="page-header">
                <h4>
                  <b>GuardaBosque Urbano</b>
                </h4>
              </div>
              <div class="form-group">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Correo electronico:</label>
                      <div class="col-lg-8">
                        <input type="text" class="form-control">
                      </div>                                            
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="col-lg-5">
                        <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
                    </div>
                  </div>
                  <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                   <?php 

                   $datos=array('GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','',
                     'GuardaBosque','Correo electronico','','');
                    $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
                     'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
                    $this->table->set_template($template);
                    $this->table->set_heading('GuardaBosque','Correo electronico','','');
                    echo  $this->table->generate($this->table->make_columns($datos,4));

                  ?>
                </div><!--col-->
              </div>
              </div>
          	</div>
	    	</div>
	    </div>
    </div>
  </div>
</div>
<div class="text-right">   
    <button class="btn btn-primary">Guardar</button>
    <button id="btnRegresar" class="btn btn-default">Regresar</button>
</div>