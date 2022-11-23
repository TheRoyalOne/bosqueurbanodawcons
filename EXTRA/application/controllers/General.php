<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller 
{	

	public function __construct()
	{
		parent::__construct();		
		$this->load->model('general_model');		
		$this->load->helper('url_helper');
		
		
		 if ( ! $this->session->userdata('logged_in'))
		 { 			
			redirect('inicio/login');			
		}
	}	
	public function getColonias()
	{
		$ID__ESTADO=null;
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");
		$VCH_NOMBRE=null;
		$VCH_CODIGOPOSTAL=null;				
		echo JSON_ENCODE($this->general_model->get_colonias($ID__ESTADO,$ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL));	
	}	
	public function getCiudades()
	{
		$ID__ESTADO=$this->input->post("ID__ESTADO");				
		echo JSON_ENCODE($this->general_model->get_ciudades($ID__ESTADO));	
	}
	public function altaColonia()
	{
		$ID__MUNICIPIO	=$this->input->post("ID__MUNICIPIO");				
		$VCH_NOMBRE		=$this->input->post("VCH_NOMBRE");						
		$VCH_CODIGOPOSTAL=$this->input->post("VCH_CODIGOPOSTAL");						
		echo JSON_ENCODE($this->general_model->alta_colonia($ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL));	
	}
	public function buscadorColonias()
	{
		$ID__ESTADO=$this->input->post("ID__ESTADO");						
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");						
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");						
		$VCH_CODIGOPOSTAL=$this->input->post("VCH_CODIGOPOSTAL");					
		$estados = $this->general_model->get_estados();			
		$colonias = $this->general_model->get_colonias($ID__ESTADO,$ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL);		
		
		//echo "<pre>";		die(print_r(get_defined_vars()));
		/*$datos=array();
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('administrativo/perfiles')
		           ->view('fin_archivo');*/
				
		$this->load->view('inicio_archivo')->view('general/buscadorColonias',array('colonias'=>$colonias,'estados'=>$estados))->view('fin_archivo');				
	}	
	public function alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE)
	{								
			$sql='INSERT INTO catconf_008_domicilios(ID__COLONIA,VCH_CALLE,VCH_ENTRECALLE)VALUES(?,?,?)';
			$this->db->query($sql,array($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE));	
			return $this->db->insert_id();
	}	
}
