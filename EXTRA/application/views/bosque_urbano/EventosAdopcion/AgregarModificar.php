<!--Botones que abriran los divs-->
<form id="formguardar" METHOD="POST">
<input type="hidden" id="form_ID__EVENTO" name="form_ID__EVENTO">
<input type="hidden" id="form_empaquetadoP" name="form_empaquetadoP">
<input type="hidden" id="ID__DOMICILIO" name="ID__DOMICILIO">
<input type="hidden" id="ID__COLONIA" name="ID__COLONIA">
	
<div class="row form-horizontal" style="padding-bottom:30px;">
  <div class="">
    <div class="tabbable">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Adopcion">Eventos de Adopción</a></li>
        <li><a data-toggle="tab" href="#Patrocinadores">Patrocinadores</a></li>
      </ul>
      <div class="panel panel-default" style="padding-bottom:50px; padding-right:50px !important;">
      <div class="tab-content">
        <!-- Div Datos Adopcion -->
        <div class="tab-pane in active" id="Adopcion">
          <div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
          </div>
          <div class="page-header">
              <h4>
                <b>Datos Adopción</b>
              </h4>
          </div>     
          <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4">Nombre:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_VCH_NOMBRE" name="form_VCH_NOMBRE">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Descripción:</label>
                <div class="col-lg-8">
                  <textarea style="resize: none;" class="form-control required" id="form_VCH_DESCRIPCION" name="form_VCH_DESCRIPCION"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Lugar:</label>
                <div class="col-lg-8">
                  <textarea style="resize: none;" class="form-control required" id="form_VCH_LUGAR" name="form_VCH_LUGAR"></textarea>
                </div>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4">Fecha Inicio:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_FEC_FECHAINICIO" name="form_FEC_FECHAINICIO" readonly>
                </div>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4">Fecha Fin:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_FEC_FECHAFIN" name="form_FEC_FECHAFIN" readonly>
                </div>
              </div>
          </div>
          <div class="col-lg-10">
            <div class="form-group">
                <label class="control-label col-lg-4">Campaña Publicitaria:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" id="form_VCH_COMPANIAPUBLICITARIA" name="form_VCH_COMPANIAPUBLICITARIA">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Cantidad de Árboles:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_NUM_CANTIDADARBOLES" name="form_NUM_CANTIDADARBOLES">
                </div>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4">Estatus:</label>
                <div class="radio col-lg-8">
                  <label class="radio-inline"><input type="radio" name="optradio" id="Activo" value="1">Activo</label>
                 <label class="radio-inline"><input type="radio" name="optradio" id="Inactivo" value="0">Inactivo</label>
               </div>
            </div>
          </div>
          <div class="col-lg-10">
            <div class="form-group">
                <label class="control-label col-lg-4">Contacto:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_VCH_CONTACTO" name="form_VCH_CONTACTO">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Cargo:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_VCH_CARGOCONTACTO" name="form_VCH_CARGOCONTACTO">
                </div>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4">Telefono:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_VCH_TELEFONOCONTACTO" name="form_VCH_TELEFONOCONTACTO">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Celular:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_VCH_CELULARCONTACTO" name="form_VCH_CELULARCONTACTO">
                </div>
              </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group">
                <label class="control-label col-lg-4">Correo Electronico:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control required" id="form_VCH_CORREOCONTACTO" name="form_VCH_CORREOCONTACTO">
                </div>
              </div>
          </div>
          <div class="form-group">
                <div class="checkbox col-lg-offset-2 col-lg-10">
                  <label class="checkbox-inline"><input id="chkDomicilio" type="checkbox" value="" onclick="abrirModal()">Domicilio</label>
                </div>
          </div>
          <div id="divDomicilio" class="row form-horizontal" hidden>
 <div class="col-lg-6">
  <div class="form-group">
    <label class="control-label col-lg-4">Estado:</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" id="divDomicilio-estado" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-4">Municipio:</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" id="divDomicilio-municipio" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-4">Código Postal:</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" id="divDomicilio-cp" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-4">Colonia:</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" id="divDomicilio-colonia" name="divDomicilio-colonia" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-4">Calle y Número:</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" id="divDomicilio-calle" name="divDomicilio-calle">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-4">Entre Calles:</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" id="divDomicilio-entre" name="divDomicilio-entre">
    </div>
  </div>
</div><!--col-->
</div><!--row-->
        </div>
        <!-- Div Datos Patrocinadores -->
      <div  class="tab-pane" id="Patrocinadores">
        <div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
          </div>
          <div class="page-header">
              <h4>
                <b>Datos Patrocinadores</b>
              </h4>
          </div> 
        <div class="col-lg-6">
          <div class="form-group">
              <label class="control-label col-lg-4">Empresa/Institución:</label>
              <div class="col-lg-8">
               <select class="form-control" id="empresainstitucion">
                <option value="0">---</option>
                 <?php          
				foreach($empresas as $empresa)
				{?>     				
					<option value="<?=$empresa["VCH_NOMBREEMPRESA"]?>"><?=$empresa["VCH_NOMBREEMPRESA"]?></option>				
				<?php
				}
				?>
               </select>
             </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group">
                <label class="control-label col-md-4">Institución:</label>
                <div class="col-md-8" id="divdeinputs">
					<div id="inp0">
                  <input id="iptFotoEspecie0" class="file" type="file"/>
                  </div>
               </div>
           </div>
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-primary" onclick="cancelarArchivo()"><i class="fa fa-close"></i> Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="agregarTablaPatrocinios()"><i class="fa fa-plus-circle"></i> Agregar</button>
        </div><br><br>
        <div class="row">
          <div class="col-lg-offset-1 col-lg-10">
             <?php 
/*
             $datos=array('Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','',
               'Patrocinador','Archivo','','');
              $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
               'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
              $this->table->set_template($template);
              $this->table->set_heading('Patrocinador','Archivo','','');
              echo  $this->table->generate($this->table->make_columns($datos,4));
*/
            ?>
            <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaPatrocinios" name="tablaPatrocinios" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Patrocinador
				</th>
				<th>
					Archivo
				</th>																	
			</tr>
			</thead>			
			<tbody>
			</tbody>			
			</table>      
          </div><!--col-->
        </div>
      </div>
      </div>
      </div>      
    </div>
  </div>
</div><!--row-->
<div class="text-right">   
    <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
    <button type="button" id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
</form>
