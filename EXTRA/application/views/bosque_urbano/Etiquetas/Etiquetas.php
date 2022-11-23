<div id="page-wrapper">
  <div class="container-fluid">
	<div class="page-wrapper">
		<div class="container-fluid">
			<div class="row">
			    <div class="col-lg-12">
			      <h2 class="page-header">
			        Bosque Urbano > <?= $titulo?>
			      </h2>
			    </div>
	  		</div>

	  		<div id="catalogoGuardaBosques">
	  			<?php include('catalogoInventarios.php'); ?>
			</div>
			<br>

			<div id="agregarModificar" hidden>
				  <div class="row">
				    <div class="col-lg-12">
				      <h2 class="page-header">
				        Generacion de etiquetas
				      </h2>
				    </div>
				  </div>
				  <?php include('AgregarModificar.php'); ?>
			</div>
		</div>		
		<div id="devolverModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-md">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">Recuperar etiqueta</h4>
			  </div>
			  <div class="modal-body">
				<form id="transferencia" >
					<div class="row form-horizontal">
						<div class="col-lg-12">
							<div class="form-group">
								  <label class="control-label col-md-3">Codigo QR:</label>
								  <div class="col-md-8">
									<input type="text" class="form-control required" id="VCH_QRRECUPERAR" name="VCH_QRRECUPERAR" >
								 </div>
						   </div>
						</div>						
					</div>
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-default" onclick="recuperar()">Devolver</button>
			  </div>
			</div>
		  </div>
		</div>
				
		<div id="etiquetaPerdidaModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-md">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">Etiqueta perdida</h4>
			  </div>
			  <div class="modal-body">
				<form id="transferencia" >
					<div class="row form-horizontal">
						<div class="col-lg-12">
							<div class="form-group">
								  <label class="control-label col-md-3">Codigo QR:</label>
								  <div class="col-md-8">
									<input type="text" class="form-control required" id="VCH_QRDESCONTAR" name="VCH_QRDESCONTAR" >
								 </div>
						   </div>
						</div>						
					</div>
					</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-default" onclick="descontar()">Descontar</button>
			  </div>
			</div>
		  </div>
		</div>
		<div id="verListaModal" class="modal fade" role="dialog">
		  <div class="modal-dialog modal-sm">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">Lista de etiquetas</h4>
			  </div>
			  <div class="modal-body" >
				<div style="height:200px;overflow:auto">
					<ul id="listaetiquetas">						
						<li>Coffee</li>
					</ul>
				</div>
			  </div>			  
			</div>
		  </div>
		</div>
		
	</div>
  </div>
</div>
<!-- Esta etiqueta se abre en la vista menu.php -->
</div>
<style>
  #custom-handle {
	width:30px;
    height: 1.8em;
    top: 50%;
    margin-top: -.9em;
    text-align: center;
  }
  </style>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/jqueryslider.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bosque_urbano/etiquetas.js"></script>
<script>$('#tablaespecies').on('click', 'tbody tr', function(event) 
  {
    $(this).addClass('success').siblings().removeClass('success')
 });</script>
