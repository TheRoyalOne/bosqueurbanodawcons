<style>
	.paddtop
	{
		padding-top:13px !important;
	}
</style>
<form id="formaltaus" method="POST">
	<div class="row form-horizontal" style="padding-top:20px">
		<div class="col-lg-9 col-md-9 col-sm-9">
			<div class="form-group">
			  <label class="control-label col-lg-4 col-md-4 col-sm-4">Categoria de la Pregunta:</label>
			  <div class="col-lg-8 col-md-8 col-sm-8">
				  <select type="text" class="form-control" id="ID__CATEGORIA" name="ID__CATEGORIA" style="text-align-last:center;   ">
					  <option value="-1">Todas</option>
					  <?php
					  
					  //die("?".$ID__CATEGORIA);
					  foreach($categorias as $cat)
					  {
					  ?>
						<option value="<?=$cat["ID__CATEGORIA"]?>"  <?php if($ID__CATEGORIA==$cat["ID__CATEGORIA"]){?> selected="selected" <?php }?>><?=$cat["VCH_NOMBRE"]?></option>						
					 <?php
					 }
					 ?>
				  </select>
			  </div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2">
			<button type="submit" class="col-offset-lg-10 btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
		</div>
	</div>
</form>


<div class="col-lg-10 col-lg-offset-1 col-md-10 col-sm-12">            
    <div class="panel-group" id="accordion">                
       <!-- <div class="faqHeader">Tema </div>        -->
       
       
       
       
		<?php 
		foreach($misPreguntas as $pregunta)

		{
		?>
        <div class="panel panel-default">
            <div class="panel-headings pendiente">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$pregunta["ID__MENSAJE"]?>">
						<label><?=$pregunta["FEC_REGISTRO"];?></label> - <?=$pregunta["nombre"];?>
						</br>
						 <?=$pregunta["VCH_TEXTO"];?>						
                    </a>
                </h4>
            </div>
            <div id="collapse<?=$pregunta["ID__MENSAJE"]?>" class="panel-collapse collapse">
                <div class="panel-body text-center">
					<form action="ResponderPregunta" method="post" enctype="multipart/form-data" id="formulario<?=$pregunta['ID__MENSAJE'];?>">												
						<div class="row form-horizontal">
						  <div class="col-lg-11">
								<div class="form-group">
									 <label class="control-label col-lg-3">Respuesta:</label>
									 <div class="col-lg-9">
									   <input type="text" class="form-control required" id="VCH_TEXTO<?=$pregunta['ID__MENSAJE'];?>" name="VCH_TEXTO">
									 </div>
							   </div>
							   <div class="form-group">
									 <label class="control-label col-lg-3">Archivo Complementario:</label>
									 <div class="col-lg-9">
									  <input type="FILE" class="form-control required" id="VCH_FILE<?=$pregunta['ID__MENSAJE'];?>" name="VCH_FILE">
									 </div>
							   </div>
							   <div >									
									 <div class="col-lg-offset-10 col-md-offset-6 col-sm-offset-1 col-lg-2 col-sm-6 col-md-6 ">
											 <input type="hidden" value="<?=$pregunta['ID__MENSAJE'];?>" id="ID__MENSAJE" name="ID__MENSAJE">
		 									 <button type="button" class="btn btn-primary form-control" onclick="responder(<?=$pregunta["ID__MENSAJE"];?>)">Responder</button>
									 </div>

							   </div>
						  </div>
						</div>
                    </form>
                </div>
            </div>
        </div>        
        <?php
        }
        ?>

        

    </div>
</div>

<style>
    .faqHeader {
        font-size: 27px;
        margin: 20px;
    }

    .panel-headings [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        content: "\e072"; /* "play" icon */
        float: right;
        color: #F58723;
        font-size: 18px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-headings [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
    
    .pendiente
    {
		min-height: 70px;
		background-color:#f5f5f5;
	}
	.respondida
	{
		background-color:#97E0C9;
		color:black;

	}
	.panel-headings
	{
		 padding: 10px 15px;
	  border-bottom: 1px solid transparent;
	  border-top-left-radius: 3px;
	  border-top-right-radius: 3px;
	}
</style>

<script type="text/javascript" >
	function responder(cual)
	{
		if($("#VCH_TEXTO"+cual).val()=="")
		{
			bootbox.alert("Favor de escribir la respuesta");
			return;
		}
		else
		{
			$("#formulario"+cual).submit();					
		}
	}

</script>

