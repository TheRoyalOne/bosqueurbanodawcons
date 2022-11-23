<style>
	.paddtop
	{
		padding-top:13px !important;
	}
</style>
<div class="row form-horizontal">
	<!--<div class="col-lg-8">
		<div class="form-group">
        <label class="control-label col-lg-4">Taller:</label>
        <div class="col-lg-8">
          <select class="form-control" id="ID__CVETALLER">
           <?php			
			foreach($talleresPorEvaluar as $tallerPorEvaluaro)			
			{?>
				 <option value=""><?=$tallerPorEvaluaro["VCH_TALLER"]?></option>
			<?php }?>
          </select>
        </div>
      </div>
	</div>
	<div class="col-lg-4">
       	<button type="button" class="col-offset-lg-11 btn btn-primary" id="BtnEvaluar"><i class="fa fa-share"></i> Evaluar</button>
    </div>-->
	<div class="row">
	  <div class="col-lg-offset-1 col-lg-10">
	  
	  <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Taller
				</th>
				<th>
					Fecha de inicio
				</th>
				<th>
					Estado
				</th>														
			</tr>
			</thead>
			<?php			
			foreach($talleresTomados as $tallerTomado)			
			{?>
			 <tr>
				 <td><?=$tallerTomado["VCH_TALLER"]?></td>
				 <td><?php 
						//die(print_r($tallerTomado));
//						print_r($tallerTomado);
							if(!empty($tallerTomado["ID__GUARDABOSQUE"]))
							{
								echo $tallerTomado["FEC_FECHA"];
							}
							else
							{								
							}				 
				 ?></td>			
				 <td><?php
							if((!empty($tallerTomado["ID__GUARDABOSQUE"]))&&($tallerTomado["NUM_PAGADO"]==1))
							{
								if(!empty($tallerTomado["ID_Resultado_Evaluacion"]))
								{
									echo "<b>Evaluado</b>";
								}				 
								else
								{
									echo "<a href='javascript:evaluar(".$tallerTomado["ID__CVETALLER"].")' style='cursor:pointer' target='_SELF'>Evaluar</a>";
								}
							}
							else
							{
								Echo "";
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
	  <div class="modal-header">
		<h4 class="modal-title">Evaluacion del curso</h4>
	  </div>
	  <div class="modal-body">
		<form id="transferencia" >
			
			<div class="row form-horizontal">
					<div class="col-lg-12 col-md-12 col-sm-12">
					  <div class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-8 col-md-8 col-sm-8 text-center">Desempeño del expositor:</label>							
					  </div>
					  <div >
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">Preparación del tema:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioPREPTEMA" value="E" id="">Excelente</label>
						  <label class="radio-inline"><input type="radio" name="optradioPREPTEMA" value="M" id="">Muy bien</label>
						  <label class="radio-inline"><input type="radio" name="optradioPREPTEMA" value="B" id="">Bien </label>
						  <label class="radio-inline"><input type="radio" name="optradioPREPTEMA" value="R" id="">Regular </label>
						  <label class="radio-inline"><input type="radio" name="optradioPREPTEMA" value="D" id="">Deficiente</label>
						  
						</div>
					  </div>						  
					  <div >
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">Claridad al exponer:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioCLARIDAD" value="E" id="">Excelente</label>
						  <label class="radio-inline"><input type="radio" name="optradioCLARIDAD" value="M" id="">Muy bien</label>
						  <label class="radio-inline"><input type="radio" name="optradioCLARIDAD" value="B" id="">Bien </label>
						  <label class="radio-inline"><input type="radio" name="optradioCLARIDAD" value="R" id="">Regular </label>
						  <label class="radio-inline"><input type="radio" name="optradioCLARIDAD" value="D" id="">Deficiente</label>							  
						</div>
					  </div>
					  <div class="">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">Material de apoyo:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioAPOYO" value="E" id="">Excelente</label>
						  <label class="radio-inline"><input type="radio" name="optradioAPOYO" value="M" id="">Muy bien</label>
						  <label class="radio-inline"><input type="radio" name="optradioAPOYO" value="B" id="">Bien </label>
						  <label class="radio-inline"><input type="radio" name="optradioAPOYO" value="R" id="">Regular </label>
						  <label class="radio-inline"><input type="radio" name="optradioAPOYO" value="D" id="">Deficiente</label>							  
						</div>
					  </div>
					  <div class="">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">Manejo del tiempo:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioMANEJO" value="E" id="">Excelente</label>
						  <label class="radio-inline"><input type="radio" name="optradioMANEJO" value="M" id="">Muy bien</label>
						  <label class="radio-inline"><input type="radio" name="optradioMANEJO" value="B" id="">Bien </label>
						  <label class="radio-inline"><input type="radio" name="optradioMANEJO" value="R" id="">Regular </label>
						  <label class="radio-inline"><input type="radio" name="optradioMANEJO" value="D" id="">Deficiente</label>							  
						</div>
					  </div>
					  <div class="">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">Contenido del taller:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioCONTENIDO" value="E" id="">Excelente</label>
						  <label class="radio-inline"><input type="radio" name="optradioCONTENIDO" value="M" id="">Muy bien</label>
						  <label class="radio-inline"><input type="radio" name="optradioCONTENIDO" value="B" id="">Bien </label>
						  <label class="radio-inline"><input type="radio" name="optradioCONTENIDO" value="R" id="">Regular </label>
						  <label class="radio-inline"><input type="radio" name="optradioCONTENIDO" value="D" id="">Deficiente</label>							  
						</div>
					  </div>
					  <div class="">
						<label class="control-label col-lg-4 col-md-4 col-sm-4 paddtop">Aclaración de dudas:</label>
						<div class="radio col-lg-8 col-md-8 col-sm-8">
						  <label class="radio-inline"><input type="radio" name="optradioDUDAS" value="E" id="">Excelente</label>
						  <label class="radio-inline"><input type="radio" name="optradioDUDAS" value="M" id="">Muy bien</label>
						  <label class="radio-inline"><input type="radio" name="optradioDUDAS" value="B" id="">Bien </label>
						  <label class="radio-inline"><input type="radio" name="optradioDUDAS" value="R" id="">Regular </label>
						  <label class="radio-inline"><input type="radio" name="optradioDUDAS" value="D" id="">Deficiente</label>
						  
						</div>
					  </div>
					  <div class="form-group">&nbsp; </div>
					  
					  <div class="form-group">
						<label class="control-label col-lg-6 col-md-6 col-sm-6">Calificación según expectativas del taller:</label>
						<div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
							<select class="form-control" name="VCH_CALIFICACION_EXPECTATIVAS">
							<?php
							$i=1;
							while($i<=10)
							{?>
								<option value="<?=$i?>" <?php if($i==10){ 
											echo 'selected="selected"';}?>><?=$i?></option>
							<?php 
							$i++;
							}
							?>
							</select>							  
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-lg-4">Justificacion:</label>
						<div class="col-lg-6">
						  <input type="text" class="form-control required" name="VCH_JUSTIFICACION_CALIFICACION_EXPECTATIVA">
						</div>
					  </div>
					  <div class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-8 col-md-8 col-sm-8 text-center">Aprendizajes Obtenidos:</label>							
					  </div>
					  <div class="form-group">&nbsp; </div>
					  <div class="form-group">
						<label class="control-label col-lg-4">Aprendizaje 1:</label>
						<div class="col-lg-6">
						  <input type="text" class="form-control required" name="VCH_APRENDIZAJE1">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-lg-4">Aprendizaje 2:</label>
						<div class="col-lg-6">
						  <input type="text" class="form-control required" name="VCH_APRENDIZAJE2">
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-lg-4">Aprendizaje 3:</label>
						<div class="col-lg-6">
						  <input type="text" class="form-control required" name="VCH_APRENDIZAJE3">
						</div>
					  </div>
					</div>
					 <div class="col-lg-12 col-md-12 col-sm-12">
						<label class="control-label col-lg-8 col-md-8 col-sm-8 text-center">Evaluación del proyecto Bosque Urbano:</label>							
					</div>
					<div class="form-group">&nbsp; </div>
					<div class="form-group">
						<label class="control-label col-lg-4">Opinion del proyecto:</label>
						<div class="col-lg-6">
						<input type="text" class="form-control required" name="VCH_EVALUACION_BOSQUEURBANO">
					</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Sugerencias:</label>
						<div class="col-lg-6">
							<input type="text" class="form-control " name="VCH_SUGERENCIAS">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Participarias en otro taller?:</label>
						<div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-4 col-md-offset-4 col-sm-offset-4">
							<select class="form-control" onchange="gestorParticipa(this.value)" name="VCH_PARTICIPA_OTRO">
								<option value="1">Si</option>
								<option value="0" selected="selected">No</option>
							</select>	
						</div>
					</div>
					<div class="form-group" id="cualotro" style="display:none">
						<label class="control-label col-lg-4">Cual?:</label>
						<div class="col-lg-6 col-md-6 col-sm-6 ">									
							<select class="form-control" id="ID__CVETALLER" name="NUM_OTRO_ID__CVETALLER">
							<?php			
								foreach($talleresTomados as $tallerTomado)			
								{?>
								 <option value="<?=$tallerTomado["ID__CVETALLER"]?>" ><?=$tallerTomado["VCH_TALLER"]?></option>
							<?php }?>
						  </select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-4">Como te enteraste de este taller??:</label>
						<div class="col-lg-6 col-md-6 col-sm-6 ">									
							<select class="form-control" name="NUM_ENTARADOPOR"  onchange="gestorMedio(this.value)">							  
								<option value="0" >Prensa</option>
								<option value="1" >Radio</option>
								<option value="2" >Tv</option>
								<option value="3" >Facebook</option>
								<option value="4" >Página Web</option>
								<option value="5" >Aplicación Móvil</option>
								<option value="6" >Otro</option>
						  </select>
						</div>
					</div>
					<div class="form-group" id="cualmedio" style="display:none">
						<label class="control-label col-lg-4">Cual?:</label>
						<div class="col-lg-6 col-md-6 col-sm-6 ">																	
							<input type="text" class="form-control" name="VCH_ENTERADOPOROTRO">								
						</div>
					</div>						
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<button type="button" class="btn btn-default" onclick="contestarEncuesta()">Guardar Evaluacion</button>
	  </div>
	</div>
  </div>
</div>

<script type="text/javascript" src="<?=base_url()?>js/Taller/ListaTaller.js"></script>
