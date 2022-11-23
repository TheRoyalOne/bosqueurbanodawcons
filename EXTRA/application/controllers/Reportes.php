<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('reportes/reporte_model');		
		$this->load->helper('url_helper');
		
		
		 if ( ! $this->session->userdata('logged_in'))
		 { 			
			redirect('inicio/login');			
		}
	}
	public function TienePermiso($ID__PERMISO)
	{
		if(in_array($ID__PERMISO,$this->session->userdata('PERMISOS')))
		{
			return true;
		}		
		return false;
	}	
	
	 	 
	public function ReporteAdopcion()
	{		
		$VCH_NOMBRECOMUN	=$this->input->post("VCH_NOMBRECOMUN");				
		$VCH_ESTATUS		=$this->input->post("VCH_ESTATUS");

		$estados=$this->reporte_model->get_estadosLiberado();
		$eventos = $this->reporte_model->get_selectEventos();
		$empresas = $this->reporte_model->get_selectEmpresas();
		
		$datos=array('titulo'=>'Reporte de adopcion','eventos'=>$eventos,'empresas'=>$empresas,'menu'=>'Reportes','estados'=>$estados);
		$this->session->set_userdata("SUBMENU",20);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('reportes/ReporteAdopcion/ReporteAdopcion')
		           ->view('fin_archivo');
	} 	 
	public function ReporteSupervivencia()
	{
		$VCH_NOMBRECOMUN	=$this->input->post("VCH_NOMBRECOMUN");				
		$VCH_ESTATUS		=$this->input->post("VCH_ESTATUS");

		$eventos = $this->reporte_model->get_selectEventos();
		$empresas = $this->reporte_model->get_selectEmpresas();
		$especies = $this->reporte_model->get_selectEspecies();
		
		$datos=array('titulo'=>'Reporte de Supervivencia','eventos'=>$eventos,'empresas'=>$empresas,'especies'=>$especies,'menu'=>'Reportes');
		$this->session->set_userdata("SUBMENU",21);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('reportes/ReporteSupervivencia/ReporteSupervivencia')
		           ->view('fin_archivo');
	} 	 
	public function ReporteReforestacion()
	{
		$VCH_NOMBRECOMUN	=$this->input->post("VCH_NOMBRECOMUN");				
		$VCH_ESTATUS		=$this->input->post("VCH_ESTATUS");

		$eventos = $this->reporte_model->get_selectEventos();
		$empresas = $this->reporte_model->get_selectEmpresas();
		
		$datos=array('titulo'=>'Reporte de Reforestacion','eventos'=>$eventos,'empresas'=>$empresas,'menu'=>'Reportes');
		$this->session->set_userdata("SUBMENU",22);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('reportes/ReporteReforestacion/ReporteReforestacion')
		           ->view('fin_archivo');
	} 	 
	public function ReporteAdopcionCiudadana()
	{
		$VCH_NOMBRECOMUN	=$this->input->post("VCH_NOMBRECOMUN");				
		$VCH_ESTATUS		=$this->input->post("VCH_ESTATUS");
		$estados=$this->reporte_model->get_estadosLiberado();

		$eventos = $this->reporte_model->get_selectEventos();
		$empresas = $this->reporte_model->get_selectEmpresas();
		$especies= $this->reporte_model->get_selectEspecies();
		
		$datos=array('titulo'=>'Reporte de adopcion Ciudadana','eventos'=>$eventos,'empresas'=>$empresas,'especies'=>$especies,'menu'=>'Reportes','estados'=>$estados);
		$this->session->set_userdata("SUBMENU",24);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('reportes/ReporteAdopcionCiudadana/ReporteAdopcionCiudadana')
		           ->view('fin_archivo');
	} 	 
	
	public function ReporteSupervivenciaReforestacion()
	{
		$eventos = $this->reporte_model->get_selectEventos();
		$empresas = $this->reporte_model->get_selectEmpresas();
		$especies= $this->reporte_model->get_selectEspecies();
		
		$datos=array('titulo'=>'Reporte de adopcion Ciudadana','eventos'=>$eventos,'empresas'=>$empresas,'especies'=>$especies,'menu'=>'Reportes');
		$this->session->set_userdata("SUBMENU",23);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('reportes/ReporteSupervivenciaReforestacion/ReporteSupervivenciaReforestacion')
		           ->view('fin_archivo');
	} 	 

	public function fechizador($data)
	{
		$data=explode("/",$data);
		if(count($data)==3)
		{
			$formated=$data[2]."-".$data[1]."-".$data[0];
		}
		else
		{
			return "2000-01-01";
		}				
		return $formated;
	}
	public function GenerarReporteAdopcion()
	{
		//$this->load->helper('pdf_helper');
		$fechaInicio=$this->fechizador($this->input->post("fechaInicio"));			
		$fechafin=$this->fechizador($this->input->post("fechafin"));			
		$ID__EVENTO=$this->input->post("ID__EVENTO");						
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");			
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			
		
		$ID__ESTADO=$this->input->post("ID__ESTADO");						
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");				
		$GEO=null;
		if($ID__MUNICIPIO!=-1)
		{
			$GEO=$this->reporte_model->getGeocerca($ID__MUNICIPIO,1);
		}
		else
		{
			if($ID__ESTADO!=-1)
			{
				$GEO=$this->reporte_model->getGeocerca($ID__ESTADO,0);
			}
		}		
		$dataEventos = $this->reporte_model->getAllInfoEventos($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$VCH_ESTATUS);

		//echo "<pre>";		die(print_r($dataEventos));
		
		//$JSONARCHIVO=$this->reporte_model->generaReporteAdopcion( $fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$VCH_ESTATUS  );					
		
  		//$CARGADORES=$this->bosqueurbano_model->obtener_personas_cargan_unEvento($id);  		  		
  		//$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignadosParaFormato($id);		
		//$data=array('data'=>$eventos[0],'solicitante'=>$solicitante,'cargadores'=>$CARGADORES,'relarbolasignados'=>$relarbolasignados);	
		$data=array('del'=>$fechaInicio,'al'=>$fechafin,'dataeventos'=>$dataEventos,'GEO'=>$GEO);
		//$this->load->view('reportes/ReporteAdopcion/pdf', $data);
		$this->load->view('reportes/ReporteAdopcion/plantilla', $data);
		

	
	}
	public function GenerarReporteAdopcionB()
	{
		$fechaInicio=$this->fechizador($this->input->post("fechaInicio"));			
		$fechafin=$this->fechizador($this->input->post("fechafin"));			
		$ID__EVENTO=$this->input->post("ID__EVENTO");						
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");			
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");					
		$ID__ESTADO=$this->input->post("ID__ESTADO");						
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");				
		$GEO=null;
		if($ID__MUNICIPIO!=-1)
		{
			$GEO=$this->reporte_model->getGeocerca($ID__MUNICIPIO,1);
		}
		else
		{
			if($ID__ESTADO!=-1)
			{
				$GEO=$this->reporte_model->getGeocerca($ID__ESTADO,0);
			}
		}		
		$dataEventos = $this->reporte_model->getAllInfoEventosB($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$VCH_ESTATUS);

		$data=array('del'=>$fechaInicio,'al'=>$fechafin,'dataeventos'=>$dataEventos,'GEO'=>$GEO);
		$this->load->view('reportes/ReporteAdopcion/plantillaB', $data);		
	}
	public function GenerarReporteSupervivencia()
	{
		//$this->load->helper('pdf_helper');
		$fechaInicio=$this->fechizador($this->input->post("fechaInicio"));			
		$fechafin=$this->fechizador($this->input->post("fechafin"));	
		$ID__EVENTO=$this->input->post("ID__EVENTO");						
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");			//patrocinador
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			//vivo sano vivo enfermo muerto
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");			//vivo sano vivo enfermo muerto		
		$mostrarFotos=$this->input->post("bool_fotos");			//bool de mostrar foto
		$mostrarListado=$this->input->post("bool_Listado");			//bool de mostrar foto
		
//die($mostrarListado."?");
//die($mostrarFotos."?");
		$dataEventos = $this->reporte_model->getAllInfoSupervivencia($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$VCH_ESTATUS,$ID__ESPECIE,$mostrarFotos,$mostrarListado);		
		$data=array('del'=>$fechaInicio,'al'=>$fechafin,'dataeventos'=>$dataEventos);

		$this->load->view('reportes/ReporteSupervivencia/plantilla', $data);			
	}
	public function GenerarReporteReforestacion()
	{
		//$this->load->helper('pdf_helper');
		$fechaInicio=$this->fechizador($this->input->post("fechaInicio"));			
		$fechafin=$this->fechizador($this->input->post("fechafin"));			
		$ID__EVENTO=$this->input->post("ID__EVENTO");						
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");			
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");							
		//$this->load->view('reportes/ReporteAdopcion/pdf', $data);
		$dataEventos = $this->reporte_model->getAllInfoReforesta($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$VCH_ESTATUS);
		
		$data=array('del'=>$fechaInicio,'al'=>$fechafin,'dataeventos'=>$dataEventos);
		$this->load->view('reportes/ReporteReforestacion/plantilla', $data);			
	}
	 	 
	public function GenerarReporteAdopcionCiudadana()
	{

		//$this->load->helper('pdf_helper');
		$fechaInicio=$this->fechizador($this->input->post("fechaInicio"));
		// die($fechaInicio."?");			
		$fechafin=$this->fechizador($this->input->post("fechafin"));	
		$ID__EVENTO=$this->input->post("ID__EVENTO");						
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");			
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");					
		$listado=$this->input->post("listado");							
		$ID__ESTADO=$this->input->post("ID__ESTADO");						
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");				
		$GEO=null;
		if($ID__MUNICIPIO!=-1)
		{
			$GEO=$this->reporte_model->getGeocerca($ID__MUNICIPIO,1);
		}
		else
		{
			if($ID__ESTADO!=-1)
			{
				$GEO=$this->reporte_model->getGeocerca($ID__ESTADO,0);
			}
		}		
		
		
		$dataEventos = $this->reporte_model->getAllInfoAdopciudadana($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$ID__ESPECIE,$listado);
		// die($dataEventos);
		print_r(array_values($dataEventos));
		$data=array('del'=>$fechaInicio,'al'=>$fechafin,'dataeventos'=>$dataEventos,'GEO'=>$GEO);
		$this->load->view('reportes/ReporteAdopcionCiudadana/plantilla', $data);			
	}
	 	 
	 	 
	public function GenerarReporteSupervivenciaReforestacion()
	{
		$fechaInicio=$this->fechizador($this->input->post("fechaInicio"));			
		$fechafin=$this->fechizador($this->input->post("fechafin"));	
		$ID__EVENTO=$this->input->post("ID__EVENTO");								
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");					
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");	

		$mostrarFotos=$this->input->post("bool_fotos");			//bool de mostrar foto
		$mostrarListado=$this->input->post("bool_Listado");			//bool de mostrar foto
					
		
		$dataEventos = $this->reporte_model->getAllInfoSupervivenciaReforestal($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$ID__ESPECIE,$mostrarFotos,$mostrarListado);		
		$data=array('del'=>$fechaInicio,'al'=>$fechafin,'dataeventos'=>$dataEventos);
		$this->load->view('reportes/ReporteSupervivenciaReforestacion/plantilla', $data);	
	}
	// -------------------------------------NUEVO -------------------------------------- 
	public function getCiudadesLiberadas()
	{
		$ID__ESTADO=$this->input->post("ID__ESTADO");				
		echo JSON_ENCODE($this->reporte_model->get_ciudadesLiberadas($ID__ESTADO));	
	}


	 	 
	public function ReporteTaller()
	{		
		$VCH_NOMBRECOMUN	=$this->input->post("VCH_NOMBRECOMUN");				
		$VCH_ESTATUS		=$this->input->post("VCH_ESTATUS");
		$empresas = $this->reporte_model->get_selectEmpresas();		
		$tipostaller = $this->reporte_model->get_selectTipoTaller();		
		$datos=array('titulo'=>'Reporte de taller','empresas'=>$empresas,'menu'=>'Reportes','tipostaller'=>$tipostaller);
		$this->session->set_userdata("SUBMENU",27);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('reportes/ReporteTaller/ReporteAdopcion')
		           ->view('fin_archivo');
	} 	  	 	 	 
	public function GenerarReporteTALLER()
	{
		$fechaInicio=$this->fechizador($this->input->post("fechaInicio"));			
		$fechafin=$this->fechizador($this->input->post("fechafin"));							
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$ID__TALLER=$this->input->post("ID__TALLER");	
		$dataEventos = $this->reporte_model->getAllInfoTaller($fechaInicio,$fechafin,$ID__EMPRESA,$ID__TALLER);
		$data=array('del'=>$fechaInicio,'al'=>$fechafin,'dataeventos'=>$dataEventos);
		$this->load->view('reportes/ReporteTaller/plantilla', $data);			
	}
	 	 	 	 
}
