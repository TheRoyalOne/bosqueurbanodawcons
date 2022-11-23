<form id="form-especie" method="POST" enctype='multipart/form-data'>
<div class="row form-horizontal">
	<div class="col-lg-10">
		<div class="form-group">
	      <label class="control-label col-lg-4">Nombre:</label>
	      <div class="col-lg-8">
	        <input type="text" class="form-control required" id="VCH_NOMBRE" name="VCH_NOMBRE">
	      </div>
   		</div>
   		<div class="form-group">
           	<label class="control-label col-lg-4">Material:</label>
            <div class="col-lg-8">
            	<textarea style="resize: none;" class="form-control required" id="VCH_MATERIAL" name="VCH_MATERIAL"></textarea>
            </div>
        </div>
        <div class="form-group">
           	<label class="control-label col-lg-4">Descripción:</label>
            <div class="col-lg-8">
            	<textarea style="resize: none;" class="form-control required" id="VCH_DESCRIPCION" name="VCH_DESCRIPCION"></textarea>
            </div>
        </div>
	</div>

	<div class="col-lg-10">
		<br><br>
		<div class="form-group">
	      <label class="control-label col-lg-4">Nombre del Archivo:</label>
	      <div class="col-lg-8">
	        <input type="text" class="form-control"  id="VCH_NOMBREFile" >
	      </div>
   		</div>
   		<div class="form-group">
		      <label class="control-label col-md-4">Archivo:</label>
		      <!--struct base para manejador de files-->
		      <div class="col-md-8" id="divdeinputs">
				  <div id="inp0">
					<input id="VCH_URL_ARCHIVOFile0" name="VCH_URL_ARCHIVOFile0" class="file" type="file">
				  </div>
		     </div>
		     <!--struct base para manejador de files-->
	   </div>
	   <div class="text-right">
        	<button class="btn btn-primary" type="button" onclick="resetArchivo()"><i class="fa fa-close"></i> Cancelar</button>
        	<button class="btn btn-primary" type="button" onclick="agregarArrayFile()"><i class="fa fa-plus-circle"></i> Agregar</button>
    	</div>
	</div>    
</div><br><br>

<div class="row" style="padding-bottom:50px;">
    <div class="col-lg-offset-1 col-lg-10">
       <?php 
	/*
       $datos=array('Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo',
         'Nombre del Archivo','Archivo');
        $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
         'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
        $this->table->set_template($template);
        $this->table->set_heading('Nombre del Archivo','Archivo');
        echo  $this->table->generate($this->table->make_columns($datos,2));
	*/
      ?>
    
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaarchivos" name="tablaarchivos" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Nombre del Archivo
				</th>
				<th>
					Archivo
				</th>				
			</tr>
			</thead>
			<tbody id="tbodyarchivos">	</tbody>
			</table>      
    </div><!--col-->
  </div>

<div class="text-right">   
    <button class="btn btn-primary" onclick="guardar()" type="button">Guardar</button>
    <button id="btnRegresar" class="btn btn-default" type="button" onclick="document.getElementById('form-especie').reset()">Regresar</button>
</div>
<input type="hidden" name="CompiladoNombresFiles" id="CompiladoNombresFiles">
<input type="hidden" name="ID__TALLER" id="ID__TALLER">
</form>
