<form id="form-especie" action="/altaEspecie" enctype="multipart/form-data" method="post" >
<div class="row form-horizontal">
  <div class="col-lg-12">
   <div class="form-group">
     <label class="control-label col-lg-2">Nombre Común:</label>
     <div class="col-lg-10">
       <input type="text" class="form-control required" id="form_VCH_NOMBRECOMUN" name="form_VCH_NOMBRECOMUN">
       <input type="hidden" name="idEspecie" id="idEspecie">
     </div>
   </div>
   <div class="form-group">
     <label class="control-label col-lg-2">Nombre Cientifico:</label>
     <div class="col-lg-10">
       <input type="text" class="form-control required" id="form_VCH_NOMBRECIENTIFICO" name="form_VCH_NOMBRECIENTIFICO">
     </div>
   </div>
   <div class="form-group">
     <label class="control-label col-lg-2">Estatus:</label>
      <div class="radio col-lg-8">
         <label class="radio-inline"><input type="radio" name="optradio" id="form-activo" value="1">Activo</label>
         <label class="radio-inline"><input type="radio" name="optradio" id="form-inactivo" value="0">Inactivo</label>
      </div>
  </div>
  <div class="form-group">
   <label class="control-label col-lg-2">Observaciones:</label>
   <div class="col-lg-10">
     <input type="text" class="form-control required" id="form_VCH_OBSERVACIONES" name="form_VCH_OBSERVACIONES">
   </div>
 </div>
 <div class="form-group">
   <label class="control-label col-lg-2">Url de referencia:</label>
   <div class="col-lg-10">
     <input type="text" class="form-control required" id="form_VCH_URLREFERENCIA" name="form_VCH_URLREFERENCIA">
   </div>
 </div>
</div><!--col-->
</div><!--row-->

<div class="row">
  <div class="col-lg-12">
   <h4 class="page-header">Periodo de Seguimientos</h4>
 </div><!--col-->
</div><!--row-->

<div class="row form-horizontal">
 <div class="col-lg-6">
  <div class="form-group">
   <label class="control-label col-lg-4">Primer período(meses):</label>
   <div class="col-lg-8">
     <input type="text" class="form-control required" id="form_NUM_PRIMERPERIODO" name="form_NUM_PRIMERPERIODO">
   </div>
 </div>
 <div class="form-group">
   <label class="control-label col-lg-4">Tercer Período(meses):</label>
   <div class="col-lg-8">
     <input type="text" class="form-control required" id="form_NUM_TERCERPERIODO" name="form_NUM_TERCERPERIODO">
   </div>
 </div>
</div><!--col-->
<div class="col-lg-6">
  <div class="form-group">
   <label class="control-label col-lg-4">Segundo Período(meses):</label>
   <div class="col-lg-8">
     <input type="text" class="form-control required" id="form_NUM_SEGUNDOPERIODO" name="form_NUM_SEGUNDOPERIODO">
   </div>
 </div>
 <div class="form-group">
   <label class="control-label col-lg-4">Cuarto Período:</label>
   <div class="col-lg-8">
     <input type="text" class="form-control required" id="form_NUM_CUARTOPERIODO" name="form_NUM_CUARTOPERIODO">
   </div>
 </div>
</div><!--col-->
</div><!--row-->

<div class="row">
  <div class="col-lg-6 form-group">
    <label class="control-label" for="iptFotoEspecie">Foto de la Especie:</label>
    <input id="iptFotoEspecie" class="file " type="file" name="iptFotoEspecie" >
  </div><!--col-->
<div class="col-lg-6 form-group">
  <div class="form-inline pull-right">
      <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
      <button type="button" class="btn btn-default" id="btnCancelarEspecie">Regresar</button>
  </div>
</div><!--col-->
</div><!--row-->
</form>
