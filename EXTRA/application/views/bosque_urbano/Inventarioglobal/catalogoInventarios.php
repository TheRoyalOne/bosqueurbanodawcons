<form id="formaltaus" method="POST">
<div class="row form-horizontal" >
  <div class="col-lg-11 col-lg-offset-1">
    <div class="form-inline">
      <button type="button" id="btnAgregar" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <!--<button type="button" id="btnEditar" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
      <button type="button" class="btn btn-primary" onclick="eliminar()"><i class="fa fa-trash" ></i> Eliminar</button>-->
    </div>
  </div>
</div><!--row-->
<!--
<div class="row form-horizontal">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_NOMBRE" name="VCH_NOMBRE">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-lg-4">Especie:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_APELLIDOPATERNO" name="VCH_APELLIDOPATERNO">
      </div>
    </div>
    
  </div><!--col-- >
</div><!--col-- >

<div class="col-lg-12">
  <div class="text-right">
    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
  </div>
</div><br> <br><br>
-->


<div class="row" style="padding-top:20px">
  <div class="col-lg-offset-1 col-lg-11">
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >			
			<tr>	
				
				<th>
					Ubicacion
				</th>
				<th>
					Especie
				</th>
				<th>
					Contenedor
				</th>
				<th>
					Edad meses
				</th>
				<th>
					Procedencia
				</th>			
				<th>
					Cantidad
				</th>
				<th>
					
				</th>
				<th>
					
				</th>
				<th>
					
				</th>

			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($inventarios as $inventario)			
			{?>
			 <tr id="<?=$inventario["ID__INVENTARIO"]?>">				 
				 
				 <td><?php echo $inventario["zona"];				 
						switch($inventario["INT_USO"])
						{
							case "1":{ Echo " | evento de adopcion"; break;}
							case "2":{ Echo " |  Crecimiento" ;break;}
							case 3:{ Echo " |  Producción" ;break;}
							case 4:{ Echo " |  Recuperación"; break;}
							case 5:{ Echo " |  Stock" ;break;}
							case 6:{ Echo " |  Trasplante"; break;}
							case 7:{ Echo " |  Reforestación"; break;}
							case 8:{ Echo " |  Evento Adopción Especial"; break;}
							case 9:{ Echo " |  Tipo:Cuarentena"; break;}
							default:{break;}
							
						}
				 
				 ?></td>				 
				 <td><?=$inventario["especie"]?></td>				
				 <td><?=$inventario["contenedor"]?></td>			
				 <td><?=ceil($inventario["edad"])?></td>			
				 <td><?=$inventario["procedencia"]?></td>
				 <td><?=$inventario["NUM_CANTIDAD"]?></td>		
				 <td><a href="javascript:editar(<?=$inventario["ID__INVENTARIO"]?>)">Editar</a> </td>				 				 				 				 									 
				 <td><a href="javascript:transferirDe(<?=$inventario["ID__INVENTARIO"]?>,<?=$inventario["NUM_CANTIDAD"]?>)">Transferir</a></td>
				 <td><a href="javascript:darDeBaja(<?=$inventario["ID__INVENTARIO"]?>,<?=$inventario["NUM_CANTIDAD"]?>)">Merma</a></td>
			 </tr>
			 <?php
			 }?>
		 </table>      
	</div><!--col-->
</div><!--row-->





</form>
