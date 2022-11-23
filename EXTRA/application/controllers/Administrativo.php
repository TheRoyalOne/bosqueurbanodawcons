<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrativo extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('administrativo/administrativo_model');		
		$this->load->helper('url_helper');
		
		
		 if ( ! $this->session->userdata('logged_in'))
		{ 			
			redirect('inicio/login');			
		}
	}		
	public function TienePermiso($ID__PERMISO)
	{
		if(in_array($ID__PERMISO,$this->session->userdata('PERMISOS')))
		{
			return true;
		}		
		return false;
	}
	
	 	 
	//perfiles abajo
	public function perfiles()
	{				
		$perfiles = $this->administrativo_model->get_perfiles();		
		$permisos = $this->administrativo_model->get_permisos();														
		$temporalRaiz='';
		$cadenaArbol="[";						
		foreach($permisos as $permiso)
		{
			if($temporalRaiz!=$permiso["VCH_MODULO"])
			{
				if($temporalRaiz!='')
				{
					$cadenaArbol.=
					']},';
				}				
				$temporalRaiz=$permiso["VCH_MODULO"];
				$cadenaArbol.=
						'{   "text": "'.$temporalRaiz.'","state": {"expanded":false}, "nodes":[{"ID__PERMISO":"'.$permiso["ID__PERMISO"].'","text": "'.$permiso["VCH_PERMISO"].'"}';
			}
			else
			{				
				$cadenaArbol.=',{"ID__PERMISO":"'.$permiso["ID__PERMISO"].'","text": "'.$permiso["VCH_PERMISO"].'"}';
			}
		}	
		$cadenaArbol.="]}]";
		$cadenaArbol=json_encode($cadenaArbol);							
		
		
		$datos=array('titulo'=>'Perfiles','perfiles'=>$perfiles,'permisos'=>$cadenaArbol,'menu'=>'Configuración');
		$this->session->set_userdata("SUBMENU",1);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('administrativo/perfiles')
		           ->view('fin_archivo');
	}		
	public function guardarPerfil()
	{		
		$permisos=$this->input->post("permisos");		
		$ID__PERFIL=$this->input->post("ID__PERFIL");		
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");				
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");				
		
		$this->administrativo_model->guardarPerfil($permisos,$ID__PERFIL,$VCH_NOMBRE,$VCH_ESTATUS);	
	}
	public function cargarPerfil()
	{		
		$ID__PERFIL=$this->input->post("ID__PERFIL");				
		$this->administrativo_model->cargarPerfil($ID__PERFIL);	
	}
	public function eliminarPerfil()
	{		
		$ID__PERFIL=$this->input->post("ID__PERFIL");		
		$this->administrativo_model->delete_perfil($ID__PERFIL);	
	}
	//perfiles arriba








	//usuarios abajo
	public function usuarios()
	{			
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");		
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");		
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");		
		$VCH_PUESTO=$this->input->post("VCH_PUESTO");		
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");		
		
		$usuarios = $this->administrativo_model->get_usuarios($VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_PUESTO,$VCH_ESTATUS);					
		
		
		if (!$this->input->is_ajax_request()) 	//Si no es ajax
		{
			$estados = $this->administrativo_model->get_estados();						
			//$colonias = $this->administrativo_model->get_colonias("","","","");			
			//die(print_r($colonias));						
			$perfiles = $this->administrativo_model->get_perfiles();											
			$datos=array('titulo'=>'Usuarios','usuarios'=>$usuarios,'estados'=>$estados,'colonias'=>array(),'perfiles'=>$perfiles,'menu'=>'Configuración');			
			$this->session->set_userdata("SUBMENU",2);
			$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('administrativo/usuarios/usuarios')
		           ->view('fin_archivo');
		}
		else
		{	//Si es ajax... carga solo la vista intermedia
		  $datos=array('titulo'=>'Usuarios','usuarios'=>$usuarios);
		  $this->load->view('administrativo/usuarios/buscarUsuarios',array('usuarios'=>$usuarios));		   			
		}		
	}
	public function getCiudades()
	{
		$ID__ESTADO=$this->input->post("ID__ESTADO");				
		echo JSON_ENCODE($this->administrativo_model->get_ciudades($ID__ESTADO));	
	}
	public function altaColonia()
	{
		$ID__MUNICIPIO	=$this->input->post("ID__MUNICIPIO");				
		$VCH_NOMBRE		=$this->input->post("VCH_NOMBRE");						
		$VCH_CODIGOPOSTAL=$this->input->post("VCH_CODIGOPOSTAL");						
		echo JSON_ENCODE($this->administrativo_model->alta_colonia($ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL));	
	}
	public function buscaColonia()
	{
		$ID__ESTADO=$this->input->post("ID__ESTADO");						
		$ID__MUNICIPIO=$this->input->post("ID__MUNICIPIO");						
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");						
		$VCH_CODIGOPOSTAL=$this->input->post("VCH_CODIGOPOSTAL");					
		$estados = $this->administrativo_model->get_estados();			
		$colonias = $this->administrativo_model->get_colonias($ID__ESTADO,$ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL);				
		$this->load->view('administrativo/usuarios/buscadorColonias',array('colonias'=>$colonias,'estados'=>$estados));				
	}
	public function altaUsuarioPerfil()
	{				
		$ID__USUARIO	=$this->input->post("ID__USUARIO");				
		$ID__PERFIL		=$this->input->post("ID__PERFIL");						
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");								
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");								
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");								
		$VCH_CORREO=$this->input->post("VCH_CORREO");								
		$VCH_TELEFONO=$this->input->post("VCH_TELEFONO");								
		$VCH_CELULAR=$this->input->post("VCH_CELULAR");						
		$VCH_PUESTO=$this->input->post("VCH_PUESTO");								
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");								
		$VCH_USUARIO=$this->input->post("VCH_USUARIO");										
		$VCH_PASSWORD=$this->input->post("VCH_PASSWORD");										
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");					
		
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");
		$VCH_CALLE=$this->input->post("VCH_CALLE");
		$ID__COLONIA=$this->input->post("ID__COLONIA");
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");	//Advertenciam este campo no esta en la vista		
		
		$ID__DOMICILIO=$this->administrativo_model->alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);				
		$this->administrativo_model->alta_Usuario($ID__PERFIL,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_PUESTO,$VCH_ESTATUS,$VCH_USUARIO,$VCH_PASSWORD,$VCH_OBSERVACIONES,$ID__DOMICILIO);	
	}	
	public function eliminarUsuario()
	{				
		$ID__USUARIO=$this->input->post("ID__USUARIO");		
		$this->administrativo_model->delete_usuario($ID__USUARIO);	
	}
	public function cargarUsuario()
	{		
		$ID__USUARIO=$this->input->post("ID__USUARIO");				
		$this->administrativo_model->cargarUsuario($ID__USUARIO);	
	}
	public function editarUsuarioPerfil()
	{				
		$ID__USUARIO	=$this->input->post("ID__USUARIO");				
		$ID__PERFIL		=$this->input->post("ID__PERFIL");						
		$VCH_NOMBRE=$this->input->post("VCH_NOMBRE");								
		$VCH_APELLIDOPATERNO=$this->input->post("VCH_APELLIDOPATERNO");								
		$VCH_APELLIDOMATERNO=$this->input->post("VCH_APELLIDOMATERNO");								
		$VCH_CORREO=$this->input->post("VCH_CORREO");								
		$VCH_TELEFONO=$this->input->post("VCH_TELEFONO");								
		$VCH_CELULAR=$this->input->post("VCH_CELULAR");						
		$VCH_PUESTO=$this->input->post("VCH_PUESTO");								
		$VCH_ESTATUS=$this->input->post("VCH_ESTATUS");								
		$VCH_USUARIO=$this->input->post("VCH_USUARIO");										
		$VCH_PASSWORD=$this->input->post("VCH_PASSWORD");										
		$VCH_OBSERVACIONES=$this->input->post("VCH_OBSERVACIONES");					
		
		$ID__DOMICILIO=$this->input->post("ID__DOMICILIO");
		$VCH_CALLE=$this->input->post("VCH_CALLE");
		$ID__COLONIA=$this->input->post("ID__COLONIA");
		$VCH_ENTRECALLE=$this->input->post("VCH_ENTRECALLE");	//Advertenciam este campo no esta en la vista		
		
		
		$this->administrativo_model->edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);				
		$this->administrativo_model->edita_Usuario($ID__USUARIO,$ID__PERFIL,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_PUESTO,$VCH_ESTATUS,$VCH_USUARIO,$VCH_PASSWORD,$VCH_OBSERVACIONES,$ID__DOMICILIO);	
	}	
	//usuarios arriba







	

	public function especies()
	{
		$VCH_NOMBRECOMUN	=$this->input->post("VCH_NOMBRECOMUN");				
		$VCH_ESTATUS		=$this->input->post("VCH_ESTATUS");
		//die($VCH_ESTATUS);
		if($VCH_ESTATUS=='')
		{
			$VCH_ESTATUS=1;
		}
		//die($VCH_ESTATUS);

		$especies = $this->administrativo_model->get_especies($VCH_NOMBRECOMUN,$VCH_ESTATUS);
		//die(print_r($especies));
		
		$estado = $this->session->flashdata('estado');
		$datos=array('titulo'=>'Especies','especies'=>$especies,'estado'=>$estado,'menu'=>'Configuración');			
		$this->session->set_userdata("SUBMENU",3);
		$this->load->view('inicio_archivo',$datos)
		           ->view('menu')
		           ->view('administrativo/especies/especies')
		           ->view('fin_archivo');
	}
	public function eliminarEspecie()
	{				
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");		
		$this->administrativo_model->delete_especie($ID__ESPECIE);	
	}
	public function cargarEspecie()
	{		
		$ID__ESPECIE=$this->input->post("ID__ESPECIE");				
		$this->administrativo_model->cargarEspecie($ID__ESPECIE);	
	}
	public function altaEspecie()
	{				
		$filename="";		
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
	
		$VCH_NOMBRECOMUN=$this->input->post("form_VCH_NOMBRECOMUN");						
		$VCH_NOMBRECIENTIFICO=$this->input->post("form_VCH_NOMBRECIENTIFICO");						
		$VCH_ESTATUS=$this->input->post("optradio");						
		$VCH_OBSERVACIONES=$this->input->post("form_VCH_OBSERVACIONES");						
		$VCH_URLREFERENCIA=$this->input->post("form_VCH_URLREFERENCIA");																			
		$NUM_PRIMERPERIODO=$this->input->post("form_NUM_PRIMERPERIODO");						
		$NUM_SEGUNDOPERIODO=$this->input->post("form_NUM_SEGUNDOPERIODO");						
		$NUM_TERCERPERIODO=$this->input->post("form_NUM_TERCERPERIODO");						
		$NUM_CUARTOPERIODO=$this->input->post("form_NUM_CUARTOPERIODO");			
		$ID__ESPECIE=$this->input->post("idEspecie");								
		$this->administrativo_model->agregarEspecie($VCH_NOMBRECOMUN,$VCH_NOMBRECIENTIFICO,$VCH_ESTATUS,$VCH_OBSERVACIONES,$VCH_URLREFERENCIA,$NUM_PRIMERPERIODO,$NUM_SEGUNDOPERIODO,$NUM_TERCERPERIODO,$NUM_CUARTOPERIODO,$filename);						
		$this->session->set_flashdata('estado', 'Se guardo exitosamente');
		redirect('administrativo/especies', 'refresh');
	}
	public function editarEspecie()
	{						
		$filename="";		
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

		$VCH_NOMBRECOMUN=$this->input->post("form_VCH_NOMBRECOMUN");						
		$VCH_NOMBRECIENTIFICO=$this->input->post("form_VCH_NOMBRECIENTIFICO");						
		$VCH_ESTATUS=$this->input->post("optradio");						
		$VCH_OBSERVACIONES=$this->input->post("form_VCH_OBSERVACIONES");						
		$VCH_URLREFERENCIA=$this->input->post("form_VCH_URLREFERENCIA");																			
		$NUM_PRIMERPERIODO=$this->input->post("form_NUM_PRIMERPERIODO");						
		$NUM_SEGUNDOPERIODO=$this->input->post("form_NUM_SEGUNDOPERIODO");						
		$NUM_TERCERPERIODO=$this->input->post("form_NUM_TERCERPERIODO");						
		$NUM_CUARTOPERIODO=$this->input->post("form_NUM_CUARTOPERIODO");			
		$ID__ESPECIE=$this->input->post("idEspecie");											
		$this->administrativo_model->modificaEspecie($ID__ESPECIE,$VCH_NOMBRECOMUN,$VCH_NOMBRECIENTIFICO,$VCH_ESTATUS,$VCH_OBSERVACIONES,$VCH_URLREFERENCIA,$NUM_PRIMERPERIODO,$NUM_SEGUNDOPERIODO,$NUM_TERCERPERIODO,$NUM_CUARTOPERIODO,$filename);	
		$this->session->set_flashdata('estado', 'Se guardo exitosamente');		
		redirect('administrativo/especies', 'refresh');
	}
}
