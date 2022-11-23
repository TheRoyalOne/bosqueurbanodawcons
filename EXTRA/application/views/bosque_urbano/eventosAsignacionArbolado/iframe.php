<div class="row">
	  <div class="col-lg-offset-1 col-lg-10">
			<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='100' id="tablaespecies" name="tablaespecies" >
				<thead style='background-color:#00A89C; color:#fff;' >
				<tr>
					<th class="text-center">
						Nombre de evento
					</th>
					<th class="text-center">
						Patrocinador
					</th>
					<th class="text-center">
						Fecha Evento
					</th>
					<th class="text-center">
						Hora evento
					</th>					
					<th class="text-center">
						Arboles Solicitdados
					</th>
					<th class="text-center">
						Arboles asignados
					</th>												
					<th class="text-center">
						Vehiculo asignado
					</th>												
				</tr>
				</thead>
				<?php			
				//die(print_r($guardabosques)."?");
				foreach($eventos as $evento)			
				{?>
				 <tr id="<?=$evento["ID__EVENTO"]?>"  >
					 <td class="text-center"><?=$evento["VCH_NOMBREEVENTO"]?></td>
					 <td class="text-center"><?=$evento["VCH_NOMBREEMPRESA"]?></td>				 
					 <td class="text-center"><?=explode(" ",$evento["FEC_FECHAINICIO"])[0]?></td>				
					 <td class="text-center"><?=explode(" ",$evento["FEC_FECHAINICIO"])[1]?></td>				
					 <td class="text-center"><?=$evento["NUM_ARBOLESSOLICITADOS"]?></td>
					 <td class="text-center" ><?php 
					if(!empty($evento["asignados"]))
					{echo $evento["asignados"];}else{ echo 0;}?></td>
					 <td class="text-center"><?=$evento["vehiculos"]?></td>
				 </tr>
				 <?php
				 }?>
			 </table>      
	</div><!--col-->
</div><!--row-->
<br/>
<div class="row">
    <div class="col-lg-offset-1 col-lg-3" style="padding-bottom:10px">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='300' id="tablaetiquetas" name="tablaetiquetas" >
		<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Etiquetas
				</th>
				<th>&nbsp;</th>
			</tr>
		</thead>				
			<?php			
			foreach($etiquetas as $etiqueta)			
			{?>
			 <tr>
				 <td class="text-center"><?=$etiqueta["cuantas"]?></td>
				 <td class="text-center"><?=$etiqueta["VCH_NOMBRECOMUN"]?></td>
			 </tr>
			 <?php
			 }?>
		 </table>  
	</div><!--col-->
	<div class="col-lg-offset-2 col-lg-5">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='300' id="tablaetiquetas" name="tablaetiquetas" >
				<thead style='background-color:#00A89C; color:#fff;' >
				<tr>
					<th class="text-center">
						Especie
					</th>
					<th class="text-center">
						Asignados zona
					</th>
					<th class="text-center">
						Cantidad
					</th>
				</tr>
				</thead>
				<?php			
//				die(print_r($relarbolasignados)."?");
				foreach($relarbolasignados as $relarbolasignado)			
				{?>
				 <tr>
					 <td class="text-center"><?=$relarbolasignado["VCH_NOMBRECOMUN"]?></td>
					 <td class="text-center"><?=$relarbolasignado["VCH_NOMBRE"]?></td>
					 <td class="text-center"><?=$relarbolasignado["NUM_CANTIDAD"]?></td>
				 </tr>
				 <?php
				 }?>
			 </table>  
	</div><!--col-->
</div><!--row-->
<br/>
<div class="row form-horizontal">			
  <div class="col-lg-5 col-lg-offset-1 col-md-5 col-sm-5 col-md-offset-1 col-sm-offset-1">
    <div class="form-group">
      <label class="control-label col-lg-6">Responsable de carga:</label>
      <div class="col-lg-6">
			<select class="form-control" id="ID__USUARIO">
				<?php  
				foreach($responsables as $responsable)
				{?>
				<option value="<?=$responsable["ID__USUARIO"]?>"><?=$responsable["VCH_NOMBRE"]?></option>				
				<?php
				}
				?>
			</select>
		</div>
    </div> 
