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
		$datos=array('titulo'=>'Login');

		$this->load->view('inicio_archivo',$datos)
		           ->view('inicio/login')
		           ->view('fin_archivo');
	}

	public function home()
	{
		 if ( ! $this->session->userdata('logged_in'))
		 { 			
			redirect('inicio/login');			
		}
		$eventos = $this->inicio_model->get_eventos();	
		$arboles = $this->inicio_model->get_estadosarbol();	
		$arbolesSalud = $this->inicio_model->get_saludsarbol();	
		$totaladop = $this->inicio_model->get_totalAdop();	
		$totalarb = $this->inicio_model->get_totalarb();	
		$totalarb = $this->inicio_model->get_totalarb();	
		$totalarbAdop = $this->inicio_model->get_totalarbAdop();	
		
		$estadoarboles=array('vivos'=>0,'muertos'=>0,'desconocidos'=>0);		
		foreach($arboles as $arbol)
		{
			switch($arbol["VCH_ESTADO"])
			{
				case "V"://vivo
				{
					$estadoarboles['vivos']+=$arbol["cantidad"];
					break;
				}
				case "M"://muerto
				{
					$estadoarboles['muertos']+=$arbol["cantidad"];
					break;
				}
				default:	//desconocido del 2 al 6
				{					
					$estadoarboles['desconocidos']+=$arbol["cantidad"];
					break;
				}
			}					
		}		

		$arbolesSaludlista=array('sanos'=>0,'enfermos'=>0,'desconocidos'=>0);		
		foreach($arbolesSalud as $arbol)
		{
			switch($arbol["VCH_SALUD"])
			{
				case "S"://sano
				{
					$arbolesSaludlista['sanos']+=$arbol["cantidad"];
					break;
				}
				case "E"://enfermo
				{
					$arbolesSaludlista['enfermos']+=$arbol["cantidad"];
					break;
				}
				default:	//desconocido del 2 al 6
				{					
					$arbolesSaludlista['desconocidos']+=$arbol["cantidad"];
					break;
				}
			}					
		}		

		$datos=array('titulo'=>'Página principal','eventos'=>$eventos,'arboles'=>$estadoarboles,'graph'=>true,'salud'=>$arbolesSaludlista,'totaladop'=>$totaladop,'totalarb'=>$totalarb,'totalarbAdop'=>$totalarbAdop,'menu'=>false);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('inicio/home')
		           ->view('fin_archivo');
	}
	
	public function login()	
	{
		$user=$this->input->post("user");		
		$pass=$this->input->post("pass");		
		$rowsession=$this->inicio_model->login($user,$pass);								
		if(count($rowsession)>0)
		{
			$rowsession=$rowsession[0];
		}		
		if(isset($rowsession["ID__USUARIO"]))
		{
			$this->session->set_userdata('logged_in', $rowsession);
			$PERMISOS=$this->inicio_model->get_permisos($rowsession["ID__PERFIL"]);											
			
			$PERMISOS=array_column($PERMISOS, 'ID__PERMISO');
			
			$this->session->set_userdata('PERMISOS', $PERMISOS);
			
			redirect('/inicio/home', 'refresh');									
		}
		else
		{
			$datos=array('titulo'=>'Login');
			$this->load->view('inicio_archivo',$datos)
		           ->view('inicio/login')
		           ->view('fin_archivo');
		}	
						
		
	}
	public function logout()	
	{		
		$sess_array = array(
		'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		
		$datos=array('titulo'=>'Login');
		$this->load->view('inicio_archivo',$datos)
			   ->view('inicio/login')
			   ->view('fin_archivo');
		
						
		
	}
}
