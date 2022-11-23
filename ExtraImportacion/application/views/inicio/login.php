<script>
	 document.body.className="back";
</script>

<form action="<?= base_url().'index.php/Inicio/login'?>" method="post" enctype="multipart/form-data">
<div class="col-lg-4 col-md-5 div-centrado">
	<div class="panel panel-default">
		<div class="panel-heading text-center">
			<img src="<?=base_url().'Imagenes/bosque-urbano-logo.png'?>" style="heigth:180px; width:180px;"/>
		</div>
		<div class="panel-body">
			<form role="form">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-file"></span>
						</span>
						<input type="file" class="form-control txtLogin" name="archivo" id="archivo" placeholder="Usuario">
					</div>					
				</div>								
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-user"></span>
						</span>
						<select class="form-control txtLogin" name="evento" id="evento" placeholder="evento">
						<?php
							foreach($eventos as $evento)
							{
						?>
								<option value="<?=$evento["ID__EVENTO"]?>"><?=$evento["VCH_NOMBREEVENTO"]?></option>
						<?php
							}
						?>
						</select>

					</div>					
				</div>								
				<div class="form-group">
					<div class="col-lg-6 col-md-6 noPad-left"><!--<label for="" class="lblEtiqueta puntero">Olvidé mi contraseña</label>--></div>
					<div class="col-lg-6 col-md-6 noPad-right">
						<button type="submit" class="btn btn-primary btn-login ">Importar XML</button>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>
</form>



