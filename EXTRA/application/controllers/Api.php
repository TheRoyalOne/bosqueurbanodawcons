<?php

//defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {


	public function __construct()
	{
		parent::__construct();		
		$this->load->model('bosqueurbano/api_model');		
		$this->load->helper('url_helper');				 

	}		
	public function conectado()
	{
		echo "alcanzable";
	}
	public function finalizarEvento() //endpoint offline
	{				
		
		$JSON=$this->input->post();	$JSON= $JSON["JSON"];				
		$JSON=json_decode(json_encode(json_decode($JSON)), true);		
//		die(print_r($JSON));
		$this->api_model->FinalizarEvento($JSON);		
	}	
}
