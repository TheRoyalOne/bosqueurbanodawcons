    <form id="formaltaus">
    <div class="row form-horizontal">
        <div class="col-lg-6">
          <div class="form-group">
            <label class="control-label col-lg-4">Nombre:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control required" id="Form_VCH_NOMBRE">
              <input type="hidden" id="" value=0>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Apellido Paterno:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control required" id="Form_VCH_APELLIDOPATERNO">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Apellido Materno:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control required" id="Form_VCH_APELLIDOMATERNO">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Correo Electrónico:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control required" id="Form_VCH_CORREO">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Usuario:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control required" id="Form_VCH_USUARIO">
            </div>
          </div>
        </div>
        
        <div class="col-lg-6">
          <div class="form-group">
            <label class="control-label col-lg-4">Puesto:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control required" id="Form_VCH_PUESTO">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Perfil:</label>
            <div class="col-lg-8">
              <select type="text" class="form-control" id="Form_ID__PERFIL">           
			<?php
			foreach($perfiles as $perfil)
			{?>     
				
				<option value="<?=$perfil["ID__PERFIL"]?>"><?=$perfil["VCH_NOMBRE"]?></option>
				
			<?php
			}
			?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Teléfono:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control required" id="Form_VCH_TELEFONO">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Celular:</label>
            <div class="col-lg-8">
              <input type="text" class="form-control required" id="Form_VCH_CELULAR">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Estatus:</label>
            <div class="radio col-lg-8">
              <label class="radio-inline"><input type="radio" name="optradio" value="1" id="Form_Activo">Activo</label>
              <label class="radio-inline"><input type="radio" name="optradio" value="0" id="Form_Inactivo">Inactivo</label>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-4">Contraseña:</label>
            <div class="col-lg-8">
              <input type="password" class="form-control" id="Form_VCH_PASSWORD">
            </div>
          </div>
        </div>
    </div><!--row-->
    <div class="row form-horizontal">
      <div class="col-lg-12">
        <div class="form-group">
          <label class="control-label col-lg-2">Observaciones:</label>
          <div class="col-lg-10">
            <textarea class="form-control" row="5" id="Form_VCH_OBSERVACIONES"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="checkbox col-lg-offset-2 col-lg-10">
            <label class="checkbox-inline"><input id="chkDomicilio" type="checkbox" value="">Domicilio</label>
          </div>
        </div>
      </div><!--col-->
    </div><!--row-->
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
          <label class="control-label col-lg-4">Colonia</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="divDomicilio-colonia" readonly>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-4">Calle y Número</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="divDomicilio-calleynumero">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-4">Entre calles</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="divDomicilio-VCH_ENTRECALLE">
          </div>
        </div>
     </div><!--col-->
    </div><!--row-->
    <div class="row">
      <div class="pull-right form-inline">
        <button type="button" class="btn btn-primary form-control" onclick="AltaUsuario();">Guardar</button>
        <button id="btnRegresarCatUsuarios" type="button" class="btn btn-default form-control">Regresar</button>
      </div><!--col-->
    </div><!--row-->
	</form>
