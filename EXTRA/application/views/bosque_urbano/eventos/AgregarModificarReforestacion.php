<form id="formulario">
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre del evento:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control requiredc" id="FVCH_NOMBREEVENTOREFORESTACION">
      </div>
    </div>

    <div class="form-group">
        <label class="control-label col-lg-4">Empresas:</label>
        <div class="col-lg-8 input-group">
          <select class="form-control" id="selEmpresasReforestacion" multiple>
            <?php          
               foreach($empresas as $empresa)
               {?>             
                   <option value="<?=$empresa["ID__EMPRESA"]?>"><?=$empresa["VCH_NOMBREEMPRESA"]?></option>        
               <?php
                }
                ?>
          </select>
          <span class="input-group-addon" id="btnAgregarEmpresa">
            <i class="fa fa-plus-circle" ></i>
          </span>
        </div>
      </div> 


    <div class="form-group">
		  <label class="control-label col-lg-4">Arboles solicitados:</label>
		  <div class="col-lg-8">
			<input type="text" class="form-control requiredc" id="FNUM_ARBOLESSOLICITADOSREF">
		  </div>
      </div>

    <div class="form-group">
       <label class="control-label col-lg-4">Fecha Inicio:</label>
       <div class="col-lg-8">
        <div class='input-group date' id='FFEC_FECHAINICIOCal'>
          <input type='text' class="form-control requiredc" id="FFEC_FECHAINICIOREFORESTACION" name="FFEC_FECHAINICIOREFORESTACION"/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>    

    <div class="form-group">
     <label class="control-label col-lg-4">Estatus:</label>
      <div class="radio col-lg-8">
         <label class="radio-inline"><input type="radio" name="optradioc" id="form-activoc" value="1">Activo</label>
         <label class="radio-inline"><input type="radio" name="optradioc" id="form-inactivoc" value="0">Inactivo</label>
      </div>
	</div>
</div><!--col-->

    <div class="col-lg-6">
      <div class="form-group">
        <label class="control-label col-lg-4">Tipo de reforestación:</label>
        <div class="col-lg-8">
         <select class="form-control" id="VCH_TIPOREFORESTA">
          <option value="1">Masivo</option>
          <option value="2">Empresarial cerrado</option>
          <option value="3">Taller</option>
          <option value="4">Empresarial abierto</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-lg-4">Empresas participantes:</label>
      <div class="col-lg-8 input-group">
        <select class="form-control" id="selEmpresasParticipantes"></select>
        <span class="input-group-addon" id="btnQuitarEmpresa">
            <i class="fa fa-minus-circle" ></i>
          </span>
      </div>
    </div>

      <div class="form-group">
		  <label class="control-label col-lg-4">Fecha fin:</label>
			<div class="col-lg-8">
				<!--<input type="text" class="form-control required" id="FFEC_FECHAFIN"  readonly>-->
				<div class='input-group date' id='FFEC_FECHAFINcal'>
                    <input type='text' class="form-control requiredc" id="FFEC_FECHAFINREFORESTACION" name="FFEC_FECHAFINREFORESTACION"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
			</div>
      </div>
      <div class="form-group">
		 <label class="control-label col-lg-4 ">Prerequisitos:</label>
		  <div class="col-lg-8">
			<input type="text" class="form-control" id="VCH_PRERREQUISITOS">
		  </div>
      </div>
      <div class="form-group">
		 <label class="control-label col-lg-4 ">Observaciones:</label>
		  <div class="col-lg-8">
			<input type="text" class="form-control" id="FVCH_OBSERVACIONESREF">
		  </div>
      </div>

  </div><!--col-->  
</div><!--row-->

<input id="pac-inputReforestacion" class="controls" type="text" placeholder="Search Box">
<div id="mapEventoReforestacion" style="height:550px; width:100%;"></div>
<div class="text-right" style="padding-top:20px">
    <button type="button" class="btn btn-primary" onclick="guardarREFOR()">Guardar</button>
    <button type="button" id="btnRegresarReforestacion" class="btn btn-default">Regresar</button>
</div>
</form>
<style>
#pac-inputReforestacion {
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

      #pac-inputReforestacion:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }
</style>
