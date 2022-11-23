<?php
//echo "<pre>";
//die(print_r($perfiles));


?>
<div id="page-wrapper">
  <div class="container-fluid">
   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header" style="font-size:30px">
       <?= $titulo?>
      </h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <form class="form-horizontal" id="form">
        <div class="form-group">
          <label class="control-label col-lg-4">Nombre Perfil:</label>
          <div class="col-lg-8">
            <input type="text" class="form-control" id="VCH_NOMBRE">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-4">Estatus:</label>
          <div class="radio">
            <label class="radio-inline"><input type="radio" name="optradio" name="estatus" id="activo">Activo</label>
            <label class="radio-inline"><input type="radio" name="optradio" name="estatus" id="inactivo">Inactivo</label>
            <input type="hidden" id="ID__PERFIL" value="0">
          </div>
        </div>

        <div class="form-inline col-lg-offset-4 col-lg-8">
          <button type="button" onclick="guardarPerfil()" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
          <button type="button" onclick='document.getElementById("form").reset()' class="btn btn-default"><i class="fa fa-ban"></i> Cancelar</button>
        </div>
      </form>

    </div>

    <div class="col-lg-6">
      <form class="form-group">
       <label for="tree">Permisos:</label>
       <div id="tree" class="treeview">
      </form>        
    </div>
  </div><!--row-->
  <div class="row">
    <div class="col-lg-offset-1 col-lg-11">
       <?php 			
			$datos=array();
			foreach($perfiles as $perfil)
			{
				if(intval($perfil['VCH_ESTATUS'])==1)				
				{					
					$perfil['VCH_ESTATUS']='Activo';													
				}
				else
				{	
					$perfil['VCH_ESTATUS']='Inactivo';									
				}
				array_push($datos,$perfil['VCH_NOMBRE'],$perfil['VCH_ESTATUS'],"<button type='button' class='btn btn-primary' onclick='cargarmodificar(".$perfil['ID__PERFIL'].",$(this).parent().parent())'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary' onclick='eliminar(".$perfil['ID__PERFIL'].",$(this).parent().parent())'><i class='fa fa-trash'></i> Eliminar</button>");
			}
			       
          /*$datos=array('Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>",
            'Administrador','Activo',"<button type='button' class='btn btn-primary'><i class='fa fa-cog'></i> Modificar</button>","<button type='button' class='btn btn-primary'><i class='fa fa-trash'></i> Eliminar</button>"); */
          
          $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='500' >",
                           'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
          $this->table->set_template($template);
          $this->table->set_heading('Nombre Perfil','Estatus','','');
          echo  $this->table->generate($this->table->make_columns($datos,4));

         ?>
    </div>
  </div>
 </div>
</div>

<!-- Esta etiqueta se abre en la vista menu.php -->
</div>

<script> var cadenaPermisos=<?=$permisos?>;</script>
<script type="text/javascript" src="<?=base_url()?>js/administrativo/perfiles.js"></script>

