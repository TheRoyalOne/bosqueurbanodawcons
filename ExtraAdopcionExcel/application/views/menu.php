
<!-- Esta etiqueta se cierra en cada vista de contenido -->
<div id="wrapper">
<?php
	//echo "<pre>";
	
	//$this->session->userdata["logged_in"]["VCH_CORREO"]
	//die(print_r($this->session->userdata["logged_in"]));
	
?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="heigth:300px !important; width:100%;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img src="<?=base_url().'Imagenes/bosque-urbano-logo.png'?>" style="heigth:180px; width:180px; padding-left:20px; padding:botton:20px;"/>
            
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
          
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->userdata["logged_in"]["VCH_NOMBRE"]?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?=base_url().'index.php/Inicio/logout'?>"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuRegistrp"><i class="fa fa-sliders"></i> Reportar Arbol <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuRegistrp" class="collapse">
                    <li>
                        <a href="<?=base_url().'index.php/Arboles/MisGuardabosques'?>"><i class="fa fa-dot-circle-o"></i>Mis Guardabosques Asignados</a>
                    </li>                   
                </ul>
            </li>                                                                             
            <!--<li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuTallers"><i class="fa fa-sliders"></i> Contacto <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuTallers" class="collapse">
                     <li>
                        <a href="<?=base_url().'index.php/Preguntas/MisPreguntas'?>"><i class="fa fa-dot-circle-o"></i> Responder Preguntas</a>
                    </li>                    

                </ul>
            </li>                                        -->
            <li style="padding-top:10px">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="FCQFS3ES4JNSS">
					<input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
					<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
					</form>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
    <!--<div id="page-wrapper">

        <div class="container-fluid">
        </div>
    </div>-->
<!--</div>-->
