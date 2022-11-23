<form id="formaltaus" method="POST">
<div class="row form-horizontal" style="padding-left:20px">
  <div class="col-lg-8 col-lg-offset-1 col-md-8 col-md-offset-1 col-sm-8 col-sm-offset-1">
    <div class="form-inline">
	<?php
	if(in_array(22,$this->session->userdata('PERMISOS')))
	{?>
      <button type="button" id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button type="button" id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
      <button type="button" class="btn btn-primary" onclick="eliminar()"><i class="fa fa-trash" ></i> Eliminar</button>
    <?php
	}
	?>
      <!--<button type="button" id="btnSeguimiento" class="btn btn-primary"><i class="fa fa-arrow-right" ></i> Adopcion Ciudadana</button>-->
    <?php
	if(in_array(23,$this->session->userdata('PERMISOS')))
	{?>
      <button type="button" id="btnTerminar" class="btn btn-primary" ><i class="fa fa-arrow-right" ></i> Terminar evento</button>
    <?php
	}
	?>				
     </div>
  </div>
  <div class="col-lg-2 col-lg-offset-1 col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-1">
	 <?php
	//if(in_array(20,$this->session->userdata('PERMISOS')))
	if(true)
	{?>
	  <button type="button" id="btnSeguimientoReforesta" class="btn btn-primary"><i class="fa fa-arrow-right" ></i>Reportar Seguimiento</button>
	<?php
	}
    ?>
 </div>
</div><!--row-->
<div class="row form-horizontal" style="padding-top:20px">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre del evento:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_NOMBREEVENTO" name="VCH_NOMBREEVENTO" value="<?=$VCH_NOMBREEVENTO?>">
      </div>
    </div>   
   
    <div class="form-group">
		<label class="control-label col-lg-4">Fecha Inicio:</label>
		<div class="col-lg-8 date">
									
                <div class='input-group date' id='FEC_FECHAINICIOCal'>
                    <input type='text' class="form-control " id="FEC_FECHAINICIO" name="FEC_FECHAINICIO" value="<?=$FEC_FECHAINICIO?>"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            
			
		 <!-- <input type="text" class="form-control required" id="FEC_FECHAINICIO" name="FEC_FECHAINICIO" readonly>-->
		</div>
    </div>  
     <div class="form-group">
      <label class="control-label col-lg-4">Patrocinador:</label>
      <div class="col-lg-8">
         <select class="form-control" id="ID__EMPRESA" name="ID__EMPRESA">
			  <option value="-1">Todas</option>
          <?php          
			foreach($empresas as $empresa)
			{?>     				
				<option value="<?=$empresa["ID__EMPRESA"]?>" <?php if($ID__EMPRESA==$empresa["ID__EMPRESA"]){ ?>selected="selected"<?php } ?> ><?=$empresa["VCH_NOMBREEMPRESA"]?></option>				
			<?php
			}
			?>
        </select>

      </div>
    </div> 
    <div class="form-group">
     <label class="control-label col-lg-4">Estatus:</label>
      <div class="radio col-lg-8">
         <label class="radio-inline"><input type="radio" name="VCH_ESTATUS" id="form-activo" value="1" <?php if($VCH_ESTATUS==1){?>checked="checked"<?php }?>>Activo</label>
         <label class="radio-inline"><input type="radio" name="VCH_ESTATUS" id="form-inactivo" value="0" <?php if($VCH_ESTATUS==0){?>checked="checked"<?php }?>>Cancelado</label>
      </div>
	</div>        
    
    </div>
    
    <div class="col-lg-6">
    <div class="form-group" style="display:none">
      <label class="control-label col-lg-4">Tipo del evento:</label>
      <div class="col-lg-8">
        <select class="form-control" id="VCH_TIPO" name="VCH_TIPO">
			<option value="2" <?php if($VCH_TIPO==2){?>selected="selected"<?php }?>>Reforestacion</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre del lugar:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_NOMBRELUGAR" name="VCH_NOMBRELUGAR" value="<?=$VCH_NOMBRELUGAR?>">
      </div>
    </div>   
    <div class="form-group">
		<label class="control-label col-lg-4">Fecha Fin:</label>
		<div class="col-lg-8">
		 <!-- <input type="text" class="form-control required" id="FEC_FECHAFIN" name="FEC_FECHAFIN" readonly>-->
				<div class='input-group date' id='FEC_FECHAFINcal'>
                    <input type='text' class="form-control " id="FEC_FECHAFIN" name="FEC_FECHAFIN" value="<?=$FEC_FECHAFIN?>"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
		</div>
    </div>
	   
  </div><!--col-->
</div><!--col-->

<div class="col-lg-12">
  <div class="text-right">
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
  </div>
</div><br> <br><br>

<div class="row">
  <div class="col-lg-offset-1 col-lg-11">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					Nombre de evento
				</th>
				<th>
					Patrocinador
				</th>
				<th>
					Fecha de inicio
				</th>
				<th>
					Fecha de termino
				</th>
				<th>
					Nombre lugar
				</th>				
				<th>
					Estado
				</th>			
				<th>
					&nbsp;
				</th>												
				<th>
					&nbsp;
				</th>	
													
			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($eventos as $evento)			
			{?>
			 <tr id="<?=$evento["ID__EVENTO"]?>"  >
				 <td><?=$evento["VCH_NOMBREEVENTO"]?></td>
				 <td id="<?=$evento["ID__EMPRESA"]?>"><?=$evento["VCH_NOMBREEMPRESA"]?></td>				 
				 <td><?=$evento["FEC_FECHAINICIO"]?></td>				
				 <td><?=$evento["FEC_FECHAFIN"]?></td>			
				 <td><?=$evento["VCH_NOMBRELUGAR"]?></td>							 		 
				 <td><?php 
					switch($evento["VCH_ESTATUS"])
					{
						case 1:{
								echo "Activo"; break;}
						CASE 2:{
								echo "Finalizado"; break;}
						CASE 0:{
								echo "Cancelado"; break;}
					}
					?></td>			 			
					<td>
							<?php
							if($evento["VCH_ESTADOASIGNACION"]==1)
							{?>
							<button type="button" class="btn btn-primary" onclick="Imprimir(<?=$evento["ID__EVENTO"]?>)">Salida de Arbol de Evento</button>  
							<?php
							}
							?>&nbsp;
					</td>	
					<td>
						<?php
						if($evento["VCH_ESTADOASIGNACION"]==2)
						{	?>
						<button type="button" class="btn btn-primary" onclick="GeneraArchivo(<?=$evento["ID__EVENTO"]?>)">Generar Archivo para offline</button> 
						<?php
						}
							?>&nbsp;
					</td>		 		
			 </tr>
			 <?php
			 }?>
		 </table>      
</div><!--col-->
  </div><!--row-->
</form>
