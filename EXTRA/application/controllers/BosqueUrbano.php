<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BosqueUrbano extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('bosqueurbano/bosqueurbano_model');		
		$this->load->helper('url_helper');
				
		//$this->load->library('generics');
		
		 if ( ! $this->session->userdata('logged_in'))
		 { 			
			redirect('inicio/login');			
		}
	}	
	
	public function reporteFotos()
	{
		$cadena=$this->input->post("cadena");				
		$data=null;
		if(!empty($cadena))
		{
			$data=$this->bosqueurbano_model->get_reporteFotos($cadena);
		}				
		$datos=array('datos'=>$data);
		$this->load->view('bosque_urbano/reporteFotos/index',$datos);
	}

	public function getEspeciesJson()
	{
		ECHO JSON_ENCODE($this->bosqueurbano_model->get_especies());
	}

	public function getMuniJson()
	{
		ECHO JSON_ENCODE($this->bosqueurbano_model->get_muni());
	}
	public function getColoniasJson()
	{
		ECHO JSON_ENCODE($this->bosqueurbano_model->get_colo());
	}
	
	
	public function TienePermiso($ID__PERMISO)
	{
		if(in_array($ID__PERMISO,$this->session->userdata('PERMISOS')))
		{
			return true;
		}		
		return false;
	}
	
	
	/* embajadores abajo */
	public function embajadores()
	{
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");		
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");		
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");		
		$VCH_CORREO=$this->input->post("VCH_CORREO");		
		$VCH_NOMBRECOLONIA=$this->input->post("VCH_NOMBRECOLONIA");
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");
		$ID__INSTITUCION=$this->input->post("ID__INSTITUCION");
		$VCH_TIPO=$this->input->post("VCH_TIPO");
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");
		
		$maximos= $this->bosqueurbano_model->get_guardabosquesSinSeguimiento();					
		$tiposEmbajador= $this->bosqueurbano_model->get_tiposEmbajador();					
		$embajadores = $this->bosqueurbano_model->get_embajadores($VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$VCH_NOMBRECOLONIA,$VCH_ESTATUS,$ID__INSTITUCION,$VCH_TIPO);					
		$instituciones = $this->bosqueurbano_model->get_instituciones();					
		
		
		$this->load->model('general_model');
		$estados=$this->general_model->get_estados();
		$especies= $this->bosqueurbano_model->get_selectEspecies();
		$empresas= $this->bosqueurbano_model->get_Select_empresas();
		
		$datos=array('titulo'=>'Embajadores','embajadores'=>$embajadores,'instituciones'=>$instituciones,'maximos'=>$maximos,'tiposEmbajador'=>$tiposEmbajador,'estados'=>$estados,
		'especies'=>$especies,'empresas'=>$empresas
		,'menu'=>'Configuración');

		$this->session->set_userdata("SUBMENU",4);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/embajadores/embajadores')
		           ->view('fin_archivo');
	}
	public function eliminarEmbajador()
	{				
		$ID__EMBAJADOR=$this->input->post("ID__EMBAJADOR");		
		$this->bosqueurbano_model->delete_embajador($ID__EMBAJADOR);	
	}
	public function cargarEmbajador()
	{
		$ID__EMBAJADOR=$this->input->post("ID__EMBAJADOR");		
		echo JSON_ENCODE($this->bosqueurbano_model->cargar_embajador($ID__EMBAJADOR));			
	}
	public function altaEmbajador()
	{
		$ID__EMBAJADOR=$this->input->post("ID__EMBAJADOR");	
		$ID__INSTITUCION=$this->input->post("ID__INSTITUCION");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");	
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");		
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");	
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");	
		$VCH_TELEFONO=$this->input->post("VCH_TELEFONO");	
		$VCH_CELULAR=$this->input->post("VCH_CELULAR");		
		$VCH_CORREO=$this->input->post("VCH_CORREO");	
		$VCH_TIPO=$this->input->post("VCH_TIPO");	
		$VCH_NUMGAFETE=$this->input->post("VCH_NUMGAFETE");	
		$VCH_SEMESTRE=$this->input->post("VCH_SEMESTRE");		
		$VCH_CARRERA=$this->input->post("VCH_CARRERA");				
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");		
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");		
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");		
		$ID__COLONIA=$this->input->post("ID__COLONIA");				
		
		
		if(($ID__COLONIA!=0)&&($ID__COLONIA!=''))
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);		
		}
		else
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio("0","-","");		
		}
		
		
		$this->bosqueurbano_model->alta_embajador($ID__EMBAJADOR,$ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,
													$VCH_APELLIDOMATERNO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO,$VCH_TIPO,
													$VCH_NUMGAFETE,$VCH_SEMESTRE,$VCH_CARRERA,$FEC_FECHAINICIO,$FEC_FECHAFIN,
													$VCH_ESTATUS );			
		
		
	}
	public function editarEmbajador()
	{
		$ID__EMBAJADOR=$this->input->post("ID__EMBAJADOR");	
		$ID__INSTITUCION=$this->input->post("ID__INSTITUCION");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");	
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");		
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");	
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");	
		$VCH_TELEFONO=$this->input->post("VCH_TELEFONO");	
		$VCH_CELULAR=$this->input->post("VCH_CELULAR");		
		$VCH_CORREO=$this->input->post("VCH_CORREO");	
		$VCH_TIPO=$this->input->post("VCH_TIPO");	
		$VCH_NUMGAFETE=$this->input->post("VCH_NUMGAFETE");	
		$VCH_SEMESTRE=$this->input->post("VCH_SEMESTRE");		
		$VCH_CARRERA=$this->input->post("VCH_CARRERA");				
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");		
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");		
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");		
		$ID__COLONIA=$this->input->post("ID__COLONIA");				
				
				
				
		$this->bosqueurbano_model->edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);		
				
		$this->bosqueurbano_model->edita_embajador($ID__EMBAJADOR,$ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,
													$VCH_APELLIDOMATERNO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO,$VCH_TIPO,
													$VCH_NUMGAFETE,$VCH_SEMESTRE,$VCH_CARRERA,$FEC_FECHAINICIO,$FEC_FECHAFIN,
													$VCH_ESTATUS );							
	}
	public function importarEmbajadores()
	{		
		if(isset($_POST["ID__INSTITUCION_IMPORTAR"]))
		{			
			$filename=$_FILES["iptFotoEspecie"]["tmp_name"];						
			$this->load->library('excel');			
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES["iptFotoEspecie"]["tmp_name"]);
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			$valido=0;	//Para verificar que los headers del archivo sean los del formato esperado...
			foreach ($cell_collection as $cell) 
			{
				$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
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
			if(isset($header["O"]))
			{
				if($header["A"]=="nombre"){$valido++;}
				if($header["B"]=="apellido paterno"){$valido++;}					
				if($header["C"]=="apellido materno"){$valido++;}
				if($header["D"]=="telefono"){$valido++;}					
				if($header["E"]=="celular"){$valido++;}
				if($header["F"]=="correo"){$valido++;}					
				if($header["G"]=="tipo (practicante / técnico)"){$valido++;}
				if($header["H"]=="semestre"){$valido++;}
				if($header["I"]=="carrera"){$valido++;}
				if($header["J"]=="fecha inicio"){$valido++;}
				if($header["K"]=="fecha fin"){$valido++;}
				if($header["L"]=="codigo postal"){$valido++;}
				if($header["M"]=="colonia"){$valido++;}
				if($header["N"]=="calle"){$valido++;}
				if($header["O"]=="entre calle"){$valido++;}	
			}			
			if($valido==15)//15 campos del importado y coincidencias			
			{
				foreach($arr_data as $row)
				{					
					//$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);												
					$data = array(
									'ID__INSTITUCION' => $_POST["ID__INSTITUCION_IMPORTAR"],
									'VCH_NOMBRE' => $row["A"],
									'VCH_APELLIDOPATERNO' => $row["B"],									
									'VCH_APELLIDOMATERNO' => $row["C"],
									'VCH_TELEFONO' => $row["D"],
									'VCH_CELULAR' => $row["E"],
									'VCH_CORREO' => $row["F"],
									'VCH_TIPO' => $row["G"],
									'VCH_SEMESTRE' => $row["H"],
									'VCH_CARRERA' => $row["I"],
									'FEC_FECHAINICIO' => $row["J"],
									'FEC_FECHAFIN' => $row["K"],
									'VCH_ESTATUS' => 0									
								);					
					//$row["M"]					$row["N"]					$row["O"]
					$this->bosqueurbano_model->importacion($data);
				}
				echo("Se inserto correctamente");			
			}						
			else
			{
				echo "Formato de archivo no compatible";
			}
			
		}
        
	}
	/* embajadores arriba */







	/* Guardabosques abajo */
	public function Guardabosques()
	{
		$this->load->model('general_model');
		$estados=$this->general_model->get_estados();
		
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");	
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");	
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");			
		$VCH_CORREO=$this->input->post("VCH_CORREO");	
		
		$estado=$this->input->post("ID__ESTADO");	
		$ciudad=$this->input->post("ID__MUNICIPIO");	
		$colonia=$this->input->post("colonia");	
		$VCH_CODIGOPOSTAL=$this->input->post("VCH_CODIGOPOSTAL");	
		$VCH_CALLE=$this->input->post("VCH_CALLE");	
				
		$guardabosques = $this->bosqueurbano_model->get_guardabosques($VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$estado,$ciudad,$colonia,$VCH_CODIGOPOSTAL,$VCH_CALLE);							
		$datos=array('titulo'=>'Guardabosques','estados'=>$estados,'guardabosques'=>$guardabosques,'menu'=>'Adopciones');

		$this->session->set_userdata("SUBMENU",14);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/GuardaBosques/guardabosquesUrbanos')
		           ->view('fin_archivo');
	}
	public function cargarGuardabosque()
	{
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");		
		echo JSON_ENCODE($this->bosqueurbano_model->cargar_guardabosque($ID__GUARDABOSQUE));			
	}
	public function altaGuardabosque()
	{
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");			
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");		
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");	
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");		
		$VCH_TELEFONO=$this->input->post("VCH_TELEFONO");	
		$VCH_CELULAR=$this->input->post("VCH_CELULAR");		
		$VCH_CORREO=$this->input->post("VCH_CORREO");			
		$ID__COLONIA=$this->input->post("ID__COLONIA");											
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");		
		

		if($this->bosqueurbano_model->existe_guardabosques($ID__GUARDABOSQUE,$VCH_CORREO,0))
		{						
			
			$a["status"]="repetido";
			$a["mensaje"]="Ese Correo ya se encuentra registrado!";
			echo JSON_ENCODE($a);
			return;
		}
		
		
		if(($ID__COLONIA!=0)&&($ID__COLONIA!=''))
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);		
		}
		else		
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio(0,"-","");		
		}
		
		$this->bosqueurbano_model->alta_guardabosque($ID__GUARDABOSQUE,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO
													,$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO );							
	}
	public function editarGuardabosque()
	{
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");			
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");		
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");	
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");		
		$VCH_TELEFONO=$this->input->post("VCH_TELEFONO");	
		$VCH_CELULAR=$this->input->post("VCH_CELULAR");		
		$VCH_CORREO=$this->input->post("VCH_CORREO");			
		$ID__COLONIA=$this->input->post("ID__COLONIA");											
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");			
				
		if($this->bosqueurbano_model->existe_guardabosques($ID__GUARDABOSQUE,$VCH_CORREO,1))
		{			
			
			$a["status"]="repetido";
			$a["mensaje"]="Ese Correo ya se encuentra registrado!";
			echo JSON_ENCODE($a);
			return;
		}
				
		$this->bosqueurbano_model->edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);		
				
		$this->bosqueurbano_model->edita_guardabosque($ID__GUARDABOSQUE,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO
												  ,$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO );							
	}	
	public function eliminarGuardabosques()
	{				
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");		
		$this->bosqueurbano_model->delete_guardabosques($ID__GUARDABOSQUE);	
	}
	/* Guardabosques arriba*/








	/* empresas institucion abajo */
	public function EmpresaInstitucion()
	{
		//$this->load->model('general_model');
		//$estados=$this->general_model->get_estados();
		$estado = $this->session->flashdata('estado');
				
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");	
		$VCH_RFC=$this->input->post("VCH_RFC");	
		$VCH_GIROEMPRESA=$this->input->post("VCH_GIROEMPRESA");			
		$VCH_PERSONACONTACTO=$this->input->post("VCH_PERSONACONTACTO");	

		$patrocinios = $this->bosqueurbano_model->get_patrocinios();		
		$responsables = $this->bosqueurbano_model->get_responsables();														
		$empresas = $this->bosqueurbano_model->get_empresas($VCH_NOMBRE,$VCH_RFC,$VCH_GIROEMPRESA,$VCH_PERSONACONTACTO);									
		$datos=array('titulo'=>'Patrocinador','empresas'=>$empresas,'patrocinios'=>$patrocinios,'responsables'=>$responsables,'estado'=>$estado,'menu'=>'Configuración');

		$this->session->set_userdata("SUBMENU",5);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/EmpresasInstitucion/empresasInstitucion')
		           ->view('fin_archivo');
	}
	public function altaEmpresaInstitucion()
	{
		$VCH_NOMBREEMPRESA=$this->input->post("form_VCH_NOMBREEMPRESA");
		$VCH_RFC		 =$this->input->post("form_VCH_RFC");
		$VCH_PERSONACONTACTO=$this->input->post("form_VCH_PERSONACONTACTO");
		$VCH_PUESTOCONTACTO=$this->input->post("form_VCH_PUESTOCONTACTO");
		$VCH_CORREO=$this->input->post("form_VCH_CORREO");
		$VCH_TELEFONO=$this->input->post("form_VCH_TELEFONO");
		$VCH_GIROEMPRESA=$this->input->post("form_VCH_GIROEMPRESA");
		$VCH_CELULAR=$this->input->post("form_VCH_CELULAR");
		$NUM_EMPLEADOS=$this->input->post("form_NUM_EMPLEADOS");
		$VCH_COMENTARIOS=$this->input->post("form_VCH_COMENTARIOS");
		
		$ID__DOMICILIO=0;
		$ID__COLONIA=$this->input->post("ID__COLONIA");											
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");				
		if(($ID__COLONIA!=0)&&($ID__COLONIA!=''))
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);		
		}
		else
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio(0,"-","");		
		}
		
		
		$logo="";
		if(!empty($_FILES["iptFotoEspecie"]["name"]))
		{			
			$logo=$_FILES["iptFotoEspecie"]["name"];		
		}
		
		if(!empty($_FILES["iptFotoEspecie"]["name"]))
		{
			$config['upload_path']          = './uploads/empresas/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 10000;		
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('iptFotoEspecie'))
			{		
				$error = array('error' => $this->upload->display_errors());
				die(print_r($error));
				$this->load->view('upload_form', $error);
			}
			$filename=$_FILES["iptFotoEspecie"]["name"];
		}
		
		$empresa_id=$this->bosqueurbano_model->alta_EmpresaInstitucion($ID__DOMICILIO,$VCH_NOMBREEMPRESA,$VCH_RFC,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$VCH_GIROEMPRESA,$VCH_CELULAR,$NUM_EMPLEADOS,$VCH_COMENTARIOS,$logo);
		
		$empaquetadoP=json_decode($this->input->post("empaquetadoP"));
		$empaquetadoD=json_decode($this->input->post("empaquetadoD"));
		$empaquetadoS=json_decode($this->input->post("empaquetadoS"));
		
		
		
		foreach($empaquetadoP as $patrocinio)
		{						
			$this->bosqueurbano_model->alta_patrocinio($empresa_id,$patrocinio->ID__PATROCINIO,$patrocinio->NUM_CANTIDAD,$patrocinio->FEC_FECHAINICIO,$patrocinio->FEC_FECHAFIN,$patrocinio->VCH_DESCRIPCION,$patrocinio->VCH_TIPOPERIODO,$patrocinio->VCH_FORMAPAGO,$patrocinio->VCH_TIPOSEGUIMIENTO,$patrocinio->ID__USUARIO_RESPONSABLE);						
		}	
		foreach($empaquetadoD as $donacion)
		{			
			$this->bosqueurbano_model->alta_donacion($empresa_id,$donacion->VCH_DONACIONPERIODICA,$donacion->VCH_TIPOPERIODO,$donacion->VCH_FORMAPAGO,$donacion->NUM_TOTALDONACION,$donacion->FEC_FECHAINICIO,$donacion->FEC_FECHAFIN,$donacion->VCH_OTROTIPO);						
		}		
		foreach($empaquetadoS as $seguimiento)
		{			
			$this->bosqueurbano_model->alta_seguimiento($empresa_id,$seguimiento->ID__USUARIO,$seguimiento->VCH_ACUERDOS,$seguimiento->VCH_TIPO,$seguimiento->FEC_FECHA);						
		}
		$this->session->set_flashdata('estado', 'Se guardo exitosamente');
		redirect('/bosqueUrbano/EmpresaInstitucion');	
				
	}
	public function editarEmpresaInstitucion()
	{

		$VCH_NOMBREEMPRESA=$this->input->post("form_VCH_NOMBREEMPRESA");
		$VCH_RFC		 =$this->input->post("form_VCH_RFC");
		$VCH_PERSONACONTACTO=$this->input->post("form_VCH_PERSONACONTACTO");
		$VCH_PUESTOCONTACTO=$this->input->post("form_VCH_PUESTOCONTACTO");
		$VCH_CORREO=$this->input->post("form_VCH_CORREO");
		$VCH_TELEFONO=$this->input->post("form_VCH_TELEFONO");
		$VCH_GIROEMPRESA=$this->input->post("form_VCH_GIROEMPRESA");
		$VCH_CELULAR=$this->input->post("form_VCH_CELULAR");
		$NUM_EMPLEADOS=$this->input->post("form_NUM_EMPLEADOS");
		$VCH_COMENTARIOS=$this->input->post("form_VCH_COMENTARIOS");
		
		$empresa_id=$ID__EMPRESA=$this->input->post("ID__EMPRESA");
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");
		$ID__COLONIA=$this->input->post("ID__COLONIA");											
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");				
		$this->bosqueurbano_model->edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);				
		$logo="";								
		if(!empty($_FILES["iptFotoEspecie"]["name"]))
		{			
			$logo=$_FILES["iptFotoEspecie"]["name"];		
		}
		if(!empty($_FILES["iptFotoEspecie"]["name"]))
		{
			$config['upload_path']          = './uploads/empresas/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 10000;		
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('iptFotoEspecie'))
			{		
				$error = array('error' => $this->upload->display_errors());
				die(print_r($error));
				$this->load->view('upload_form', $error);
			}
			$filename=$_FILES["iptFotoEspecie"]["name"];
		}
		
		$this->bosqueurbano_model->edita_EmpresaInstitucion($empresa_id,$VCH_NOMBREEMPRESA,$VCH_RFC,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$VCH_GIROEMPRESA,$VCH_CELULAR,$NUM_EMPLEADOS,$VCH_COMENTARIOS,$logo);
		
		$empaquetadoP=json_decode($this->input->post("empaquetadoP"));
		$empaquetadoD=json_decode($this->input->post("empaquetadoD"));
		$empaquetadoS=json_decode($this->input->post("empaquetadoS"));
			
		$this->bosqueurbano_model->limpia_patrocinios($empresa_id);			
		foreach($empaquetadoP as $patrocinio)
		{
			//$this->bosqueurbano_model->alta_patrocinio($empresa_id,$patrocinio->ID__PATROCINIO,$patrocinio->NUM_CANTIDAD,$patrocinio->FEC_FECHAINICIO,$patrocinio->FEC_FECHAFIN,$patrocinio->VCH_DESCRIPCION);			
			$this->bosqueurbano_model->alta_patrocinio($empresa_id,$patrocinio->ID__PATROCINIO,$patrocinio->NUM_CANTIDAD,$patrocinio->FEC_FECHAINICIO,$patrocinio->FEC_FECHAFIN,$patrocinio->VCH_DESCRIPCION,$patrocinio->VCH_TIPOPERIODO,$patrocinio->VCH_FORMAPAGO,$patrocinio->VCH_TIPOSEGUIMIENTO,$patrocinio->ID__USUARIO_RESPONSABLE);						
		}	
		$this->bosqueurbano_model->limpia_donaciones($empresa_id);
		foreach($empaquetadoD as $donacion)
		{			
			$this->bosqueurbano_model->alta_donacion($empresa_id,$donacion->VCH_DONACIONPERIODICA,$donacion->VCH_TIPOPERIODO,$donacion->VCH_FORMAPAGO,$donacion->NUM_TOTALDONACION,$donacion->FEC_FECHAINICIO,$donacion->FEC_FECHAFIN,$donacion->VCH_OTROTIPO);						
		}		
		$this->bosqueurbano_model->limpia_seguimiento($empresa_id);
		foreach($empaquetadoS as $seguimiento)
		{			
			$this->bosqueurbano_model->alta_seguimiento($empresa_id,$seguimiento->ID__USUARIO,$seguimiento->VCH_ACUERDOS,$seguimiento->VCH_TIPO,$seguimiento->FEC_FECHA);						
		}
		$this->session->set_flashdata('estado', 'Se guardo exitosamente');
		redirect('/bosqueUrbano/EmpresaInstitucion');	
		
		/*
		echo "<pre>";		 
		die(print_r($empaquetadoP));
		die(print_r($empaquetadoD));		
		die(print_r($empaquetadoS));*/
		//die(print_r($this->input->post()));
	}
	public function cargarEmpresaInstitucion()
	{
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");
		
		$global['empresa']=$this->bosqueurbano_model->get_precargaEmpresa($ID__EMPRESA);	
		$global['empaquetadoP']=$this->bosqueurbano_model->get_precargaPatrocinio($ID__EMPRESA);	
		$global['empaquetadoD']=$this->bosqueurbano_model->get_precargaDonacion($ID__EMPRESA);	
		$global['empaquetadoS']=$this->bosqueurbano_model->get_precargaSeguimiento($ID__EMPRESA);			
		echo JSON_ENCODE($global);			
	}
	public function eliminarEmpresaInstitucion()
	{				
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$this->bosqueurbano_model->limpia_patrocinios($ID__EMPRESA);	
		$this->bosqueurbano_model->limpia_donaciones($ID__EMPRESA);
		$this->bosqueurbano_model->limpia_seguimiento($ID__EMPRESA);
		$this->bosqueurbano_model->delete_EmpresaInstitucion($ID__EMPRESA);	
	}
	/* empresas institucion arriba */




	/* embajadores Institucion abajo */
	public function EmbajadoresInstitucion()
	{
		$estado = $this->session->flashdata('estado');				
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");	
		$VCH_PERSONACONTACTO=$this->input->post("VCH_PERSONACONTACTO");	
		$responsables = $this->bosqueurbano_model->get_responsables();	
		$instituciones = $this->bosqueurbano_model->get_institucionesEmbajador($VCH_NOMBRE,$VCH_PERSONACONTACTO);	
		$datos=array('titulo'=>'Instituciones','instituciones'=>$instituciones,'responsables'=>$responsables,'menu'=>'Configuración');

		$this->session->set_userdata("SUBMENU",6);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/InstitucionesEducativasEmbajadores/institucionesEducativasEmbajadores')
		           ->view('fin_archivo');
	}
	public function cargarInstitucion()
	{
		$ID__INSTITUCION=$this->input->post("ID__INSTITUCION");
		
		$data=$this->bosqueurbano_model->get_precargaInstitucion($ID__INSTITUCION);	
		echo JSON_ENCODE($data);			
	}
	public function altaInstitucion()
	{		
		//$ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$ID__USUARIO,$VCH_COMENTARIOS
		
		$ID__INSTITUCION=$this->input->post("ID__INSTITUCION");
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");
		$VCH_PERSONACONTACTO=$this->input->post("VCH_PERSONACONTACTO");
		$VCH_PUESTOCONTACTO=$this->input->post("VCH_PUESTOCONTACTO");
		$VCH_CORREO=$this->input->post("VCH_CORREO");
		$VCH_TELEFONO=$this->input->post("VCH_TELEFONO");
		$ID__USUARIO=$this->input->post("ID__USUARIO");
		$VCH_COMENTARIOS=$this->input->post("VCH_COMENTARIOS");
		$ID__COLONIA=$this->input->post("ID__COLONIA");
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");
		
		if(($ID__COLONIA!=0)&&($ID__COLONIA!=''))
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);		
		}						
		else
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio("0","-","");		
		}
		$this->bosqueurbano_model->alta_Institucion($ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$ID__USUARIO,$VCH_COMENTARIOS);			
	}
	public function editarInstitucion()
	{		
		//$ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$ID__USUARIO,$VCH_COMENTARIOS
		
		$ID__INSTITUCION=$this->input->post("ID__INSTITUCION");
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");
		$VCH_PERSONACONTACTO=$this->input->post("VCH_PERSONACONTACTO");
		$VCH_PUESTOCONTACTO=$this->input->post("VCH_PUESTOCONTACTO");
		$VCH_CORREO=$this->input->post("VCH_CORREO");
		$VCH_TELEFONO=$this->input->post("VCH_TELEFONO");
		$ID__USUARIO=$this->input->post("ID__USUARIO");
		$VCH_COMENTARIOS=$this->input->post("VCH_COMENTARIOS");
		$ID__COLONIA=$this->input->post("ID__COLONIA");
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");		
		$this->bosqueurbano_model->edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);		
		
		$this->bosqueurbano_model->edita_Institucion($ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$ID__USUARIO,$VCH_COMENTARIOS);			
	}
	public function eliminarInstitucion()
	{				
		$ID__INSTITUCION=$this->input->post("ID__INSTITUCION");				
		$this->bosqueurbano_model->delete_Institucion($ID__INSTITUCION);	
	}
	/* embajadores Institucion arriba */



	/* eventos de adopcion abajo */
	public function EventosAdopcion()
	{				
		$estado = $this->session->flashdata('estado');				
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");	
		$fechaInicio=$this->input->post("fechaInicio");	
		$fechafin=$this->input->post("fechafin");	
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");	
		
		$empresas= $this->bosqueurbano_model->get_Select_empresas();
		$eventosAdopcion = $this->bosqueurbano_model->get_eventosAdopcion($VCH_NOMBRE,$fechaInicio,$fechafin,$VCH_ESTATUS);	
		$datos=array('titulo'=>'Eventos de Adopción','eventosadopcion'=>$eventosAdopcion,'empresas'=>$empresas);

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/EventosAdopcion/eventosAdopcion')
		           ->view('fin_archivo');
	}
	
	public function altaEventoAdopcion()
	{					
		$form_empaquetadoP=$this->input->post("form_empaquetadoP");				
		$form_empaquetadoP=json_decode($form_empaquetadoP);
		foreach($form_empaquetadoP as $patrocinador)
		{
			$this->bosqueurbano_model->altaEventoAdopcionPatrocinador($patrocinador->VCH_NOMBREPATROCINADOR,$patrocinador->VCH_ARCHIVO);

		}
//		die(print_r($form_empaquetadoP));
			/*
				if(!empty($_FILES["iptFotoEspecie"]["name"]))
				{
					$config['upload_path']          = './uploads/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2000;		
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('iptFotoEspecie'))
					{
				
						$error = array('error' => $this->upload->display_errors());
						die(print_r($error));
						$this->load->view('upload_form', $error);
					}
					$filename=$_FILES["iptFotoEspecie"]["name"];
				}		
			*/
		//die("te pasaste");
		
		$ID__EVENTO=$this->input->post("form_ID__EVENTO");
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");
		$VCH_NOMBRE=$this->input->post("form_VCH_NOMBRE");
		$VCH_DESCRIPCION=$this->input->post("form_VCH_DESCRIPCION");
		$VCH_LUGAR=$this->input->post("form_VCH_LUGAR");
		$FEC_FECHAINICIO=$this->input->post("form_FEC_FECHAINICIO");
		$FEC_FECHAFIN=$this->input->post("form_FEC_FECHAFIN");
		$VCH_COMPANIAPUBLICITARIA=$this->input->post("form_VCH_COMPANIAPUBLICITARIA");
		$NUM_CANTIDADARBOLES=$this->input->post("form_NUM_CANTIDADARBOLES");
		$VCH_ESTATUS=$this->input->post("optradio");
		$VCH_CONTACTO=$this->input->post("form_VCH_CONTACTO");
		$VCH_CARGOCONTACTO=$this->input->post("form_VCH_CARGOCONTACTO");		
		$VCH_TELEFONOCONTACTO=$this->input->post("form_VCH_TELEFONOCONTACTO");
		$VCH_CELULARCONTACTO=$this->input->post("form_VCH_CELULARCONTACTO");		
		$VCH_CORREOCONTACTO=$this->input->post("form_VCH_CORREOCONTACTO");	
		
		$ID__COLONIA=$this->input->post("ID__COLONIA");
		$VCH_CALLE=$this->input->post("divDomicilio-calle");		
		$VCH_ENTRECALLE=$this->input->post("divDomicilio-entre");
	//	echo "<pre>";die(print_r($this->input->post()));
		if(($ID__COLONIA!=0)&&($ID__COLONIA!=''))
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);		
		}		
		else
		{
			$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio(0,"-","");		
		}				
				
		$this->bosqueurbano_model->alta_eventoAdopciones($ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$ID__USUARIO,$VCH_COMENTARIOS);			
		
						
		
		
		
	}
	
	/* eventos de adopcion arriba */



	public function Adopcion()
	{
		$datos=array('titulo'=>'Registros de Adopción');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/RegistroAdopcion/registrosAdopcion')
		           ->view('fin_archivo');
	}

	public function Reforestacion()
	{
		$datos=array('titulo'=>'Eventos Reforestación');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/EventosReforestacion/eventosReforestacion')
		           ->view('fin_archivo');
	}

	public function AdopcionMultiple()
	{
		$datos=array('titulo'=>'Solicitud Adopción Multiple');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/SolicitudAdopcionMultiple/solicitudesAdopcionMultiple')
		           ->view('fin_archivo');
	}

	public function Inventario()
	{
		$datos=array('titulo'=>'Inventario');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/Inventario/inventario')
		           ->view('fin_archivo');
	}

	public function MapaArboles()
	{
		$especies= $this->bosqueurbano_model->get_selectEspeciesConAdopcion();
//		die(print_r($especies));
		$eventos= $this->bosqueurbano_model->get_selectEventosConAdopcion();
		$empresas= $this->bosqueurbano_model->get_selectEmpresasConAdopcion();
		
		$datos=array('titulo'=>'Mapa de Arboles','especies'=>$especies,'eventos'=>$eventos,'empresas'=>$empresas,'menu'=>'Reportes');
		$this->session->set_userdata("SUBMENU",25);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/MapaArboles/mapaArboles')
		           ->view('fin_archivo',array('mapa'=>true));
	}
	
	/*
	public function AsignacionEmbajadoresAdopciones()
	{
		$datos=array('titulo'=>'Asignaciones de Adopciones a Embajador');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/AsignacionAdopcionEmbajador/asignacionAdopcionesEmbajador')
		           ->view('fin_archivo');
	}

	public function AsignacionEmbajadoresAdopcionesMultiples()
	{
		$datos=array('titulo'=>'Asignaciones de Adopciones Multiples a Embajador');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/AsignacionAdopcionMultiplesEmbajador/asignacionAdopcionesMultiplesEmbajador')
		           ->view('fin_archivo');
	}

	public function AsignacionReforestacionEmbajador()
	{
		$datos=array('titulo'=>'Asignaciones de Reforestación a Embajador');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/asignacionReforestacionesEmbajador/asignacionReforestacionesEmbajador')
		           ->view('fin_archivo');
	}*/

	public function Blog()
	{
		$datos=array('titulo'=>'Blog');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/Blog/blog')
		           ->view('fin_archivo');
	}

	/* Tipos de patrocinios abajo*/
	public function TiposPatrocinios()
	{
		
		$tiposPatrocinios = $this->bosqueurbano_model->get_tiposPatrocinios();	
		$datos=array('titulo'=>'Tipos Patrocinios','tiposPatrocinios'=>$tiposPatrocinios,'menu'=>'Configuración');

		$this->session->set_userdata("SUBMENU",7);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/TiposPatrocinios/tiposPatrocinio')
		           ->view('fin_archivo');
	}
	public function cargarTipoPatrocinio()
	{
		$ID__PATROCINIO=$this->input->post("ID__PATROCINIO");		
		$data=$this->bosqueurbano_model->get_precargaTipoPatrocinio($ID__PATROCINIO);	
		echo JSON_ENCODE($data);
	}
	public function altaTipoPatrocinio()
	{
		$ID__PATROCINIO=$this->input->post("ID__PATROCINIO");	
		$VCH_TIPO=$this->input->post("VCH_TIPO");		
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");		
		$this->bosqueurbano_model->alta_TipoPatrocinio($ID__PATROCINIO,$VCH_TIPO,$VCH_OBSERVACIONES);	
		echo "Se guardo exitosamente";
	}
	public function editarTipoPatrocinio()
	{
		$ID__PATROCINIO=$this->input->post("ID__PATROCINIO");	
		$VCH_TIPO=$this->input->post("VCH_TIPO");		
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");		
		$this->bosqueurbano_model->edita_TipoPatrocinio($ID__PATROCINIO,$VCH_TIPO,$VCH_OBSERVACIONES);	
		echo "Se guardo exitosamente";
	}	
	public function eliminarTipoPatrocinio()
	{
		$ID__PATROCINIO=$this->input->post("ID__PATROCINIO");	
		$this->bosqueurbano_model->delete_TipoPatrocinio($ID__PATROCINIO);
	}
	/* Tipos de patrocinios arriba*/

	public function PuntosGanados()
	{
		$datos=array('titulo'=>'Puntos Ganados');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/PuntosGanados/puntosGanados')
		           ->view('fin_archivo');
	}

	public function PatrocinadorArbol()
	{
		$datos=array('titulo'=>'Patrocinador Arbol');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/PatrocinadorArbol/patrocinadorArbol')
		           ->view('fin_archivo');
	}

	/* catalogo de ubicaciones abajo */
	public function CatalogoUbicaciones()
	{
		$VCH_NOMBRE=$this->input->post("BUSQUEDA_VCH_NOMBRE");	
		$INT_ESTATUS=$this->input->post("BUSQUEDA_INT_ESTATUS");	
		$INT_USO=$this->input->post("BUSQUEDA_INT_USO");	
		$ubicaciones= $this->bosqueurbano_model->get_ubicaciones($VCH_NOMBRE,$INT_ESTATUS,$INT_USO);
		$datos=array('titulo'=>'Catalogo Ubicaciones','ubicaciones'=>$ubicaciones,'menu'=>'Configuración');

		$this->session->set_userdata("SUBMENU",8);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/CatalogoUbicaciones/catalogoUbicaciones')
		           ->view('fin_archivo');
	}
	public function cargarUbicacion()
	{
		$ID__UBICACION=$this->input->post("ID__UBICACION");		
		$data=$this->bosqueurbano_model->get_precargaUbicacion($ID__UBICACION);	
		echo JSON_ENCODE($data);	
	}
	public function altaUbicacion()
	{
		$ID__UBICACION=$this->input->post("ID__UBICACION");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");	
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");				
		$INT_ESTATUS=$this->input->post("INT_ESTATUS");			
		$INT_USO=$this->input->post("INT_USO");			
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");			
		$ID__COLONIA=$this->input->post("ID__COLONIA");	
		$VCH_CODIGOPOSTAL=$this->input->post("VCH_CODIGOPOSTAL");	
		$VCH_CALLE=$this->input->post("VCH_CALLE");				
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");											
		if (($ID__COLONIA==0)||($ID__COLONIA==''))
		{
			$VCH_CALLE="-";$VCH_ENTRECALLE="-";
		}
		$filename="";
		if(!empty($_FILES["iptFotoEspecie"]["name"]))
		{
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 10000;		
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('iptFotoEspecie'))
			{		
				$error = array('error' => $this->upload->display_errors());
				die(print_r($error));
				$this->load->view('upload_form', $error);
			}
			$filename=$_FILES["iptFotoEspecie"]["name"];
		}		
				
		$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);												
		$this->bosqueurbano_model->alta_Ubicacion($ID__DOMICILIO,$VCH_NOMBRE,$INT_ESTATUS,$INT_USO,$VCH_OBSERVACIONES,$filename);						
		redirect('/bosqueUrbano/CatalogoUbicaciones');	
	}
	public function editarUbicacion()
	{
		$ID__UBICACION=$this->input->post("ID__UBICACION");	
//				die($ID__UBICACION."?");
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");	
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");				
		$INT_ESTATUS=$this->input->post("INT_ESTATUS");			
		$INT_USO=$this->input->post("INT_USO");			
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");			
		$ID__COLONIA=$this->input->post("ID__COLONIA");	
		$VCH_CODIGOPOSTAL=$this->input->post("VCH_CODIGOPOSTAL");	
		$VCH_CALLE=$this->input->post("VCH_CALLE");				
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");											
		if (($ID__COLONIA==0)||($ID__COLONIA==''))
		{
			$VCH_CALLE="-";$VCH_ENTRECALLE="-";
		}
		$filename="";
		if(!empty($_FILES["iptFotoEspecie"]["name"]))
		{
			$config['upload_path']          = './uploads/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 10000;			
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('iptFotoEspecie'))
			{		
				$error = array('error' => $this->upload->display_errors());
				die(print_r($error));
				$this->load->view('upload_form', $error);
			}
			$filename=$_FILES["iptFotoEspecie"]["name"];
		}
		$this->bosqueurbano_model->edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);												
		$this->bosqueurbano_model->edita_Ubicacion($ID__UBICACION,$ID__DOMICILIO,$VCH_NOMBRE,$INT_ESTATUS,$INT_USO,$VCH_OBSERVACIONES,$filename);	
		$this->session->set_flashdata('estado', 'Se guardo exitosamente');
		redirect('/bosqueUrbano/CatalogoUbicaciones');	
	}
	
	/* catalogo de ubicaciones arriba */


	/* catalogo de talleres abajo*/
	public function CatalogoTalleres()
	{
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE_Busqueda");					
		$talleres= $this->bosqueurbano_model->get_CatalogoTalleres($VCH_NOMBRE);
		$estado = $this->session->flashdata('estado');
		$datos=array('titulo'=>'Catalogo Talleres','talleres'=>$talleres,'estado'=>$estado,'menu'=>'Talleres');
		$this->session->set_userdata("SUBMENU",12);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/CatalogoTalleres/catalogoTalleres')
		           ->view('fin_archivo');
	}
	public function	altaCatalogoTalleres()
	{
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");					
		$VCH_MATERIAL=$this->input->post("VCH_MATERIAL");					
		$VCH_DESCRIPCION=$this->input->post("VCH_DESCRIPCION");		

		$ID__TALLER=$this->bosqueurbano_model->altaCatalogoTalleres($VCH_NOMBRE,$VCH_MATERIAL,$VCH_DESCRIPCION);			
		
				
		$CompiladoNombresFiles=$this->input->post("CompiladoNombresFiles");					
		$CompiladoNombresFiles= JSON_DECODE($CompiladoNombresFiles);	
		if(!empty($_FILES["VCH_URL_ARCHIVOFile0"]["name"]))
		{
			$config['upload_path']          = './uploads/catalogoTalleres/';
//			$config['allowed_types']        = 'gif|jpg|png';
			$config['allowed_types']        = '*';
			$config['max_size']             = 10000;			
			$this->load->library('upload', $config);
						
			$indiceFile=0;			

			while (!empty( $_FILES["VCH_URL_ARCHIVOFile".$indiceFile]["name"]) )
			{				
				if ( ! $this->upload->do_upload("VCH_URL_ARCHIVOFile".$indiceFile))
				{			
					$error = array('error' => $this->upload->display_errors());
					die(print_r($error));
				}
				$filename=$_FILES["VCH_URL_ARCHIVOFile".$indiceFile]["name"];
				$this->bosqueurbano_model->altaArchivosTalleres($ID__TALLER,$CompiladoNombresFiles[$indiceFile],$filename);			
				$indiceFile++;				
			}													
			
		}
		$this->session->set_flashdata('estado', 'Se guardo exitosamente');	
		redirect('/bosqueUrbano/CatalogoTalleres');							
	}
	public function	cargarCatalogoTaller()
	{
		$ID__TALLER=$this->input->post("ID__TALLER");			
		$data["taller"]=$this->bosqueurbano_model->get_cargaCatalogoTaller($ID__TALLER);	
		$data["archivos"]=$this->bosqueurbano_model->get_cargaCatalogoTallerArchivos($ID__TALLER);	
		echo JSON_ENCODE($data);	
		
	}
	public function	editarCatalogoTalleres()
	{
		$ID__TALLER=$this->input->post("ID__TALLER");	
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");					
		$VCH_MATERIAL=$this->input->post("VCH_MATERIAL");					
		$VCH_DESCRIPCION=$this->input->post("VCH_DESCRIPCION");		

		$this->bosqueurbano_model->editaCatalogoTalleres($VCH_NOMBRE,$VCH_MATERIAL,$VCH_DESCRIPCION,$ID__TALLER);			
		
				
		$CompiladoNombresFiles=$this->input->post("CompiladoNombresFiles");					
		$CompiladoNombresFiles= JSON_DECODE($CompiladoNombresFiles);	
		if(!empty($_FILES["VCH_URL_ARCHIVOFile0"]["name"]))
		{
			$config['upload_path']          = './uploads/catalogoTalleres/';
			$config['allowed_types']        = '*';
			$config['max_size']             = 10000;			
			$this->load->library('upload', $config);
						
			$indiceFile=0;			

			while (!empty( $_FILES["VCH_URL_ARCHIVOFile".$indiceFile]["name"]) )
			{				
				
				if ( ! $this->upload->do_upload("VCH_URL_ARCHIVOFile".$indiceFile))
				{			
					$error = array('error' => $this->upload->display_errors());
					die(print_r($error));
				}
				$filename=$_FILES["VCH_URL_ARCHIVOFile".$indiceFile]["name"];
				$this->bosqueurbano_model->altaArchivosTalleres($ID__TALLER,$CompiladoNombresFiles[$indiceFile],$filename);			
				
				$indiceFile++;				
			}													
			
		}
		$this->session->set_flashdata('estado', 'Se guardo exitosamente');	
		redirect('/bosqueUrbano/CatalogoTalleres');				
	}	
	/* catalogo de talleres arriba*/
	
	
	
	
	
	
	public function evaluacion()
	{
		$datos=array('titulo'=>'Evaluación');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/evaluacion/evaluacion')
		           ->view('fin_archivo');
	}
	
	public function BuscarGuardabosque()
	{	
		$VCH_NOMBRE=$this->input->post("VCH_NOMBREASISTENTE");	
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");
		$VCH_CORREO=$this->input->post("VCH_CORREOASISTENTE");			
		//				$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$estado,$ciudad,$colonia,$VCH_CODIGOPOSTAL,$VCH_CALLE
		$guardabosques	 = $this->bosqueurbano_model->get_guardabosques($VCH_NOMBRE,$VCH_APELLIDOPATERNO,"",$VCH_CORREO,"","","","","");
		echo JSON_ENCODE($guardabosques);		
	}

	public function taller()
	{
//		die(print_r($this->input->post));
		$ID__TALLER=$this->input->post("ID__TALLER_busqueda");	
		$VCH_TALLER=$this->input->post("VCH_CLAVETALLER_busqueda");	
		$registrotalleres= $this->bosqueurbano_model->get_registrotalleres($ID__TALLER, $VCH_TALLER);
		$catalogotalleres= $this->bosqueurbano_model->get_CatalogoTalleres("");		
		$empresas		 = $this->bosqueurbano_model->get_Select_empresas();
		
		$talleristas		 = $this->bosqueurbano_model->get_Select_talleristas();
		$embajadores		 = $this->bosqueurbano_model->get_Select_embajadores();
		
		
		
		$datos=array('titulo'=>'Registro de Talleres','talleres'=>$registrotalleres,'catalogotalleres'=>$catalogotalleres,'patrocinadores'=>$empresas,'talleristas'=>$talleristas,'embajadores'=>$embajadores,'menu'=>'Talleres');		
		$this->session->set_userdata("SUBMENU",13);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/registro_talleres/taller')
		           ->view('fin_archivo');
	}
	public function GuardarRegistroTaller()
	{
		$data=$this->input->post("data");	
		$talleristas=$this->input->post("talleristas");	
		$embajadores=$this->input->post("embajadores");	
		$asistentes=json_decode($this->input->post("asistentes"));			
		$asistentes=json_decode(json_encode($asistentes), true);
		
		$ID__COLONIA=$this->input->post("ID__COLONIA");			
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");			
		
		//die(print_r(get_defined_vars()));
		
		if($data["ID__CVETALLER"]==0)	//crear 
		{			
			$this->bosqueurbano_model->inserta_RegistroTaller($data,$talleristas,$embajadores,$asistentes,$ID__COLONIA);
		}
		else
		{
			//die(print_r(get_defined_vars()));
			$this->bosqueurbano_model->edita_RegistroTaller($data,$talleristas,$embajadores,$asistentes,$ID__COLONIA,$ID__DOMICILIO);
		}
		Echo "guardado exitosamente";					
	}
	public function cargarTallerRegistro()
	{
		$ID__CVETALLER=$this->input->post("ID__CVETALLER");		
		$data=$this->bosqueurbano_model->get_TallerRegistro($ID__CVETALLER);	
		echo JSON_ENCODE($data);	
	}

