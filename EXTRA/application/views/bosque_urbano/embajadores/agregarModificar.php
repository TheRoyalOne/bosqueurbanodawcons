<form id="embaja">
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">No. de Gafete:</label>
      <div class="col-lg-8">
       <input type="text" class="form-control required" id="form_VCH_NUMGAFETE" name="form_VCH_NUMGAFETE">
     </div>
   </div>
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
   <input type="text" class="form-control required" id="form_VCH_APELLIDOMATERNO" name="form_VCH_APELLIDOMATERNO">
 </div>
</div>
<div class="form-group">
  <label class="control-label col-lg-4">Correo electrónico:</label>
  <div class="col-lg-8">
   <input type="text" class="form-control required" id="form_VCH_CORREO" name="form_VCH_CORREO">
 </div>
</div>
<div class="form-group">
 <div class="col-lg-12">
  <div class="text-right">
    <button  type="button" class="btn btn-primary" onclick="GeneraPass()" id="btnGeneraPass"><i class="fa fa-key"></i> Nueva Contraseña</button>
  </div>
</div>
</div>
<div class="form-group">
  <label class="control-label col-lg-4">Tipo de Embajador:</label>
  <div class="radio col-lg-8">
	   <select type="text" class="form-control required" id="form_VCH_TIPO" name="form_VCH_TIPO">
		   <?php
		   foreach($tiposEmbajador as $tipo)
		   {
		   ?>
				<option value="<?=$tipo["ID__TIPO"]?>"><?=$tipo["VCH_TEXTOTIPO"]?></option>
		   <?php
			}
		   ?>
	  </select>
  <!--
   <label class="radio-inline"><input type="radio" name="optradio" value="0" id="practicante">Practicante</label>
   <label class="radio-inline"><input type="radio" name="optradio" value="1" id="tecnico">Técnico</label>
   -->
 </div>
</div>
<div class="form-group">
  <label class="control-label col-lg-4">Semestre:</label>
  <div class="col-lg-8">
   <input type="text" class="form-control required" id="form_VCH_SEMESTRE" name="form_VCH_SEMESTRE">
 </div>
</div>
</div><!--col-->
<div class="col-lg-6">
  <div class="form-group">
    <label class="control-label col-lg-4">Teléfono:</label>
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
<div class="form-group">
  <label class="control-label col-lg-4">Institución Educativa:</label>
  <div class="col-lg-8">
   <select class="form-control" id="form_ID__INSTITUCION" name="form_ID__INSTITUCION" >
    <?php        
	foreach($instituciones as $institucion)
	{?>     				
			<option value="<?=$institucion["ID__INSTITUCION"]?>"><?=$institucion["VCH_NOMBRE"]?></option>			
	<?php
	}
	?>
   </select>
 </div>
</div>
<div class="form-group">
  <label class="control-label col-lg-offset-7">Período Activo</label>
</div>
<div class="form-group">
  <div class="form-group">
        <label class="control-label col-lg-4">Fecha Inicio:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control required" id="form_FEC_FECHAINICIO" name="form_FEC_FECHAINICIO" >
        </div>
      </div>
</div>
<div class="form-group">
  <div class="form-group">
        <label class="control-label col-lg-4">Fecha Fin:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control required" id="form_FEC_FECHAFIN" name="form_FEC_FECHAFIN">
        </div>
  </div>
</div>
</div><!--col-->
</div><!--row-->
<div class="row form-horizontal">
 <div class="col-lg-12">
   <div class="form-group">
    <label class="control-label col-lg-2">Carrera:</label>
    <div class="col-lg-4">
     <input type="text" class="form-control required" id="form_VCH_CARRERA" name="form_VCH_CARRERA">
   </div>
 </div>
 <div class="form-group">
  <div class="checkbox col-lg-offset-2 col-lg-10">
    <label class="checkbox-inline"><input id="chkDomicilio" type="checkbox" value="" onclick="abrirModal()">Domicilio</label>
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
<div class="row">
  <div class="pull-right form-inline">
    <button type="button" class="btn btn-primary form-control" onclick="guardar()">Guardar</button>
    <button id="btnRegresarCatUsuarios" type="button" class="btn btn-default form-control">Cancelar</button>
  </div><!--col-->
</div><!--row-->
</form>
