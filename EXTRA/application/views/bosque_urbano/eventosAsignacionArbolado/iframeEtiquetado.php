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
					<!--<th class="text-center">
						Arboles etiquetados
					</th>-->
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
					 
				 </tr>
				 <?php
				 }?>
			 </table>      
	</div><!--col-->
</div><!--row-->
<!--
<div class="row">
    <div class="col-lg-offset-1 col-lg-3" style="padding-bottom:10px">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='300' id="tablaetiquetas" name="tablaetiquetas" >
				<thead style='background-color:#00A89C; color:#fff;' >
				<tr>
					<th colspan="2">
						Etiquetas impresas para patrocinador
					</th>
				</tr>
				</thead>				
				< ?php			
				foreach($etiquetas as $etiqueta)			
				{?>
				 <tr>
					 <td class="text-center">< ?=$etiqueta["cuantas"]?></td>
					 <td class="text-center">< ?=$etiqueta["VCH_NOMBRECOMUN"]?></td>
				 </tr>
				 < ?php
				 }?>
			 </table>  
	</div><! --col- ->
</div><! --row - ->
-->




<div class="row">			
  <!--<div class="col-lg-3 col-lg-offset-1  col-md-3 col-sm-3 ">
    <div class="form-group">
      <label class="control-label col-lg-3 col-md-3 col-sm-3">Especie:</label>
      <div class="col-lg-8 col-md-9 col-sm-9">
			<select class="form-control" id="ID__ESPECIEAsignar" onchange="CargaStockEtiqueta(this.value)">
			  <option value="-1">Selecciona</option>
			  <?php          
				foreach($especiesEmpresa as $especie)
				{?>     				
					<option value="<?=$especie["ID__ESPECIE"]?>"><?=$especie["VCH_NOMBRECOMUN"]?></option>				
				<?php
				}
				?>
			</select>
		</div>
	 </div>       
	</div>	
  <div class="col-lg-4 col-md-4 col-sm-4">
    <div class="form-group">
      <label class="control-label col-lg-9 col-md-9 col-sm-9">Cantidad de etiquetas a asignar:</label>
      <div class="col-lg-3 col-md-3 col-sm-3">
			<input type="number" min="0" class="form-control" id="cantidadAsignar"/>
		</div>
	 </div>       
	</div>	-->
  <div class="col-lg-11 col-md-11 col-sm-11 text-right">
    <div class="form-group">
          <button type="button" id="btnAgresgar" class="btn btn-primary" onclick="AbrirGeneradorEtiquetas()"><i class="fa fa-plus-circle"></i> Generar</button>
          <button type="button" id="btnAgresgar" class="btn btn-primary" onclick="AsignarEtiquetasAevento()"><i class="fa fa-plus-circle"></i> Asignar</button>
	</div>	
</div>




<div class="row">
    <div class="col-lg-offset-1 col-lg-10 col-md-12 col-sm-12">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='300' id="tablaetiquetas" name="tablaetiquetas" >
				<thead style='background-color:#00A89C; color:#fff;' >
				<tr>
					<th class="text-center">
						Especie
					</th>
					<th class="text-center">
						Arbolado Cantidad
					</th>
					<th class="text-center">
						Etiquetas del stock
					</th>
					<th class="text-center">
						&nbsp;
					</th>					
					<!--<th class="text-center">
						&nbsp;
					</th>					-->
					<!--<th class="text-center">
						&nbsp;
					</th>					-->
					<!--<th class="text-center">
						Imprimir etiquetas
					</th>-->
				</tr>
				</thead>
				<?php			
//				echo "<pre>";die(print_r(get_defined_vars())."?");
				foreach($reletiquetasasignados as $reletiquetaasignada)			
				{?>
				 <tr>
					 <td class="text-center"><?=$reletiquetaasignada["especie"]?></td>
					 <td class="text-center"><?=$reletiquetaasignada["cantidadarboles"]?></td>
					 <td class="text-center"><?=$reletiquetaasignada["cantidadetiquetas"]?></td>					 					 
					 <td class="text-center"><a href="javascript:AutoGenerar('<?=($reletiquetaasignada["cantidadarboles"]-$reletiquetaasignada["cantidadetiquetas"])?>','<?=$reletiquetaasignada["ID__ESPECIE"]?>','<?=$reletiquetaasignada["ID__EVENTO"]?>')">Auto Generar</a></td>
					<!-- <td class="text-center"><a href="javascript:AutoAsignar('<?=($reletiquetaasignada["cantidadarboles"]-$reletiquetaasignada["cantidadetiquetas"])?>','<?=$reletiquetaasignada["ID__ESPECIE"]?>','<?=$reletiquetaasignada["ID__EVENTO"]?>')">Auto Asignar</a></td>
					 <td class="text-center"><a href="javascript:verEtiquetas(<?=$reletiquetaasignada["ID__ESPECIE"]?>)">Ver</a></td>-->
					 <!--<td class="text-center"><a href="javascript:ImprimirEtiquetas()">Imprimir</a></td>-->
					 
				 </tr>
				 <?php
				 }?>
			 </table>  
	</div><!--col-->
</div><!--row-->

<div class="text-center">
    <button class="btn btn-primary" onclick="TerminaDeEtiquetar()">Termine de asignar Etiquetas</button>    
</div>

<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/EventosAsignarRecusosIframe.js"></script>
<script>var maximosrequeridos=<?=$evento["NUM_ARBOLESSOLICITADOS"]-$evento["asignados"];?>;</script>

