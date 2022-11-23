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
		$eventos = $this->inicio_model->get_eventos();	
		$arboles = $this->inicio_model->get_estadosarbol();	
		$estadoarboles=array('vivos'=>0,'muertos'=>0,'desconocidos'=>0);		
		foreach($arboles as $arbol)
		{
			switch($arbol["VCH_eSTATUS"])
			{
				case 0://vivo
				{
					$estadoarboles['vivos']+=$arbol["cuantos"];
					break;
				}
				case -1://muerto
				{
					$estadoarboles['muertos']+=$arbol["cuantos"];
					break;
				}
				default:	//desconocido del 2 al 6
				{					
					$estadoarboles['desconocidos']+=$arbol["cuantos"];
					break;
				}
			}					
		}		
		//$estadisticas = $this->inicio_model->get_estadisticas();	
		//$estadoarbol = $this->inicio_model->get_estadisticas();	
		$datos=array('titulo'=>'Página principal','eventos'=>$eventos,'arboles'=>$estadoarboles,'graph'=>true);
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
		if(isset($rowsession["ID__EMBAJADOR"]))
		{
			$this->session->set_userdata('logged_in', $rowsession);

			redirect('/Arboles/MisGuardabosques', 'refresh');			
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
