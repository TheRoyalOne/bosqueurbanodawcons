<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inicio extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();						
		$this->load->model('inicio_model');			
		$this->load->helper('url_helper');		
		$this->load->library('session');
	}
	 
	public function index()
	{				
		$empresas = $this->inicio_model->get_empresas();	
		$especies = $this->inicio_model->get_especies();	
		$datos=array('titulo'=>'Login','especies'=>$especies,'empresas'=>$empresas);
		$this->load->view('inicio_archivo',$datos)
		           ->view('inicio/login')
		           ->view('fin_archivo');
	}

	
	public function login()	
	{
		$IMPORT=$this->input->post();																	
		$this->inicio_model->CREAR_SERIE($IMPORT);												
	}		
}
