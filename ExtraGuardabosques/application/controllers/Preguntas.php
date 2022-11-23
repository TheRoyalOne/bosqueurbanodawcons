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
		$FAQS=$this->preguntas_model->get_FAQS();				
		$datos=array('titulo'=>'FAQS','faqs'=>$FAQS);
		
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Preguntas/FAQ/index')
		           ->view('fin_archivo');
	}
	public function MisPreguntas()
	{	
		$categoria=$this->preguntas_model->get_Categorias();		
		$misPreguntas=$this->preguntas_model->get_misPreguntas();		
//		$ID__CATEGORIA=$this->input->post('ID__CATEGORIA');
//		die("?".$ID__CATEGORIA);
		$datos=array('titulo'=>'Mis preguntas','misPreguntas'=>$misPreguntas,'categoria'=>$categoria);		
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('Preguntas/MisPreguntas/index')
		           ->view('fin_archivo');
	}
	public function SendPregunta()
	{
		$pregunta=$this->input->post('Pregunta');
		$ID__CATEGORIA=$this->input->post('ID__CATEGORIA');
		$misPreguntas=$this->preguntas_model->SendPregunta($pregunta,$ID__CATEGORIA);		
	}
	public function DESCARGA($filename)
	{				
		//die($filename);
		$this->load->helper(array('download', 'file', 'url', 'html', 'form'));						  
			$data = file_get_contents(getcwd()."/uploads/respuesta/".urldecode ($filename)); 										
		force_download($filename,$data); 
	}
	
}
