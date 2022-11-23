<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Arboles extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('arbol/arbol_model');		
		$this->load->helper('url_helper');			
		if ( ! $this->session->userdata('logged_in'))
		{ 			
			redirect('inicio/login');			
		}
	}		
	public function MisGuardabosques()
	{	
		// set_time_limit(0);
		// die();
		$MisGuardabosquesProcesados=$this->arbol_model->get_MisGuardabosquesProcesados();
		$MisGuardabosques=$this->arbol_model->get_MisGuardabosques();
		var_dump("holi");
		die();								
		$datos=array('titulo'=>'Seguimiento a mis guardabosques','MisGuardabosques'=>$MisGuardabosques,'MisGuardabosquesProcesados'=>$MisGuardabosquesProcesados);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Arboles/MisGuardaBosques/index')
		           ->view('fin_archivo');
	}	
	
	public function GetArbolesParaSeguimiento()
	{
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");
		$susarboles=$this->arbol_model->susarboles($ID__GUARDABOSQUE);
		ECHO JSON_ENCODE($susarboles);
	}
	public function SetEquivocado()
	{
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");
		$this->arbol_model->SetEquivocado($ID__GUARDABOSQUE);		
	}
	public function GetDatosGuardabosque()
	{
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");
		$datosguarda=$this->arbol_model->GetDatosGuardabosque($ID__GUARDABOSQUE);
		ECHO JSON_ENCODE($datosguarda);
	}
	
	
	
	public function ReporteEstadoAccion()
	{
		$IMPORT=$this->input->post();
		$ID__EMBAJADOR=$this->session->userdata["logged_in"]["ID__EMBAJADOR"];
		$this->arbol_model->set_ReporteEstadoArbol($IMPORT, null,	$ID__EMBAJADOR);			
	}
	public function subirFotos()
	{
		//ID__SEGUIMIENTO
		//VCH_CODIGOQR
		//$ID__EMBAJADOR=$this->session->userdata["logged_in"]["ID__EMBAJADOR"];
		$IMPORT=$this->input->post();
		$this->arbol_model->subirPics($IMPORT);			
		redirect('Arboles/MisGuardabosques');	
	}
	
	
	
	/*
	public function ReportarAjenos()
	{															
		$datos=array('titulo'=>'Reportar el estado de arboles ajenos','MisArboles'=>array());
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Arboles/ReportarAjenos/index')
		           ->view('fin_archivo');
	}	
	public function Consultar()
	{									
		$du=$this->arbol_model->get_puntos();
		$datos=array('titulo'=>'Mis puntos ganados','du'=>$du);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		            ->view('Arboles/Consultar/index')
		           ->view('fin_archivo');
	}	
	public function BuscarQR()
	{
		$this->arbol_model->get_seguimientos_por_qr($this->input->post('BusquedaQr',TRUE));		
	}
	public function BuscarPuntosQR()
	{
		$this->arbol_model->get_puntos_por_qr($this->input->post('BusquedaQr',TRUE));		
	}
	
	public function EvaluarTaller()
	{			
		$IMPORT=$this->input->post();
		$this->taller_model->EvaluarTaller($IMPORT);
	}	*/
}
