<!--Botones que abriran los divs-->
<style>
body 
{
    margin-top: 0px !important;
}
</style>

<div class="form-horizontal" style="padding-bottom:10px;">
  <div class="">
    <div class="tabbable">
    	<ul class="nav nav-tabs">
	        <li class="active"><a data-toggle="tab" href="#Genera">Asignar Personal</a></li>
	        <li><a data-toggle="tab" href="#Especies">Asignar Servicio social</a></li>
	        <li><a data-toggle="tab" href="#Patrocinadores">Asignar vehiculo</a></li>
			<li><a data-toggle="tab" href="#suministros">Asignar Herramientas y Suministros</a></li>
	        
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
                <b>Asignar Personal</b>
              </h4>
            </div>
            <div class="form-group">
               
                <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Personal:</label>
                      <div class="col-lg-8">
                         <select class="form-control" id="personalSelect">
						<?php
						foreach($personal as $persona)
                         {
							 ?>
							  <option value="<?=$persona["ID__USUARIO"]?>"><?=$persona["VCH_NOMBRE"]." ".$persona["VCH_APELLIDOPATERNO"]." ".$persona["VCH_APELLIDOMATERNO"]?></option>
							  <?php
						 }
                          ?>
                         </select>
                     </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <button class="btn btn-primary" onclick="addUser()"><i class="fa fa-plus-circle"></i> Agregar</button>
                  </div>                                   
                </div>
               <br><br>
                <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                   
                  <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
					<thead style='background-color:#00A89C; color:#fff;' >
						<tr>
							<th class="text-center">
								Usuario
							</th>
							<th class="text-center">
								Opciones
							</th>																
						</tr>
					</thead>
					<tbody>
					<?php
						foreach($personalASIGNADO as $persona)
                        {
						?>
						<tr>
							<td class="text-center">
								<?=$persona["VCH_NOMBRE"]." ".$persona["VCH_APELLIDOPATERNO"]." ".$persona["VCH_APELLIDOMATERNO"]?>
							</td>
							<td class="text-center">
								<a href="javascript:eliminarPersona(<?=$persona["ID__REL"]?>)">Eliminar</a>
							</td>
						</tr>
					<?php
						}
						?>
					</tbody>
					</table>
                </div><!--col-->
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
                <b>Asignar Servicio social</b>
              </h4>
            </div>
            <div class="form-group">
                <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Prestador de servicio:</label>
                      <div class="col-lg-8">
                         <select class="form-control" id="prestadorSelect">
                          <?php
						foreach($prestadores as $persona)
                         {
							 ?>
							  <option value="<?=$persona["ID__USUARIO"]?>"><?=$persona["VCH_NOMBRE"]." ".$persona["VCH_APELLIDOPATERNO"]." ".$persona["VCH_APELLIDOMATERNO"]?></option>
							  <?php
						 }
                          ?>
                         </select>
                     </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <button class="btn btn-primary" onclick="addPrestador()"><i class="fa fa-plus-circle"></i> Agregar</button>
                  </div>                                   
                </div>
				<br><br>
                <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                  <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
					<thead style='background-color:#00A89C; color:#fff;' >
						<tr>
							<th class="text-center">
								Usuario
							</th>
							<th class="text-center">
								Opciones
							</th>																
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($prestadoresASIGNADO as $persona)
                        {
						?>
						<tr>
							<td class="text-center">
								<?=$persona["VCH_NOMBRE"]." ".$persona["VCH_APELLIDOPATERNO"]." ".$persona["VCH_APELLIDOMATERNO"]?>
							</td>
							<td class="text-center">
								<a href="javascript:eliminarPrestador(<?=$persona["ID__REL"]?>)">Eliminar</a>
							</td>
						</tr>
					<?php
						}
						?>
					</tbody>
					</table>
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
                  <b>Asignar vehiculo</b>
                </h4>
              </div>
              <div class="form-group">
                
                <div class="col-lg-6">
                    <div class="form-group">
                      <label class="control-label col-lg-4">Vehiculo:</label>
                      <div class="col-lg-8">
                         <select class="form-control" id="vehiculoSelect">
                          <?php
						foreach($vehiculos as $vehiculo)
                         {
							 ?>
							  <option value="<?=$vehiculo["ID__VEHICULO"]?>"><?=$vehiculo["VCH_MATRICULA"]." ".$vehiculo["VCH_DESCRIPCION"]?></option>
							  <?php
						 }
                          ?>
                         </select>
                     </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                    <button class="btn btn-primary" onclick="addVehiculo()"><i class="fa fa-plus-circle"></i> Agregar</button>
                  </div>                                   
                </div>
               <br><br>
                <div class="row">
                <div class="col-lg-offset-1 col-lg-10">
                   <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
					<thead style='background-color:#00A89C; color:#fff;' >
						<tr>
							<th class="text-center">
								Vehiculo
							</th>
							<th class="text-center">
								Opciones
							</th>																
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($vehiculosASIGNADO as $vehiculo)
							{
							?>
							<tr>
								<td class="text-center">
									<?=$vehiculo["VCH_MATRICULA"]." ".$vehiculo["VCH_DESCRIPCION"]?>
								</td>
								<td class="text-center">
									<a href="javascript:eliminarVehiculo(<?=$vehiculo["ID__REL"]?>)">Eliminar</a>
								</td>
							</tr>
						<?php
							}
							?>
					</tbody>
					</table>
                </div><!--col-->
              </div>
            
              
              </div>
          	</div>          
          	
          	
          	          <div  class="tab-pane" id="suministros">
						<div class="col-lg-1 col-md-1 col-xs-12">
						  &nbsp;
						</div>
						<div class="page-header">
						  <h4>
							<b>Asignar Suministros</b>
						  </h4>
						</div>
						
						
						<div class="form-group">	
							<div class="col-lg-5 col-md-5 col-sm-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
								<div class="form-group">
								  <label class="control-label col-lg-4">Especies:</label>
								  <div class="col-lg-6">
									  <ul>
										<?php
										foreach($especies as $especie)
										{?>
											<li><?=$especie["VCH_NOMBRECOMUN"]?>	</li>
										<?php 
										}
										?>
									</ul>	
								 </div>
								</div>
							</div>																		
						</div>
												
						<div class="form-group">
							<div class="col-lg-5 col-md-5 col-sm-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
								<div class="form-group">
								  <label class="control-label col-lg-4">Herramienta/Suministro:</label>
								  <div class="col-lg-6">
									 <select class="form-control" id="HerSelect">
									  <?php
									foreach($herramientas["select"] as $herramienta)
									 {
										 ?>
										  <option value="<?=$herramienta["ID_SUMHER"]?>"><?=$herramienta["VCH_NOMBRE"]?></option>
										  <?php
									 }
									  ?>
									 </select>
								 </div>
								</div>
							</div>
							<div class="col-lg-5 col-md-5 col-sm-5">
								<div class="form-group">
								  <label class="control-label col-lg-4">Cantidad:</label>
								  <div class="col-lg-8">
									  <input type="number" class="form-control"  min="1" id="canther" >									
								 </div>
								</div>
							</div>
					</div>
						<div class="form-group">
							<div class="col-lg-5 col-md-5 col-sm-5 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
								<div class="form-group">
								  <label class="control-label col-lg-4">Descripcion Extra:</label>
								  <div class="col-lg-6">
									  <input type="text" class="form-control" id="descher">	
								 </div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 text-right">
								<div class="form-group">								 
								  <div class="col-lg-12">
									<button class="btn btn-primary" onclick="addSuministro()"><i class="fa fa-plus-circle"></i> Agregar</button>
								 </div>
								</div>
							</div>
							</div>							
							<br><br>
							<div class="row">
							<div class="col-lg-offset-1 col-lg-10">
							  <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
								<thead style='background-color:#00A89C; color:#fff;' >
									<tr>
										<th class="text-center">
											Herramienta/Suministro
										</th>
										<th class="text-center">
											Cantidad
										</th>
										<th class="text-center">
											Descripcion extra
										</th>
										<th class="text-center">
											Opciones
										</th>																
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($herramientas["actuales"] as $herramienta)
									 {
									?>
									<tr>
										<td class="text-center">
											<?=$herramienta["VCH_NOMBRE"]?>
										</td>
										<td class="text-center">
											<?=$herramienta["VCH_CANTIDAD"]?>
										</td>
										<td class="text-center">
											<?=$herramienta["VCH_DESCRIPCION"]?>
										</td>
										<td class="text-center">
											<a href="javascript:eliminarHer(<?=$herramienta["ID__REL"]?>)">Eliminar</a>
										</td>
									</tr>
								<?php
									}
									?>
								</tbody>
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
<!--
<div class="text-right">   
    <button class="btn btn-primary">Guardar</button>
    <button id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
-->



<script type="text/javascript" src="<?=base_url()?>js/moment.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/bootstrap-datetimepicker.min.css"/>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/EventosAsignarRecusosIframeREAL.js"></script>

