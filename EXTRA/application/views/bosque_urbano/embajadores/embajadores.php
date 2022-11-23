<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/datatables.min.js"></script>
<style>.success {
  background-color: #dff0d8 !important;
}</style>
<div id="page-wrapper">
  <div class="container-fluid">
   <!-- Page Heading -->
   <div class="row">
    <div class="col-lg-12">
     <h1 class="page-header" style="font-size:30px">
       <?= $titulo?>
      </h2>
    </div>
  </div>

<div id="catalogoEmbajadores">
  <?php include('catalogoEmbajadores.php'); ?>
</div>

<br>
<div id="agregarModificar" hidden>
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">
        Formulario Embajador
      </h2>
    </div>
  </div>
  <?php include('agregarModificar.php'); ?>
</div>

<div id="modalColonias" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Colonias</h4>
      </div>
      <div class="modal-body" style="padding-bottom: 50px;">
		  <?php		  $segments = array('general', 'buscadorColonias');		  		  ?>
		  <script>window.closeModal = function(){    $('#modalColonias').modal('hide');};</script>
		  <iframe src="<?=site_url($segments)?>" style="width:100%;height:500px;"></iframe>
        <!--< ?php include('buscadorColonias.php'); ?>-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<div id="subirEmbajadores" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Importar Embajadores</h4>
      </div>
      <div class="modal-body">
        <?php include('subirEmbajadores.php'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-default" onclick="importar()">Subir</button>
      </div>
    </div>
  </div>
</div>

<div id="verAsignados" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Asignados a <label  id="QuienB"></label></h4>
      </div>
      <div class="modal-body" id="asignadosBody" style="height:300px;overflow:auto;">
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>      
      </div>
    </div>
  </div>
</div>

<div id="transferirModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Asignacion de Guardabosques</h4>
	  </div>
	  <div class="modal-body">
		<form id="transferencia" >
			<div class="row form-horizontal">
				<div class="col-lg-12 col-sm-12 col-md-12">
					<div class="form-group">
						  <label class="control-label col-md-5 col-lg-5 col-sm-5">Embajador:</label>
						  <label class=" col-lg-6 col-md-6 col-sm-6 text-center" id="Quien"></label>
				   </div>
				</div>				
				<div class="col-lg-12  col-sm-12 col-md-12">
					<div class="form-group">
						  <label class="control-label col-md-5 col-lg-5 col-sm-5">Antiguedad de Adopcion:</label>
						  <div  class=" col-lg-6 col-md-6 col-sm-6 text-center">
							<select class="form-control" id="AsignarAntiguedad" name="AsignarAntiguedad">
								<option value="-1">---</option>
								<?php
								$i=3;
								while($i<49)
								{
								?>
									<option value="<?=$i?>">Hasta <?=$i?> Meses</option>
									
								<?php
									$i=$i+3;
								}
								?>
								<option value="999">Mayor a 48 Meses</option>
							</select>
						  </div>
						  <!--<div id="slider" class="col-md-6 col-lg-6 col-sm-6"  style="padding-top:25px">
							  <div id="custom-handle" class="ui-slider-handle"></div>
						  </div>-->
				   </div>
				</div>
				<div class="col-lg-12  col-sm-12 col-md-12">
					<div class="form-group">
						  <label class="control-label col-md-5 col-lg-5 col-sm-5">Patrocinador:</label>
						  <!--<div id="slider" class="col-md-6 col-lg-6 col-sm-6"  style="padding-top:25px">
							  <div id="custom-handle" class="ui-slider-handle"></div>
						  </div>-->
						  <div  class=" col-lg-6 col-md-6 col-sm-6 text-center">							
							<select class="form-control" id="AsignarPatrocinador" name="AsignarPatrocinador">
								<option value="-1">---</option>
								<?php								
								foreach($empresas as $empresa)
								{
								?>
									<option value="<?=$empresa["ID__EMPRESA"]?>"><?=$empresa["VCH_NOMBREEMPRESA"]?></option>
								<?php								
								}
								?>
							</select>
						  </div>
				   </div>
				</div>
				<div class="col-lg-12  col-sm-12 col-md-12">
					<div class="form-group">
						  <label class="control-label col-md-5 col-lg-5 col-sm-5">Especie:</label>
						  <!--<div id="slider" class="col-md-6 col-lg-6 col-sm-6"  style="padding-top:25px">
							  <div id="custom-handle" class="ui-slider-handle"></div>
						  </div>-->
						  <div  class=" col-lg-6 col-md-6 col-sm-6 text-center">
							<select class="form-control" id="AsignarEspecie" name="AsignarEspecie">
								<option value="-1">---</option>
								<?php
								foreach($especies as $especie)
								{
								?>
									<option value="<?=$especie["ID__ESPECIE"]?>"><?=$especie["VCH_NOMBRECOMUN"]?></option>
								<?php								
								}
								?>
							</select>
						  </div>
				   </div>
				</div>
				<div class="col-lg-12  col-sm-12 col-md-12">
					<div class="form-group">
						  <label class="control-label col-md-5 col-lg-5 col-sm-5">Estado:</label>
						 <!-- <div id="slider" class="col-md-6 col-lg-6 col-sm-6"  style="padding-top:25px">
							  <div id="custom-handle" class="ui-slider-handle"></div>
						  </div>-->
						  <div  class=" col-lg-6 col-md-6 col-sm-6 text-center">
							<select class="form-control" id="AsignarEstado" name="AsignarEstado" onchange="cargaciudadeseMB(this.value)">
								<option value="-1">---</option>
								<?php
								foreach($estados as $estado)
								{
								?>
									<option value="<?=$estado["ID__ESTADO"]?>"><?=$estado["VCH_NOMBRE"]?></option>
								<?php
								}
								?>
							</select>
						  </div>
				   </div>
				</div>
				<div class="col-lg-12  col-sm-12 col-md-12">
					<div class="form-group">
						  <label class="control-label col-md-5 col-lg-5 col-sm-5">Municipio:</label>
						  <!--<div id="slider" class="col-md-6 col-lg-6 col-sm-6"  style="padding-top:25px">
							  <div id="custom-handle" class="ui-slider-handle"></div>
						  </div>-->
						  <div  class=" col-lg-6 col-md-6 col-sm-6 text-center">
							<select class="form-control" id="AsignarMunicipio" name="AsignarMunicipio" onchange="cargacoloniaseMB(this.value)">								
								<option value="-1">---</option>
							</select>
						  </div>
				   </div>
				</div>
				<div class="col-lg-12  col-sm-12 col-md-12">
					<div class="form-group">
						  <label class="control-label col-md-5 col-lg-5 col-sm-5">Colonia:</label>
						  <!--<div id="slider" class="col-md-6 col-lg-6 col-sm-6"  style="padding-top:25px">
							  <div id="custom-handle" class="ui-slider-handle"></div>
						  </div>-->
						   <div  class=" col-lg-6 col-md-6 col-sm-6 text-center">
							<select class="form-control" id="AsignaColonia" name="AsignaColonia">								
								<option value="-1">---</option>
							</select>
						  </div>
				   </div>
				</div>
				<div class="col-lg-12  col-sm-12 col-md-12">
					<div class="form-group">
						  <label class="control-label col-md-5 col-lg-5 col-sm-5">Cantidad:</label>
						  <!--<div id="slider" class="col-md-6 col-lg-6 col-sm-6"  style="padding-top:25px">
							  <div id="custom-handle" class="ui-slider-handle"></div>
						  </div>-->
						  <div  class=" col-lg-6 col-md-6 col-sm-6 text-center">
							<input type="text" class="form-control requiredc" id="AsignarCantidad" name="AsignaCantidad">
						  </div>
				   </div>
				</div>
			</div>
			
			</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<button type="button" class="btn btn-primary" onclick="transferir()">Asignar</button>
	  </div>
	</div>
  </div>
</div>

</div><!--container fluid-->
</div><!--page-wrapper-->
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>


<script type="text/javascript">
$('#form_FEC_FECHAINICIO').datepicker({
    format: 'dd/mm/yyyy',
    language: 'esp'
  });
  $('#form_FEC_FECHAFIN').datepicker({
    format: 'dd/mm/yyyy',
    language: 'esp'
  });
  
  
  
  $('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/jqueryslider.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style>
  #custom-handle {
	width:30px;
    height: 1.8em;
    top: 50%;
    margin-top: -.9em;
    text-align: center;
  }
  </style>
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/embajadores.js"></script>
<script>var maximos='<?=$maximos?>'</script>

