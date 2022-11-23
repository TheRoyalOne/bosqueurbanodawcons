<style>
	#map * {
    overflow:visible;
}
</style>
<form id="formulario">
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre del evento:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="FVCH_NOMBREEVENTO">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Patrocinador:</label>
      <div class="col-lg-8">
          <select class="form-control" id="FID__EMPRESA">
          <?php          
			foreach($empresas as $empresa)
			{?>     				
				<option value="<?=$empresa["ID__EMPRESA"]?>"><?=$empresa["VCH_NOMBREEMPRESA"]?></option>				
			<?php
			}
			?>
        </select>

      </div>
    </div>
    <div class="form-group">
		  <label class="control-label col-lg-4">Arboles solicitados:</label>
		  <div class="col-lg-8">
			<input type="text" class="form-control" id="FNUM_ARBOLESSOLICITADOS">
		  </div>
      </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Fecha Inicio:</label>
		<div class="col-lg-8">		
		  
				<div class='input-group date' id='FFEC_FECHAINICIOCal'>
                    <input type='text' class="form-control required" id="FFEC_FECHAINICIO" name="FFEC_FECHAINICIO"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
		</div>
    </div>    
    <div class="form-group">
     <label class="control-label col-lg-4">Estatus:</label>
      <div class="radio col-lg-8">
         <label class="radio-inline"><input type="radio" name="optradio" id="form-activoe" value="1">Activo</label>
         <label class="radio-inline"><input type="radio" name="optradio" id="form-inactivoe" value="0">Cancelado</label>
      </div>
	</div>
    <div class="form-group">
      <div class="checkbox col-lg-offset-4 col-lg-10">
		<label class="checkbox-inline"><input id="chkDomicilio" type="checkbox" value="" onclick="abrirModal()">Domicilio</label>
	  </div>
    </div>
</div>
    <div class="col-lg-6">
     <!-- <div class="form-group">
        <label class="control-label col-lg-4">Tipo del evento:</label>
        <div class="col-lg-8">
         <select class="form-control" id="FVCH_TIPO">
          <option value="1">Adopcion</option>
          <option value="2">Reforestacion</option>
        </select>
      </div>
    </div>-->
      <div class="form-group">
		  <label class="control-label col-lg-4">Nombre del lugar:</label>
		  <div class="col-lg-8">
			<input type="text" class="form-control" id="FVCH_NOMBRELUGAR" >
		  </div>
      </div>
      <div class="form-group">
		  <label class="control-label col-lg-4">Computadoras a llevar:</label>
		  <div class="col-lg-8">
			<input type="text" class="form-control" id="FNUM_COMPUTADORAS">
		  </div>
      </div>
      <div class="form-group">
		  <label class="control-label col-lg-4">Fecha fin:</label>
			<div class="col-lg-8">
				
				<div class='input-group date' id='FFEC_FECHAFINcal'>
                    <input type='text' class="form-control required" id="FFEC_FECHAFIN" name="FFEC_FECHAFIN"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
			</div>
      </div>
      <div class="form-group">
		 <label class="control-label col-lg-4 ">Observaciones:</label>
		  <div class="col-lg-8">
			<input type="text" class="form-control" id="FVCH_OBSERVACIONES">
		  </div>
      </div>

  </div><!--col-->  
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

<input id="pac-input" class="controls" type="text" placeholder="Search Box">
<div id="mapEvento" style="height:550px; width:100%;"></div>
<div class="text-right">
    <button type="button" id="buttguar" class="btn btn-primary" onclick="guardar()">Guardar</button>
    <button type="button" id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
</form>
<style>
#pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
        margin-top:9px;
        height:29px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }
</style>
