<div class="row" id="catalogo">  
</div><!--row-->
<form action="<?=base_url().'index.php/reportes/GenerarReporteReforestacion'?>" method="POST" target="_blank" id="form">
<div class="row form-horizontal">
  <div class="col-lg-6 col-md-6 col-sm-6">       
    <div class="form-group">
        <label class="control-label col-lg-4 col-md-4 col-sm-4">Fecha Inicio:</label>
        <div class="col-lg-8 col-md-8 col-sm-8">
          <input type="text" class="form-control" name="fechaInicio" id="fechaInicio" onkeypress="return false;" onpaste="return false">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Fecha Fin:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control" name="fechafin" id="fechafin" onkeypress="return false;" onpaste="return false">
        </div>
      </div>   
      <div class="form-group">
        <label class="control-label col-lg-4">Evento:</label>
        <div class="col-lg-8">
         <select class="form-control" id="ID__EVENTO" name="ID__EVENTO">
			<option value="-1">Todos</option>
          <?php          
			foreach($eventos as $evento)
			{?>     				
				<option value="<?=$evento["ID__EVENTO"]?>"><?=$evento["VCH_NOMBREEVENTO"]?></option>				
			<?php
			}

			?>
        </select>
        </div>
      </div>   
      <div class="form-group">
        <label class="control-label col-lg-4">Patrocinador:</label>
        <div class="col-lg-8">
         <select class="form-control" id="ID__EMPRESA" name="ID__EMPRESA">
		 <option value="-1">Todos</option>
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
		  <div class="pull-right col-lg-2 col-sm-2 col-md-2">		
			<button type="button" class="btn btn-primary" onclick="generar()"><i class="fa fa-search"></i> Generar</button>
		  </div>  
      </div>         
  </div><!--col-->
  
</div><!--row-->
</form>

