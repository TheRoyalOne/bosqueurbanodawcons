<style>
	.paddtop
	{
		padding-top:13px !important;
	}
	.backg
	{
		background-color:#00A89C;
		color:white;
	}
</style>

<div class="row form-horizontal">	
				
	<div class="row">
	  <div class="col-lg-offset-1 col-lg-10">
	  
	  <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th class="text-center">
					QR
				</th>				
				<th class="text-center">
					ESPECIE
				</th >
				<th class="text-center">
					Ultimo seguimiento
				</th >
				<th class="text-center">
					Opciones
				</th>														
			</tr>
			</thead>
			<?php			
			foreach($MisArboles as $Arbol)			
			{
			//	die(print_r($Arbol));
				?>
			 <tr>
				 <td><?=$Arbol["VCH_CODIGOQR"]?></td>
				 <td><?=$Arbol["VCH_NOMBRECOMUN"]?></td>
				 <td><?=$Arbol["FEC_FECHA_SEGUIMIENTO"]?></td>
				 <td><?php
						if(empty($Arbol["FEC_FECHA_SEGUIMIENTO"]))
						{
							?>
								<button class="btn btn-primary" onclick="Seguimiento('<?=$Arbol['VCH_CODIGOQR']?>','<?=$Arbol['ID__ARBOL']?>','<?=$Arbol['VCH_LATITUD']?>','<?=$Arbol['VCH_LONGITUD']?>')">Dar seguimiento</button>
							<?php
						}
						else
						{							
							$ProxSeguimiento = strtotime("+3 months", strtotime($Arbol["FEC_FECHA_SEGUIMIENTO"]));
							if( $ProxSeguimiento <= strtotime("now") )
							{
								?>
									<button class="btn btn-primary" onclick="Seguimiento('<?=$Arbol['VCH_CODIGOQR']?>','<?=$Arbol['ID__ARBOL']?>','<?=$Arbol['VCH_LATITUD']?>','<?=$Arbol['VCH_LONGITUD']?>')">Dar seguimiento</button>
								<?php
							}	
							else
							{
								echo " <b>Proximo Seguimiento desde: </b>".date('Y-m-d',strtotime("+3 months"));
							}						
						}
							
					?></td>
			 </tr>
			 <?php				
			 }?>
		 </table>      
	   
	  </div><!--col-->
	</div><!--row-->
</div>
<div id="etiquetaPerdidaModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header backg">
		<h4 class="modal-title">Reporte de estado <b><label id="qretiqueta"></b> </label></h4>
	  </div>
	  <div class="modal-body">
		<form id="transferencia" action="ReporteEstadoAccion" method="POST" enctype="multipart/form-data" >			
			<div class="row text-center">
			  <div class="col-lg-offset-1 col-lg-10">
				  <img src="http://bosqueurbanoextra.org.mx/wp-content/themes/bosqueurbano/img/logo.png">
			 </div>
			</div>	
			<div class="row form-horizontal">
					<div class="col-lg-12 col-md-12 col-sm-12">
					 
					  <div  class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">*Estado:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioVCH_ESTADO" value="V" id="">Vivo&nbsp;&nbsp;&nbsp</label>
						  <label class="radio-inline"><input type="radio" name="optradioVCH_ESTADO" value="M" id="">Muerto&nbsp;&nbsp;</label>						  
						  <label class="radio-inline"><input type="radio" name="optradioVCH_ESTADO" value="D" id="">Desconocido</label>						  
						</div>
					  </div>						  
					  <div class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">*Salud:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioVCH_SALUD" value="S" id="">Sano&nbsp;</label>
						  <label class="radio-inline"><input type="radio" name="optradioVCH_SALUD" value="E" id="">Enfermo</label>						  
						  <label class="radio-inline"><input type="radio" name="optradioVCH_SALUD" value="O" id="">Desconocido</label>						  
						</div>
					  </div>					  						  
					  <div class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">*Todavia tiene la etiqueta?:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioVCH_CON_ETIQUETA" value="S" id="">Si&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						  <label class="radio-inline"><input type="radio" name="optradioVCH_CON_ETIQUETA" value="N" id="">No</label>						  					  
						</div>
					  </div>						  
					  <div class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">*Condicion:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioVCH_CONTENEDOR" value="P" id="">Plantado</label>
						  <label class="radio-inline"><input type="radio" name="optradioVCH_CONTENEDOR" value="B" id="">En bolsa</label>
						  <label class="radio-inline"><input type="radio" name="optradioVCH_CONTENEDOR" value="O" id="">Otro</label>
						</div>
					  </div>
					  <div class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">*Ubicacion del arbol:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioVCH_UBICACION_REPORTADA" value="O" id="">Direccion original</label>
						  <label class="radio-inline"><input type="radio" name="optradioVCH_UBICACION_REPORTADA" value="T" id="">En otra direccion</label>
						</div>
					  </div>
					  <div class="col-lg-12 col-md-12 col-sm-12" id="divmapa" style="display:none">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">Donde?:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
							<div id="map" style="height:450px; overflow:auto"></div>
						</div>
					  </div>
					  <div class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">*Acceso al árbol:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline" title="(Parque / Camellón / Banqueta)"><input type="radio" name="optradioVCH_ACCESO_AL_ARBOL" value="P" id="">En la via publica&nbsp;&nbsp; </label>
						
						  <label class="radio-inline" title="(Casa / Terreno / Rancho)"><input type="radio" name="optradioVCH_ACCESO_AL_ARBOL" value="R" id="">En propiedad privada </label>
						</div>
					  </div>
					  					  
					  <div class="form-group">&nbsp; </div>
					  					  
					  <div class="form-group">
						<label class="control-label col-lg-4">Observaciones / Comentarios</label>
						<div class="col-lg-6">
						  <input type="text" class="form-control required" name="VCH_COMENTARIOS">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-lg-4">Foto del arbol:</label>
						<div class="col-lg-6">
						  <input type="file" class="form-control" name="VCH_RUTA_FOTO_COMPLETA" accept="image/x-png,image/gif,image/jpeg">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-lg-4">Foto de la etiqueta:</label>
						<div class="col-lg-6">
						  <input type="file" class="form-control" name="VCH_RUTA_FOTO_SOLOETIQUETA"  accept="image/x-png,image/gif,image/jpeg">
						</div>
					  </div>
					  
					<div class="form-group" id="cualmedio" style="display:none">
						<label class="control-label col-lg-4">Cual?:</label>
						<div class="col-lg-6 col-md-6 col-sm-6 ">																	
							<input type="text" class="form-control" name="VCH_ENTERADOPOROTRO">			
							<input type="hidden" name="ID__ARBOL" id="ID__ARBOL">				
							<input type="hidden" name="QR" id="QR">				

							<input type="hidden" name="VCH_LATITUD" id="VCH_LATITUD">
							<input type="hidden" name="VCH_LONGITUD" id="VCH_LONGITUD">
						</div>
					</div>						
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<button type="button" class="btn btn-primary" onclick="contestarEncuesta()">Guardar Evaluacion</button>
	  </div>
	</div>
  </div>
</div>
<script type="text/javascript" src="<?=base_url()?>js/Arboles/ReportarPropios.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCN5YlYKfOuVVJGxRzIEmekifZeGT_3sgE"></script>