</div>
  <div class="col-lg-5  col-md-5 col-sm-5 ">
      <div class="form-group">
        <label class="control-label col-lg-6">Fecha y hora de carga:</label>
		<div class="col-lg-6">
			<!--<input type="text" class="form-control required" id="FFEC_FECHAFIN"  readonly>-->
			<div class='input-group date' id='FFEC_FECHAFINcal'>
				<input type='text' class="form-control required" id="FFEC_FECHAFIN" name="FFEC_FECHAFIN" />
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>						
      </div>
      
      
  </div><!--col-->  
</div><!--col-->

<div class="row form-horizontal">			
   <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
	   <table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='300'>
		   <thead style='background-color:#00A89C; color:#fff;' >
			   <tr>
				   <th>Especies</th>
				   <th>Zona</th>
				   <th>Contenedor</th>
				   <th>Edad</th>
				   <th>Disponibles</th>
				   <th>Cantidad a asignar</th>
			   </tr>
		   </thead>
		   <tbody>
		   <?php 
		   
		   $i=0;
		   //echo "<pre>";		   die(print_r($especies));
		   foreach($especies as $especie)
			{
				
			 ?>
		   <tr>
			   <td><?=$especie["VCH_NOMBRECOMUN"]?></td>
			   <td><?=$especie["ubicacion"]?></td>
			   <td><?=$especie["contenedor_nombre"]?></td>
			   <td><?=$especie["edad"]?></td>
			   <td><?=$especie["NUM_CANTIDAD"]?></td>
			   <td id="form<?=$i?>"><input type="number" id="NUM_CANTIDAD<?=$i?>"  min="0" max="<?=$especie["NUM_CANTIDAD"]?>" OnPaste="return false;" onblur="if(this.value><?=$especie["NUM_CANTIDAD"]?>){this.value=<?=$especie["NUM_CANTIDAD"]?>}">
				 <input type="hidden" id="ID__UBICACION<?=$i?>" value="<?=$especie["ID__UBICACION"]?>"/>			   
				 <input type="hidden" id="contenedor_id<?=$i?>" value="<?=$especie["contenedor_id"]?>"/>
				 <input type="hidden" id="NUM_EDADMESES<?=$i?>" value="<?=$especie["edad"]?>"/>
				 <input type="hidden" id="ID__ESPECIE<?=$i?>" value="<?=$especie["ID__ESPECIE"]?>"/>				 
			   </td>
			   
			</tr>		   
		   <?php
				$i++;
			}
		   ?>
		   </tbody>
	   </table>	   
	</div>
</div>










<div class="text-right">
	<div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1">
		<button class="btn btn-primary" onclick="guardar()">Asignar</button>    
    </div>
</div>
<div class="text-right">
	<div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1">
		&nbsp;
    </div>
</div>

<div class="text-center">
    <button class="btn btn-primary" onclick="TerminaDeAsignar()">Termine de asignar Arboles</button>    
    <button class="btn btn-danger" onclick="ReiniciarAsignacion()">Reiniciar Asignacion</button>    
<!--    <button class="btn btn-default" onclick="Imprimir()">Salida de Arbol de Evento</button>    
    <button class="btn btn-default" onclick="GeneraArchivo()">Generar Archivo para offline</button>    -->
</div>
<script type="text/javascript" src="<?=base_url()?>js/moment.js"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/bootstrap-datetimepicker.min.css"/>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/EventosAsignarRecusosIframe.js"></script>
<script>var maximosrequeridos=<?=$evento["NUM_ARBOLESSOLICITADOS"]-$evento["asignados"];?></script>
<?php
if($ID__USUARIO!='')
{
?>
	<script>$("#ID__USUARIO").val(<?=$ID__USUARIO?>)</script>
<?php
}
if($FFEC_FECHAFIN!='')
{
?>
	<script>		
			$('#FFEC_FECHAFIN').datetimepicker({});
			$('#FFEC_FECHAFIN').data("DateTimePicker").date(new Date('<?=$FFEC_FECHAFIN?>'));		
	</script>
<?php
}

