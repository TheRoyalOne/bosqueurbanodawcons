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
	public function ReportarPropios()
	{									
		$MisArboles=$this->arbol_model->reportarPropios();
		$datos=array('titulo'=>'Reportar el estado de mis arboles','MisArboles'=>$MisArboles);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Arboles/ReportarPropios/index')
		           ->view('fin_archivo');
	}	
	public function ReporteEstadoAccion()
	{
		$IMPORT=$this->input->post();
		$ID__GUARDABOSQUE=$this->session->userdata["logged_in"]["ID__GUARDABOSQUE"];
		$this->arbol_model->set_ReporteEstadoArbol($IMPORT, $ID__GUARDABOSQUE,	null);
		redirect('/Arboles/ReportarPropios');
	}
	
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
	}	
}
