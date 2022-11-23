<style>
	.paddtop
	{
		padding-top:13px !important;
	}
</style>


<div class="row form-horizontal">
	<div class="col-lg-8 col-md-8 col-sm-8">
		<div class="form-group">
          <label class="control-label col-lg-4 col-md-4 col-sm-4">Realizar una pregunta:</label>
          <div class="col-lg-8 col-md-8 col-sm-7">
            <input type="text" class="form-control" id="Pregunta" maxlength="2000">
          </div>
      	</div>      	
	</div>
	<div class="col-lg-2 text-left">
       	<button class="btn btn-primary" onclick="SendPregunta()">Enviar</button>
    </div>
</div>


<div class="col-lg-10 col-lg-offset-1 col-md-10 col-sm-12">    
    <div class="panel-group" id="accordion">                
       <!-- <div class="faqHeader">Tema </div>        -->
       
       
       
       
		<?php 
		foreach($misPreguntas as $pregunta)
		{
		?>
        <div class="panel panel-default">
            <div class="panel-headings <?php if(!empty($pregunta["ID__RESPUESTA"])){  ?>respondida<?php } else {?> pendiente<?php } ?>">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$pregunta["ID__MENSAJE"]?>">
						<label><?=$pregunta["pregunta"];?></label>
                    </a>
                </h4>
            </div>
            <div id="collapse<?=$pregunta["ID__MENSAJE"]?>" class="panel-collapse collapse">
                <div class="panel-body text-center">
                    <?php
                    if(!empty($pregunta["ID__RESPUESTA"]))
                    {
						echo $pregunta["respuesta"]."<br><b>".($pregunta['fecha_contestada'])."</b>";
					}
					else
					{
						
						echo  "Parece que todavia no hay respuesta... intenta denuevo mas tarde.<br><b>".(date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']))."</b>"; 
					}
                    ?>
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
	function SendPregunta()
	{
		$.ajax({
			  url: "SendPregunta",
			  type: 'POST',
			  data:{					
					Pregunta			:$("#Pregunta").val(),
				  }						  
			}).done(function(val) 
			{			
				console.log(val);						
				bootbox.alert("Pregunta enviada Correctamente", function()
				{				
					document.location.reload();
				});	
			});			
	}

</script>

