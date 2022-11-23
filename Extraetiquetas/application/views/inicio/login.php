<script>
	 document.body.className="back";
</script>

<form action="<?= base_url().'index.php/Inicio/login'?>" method="post" enctype="multipart/form-data" onkeypress="return event.keyCode != 13;">
<div class="col-lg-4 col-md-5 div-centrado">
	<div class="panel panel-default">
		<div class="panel-heading text-center">
			<img src="<?=base_url().'Imagenes/bosque-urbano-logo.png'?>" style="heigth:180px; width:180px;"/>
		</div>
		<div class="panel-body">
			<form role="form">
				
				<div class="row form-horizontal">
				  <div class="col-lg-6">
					<div class="form-group">
					  <label class="control-label col-lg-4">Patrocinador:</label>
					  <div class="col-lg-8">
						<select class="form-control" id="ID__EMPRESA" name="ID__EMPRESA" >
							<?php        
							foreach($empresas as $empresa)
							{?>     				
									<option value="<?=$empresa["ID__EMPRESA"]?>"><?=$empresa["VCH_NOMBREEMPRESA"]?></option>			
							<?php
							}
							?>
						</select>
						<!--<input type="text" class="form-control required" id="form_VCH_NOMBRE" name="form_VCH_NOMBRE">-->
					  </div>
					</div>
				   
					<div class="form-group">
					  <label class="control-label col-lg-4">A&ntilde;o:</label>
					  <div class="col-lg-8">
						<input type="number" min="2014" max="2035" class="form-control requiredb" id="VCH_ANIO" name="VCH_ANIO" value="2017">
					  </div>
					</div>
					<!--<div class="form-group">
					  <label class="control-label col-lg-4">Correo Electrónico:</label>
					  <div class="col-lg-8">
						<input type="text" class="form-control required" id="form_VCH_CORREO" name="form_VCH_CORREO">
					  </div>
					</div>-->
					</div>
					<div class="col-lg-6">
					  <div class="form-group">
						<label class="control-label col-lg-4">Especie:</label>
						<div class="col-lg-8">
							 <select class="form-control" id="ID__ESPECIE" name="ID__ESPECIE" >
							<?php        
							foreach($especies as $especie)
							{?>     				
									<option value="<?=$especie["ID__ESPECIE"]?>"><?=$especie["VCH_NOMBRECOMUN"]?></option>			
							<?php
							}
							?>          
							</select>
						</div>
					  </div>
					      
					  <div class="form-group">
						<label class="control-label col-lg-4">inicial:</label>
						<div class="col-lg-8">
						  <input  class="form-control required" id="INICIAL" name="INICIAL">
						</div>
					  </div>      
					  <div class="form-group">
						<label class="control-label col-lg-4">Final:</label>
						<div class="col-lg-8">
						  <input  class="form-control required" id="FINAL" name="FINAL">
						</div>
					  </div>      
				  </div><!--col--> 
				</div><!--col-->
				
				
												
				<div class="form-group">
					<div class="col-lg-6 col-md-6 noPad-left"><!--<label for="" class="lblEtiqueta puntero">Olvidé mi contraseña</label>--></div>
					<div class="col-lg-6 col-md-6 noPad-right">
						<button type="submit" class="btn btn-primary btn-login ">Dar de alta</button>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>
</form>



