<form id="formaltaus" method="POST">
<div class="row">
  <div class="col-lg-11 col-lg-offset-1">
    <div class="form-inline">
      <button id="btnAgregar" type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Agregar</button>
      <button id="btnEditar" type="button" class="btn btn-primary"><i class="fa fa-gear"></i> Modificar</button>
    </div>
  </div>
</div><!--row-->
<div class="row form-horizontal" style="padding-top:20px">
  <div class="col-lg-6">
    <div class="form-group">
      <label class="control-label col-lg-4">Nombre del taller:</label>
      <div class="col-lg-8">
        <input type="text" class="form-control" id="VCH_CLAVETALLER_busqueda" name="VCH_CLAVETALLER_busqueda">
      </div>
    </div>

  </div><!--col-->
  <div class="col-lg-6 ">
    <div class="form-group">
      <label class="control-label col-lg-4 ">Categoria:</label>
      <div class="col-lg-8">
        <select class="form-control" name="ID__TALLER_busqueda">
			<option value="-1">Seleccione</option>
			<?php
			foreach($catalogotalleres as $catalogotaller)			
			{?>
			 <option value="<?=$catalogotaller["ID__TALLER"]?>"><?=$catalogotaller["VCH_NOMBRE"]?></option>			
		 <?php
			 }?>
          
          <!--<option>Taller 1</option>
          <option>Taller 2</option>-->
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="pull-right" style="padding-right:12px">
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
      </div>
    </div>
  </div><!--col-->
</div><!--row-->

<div class="row">
  <div class="col-lg-offset-1 col-lg-11">
   <?php 
/*
   $datos=array('1','Taller 1','2',' 57','Vivero',
     '1','Taller 2','2',' 57','Vivero',
     '1','Taller 3','2',' 57','Vivero',
     '1','Taller 4','2',' 57','Vivero',
     '1','Taller 5','2',' 57','Vivero',
     '1','Taller 6','2',' 57','Vivero',
     '1','Taller 7','2',' 57','Vivero',
     '1','Taller 8','2',' 57','Vivero',
     '1','Taller 9','2',' 57','Vivero',
     '1','Taller 10','2',' 57','Vivero',
     '1','Taller 11','2',' 57','Vivero',
     '1','Taller 12','2',' 57','Vivero',
     '1','Taller 13','2',' 57','Vivero',
     '1','Taller 14','2',' 57','Vivero',
     '1','Taller 15','2',' 57','Vivero',
     '1','Taller 16','2',' 57','Vivero'); 
$template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
 'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
$this->table->set_template($template);
$this->table->set_heading('No.','Nombre del taller','Sesiones','Convocados','Instalaciones');
echo  $this->table->generate($this->table->make_columns($datos,5));
*/
?>
		<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' id="tablaespecies" name="tablaespecies" >
			<thead style='background-color:#00A89C; color:#fff;' >
			<tr>
				<th>
					No.
				</th>
				<th>
					Nombre del taller
				</th>
				<th>
					Sesiones
				</th>
				<th>
					Convocados
				</th>
				<th>
					Instalaciones
				</th>													
				<th>
					Precio
				</th>	
        <th>
          Patrocinador
        </th> 												
        <th>
          Tallerista(s)
        </th>     
        <th>
          Fecha(s)
        </th>     
			</tr>
			</thead>
			<?php			
			//die(print_r($guardabosques)."?");
			foreach($talleres as $taller)			
			{?>
			 <tr id="<?=$taller["ID__CVETALLER"]?>"  >
				 <td><?=$taller["ID__CVETALLER"]?></td>
				 <td><?=$taller["VCH_TALLER"]?></td>
				 <td><?=$taller["NUM_SESIONES"]?></td>				 
				 <td><?=$taller["NUM_CONVOCADOS"]?></td>				
				 <td><?=$taller["VCH_INSTALACIONES"]?></td>	
				 <td><?=$taller["VCH_PRECIO"]?></td>		
         <td><?=$taller["VCH_NOMBREEMPRESA"]?></td>	

         <td><?=$taller["TALLERISTA"]?></td>    
         <td><?=$taller["fecha"]?></td> 
			 </tr>
			 <?php
			 }?>
	 </table>
</div><!--col-->
  </div><!--row-->
  </form>
