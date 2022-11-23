<!--Botones que abriran los divs-->
<div class="form-horizontal" style="padding-bottom:50px;">
  <div class="">
    <div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#datosEmpresa">Datos Empresa</a></li>
        <li><a data-toggle="tab" href="#datosPatrocios">Patrocinios</a></li>
        <!--<li><a data-toggle="tab" href="#datosDonaciones">Donaciones</a></li>
        <li><a data-toggle="tab" href="#datosSeguimiento">Seguimiento</a></li>-->
    </ul>
    <div class="panel panel-default" style="padding-bottom:50px;">
      <div class="tab-content">
        <!-- Div Datos Empresa -->
          <div class="tab-pane in active" id="datosEmpresa">
          <form id="formGeneralEmpresa" method="post" enctype="multipart/form-data">

		<input type="hidden" name="ID__EMPRESA" id="ID__EMPRESA">
		<input type="hidden" name="ID__DOMICILIO" id="ID__DOMICILIO">
		<input type="hidden" name="ID__COLONIA" id="ID__COLONIA">
		<input type="hidden" name="empaquetadoP" id="empaquetadoP">
		<input type="hidden" name="empaquetadoD" id="empaquetadoD">
		<input type="hidden" name="empaquetadoS" id="empaquetadoS">
            <div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
                  <div class="page-header">
                      <h4>
                          <b>Datos Patrocinador</b>
                      </h4>
                  </div>
              <div class="col-lg-10">
                <div class="form-group">
                  <label class="control-label col-lg-4">*Patrocinador:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control required" id="form_VCH_NOMBREEMPRESA" name="form_VCH_NOMBREEMPRESA">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">*RFC:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control required" id="form_VCH_RFC" name="form_VCH_RFC">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">*Contacto:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control required" id="form_VCH_PERSONACONTACTO" name="form_VCH_PERSONACONTACTO">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Cargo:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="form_VCH_PUESTOCONTACTO" name="form_VCH_PUESTOCONTACTO">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label col-lg-4">*CorreoElectronico:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control required" id="form_VCH_CORREO" name="form_VCH_CORREO">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">*Telefono:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control required" id="form_VCH_TELEFONO" name="form_VCH_TELEFONO">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">*Giro Patrocinador:</label>
                  <div class="col-lg-8">
                   <select class="form-control required" id="form_VCH_GIROEMPRESA" name="form_VCH_GIROEMPRESA">
                    <option value="0">0</option>                    
                    <option value="1">1</option>
                    <option value="2">2</option>                    
                    <option value="3">3</option>
                    <option value="4">4</option>                    
                    <option value="5">6</option>                    
                   </select>
                 </div>
              </div>
              <div class="form-group">
                    <label class="control-label col-md-4">*Institución:</label>
                    <div class="col-md-8">
                      <input id="iptFotoEspecie required" name="iptFotoEspecie" class="file" type="file">
                   </div>
               </div>
            </div><!--col-->
            <div class="col-lg-6">
                <div class="form-group">        
                  <div class="col-lg-12">
                    <button class="btn btn-primary" onclick="GeneraPass()" id="btnGeneraPass"><i class="fa fa-key"></i> Nueva Contraseña</button>  
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">*Celular:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control required" id="form_VCH_CELULAR" name="form_VCH_CELULAR">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">*Empleados:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control required" id="form_NUM_EMPLEADOS" name="form_NUM_EMPLEADOS">
                  </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="form-group">
                  <label class="control-label col-lg-4">*Descripción:</label>
                  <div class="col-lg-8">
                    <textarea style="resize: none;" class="form-control required" id="form_VCH_COMENTARIOS" name="form_VCH_COMENTARIOS"></textarea>
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
					  <input type="text" class="form-control" id="divDomicilio-calle" name="VCH_CALLE">
					</div>
				  </div>
				  <div class="form-group">
					<label class="control-label col-lg-4">Entre Calles:</label>
					<div class="col-lg-8">
					  <input type="text" class="form-control" id="divDomicilio-entre" name="VCH_ENTRECALLE">
					</div>
				  </div>
				</div><!--col-->
				</div><!--row--> 
                
  
                
                
                
                
                
                
                
              
                
                
                
                		</form>
                
          </div>
          <!-- Div Patrocinios -->
          
          <div  class="tab-pane" id="datosPatrocios">
			<form id="formPatrocinios">
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
                    <label class="control-label col-lg-4">*Fecha Inicio:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control requiredPatrocinios" id="fechaInicioPatrocinio" name="fechaInicioPatrocinio" readonly >
                      <input type="hidden" id="ID__PATROCINIO" name="ID__PATROCINIO" >
                      <input type="hidden" id="indexrowPATROCINIO" name="indexrowPATROCINIO" >                      
                    </div>
                  </div>
                  <div class="form-group">
					  <label class="control-label col-lg-4">Tipo Periodo:</label>
					  <div class="col-lg-8">
					   <select class="form-control" id="tipoDonacion" name="tipoDonacion">
						<option value="1">---</option>
						<option value="2">Mensual</option>
						<option value="3">Semestral</option>
					   </select>
					 </div>
				  </div>
                  <div class="form-group">
					  <label class="control-label col-lg-4">Forma de Pago:</label>
					  <div class="col-lg-8">
					   <select class="form-control" id="formapagoDonacion" name="formapagoDonacion">
						<option value="1">---</option>
						<option value="2">Efectivo</option>
						<option value="3">Tarjeta de Credito</option>
						<option value="4">TRANSFERENCIA</option>
						<option value="5">ESPECIE</option>
						<option value="6">CHEQUE</option>
					   </select>
					 </div>
				  </div>
                  
                  <div class="form-group">
					<label class="control-label col-lg-4">Tipo de Seguimiento:</label>
					<div class="col-lg-8">
					 <select class="form-control" id="tipoSeguimiento" name="tipoSeguimiento">
					  <option value="0">---</option>
					  <option value="1">Visita</option>
					  <option value="2">Llamada</option>
					 </select>
				   </div>
				  </div>
                 
                 <div class="form-group">
					<label class="control-label col-lg-4">Responsable:</label>
					<div class="col-lg-8">
					 <select class="form-control" id="responsableSeguimiento" name="responsableSeguimiento">
						<?php
							foreach($responsables as $responsable)			
							{?>
								<option value="<?=$responsable["ID__USUARIO"]?>"><?=$responsable["VCH_NOMBRE"]?></option>
						 <?php
							}?>
					 </select>
				   </div>
				  </div>
                 
                </div>
                <div class="col-lg-6">
				  <div class="form-group">
                    <label class="control-label col-lg-4">*Fecha Fin:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control requiredPatrocinios" id="fechafinPatrocinio" name="fechafinPatrocinio" readonly>
                    </div>
                  </div>
					
                  <div class="form-group">
                    <label class="control-label col-lg-4">*Cantidad:</label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control requiredPatrocinios" id="cantidadPatrocinio" name="cantidadPatrocinio" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-4">Tipo Patrocinio:</label>
                    <div class="col-lg-8">
                     <select class="form-control " id="tipoPatrocinio" name="tipoPatrocinio">
					<?php
						foreach($patrocinios as $patrocinio)			
						{?>
							<option value="<?=$patrocinio["ID__PATROCINIO"]?>"><?=$patrocinio["VCH_TIPO"]?></option>
                	 <?php
						}?>
                     </select>
                   </div>                                     
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">*Acuerdos/Observaciones:</label>
                    <div class="col-lg-8">
                     <input type="text" class="form-control requiredPatrocinios" id="tipoPatrocinioDesc" name="tipoPatrocinioDesc" >					
                    </div>                                     
                </div>
               
                
                </div>
                <div class="text-right">
                  <button type="button" class="btn btn-primary" onclick="resetPatrocinio()"><i class="fa fa-close"></i> Cancelar</button>
                  <button type="button" class="btn btn-primary" onclick="agregarTablaPatrocinios()"><i class="fa fa-plus-circle" ></i> Guardar</button>
                </div><br><br>

                <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
					<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaPatrocinios">
					<thead style='background-color:#00A89C; color:#fff;' >
					<tr>
						<th>
							Tipo Patrocinio
						</th>
						<th>
							Descripcion de Patrocinio
						</th>
						<th>
							Cantidad
						</th>
						<th>
							Fecha Inicio
						</th>
						<th>
							Fecha Fin
						</th>																			
					</tr>
					</thead>					
					<tbdody></tbdody>					 	
					</table> 
                   
                </div><!--col-->
              </div>
              </form>
          </div>
         
           <!-- Div Donaciones -->
          <div  class="tab-pane" id="datosDonaciones" style="display:none">
			 <form id="formDonaciones">
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
                   <select class="form-control" id="tipoDonacion7" name="tipoDonacion7">
                    <option value="1">---</option>
                    <option value="2">Mensual</option>
                    <option value="3">Semestral</option>
                   </select>
                 </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-lg-4">Forma de Pago:</label>
                  <div class="col-lg-8">
                   <select class="form-control" id="formapagoDonacion7" name="formapagoDonacion7">
                    <option value="1">---</option>
                    <option value="2">Efectivo</option>
                    <option value="3">Tarjeta de Credito</option>
                   </select>
                 </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-lg-4">Donacion Periodica:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="periodicaDonacion7" name="periodicaDonacion7">
                  </div>
              </div>
              <div class="form-group">
                  <label class="control-label col-lg-4">Total donacion Economica:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="economicaDonacion7" name="economicaDonacion7" disabled>
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
                    <input type="text" class="form-control" id="InicioDonacion7" name="InicioDonacion7" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Fin:</label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="FinDonacion7" name="FinDonacion7" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">Otro tipo de Donación:</label>
                  <div class="col-lg-8">
                    <textarea style="resize: none;" class="form-control" id="otrosDonacion7" name="otrosDonacion7"></textarea>
                  </div>
                </div>
             </div>
            <div class="text-right">
                <button type="button"  class="btn btn-primary" onclick="resetDonacion7()"><i class="fa fa-close"></i> Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="agregartablaDonacion7()"><i class="fa fa-plus-circle"></i> Agregar</button>
            </div><br><br>

            <div class="row">
              <div class="col-lg-offset-1 col-lg-10">
                 <?php 
				/*
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
				*/
                ?>
                <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaDonacion">
					<thead style='background-color:#00A89C; color:#fff;' >
					<tr>
						<th>
							Donacion Periodica
						</th>
						<th>
							Tipo de Periodo
						</th>
						<th>
							Total Donacion Economica
						</th>
						<th>
							Fecha Inicio
						</th>																			
						<th>
							Forma de Pago
						</th>																			
						<th>
							Otro tipo de Donacion
						</th>																			
					</tr>
					</thead>					
					<tbdody></tbdody>					 	
				</table> 
              </div><!--col-->
            </div>
           </form>
          </div>
          <!-- Div Seguimiento -->
          <div  class="tab-pane" id="datosSeguimiento" style="display:none">
			<form id="formSeguimiento">
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
                  <textarea style="resize: none;" class="form-control" id="observacionesSeguimiento7" name="observacionesSeguimiento7"></textarea>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="control-label col-lg-4">Fecha:</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" id="FechaSeguimiento7" name="FechaSeguimiento7" readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-4">Tipo de Seguimiento:</label>
                <div class="col-lg-8">
                 <select class="form-control" id="tipoSeguimiento7" name="tipoSeguimiento7">
                  <option value="0">---</option>
                  <option value="1">Visita</option>
                  <option value="2">Llamada</option>
                 </select>
               </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label class="control-label col-lg-4">Responsable:</label>
                <div class="col-lg-8">
                 <select class="form-control" id="responsableSeguimiento7" name="responsableSeguimiento7">
					<?php
						foreach($responsables as $responsable)			
						{?>
							<option value="<?=$responsable["ID__USUARIO"]?>"><?=$responsable["VCH_NOMBRE"]?></option>
                	 <?php
						}?>
                 </select>
               </div>
              </div>
              <div class="text-right">
                <button type="button" class="btn btn-primary" onclick="resetSeguimiento7()"><i class="fa fa-close"></i> Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="agregartablaSeguimiento7()"><i class="fa fa-plus-circle"></i> Agregar</button>
              </div>
            </div><br><br>

            <div class="row">
            <div class="col-lg-offset-1 col-lg-10">
               
              <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaSeguimiento">
					<thead style='background-color:#00A89C; color:#fff;' >
					<tr>
						<th>
							Acuerdos/Observaciones
						</th>
						<th>
							Tipo Seguimiento
						</th>						
						<th>
							Responsable
						</th>
						<th>
							Fecha
						</th>																			
																									
					</tr>
					</thead>					
					<tbdody></tbdody>					 	
				</table>
            </div><!--col-->        
            </form>   
          </div>
           
          </div>
          </div>
      </div>
    </div>
  </div>
</div><!--row-->

<div class="text-right">   
    <button class="btn btn-primary" onclick="guardar()">Guardar</button>
    <button id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
