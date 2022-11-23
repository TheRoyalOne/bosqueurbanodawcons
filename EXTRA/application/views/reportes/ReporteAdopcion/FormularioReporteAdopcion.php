<div class="row" id="catalogo">  
</div><!--row-->
<form action="<?=base_url().'index.php/reportes/GenerarReporteAdopcion'?>" method="POST" target="_blank" id="form">
<div class="row form-horizontal">
  <div class="col-lg-6 col-md-6 col-sm-6">       
    <div class="form-group">
        <label class="control-label col-lg-4 col-md-4 col-sm-4">Fecha Inicio:</label>
        <div class="col-lg-8 col-md-8 col-sm-8">
          <input type="text" class="form-control" name="fechaInicio" id="fechaInicio" onkeypress="return false;" onpaste="return false" autocomplete="off">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-lg-4">Fecha Fin:</label>
        <div class="col-lg-8">
          <input type="text" class="form-control" name="fechafin" id="fechafin" onkeypress="return false;" onpaste="return false" autocomplete="off">
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
        <label class="control-label col-lg-4">Estatus:</label>
        <div class="col-lg-8">
          <select class="form-control" id="VCH_ESTATUS" name="VCH_ESTATUS">             				
    		<option value="-1">Todos</option>
			<option value="0">Inactivo</option>				
			<option value="1">Activo</option>							
			<option value="2">Finalizado</option>							
        </select>
        </div>
      </div>   
      <div class="form-group">
        <label class="control-label col-lg-4">Geocerca de Estado:</label>
        <div class="col-lg-8">
          <select class="form-control" id="ID__ESTADO" name="ID__ESTADO" onchange="cargaciudades(this.value)" title="unicamente se reflejara en el mapa">             				
    		<option value="-1">Todo</option>			
    		 <?php          
			foreach($estados as $estado)
			{?>     				
				<option value="<?=$estado["ID__ESTADO"]?>"><?=$estado["VCH_NOMBRE"]?></option>				
			<?php
			}
			?>
        </select>
        </div>
      </div>   
      <div class="form-group">
        <label class="control-label col-lg-4">Geocerca de Municipio:</label>
        <div class="col-lg-8">
          <select class="form-control" id="ID__MUNICIPIO" name="ID__MUNICIPIO" title="unicamente se reflejara en el mapa">             				
    		<option value="-1">Todo</option>		    			
        </select>
        </div>
      </div>   
      <div class="form-group">      
      <div class="col-lg-2 col-sm-2 col-md-2 col-offset-sm-2 col-sm-offset-7">    
        <button type="button" class="btn btn-primary" onclick="generarNuevo()"><i class="fa fa-search"></i> Generar V2</button>
      </div> 
		  <div class="pull-right col-lg-2 col-sm-2 col-md-2">		
			   <button type="button" class="btn btn-primary" onclick="generar()"><i class="fa fa-search"></i> Generar</button>
		  </div>  
      </div>         
  </div><!--col-->
  
</div><!--row-->
</form>

