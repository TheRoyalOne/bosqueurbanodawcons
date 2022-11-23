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
		
		$eventos = $this->inicio_model->get_eventos();	
//		die(print_r($eventos));
		$datos=array('titulo'=>'Login','eventos'=>$eventos);
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
	
	
	function removeElementWithValue($array, $key, $value)
	{
		 foreach($array as $subKey => $subArray)
		 {
			  if($subArray[$key] == $value){
				   unset($array[$subKey]);
			  }
		 }
		 return $array;
	}
	function delete_col(&$array, $offset) 
	{
		return array_walk($array, function (&$v) use ($offset) 
		{
			array_splice($v, $offset, 1);
		});
	}
	public function login()	
	{
		
		
		if(!empty($_FILES["archivo"]["name"]))
		{
			$xml = file_get_contents($_FILES["archivo"]["tmp_name"]);  
			$xml = simplexml_load_string($xml);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);												
			if(empty($array["RDATA"]))
			{
				die("archivo invalido");
			}else
			{
				$array=$array["RDATA"];
			}
			$original=$array;			
			$evento=$this->input->post("evento");
			
			if($this->inicio_model->verificaSiYaExiste($evento))
			{
				die("Este evento ya fue subido antes!");
			}
			
//			echo"<pre>";die(print_r($original));
			
			
			
			$this->delete_col($array, 10);// REMUEVE LA ETIQUETA QR			
			$array = array_map("unserialize", array_unique(array_map("serialize", $array)));	// Remueve guardabosques duplicados
			$array = array_values($array);		//RESETEA LOS INDEX DEL ARRAY POR QUE...YOLO
			
			$arrayProcesado=array();
			$cont=0;
//			echo "<pre>";			die(print_r($array));
			foreach ($array as $guardabosque)	//Por cada guardabosque ve si existe y traete el ID, sino... inserta y traeme el ID
			{				
//				DIE(print_r(($array)));
				$ID__GUARDABOSQUE=$this->inicio_model->get_guardabosqueDireccion($guardabosque);
				foreach ($original as $rowPlanta)// por cada planta (removiendola conforme la encuentres)
				{					
					if(($rowPlanta["NOMBRE"]==$guardabosque["NOMBRE"])&&($rowPlanta["APELLIDO_x0020_PATERNO"]==$guardabosque["APELLIDO_x0020_PATERNO"])&&($rowPlanta["APELLIDO_x0020_MATERNO"]==$guardabosque["APELLIDO_x0020_MATERNO"]))										
					{																
						$this->inicio_model->set_adopcion($rowPlanta,$guardabosque,$ID__GUARDABOSQUE,$evento);						
						$original = $this->removeElementWithValue($original, "CODIGO_x0020_QR", $rowPlanta["CODIGO_x0020_QR"]);	//Quitalo de los pendientes
//						break;						
					}
				}
			$cont++;	
			}
			die("Subido");			
		}
		else
		{
			die("Archivo invalido");
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
	
	public function SeteoEtiquetas()	
	{		
		$this->inicio_model->setEtiquetas();
	}
}
