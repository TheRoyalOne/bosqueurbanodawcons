<style>
	.paddtop
	{
		padding-top:13px !important;
	}
</style>

<div class="container">    

    <div class="panel-group" id="accordion">
       
        
                 <!--                                      
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Quien puede tomar un taller?</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    Los talleres estan orientados a los guardabosques urbanos
                </div>
            </div>
        </div>-->
        <?php
        foreach($faqs as $faq)
        {
		?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$faq["id_faq"]?>"><?=$faq["VCH_PREGUNTA"]?></a>
                </h4>
            </div>
            <div id="collapse<?=$faq["id_faq"]?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php
						ECHO $faq["VCH_RESPUESTA"];
						if(!empty($faq["VCH_FILE"]))
						{?>
							<a href="<?=$faq["VCH_FILE"]?>" target="__BLANK"><?=$faq["VCH_TEXTODELFILE"]?></a>
					<?php
						}
					?>                    
					
                </div>                
            </div>
        </div>        
        <?php
		}?>
    </div>
</div>

<style>
    .faqHeader {
        font-size: 27px;
        margin: 20px;
    }

    .panel-heading [data-toggle="collapse"]:after {
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

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
</style>

<script type="text/javascript" src="<?=base_url()?>js/Taller/ListaTaller.js"></script>