/*
	public function bajaArboles()
	{
		$datos=array('titulo'=>'Baja de Árbol Muerto o Intercambio');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/bajaArbolesMuertos/bajaArboles')
		           ->view('fin_archivo');
	}*/

	/* Precios especie abajo */
	public function preciosEspeciales()
	{
		$especies= $this->bosqueurbano_model->get_selectEspecies();
		$datos=array('titulo'=>'Precios por Especie','especies'=>$especies,'menu'=>'Configuración');

		$this->session->set_userdata("SUBMENU",9);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/catalogoPrecios/preciosEspeciales')
		           ->view('fin_archivo');
	}
	public function cargarPreciosEspecie()
	{
		$id_especie=$this->input->post("id_especie");		
		$data=$this->bosqueurbano_model->get_PrecioEspecie($id_especie);	
		echo JSON_ENCODE($data);	
	}
	public function altaPrecioEspecie()
	{
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");
		$MES_TRES=$this->input->post("MES_TRES");	
		$MES_SEIS=$this->input->post("MES_SEIS");
		$MES_NUEVE=$this->input->post("MES_NUEVE");	
		$MES_DOCE=$this->input->post("MES_DOCE");
		$MES_DIECIOCHO=$this->input->post("MES_DIECIOCHO");	
		$MES_VEINTICUATRO=$this->input->post("MES_VEINTICUATRO");
		$MES_TREINTA=$this->input->post("MES_TREINTA");	
		$MES_TREINTAYSEIS=$this->input->post("MES_TREINTAYSEIS");
		$MES_CUARENTAYDOS=$this->input->post("MES_CUARENTAYDOS");	
		$MES_CUARENTAYOCHO=$this->input->post("MES_CUARENTAYOCHO");
		$MES_SESENTA=$this->input->post("MES_SESENTA");
		$MES_SETENTAYDOS=$this->input->post("MES_SETENTAYDOS");	
		$this->bosqueurbano_model->alta_precioEspecie($ID__ESPECIE,$MES_TRES,$MES_SEIS,$MES_NUEVE,$MES_DOCE,$MES_DIECIOCHO,$MES_VEINTICUATRO,$MES_TREINTA,$MES_TREINTAYSEIS,$MES_CUARENTAYDOS,$MES_CUARENTAYOCHO,$MES_SESENTA,$MES_SETENTAYDOS);
	}
	public function editarPrecioEspecie()
	{			
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");
		$MES_TRES=$this->input->post("MES_TRES");	
		$MES_SEIS=$this->input->post("MES_SEIS");
		$MES_NUEVE=$this->input->post("MES_NUEVE");	
		$MES_DOCE=$this->input->post("MES_DOCE");
		$MES_DIECIOCHO=$this->input->post("MES_DIECIOCHO");	
		$MES_VEINTICUATRO=$this->input->post("MES_VEINTICUATRO");
		$MES_TREINTA=$this->input->post("MES_TREINTA");	
		$MES_TREINTAYSEIS=$this->input->post("MES_TREINTAYSEIS");
		$MES_CUARENTAYDOS=$this->input->post("MES_CUARENTAYDOS");	
		$MES_CUARENTAYOCHO=$this->input->post("MES_CUARENTAYOCHO");
		$MES_SESENTA=$this->input->post("MES_SESENTA");
		$MES_SETENTAYDOS=$this->input->post("MES_SETENTAYDOS");	
		$this->bosqueurbano_model->edita_precioEspecie($ID__ESPECIE,$MES_TRES,$MES_SEIS,$MES_NUEVE,$MES_DOCE,$MES_DIECIOCHO,$MES_VEINTICUATRO,$MES_TREINTA,$MES_TREINTAYSEIS,$MES_CUARENTAYDOS,$MES_CUARENTAYOCHO,$MES_SESENTA,$MES_SETENTAYDOS);
	}
	/* Precios especie arriba */

	public function altaVales()
	{
		$datos=array('titulo'=>'Alta de Vales');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/altasVales/altasVales')
		           ->view('fin_archivo');
	}
	
	
	
	
	
	
	
	public function ReporteInventarioEspecie()
	{
		
		/*$estados= $this->bosqueurbano_model->get_estados();
		$municipios= $this->bosqueurbano_model->get_municipios();
		$colonias=$this->bosqueurbano_model->get_colonias();
		file_put_contents ( "colonias.json" , JSON_ENCODE($colonias) );*/
		
		$datos=array('titulo'=>'Reporte de Inventario por Especie');
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/reportes/ReporteInventarioEspecie')
		           ->view('fin_archivo');
	}
	public function ReporteDonacionesPeriodo()
	{
		$datos=array('titulo'=>'Reporte de Donaciones por Periodo');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/reportes/ReporteDonacionesPeriodo')
		           ->view('fin_archivo');
	}
	public function ReporteSeguimientoAdopciones()
	{
		$datos=array('titulo'=>'Reporte de Seguimiento a adopciones');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/reportes/ReporteSeguimientoAdopciones')
		           ->view('fin_archivo');
	}
	public function ReporteSeguimientoAdopcionMultiple()
	{
		$datos=array('titulo'=>'Reporte de Seguimiento a Adopciones Múltipes y Reforestaciones');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/reportes/ReporteSeguimientoAdopcionMultiple')
		           ->view('fin_archivo');
	}
	public function ReporteAdopcionEmpresa()
	{
		$datos=array('titulo'=>'Reporte de Adopciones por Empresa');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/reportes/ReporteAdopcionEmpresa')
		           ->view('fin_archivo');
	}
	public function CatalogoProcedencias()
	{
		$datos=array('titulo'=>'Catalogo de Procedencias');

		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/catalogoProcedencias/Procedencias')
		           ->view('fin_archivo');
	}
	
	public function atajoGuardabosque()
	{
		$this->load->view('inicio_archivo')
		           ->view('bosque_urbano/GuardaBosques/AgregarModificarSOLO')
//		           ->view('bosque_urbano/GuardaBosques/guardabosquesUrbanos/')
		           ->view('fin_archivo');
	}
		
	public function mermaInventarioGlobal()
	{	
		$ID__INVENTARIOORIGEN=$this->input->post("ID__INVENTARIO");		
		$NUM_CANTIDADORIGEN=$this->input->post("NUM_CANTIDAD");	
		$RazonMerma=$this->input->post("RazonMerma");		
		$this->bosqueurbano_model->set_merma($ID__INVENTARIOORIGEN,$NUM_CANTIDADORIGEN,$RazonMerma);					
		Echo "Descontado exitosamente";
	}	
	
	/* inventario global abajo */
	public function Inventarioglobal()
	{
		$inventarios = $this->bosqueurbano_model->get_inventariosGlobales();
		$Procedencias= $this->bosqueurbano_model->get_selectProcedencias();
		$ubicaciones= $this->bosqueurbano_model->get_selectUbicaciones();
		$especies= $this->bosqueurbano_model->get_selectEspecies();
		$contenedores= $this->bosqueurbano_model->get_selectContenedor();
		
		
		$datos=array('titulo'=>'Inventarios','inventarios'=>$inventarios,'Procedencias'=>$Procedencias,'ubicaciones'=>$ubicaciones,'especies'=>$especies,'contenedores'=>$contenedores,'menu'=>'Arbolado');
		$this->session->set_userdata("SUBMENU",11);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/Inventarioglobal/Inventarioglobal')
		           ->view('fin_archivo');
	}
	public function altaInventarioGlobal()
	{							
		$ID__UBICACION=$this->input->post("ID__UBICACION");
		$ID__INVENTARIO=$this->input->post("ID__INVENTARIO");
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");
		$procedencia_id=$this->input->post("procedencia_id");		
		$contenedor_id=$this->input->post("contenedor_id");
		$FEC_FECHAGERMINACION=$this->input->post("FEC_FECHAGERMINACION");
		$NUM_CANTIDAD=$this->input->post("NUM_CANTIDAD");	
		
		//Buscar si existe en esa zona con esas caracteristicas (para sumar?)
		$idPREVIO=$this->bosqueurbano_model->buscar_altaInventarioGlobalRepetido($ID__UBICACION,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION);		
		if(!empty($idPREVIO))
		{			
			$this->bosqueurbano_model->alta_inventarioGlobalCombinar($idPREVIO[0]["ID__INVENTARIO"],$NUM_CANTIDAD);			
		}
		else
		{	
			$this->bosqueurbano_model->alta_inventarioGlobal($ID__UBICACION,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION,$NUM_CANTIDAD);			
		}		
		Echo "guardado exitosamente";			
	}
	public function editarInventarioGlobal()
	{	
		$ID__INVENTARIO=$this->input->post("ID__INVENTARIO");						
		$ID__UBICACION=$this->input->post("ID__UBICACION");
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");
		$procedencia_id=$this->input->post("procedencia_id");		
		$contenedor_id=$this->input->post("contenedor_id");
		$FEC_FECHAGERMINACION=$this->input->post("FEC_FECHAGERMINACION");
		$NUM_CANTIDAD=$this->input->post("NUM_CANTIDAD");			
		$idPREVIO=$this->bosqueurbano_model->buscar_altaInventarioGlobalRepetido($ID__UBICACION,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION);		
		if(!empty($idPREVIO))
		{	
			//Resta el actual que se va
			$this->bosqueurbano_model->reduccion_inventarioGlobal($ID__INVENTARIO,$NUM_CANTIDAD);					
			//Suma al de esas caracteristicas
			$this->bosqueurbano_model->alta_inventarioGlobalCombinar($idPREVIO[0]["ID__INVENTARIO"],$NUM_CANTIDAD);						
		}
		else
		{	
			//No existe algo asi, puedo reciclar el row de BD y cambiarle los valores.
			$this->bosqueurbano_model->modifica_inventarioGlobal($ID__INVENTARIO,$contenedor_id,$FEC_FECHAGERMINACION);			
		}					
		Echo "guardado exitosamente";
	}
	public function cargarInventarioGlobal()
	{
		$ID__INVENTARIO=$this->input->post("ID__INVENTARIO");		
		$data=$this->bosqueurbano_model->get_precargaInventarioGlobal($ID__INVENTARIO);	
		echo JSON_ENCODE($data);	
	}
	public function transferenciaInventarioGlobal()
	{
		$ID__INVENTARIOORIGEN=$this->input->post("ID__INVENTARIO");		
		$NUM_CANTIDADORIGEN=$this->input->post("NUM_CANTIDAD");	
		$ID__UBICACIONDESTINO=$this->input->post("ID__UBICACION");		


		//trae datos del inventario que estas moviendo
		$data=$this->bosqueurbano_model->get_precargaInventarioGlobal($ID__INVENTARIOORIGEN);			
		$data= $data[0];
		extract($data);
						
						
		//Busca si existe algo similar 				
		$idPREVIO=$this->bosqueurbano_model->buscar_altaInventarioGlobalRepetido($ID__UBICACIONDESTINO,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION);		
		if(!empty($idPREVIO))
		{			
			$this->bosqueurbano_model->alta_inventarioGlobalCombinar($idPREVIO[0]["ID__INVENTARIO"],$NUM_CANTIDADORIGEN);			
			$this->bosqueurbano_model->reduccion_inventarioGlobal($ID__INVENTARIOORIGEN,$NUM_CANTIDADORIGEN);
		}
		else
		{				
			$this->bosqueurbano_model->alta_inventarioGlobal($ID__UBICACIONDESTINO,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION,$NUM_CANTIDADORIGEN);			
			$this->bosqueurbano_model->reduccion_inventarioGlobal($ID__INVENTARIO,$NUM_CANTIDADORIGEN);					
		}			
		Echo "transferido exitosamente";
	}	
	/* inventario global arriba */
	
	
	
	/*CatalogoEventos abajo*/
	public function CatalogoEventos()
	{				
		$VCH_NOMBREEVENTO=$this->input->post("VCH_NOMBREEVENTO");		
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");		
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");		
		$VCH_TIPO=$this->input->post("VCH_TIPO");		
		$VCH_NOMBRELUGAR=$this->input->post("VCH_NOMBRELUGAR");		
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");	
		$adop=$this->input->get("adop");		
//		die("?".$adop);
		
		$mensaje = $this->session->flashdata('mensaje');

		$this->load->model('General_model');
		$this->load->model('bosqueurbano/Bosqueurbano_model');

		$empresas= $this->bosqueurbano_model->get_Select_empresas();
		$eventos= $this->bosqueurbano_model->get_catalogoEventos($VCH_NOMBREEVENTO,$ID__EMPRESA,$FEC_FECHAINICIO,$VCH_ESTATUS,$VCH_TIPO,$VCH_NOMBRELUGAR,$FEC_FECHAFIN,1);
		$datos=array('titulo'=>'Eventos de Adopcion','eventos'=>$eventos,'empresas'=>$empresas,'mapaTypeBox'=>true,'mensaje'=>$mensaje,'VCH_NOMBREEVENTO'=>$VCH_NOMBREEVENTO,'ID__EMPRESA'=>$ID__EMPRESA,'FEC_FECHAINICIO'=>$FEC_FECHAINICIO,'VCH_ESTATUS'=>$VCH_ESTATUS,'VCH_TIPO'=>$VCH_TIPO,'VCH_NOMBRELUGAR'=>$VCH_NOMBRELUGAR,'FEC_FECHAFIN'=>$FEC_FECHAFIN,'menu'=>'Eventos','AdopcionVivero'=>$adop);
		
		$this->session->set_userdata("SUBMENU",16);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/eventos/Eventos')
		           ->view('fin_archivo');
	}	
	/*CatalogoEventos abajo*/
	public function CatalogoEventosREFORESTACION()
	{				
		$VCH_NOMBREEVENTO=$this->input->post("VCH_NOMBREEVENTO");		
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");		
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");		
		$VCH_TIPO=$this->input->post("VCH_TIPO");		
		$VCH_NOMBRELUGAR=$this->input->post("VCH_NOMBRELUGAR");		
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");		
		
		$mensaje = $this->session->flashdata('mensaje');

		$this->load->model('General_model');
		$this->load->model('bosqueurbano/Bosqueurbano_model');

		$empresas= $this->bosqueurbano_model->get_Select_empresas();
		$eventos= $this->bosqueurbano_model->get_catalogoEventos($VCH_NOMBREEVENTO,$ID__EMPRESA,$FEC_FECHAINICIO,$VCH_ESTATUS,$VCH_TIPO,$VCH_NOMBRELUGAR,$FEC_FECHAFIN,2);
		$datos=array('titulo'=>'Eventos de Reforestacion','eventos'=>$eventos,'empresas'=>$empresas,'mapaTypeBox'=>true,'mensaje'=>$mensaje,'VCH_NOMBREEVENTO'=>$VCH_NOMBREEVENTO,'ID__EMPRESA'=>$ID__EMPRESA,'FEC_FECHAINICIO'=>$FEC_FECHAINICIO,'VCH_ESTATUS'=>$VCH_ESTATUS,'VCH_TIPO'=>$VCH_TIPO,'VCH_NOMBRELUGAR'=>$VCH_NOMBRELUGAR,'FEC_FECHAFIN'=>$FEC_FECHAFIN,'menu'=>'Eventos');
		
		$this->session->set_userdata("SUBMENU",17);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/eventosREFOR/Eventos')
		           ->view('fin_archivo');
	}	
	
	public function cargarEventoCatalogo()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$data=$this->bosqueurbano_model->get_precargaEventoCatalogo($ID__EVENTO);	
		echo JSON_ENCODE($data);	
	}
	
	public function cargarEventoCatalogoReforesta()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$data=$this->bosqueurbano_model->get_precargaEventoCatalogoReforesta($ID__EVENTO);	
		echo JSON_ENCODE($data);	
	}
		
	public function altaEventoCatalogo()
	{				
			
		$ID__EVENTO=$this->input->post("ID__EVENTO");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");	
		
		//$VCH_TIPO=$this->input->post("VCH_TIPO");			
		$VCH_TIPO=1;			
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$VCH_NOMBREEVENTO=$this->input->post("VCH_NOMBREEVENTO");		
		$VCH_NOMBRELUGAR=$this->input->post("VCH_NOMBRELUGAR");		
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");		
		$NUM_COMPUTADORAS=$this->input->post("NUM_COMPUTADORAS");		
		$NUM_ARBOLESSOLICITADOS=$this->input->post("NUM_ARBOLESSOLICITADOS");				
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");						
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");				
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			if($VCH_ESTATUS=="true")	{	$VCH_ESTATUS=1;	}else{$VCH_ESTATUS=0;}
						
		$ID__COLONIA=$this->input->post("ID__COLONIA");	
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");											

		$VCH_LATITUD=$this->input->post("VCH_LATITUD");											
		$VCH_LONGITUD=$this->input->post("VCH_LONGITUD");											
		
		if(empty($VCH_CALLE)){$VCH_CALLE='-';}		if(empty($VCH_ENTRECALLE)){$VCH_ENTRECALLE='-';}

		$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);									
								
		$this->bosqueurbano_model->alta_catalogoEventos( $VCH_ESTATUS,$VCH_TIPO,$ID__EMPRESA,$ID__DOMICILIO,$VCH_NOMBREEVENTO,
												$VCH_NOMBRELUGAR,$VCH_OBSERVACIONES,$NUM_COMPUTADORAS,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
												$FEC_FECHAFIN,$VCH_LATITUD,$VCH_LONGITUD);		
		
	}	
	public function altaEventoReforCatalogo()
	{							

		//echo "<pre>";
		//DIE(print_r($this->input->post()));
		
		$ID__EVENTO=$this->input->post("ID__EVENTO");	
		$VCH_NOMBREEVENTO=$this->input->post("VCH_NOMBREEVENTO");		
		$EMPRESAS=$this->input->post("EMPRESAS");								
		$VCH_TIPO=2;	
		$VCH_TIPOREFORESTA=$this->input->post("VCH_TIPOREFORESTA");		
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");						
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");					
		$NUM_ARBOLESSOLICITADOS=$this->input->post("NUM_ARBOLESSOLICITADOS");										
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			if($VCH_ESTATUS=="true")	{	$VCH_ESTATUS=1;	}else{$VCH_ESTATUS=0;}
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");		
		$VCH_PRERREQUISITOS=$this->input->post("VCH_PRERREQUISITOS");	
		$VCH_LATITUD=$this->input->post("VCH_LATITUD");											
		$VCH_LONGITUD=$this->input->post("VCH_LONGITUD");											

//		echo "<pre>";
//		DIE(print_r(get_defined_vars()));
								
		$this->bosqueurbano_model->alta_catalogoEventosRefor( $ID__EVENTO,$VCH_NOMBREEVENTO,$EMPRESAS,$VCH_TIPOREFORESTA,
															  $NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,$FEC_FECHAFIN,$VCH_ESTATUS,
															  $VCH_OBSERVACIONES,$VCH_PRERREQUISITOS,$VCH_LATITUD,$VCH_LONGITUD);		
		
	}	
	public function editarEventoCatalogo()
	{						
		$ID__EVENTO=$this->input->post("ID__EVENTO");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");	
		
		//$VCH_TIPO=$this->input->post("VCH_TIPO");			
		$VCH_TIPO=1;
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$VCH_NOMBREEVENTO=$this->input->post("VCH_NOMBREEVENTO");		
		$VCH_NOMBRELUGAR=$this->input->post("VCH_NOMBRELUGAR");		
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");		
		$NUM_COMPUTADORAS=$this->input->post("NUM_COMPUTADORAS");		
		$NUM_ARBOLESSOLICITADOS=$this->input->post("NUM_ARBOLESSOLICITADOS");				
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");						
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");				
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			if($VCH_ESTATUS=="true")	{	$VCH_ESTATUS=1;	}else{$VCH_ESTATUS=0;}
						
		$ID__COLONIA=$this->input->post("ID__COLONIA");	if(empty($ID__COLONIA)){$ID__COLONIA=0;}
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");																				
		$VCH_LATITUD=$this->input->post("VCH_LATITUD");											
		$VCH_LONGITUD=$this->input->post("VCH_LONGITUD");	

		if(empty($VCH_CALLE)){$VCH_CALLE='-';}		if(empty($VCH_ENTRECALLE)){$VCH_ENTRECALLE='-';}
		$ID__DOMICILIO=$this->bosqueurbano_model->edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);									
								
		$this->bosqueurbano_model->edita_catalogoEventos( $VCH_ESTATUS,$VCH_TIPO,$ID__EMPRESA,$ID__DOMICILIO,$VCH_NOMBREEVENTO,
												$VCH_NOMBRELUGAR,$VCH_OBSERVACIONES,$NUM_COMPUTADORAS,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
												$FEC_FECHAFIN,$ID__EVENTO,$VCH_LATITUD,$VCH_LONGITUD);		
	}	
	public function editarEventoReforCatalogo()
	{					
		$ID__EVENTO=$this->input->post("ID__EVENTO");	
		$VCH_NOMBREEVENTO=$this->input->post("VCH_NOMBREEVENTO");		
		$EMPRESAS=$this->input->post("EMPRESAS");								
		$VCH_TIPO=2;	
		$VCH_TIPOREFORESTA=$this->input->post("VCH_TIPOREFORESTA");		
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");						
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");					
		$NUM_ARBOLESSOLICITADOS=$this->input->post("NUM_ARBOLESSOLICITADOS");										
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			if($VCH_ESTATUS=="true")	{	$VCH_ESTATUS=1;	}else{$VCH_ESTATUS=0;}
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");		
		$VCH_PRERREQUISITOS=$this->input->post("VCH_PRERREQUISITOS");	
		$VCH_LATITUD=$this->input->post("VCH_LATITUD");											
		$VCH_LONGITUD=$this->input->post("VCH_LONGITUD");											
		
//		echo "<pre>";		DIE(print_r($this->input->post()));
		
		$this->bosqueurbano_model->editarEventoReforCatalogo( $ID__EVENTO,$VCH_NOMBREEVENTO,$EMPRESAS,$VCH_TIPOREFORESTA,
															  $NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,$FEC_FECHAFIN,$VCH_ESTATUS,
															  $VCH_OBSERVACIONES,$VCH_PRERREQUISITOS,$VCH_LATITUD,$VCH_LONGITUD);		
	}	
	public function eliminarEventoCatalogo()
	{				
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$this->bosqueurbano_model->delete_EventoCatalogo($ID__EVENTO);	
	}

	public function seguimiento()
	{   
        $this->load->model('bosqueurbano/Bosqueurbano_model');	
		$ID__EVENTO=$this->input->post("ID__EVENTO");
		//echo $this->Bosqueurbano_model->generaArchivoOffline($ID__EVENTO);
		echo $this->Bosqueurbano_model->generaContenidoAdopcionCiudadana($ID__EVENTO);
	}
	public function seguimientoeti()
	{   
        $this->load->model('bosqueurbano/Bosqueurbano_model');	
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		echo $this->Bosqueurbano_model->generaContenidoAdopcionCiudadanaEtiquetas($ID__EVENTO);
	}

	public function AdopcionOnline()
	{   
		$this->load->model('bosqueurbano/Bosqueurbano_model');	
		$ID__EVENTO=$this->input->post("ID__EVENTO");
		//echo $this->Bosqueurbano_model->generaArchivoOffline($ID__EVENTO);
		echo $this->Bosqueurbano_model->generaContenidoAdopcionONLINE($ID__EVENTO);
	}
	/*CatalogoEventos arriba*/
	
	
	
	/* AsignacionRecursosEvento */

	public function AsignacionArboladoEvento()
	{				
		$empresas= $this->bosqueurbano_model->get_Select_empresas();
		$especies = $this->bosqueurbano_model->get_selectEspecies();
		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcion(null);
		$datos=array('titulo'=>'Asignacion de arbolado a evento','eventos'=>$eventos,'especies'=>$especies,'empresas'=>$empresas,'menu'=>'Eventos');
		$this->session->set_userdata("SUBMENU",19);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/eventosAsignacionArbolado/Eventos')
		           ->view('fin_archivo');
	}	
	public function EtiquetadoArbolesTerminar()
	{				
		$ID__EVENTO=$this->input->post("ID__EVENTO");
		$this->bosqueurbano_model->EtiquetadoArbolesTerminar($ID__EVENTO);
	}	
	public function cargarListaEspecies()
	{				
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		echo JSON_ENCODE($this->bosqueurbano_model->cargarListaEspeciesAsignadas($ID__EVENTO));
		
	}	
	public function AsignacionArbolesTerminar()
	{				
		$ID__EVENTO=$this->input->post("ID__EVENTO");
		$this->bosqueurbano_model->AsignacionArbolesTerminar($ID__EVENTO);
	}	
	public function IframeAsignacionArboladoEvento($id)
	{						
		$especies= $this->bosqueurbano_model->get_EspeciesParaAsignarArbolado();				
		$id_empresa= $this->bosqueurbano_model->get_Empresa_Evento($id);	
		
		$responsables=$this->bosqueurbano_model->get_responsables();
		$ubicaciones=$this->bosqueurbano_model->get_selectUbicaciones();
		$contenedores=$this->bosqueurbano_model->get_selectContenedor();
		$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignados($id);
		
		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcion($id);
		
		$etiquetaspre= $this->bosqueurbano_model->get_etiquetas($id_empresa);		
		$etiquetas=array();
		
		foreach($etiquetaspre as $eti)
		{
			$obj["VCH_NOMBRECOMUN"]=$eti["VCH_NOMBRECOMUN"];
			$obj["cuantas"]=$eti["cuantas"];
			if($eti["VCH_ANIO"]==substr($eventos[0]["FEC_FECHAINICIO"],0,4))
			{
				array_push($etiquetas,$obj);
			}
		}
		
		$datosResponsable=$this->bosqueurbano_model->get_ResponsablePrevio($id);		

		$datos=array('titulo'=>'Eventos de adopcion por asignar','eventos'=>$eventos,'etiquetas'=>$etiquetas,'responsables'=>$responsables,'especies'=>$especies,'ubicaciones'=>$ubicaciones,'contenedores'=>$contenedores,'relarbolasignados'=>$relarbolasignados,		
			'ID__USUARIO'=>$datosResponsable["ID__USUARIO"],'FFEC_FECHAFIN'=>$datosResponsable["FFEC_FECHAFIN"]);
		$this->load->view('inicio_archivo',$datos)
		           ->view('bosque_urbano/eventosAsignacionArbolado/iframe')
		           ->view('fin_archivo');
	}	
	public function IframeAsignacionEtiquetaEvento($id)
	{						
		
		$especies= $this->bosqueurbano_model->get_selectEtiquetasEspeciesDisponibles($id);				
		$reletiquetasasignados=$this->bosqueurbano_model->get_reletiquetasAsignadas($id);

		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcion($id);
		$datos=array('titulo'=>'Eventos de adopcion por asignar','eventos'=>$eventos,'reletiquetasasignados'=>$reletiquetasasignados,'especiesEmpresa'=>$especies);
		$this->load->view('inicio_archivo',$datos)
		           ->view('bosque_urbano/eventosAsignacionArbolado/iframeEtiquetado')
		           ->view('fin_archivo');
	}	
	public function UbicacionesConEspecie()
	{
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		echo JSON_ENCODE($this->bosqueurbano_model->buscar_zona_con_especie($ID__ESPECIE));		
	}
	public function EdadesdeEspecieEnZona()
	{
		//die(print_r($this->input->post()));
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$ID__UBICACION=$this->input->post("ID__UBICACION");		
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		echo JSON_ENCODE($this->bosqueurbano_model->buscar_edades_en_zona_con_especie($ID__ESPECIE,$ID__UBICACION,$ID__EVENTO));		
	}
	public function EdadesdeEspecieEnZonaAdopCiudadana()
	{
		//die(print_r($this->input->post()));
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$ID__UBICACION=$this->input->post("ID__UBICACION");				
		echo JSON_ENCODE($this->bosqueurbano_model->buscar_edades_en_zona_con_especie_Ciudadana($ID__ESPECIE,$ID__UBICACION));		
	}
	public function BusquedaRecipientesConEdadEnZonaEspecie()
	{
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$ID__UBICACION=$this->input->post("ID__UBICACION");	
		$edad=$this->input->post("edad");		
		echo JSON_ENCODE($this->bosqueurbano_model->buscar_recipientes_con_edades_en_zona_con_especie($ID__ESPECIE,$ID__UBICACION,$edad));		
	}
	public function BusquedaInventarioDisponiblesConFiltro()
	{
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$ID__UBICACION=$this->input->post("ID__UBICACION");	
		$edad=$this->input->post("edad");	
		$contenedor_id=$this->input->post("contenedor_id");		
		echo JSON_ENCODE($this->bosqueurbano_model->BusquedaInventarioDisponiblesConFiltro($ID__ESPECIE,$ID__UBICACION,$edad,$contenedor_id));		
	}
	public function AsignaArboladoEvento()
	{	
		$paquete=$this->input->post("paquete");		
		$paquete=JSON_DECODE($paquete);			
		foreach($paquete as $item)
		{								
			$item=json_decode(json_encode($item), true);	
			extract($item);
//echo "<pre>";			die(print_r(get_defined_vars()));
			$this->bosqueurbano_model->AsignarArboladoAEvento($ID__EVENTO,$ID__USUARIO,$FFEC_FECHAFIN,$ID__ESPECIE,$ID__UBICACION,$edad,$contenedor_id,$cantidadAsignar);		
		}
		die("Asignados correctamente");		
	}	
	public function reiniciarAsignacion()
	{	
		$ID__EVENTO=$this->input->post("ID__EVENTO");				
		$this->bosqueurbano_model->reiniciarAsignacion($ID__EVENTO);				
		die("Reiniciado correctamente");		
	}
	
	public function Imprimir()
	{
		$this->load->helper('pdf_helper');

		$id=$_GET["id"];
    	$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignados($id);		
		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcion($id);
  		$CARGADORES=$this->bosqueurbano_model->obtener_personas_cargan_unEvento($id);
  		
  		$relPersonal=$this->bosqueurbano_model->get_RelPersonal($id);
  		$relServicioSocial=$this->bosqueurbano_model->get_RelServicioSocial($id);
  		$relVehiculo=$this->bosqueurbano_model->get_RelVehiculo($id);
  		$relHerramientas=$this->bosqueurbano_model->get_RelHerramientas($id);
  		
  		$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignadosParaFormato($id);
  		$etiquetas=$this->bosqueurbano_model->get_etiquetasEventoSinFiltrar($id);
  		
  		$domicilio=$this->bosqueurbano_model->get_domicilio($id);		
  		
//echo "<pre>"; die(print_r(get_defined_vars()));
		$solicitante=$this->session->userdata["logged_in"]["VCH_NOMBRE"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOPATERNO"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOMATERNO"];

//die(print_r($eventos));
		$data=array('data'=>$eventos[0],'solicitante'=>$solicitante,'cargadores'=>$CARGADORES,'relarbolasignados'=>$relarbolasignados,'relPersonal'=>$relPersonal,'relServicioSocial'=>$relServicioSocial,'relVehiculo'=>$relVehiculo,'relHerramientas'=>$relHerramientas,'etiquetas'=>$etiquetas,'domicilio'=>$domicilio);	

//die(print_r($data));
		$this->load->view('bosque_urbano/pdfadopcion', $data);
	
	}
	public function ImprimirREFOR()
	{
		$this->load->helper('pdf_helper');

		$id=$_GET["id"];
    	$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignados($id);		
		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcion($id);
  		$CARGADORES=$this->bosqueurbano_model->obtener_personas_cargan_unEvento($id);
  		
  		$relPersonal=$this->bosqueurbano_model->get_RelPersonal($id);
  		$relServicioSocial=$this->bosqueurbano_model->get_RelServicioSocial($id);
  		$relVehiculo=$this->bosqueurbano_model->get_RelVehiculo($id);
  		$relHerramientas=$this->bosqueurbano_model->get_RelHerramientas($id);
  		
  		$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignadosParaFormato($id);
  		$etiquetas=$this->bosqueurbano_model->get_etiquetasEvento($id);
  		

	   
		$solicitante=$this->session->userdata["logged_in"]["VCH_NOMBRE"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOPATERNO"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOMATERNO"];
		$data=array('data'=>$eventos[0],'solicitante'=>$solicitante,'cargadores'=>$CARGADORES,'relarbolasignados'=>$relarbolasignados,'relPersonal'=>$relPersonal,'relServicioSocial'=>$relServicioSocial,'relVehiculo'=>$relVehiculo,'relHerramientas'=>$relHerramientas,'etiquetas'=>$etiquetas);	
		$this->load->view('bosque_urbano/pdfREFOR', $data);
	}
	
	public function AsignacionRecursosEvento()
	{				
		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcionCuentaRecursos(null);
		$datos=array('titulo'=>'Asignacion de recursos a evento','eventos'=>$eventos,'menu'=>'Eventos');
		$this->session->set_userdata("SUBMENU",18);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/eventosAsignacionRecursos/Eventos')
		           ->view('fin_archivo');
	}	
	public function IframeAsignacionRecursoEvento($id)
	{				
		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcion($id);
//		die(print_r($eventos));



		$personalASIGNADO= $this->bosqueurbano_model->get_personalAsignadoEvento($id);		
		$vehiculosASIGNADO= $this->bosqueurbano_model->get_vehiculoAsignadoEvento($id);				
		$prestadoresASIGNADO= $this->bosqueurbano_model->get_prestadorAsignadoEvento($id);		
		
		$personal= $this->bosqueurbano_model->get_selectPersonalEvento($id);		
		$vehiculos= $this->bosqueurbano_model->get_selectvehiculoEvento($id);				
		$prestadores= $this->bosqueurbano_model->get_selectprestadorEvento($id);

		$herramientas= $this->bosqueurbano_model->get_selectHerramientaEvento($id);
		
		$especies=$this->bosqueurbano_model->get_especiesAsignadasAeventoInformativo($id);
		
		
		$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignados($id);
		$datos=array('titulo'=>'Eventos por asignar','eventos'=>$eventos,'personal'=>$personal,'vehiculos'=>$vehiculos,'prestadores'=>$prestadores,'personalASIGNADO'=>$personalASIGNADO,'vehiculosASIGNADO'=>$vehiculosASIGNADO,'prestadoresASIGNADO'=>$prestadoresASIGNADO,'VCH_TIPO'=>$eventos[0]["VCH_TIPO"],'herramientas'=>$herramientas,'especies'=>$especies);
		$this->load->view('inicio_archivo',$datos)
		           ->view('bosque_urbano/eventosAsignacionRecursos/iframe')
		           ->view('fin_archivo');
	}	
	
	public function AsignarRecursoEventoVehiculo()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$ID__VEHICULO=$this->input->post("ID__VEHICULO");	

		$this->bosqueurbano_model->AsignarRecursoEventoVehiculo($ID__EVENTO,$ID__VEHICULO);
	}
	public function AsignarRecursoEventoPrestador()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$ID__USUARIO=$this->input->post("ID__USUARIO");	
		$this->bosqueurbano_model->AsignarRecursoEventoPrestador($ID__EVENTO,$ID__USUARIO);
	}
	public function AsignarRecursoEventoSuministro()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$HerSelect=$this->input->post("HerSelect");	
		$canther=$this->input->post("canther");	
		$descher=$this->input->post("descher");	
		$this->bosqueurbano_model->AsignarRecursoEventoHer($ID__EVENTO,$HerSelect,$canther,$descher);
	}
	public function AsignarRecursoEventoPersonal()
	{

		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$ID__USUARIO=$this->input->post("ID__USUARIO");	
		$this->bosqueurbano_model->AsignarRecursoEventoPersonal($ID__EVENTO,$ID__USUARIO);
	}
	
		public function EliminarRecursoEventoPrestador()
	{

		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$ID__USUARIO=$this->input->post("ID__USUARIO");	
		$this->bosqueurbano_model->EliminarRecursoEventoPrestador($ID__EVENTO,$ID__USUARIO);
	}
		public function EliminarRecursoEventoVehiculo()
	{

		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$ID__VEHICULO=$this->input->post("ID__USUARIO");	
		$this->bosqueurbano_model->EliminarRecursoEventoVehiculo($ID__EVENTO,$ID__VEHICULO);
	}
		public function EliminarRecursoEventoPersonal()
	{

		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$ID__USUARIO=$this->input->post("ID__USUARIO");	
		$this->bosqueurbano_model->EliminarRecursoEventoPersonal($ID__EVENTO,$ID__USUARIO);
	}
		public function EliminarRecursoEventoHer()
	{

		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$ID_SUMHER=$this->input->post("ID_SUMHER");	
		$this->bosqueurbano_model->EliminarRecursoEventoHer($ID__EVENTO,$ID_SUMHER);
	}
	
	/* Administracion de etiquetas abajo*/
	public function etiquetas()
	{			
		$etiquetas= $this->bosqueurbano_model->get_etiquetas(null);
		$empresas= $this->bosqueurbano_model->get_Select_empresas();
		$especies = $this->bosqueurbano_model->get_selectEspecies();
		$datos=array('titulo'=>'Administracion de etiquetas','etiquetas'=>$etiquetas,'empresas'=>$empresas,'especies'=>$especies,'menu'=>'Adopciones');
		$this->session->set_userdata("SUBMENU",15);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/Etiquetas/Etiquetas')
		           ->view('fin_archivo');
	}
	public function cargarListaEtiquetas()
	{			
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$VCH_ANIO=$this->input->post("VCH_ANIO");		
		echo JSON_ENCODE($this->bosqueurbano_model->cargarListaEtiquetas($ID__ESPECIE,$ID__EMPRESA,$VCH_ANIO));	
	}
	public function cargarListaEtiquetasDeEvento()
	{			

		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$ID__EVENTO=$this->input->post("ID__EVENTO");		

		
		echo JSON_ENCODE($this->bosqueurbano_model->cargarListaEtiquetasDeEvento($ID__ESPECIE,$ID__EVENTO));	
	}
	public function etiquetasGenerar()
	{
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$VCH_ANIO=$this->input->post("VCH_ANIO");	
		$NUM_CANTIDAD=$this->input->post("NUM_CANTIDAD");					
		$this->bosqueurbano_model->AltaEtiquetas($ID__ESPECIE,$ID__EMPRESA,$VCH_ANIO,$NUM_CANTIDAD);		
	}
	
	public function etiquetasDescontar()
	{
		$VCH_QR=$this->input->post("VCH_QR");		
		$this->bosqueurbano_model->PerdiEtiquetas($VCH_QR);		
	}
	public function etiquetasRecuperar()
	{
		$VCH_QR=$this->input->post("VCH_QR");		
		$this->bosqueurbano_model->EncontreEtiquetas($VCH_QR);		
	}
	public function BusquedaInventarioEtiquetasDisponiblesConFiltro()
	{
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		echo JSON_ENCODE($this->bosqueurbano_model->BusquedaInventarioEtiquetasDisponiblesConFiltro($ID__ESPECIE,$ID__EVENTO));		
	}
	public function AsignarEtiquetasAeventoManual()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");	
		$JSON=$this->input->post("JSON");				
		$this->bosqueurbano_model->AsignaEtiquetasManual($JSON,$ID__EVENTO);		
	}
	
	
	/* Administracion de etiquetas arriba*/
	
	
	public function generaArchivo()
	{		
		if(!is_numeric($this->input->get("id")))
		{
			die("");
		}
		$this->load->helper(array('download', 'file', 'url', 'html', 'form'));						  
				
		$urloffline="./archivos_offline/";
 		//$name="EV-".$this->input->get("id").".exo"; 		
 		$name="EV.exo"; 		
 		$JSONARCHIVO=$this->bosqueurbano_model->generaArchivoOffline($this->input->get("id"));	
 		//die($JSONARCHIVO);
		//file_put_contents ( $urloffline.$name , $JSONARCHIVO );		
		
		//$data = file_get_contents($urloffline.$name); 				
		force_download($name,$JSONARCHIVO); 
		//unlink($urloffline.$name);
	}
	
	public function archivoSalida()
	{
		$this->bosqueurbano_model->planesArchivoImportarAdopcion(24);				
	}
	public function finalizarEvento()
	{		
		//SUBIR ARCHIVO Y/O JSON
		//$JSON='{"ID__EVENTO":24,"etiquetas":[{"ID__ETIQUETA":"715","VCH_QR":"2017-645-000001","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"716","VCH_QR":"2017-645-000002","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"717","VCH_QR":"2017-645-000003","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"718","VCH_QR":"2017-645-000004","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"719","VCH_QR":"2017-645-000005","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"720","VCH_QR":"2017-645-000006","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"721","VCH_QR":"2017-645-000007","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"722","VCH_QR":"2017-645-000008","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"723","VCH_QR":"2017-645-000009","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"724","VCH_QR":"2017-645-000010","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"725","VCH_QR":"2017-645-000011","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"726","VCH_QR":"2017-645-000012","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"727","VCH_QR":"2017-645-000013","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"728","VCH_QR":"2017-645-000014","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"729","VCH_QR":"2017-645-000015","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"730","VCH_QR":"2017-645-000016","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"731","VCH_QR":"2017-645-000017","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"732","VCH_QR":"2017-645-000018","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"733","VCH_QR":"2017-645-000019","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"734","VCH_QR":"2017-645-000020","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"735","VCH_QR":"2017-645-000021","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"736","VCH_QR":"2017-645-000022","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"737","VCH_QR":"2017-645-000023","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"738","VCH_QR":"2017-645-000024","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"739","VCH_QR":"2017-645-000025","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"740","VCH_QR":"2017-645-000026","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"741","VCH_QR":"2017-645-000027","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"742","VCH_QR":"2017-645-000028","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"743","VCH_QR":"2017-645-000029","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"744","VCH_QR":"2017-645-000030","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"745","VCH_QR":"2017-645-000031","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"746","VCH_QR":"2017-645-000032","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"747","VCH_QR":"2017-645-000033","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"748","VCH_QR":"2017-645-000034","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"749","VCH_QR":"2017-645-000035","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"750","VCH_QR":"2017-645-000036","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"751","VCH_QR":"2017-645-000037","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"752","VCH_QR":"2017-645-000038","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"753","VCH_QR":"2017-645-000039","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"754","VCH_QR":"2017-645-000040","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"755","VCH_QR":"2017-645-000041","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"756","VCH_QR":"2017-645-000042","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"757","VCH_QR":"2017-645-000043","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"758","VCH_QR":"2017-645-000044","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"759","VCH_QR":"2017-645-000045","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"760","VCH_QR":"2017-645-000046","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"761","VCH_QR":"2017-645-000047","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"762","VCH_QR":"2017-645-000048","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"763","VCH_QR":"2017-645-000049","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"764","VCH_QR":"2017-645-000050","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"765","VCH_QR":"2017-645-000051","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"766","VCH_QR":"2017-645-000052","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"767","VCH_QR":"2017-645-000053","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"768","VCH_QR":"2017-645-000054","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"769","VCH_QR":"2017-645-000055","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"770","VCH_QR":"2017-645-000056","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"771","VCH_QR":"2017-645-000057","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"772","VCH_QR":"2017-645-000058","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"773","VCH_QR":"2017-645-000059","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"774","VCH_QR":"2017-645-000060","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"775","VCH_QR":"2017-645-000061","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"776","VCH_QR":"2017-645-000062","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"777","VCH_QR":"2017-645-000063","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"778","VCH_QR":"2017-645-000064","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"779","VCH_QR":"2017-645-000065","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"780","VCH_QR":"2017-645-000066","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"781","VCH_QR":"2017-645-000067","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"782","VCH_QR":"2017-645-000068","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"783","VCH_QR":"2017-645-000069","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"784","VCH_QR":"2017-645-000070","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"785","VCH_QR":"2017-645-000071","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"786","VCH_QR":"2017-645-000072","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"787","VCH_QR":"2017-645-000073","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"788","VCH_QR":"2017-645-000074","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"789","VCH_QR":"2017-645-000075","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"790","VCH_QR":"2017-645-000076","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"791","VCH_QR":"2017-645-000077","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"792","VCH_QR":"2017-645-000078","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"793","VCH_QR":"2017-645-000079","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"794","VCH_QR":"2017-645-000080","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"795","VCH_QR":"2017-645-000081","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"796","VCH_QR":"2017-645-000082","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"797","VCH_QR":"2017-645-000083","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"798","VCH_QR":"2017-645-000084","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"799","VCH_QR":"2017-645-000085","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"800","VCH_QR":"2017-645-000086","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"801","VCH_QR":"2017-645-000087","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"802","VCH_QR":"2017-645-000088","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"803","VCH_QR":"2017-645-000089","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"804","VCH_QR":"2017-645-000090","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"805","VCH_QR":"2017-645-000091","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"806","VCH_QR":"2017-645-000092","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"807","VCH_QR":"2017-645-000093","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"808","VCH_QR":"2017-645-000094","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"809","VCH_QR":"2017-645-000095","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"810","VCH_QR":"2017-645-000096","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"811","VCH_QR":"2017-645-000097","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"812","VCH_QR":"2017-645-000098","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":1},{"ID__ETIQUETA":"813","VCH_QR":"2017-645-000099","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0},{"ID__ETIQUETA":"814","VCH_QR":"2017-645-000100","ID__ESPECIE":"645","especie":"Acacia","ID__EMPRESA":"410","empresa":"AON","usada":0}],"adopciones":[{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"nombre de guardabosques","VCH_APELLIDOPATERNO":"apepat","VCH_APELLIDOMATERNO":"apemat","VCH_TELEFONO":"33310000","VCH_CELULAR":"310000","ID__COLONIA":"0","VCH_CALLE":"una calle","VCH_ENTRECALLE":"un entrecalles","VCH_CORREO":"a@a.a"}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}},{"arbol":{"ID__ESPECIE":"645","NUM_EDAD":"1","VCH_CODIGOQR":"2017-645-000002","VCH_CODIGOQRFINAL":"2017-645-000002","NUM_CANTIDAD":"1","VCH_LATITUD":"20.5714541","VCH_LONGITUD":"-103.4779451"},"guardabosque":{"VCH_NOMBRE":"","VCH_APELLIDOPATERNO":"","VCH_APELLIDOMATERNO":"","VCH_TELEFONO":"","VCH_CELULAR":"","ID__COLONIA":"0","VCH_CALLE":"","VCH_ENTRECALLE":"","VCH_CORREO":""}}]}';
		$JSON=$this->input->post('json');
		$this->bosqueurbano_model->FinalizarEvento($JSON);		
		die($JSON);
	}
	public function AdopcionCiudadana()
	{		
		$JSON=$this->input->post('json');
		$ID__GUARDABOSQUE=$this->bosqueurbano_model->RealizarAdopcionCiudadana($JSON);						
		$JSON=JSON_DECODE($JSON,TRUE);
		$JSON["ID__GUARDABOSQUE"]=$ID__GUARDABOSQUE;
		$JSON=JSON_ENCODE($JSON);		
		die($JSON);
	}
	
	
	/*
	public function cargarEventoCatalogo()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$data=$this->bosqueurbano_model->get_precargaEventoCatalogo($ID__EVENTO);	
		echo JSON_ENCODE($data);	
	}
		
	public function altaEventoCatalogo()
	{				
			
		$ID__EVENTO=$this->input->post("ID__EVENTO");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");	
		
		$VCH_TIPO=$this->input->post("VCH_TIPO");			
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$VCH_NOMBREEVENTO=$this->input->post("VCH_NOMBREEVENTO");		
		$VCH_NOMBRELUGAR=$this->input->post("VCH_NOMBRELUGAR");		
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");		
		$NUM_COMPUTADORAS=$this->input->post("NUM_COMPUTADORAS");		
		$NUM_ARBOLESSOLICITADOS=$this->input->post("NUM_ARBOLESSOLICITADOS");				
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");						
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");				
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			if($VCH_ESTATUS=="true")	{	$VCH_ESTATUS=1;	}else{$VCH_ESTATUS=0;}
						
		$ID__COLONIA=$this->input->post("ID__COLONIA");	
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");											


		
		if(empty($VCH_CALLE)){$VCH_CALLE='-';}		if(empty($VCH_ENTRECALLE)){$VCH_ENTRECALLE='-';}

		$ID__DOMICILIO=$this->bosqueurbano_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);									
								
		$this->bosqueurbano_model->alta_catalogoEventos( $VCH_ESTATUS,$VCH_TIPO,$ID__EMPRESA,$ID__DOMICILIO,$VCH_NOMBREEVENTO,
												$VCH_NOMBRELUGAR,$VCH_OBSERVACIONES,$NUM_COMPUTADORAS,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
												$FEC_FECHAFIN);		
		
	}	
	public function editarEventoCatalogo()
	{						
		$ID__EVENTO=$this->input->post("ID__EVENTO");	
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");	
		
		$VCH_TIPO=$this->input->post("VCH_TIPO");			
		$ID__EMPRESA=$this->input->post("ID__EMPRESA");		
		$VCH_NOMBREEVENTO=$this->input->post("VCH_NOMBREEVENTO");		
		$VCH_NOMBRELUGAR=$this->input->post("VCH_NOMBRELUGAR");		
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");		
		$NUM_COMPUTADORAS=$this->input->post("NUM_COMPUTADORAS");		
		$NUM_ARBOLESSOLICITADOS=$this->input->post("NUM_ARBOLESSOLICITADOS");				
		$FEC_FECHAINICIO=$this->input->post("FEC_FECHAINICIO");						
		$FEC_FECHAFIN=$this->input->post("FEC_FECHAFIN");				
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");			if($VCH_ESTATUS=="true")	{	$VCH_ESTATUS=1;	}else{$VCH_ESTATUS=0;}
						
		$ID__COLONIA=$this->input->post("ID__COLONIA");	if(empty($ID__COLONIA)){$ID__COLONIA=0;}
		$VCH_CALLE=$this->input->post("VCH_CALLE");		
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");																				

		if(empty($VCH_CALLE)){$VCH_CALLE='-';}		if(empty($VCH_ENTRECALLE)){$VCH_ENTRECALLE='-';}
		$ID__DOMICILIO=$this->bosqueurbano_model->edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);									
								
		$this->bosqueurbano_model->edita_catalogoEventos( $VCH_ESTATUS,$VCH_TIPO,$ID__EMPRESA,$ID__DOMICILIO,$VCH_NOMBREEVENTO,
												$VCH_NOMBRELUGAR,$VCH_OBSERVACIONES,$NUM_COMPUTADORAS,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
												$FEC_FECHAFIN,$ID__EVENTO);		
	}	
	public function eliminarEventoCatalogo()
	{				
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$this->bosqueurbano_model->delete_EventoCatalogo($ID__EVENTO);	
	}
*/
	/* AsignacionRecursosEvento */
	
	public function traerArboles()
	{			
		$fechaInicio=$this->input->post("fechaInicio");		
		$fechafin=$this->input->post("fechafin");		
		$empresa=$this->input->post("empresa");		
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");				
		$Tipo=$this->input->post("Tipo");		
		echo JSON_ENCODE($this->bosqueurbano_model->traer_ArbolesMapa($fechaInicio,	$fechafin,$empresa,$ID__ESPECIE,$Tipo));			
	}
	
	public function geocercas()
	{		
		$this->load->model('general_model');
		$estados=$this->bosqueurbano_model->get_estadosLiberado();
		$datos=array('titulo'=>'Geocercas','estados'=>$estados);
		
		$datos=array('titulo'=>'Definicion de geocercas','estados'=>$estados,'menu'=>'Configuración');
		$this->session->set_userdata("SUBMENU",10);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/geocercas/catalogoMapaArbol')
		           ->view('fin_archivo',array('mapa'=>true));		           		           	
	}
	
	public function traerGeocercas()
	{		
		$ID__ESTADO=$this->input->post("ID__ESTADO");		
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");		
		echo JSON_ENCODE($this->bosqueurbano_model->get_Geocerca($ID__ESTADO,$ID__MUNICIPIO));	        		           	
	}
	public function crearGeocercas()
	{		
		$ID__ESTADO=$this->input->post("ID__ESTADO");		
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");		
		$arr=$this->input->post("arr");				
		$this->bosqueurbano_model->altaGeocerca($ID__ESTADO,$ID__MUNICIPIO,$arr);	       	
	}
	public function LiberarEVENTO()
	{								 
			$JSON=JSON_DECODE($this->bosqueurbano_model->generaArchivoOffline($this->input->post("idevent")));			
			$JSON = json_decode(json_encode($JSON), true);
						
//			//echo "<pre>";			die(print_r($JSON["arboles"]));			
			if($this->bosqueurbano_model->fechaMayorAfinEvento($JSON["ID__EVENTO"])==0)	  
			 {
				$this->session->set_flashdata('mensaje', 'El evento no debe ser terminado antes de su fecha de termino');		 
				 redirect('bosqueUrbano/CatalogoEventos');	
				 return;
				  
			 }
						
			$this->session->set_flashdata('mensaje', 'El evento fue terminado exitosamente');					
			$inventarioInicial=$JSON["arboles"];		
			$this->bosqueurbano_model->liberarDEevento($inventarioInicial,$JSON["ID__EVENTO"]);	    
			redirect('bosqueUrbano/CatalogoEventos');	
				
	}
	public function ordenSalidaCiudadana()
	{
		$this->load->helper('pdf_helper');
		$JSONSALIDA=json_decode($this->input->post("JSONSALIDA"), true);

		/*$id=0;
    	$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignados($id);		
		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcion($id);*/
  		//$CARGADORES=$this->bosqueurbano_model->obtener_personas_cargan_unEvento($id);
 
			//echo "<pre/>";die(print_r($JSONSALIDA));
		$colonia=$this->bosqueurbano_model->getDatosColoniaOrdenSalida($JSONSALIDA["guardabosque"]["ID__COLONIA"]);
			//echo "<pre/>";die(print_r($colonia));
  		$adopciones=$this->bosqueurbano_model->get_precios_adopcion($JSONSALIDA["adopciones"]);

		$data["ID__EVENTO"]="";
		$data["vehiculodesc"]="";
		$data["vehiculos"]="";
		$data["VCH_NOMBRELUGAR"]="Adopcion En vivero";

		$entrega=$this->session->userdata["logged_in"]["VCH_NOMBRE"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOPATERNO"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOMATERNO"];		
		$solicitante=$JSONSALIDA["guardabosque"]["VCH_APELLIDOPATERNO"]." ".$JSONSALIDA["guardabosque"]["VCH_APELLIDOMATERNO"]." ".$JSONSALIDA["guardabosque"]["VCH_NOMBRE"];
		$data=array('data'=>$data,'solicitante'=>$solicitante,'entrega'=>$entrega, /*'cargadores'=>$CARGADORES,*/'adopciones'=>$adopciones,'JSONSALIDA'=>$JSONSALIDA,'colonia'=>$colonia);	
		$this->load->view('bosque_urbano/pdfadopcionCiudadana', $data);
		
		$view_string = $this->load->view('bosque_urbano/pdfadopcionCiudadana', $data, TRUE);
		file_put_contents($_SERVER["DOCUMENT_ROOT"]."Extra/adopcionviveropdfs/AdopcionVivero_".date('m-d-Y_hia').".pdf", $view_string);
	}
	public function ordenSalidaOnline()
	{
		$this->load->helper('pdf_helper');
		$JSONSALIDA=$this->input->post("JSONSALIDA");
		$id=0;
    	$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignados($id);		
		$eventos= $this->bosqueurbano_model->get_catalogoEventosAdopcion($id);
  		$CARGADORES=$this->bosqueurbano_model->obtener_personas_cargan_unEvento($id);  		  		
  		$relarbolasignados=$this->bosqueurbano_model->get_relarbolasignadosParaFormato($id);
		$solicitante=$this->session->userdata["logged_in"]["VCH_NOMBRE"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOPATERNO"]." ".$this->session->userdata["logged_in"]["VCH_APELLIDOMATERNO"];
		$data=array('data'=>$eventos[0],'solicitante'=>$solicitante,'cargadores'=>$CARGADORES,'relarbolasignados'=>$relarbolasignados);	
		$this->load->view('bosque_urbano/pdfadopcionOnline', $data);
		
		$view_string = $this->load->view('bosque_urbano/pdfadopcionOnline', $data, TRUE);
		file_put_contents($_SERVER["DOCUMENT_ROOT"]."Extra/adopcionOnlinepdf/AdopcionOnline_".date('m-d-Y_hia').".pdf", $view_string);
	}
	
	public function setClaveGuardabosque()
	{
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");		
		$this->bosqueurbano_model->setClaveGuardabosque($ID__GUARDABOSQUE);
	}
	public function setClaveembajador()
	{
		$ID__EMBAJADOR=$this->input->post("ID__EMBAJADOR");		
		$this->bosqueurbano_model->setClaveembajador($ID__EMBAJADOR);
	}
	
	public function AsignarGuardabosqueAembajador()
	{
		$ID__EMBAJADOR=$this->input->post("ID__EMBAJADOR");		
		
		$AsignarAntiguedad=$this->input->post("AsignarAntiguedad");			
		$AsignarPatrocinador=$this->input->post("AsignarPatrocinador");		
		$AsignarEspecie=$this->input->post("AsignarEspecie");			
		$AsignarEstado=$this->input->post("AsignarEstado");		
		$AsignarMunicipio=$this->input->post("AsignarMunicipio");			
		$AsignaColonia=$this->input->post("AsignaColonia");				
		$NUM_CANTIDAD=$this->input->post("NUM_CANTIDAD");		
		
		
		$this->bosqueurbano_model->AsignarGuardabosqueAembajador($ID__EMBAJADOR,$AsignarAntiguedad,$AsignarPatrocinador,$AsignarEspecie,$AsignarEstado,$AsignarMunicipio,$AsignaColonia,$NUM_CANTIDAD);
	}
	public function getAsignados()
	{
		$ID__EMBAJADOR=$this->input->post("ID__EMBAJADOR");		
		$this->bosqueurbano_model->GetGuardabosqueAsignadoAembajador($ID__EMBAJADOR);
	}
	public function EliminarGuardabosqueAsignado()
	{
		$ID__ASIGNACION=$this->input->post("ID__ASIGNACION");		
		$this->bosqueurbano_model->EliminarGuardabosqueAsignado($ID__ASIGNACION);
	}
	
	public function preguntas()
	{
		$ID__CATEGORIA=$this->input->post("ID__CATEGORIA");	
		$misPreguntas=$this->bosqueurbano_model->get_Preguntas($ID__CATEGORIA);		
		$categorias=$this->bosqueurbano_model->get_Categorias();		
		$datos=array('titulo'=>'Mis preguntas','misPreguntas'=>$misPreguntas,'categorias'=>$categorias,'ID__CATEGORIA'=>$ID__CATEGORIA,'menu'=>'Contacto');		
		$this->session->set_userdata("SUBMENU",26);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('bosque_urbano/Preguntas/index')
		           ->view('fin_archivo');
	}
	public function ResponderPregunta()
	{
		$VCH_TEXTO=$this->input->post("VCH_TEXTO");		
		$new_name="";
		$ID__MENSAJE=$this->input->post("ID__MENSAJE");													
		if(!empty($_FILES["VCH_FILE"]["name"]))
		{
			$new_name = time().$_FILES["VCH_FILE"]['name'];
			$new_name =preg_replace('/\s+/', '_', $new_name);
			$config['file_name'] = $new_name;
//			$config['upload_path']          = './uploads/respuestas/';						//			
			$config['upload_path']          = $_SERVER["DOCUMENT_ROOT"]."ExtraGuardabosques/uploads/respuesta/";						

			$config['allowed_types']        = '*';
			$config['max_size']             = 10000;		
			$this->load->library('upload', $config);			
			$VCH_FILE=$_FILES["VCH_FILE"]["name"];
			$this->upload->do_upload('VCH_FILE');
		}
		$this->bosqueurbano_model->ResponderPregunta($VCH_TEXTO,$new_name,$ID__MENSAJE);
		redirect('bosqueUrbano/Preguntas');			
	}

	
	
	public function mail()
	{

		$this->bosqueurbano_model->sendMailGuardabosque2();
	}

	public function FinalizarReforestacion()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");	
		$this->bosqueurbano_model->FinalizarReforestacion($ID__EVENTO);
	}
	
	public function getColonias()
	{
		$this->load->model('general_model');
		$ID__ESTADO=null;
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");
		$VCH_NOMBRE=null;
		$VCH_CODIGOPOSTAL=null;				
		echo JSON_ENCODE($this->general_model->get_colonias($ID__ESTADO,$ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL));	
	}	
	public function getCiudades()
	{
		$this->load->model('general_model');
		$ID__ESTADO=$this->input->post("ID__ESTADO");				
		echo JSON_ENCODE($this->general_model->get_ciudades($ID__ESTADO));	
	}
	public function MarcarPagado()
	{
		$ID__GUARDABOSQUE=$this->input->post("ID__GUARDABOSQUE");				
		$ID__CLAVETALLER=$this->input->post("ID__CLAVETALLER");				
		$this->bosqueurbano_model->MarcarPagado($ID__GUARDABOSQUE,$ID__CLAVETALLER);	
	}	
	public function traerPrecioEdadEspecie()
	{
		$selEspecie=$this->input->post("selEspecie");				
		$selZona=$this->input->post("selZona");				
		$selEdad=$this->input->post("selEdad");				
		$this->bosqueurbano_model->getPrecioEdadEspecie($selEspecie,$selZona,$selEdad);	
	}
	public function AutoGenerarEtiquetasDeEvento()
	{
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");				
		$ID__EVENTO=$this->input->post("ID__EVENTO");				
		$totales=$this->input->post("totales");				
		$this->bosqueurbano_model->AutoGenerarEtiquetasDeEvento($ID__ESPECIE,$ID__EVENTO,$totales);	
	}
	public function AutoAsignarEtiquetasDeEvento()
	{
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");				
		$ID__EVENTO=$this->input->post("ID__EVENTO");				
		$totales=$this->input->post("totales");			
		$this->bosqueurbano_model->AutoAsignarEtiquetasDeEvento($ID__ESPECIE,$ID__EVENTO,$totales);	
	}
	public function EspeciesDeRefor()
	{	
		$ID__EVENTO=$this->input->post("ID__EVENTO");				
		echo JSON_ENCODE($this->bosqueurbano_model->getAsignadosReforestacion($ID__EVENTO));	
	}
	public function ReportarSeguimientoReforesta()
	{
		$ID__EVENTO=$this->input->post("ID__EVENTO");		
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$NUM_VIVOS=$this->input->post("NUM_VIVOS");		
		$NUM_SANOS=$this->input->post("NUM_SANOS");		
		$this->bosqueurbano_model->setAsignadosReforestacion( $ID__EVENTO,$ID__ESPECIE,$NUM_VIVOS,$NUM_SANOS );
	}
	
	
	
}
