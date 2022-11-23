<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Preguntas extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();		
		//$this->load->model('taller/taller_model');		
		$this->load->model('preguntas/preguntas_model');		
		$this->load->helper('url_helper');			
		if ( ! $this->session->userdata('logged_in'))
		{ 			
			redirect('inicio/login');			
		}
	}			
	public function FAQ()
	{			
		$datos=array('titulo'=>'FAQS');
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Preguntas/FAQ/index')
		           ->view('fin_archivo');
	}
	public function MisPreguntas()
	{	
		$misPreguntas=$this->preguntas_model->get_misPreguntas();		
		$datos=array('titulo'=>'Mis preguntas','misPreguntas'=>$misPreguntas);		
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Preguntas/MisPreguntas/index')
		           ->view('fin_archivo');
	}
	public function SendPregunta()
	{
		$pregunta=$this->input->post('Pregunta');
		$misPreguntas=$this->preguntas_model->SendPregunta($pregunta);		
	}
}
