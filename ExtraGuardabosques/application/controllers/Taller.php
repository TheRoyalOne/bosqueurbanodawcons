<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taller extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('taller/taller_model');		
		$this->load->helper('url_helper');			
		if ( ! $this->session->userdata('logged_in'))
		{ 			
			redirect('inicio/login');			
		}
	}		
	public function EvaluarLista()
	{									
		//DIE(print_r($this->session->userdata()));
				
		$talleresTomados=$this->taller_model->get_talleres();
		$datos=array('titulo'=>'Talleres a evaluar','talleresTomados'=>$talleresTomados);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Taller/ListaTaller/index')
		           ->view('fin_archivo');
	}	
	public function Inscribirse()
	{												
		$talleresTomados=$this->taller_model->get_talleres_Completos();
		$encuestasDescuento=$this->taller_model->get_DescuentoPorEncuesta();
		$datos=array('titulo'=>'Inscribirse','talleresTomados'=>$talleresTomados,'encuestasDescuento'=>$encuestasDescuento);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Taller/Inscribirse/index')
		           ->view('fin_archivo');
	}	
	public function EvaluarTaller()
	{			
		$IMPORT=$this->input->post();
		$this->taller_model->EvaluarTaller($IMPORT);
	}
	public function EvaluarTallerAccion()
	{			
		/*$etiquetas= $this->bosqueurbano_model->get_etiquetas(null);
		$empresas= $this->bosqueurbano_model->get_Select_empresas();
		$especies = $this->bosqueurbano_model->get_selectEspecies();*/
		$datos=array('titulo'=>'Administracion de etiquetas','etiquetas'=>$etiquetas,'empresas'=>$empresas,'especies'=>$especies);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/Etiquetas/Etiquetas')
		           ->view('fin_archivo');
	}					
	public function InscribirseAction()
	{			
		$ID__CVETALLER=$this->input->post('ID__CVETALLER');
		$this->taller_model->InscribirseAction($ID__CVETALLER);
	}	
}
