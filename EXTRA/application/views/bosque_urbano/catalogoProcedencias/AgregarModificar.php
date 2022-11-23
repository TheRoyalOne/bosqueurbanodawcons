<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control required" id="form_VCH_NOMBRE" name="form_VCH_NOMBRE">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Apellido Paterno:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control required" id="form_VCH_APELLIDOPATERNO" name="form_VCH_APELLIDOPATERNO">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Apellido Materno:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control  required" id="form_VCH_APELLIDOMATERNO" name="form_VCH_APELLIDOMATERNO">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Correo Electrónico:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control required" id="form_VCH_CORREO" name="form_VCH_CORREO">
      </div>
    </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label class="control-label col-lg-4">Telefono:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control required" id="form_VCH_TELEFONO" name="form_VCH_TELEFONO">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Celular:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control required" id="form_VCH_CELULAR" name="form_VCH_CELULAR">
        </div>
      </div>
  </div><!--col-->
  <div class="form-group">
        <div class="checkbox col-lg-offset-2 col-lg-10">
          <label class="checkbox-inline"><input id="chkDomicilio" type="checkbox" value="" onclick="abrirModal()">Domicilio</label>
        </div>
      </div>
</div><!--col-->
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
      <input type="text" class="form-control" id="divDomicilio-colonia" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-4">Calle y Número:</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" id="divDomicilio-calle">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-4">Entre Calles:</label>
    <div class="col-lg-8">
      <input type="text" class="form-control" id="divDomicilio-entre">
    </div>
  </div>
</div><!--col-->
</div><!--row-->
<div class="text-right">
    <button class="btn btn-primary" onclick="GeneraPass()" id="btnGeneraPass"><i class="fa fa-key"></i> Nueva Contraseña</button>    
    <button class="btn btn-default" onclick="guardar()">Guardar</button>
    <button id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
