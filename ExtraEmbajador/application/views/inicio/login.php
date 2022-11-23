<script>
	 document.body.className="back";
</script>

<form action="<?= base_url().'index.php/Inicio/login'?>" method="post">
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
							<span class="glyphicon glyphicon-user"></span>
						</span>
						<input type="text" class="form-control txtLogin" name="user" id="exampleInputEmail1" placeholder="Usuario">
					</div>
					<!--<label for="exampleInputEmail1">Usuario</label>-->
					
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<span class="glyphicon glyphicon-lock"></span>
						</span>
						<input type="password" class="form-control txtLogin" name="pass" id="exampleInputPassword1" placeholder="Contraseña">
					</div>
					<!--<label for="exampleInputPassword1">Contraseña <a href="/sessions/forgot_password">(Olvidé mi Contraseña)</a></label>-->
					
				</div>
				
				<div class="form-group">
					<div class="col-lg-6 col-md-6 noPad-left"><!--<label for="" class="lblEtiqueta puntero">Olvidé mi contraseña</label>--></div>
					<div class="col-lg-6 col-md-6 noPad-right">
						<button type="submit" class="btn btn-primary btn-login ">Iniciar Sesión</button>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>
</form>



