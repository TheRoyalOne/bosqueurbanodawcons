<?php
class Administrativo_model extends CI_Model 
{

        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }
        
        /*Perfiles Abajo*/
        public function get_perfiles($perfil = FALSE)
		{
			if ($perfil === FALSE)
			{
					$query = $this->db->get('catconf_001_perfiles');
					return $query->result_array();
			}

			$query = $this->db->get_where('catconf_001_perfiles', array('ID__PERFIL' => $perfil));
			return $query->row_array();
		}		
		public function get_permisos()
		{					
			$query = $this->db->query('select * from catconf_002_permisos order by VCH_MODULO')->result_array();					
			return $query;			
		}		
		public function delete_perfil($ID__PERFIL)
		{				
			$this->db->delete('catconf_001_perfiles', array('ID__PERFIL' => $ID__PERFIL));										
			$sql='delete from catconf_003_perfilespermisos where ID__PERFIL=?';
			$this->db->query($sql,array($ID__PERFIL));					
			echo "Se elimino exitosamente";			
		}	
		public function guardarPerfil($permisos,$ID__PERFIL,$VCH_NOMBRE,$VCH_ESTATUS)	
		{							
			if($VCH_ESTATUS=="true")			{				$VCH_ESTATUS=1;			}
			else								{				$VCH_ESTATUS=0;			}					
			if($ID__PERFIL!=0)
			{
				$sql='update catconf_001_perfiles set VCH_NOMBRE=? ,VCH_ESTATUS=? where ID__PERFIL=?';
				$this->db->query($sql,array($VCH_NOMBRE,$VCH_ESTATUS,$ID__PERFIL));
			}
			else
			{
				$sql='INSERT INTO catconf_001_perfiles (VCH_NOMBRE,VCH_ESTATUS)VALUES(?,?);';
				$this->db->query($sql,array($VCH_NOMBRE,$VCH_ESTATUS));
				$ID__PERFIL=$this->db->insert_id();
				
			}
						
			if($ID__PERFIL!=0)
			{
				$sql='delete from catconf_003_perfilespermisos where ID__PERFIL=?';
				$this->db->query($sql,array($ID__PERFIL));					
			}
			
			foreach ($permisos as $permiso)
			{
				$sql='INSERT INTO catconf_003_perfilespermisos (ID__PERFIL,ID__PERMISO)VALUES(?,?);';
				$this->db->query($sql,array($ID__PERFIL,$permiso));
			}			
			echo "Perfil guardado";
		}		
		public function cargarPerfil($ID__PERFIL)
		{					
			$sql='select ID__PERFIL,VCH_NOMBRE,VCH_ESTATUS from catconf_001_perfiles where ID__PERFIL= ? ';
			$datosperfil=$this->db->query($sql,array($ID__PERFIL))->result_array();
			
			$sql='select ID__PERFIL,ID__PERMISO from catconf_003_perfilespermisos where ID__PERFIL= ? ';
			$permisos=$this->db->query($sql,array($ID__PERFIL))->result_array();
			
			$datosperfil['general']= $datosperfil;
			$datosperfil['Permisos']=$permisos;			
			echo JSON_ENCODE($datosperfil);	
		}							
		/*Perfiles Arriba*/
		
		
		
		
		/*Usuarios Abajo*/
        public function get_usuarios($VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_PUESTO,$VCH_ESTATUS)
		{			
			
			$sql="select `catconf_007_usuarios`.`ID__USUARIO`,
											`catconf_007_usuarios`.`ID__PERFIL`,
											`catconf_007_usuarios`.`VCH_NOMBRE`,
											`catconf_007_usuarios`.`VCH_APELLIDOPATERNO`,
											`catconf_007_usuarios`.`VCH_APELLIDOMATERNO`,
											`catconf_007_usuarios`.`VCH_CORREO`,
											`catconf_007_usuarios`.`VCH_TELEFONO`,
											`catconf_007_usuarios`.`VCH_CELULAR`,
											`catconf_007_usuarios`.`VCH_PUESTO`,
											`catconf_007_usuarios`.`VCH_ESTATUS`,
											`catconf_007_usuarios`.`VCH_USUARIO`,
											`catconf_007_usuarios`.`VCH_PASSWORD`,
											`catconf_007_usuarios`.`VCH_OBSERVACIONES`,
    										`catconf_007_usuarios`.`ID__DOMICILIO` , catconf_001_perfiles.VCH_NOMBRE as perfil
									from catconf_007_usuarios
						inner join 		 catconf_001_perfiles 
									on catconf_007_usuarios.ID__PERFIL=catconf_001_perfiles.ID__PERFIL
									
									where 
									 catconf_007_usuarios.VCH_NOMBRE like '%".$VCH_NOMBRE."%' 
											and VCH_APELLIDOPATERNO like '%".$VCH_APELLIDOPATERNO."%' 
											and VCH_APELLIDOMATERNO like '%".$VCH_APELLIDOMATERNO."%' 
											and VCH_PUESTO like '%".$VCH_PUESTO."%' ";
											
										if($VCH_ESTATUS!=2)
										{	
											$sql.="and catconf_007_usuarios.VCH_ESTATUS	like '%".$VCH_ESTATUS."%' ";
										}	
									  $sql.="order by VCH_APELLIDOPATERNO";									  									  
			$query = $this->db->query($sql)->result_array();					
			return $query;			
		}	
		public function get_estados()
		{					
			$query = $this->db->query('SELECT ID__ESTADO,VCH_NOMBRE from catconf_004_estados order by VCH_NOMBRE')->result_array();					
			return $query;			
		}
		public function get_ciudades($ID__ESTADO)
		{					
			$sql='SELECT `catconf_005_municipios`.`ID__MUNICIPIO`,`catconf_005_municipios`.`VCH_NOMBRE` FROM `catconf_005_municipios` where ID__ESTADO= ? ';
			return ($this->db->query($sql,array($ID__ESTADO))->result_array());	
		}
		public function alta_colonia($ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL)
		{					
			$sql='INSERT INTO catconf_006_colonias (ID__MUNICIPIO,VCH_NOMBRE,VCH_CODIGOPOSTAL) VALUES (?,?,?)';
			$this->db->query($sql,array($ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL));	
		}
		public function get_colonias($ID__ESTADO,$ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL)
		{					
			$sql="SELECT 
				col.VCH_NOMBRE as colonia,col.ID__COLONIA,col.VCH_CODIGOPOSTAL,est.VCH_NOMBRE as estado,muni.VCH_NOMBRE as municipio
				FROM catconf_006_colonias col 
				inner join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				inner join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
				where
				(muni.ID__ESTADO =".$ID__ESTADO." or '".$ID__ESTADO."'='') and  
				(col.VCH_NOMBRE like '%".$VCH_NOMBRE."%' or '".$VCH_NOMBRE."'='' )  and 
				(VCH_CODIGOPOSTAL like '%".$VCH_CODIGOPOSTAL."%' or '".$VCH_CODIGOPOSTAL."'='') and 
				(col.ID__MUNICIPIO ='".$ID__MUNICIPIO."' or '".$ID__MUNICIPIO."'='')
				limit 100;";				
				//die($sql);
			return ($this->db->query($sql)->result_array());	
		}		
		public function alta_Usuario($ID__PERFIL,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_PUESTO,$VCH_ESTATUS,$VCH_USUARIO,$VCH_PASSWORD,$VCH_OBSERVACIONES,$ID__DOMICILIO)
		{						
			$sql="select * from catconf_007_usuarios where VCH_USUARIO=?";					
			$existe=$this->db->query($sql,array($VCH_USUARIO))->result_array();			
			$count=count($existe);
						
			if($count!=0)
			{				
				echo 2;
				return;
			}				
			
			$sql='INSERT INTO catconf_007_usuarios
			(
			ID__PERFIL,VCH_NOMBRE,VCH_APELLIDOPATERNO,VCH_APELLIDOMATERNO,VCH_CORREO,
			VCH_TELEFONO,VCH_CELULAR,VCH_PUESTO,VCH_ESTATUS,VCH_USUARIO,
			VCH_PASSWORD,VCH_OBSERVACIONES,ID__DOMICILIO)
			VALUES
			(?,?,?,?,?,
			?,?,?,?,?,
			?,?,?);';
			
			$this->db->query($sql,array($ID__PERFIL,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,
										$VCH_TELEFONO,$VCH_CELULAR,$VCH_PUESTO,$VCH_ESTATUS,$VCH_USUARIO,
										md5($VCH_PASSWORD),$VCH_OBSERVACIONES,$ID__DOMICILIO));	
			echo 1; //condicion en JS para decirle que todo bien
		}
		public function alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE)
		{								
			$sql='INSERT INTO catconf_008_domicilios(ID__COLONIA,VCH_CALLE,VCH_ENTRECALLE)VALUES(?,?,?)';
			$this->db->query($sql,array($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE));	
			return $this->db->insert_id();
		}
		public function delete_usuario($ID__USUARIO)
		{				
			$this->db->delete('catconf_007_usuarios', array('ID__USUARIO' => $ID__USUARIO));															
			echo "Se elimino exitosamente";			
		}	
		public function cargarUsuario($ID__USUARIO)
		{	
							
			$sql='select ID__PERFIL,
				VCH_NOMBRE,
				VCH_APELLIDOPATERNO,
				VCH_APELLIDOMATERNO,
				VCH_CORREO,
				VCH_TELEFONO,
				VCH_CELULAR,
				VCH_PUESTO,
				VCH_ESTATUS,
				VCH_USUARIO,    
				VCH_OBSERVACIONES,
				us.ID__DOMICILIO ,
				ID__COLONIA,
				VCH_CALLE,
				VCH_ENTRECALLE
				from catconf_007_usuarios us
				left join catconf_008_domicilios dom 
				on us.ID__DOMICILIO= dom.ID__DOMICILIO
				where ID__USUARIO= ? ';				
			$usuario=$this->db->query($sql,array($ID__USUARIO))->result_array()[0];			
			
			echo JSON_ENCODE($usuario);	
		}		
		public function edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE)
		{											
			$sql='update catconf_008_domicilios  set ID__COLONIA=? ,VCH_CALLE=? ,VCH_ENTRECALLE=?  where ID__DOMICILIO=?';
			$this->db->query($sql,array($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE,$ID__DOMICILIO));				
		}		
		public function edita_Usuario($ID__USUARIO,$ID__PERFIL,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_PUESTO,$VCH_ESTATUS,$VCH_USUARIO,$VCH_PASSWORD,$VCH_OBSERVACIONES,$ID__DOMICILIO)
		{						
			//die(print_r(get_defined_vars()));
			$sql="select * from catconf_007_usuarios where VCH_USUARIO=? and ID__USUARIO!=?";					
			$existe=$this->db->query($sql,array($VCH_USUARIO,$ID__USUARIO))->result_array();			
			$count=count($existe);
						
			if($count!=0)
			{				
				echo 2;
				return;
			}				
			
			$sql='update catconf_007_usuarios
			set
			ID__PERFIL=?,VCH_NOMBRE=?,VCH_APELLIDOPATERNO=?,VCH_APELLIDOMATERNO=?,VCH_CORREO=?,
			VCH_TELEFONO=?,VCH_CELULAR=?,VCH_PUESTO=?,VCH_ESTATUS=?,VCH_USUARIO=?,
			VCH_OBSERVACIONES=?,ID__DOMICILIO=? 
			where ID__USUARIO=?';			
			$this->db->query($sql,array($ID__PERFIL,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,
										$VCH_TELEFONO,$VCH_CELULAR,$VCH_PUESTO,$VCH_ESTATUS,$VCH_USUARIO,
										$VCH_OBSERVACIONES,$ID__DOMICILIO,$ID__USUARIO));											
			if(!empty($VCH_PASSWORD))
			{
				$sql='update catconf_007_usuarios
				set	VCH_PASSWORD=?						
				where ID__USUARIO=?';			
				$this->db->query($sql,array(md5($VCH_PASSWORD),$ID__USUARIO));								
			}
			echo 1; //condicion en JS para decirle que todo bien
		}
		/*Usuarios Arriba*/
		
		
		
		
		
		
		
		/*especies abajo*/
		public function get_especies($VCH_NOMBRECOMUN,$VCH_ESTATUS)
		{			
			$sql="SELECT * FROM catconf_009_especies where VCH_NOMBRECOMUN like '%".$VCH_NOMBRECOMUN."%' ";
			if(($VCH_ESTATUS!=2)&&$VCH_ESTATUS!='')
			{
				$sql.="and VCH_ESTATUS=".$VCH_ESTATUS;
			}
			//die($sql);
			return ($this->db->query($sql)->result_array());	
		}
		public function delete_especie($ID__ESPECIE)
		{				
			$this->db->delete('catconf_009_especies', array('ID__ESPECIE' => $ID__ESPECIE));															
			echo "Se elimino exitosamente";			
		}	
		public function cargarEspecie($ID__ESPECIE)
		{	
							
			$sql='SELECT catconf_009_especies.ID__ESPECIE,
					catconf_009_especies.VCH_NOMBRECOMUN,
					catconf_009_especies.VCH_NOMBRECIENTIFICO,
					catconf_009_especies.VCH_ESTATUS,
					catconf_009_especies.VCH_OBSERVACIONES,
					catconf_009_especies.VCH_URLREFERENCIA,
					catconf_009_especies.NUM_PRIMERPERIODO,
					catconf_009_especies.NUM_SEGUNDOPERIODO,
					catconf_009_especies.NUM_TERCERPERIODO,
					catconf_009_especies.NUM_CUARTOPERIODO,
					catconf_009_especies.NUM_INVENTARIO,
					catconf_009_especies.NUM_ADOPCIONES,
					catconf_009_especies.VCH_FOTO
				FROM catconf_009_especies
				where ID__ESPECIE= ? ';				
			$especie=$this->db->query($sql,array($ID__ESPECIE))->result_array()[0];						
			echo JSON_ENCODE($especie);	
		}		
		public function agregarEspecie($VCH_NOMBRECOMUN,$VCH_NOMBRECIENTIFICO,$VCH_ESTATUS,$VCH_OBSERVACIONES,$VCH_URLREFERENCIA,$NUM_PRIMERPERIODO,$NUM_SEGUNDOPERIODO,$NUM_TERCERPERIODO,$NUM_CUARTOPERIODO,$filename)
		{											
			
			$sql='INSERT INTO catconf_009_especies
				(
				VCH_NOMBRECOMUN,VCH_NOMBRECIENTIFICO,VCH_ESTATUS,VCH_OBSERVACIONES,VCH_URLREFERENCIA,
				NUM_PRIMERPERIODO,NUM_SEGUNDOPERIODO,NUM_TERCERPERIODO,NUM_CUARTOPERIODO,NUM_INVENTARIO,
				NUM_ADOPCIONES,VCH_FOTO)
				VALUES
				(?,?,?,?,?,
				?,?,?,?,?,
				?,?)';
			$this->db->query($sql,array($VCH_NOMBRECOMUN,$VCH_NOMBRECIENTIFICO,$VCH_ESTATUS,$VCH_OBSERVACIONES,$VCH_URLREFERENCIA,$NUM_PRIMERPERIODO,$NUM_SEGUNDOPERIODO,$NUM_TERCERPERIODO,$NUM_CUARTOPERIODO,0,0,''));										
			$ID__ESPECIE=$this->db->insert_id();			
			//die($this->db->last_query());	muestra el query compilado
			if(!empty($filename))
			{
				$this->db->query("update catconf_009_especies set VCH_FOTO=? where ID__ESPECIE=? ",array($filename,$ID__ESPECIE));				
			}		
		}	
		public function modificaEspecie($ID__ESPECIE,$VCH_NOMBRECOMUN,$VCH_NOMBRECIENTIFICO,$VCH_ESTATUS,$VCH_OBSERVACIONES,$VCH_URLREFERENCIA,$NUM_PRIMERPERIODO,$NUM_SEGUNDOPERIODO,$NUM_TERCERPERIODO,$NUM_CUARTOPERIODO,$filename)
		{											
			$sql='update catconf_009_especies set 
				VCH_NOMBRECOMUN=?,VCH_NOMBRECIENTIFICO=?,VCH_ESTATUS=?,VCH_OBSERVACIONES=?,VCH_URLREFERENCIA=?,
				NUM_PRIMERPERIODO=?,NUM_SEGUNDOPERIODO=?,NUM_TERCERPERIODO=?,NUM_CUARTOPERIODO=?,NUM_INVENTARIO=?,
				NUM_ADOPCIONES=? where ID__ESPECIE=?';
			$this->db->query($sql,array($VCH_NOMBRECOMUN,$VCH_NOMBRECIENTIFICO,$VCH_ESTATUS,$VCH_OBSERVACIONES,$VCH_URLREFERENCIA,$NUM_PRIMERPERIODO,$NUM_SEGUNDOPERIODO,$NUM_TERCERPERIODO,$NUM_CUARTOPERIODO,0,0,$ID__ESPECIE));				
			if(!empty($filename))
			{
				$this->db->query("update catconf_009_especies set VCH_FOTO=? where ID__ESPECIE=? ",array($filename,$ID__ESPECIE));				
			}
			
		}	
		/*especies arriba*/
}

