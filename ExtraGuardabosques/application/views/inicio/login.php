<script>
	 document.body.className="back";
</script>


<div id="devolverModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Recuperar contraseña</h4>
	  </div>
	  <div class="modal-body">
		<form id="transferencia" >
			<div class="row form-horizontal">
				<div class="col-lg-12">
					<div class="form-group">
						  <label class="control-label col-md-4 col-lg-4 col-sm-4">Correo registrado:</label>
						  <div class="col-md-6 col-lg-6 col-sm-6">
							<input type="text" class="form-control required" id="VCH_QRRECUPERAR" name="VCH_QRRECUPERAR" >
						 </div>
				   </div>
				</div>						
			</div>
		</form>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		<button type="button" class="btn btn-primary" onclick="recuperar()">Enviar Correo de recuperacion</button>
	  </div>
	</div>
  </div>
</div>

<form action="<?= base_url().'index.php/Inicio/login'?>" method="POST" id="form">

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
					<div class="col-lg-6 col-md-6 noPad-left">
						<label for="" class="lblEtiqueta puntero" onclick="$('#devolverModal').modal('show');">Olvidé mi contraseña</label>
					</div>
					<div class="col-lg-6 col-md-6 noPad-right">
						<button type="BUTTON" onclick="submitear()" class="btn btn-primary btn-login ">Iniciar Sesión</button>
					</div>
				</div>
				
			</form>
		</div>
	</div>
</div>
</form>
<script>
	function recuperar()
	{
		if($("#VCH_QRRECUPERAR").val()=='')
		{
			bootbox.alert("Escribe la cuenta a buscar");			
			return;
		}		
		$.ajax({
		  url: "<?=base_url().'index.php/Inicio';?>/recuperarPassword",
		  type: 'POST',
		  data:{		 
					cuenta: $("#VCH_QRRECUPERAR").val(),						
				}						  
		}).always(function(val) 
		{	
			bootbox.alert("Si la cuenta existe se enviara un correo a la direccion especificada.", function()
			{				
				$("#VCH_QRRECUPERAR").val("");
				$('#devolverModal').modal('hide');
			});			
		});			
	}
	
	function submitear()
	{
		$("#form").submit();
	}
</script>

