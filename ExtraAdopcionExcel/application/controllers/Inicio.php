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
			$this->load->library('excel');			
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES["archivo"]["tmp_name"]);
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			$valido=0;	//Para verificar que los headers del archivo sean los del formato esperado...
			foreach ($cell_collection as $cell) 
			{
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
				switch($column)
				{
					case "A":
					{
						$column="NOMBRE";
						BREAK;
					}
					case "B":
					{
						$column="APELLIDO_x0020_PATERNO";
						BREAK;
					}
					case "C":
					{
						$column="APELLIDO_x0020_MATERNO";						
						BREAK;
					}
					case "D":
					{
						$column="TELEFONO";	
						BREAK;
					}
					case "E":
					{
						$column="CELULAR";	
						BREAK;
					}
					case "F":
					{
						$column="CORREO";	
						BREAK;
					}
					case "G":
					{
						$column="C.P.";							
						BREAK;
					}
					case "H":
					{
						$column="COLONIA";		
						BREAK;
					}
					case "I":
					{
						$column="CALLE";		
						BREAK;
					}
					case "J":
					{
						$column="ENTRE_x0020_CALLES";		
						BREAK;
					}
					case "K":
					{
						$column="CODIGO_x0020_QR";								
						BREAK;
					}
					case "L":
					{
						$column="ESPECIE";		
						BREAK;
					}
					case "M":
					{
						$column="FECHA_x0020_ADOPCION";		
						BREAK;
					}
				}
				
				
				$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
				$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();																							
				if ($row == 1) 
				{
					$header[$row][$column] = $data_value;
				} else 
				{
					$arr_data[$row][$column] = $data_value;
				}																
			}		
			$header=$header[1];			
			if(isset($header["FECHA_x0020_ADOPCION"]))
			{
				if($header["NOMBRE"]=="NOMBRE"){$valido++;}
				if($header["APELLIDO_x0020_PATERNO"]=="APELLIDO_x0020_PATERNO"){$valido++;}					
				if($header["APELLIDO_x0020_MATERNO"]=="APELLIDO_x0020_MATERNO"){$valido++;}
				if($header["TELEFONO"]=="TELEFONO"){$valido++;}					
				if($header["CELULAR"]=="CELULAR"){$valido++;}
				if($header["CORREO"]=="CORREO"){$valido++;}					
				if($header["C.P."]=="C.P."){$valido++;}
				if($header["COLONIA"]=="COLONIA"){$valido++;}
				if($header["CALLE"]=="CALLE"){$valido++;}
				if($header["ENTRE_x0020_CALLES"]=="ENTRE_x0020_CALLES"){$valido++;}
				if($header["CODIGO_x0020_QR"]=="CODIGO_x0020_QR"){$valido++;}
				if($header["ESPECIE"]=="ESPECIE"){$valido++;}
				if($header["FECHA_x0020_ADOPCION"]=="FECHA_x0020_ADOPCION"){$valido++;}
			}			
			
			$arr_data=array_values($arr_data);
			$array=$arr_data;			
			if($valido==13)//15 campos del importado y coincidencias			
			{
				$original=$array;			
				$evento=$this->input->post("evento");								
				$this->delete_col($array, 10);// REMUEVE LA ETIQUETA QR			
				$array = array_map("unserialize", array_unique(array_map("serialize", $array)));	// Remueve guardabosques duplicados
				$array = array_values($array);		//RESETEA LOS INDEX DEL ARRAY POR QUE...YOLO
				
				$arrayProcesado=array();
				$cont=0;
				
				foreach ($array as $guardabosque)	//Por cada guardabosque ve si existe y traete el ID, sino... inserta y traeme el ID
				{				
					$ID__GUARDABOSQUE=$this->inicio_model->get_guardabosqueDireccion($guardabosque);
					foreach ($original as $rowPlanta)// por cada planta (removiendola conforme la encuentres)
					{					
						if(($rowPlanta["NOMBRE"]==$guardabosque["NOMBRE"])&&($rowPlanta["APELLIDO_x0020_PATERNO"]==$guardabosque["APELLIDO_x0020_PATERNO"])&&($rowPlanta["APELLIDO_x0020_MATERNO"]==$guardabosque["APELLIDO_x0020_MATERNO"]))										
						{																
							$this->inicio_model->set_adopcion($rowPlanta,$guardabosque,$ID__GUARDABOSQUE,$evento);						
							$original = $this->removeElementWithValue($original, "CODIGO_x0020_QR", $rowPlanta["CODIGO_x0020_QR"]);	//Quitalo de los pendientes
						}
					}
				$cont++;	
				}
				die("Subido");		
				
			}						
			else
			{
				echo "Formato de archivo no compatible";
			}													
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
}
