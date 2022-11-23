<!--Botones que abriran los divs-->

<form id="agregarmodificar">
	<input type="hidden" name="ID__CVETALLER" id="ID__CVETALLER" value="0">
<div class="form-horizontal" style="padding-bottom:50px;">
  <div class="">
    <div class="tabbable">
    	<ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#datosPrincipales">Datos Principales</a></li>
        <li><a data-toggle="tab" href="#datoSesiones">Datos Sesiones</a></li>
        <li><a data-toggle="tab" href="#Contacto">Contacto</a></li>
        <li><a data-toggle="tab" href="#Tallerista">Tallerista</a></li>
        <li><a data-toggle="tab" href="#Embajadores">Prestador de Servicio</a></li>
        <li><a data-toggle="tab" href="#Asistentes">Asistentes</a></li>
    </ul>
    <div class="panel panel-default" style="padding-bottom:50px; padding-right:20px;">
      <div class="tab-content">
      	<!-- Div datosPrincipales -->
      	<div class="tab-pane in active" id="datosPrincipales">
      		<div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
            <div class="page-header">
                <h4>
                    <b>Datos Principales</b>
                </h4>
            </div>
            <div class="form-group">
            	<div class="col-lg-6">
            		<div class="form-group">
                  		<label class="control-label col-lg-4">Clave Taller:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control " name="VCH_CLAVETALLER" readonly="readonly">
                  		</div>
                	</div>
                	<div class="form-group">
                  		<label class="control-label col-lg-4">*Nombre Taller:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control required" name="VCH_TALLER">
                  		</div>
                	</div>
                	<div class="form-group">
                  		<label class="control-label col-lg-4">Tipo Taller:</label>
                  		<div class="col-lg-8">
                   			<select class="form-control" name="ID__TALLER">
                    			<?php
								foreach($catalogotalleres as $catalogotaller)			
								{?>
								 <option value="<?=$catalogotaller["ID__TALLER"]?>"><?=$catalogotaller["VCH_NOMBRE"]?></option>			
								<?php
								 }?>                
                   			</select>
                 		</div>
              		</div>
                	<div class="form-group">
                  		<label class="control-label col-lg-4">*Precio Taller:</label>
                  		<div class="col-lg-8">
                   			<input type="number" min="0" step="0.5" class="form-control required" name="VCH_PRECIO">
                 		</div>
              		</div>
            	</div>
            	<div class="col-lg-6">
            		<div class="form-group">
                  		<label class="control-label col-lg-4">Numero de Sesiones:</label>
                  		<div class="col-lg-8">
                   			<select class="form-control" name="NUM_SESIONES" id="NUM_SESIONES" onchange="setCampos()">
                    		<?php
                    		$x=1;
                    		while ($x<20)
                    		{?>
                    			<option value="<?=$x?>"><?=$x?></option>                    
                   		<?php
                   		$x++;
							}	?>
                   			</select>
                 		</div>
              		</div>
              		<div class="form-group">
                  		<label class="control-label col-lg-4">Patrocinador:</label>
                  		<div class="col-lg-8">
                   			<select class="form-control" name="ID__PATROCINADOR">
                    			<?php
								foreach($patrocinadores as $patrocinador)			
								{?>
								 <option value="<?=$patrocinador["ID__EMPRESA"]?>"><?=$patrocinador["VCH_NOMBREEMPRESA"]?></option>			
								<?php
								 }?>                     
                   			</select>
                 		</div>
              		</div>
                	<div class="form-group">
                  		<label class="control-label col-lg-4">*Nombre Instalaciones:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control required" name="VCH_INSTALACIONES">
                  		</div>
                	</div> 
                	<div class="form-group">
                  		<label class="control-label col-lg-4">*Convocados:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control required" name="NUM_CONVOCADOS">
                  		</div>
                	</div>                	
            	</div>
            </div>     
      	</div>
      	<!-- Div datoSesiones -->
      	<div class="tab-pane" id="datoSesiones">
      		<div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
            <div class="page-header">
                <h4>
                    <b>Datos Sesiones</b>
                </h4>
            </div>
			<div id="datasesiones">
				<div class="form-group">
					<div class="col-lg-6">
						<div class="form-group">
							<label class="control-label col-lg-4">Dia Sesion 1:</label>
							<div class="col-lg-8">
								<input type="text" class="form-control fec " id="fechaInicio" name="FEC_FECHA1">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-lg-4">Hora Sesion 1:</label>
							<div class="col-lg-8">
								<input type="text" class="form-control " name="VCH_HORA1">
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label class="control-label col-lg-4">Asistencia 1:</label>
							<div class="col-lg-8">
								<input type="text" class="form-control " name="INT_ASISTENCIA1">
							</div>
						</div>
					</div>
				</div>     
			</div>
            
      	</div>
      	<!-- Div Contacto -->
      	<div class="tab-pane" id="Contacto">
      		<div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
            <div class="page-header">
                <h4>
                    <b>Contacto</b>
                </h4>
            </div>
            <div class="form-group">
            	<div class="col-lg-6">
            		<div class="form-group">
                  		<label class="control-label col-lg-4">*Contacto:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control required" name="VCH_CONTACTO" >
                  		</div>
                	</div>
                	<div class="form-group">
                  		<label class="control-label col-lg-4">*Cargo:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control required" name="VCH_CARGO">
                  		</div>
                	</div>
                	<div class="form-group">
                  		<label class="control-label col-lg-4">*Telefono:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control required" name="VCH_TELEFONO">
                  		</div>
                	</div>
            	</div>
            	<div class="col-lg-6">
            		<div class="form-group">
                  		<label class="control-label col-lg-4">Celular:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control " name="VCH_CELULAR">
                  		</div>
                	</div>
                	<div class="form-group">
                  		<label class="control-label col-lg-4">Correo electronico:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control " name="VCH_CORREO">
                  		</div>
                	</div>
            	</div>
            	<div class="form-group">
                    <div class="checkbox col-lg-offset-2 col-lg-10">
                      <label class="checkbox-inline"><input id="chkDomicilio" type="checkbox" value="" onclick="abrirModal()">Domicilio</label>
                    </div>
                </div>
            </div>     
      	</div>
      	<!-- Div Tallerista -->
      	<div class="tab-pane" id="Tallerista">
      		<div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
            <div class="page-header">
                <h4>
                    <b>Tallerista</b>
                </h4>
            </div>
            <div class="form-group">
            	<div class="col-lg-10">
            		<div class="form-group">
                  		<label class="control-label col-lg-4">Tallerista:</label>
                  		<div class="col-lg-8">
                   			<select class="form-control" id="talleristaselect">
								<option value="-1">Seleccione</option>			
                    			<?php
								foreach($talleristas as $tallerista)			
								{?>
								 <option value="<?=$tallerista["ID__USUARIO"]?>"><?=$tallerista["tallerista"]?></option>			
								<?php
								 }?>                    
                   			</select>
                 		</div>
              		</div>
            	</div>
            	<div class="text-right">
                	<button type="button" class="btn btn-primary" onclick="cancelarTallerista()"><i class="fa fa-close"></i> Cancelar</button>
                	<button type="button" class="btn btn-primary" onclick="agregarTallerista()"><i class="fa fa-plus-circle"></i> Agregar</button>
            	</div><br><br>

            	<div class="row">
                <div class="col-lg-offset-1 col-lg-10">                  
                  <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablatalleristas" name="tablatalleristas" >
						<thead style='background-color:#00A89C; color:#fff;' >			
						<tr>					
							<th>
								Nombre Tallerista
							</th>								
							<th>
								&nbsp;
							</th>								
						</tr>
						</thead>			
					 </table>      
                </div><!--col-->
              </div>
            </div>     
      	</div>
      	<!-- Div Embajadores -->
      	<div class="tab-pane" id="Embajadores">
      		<div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
            <div class="page-header">
                <h4>
                    <b>Embajadores</b>
                </h4>
            </div>
            <div class="form-group">
            	<div class="col-lg-10">
            		<div class="form-group">
                  		<label class="control-label col-lg-4">Embajadores:</label>
                  		<div class="col-lg-8">
                   			<select class="form-control" id="embajadoresselect">
								<option value="-1">Seleccione</option>
                    			<?php
								foreach($embajadores as $embajador)			
								{?>
								 <option value="<?=$embajador["ID__EMBAJADOR"]?>"><?=$embajador["embajador"]?></option>			
								<?php
								 }?>                     
                   			</select>
                 		</div>
              		</div>
            	</div>
            	<div class="text-right">
                	<button type="button" class="btn btn-primary" onclick="cancelarEmbajador()"><i class="fa fa-close"></i> Cancelar</button>
                	<button type="button" class="btn btn-primary" onclick="agregarEmbajador()"><i class="fa fa-plus-circle"></i> Agregar</button>
            	</div><br><br>

            	<div class="row">
                <div class="col-lg-offset-1 col-lg-10">                   
					 <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaembajador" name="tablaembajador" >
						<thead style='background-color:#00A89C; color:#fff;' >			
						<tr>					
							<th>
								Nombre Embajador
							</th>						
							<th>
								&nbsp;
							</th>				
						</tr>
						</thead>			
					 </table> 
                </div><!--col-->
              </div>
            </div>     
      	</div>
      	<!-- Div Asistentes -->
      	<div class="tab-pane" id="Asistentes">
      		<div class="col-lg-1 col-md-1 col-xs-12">
                      &nbsp;
            </div>
            <div class="page-header">
                <h4>
                    <b>Asistentes</b>
                </h4>
            </div>
            <div class="form-group">
            	<div class="col-lg-10">					
            		<div class="form-group">
                  		<label class="control-label col-lg-4">Nombre:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control" ID="VCH_NOMBREASISTENTE">
                  		</div>
                	</div>
                	<div class="form-group">
                  		<label class="control-label col-lg-4">Apellido Paterno:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control" ID="VCH_APELLIDOPATERNO">
                  		</div>
                	</div>                	
                	<div class="form-group">
                  		<label class="control-label col-lg-4">Correo Electronico:</label>
                  		<div class="col-lg-8">
                    		<input type="text" class="form-control" ID="VCH_CORREOASISTENTE">
                  		</div>
                	</div>                	
                	<div class="form-group">
                  		<label class="control-label col-lg-4">Guardabosque:</label>
                  		<div class="col-lg-8">
							<select class="form-control" ID="ID__GUARDABOSQUE" name="ID__GUARDABOSQUE">
								<option></option>
							</select>
                  		</div>
                	</div>
            	</div>
            	<div class="text-left">
                	<button type="button" class="btn btn-primary"  onclick="BuscarGuardabosque()"><i class="fa fa-search"></i> Buscar</button>
            	</div>
			</div>
			<div class="form-group">            	
            	<div class="col-lg-offset-8">
					<button type="button" class="btn btn-primary"  onclick="$('#modalGuarda').modal('show');"><i class="fa fa-plus-circle"></i> Agregar</button>
                	<button type="button" class="btn btn-primary"  onclick="cancelarAsistente()"><i class="fa fa-close"></i> Cancelar</button>
                	<button type="button" class="btn btn-primary"  onclick="agregarAsistente()"><i class="fa fa-plus-circle"></i> Inscribir</button>
            	</div><br><br>

            	<div class="row">
                <div class="col-lg-offset-1 col-lg-10">
					<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaasistente" name="tablaasistente" >
						<thead style='background-color:#00A89C; color:#fff;' >			
						<tr>					
							<th>
								Nombre
							</th>																						
							<th>
								Pagado
							</th>																						
						</tr>
						</thead>			
					 </table>                                   
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
    <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
    <button type="button" id="btnRegresar" class="btn btn-default" >Regresar</button>
</div>
</form>
