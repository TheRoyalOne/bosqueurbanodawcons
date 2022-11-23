<div class="row form-horizontal">
	<div class="col-lg-10">
		<div class="form-group">
      		<label class="control-label col-lg-4">Institución:</label>
      		<div class="col-lg-8">
        		<input type="text" class="form-control" id="form_VCH_NOMBRE" name="form_VCH_NOMBRE">
      		</div>
    	</div>
    	<div class="form-group">
      		<label class="control-label col-lg-4">Contacto:</label>
      		<div class="col-lg-8">
        		<input type="text" class="form-control" id="form_VCH_PERSONACONTACTO" name="form_VCH_PERSONACONTACTO">
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
      		<label class="control-label col-lg-4">Correo Electronico:</label>
      		<div class="col-lg-8">
        		<input type="text" class="form-control" id="form_VCH_CORREO" name="form_VCH_CORREO">
      		</div>
    	</div>
    	<div class="form-group">
      		<label class="control-label col-lg-4">Telefono:</label>
      		<div class="col-lg-8">
        		<input type="text" class="form-control" id="form_VCH_TELEFONO" name="form_VCH_TELEFONO">
      		</div>
    	</div>
    	<div class="form-group">
      		<label class="control-label col-lg-4">Responsable:</label>
      		<div class="col-lg-8">
		         <select class="form-control" id="form_ID__USUARIO" name="form_ID__USUARIO">
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
      		<label class="control-label col-lg-4">Total Embajadores:</label>
      		<div class="col-lg-8">
        		<input type="text" class="form-control" value="0" disabled>
      		</div>
    	</div>
    	<div class="form-group">
      		<label class="control-label col-lg-4">Total Embajadores Activos:</label>
      		<div class="col-lg-8">
        		<input type="text" class="form-control" value="0" disabled>
      		</div>
    	</div>
	</div>
	<div class="col-lg-10">
		<div class="form-group">
        <label class="control-label col-lg-4">Observaciones y seguimiento:</label>
        <div class="col-lg-8">
          <textarea style="resize: none;" class="form-control" id="form_VCH_COMENTARIOS" name="form_VCH_COMENTARIOS"></textarea>
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
      
      
      
      
      
      
      
      
      
</div>

<div class="text-right">   
    <button class="btn btn-primary" onclick="guardar()">Guardar</button>
    <button id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
