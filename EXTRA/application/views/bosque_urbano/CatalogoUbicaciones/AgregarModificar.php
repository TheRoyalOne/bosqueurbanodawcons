<form id="form-especie" method="post" enctype="multipart/form-data">
<input type="hidden" name="ID__UBICACION" id="ID__UBICACION">
<input type="hidden" name="ID__COLONIA" id="ID__COLONIA">
<input type="hidden" name="ID__DOMICILIO" id="ID__DOMICILIO">
<div class="row form-horizontal">
	<div class="col-lg-6">
		<div class="form-group">
	      <label class="control-label col-lg-4">Nombre:</label>
	      <div class="col-lg-8">
	        <input type="text" class="form-control" id="VCH_NOMBRE" name="VCH_NOMBRE">
	      </div>
   		</div>
		<div class="form-group">
	      <label class="control-label col-lg-4">Uso:</label>
	      <div class="col-lg-8">
	        <select class="form-control" id="INT_USO" name="INT_USO">
	          <option value="-1">---</option>
	          <option value="1">Evento Adopción</option>
	          <option value="2">Crecimiento</option>
	          <option value="3">Producción</option>
	          <option value="4">Recuperación</option>
	          <option value="5">Stock</option>
	          <option value="6">Trasplante</option>
	          <option value="7">Reforestación</option>
	          <option value="8">Evento Adopción Especial</option>
	          <option value="9">Cuarentena</option>
	        </select>
	      </div>
    	</div><br>
    	<div class="form-group">
          <label class="control-label col-lg-4">Estatus:</label>
          <div class="col-lg-6">
           <input type="radio" name="INT_ESTATUS" value="1" id="act"> Activo <br>
           <input type="radio" name="INT_ESTATUS" value="0" id="inact"> Inactivo <br>
          </div>
      	</div>
	</div>
	<div class="col-lg-6">
      	<div class="form-group">
		      <label class="control-label col-md-4">Foto Ubicación:</label>
		      <div class="col-md-8">
		        <input id="iptFotoEspecie" name="iptFotoEspecie" class="file" type="file">
		     </div>
	   </div><br>
	   <div class="form-group">
           	<label class="control-label col-lg-4">Observaciones:</label>
            <div class="col-lg-8">
            	<textarea style="resize: none;" class="form-control" name="VCH_OBSERVACIONES" id="VCH_OBSERVACIONES"></textarea>
            </div>
        </div>
	</div><br>
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
				  <input type="text" class="form-control" id="divDomicilio-estado" name="divDomicilio-estado" readonly>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-lg-4">Municipio:</label>
				<div class="col-lg-8">
				  <input type="text" class="form-control" id="divDomicilio-municipio" name="divDomicilio-municipio" readonly>
				</div>
			  </div>
			  <div class="form-group">
				<label class="control-label col-lg-4">Código Postal:</label>
				<div class="col-lg-8">
				  <input type="text" class="form-control" id="divDomicilio-cp" name="divDomicilio-cp" readonly>
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
</div>



<div class="text-right">   
    <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
    <button type="button" id="btnRegresar" class="btn btn-default">Regresar</button>
</div>
</form>
