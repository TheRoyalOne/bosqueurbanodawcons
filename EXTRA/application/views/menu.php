
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
            <a href="<?=base_url()?>index.php/inicio/home"> 
            <img src="<?=base_url().'Imagenes/bosque-urbano-logo.png'?>" style="heigth:180px; width:180px; padding-left:20px; padding:botton:20px;"/>
            </a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu message-dropdown">
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <span class="pull-left">
                                    <img class="media-object" src="http://placehold.it/50x50" alt="">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong><?=$this->session->userdata["logged_in"]["VCH_NOMBRE"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOPATERNO"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOMATERNO"]?></strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <span class="pull-left">
                                    <img class="media-object" src="http://placehold.it/50x50" alt="">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong>Juan Uriarte</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <span class="pull-left">
                                    <img class="media-object" src="http://placehold.it/50x50" alt="">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading"><strong><?=$this->session->userdata["logged_in"]["VCH_NOMBRE"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOPATERNO"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOMATERNO"]?></strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-footer">
                        <a href="#">Read All New Messages</a>
                    </li>
                </ul>
            </li>-->
            <!--
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                    </li>
                   <li>
                        <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul>
                
            </li>
            -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->userdata["logged_in"]["VCH_NOMBRE"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOPATERNO"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOMATERNO"]?> <b class="caret"></b></a>
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
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuAdministrativo"><i class="fa fa-sliders"></i> Configuración <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuAdministrativo" class="collapse <?php if($menu=="Configuración"){?>in<?php }?>">
                    
                    <?php 
                    if(in_array(1,$this->session->userdata('PERMISOS')))
					{?>
                    <li>
					<a href="<?=base_url().'index.php/administrativo/perfiles'?>" <?php if($this->session->userdata('SUBMENU') == 1){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Perfiles</a>
                    </li>
					<?php
					}
					if(in_array(2,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/administrativo/usuarios'?>" <?php if($this->session->userdata('SUBMENU') == 2){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Usuarios</a>
                    </li>
                    <?php
					}
					if(in_array(3,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/administrativo/especies'?>" <?php if($this->session->userdata('SUBMENU') == 3){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Especies</a>
                    </li>
                    <?php
					}
					/*
					if($this->session->userdata["logged_in"]["ID__USUARIO"]==282)
					{
						echo "<pre>";
						die(print_r($this->session->userdata('PERMISOS')));
					}*/
					
					if(in_array(4,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/embajadores'?>" <?php if($this->session->userdata('SUBMENU') == 4){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Embajadores</a>
                    </li>
                    <?php
					}
					if(in_array(5,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/EmpresaInstitucion'?>" <?php if($this->session->userdata('SUBMENU') == 5){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Patrocinadores</a>
                    </li>
                    <?php
					}
					if(in_array(6,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/EmbajadoresInstitucion'?>" <?php if($this->session->userdata('SUBMENU') == 6){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Instituciones Educativas</a>
                    </li>       
                    <?php
					}
					if(in_array(7,$this->session->userdata('PERMISOS')))
                    {
					?>
                     <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/TiposPatrocinios'?>" <?php if($this->session->userdata('SUBMENU') == 7){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Tipos de Patrocinio</a>
                    </li>
                    <?php
					}
					if(in_array(8,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/CatalogoUbicaciones'?>" <?php if($this->session->userdata('SUBMENU') == 8){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Catalogos de Ubicaciones</a>
                    </li>	
                    <?php
					}
					if(in_array(9,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/preciosEspeciales'?>" <?php if($this->session->userdata('SUBMENU') == 9){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Catalogos de Precios por Especies</a>
                    </li>
                    <?php
					}
					if(in_array(10,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/geocercas'?>" <?php if($this->session->userdata('SUBMENU') == 10){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Geocercas</a>
                    </li>
                    <?php
					}					
					?>
                </ul>
            </li>            
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuArbolado"><i class="fa fa-tree"></i> Arbolado <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuArbolado" class="collapse <?php if($menu=="Arbolado"){?>in<?php }?>">
				    <?php					
					if(in_array(11,$this->session->userdata('PERMISOS')))
                    {
					?>
				    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/inventarioglobal'?>"<?php if($this->session->userdata('SUBMENU') == 11){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Inventarios</a>
                    </li>                
                    <?php
					}
					?>
				</ul>
            </li>
                                    
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuTalleres"><i class="fa fa-graduation-cap "></i> Talleres <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuTalleres" class="collapse <?php if($menu=="Talleres"){?>in<?php }?>">
                 <?php					
					if(in_array(12,$this->session->userdata('PERMISOS')))
                    {
				?>
					<li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/CatalogoTalleres'?>"<?php if($this->session->userdata('SUBMENU') == 12){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Catalogos de Talleres</a>
                    </li>
                     <?php
					}
					if(in_array(13,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/taller'?>"<?php if($this->session->userdata('SUBMENU') == 13){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Registro de Talleres</a>
                    </li>   
                  <?php
					}					
					?>
				</ul>
            </li>
            
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuBosqueUrbano"><i class="fa fa-leaf"></i> Adopciones <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuBosqueUrbano" class="collapse <?php if($menu=="Adopciones"){?>in<?php }?>">                    
                   <?php					
					if(in_array(14,$this->session->userdata('PERMISOS')))
                    {
					?>                  
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/Guardabosques'?>"<?php if($this->session->userdata('SUBMENU') == 14){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Guardabosques Urbanos</a>
                    </li>                      
                     <?php
					}
					if(in_array(15,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/etiquetas'?>"<?php if($this->session->userdata('SUBMENU') == 15){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Administracion de etiquetas</a>
                    </li>      
                     <?php
					}
					?>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuEventos"><i class="fa fa-globe"></i> Eventos <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuEventos" class="collapse <?php if($menu=="Eventos"){?>in<?php }?>">
                 <?php
				if(in_array(20,$this->session->userdata('PERMISOS')))
				{?>
					<li>
						<a href="<?=base_url().'index.php/bosqueUrbano/CatalogoEventos?adop=1'?>"<?php if($this->session->userdata('SUBMENU') == 16){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Adopcion en Vivero</a>						
					</li>
				<?php
				}
				?>
                
                     <?php					
					if(in_array(16,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/CatalogoEventos'?>"<?php if($this->session->userdata('SUBMENU') == 16){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> De Adopcion</a>
                    </li>
                     <?php
					}
					if(in_array(21,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/CatalogoEventosREFORESTACION'?>"<?php if($this->session->userdata('SUBMENU') == 17){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> De Reforestacion</a>
                    </li>
                     <?php
					}
					if(in_array(24,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/AsignacionRecursosEvento'?>"<?php if($this->session->userdata('SUBMENU') == 18){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Asignacion de recursos a evento</a>
                    </li>
                     <?php
					}
					if(in_array(25,$this->session->userdata('PERMISOS'))||in_array(26,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/AsignacionArboladoEvento'?>"<?php if($this->session->userdata('SUBMENU') == 19){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Asignacion de arbolado a evento</a>
                    </li>
                     <?php
					}
					
					?>                    
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuReportes"><i class="fa fa-bar-chart"></i> Reportes <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuReportes" class="collapse <?php if($menu=="Reportes"){?>in<?php }?>">
                     <?php					
					if(in_array(27,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/reportes/ReporteAdopcion'?>"<?php if($this->session->userdata('SUBMENU') == 20){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Reporte de Adopcion</a>
                    </li>
                     <?php
					}
					if(in_array(28,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/reportes/ReporteSupervivencia'?>"<?php if($this->session->userdata('SUBMENU') == 21){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Reporte de Supervivencia</a>
                    </li>                    
                     <?php
					}
					if(in_array(29,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/reportes/ReporteReforestacion'?>"<?php if($this->session->userdata('SUBMENU') == 22){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Reporte de Eventos de Reforestacion</a>
                    </li>
                     <?php
					}
					if(in_array(30,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/reportes/ReporteSupervivenciaReforestacion'?>"<?php if($this->session->userdata('SUBMENU') == 23){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Reporte de Supervivencia de reforestacion</a>
                    </li>
                     <?php
					}
					if(in_array(31,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/reportes/ReporteAdopcionCiudadana'?>"<?php if($this->session->userdata('SUBMENU') == 24){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Reporte de Adopcion ciudadana</a>
                    </li>
                     <?php
					}

					if(in_array(32,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/MapaArboles'?>"<?php if($this->session->userdata('SUBMENU') == 25){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Mapa de Árboles</a>
                    </li>
                     <?php
					}
					?>
                    <li>
                        <a href="<?=base_url().'index.php/reportes/ReporteTaller'?>"<?php if($this->session->userdata('SUBMENU') == 27){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Reporte de talleres </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#subMenuContacto"><i class="fa fa-comments-o"></i> Contacto <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="subMenuContacto" class="collapse <?php if($menu=="Contacto"){?>in<?php }?>">                    
                     <?php					
					if(in_array(33,$this->session->userdata('PERMISOS')))
                    {
					?>
                    <li>
                        <a href="<?=base_url().'index.php/bosqueUrbano/Preguntas'?>"<?php if($this->session->userdata('SUBMENU') == 26){ ?> class="active" <?php } ?>><i class="fa fa-dot-circle-o"></i> Responder Preguntas</a>
                    </li>                                            
                     <?php
					}
					?>
                </ul>
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
