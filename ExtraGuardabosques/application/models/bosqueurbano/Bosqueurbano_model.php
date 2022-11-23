<?php
class Bosqueurbano_model extends CI_Model 
{
		/* Lo que hice, lo hice sin elección... en el nombre de la paz y la cordura Pero no en el nombre del Doctor*/
        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }
        
        public function alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE)
		{								
			$sql='INSERT INTO catconf_008_domicilios(ID__COLONIA,VCH_CALLE,VCH_ENTRECALLE)VALUES(?,?,?)';
			$this->db->query($sql,array($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE));	
			return $this->db->insert_id();
		}
        public function edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE)
		{											
			$sql='update catconf_008_domicilios  set ID__COLONIA=? ,VCH_CALLE=? ,VCH_ENTRECALLE=?  where ID__DOMICILIO=?';
			$this->db->query($sql,array($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE,$ID__DOMICILIO));				
		}	
        
        
        
        
        /*embajadores abajo*/        
        public function get_embajadores($VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$VCH_NOMBRECOLONIA,$VCH_ESTATUS,$ID__INSTITUCION,$VCH_TIPO)
		{						
			$sql="SELECT emb.ID__EMBAJADOR,					emb.ID__INSTITUCION,					emb.ID__DOMICILIO,					emb.VCH_NOMBRE,				
					emb.VCH_APELLIDOPATERNO,				emb.VCH_APELLIDOMATERNO,					emb.VCH_TELEFONO,					emb.VCH_CELULAR,					
					emb.VCH_CORREO,						emb.VCH_TIPO,					emb.VCH_NUMGAFETE,					emb.VCH_SEMESTRE,					
					emb.VCH_CARRERA,					emb.FEC_FECHAINICIO,					emb.FEC_FECHAFIN,					emb.VCH_PASSWORD,					
					emb.VCH_ESTATUS,					inst.VCH_NOMBRE as institucion,					muni.VCH_NOMBRE as municipio,					
					col.VCH_NOMBRE as colonia		, col.VCH_CODIGOPOSTAL	, dom.VCH_CALLE , est.VCH_NOMBRE as estado
					
				FROM catconf_019_embajadores emb left join catconf_018_institucion inst on emb.ID__INSTITUCION=inst.ID__INSTITUCION
				left join catconf_008_domicilios dom on emb.ID__DOMICILIO=dom.ID__DOMICILIO
				left join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
				where emb.VCH_NOMBRE like '%".$VCH_NOMBRE."%' 
				and emb.VCH_APELLIDOPATERNO like '%".$VCH_APELLIDOPATERNO."%' 
				and emb.VCH_APELLIDOMATERNO like '%".$VCH_APELLIDOMATERNO."%' 
				and emb.VCH_CORREO like '%".$VCH_CORREO."%' ";
				
				if($VCH_NOMBRECOLONIA!="")
				{
					$sql.="and col.VCH_NOMBRE like  '%".$VCH_NOMBRECOLONIA."%'"; 
				}
			
				if($ID__INSTITUCION!='')
				{				
					$sql.=" and emb.ID__INSTITUCION ='".$ID__INSTITUCION."'";
				}
				if(($VCH_TIPO!=2)&&($VCH_TIPO!=''))
				{	
					$sql.=" and VCH_TIPO	= ".$VCH_TIPO;
				}	
				if(($VCH_ESTATUS!=2)&&($VCH_ESTATUS!=''))
				{	
					$sql.=" and VCH_ESTATUS= ".$VCH_ESTATUS;
				}	
				$sql.=" order by VCH_APELLIDOPATERNO";									  									  
				$query = $this->db->query($sql)->result_array();		
			//die($this->db->last_query());			
			return $query;			
		}	
		public function get_instituciones()
		{					
			$query = $this->db->query('SELECT ID__INSTITUCION,VCH_NOMBRE from catconf_018_institucion order by VCH_NOMBRE')->result_array();					
			return $query;			
		}		
		public function delete_embajador($ID__EMBAJADOR)
		{				
			$this->db->delete('catconf_019_embajadores', array('ID__EMBAJADOR' => $ID__EMBAJADOR));															
			echo "Se elimino exitosamente";			
		}	
		public function cargar_embajador($ID__EMBAJADOR)
		{				
			$sql="SELECT emb.ID__EMBAJADOR ,
						emb.ID__INSTITUCION ,
						emb.ID__DOMICILIO ,
						emb.VCH_NOMBRE ,
						emb.VCH_APELLIDOPATERNO ,
						emb.VCH_APELLIDOMATERNO,
						emb.VCH_TELEFONO,
						emb.VCH_CELULAR,
						emb.VCH_CORREO,
						emb.VCH_TIPO,
						emb.VCH_NUMGAFETE,
						emb.VCH_SEMESTRE,
						emb.VCH_CARRERA,
						emb.FEC_FECHAINICIO,
						emb.FEC_FECHAFIN,    
						emb.VCH_ESTATUS,
						dom.VCH_CALLE,
						dom.VCH_ENTRECALLE,
						col.VCH_NOMBRE as colonia,
						col.ID__COLONIA,
						col.VCH_CODIGOPOSTAL,
						muni.VCH_NOMBRE as municipio,
						est.VCH_NOMBRE as estado
					FROM catconf_019_embajadores emb left join 
				catconf_008_domicilios dom on emb.ID__DOMICILIO=dom.ID__DOMICILIO
				left join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO 
				left join catconf_004_estados est on est.ID__ESTADO=muni.ID__ESTADO
					
				
				where ID__EMBAJADOR=?";
			return $this->db->query($sql,array($ID__EMBAJADOR))->result_array()[0];	
		}	
				
		public function alta_embajador($ID__EMBAJADOR,$ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,
													$VCH_APELLIDOMATERNO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO,$VCH_TIPO,
													$VCH_NUMGAFETE,$VCH_SEMESTRE,$VCH_CARRERA,$FEC_FECHAINICIO,$FEC_FECHAFIN,
													$VCH_ESTATUS)
		{														
			$sql='INSERT INTO catconf_019_embajadores
			(ID__INSTITUCION,ID__DOMICILIO,	VCH_NOMBRE,	VCH_APELLIDOPATERNO,VCH_APELLIDOMATERNO,
			VCH_TELEFONO,VCH_CELULAR,VCH_CORREO,VCH_TIPO,VCH_NUMGAFETE,
			VCH_SEMESTRE,VCH_CARRERA,FEC_FECHAINICIO,FEC_FECHAFIN,VCH_ESTATUS)
			VALUES
			(?,?,?,?,?,
			 ?,?,?,?,?,
			 ?,?,?,?,?)';			 
			
			$date1 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAINICIO);
			//$date1->format('Y-m-d');
			$date2 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAFIN);
			//$date2->format('Y-m-d');
			
			$this->db->query($sql,
								 array($ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,
										$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO,$VCH_TIPO,$VCH_NUMGAFETE,
										$VCH_SEMESTRE,$VCH_CARRERA,$date1->format('Y-m-d'),$date2->format('Y-m-d'),$VCH_ESTATUS)
							);	
			echo "Guardado exitosamente";
		}
		
		public function edita_embajador($ID__EMBAJADOR,$ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,
													$VCH_APELLIDOMATERNO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO,$VCH_TIPO,
													$VCH_NUMGAFETE,$VCH_SEMESTRE,$VCH_CARRERA,$FEC_FECHAINICIO,$FEC_FECHAFIN,
													$VCH_ESTATUS)
		{														
			$sql='UPDATE catconf_019_embajadores
					SET

					ID__INSTITUCION = ?,					
					VCH_NOMBRE = ?,
					VCH_APELLIDOPATERNO = ?,
					VCH_APELLIDOMATERNO = ?,
					VCH_TELEFONO = ?,
					VCH_CELULAR = ?,
					VCH_CORREO = ?,
					VCH_TIPO = ?,
					VCH_NUMGAFETE = ?,
					VCH_SEMESTRE = ?,
					VCH_CARRERA = ?,
					FEC_FECHAINICIO = ?,
					FEC_FECHAFIN = ?,					
					VCH_ESTATUS = ?
					WHERE ID__EMBAJADOR = ?';			 
			
			
			$date1 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAINICIO);			
			//$date1->format('Y-m-d');
			$date2 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAFIN);
			//$date2->format('Y-m-d');
			
			$this->db->query($sql,
								 array($ID__INSTITUCION,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,
										$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO,$VCH_TIPO,$VCH_NUMGAFETE,
										$VCH_SEMESTRE,$VCH_CARRERA,$date1->format('Y-m-d'),$date2->format('Y-m-d'),$VCH_ESTATUS,$ID__EMBAJADOR)
							);	
			echo "Guardado exitosamente";
		}		
		public function importacion($data)
		{
			extract($data);	
			//echo "<pre>";die(print_r(get_defined_vars()));
			
			if($VCH_TIPO=="técnico")
				$VCH_TIPO=1;
			else
				$VCH_TIPO=0;
			$date1 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAINICIO);						
			$date2 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAFIN);
			
			$sql="INSERT INTO catconf_019_embajadores
					(ID__INSTITUCION,ID__DOMICILIO,	VCH_NOMBRE,	VCH_APELLIDOPATERNO,VCH_APELLIDOMATERNO,
					VCH_TELEFONO,VCH_CELULAR,VCH_CORREO,VCH_TIPO,VCH_NUMGAFETE,
					VCH_SEMESTRE,VCH_CARRERA,FEC_FECHAINICIO,FEC_FECHAFIN,VCH_ESTATUS)
					VALUES
					(?,0,?,?,?,
					?,?,?,?,( select max(VCH_NUMGAFETE)+1 from catconf_019_embajadores emb ),
					?,?,?,?,0)";
					//die($sql);
			$this->db->query($sql,
								 array($ID__INSTITUCION,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,
										$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO,$VCH_TIPO,
										$VCH_SEMESTRE,$VCH_CARRERA,$date1->format('Y-m-d'),$date2->format('Y-m-d'))
							);								
			//echo "Guardado exitosamente";
		}		
        /*embajadores arriba*/
        
        
        
        
        
        /*guardabosques abajo*/
        public function get_guardabosques($VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_CORREO,$estado,$ciudad,$colonia,$VCH_CODIGOPOSTAL,$VCH_CALLE)
		{						
			$sql="SELECT guarda.ID__GUARDABOSQUE,
					guarda.ID__DOMICILIO,
					guarda.VCH_NOMBRE,
					guarda.VCH_APELLIDOPATERNO,
					guarda.VCH_APELLIDOMATERNO,
					guarda.VCH_TELEFONO,
					guarda.VCH_CELULAR,
					guarda.VCH_CORREO,
					est.VCH_NOMBRE as estado,
					muni.VCH_NOMBRE as municipio,
					col.VCH_NOMBRE as colonia,
					VCH_CODIGOPOSTAL,
					VCH_CALLE,
					VCH_ENTRECALLE    
				FROM catconf_012_guardabosques guarda
				left join catconf_008_domicilios dom on guarda.ID__DOMICILIO=dom.ID__DOMICILIO
				inner join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO

				where guarda.VCH_NOMBRE like '%".$VCH_NOMBRE."%' 
				and guarda.VCH_APELLIDOPATERNO like '%".$VCH_APELLIDOPATERNO."%' 
				and guarda.VCH_APELLIDOMATERNO like '%".$VCH_APELLIDOMATERNO."%' 
				and guarda.VCH_CORREO like '%".$VCH_CORREO."%' ";										
				if($estado!='')
				{				
					
					$sql.=" and muni.ID__ESTADO= ".$estado;
				}
				if($ciudad!='')
				{				
					
					$sql.=" and muni.ID__MUNICIPIO =".$ciudad;
				}							
				$sql.=" and col.VCH_NOMBRE like  '%".$colonia."%'
				and col.VCH_CODIGOPOSTAL like  '%".$VCH_CODIGOPOSTAL."%' 
				and dom.VCH_CALLE like  '%".$VCH_CALLE."%'"; 								
				$sql.=" order by VCH_APELLIDOPATERNO limit 100";									  									  
				$query = $this->db->query($sql)->result_array();				
				//die($this->db->last_query());	
			return $query;			
		}	        
		public function cargar_guardabosque($ID__GUARDABOSQUE)
		{				
			$sql="SELECT guarda.ID__GUARDABOSQUE,
					guarda.ID__DOMICILIO,
					guarda.VCH_NOMBRE,
					guarda.VCH_APELLIDOPATERNO,
					guarda.VCH_APELLIDOMATERNO,
					guarda.VCH_TELEFONO,
					guarda.VCH_CELULAR,
					guarda.VCH_CORREO,
					est.VCH_NOMBRE as estado,
					muni.VCH_NOMBRE as municipio,
					col.VCH_NOMBRE as colonia,
					col.ID__COLONIA,
					VCH_CODIGOPOSTAL,
					VCH_CALLE,
					VCH_ENTRECALLE    
				FROM catconf_012_guardabosques guarda
				left join catconf_008_domicilios dom on guarda.ID__DOMICILIO=dom.ID__DOMICILIO
				inner join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
				
				where ID__GUARDABOSQUE=?";
			return $this->db->query($sql,array($ID__GUARDABOSQUE))->result_array()[0];	
		}	
		public function alta_guardabosque($ID__GUARDABOSQUE,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO
										  ,$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO )
		{														
			$sql='INSERT INTO catconf_012_guardabosques
				(ID__DOMICILIO,VCH_NOMBRE,VCH_APELLIDOPATERNO,VCH_APELLIDOMATERNO,VCH_TELEFONO,
				VCH_CELULAR,VCH_CORREO)
				VALUES
				(?,?,?,?,?,
				?,?)';			 			
			$this->db->query($sql,
								 array($ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,
										$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO));	
			echo "Guardado exitosamente";
		}
		public function edita_guardabosque($ID__GUARDABOSQUE,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO
										  ,$VCH_TELEFONO,$VCH_CELULAR,$VCH_CORREO )
		{														
			$sql='update catconf_012_guardabosques set 
				VCH_NOMBRE=?, VCH_APELLIDOPATERNO=?,VCH_APELLIDOMATERNO=?,VCH_TELEFONO=?,VCH_CELULAR=?,
				VCH_CORREO=? where ID__GUARDABOSQUE=?';			 			
			$this->db->query($sql,
								 array($VCH_NOMBRE,$VCH_APELLIDOPATERNO,$VCH_APELLIDOMATERNO,$VCH_TELEFONO,$VCH_CELULAR,
								 $VCH_CORREO,$ID__GUARDABOSQUE));				
			echo "Guardado exitosamente";
		}
		public function delete_guardabosques($ID__GUARDABOSQUE)
		{				
			$this->db->delete('catconf_012_guardabosques', array('ID__GUARDABOSQUE' => $ID__GUARDABOSQUE));															
			echo "Se elimino exitosamente";			
		}	
        /*guardabosques arriba*/
        
        
        /* empresas institucion abajo */
        public function get_empresas($VCH_NOMBRE,$VCH_RFC,$VCH_GIROEMPRESA,$VCH_PERSONACONTACTO)
		{						
			$sql="SELECT 				emp.ID__EMPRESA,
					emp.ID__DOMICILIO,
					emp.VCH_NOMBREEMPRESA,
					emp.VCH_RFC,
					emp.VCH_PERSONACONTACTO,
					emp.VCH_PUESTOCONTACTO,
					emp.VCH_GIROEMPRESA,
					emp.VCH_CORREO,
					emp.VCH_TELEFONO,
					emp.VCH_CELULAR,
					emp.VCH_COMENTARIOS,
					emp.NUM_EMPLEADOS,					
					emp.VCH_LOGO,
                    est.VCH_NOMBRE as estado,
                    muni.VCH_NOMBRE as municipio,
                    col.ID__COLONIA,
                    col.VCH_NOMBRE as colonia,
                    col.VCH_CODIGOPOSTAL,
                    dom.VCH_CALLE,
                    dom.VCH_ENTRECALLE
				FROM catconf_013_empresa emp			
				left join catconf_008_domicilios dom on emp.ID__DOMICILIO=dom.ID__DOMICILIO
				left join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO

				where emp.VCH_NOMBREEMPRESA like '%".$VCH_NOMBRE."%' and
				emp.VCH_RFC like '%".$VCH_RFC."%' ";
				
				if($VCH_GIROEMPRESA!='')
				{				
					
					$sql.=" and emp.VCH_GIROEMPRESA = ".$VCH_GIROEMPRESA;
				}								
				$sql.=" and emp.VCH_PERSONACONTACTO like '%".$VCH_PERSONACONTACTO."%' ";														
				$sql.=" order by VCH_NOMBREEMPRESA limit 100";									  									  
				$query = $this->db->query($sql)->result_array();				
				//die($this->db->last_query());	
			return $query;			
		}	      
		
		public function alta_EmpresaInstitucion($ID__DOMICILIO,$VCH_NOMBREEMPRESA,$VCH_RFC,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,
									  $VCH_CORREO,$VCH_TELEFONO,$VCH_GIROEMPRESA,$VCH_CELULAR,$NUM_EMPLEADOS,$VCH_COMENTARIOS,
									  $logo)
		{
			$sql=" INSERT INTO catconf_013_empresa 
							(ID__DOMICILIO,VCH_NOMBREEMPRESA,VCH_RFC,VCH_PERSONACONTACTO,VCH_PUESTOCONTACTO,
							VCH_GIROEMPRESA,VCH_CORREO,VCH_TELEFONO,VCH_CELULAR,VCH_COMENTARIOS,
							NUM_EMPLEADOS,VCH_LOGO)
					VALUES
							(?,?,?,?,?,
							?,?,?,?,?,
							?,?);";									  									  
			$query = $this->db->query($sql, array($ID__DOMICILIO,$VCH_NOMBREEMPRESA,$VCH_RFC,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,
											$VCH_GIROEMPRESA,$VCH_CORREO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_COMENTARIOS,
											$NUM_EMPLEADOS,$logo));			
			return $this->db->insert_id();
		}
		
		public function alta_patrocinio($empresa_id,$ID__PATROCINIO,$NUM_CANTIDAD,$FEC_FECHAINICIO,$FEC_FECHAFIN)
		{
			

			$FEC_FECHAINICIO = DateTime::createFromFormat('d/m/Y', $FEC_FECHAINICIO);			
			$FEC_FECHAFIN = DateTime::createFromFormat('d/m/Y', $FEC_FECHAFIN);			
			$sql=" INSERT INTO catconf_014_patrociniosempresa
					(ID__EMPRESA,ID__PATROCINIO,NUM_CANTIDAD,FEC_FECHAINICIO,FEC_FECHAFIN)
					VALUES
					(?,?,?,?,?);";									  									  
			$query = $this->db->query($sql, array($empresa_id,$ID__PATROCINIO,$NUM_CANTIDAD,$FEC_FECHAINICIO->format('Y-m-d'),$FEC_FECHAFIN->format('Y-m-d')));			
			return $this->db->insert_id();
		}
		public function alta_donacion($empresa_id,$VCH_DONACIONPERIODICA,$VCH_TIPOPERIODO,
									$VCH_FORMAPAGO,$NUM_TOTALDONACION,$FEC_FECHAINICIO,
									$FEC_FECHAFIN,$VCH_OTROTIPO)
		{
			$FEC_FECHAINICIO = DateTime::createFromFormat('d/m/Y', $FEC_FECHAINICIO);			
			$FEC_FECHAFIN = DateTime::createFromFormat('d/m/Y', $FEC_FECHAFIN);			
			$sql=" INSERT INTO catconf_015_donacionesempresa
					(
					ID__EMPRESA,VCH_DONACIONPERIODICA,VCH_TIPOPERIODO,VCH_FORMAPAGO,NUM_TOTALDONACION,
					FEC_FECHAINICIO,FEC_FECHAFIN,VCH_OTROTIPO)
					VALUES
					(?,?,?,?,?
					,?,?,?);
					";									  									  
			$query = $this->db->query($sql, array($empresa_id,$VCH_DONACIONPERIODICA,$VCH_TIPOPERIODO,$VCH_FORMAPAGO,$NUM_TOTALDONACION,
									$FEC_FECHAINICIO->format('Y-m-d'),$FEC_FECHAFIN->format('Y-m-d'),$VCH_OTROTIPO));			
			return $this->db->insert_id();
		}
		public function alta_seguimiento($empresa_id,$ID__USUARIO,$VCH_ACUERDOS,$VCH_TIPO,$FEC_FECHA)
		{
			$FEC_FECHA = DateTime::createFromFormat('d/m/Y', $FEC_FECHA);			

			$sql=" INSERT INTO catconf_016_seguimientoempresa
					(ID__EMPRESA,ID__USUARIO,VCH_ACUERDOS,VCH_TIPO,FEC_FECHA)
					VALUES
					(?,?,?,?,?);";									  									  
			$query = $this->db->query($sql, array($empresa_id,$ID__USUARIO,$VCH_ACUERDOS,$VCH_TIPO,$FEC_FECHA->format('Y-m-d')));			
			return $this->db->insert_id();
		}
		
		public function get_patrocinios()
		{						
			$sql="SELECT catconf_033_patrocinios.ID__PATROCINIO,
						catconf_033_patrocinios.VCH_TIPO    
					FROM catconf_033_patrocinios;";									  									  
				$query = $this->db->query($sql)->result_array();				
			return $query;			
		}	     
		public function get_responsables()
		{						
			$sql='		select 				ID__USUARIO ,concat(VCH_NOMBRE," ",VCH_APELLIDOPATERNO," ",VCH_APELLIDOMATERNO) as VCH_NOMBRE				 from catconf_007_usuarios';									  									  
				$query = $this->db->query($sql)->result_array();				
			return $query;			
		}	     
		public function get_precargaEmpresa($ID__EMPRESA)
		{						
			$sql='SELECT emp.ID__EMPRESA,    emp.ID__DOMICILIO,    emp.VCH_NOMBREEMPRESA,    emp.VCH_RFC,    emp.VCH_PERSONACONTACTO,
				emp.VCH_PUESTOCONTACTO,    emp.VCH_GIROEMPRESA,    emp.VCH_CORREO,    emp.VCH_TELEFONO,    emp.VCH_CELULAR,
				emp.VCH_COMENTARIOS,    emp.NUM_EMPLEADOS,    emp.VCH_CONTRASENA,    emp.VCH_LOGO,
                    est.VCH_NOMBRE as estado,
                    muni.VCH_NOMBRE as municipio,
                    col.ID__COLONIA,
                    col.VCH_NOMBRE as colonia,
                    col.VCH_CODIGOPOSTAL,
                    dom.VCH_CALLE,
                    dom.VCH_ENTRECALLE FROM catconf_013_empresa
				emp			
				left join catconf_008_domicilios dom on emp.ID__DOMICILIO=dom.ID__DOMICILIO
				inner join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
				where ID__EMPRESA=?
				';									  									  
				$query = $this->db->query($sql,array($ID__EMPRESA))->result_array();				
			return $query;			
		}	     
		public function get_precargaPatrocinio($ID__EMPRESA)
		{						
			$sql='
SELECT catconf_014_patrociniosempresa.ID__DATA,    catconf_014_patrociniosempresa.ID__EMPRESA,    catconf_014_patrociniosempresa.ID__PATROCINIO,    catconf_014_patrociniosempresa.NUM_CANTIDAD,    
	   catconf_014_patrociniosempresa.FEC_FECHAINICIO,    catconf_014_patrociniosempresa.FEC_FECHAFIN 
      ,catconf_033_patrocinios.VCH_TIPO  as ID_textoPatrocinio
		FROM catconf_014_patrociniosempresa
		left join catconf_033_patrocinios on catconf_014_patrociniosempresa.ID__PATROCINIO=catconf_033_patrocinios.ID__PATROCINIO
							where ID__EMPRESA=?
			';									  									  
				$query = $this->db->query($sql,array($ID__EMPRESA))->result_array();				
			return $query;			
		}	     
		public function get_precargaDonacion($ID__EMPRESA)
		{						
			$sql='SELECT catconf_015_donacionesempresa.ID__DONACION,
					catconf_015_donacionesempresa.ID__EMPRESA,
					catconf_015_donacionesempresa.VCH_DONACIONPERIODICA,
					catconf_015_donacionesempresa.VCH_TIPOPERIODO,
					catconf_015_donacionesempresa.VCH_FORMAPAGO,
					catconf_015_donacionesempresa.NUM_TOTALDONACION,
					catconf_015_donacionesempresa.FEC_FECHAINICIO,
					catconf_015_donacionesempresa.FEC_FECHAFIN,
					catconf_015_donacionesempresa.VCH_OTROTIPO
				FROM catconf_015_donacionesempresa
							where ID__EMPRESA=?
			';									  									  
				$query = $this->db->query($sql,array($ID__EMPRESA))->result_array();				
			return $query;			
		}	     
		
		public function get_precargaSeguimiento($ID__EMPRESA)
		{						
			$sql='SELECT catconf_016_seguimientoempresa.ID__SEGUIMIENTO,    catconf_016_seguimientoempresa.ID__USUARIO,   
				catconf_016_seguimientoempresa.ID__EMPRESA,    catconf_016_seguimientoempresa.VCH_ACUERDOS,
				 catconf_016_seguimientoempresa.VCH_TIPO,    catconf_016_seguimientoempresa.FEC_FECHA, concat (VCH_NOMBRE," ",VCH_APELLIDOPATERNO," ",VCH_APELLIDOMATERNO) as responsable
                 FROM catconf_016_seguimientoempresa
                 left join catconf_007_usuarios on catconf_016_seguimientoempresa.id__usuario=catconf_007_usuarios.id__usuario
				 where ID__EMPRESA=?
			';									  									  
				$query = $this->db->query($sql,array($ID__EMPRESA))->result_array();				
			return $query;			
		}	     
		
		public function limpia_patrocinios($empresa_id)
		{
			$sql=" delete from catconf_014_patrociniosempresa where ID__EMPRESA=?";									  									  
			$query = $this->db->query($sql, array($empresa_id));			
		}
		
		public function limpia_donaciones($empresa_id)
		{
			$sql=" delete from catconf_015_donacionesempresa where ID__EMPRESA=?";									  									  
			$query = $this->db->query($sql, array($empresa_id));			
		}
		
		public function limpia_seguimiento($empresa_id)
		{
			$sql=" delete from catconf_016_seguimientoempresa where ID__EMPRESA=?";									  									  
			$query = $this->db->query($sql, array($empresa_id));			
		}
		
		public function edita_EmpresaInstitucion($empresa_id,$VCH_NOMBREEMPRESA,$VCH_RFC,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,
									  $VCH_CORREO,$VCH_TELEFONO,$VCH_GIROEMPRESA,$VCH_CELULAR,$NUM_EMPLEADOS,$VCH_COMENTARIOS,
									  $logo)
		{
			$sql=" update  catconf_013_empresa 
							set 
							VCH_NOMBREEMPRESA=?,VCH_RFC=?,VCH_PERSONACONTACTO=?,VCH_PUESTOCONTACTO=?,
							VCH_GIROEMPRESA=?,VCH_CORREO=?,VCH_TELEFONO=?,VCH_CELULAR=?
							,VCH_COMENTARIOS=?,NUM_EMPLEADOS=? where ID__EMPRESA=?";									  									  
																												
			$query = $this->db->query($sql, array($VCH_NOMBREEMPRESA,$VCH_RFC,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,
											$VCH_GIROEMPRESA,$VCH_CORREO,$VCH_TELEFONO,$VCH_CELULAR,$VCH_COMENTARIOS,
											$NUM_EMPLEADOS,$empresa_id));		
											
			if(!empty($logo))
			{
				$sql=" update  catconf_013_empresa 	set VCH_LOGO=? where ID__EMPRESA=?";
				$query = $this->db->query($sql, array($logo,$empresa_id));	
			}
											
		}
		public function delete_EmpresaInstitucion($ID__EMPRESA)
		{
			$this->db->delete('catconf_013_empresa', array('ID__EMPRESA' => $ID__EMPRESA));															
			echo "Se elimino exitosamente";			
		}
        /* empresas institucion arriba */
        
        
        
        
        /* embajadores Institucion abajo */
        public function get_institucionesEmbajador($VCH_NOMBRE,$VCH_PERSONACONTACTO)
        {
			$sql="SELECT catconf_018_institucion.ID__INSTITUCION,
					catconf_018_institucion.ID__USUARIO,
					catconf_018_institucion.ID__DOMICILIO,
					catconf_018_institucion.VCH_NOMBRE,
					catconf_018_institucion.VCH_PERSONACONTACTO,
					catconf_018_institucion.VCH_PUESTOCONTACTO,
					catconf_018_institucion.VCH_CORREO,
					catconf_018_institucion.VCH_TELEFONO,
					catconf_018_institucion.VCH_COMENTARIOS,
                    inact,act,
                    est.VCH_NOMBRE as estado,
                    muni.VCH_NOMBRE as municipio,
                    col.ID__COLONIA,
                    col.VCH_NOMBRE as colonia,
                    col.VCH_CODIGOPOSTAL,
                    dom.VCH_CALLE,
                    dom.VCH_ENTRECALLE,
                    concat(catconf_007_usuarios.VCH_NOMBRE,' ', VCH_APELLIDOPATERNO,' ',VCH_APELLIDOMATERNO) as responsable
				FROM catconf_018_institucion
                left join (
                
                SELECT ID__INSTITUCION, VCH_ESTATUS, SUM(VCH_ESTATUS = 0) as inact,SUM(VCH_ESTATUS = 1) as act FROM catconf_019_embajadores group by ID__INSTITUCION
                
                )b on  catconf_018_institucion.ID__INSTITUCION= b.ID__INSTITUCION
                
				left join catconf_008_domicilios dom on catconf_018_institucion.ID__DOMICILIO=dom.ID__DOMICILIO
				left join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
                left join catconf_007_usuarios on catconf_018_institucion.ID__USUARIO=catconf_007_usuarios.ID__USUARIO

				where catconf_018_institucion.VCH_NOMBRE like '%".$VCH_NOMBRE."%' and
				catconf_018_institucion.VCH_PERSONACONTACTO like '%".$VCH_PERSONACONTACTO."%' ";																
				$sql.=" order by catconf_018_institucion.VCH_NOMBRE limit 100";									  									  
				$query = $this->db->query($sql)->result_array();				
			return $query;		
		}
		public function get_precargaInstitucion($ID__INSTITUCION)
		{
			$sql="SELECT catconf_018_institucion.ID__INSTITUCION,
				catconf_018_institucion.ID__USUARIO,
				catconf_018_institucion.ID__DOMICILIO,
				catconf_018_institucion.VCH_NOMBRE,
				catconf_018_institucion.VCH_PERSONACONTACTO,
				catconf_018_institucion.VCH_PUESTOCONTACTO,
				catconf_018_institucion.VCH_CORREO,
				catconf_018_institucion.VCH_TELEFONO,
				catconf_018_institucion.VCH_COMENTARIOS,
				est.VCH_NOMBRE as estado,
				muni.VCH_NOMBRE as municipio,
				col.ID__COLONIA,
				col.VCH_NOMBRE as colonia,
				col.VCH_CODIGOPOSTAL,
				dom.VCH_CALLE,
				dom.VCH_ENTRECALLE,
				concat(catconf_007_usuarios.VCH_NOMBRE,' ', VCH_APELLIDOPATERNO,' ',VCH_APELLIDOMATERNO) as responsable
			FROM catconf_018_institucion
			left join catconf_008_domicilios dom on catconf_018_institucion.ID__DOMICILIO=dom.ID__DOMICILIO
			inner join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
			left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
			left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
			left join catconf_007_usuarios on catconf_018_institucion.ID__USUARIO=catconf_007_usuarios.ID__USUARIO
			where catconf_018_institucion.ID__INSTITUCION=?";
			$query = $this->db->query($sql,array($ID__INSTITUCION))->result_array();				
			return $query;		
		}
		public function alta_Institucion($ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$ID__USUARIO,$VCH_COMENTARIOS)
		{
			$sql=" INSERT INTO catconf_018_institucion
			(ID__USUARIO,ID__DOMICILIO,VCH_NOMBRE,VCH_PERSONACONTACTO,VCH_PUESTOCONTACTO,
			VCH_CORREO,VCH_TELEFONO,VCH_COMENTARIOS)
			VALUES
			(?,?,?,?,?,
			?,?,?);";									  									  
			$query = $this->db->query($sql, array($ID__USUARIO,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,
												  $VCH_CORREO,$VCH_TELEFONO,$VCH_COMENTARIOS));	
			echo "Guardado exitosamente";
		}
		public function edita_Institucion($ID__INSTITUCION,$ID__DOMICILIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,$VCH_CORREO,$VCH_TELEFONO,$ID__USUARIO,$VCH_COMENTARIOS)
		{
			$sql=" update catconf_018_institucion
			set ID__USUARIO=?,VCH_NOMBRE=?,VCH_PERSONACONTACTO=?,VCH_PUESTOCONTACTO=?,
			VCH_CORREO=?,VCH_TELEFONO=?,VCH_COMENTARIOS=? where ID__INSTITUCION=?";									  									  
			$query = $this->db->query($sql, array($ID__USUARIO,$VCH_NOMBRE,$VCH_PERSONACONTACTO,$VCH_PUESTOCONTACTO,
												  $VCH_CORREO,$VCH_TELEFONO,$VCH_COMENTARIOS,$ID__INSTITUCION));													  
			echo "Guardado exitosamente";												  
		}
		public function delete_Institucion($ID__INSTITUCION)
		{
			$this->db->delete('catconf_018_institucion', array('ID__INSTITUCION' => $ID__INSTITUCION));															
			echo "Se elimino exitosamente";			
		}				        
        /* embajadores Institucion arriba */
        
        
        /* eventos adopcion abajo */
        public function get_eventosAdopcion($VCH_NOMBRE,$fechaInicio,$fechafin,$VCH_ESTATUS)
		{			
			if(!empty($fechaInicio))
			{
				$fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicio);
				$fechaInicio=$fechaInicio->format('Y-m-d');
			}
			if(!empty($fechafin))
			{
				$fechafin 	 = DateTime::createFromFormat('d/m/Y', $fechafin);
				$fechafin=$fechafin->format('Y-m-d');
			}
			$sql="SELECT catconf_010_eventoadopcion.ID__EVENTO,
						catconf_010_eventoadopcion.ID__DOMICILIO,
						catconf_010_eventoadopcion.VCH_NOMBRE,
						catconf_010_eventoadopcion.VCH_DESCRIPCION,
						catconf_010_eventoadopcion.VCH_LUGAR,
						catconf_010_eventoadopcion.FEC_FECHAINICIO,
						catconf_010_eventoadopcion.FEC_FECHAFIN,
						catconf_010_eventoadopcion.VCH_COMPANIAPUBLICITARIA,
						catconf_010_eventoadopcion.NUM_CANTIDADARBOLES,
						catconf_010_eventoadopcion.VCH_ESTATUS,
						catconf_010_eventoadopcion.VCH_CONTACTO,
						catconf_010_eventoadopcion.VCH_CARGOCONTACTO,
						catconf_010_eventoadopcion.VCH_TELEFONOCONTACTO,
						catconf_010_eventoadopcion.VCH_CELULARCONTACTO,
						catconf_010_eventoadopcion.VCH_CORREOCONTACTO,
						est.VCH_NOMBRE as estado,
						muni.VCH_NOMBRE as municipio,
						col.ID__COLONIA,
						col.VCH_NOMBRE as colonia,
						col.VCH_CODIGOPOSTAL,
						dom.VCH_CALLE,
						dom.VCH_ENTRECALLE
					FROM catconf_010_eventoadopcion
				left join catconf_008_domicilios dom on catconf_010_eventoadopcion.ID__DOMICILIO=dom.ID__DOMICILIO
				inner join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO							
				where catconf_010_eventoadopcion.VCH_NOMBRE like'%".$VCH_NOMBRE."%'";				
				if($VCH_ESTATUS!="2"&&!empty($VCH_ESTATUS))
				{
					$sql.=" and catconf_010_eventoadopcion.VCH_ESTATUS ='".$VCH_ESTATUS."'";
                }
                if(!empty($fechaInicio))
                {
					$sql.=" and FEC_FECHAINICIO >  '".$fechaInicio."'";
				}
				if(!empty($fechafin))
                {
					$sql.=" and FEC_FECHAFIN < '".$fechafin."'";
				}				
				$sql.="   order by catconf_010_eventoadopcion.VCH_NOMBRE limit 100";
				$query = $this->db->query($sql)->result_array();			
				//die($this->db->last_query());	
				return $query;			
		}
		
		public function get_Select_empresas()
		{						
			$sql="SELECT ID__EMPRESA,VCH_NOMBREEMPRESA FROM catconf_013_empresa order by VCH_NOMBREEMPRESA asc";									  									  
			$query = $this->db->query($sql)->result_array();				
			return $query;			
		}	    
        /* eventos adopcion arriba */
        
        
        
        
        /* catalogo de ubicaciones abajo */
        public function get_ubicaciones($VCH_NOMBRE,$INT_ESTATUS,$INT_USO)
		{									
			//die(print_r(get_defined_vars()));
			$sql="SELECT ID__UBICACION,VCH_NOMBRE,INT_ESTATUS,INT_USO,VCH_OBSERVACIONES FROM catconf_052_catalogoubicacion 
			where VCH_NOMBRE like '%".$VCH_NOMBRE."%' ";
			
			if(($INT_ESTATUS!=-1)&&($INT_ESTATUS!=''))
			{
				$sql.=" and INT_ESTATUS=".$INT_ESTATUS;	
			}
			if(($INT_USO!=-1)&&($INT_USO!=''))
			{
				$sql.=" and INT_ESTATUS=".$INT_USO;	
			}			
						
			$sql.=" order by VCH_NOMBRE asc";									  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	                
		public function get_precargaUbicacion($ID__UBICACION)
		{
			$sql="SELECT catconf_052_catalogoubicacion.ID__UBICACION,
				catconf_052_catalogoubicacion.ID__DOMICILIO,
				catconf_052_catalogoubicacion.VCH_NOMBRE,
				catconf_052_catalogoubicacion.INT_ESTATUS,
				catconf_052_catalogoubicacion.INT_USO,
				catconf_052_catalogoubicacion.VCH_OBSERVACIONES,
				catconf_052_catalogoubicacion.VCH_FOTO,
				catconf_052_catalogoubicacion.VCH_LATITUD,
				catconf_052_catalogoubicacion.VCH_LOGITUD,
				est.VCH_NOMBRE as estado,
				muni.VCH_NOMBRE as municipio,
				col.ID__COLONIA,
				col.VCH_NOMBRE as colonia,
				col.VCH_CODIGOPOSTAL,
				dom.VCH_CALLE,
				dom.VCH_ENTRECALLE				
			FROM catconf_052_catalogoubicacion
			left join catconf_008_domicilios dom on catconf_052_catalogoubicacion.ID__DOMICILIO=dom.ID__DOMICILIO
			left join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
			left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
			left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO			
			where catconf_052_catalogoubicacion.ID__UBICACION=?";
			$query = $this->db->query($sql,array($ID__UBICACION))->result_array();				
//			die($this->db->last_query());
			return $query;		
		}
		public function alta_Ubicacion($ID__DOMICILIO,$VCH_NOMBRE,$INT_ESTATUS,$INT_USO,$VCH_OBSERVACIONES,$filename)
		{														
			$sql='INSERT INTO catconf_052_catalogoubicacion
				(ID__DOMICILIO,VCH_NOMBRE,INT_ESTATUS,
				INT_USO,VCH_OBSERVACIONES,VCH_FOTO)
				VALUES
				(?,?,?,
				?,?,?)';			 			
			
			$this->db->query($sql,
								 array($ID__DOMICILIO,$VCH_NOMBRE,$INT_ESTATUS,$INT_USO,$VCH_OBSERVACIONES,$filename)
							);	
			echo "Guardado exitosamente";
		}
		public function edita_Ubicacion($ID__UBICACION,$ID__DOMICILIO,$VCH_NOMBRE,$INT_ESTATUS,$INT_USO,$VCH_OBSERVACIONES,$filename)
		{														
			$sql='update catconf_052_catalogoubicacion
				set ID__DOMICILIO= ? ,VCH_NOMBRE=?,INT_ESTATUS=?,
				INT_USO=?,VCH_OBSERVACIONES=? where ID__UBICACION=?';			 			
			
			$this->db->query($sql,
								 array($ID__DOMICILIO,$VCH_NOMBRE,$INT_ESTATUS,$INT_USO,$VCH_OBSERVACIONES,$ID__UBICACION)
							);	
//			die($this->db->last_query());				
			if($filename!='')				
			{
				$sql='update catconf_052_catalogoubicacion set VCH_FOTO=? where ID__UBICACION=?';			 						
				$this->db->query($sql,
								 array($ID__UBICACION)
							);	
			}
							
			echo "Guardado exitosamente";
		}
        /* catalogo de ubicaciones arriba */
        
        
        /* Inventarios global abajo */
        public function get_inventariosGlobales()
		{									
			//die(print_r(get_defined_vars()));
			$sql="SELECT ID__INVENTARIO,NUM_CANTIDAD,(DATEDIFF(now(),FEC_FECHAGERMINACION)/30) as edad,VCH_NOMBRE as zona,catconf_052_catalogoubicacion.ID__UBICACION,VCH_NOMBRECOMUN as especie,
				 contenedor_nombre as contenedor,procedencia_nombre as procedencia
				 FROM catconf_064_inventariosglobal
				 inner join catconf_052_catalogoubicacion on catconf_052_catalogoubicacion.ID__UBICACION=catconf_064_inventariosglobal.ID__UBICACION
				 inner join catconf_009_especies on catconf_009_especies.ID__ESPECIE=catconf_064_inventariosglobal.ID__ESPECIE
				 inner join catconf_062_contenedores on catconf_062_contenedores.contenedor_id=catconf_064_inventariosglobal.contenedor_id
                 inner join catconf_063_procedencias on catconf_064_inventariosglobal.procedencia_id=catconf_063_procedencias.procedencia_id
                 where NUM_CANTIDAD >0 
				 order by VCH_NOMBRE,VCH_NOMBRECOMUN asc
				 ";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	        
        public function get_selectProcedencias()
		{												
			$sql="SELECT procedencia_id,procedencia_nombre FROM catconf_063_procedencias order by procedencia_nombre asc";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	        
        public function get_selectUbicaciones()
		{												
			$sql="SELECT ID__UBICACION,VCH_NOMBRE FROM catconf_052_catalogoubicacion order by VCH_NOMBRE asc";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	        
        public function get_selectEspecies()
		{												
			$sql="SELECT ID__ESPECIE,VCH_NOMBRECOMUN FROM catconf_009_especies order by VCH_NOMBRECOMUN asc ";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	        
        public function get_selectEspeciesDisponibles()
		{												
			$sql="SELECT catconf_009_especies.ID__ESPECIE,VCH_NOMBRECOMUN FROM catconf_009_especies 
			inner join 
			(
				select ID__ESPECIE,sum(NUM_CANTIDAD) from catconf_064_inventariosglobal where NUM_CANTIDAD>0 group by ID__ESPECIE
			)existentes on catconf_009_especies.ID__ESPECIE=existentes.ID__ESPECIE
			order by VCH_NOMBRECOMUN asc";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	        
        public function get_selectEtiquetasEspeciesDisponibles()
		{												
			$sql="SELECT catconf_009_especies.ID__ESPECIE,VCH_NOMBRECOMUN FROM catconf_009_especies 
			inner join 
			(
				select ID__ESPECIE,count(*) as total from catconf_071_etiquetas where ID__EVENTO IS  null group by ID__ESPECIE having total  >0 
			)existentes on catconf_009_especies.ID__ESPECIE=existentes.ID__ESPECIE
			order by VCH_NOMBRECOMUN asc";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	        
        public function get_selectContenedor()
		{												
			$sql="SELECT contenedor_id,contenedor_nombre FROM catconf_062_contenedores order by contenedor_nombre";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	        
        public function alta_inventarioGlobal($ID__UBICACION,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION,$NUM_CANTIDAD)
		{												
			if (strpos($FEC_FECHAGERMINACION, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAGERMINACION);
				$FEC_FECHAGERMINACION=$date1->format('Y-m-d');
			}				
			
			$sql="INSERT INTO catconf_064_inventariosglobal
					(
					ID__UBICACION,ID__ESPECIE,procedencia_id,
					contenedor_id,FEC_FECHAGERMINACION,NUM_CANTIDAD)
					VALUES
					(?,?,?,
					?,?,?)";													  									  
			$this->db->query($sql,							
								array($ID__UBICACION,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION,$NUM_CANTIDAD)
									);				
												
		}	        
		public function buscar_altaInventarioGlobalRepetido($ID__UBICACION,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION)
		{												
			if (strpos($FEC_FECHAGERMINACION, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAGERMINACION);
				$FEC_FECHAGERMINACION=$date1->format('Y-m-d');
			}						
			$sql="SELECT ID__INVENTARIO FROM catconf_064_inventariosglobal where 
			ID__UBICACION=? and ID__ESPECIE=? and procedencia_id=? and contenedor_id=? and FEC_FECHAGERMINACION=?
			";													  									  
			$query = $this->db->query($sql,
									array($ID__UBICACION,$ID__ESPECIE,$procedencia_id,$contenedor_id,$FEC_FECHAGERMINACION)
									)->result_array();										
			return $query;
		}	
		public function alta_inventarioGlobalCombinar($idPREVIO,$NUM_CANTIDAD)
		{												
			$sql="update catconf_064_inventariosglobal set NUM_CANTIDAD=(NUM_CANTIDAD+?) where ID__INVENTARIO=?	";													  									  
			$this->db->query($sql,
								array($NUM_CANTIDAD,$idPREVIO)
								);	
		}	
		public function reduccion_inventarioGlobal($ID__INVENTARIO,$NUM_CANTIDAD)
		{		
													
			$sql="update catconf_064_inventariosglobal set NUM_CANTIDAD=(NUM_CANTIDAD-?) where ID__INVENTARIO=?	";													  									  
			$this->db->query($sql,
								array($NUM_CANTIDAD,$ID__INVENTARIO)
								);		
		}	
		public function modifica_inventarioGlobal($ID__INVENTARIO,$contenedor_id,$FEC_FECHAGERMINACION)
		{												
			$date1 = DateTime::createFromFormat('d/m/Y', $FEC_FECHAGERMINACION);
			$FEC_FECHAGERMINACION=$date1->format('Y-m-d');
			$sql="update catconf_064_inventariosglobal set contenedor_id=? , FEC_FECHAGERMINACION=? where ID__INVENTARIO=?	";													  									  
			$this->db->query($sql,
								array($contenedor_id,$FEC_FECHAGERMINACION,$ID__INVENTARIO)
								);	
		}	
		public function get_precargaInventarioGlobal($ID__INVENTARIO)
		{
			$sql="SELECT * FROM catconf_064_inventariosglobal where ID__INVENTARIO=?";													  									  
			$query = $this->db->query($sql,array($ID__INVENTARIO))->result_array();	
			return $query;	
		}
		/* Inventarios global arriba */
		
		
		/* tiposPatrocinios abajo */
		public function get_tiposPatrocinios()
		{
			$sql="SELECT * FROM catconf_033_patrocinios ";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;	
		}
		public function get_precargaTipoPatrocinio($ID__PATROCINIO)
		{
			$sql="SELECT * FROM catconf_033_patrocinios where ID__PATROCINIO=?";													  									  
			$query = $this->db->query($sql,array($ID__PATROCINIO))->result_array();	
			return $query;	
		}
		public function alta_TipoPatrocinio($ID__PATROCINIO,$VCH_TIPO,$VCH_OBSERVACIONES)
		{												
			$sql="INSERT INTO catconf_033_patrocinios(VCH_TIPO,VCH_OBSERVACIONES)VALUES(?,?)	";													  									  
			$this->db->query($sql,
								array($VCH_TIPO,$VCH_OBSERVACIONES)
								);	
		}	
		public function edita_TipoPatrocinio($ID__PATROCINIO,$VCH_TIPO,$VCH_OBSERVACIONES)
		{												
			$sql="update catconf_033_patrocinios set VCH_TIPO=? , VCH_OBSERVACIONES=? where ID__PATROCINIO=?	";													  									  
			$this->db->query($sql,
								array($VCH_TIPO,$VCH_OBSERVACIONES,$ID__PATROCINIO)
								);	
		}	
		public function delete_TipoPatrocinio($ID__PATROCINIO)
		{				
			$this->db->delete('catconf_033_patrocinios', array('ID__PATROCINIO' => $ID__PATROCINIO));															
			echo "Se elimino exitosamente";			
		}
		/* tiposPatrocinios arriba */

		/*Precios especie abajo*/
		public function get_PrecioEspecie($especieprecio_id)
		{
			$sql="SELECT * FROM catconf_053_especieprecio where ID__ESPECIE=?";													  									  
			$query = $this->db->query($sql,array($especieprecio_id))->result_array();	
			return $query;	
		}
		public function alta_precioEspecie($ID__ESPECIE,$MES_TRES,$MES_SEIS,$MES_NUEVE,$MES_DOCE,$MES_DIECIOCHO,$MES_VEINTICUATRO,$MES_TREINTA,$MES_TREINTAYSEIS,$MES_CUARENTAYDOS,$MES_CUARENTAYOCHO,$MES_SESENTA,$MES_SETENTAYDOS)
		{
			$sql="INSERT INTO catconf_053_especieprecio
			(
			ID__ESPECIE,			MES_TRES,			MES_SEIS,			MES_NUEVE,			MES_DOCE,			
			MES_DIECIOCHO,			MES_VEINTICUATRO,			MES_TREINTA,			MES_TREINTAYSEIS,			MES_CUARENTAYDOS,		
			MES_CUARENTAYOCHO,			MES_SESENTA,			MES_SETENTAYDOS)
			VALUES
			(
				?,?,?,?,?,
				?,?,?,?,?,
				?,?,?
			)";													  									  
			$this->db->query($sql,
				array($ID__ESPECIE,$MES_TRES,$MES_SEIS,$MES_NUEVE,$MES_DOCE,
				$MES_DIECIOCHO,$MES_VEINTICUATRO,$MES_TREINTA,$MES_TREINTAYSEIS,$MES_CUARENTAYDOS,
				$MES_CUARENTAYOCHO,$MES_SESENTA,$MES_SETENTAYDOS)
			);	
			echo "Guardado exitosamente";
		}
		public function edita_precioEspecie($ID__ESPECIE,$MES_TRES,$MES_SEIS,$MES_NUEVE,$MES_DOCE,$MES_DIECIOCHO,$MES_VEINTICUATRO,$MES_TREINTA,$MES_TREINTAYSEIS,$MES_CUARENTAYDOS,$MES_CUARENTAYOCHO,$MES_SESENTA,$MES_SETENTAYDOS)
		{
			$sql="update catconf_053_especieprecio
					set
					MES_TRES=?,			MES_SEIS=?,			MES_NUEVE=?,			MES_DOCE=?,			
					MES_DIECIOCHO=?,		MES_VEINTICUATRO=?,	MES_TREINTA=?,	MES_TREINTAYSEIS=?,			MES_CUARENTAYDOS=?,		
					MES_CUARENTAYOCHO=?,	MES_SESENTA=?,			MES_SETENTAYDOS=?
					where ID__ESPECIE=?	";													  									  
			$this->db->query($sql,
				array($MES_TRES,$MES_SEIS,$MES_NUEVE,$MES_DOCE,
				$MES_DIECIOCHO,$MES_VEINTICUATRO,$MES_TREINTA,$MES_TREINTAYSEIS,$MES_CUARENTAYDOS,
				$MES_CUARENTAYOCHO,$MES_SESENTA,$MES_SETENTAYDOS,
				$ID__ESPECIE));	
			echo "Guardado exitosamente";
		}
		/*Precios especie arriba*/
		
		
		/*CatalogoEventos abajo*/
		public function get_catalogoEventos($VCH_NOMBREEVENTO,$ID__EMPRESA,$FEC_FECHAINICIO,$VCH_ESTATUS,$VCH_TIPO,$VCH_NOMBRELUGAR,$FEC_FECHAFIN)
		{
			$sql="SELECT catconf_065_eventos.ID__EVENTO,
					VCH_NOMBREEMPRESA,VCH_EMPRESASREFOR,
					catconf_065_eventos.VCH_ESTATUS,
					catconf_065_eventos.VCH_TIPO,
					catconf_065_eventos.ID__EMPRESA,
					catconf_065_eventos.ID__DOMICILIO,
					catconf_065_eventos.VCH_NOMBREEVENTO,
					catconf_065_eventos.VCH_NOMBRELUGAR,
					catconf_065_eventos.VCH_OBSERVACIONES,
					catconf_065_eventos.NUM_COMPUTADORAS,
					catconf_065_eventos.NUM_ARBOLESSOLICITADOS,
					catconf_065_eventos.FEC_FECHAINICIO,
					catconf_065_eventos.FEC_FECHAFIN
				FROM catconf_065_eventos
				left join catconf_013_empresa on catconf_065_eventos.ID__EMPRESA = catconf_013_empresa.ID__EMPRESA
				where VCH_NOMBREEVENTO like '%".$VCH_NOMBREEVENTO."%'";

				/*				
				 if(!empty($ID__EMPRESA))
				{
					$sql.="and (catconf_065_eventos.ID__EMPRESA=".$ID__EMPRESA." or ".$ID__EMPRESA." in
					     (Replace(Replace(VCH_EMPRESASREFOR,']',''),'[',''))
					  )";
				}*/
				if(!empty($FEC_FECHAINICIO))
				{	
					$sql.=" and FEC_FECHAINICIO< '".$FEC_FECHAINICIO."'"; 				
				}
				if(!empty($FEC_FECHAFIN))
				{
					$sql.=" and FEC_FECHAFIN> '".$FEC_FECHAFIN."'";
				}
				if(!empty($VCH_ESTATUS))
				{	
					$sql.=" and VCH_ESTATUS=".$VCH_ESTATUS;
				}
				if(!empty($VCH_TIPO))
				{	
					$sql.=" and VCH_TIPO=".$VCH_TIPO;
				}
				if(!empty($VCH_NOMBRELUGAR))
				{
					$sql.=" and VCH_NOMBRELUGAR='".$VCH_NOMBRELUGAR."'";
				}														
				$sql.=" order by ID__EVENTO desc "	;						  									  
			$query = $this->db->query($sql)->result_array();	
			
			
			$filtrados=array();
			if(!empty($ID__EMPRESA))
			{
				foreach($query as $fill)
				{	
					//die(print_r($fill));
					$buscado=array();  					
					if(!empty($fill["ID__EMPRESA"]))
					{
						array_push($buscado, $fill["ID__EMPRESA"]);					
					}
					
					if(!empty($fill["VCH_EMPRESASREFOR"]))
					{
						$aux=JSON_DECODE($fill["VCH_EMPRESASREFOR"]);
						$buscado=array_merge($buscado,$aux);
					}
					//die(print_r($buscado));
					if(in_array($ID__EMPRESA, $buscado))
					{
							array_push($filtrados, $fill);
					}					
				}
			}
			else
			{
				return $query;
			}			
			return $filtrados;	
		}
		public function alta_catalogoEventos( $VCH_ESTATUS,$VCH_TIPO,$ID__EMPRESA,$ID__DOMICILIO,$VCH_NOMBREEVENTO,
												$VCH_NOMBRELUGAR,$VCH_OBSERVACIONES,$NUM_COMPUTADORAS,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
												$FEC_FECHAFIN,$VCH_LATITUD,$VCH_LONGITUD)
		{			
			if (strpos($FEC_FECHAINICIO, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FEC_FECHAINICIO);
				$FEC_FECHAINICIO=$date1->format('Y-m-d H:i:s');	
			}	
			if (strpos($FEC_FECHAFIN, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FEC_FECHAFIN);
				$FEC_FECHAFIN=$date1->format('Y-m-d H:i:s');
			}	
			
			$sql="INSERT INTO catconf_065_eventos
				(
				VCH_ESTATUS,VCH_TIPO,ID__EMPRESA,ID__DOMICILIO,VCH_NOMBREEVENTO,
				VCH_NOMBRELUGAR,VCH_OBSERVACIONES,NUM_COMPUTADORAS,NUM_ARBOLESSOLICITADOS,FEC_FECHAINICIO,
				FEC_FECHAFIN,VCH_LATITUD,VCH_LONGITUD)
				VALUES
				(?,?,?,?,?,
				?,?,?,?,?,
				?,?,?);";													  									  
			$this->db->query($sql,
				array($VCH_ESTATUS,$VCH_TIPO,$ID__EMPRESA,$ID__DOMICILIO,$VCH_NOMBREEVENTO,
					$VCH_NOMBRELUGAR,$VCH_OBSERVACIONES,$NUM_COMPUTADORAS,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
					$FEC_FECHAFIN,$VCH_LATITUD,$VCH_LONGITUD)
			);	
			echo "Guardado exitosamente";
		}
		public function alta_catalogoEventosRefor( $ID__EVENTO,$VCH_NOMBREEVENTO,$EMPRESAS,$VCH_TIPOREFORESTA,
															  $NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,$FEC_FECHAFIN,$VCH_ESTATUS,
															  $VCH_OBSERVACIONES,$VCH_PRERREQUISITOS,$VCH_LATITUD,$VCH_LONGITUD)
		{			
			if (strpos($FEC_FECHAINICIO, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FEC_FECHAINICIO);
				$FEC_FECHAINICIO=$date1->format('Y-m-d H:i:s');	
			}	
			if (strpos($FEC_FECHAFIN, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FEC_FECHAFIN);
				$FEC_FECHAFIN=$date1->format('Y-m-d H:i:s');
			}				
			$sql="INSERT INTO catconf_065_eventos
			(VCH_ESTATUS,VCH_TIPO,ID__EMPRESA,ID__DOMICILIO,VCH_NOMBREEVENTO
			,VCH_NOMBRELUGAR,VCH_OBSERVACIONES,NUM_COMPUTADORAS,NUM_ARBOLESSOLICITADOS,FEC_FECHAINICIO
			,FEC_FECHAFIN,VCH_PRERREQUISITOS,VCH_LATITUD,VCH_LONGITUD,VCH_TIPOREFORESTA,VCH_EMPRESASREFOR)
			VALUES
			(?,?,?,?,?,
			?,?,?,?,?,
			?,?,?,?,?,?)";													  									  
			$this->db->query($sql,
				array($VCH_ESTATUS,2,"",null,$VCH_NOMBREEVENTO,
				"",$VCH_OBSERVACIONES,"",$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
				$FEC_FECHAFIN,$VCH_PRERREQUISITOS,$VCH_LATITUD,$VCH_LONGITUD,$VCH_TIPOREFORESTA,$EMPRESAS)
			);	
			//die($this->db->last_query());
			echo "Guardado exitosamente";
		}
		public function edita_catalogoEventos( $VCH_ESTATUS,$VCH_TIPO,$ID__EMPRESA,$ID__DOMICILIO,$VCH_NOMBREEVENTO,
												$VCH_NOMBRELUGAR,$VCH_OBSERVACIONES,$NUM_COMPUTADORAS,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
												$FEC_FECHAFIN,$ID__EVENTO,$VCH_LATITUD,$VCH_LONGITUD)
		{
			if (strpos($FEC_FECHAINICIO, '/') !== false) 
			{			

				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FEC_FECHAINICIO);
				$FEC_FECHAINICIO=$date1->format('Y-m-d H:i:s');
			}	
			if (strpos($FEC_FECHAFIN, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FEC_FECHAFIN);
				$FEC_FECHAFIN=$date1->format('Y-m-d H:i:s');
			}	
			$sql="UPDATE catconf_065_eventos
				SET
				VCH_ESTATUS = ?,	VCH_TIPO = ?,	ID__EMPRESA = ?,		VCH_NOMBREEVENTO = ?,
				VCH_NOMBRELUGAR = ?, VCH_OBSERVACIONES = ?,		NUM_COMPUTADORAS = ?,	NUM_ARBOLESSOLICITADOS = ?,	FEC_FECHAINICIO = ?,
				FEC_FECHAFIN = ? , VCH_LATITUD=?,VCH_LONGITUD=?
				WHERE ID__EVENTO = ?;
				";													  									  
			$this->db->query($sql,
				array($VCH_ESTATUS,$VCH_TIPO,$ID__EMPRESA,$VCH_NOMBREEVENTO,
					  $VCH_NOMBRELUGAR,$VCH_OBSERVACIONES,$NUM_COMPUTADORAS,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
					  $FEC_FECHAFIN, $VCH_LATITUD,$VCH_LONGITUD,
					  $ID__EVENTO));	
			echo "Guardado exitosamente";
		}
		public function editarEventoReforCatalogo( $ID__EVENTO,$VCH_NOMBREEVENTO,$EMPRESAS,$VCH_TIPOREFORESTA,
												  $NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,$FEC_FECHAFIN,$VCH_ESTATUS,
												  $VCH_OBSERVACIONES,$VCH_PRERREQUISITOS,$VCH_LATITUD,$VCH_LONGITUD)
		{			
			if (strpos($FEC_FECHAINICIO, '/') !== false) 
			{			

				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FEC_FECHAINICIO);
				$FEC_FECHAINICIO=$date1->format('Y-m-d H:i:s');
			}	
			if (strpos($FEC_FECHAFIN, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FEC_FECHAFIN);
				$FEC_FECHAFIN=$date1->format('Y-m-d H:i:s');
			}	
			$sql="UPDATE catconf_065_eventos
				SET
				VCH_ESTATUS = ?,				VCH_NOMBREEVENTO = ?,				VCH_OBSERVACIONES = ?,				NUM_ARBOLESSOLICITADOS = ?,				FEC_FECHAINICIO = ?,
				FEC_FECHAFIN = ?,				VCH_PRERREQUISITOS = ?,				VCH_LATITUD = ?,				VCH_LONGITUD = ?,				VCH_TIPOREFORESTA = ?,
				VCH_EMPRESASREFOR = ?				WHERE ID__EVENTO = ?;";													  									  
			$this->db->query($sql,
				array($VCH_ESTATUS,$VCH_NOMBREEVENTO,$VCH_OBSERVACIONES,$NUM_ARBOLESSOLICITADOS,$FEC_FECHAINICIO,
					 $FEC_FECHAFIN,$VCH_PRERREQUISITOS,$VCH_LATITUD,$VCH_LONGITUD,$VCH_TIPOREFORESTA,
					$EMPRESAS,$ID__EVENTO));	
			echo "Guardado exitosamente";
		}
		public function get_precargaEventoCatalogo($ID__EVENTO) 
		{
			$sql='SELECT catconf_065_eventos.ID__EVENTO,
					catconf_065_eventos.VCH_ESTATUS,
					catconf_065_eventos.VCH_TIPO,
					catconf_065_eventos.ID__EMPRESA,
					catconf_065_eventos.ID__DOMICILIO,
					catconf_065_eventos.VCH_NOMBREEVENTO,
					catconf_065_eventos.VCH_NOMBRELUGAR,
					catconf_065_eventos.VCH_OBSERVACIONES,
					catconf_065_eventos.NUM_COMPUTADORAS,
					catconf_065_eventos.NUM_ARBOLESSOLICITADOS,
					catconf_065_eventos.FEC_FECHAINICIO,
					catconf_065_eventos.FEC_FECHAFIN,
					VCH_LATITUD,VCH_LONGITUD,
                    est.VCH_NOMBRE as estado,
                    muni.VCH_NOMBRE as municipio,
                    col.ID__COLONIA,
                    col.VCH_NOMBRE as colonia,
                    col.VCH_CODIGOPOSTAL,
                    dom.VCH_CALLE,
                    dom.VCH_ENTRECALLE 
                    				FROM catconf_065_eventos 
				left join catconf_008_domicilios dom on catconf_065_eventos.ID__DOMICILIO=dom.ID__DOMICILIO
				left join catconf_006_colonias col on dom.ID__COLONIA=col.ID__COLONIA
				left join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				left join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
				where ID__EVENTO=?
				';									  									  
			$query = $this->db->query($sql,array($ID__EVENTO))->result_array();				
			//die($this->db->last_query());
			return $query;			
		}
		public function get_precargaEventoCatalogoReforesta($ID__EVENTO) 
		{
			$sql='SELECT catconf_065_eventos.ID__EVENTO,
					catconf_065_eventos.VCH_ESTATUS,
					catconf_065_eventos.VCH_TIPO,
					catconf_065_eventos.ID__EMPRESA,
					catconf_065_eventos.ID__DOMICILIO,
					catconf_065_eventos.VCH_NOMBREEVENTO,
					catconf_065_eventos.VCH_NOMBRELUGAR,
					catconf_065_eventos.VCH_OBSERVACIONES,					
					catconf_065_eventos.NUM_ARBOLESSOLICITADOS,
					catconf_065_eventos.FEC_FECHAINICIO,
					catconf_065_eventos.FEC_FECHAFIN,
					VCH_PRERREQUISITOS,VCH_LATITUD,VCH_LONGITUD,VCH_TIPOREFORESTA,VCH_EMPRESASREFOR
					FROM catconf_065_eventos 
				where ID__EVENTO=?
				';									  									  
			$query = $this->db->query($sql,array($ID__EVENTO))->result_array();				
			return $query;			
		}
		public function delete_EventoCatalogo($ID__EVENTO)
		{				
			$this->db->delete('catconf_065_eventos', array('ID__EVENTO' => $ID__EVENTO));															
			echo "Se elimino exitosamente";			
		}
		
		/*CatalogoEventos arriba*/


		/*Asignacion recursos evento abajo*/
		public function get_catalogoEventosAdopcion($id)
		{
			$sql="SELECT catconf_065_eventos.ID__EVENTO,
					VCH_NOMBREEMPRESA,VCH_TIPO,															
					catconf_065_eventos.VCH_NOMBREEVENTO,
					catconf_065_eventos.VCH_NOMBRELUGAR,
					catconf_065_eventos.VCH_OBSERVACIONES,
					catconf_065_eventos.NUM_ARBOLESSOLICITADOS,
					catconf_065_eventos.FEC_FECHAINICIO,
					vehiculodesc,
					b.asignados,c.vehiculos
					FROM catconf_065_eventos
					left join catconf_013_empresa on catconf_065_eventos.ID__EMPRESA = catconf_013_empresa.ID__EMPRESA
					LEFT Join
					(
						select sum(NUM_CANTIDAD) as asignados ,ID__EVENTO from catconf_066_relarboladoasignadoaevento group by ID__EVENTO
					)b on catconf_065_eventos.ID__EVENTO=b.ID__EVENTO 
                    LEFT Join
					(										
						select GROUP_CONCAT(VCH_MATRICULA) as vehiculos,VCH_DESCRIPCION as vehiculodesc,ID__EVENTO from catconf_068_rel_evento_vehiculo rel
						left join catconf_067_vehiculos veh on rel.ID__VEHICULO=veh.ID__VEHICULO
					)c on catconf_065_eventos.ID__EVENTO=c.ID__EVENTO
					where 1=1";// VCH_TIPO=1 ";
					if(!empty($id))																									
					{
						$sql.=" and catconf_065_eventos.ID__EVENTO=".$id;
					}
					$sql.=" order by ID__EVENTO desc";
			$query = $this->db->query($sql)->result_array();	
//			die($sql);
			return $query;	
		}
	
		public function get_catalogoEventosAdopcionCuentaRecursos($id)
		{
			$sql="SELECT catconf_065_eventos.ID__EVENTO,
					VCH_NOMBREEMPRESA,					VCH_TIPO,										
					catconf_065_eventos.VCH_NOMBREEVENTO,
					catconf_065_eventos.VCH_NOMBRELUGAR,
					catconf_065_eventos.VCH_OBSERVACIONES,
					catconf_065_eventos.NUM_ARBOLESSOLICITADOS,
					catconf_065_eventos.FEC_FECHAINICIO,
					cantvehiculos,
                    cantpersonal,
                    cantprestador					
					FROM catconf_065_eventos
					left join catconf_013_empresa on catconf_065_eventos.ID__EMPRESA = catconf_013_empresa.ID__EMPRESA
					LEFT Join
					(
						select count(ID__EVENTO) as cantvehiculos ,ID__EVENTO from catconf_068_rel_evento_vehiculo group by ID__EVENTO
					)b on catconf_065_eventos.ID__EVENTO=b.ID__EVENTO 
                    LEFT Join
					(										
						select count(ID__EVENTO) as cantpersonal ,ID__EVENTO from catconf_069_rel_evento_personal group by ID__EVENTO
					)c on catconf_065_eventos.ID__EVENTO=c.ID__EVENTO
                    LEFT Join
					(										
						select count(ID__EVENTO) as cantprestador ,ID__EVENTO from catconf_070_rel_evento_prestador group by ID__EVENTO
					)d on catconf_065_eventos.ID__EVENTO=c.ID__EVENTO
					where 1=1";// VCH_TIPO=1 ";
					if(!empty($id))																									
					{
						$sql.=" and catconf_065_eventos.ID__EVENTO=".$id;
					}
					$sql.=" order by ID__EVENTO desc";
			$query = $this->db->query($sql)->result_array();	
//			die($sql);
			return $query;	
		}
		
		public function get_relarbolasignados($id)
		{
			$sql="SELECT VCH_NOMBRECOMUN,NUM_CANTIDAD,VCH_NOMBRE FROM catconf_066_relarboladoasignadoaevento rel
			left join catconf_009_especies especies on rel.ID__ESPECIE=especies.ID__ESPECIE
            left join catconf_052_catalogoubicacion ubicacion on rel.ID__UBICACION=ubicacion.ID__UBICACION
			where ID__EVENTO=?";
			$query = $this->db->query($sql,array($id))->result_array();	
			return $query;
			
		}
		
		public function buscar_zona_con_especie($ID__ESPECIE)
		{
			$sql="select catconf_052_catalogoubicacion.ID__UBICACION,VCH_NOMBRE
			 FROM catconf_064_inventariosglobal 
			 left join catconf_052_catalogoubicacion on catconf_064_inventariosglobal.ID__UBICACION=catconf_052_catalogoubicacion.ID__UBICACION 
			 WHERE ID__ESPECIE=? and NUM_CANTIDAD>0
			 group by ID__UBICACION
			 ";
			$query = $this->db->query($sql,array($ID__ESPECIE))->result_array();	
			return $query;
		}
		
		public function buscar_edades_en_zona_con_especie($ID__ESPECIE,$ID__UBICACION,$ID__EVENTO)
		{												
			$edadesprevias = $this->db->query("select NUM_EDADMESES from catconf_066_relarboladoasignadoaevento where ID__ESPECIE=?  and ID__EVENTO=?",array($ID__ESPECIE,$ID__EVENTO))->result_array();						
			if(!empty($edadesprevias))
			{
				$edadesprevias=$edadesprevias[0]["NUM_EDADMESES"];
			}			
			$sql="SELECT TIMESTAMPDIFF(MONTH, FEC_FECHAGERMINACION, now()) as edad, TIMESTAMPDIFF(MONTH, FEC_FECHAGERMINACION, now()) as id
					from catconf_064_inventariosglobal
					 where ID__ESPECIE=?  and ID__UBICACION=?
					group by  edad";
			$query = $this->db->query($sql,array($ID__ESPECIE,$ID__UBICACION))->result_array();	
			
			if(empty($edadesprevias))
			{				
				return $query;
			}
			
			$filtrado=array();
			foreach ($query as $stock)
			{
					if($stock["edad"]==$edadesprevias)
						{
							array_push($filtrado,$stock);
						}
			}

			return $filtrado;
		}
		
		public function buscar_recipientes_con_edades_en_zona_con_especie($ID__ESPECIE,$ID__UBICACION,$edad)
		{
			$sql="select * from(

					SELECT TIMESTAMPDIFF(MONTH, FEC_FECHAGERMINACION, now()) as edad, TIMESTAMPDIFF(MONTH, FEC_FECHAGERMINACION, now()) as id,contenedor_nombre,catconf_062_contenedores.contenedor_id
					from catconf_064_inventariosglobal					
                    left join catconf_062_contenedores on catconf_064_inventariosglobal.contenedor_id=catconf_062_contenedores.contenedor_id
                    where ID__ESPECIE=?  and ID__UBICACION=? and NUM_CANTIDAD>0
                    
					group by  edad
                    )b where edad = ?
			 ";			 
			$query = $this->db->query($sql,array($ID__ESPECIE,$ID__UBICACION,$edad))->result_array();	
			return $query;
		}
		public function BusquedaInventarioDisponiblesConFiltro($ID__ESPECIE,$ID__UBICACION,$edad,$contenedor_id)
		{
			$sql="SELECT sum(NUM_CANTIDAD) as NUM_CANTIDAD FROM catconf_064_inventariosglobal where ID__ESPECIE=? and ID__UBICACION=? and (TIMESTAMPDIFF(MONTH, FEC_FECHAGERMINACION, now())= ?)  and contenedor_id=? ";			 
			$query = $this->db->query($sql,array($ID__ESPECIE,$ID__UBICACION,$edad,$contenedor_id))->result_array();	
//			die($this->db->last_query());
			return $query;
		}
		public function AsignarArboladoAEvento($ID__EVENTO,$ID__USUARIO,$FFEC_FECHAFIN,$ID__ESPECIE,$ID__UBICACION,$edad,$contenedor_id,$cantidadAsignar)
		{
			
			if (strpos($FFEC_FECHAFIN, '/') !== false) 
			{			
				$date1 = DateTime::createFromFormat('m/d/Y h:i a', $FFEC_FECHAFIN);
				$FFEC_FECHAFIN=$date1->format('Y-m-d H:i:s');
			}	
			
			$sql="INSERT INTO `catconf_066_relarboladoasignadoaevento`
				(
				`ID__EVENTO`,`ID__ESPECIE`,`FEC_FECHAYHORACARGA`,`ID__RESPONSABLECARGA`,`ID__UBICACION`
				,`contenedor_id`,`NUM_EDADMESES`,`NUM_CANTIDAD`)
				VALUES
				(?,?,?,?,?,
				?,?,?); ";			 
			$this->db->query($sql,array($ID__EVENTO,$ID__ESPECIE,$FFEC_FECHAFIN,$ID__USUARIO,$ID__UBICACION,$contenedor_id,$edad,$cantidadAsignar));	
			echo "Guardado exitosamente";
		}
		
		public function busquedaInventarioParaDescontarDeAsignacion($ID__UBICACION,$ID__ESPECIE,$contenedor_id,$edad)
		{
			$sql="SELECT ID__INVENTARIO,NUM_CANTIDAD FROM catconf_064_inventariosglobal where 
					ID__UBICACION=? and ID__ESPECIE=? and contenedor_id=? and (TIMESTAMPDIFF(MONTH, FEC_FECHAGERMINACION, now())= ?)";			 
			$query=$this->db->query($sql,array($ID__UBICACION,$ID__ESPECIE,$contenedor_id,$edad))->result_array();	
			return $query;
		}
		public function obtener_personas_cargan_unEvento($ID__EVENTO)
		{
			$sql="SELECT * 
					FROM catconf_066_relarboladoasignadoaevento rel
					left join catconf_007_usuarios us
					 on rel.ID__RESPONSABLECARGA=us.ID__USUARIO WHERE ID__EVENTO=?";			 
			$query=$this->db->query($sql,array($ID__EVENTO))->result_array();	
//			die($this->db->last_query());
			return $query;
		}
		public function get_relarbolasignadosParaFormato($id)
		{
			$sql="SELECT VCH_NOMBRECOMUN,NUM_CANTIDAD,VCH_NOMBRE,contenedor_nombre FROM extrav2.catconf_066_relarboladoasignadoaevento rel
			left join catconf_009_especies especies on rel.ID__ESPECIE=especies.ID__ESPECIE
            left join catconf_052_catalogoubicacion ubicacion on rel.ID__UBICACION=ubicacion.ID__UBICACION
            left join catconf_062_contenedores contenedor on rel.contenedor_id=contenedor.contenedor_id
			where ID__EVENTO=?";
			$query = $this->db->query($sql,array($id))->result_array();	
			return $query;
			
		}
		
		
		
		public function get_selectPersonalEvento($id)
		{
			$perfil=204; //perfil encargado vivero?
			$sql="SELECT * FROM catconf_007_usuarios where ID__USUARIO NOT in 
			(
			select ID__USUARIO from  catconf_069_rel_evento_personal where ID__EVENTO=?
			) and ID__PERFIL=? ";
			$query = $this->db->query($sql,array($id,$perfil))->result_array();	
			return $query;
						
		}
		public function get_selectHerramientaEvento($id)
		{
			$sql="SELECT ID_SUMHER,VCH_NOMBRE FROM catconf_072_suministrosyherramienta";
			$select = $this->db->query($sql)->result_array();	
			
			$sql="SELECT ID__EVENTO,rel.ID_SUMHER,VCH_CANTIDAD,VCH_DESCRIPCION,VCH_NOMBRE,ID__REL from catconf_073_rel_suministros_eventos rel
				inner join catconf_072_suministrosyherramienta her on rel.ID_SUMHER=her.ID_SUMHER where ID__EVENTO=?";
			$actuales = $this->db->query($sql,array($id))->result_array();	
			
			$herramientas["select"]=$select;
			$herramientas["actuales"]=$actuales;
			return $herramientas;						
		}
		public function get_selectvehiculoEvento($id)
		{

			$sql="SELECT * FROM catconf_067_vehiculos where ID__VEHICULO not in ( select ID__VEHICULO from catconf_068_rel_evento_vehiculo where ID__EVENTO=?)";
			$query = $this->db->query($sql,array($id))->result_array();	
			return $query;			
		}
		public function get_selectprestadorEvento($id)
		{
			$perfil=265;	//perfil trabajo social
			$sql="SELECT * FROM catconf_007_usuarios where ID__USUARIO NOT in 
			(
			select ID__USUARIO from  catconf_070_rel_evento_prestador where ID__EVENTO=?
			) and ID__PERFIL=? ";
			$query = $this->db->query($sql,array($id,$perfil))->result_array();	
			return $query;			
		}
		
		
		
		
		public function get_personalAsignadoEvento($id)
		{
			$sql="select * from catconf_069_rel_evento_personal left join catconf_007_usuarios on
				  catconf_069_rel_evento_personal.ID__USUARIO=catconf_007_usuarios.ID__USUARIO
			where ID__EVENTO=?";
			$query = $this->db->query($sql,array($id))->result_array();	
			return $query;
						
		}
		public function get_vehiculoAsignadoEvento($id)
		{
			$sql="SELECT * FROM catconf_068_rel_evento_vehiculo left join catconf_067_vehiculos on catconf_067_vehiculos.ID__VEHICULO=catconf_068_rel_evento_vehiculo.ID__VEHICULO
			where ID__EVENTO=?";
			$query = $this->db->query($sql,array($id))->result_array();	
			return $query;
			
		}
		public function get_prestadorAsignadoEvento($id)
		{
			$sql="select * from catconf_070_rel_evento_prestador left join catconf_007_usuarios on
				  catconf_070_rel_evento_prestador.ID__USUARIO=catconf_007_usuarios.ID__USUARIO
			where ID__EVENTO=?";
			$query = $this->db->query($sql,array($id))->result_array();	
			return $query;
			
		}
		
		
		public function AsignarRecursoEventoVehiculo($ID__EVENTO,$ID__VEHICULO)
		{
			
			$sql="INSERT INTO catconf_068_rel_evento_vehiculo
				(ID__EVENTO,ID__VEHICULO)
				VALUES
				(?,?);";
			$query = $this->db->query($sql,array($ID__EVENTO,$ID__VEHICULO));	
		}
		public function AsignarRecursoEventoPrestador($ID__EVENTO,$ID__USUARIO)
		{			
			$sql="INSERT INTO catconf_070_rel_evento_prestador
			(ID__EVENTO,ID__USUARIO)
			VALUES
			(?,?)";
			$query = $this->db->query($sql,array($ID__EVENTO,$ID__USUARIO));	
		}
		public function AsignarRecursoEventoPersonal($ID__EVENTO,$ID__USUARIO)
		{			
			$sql="INSERT INTO catconf_069_rel_evento_personal
			(ID__EVENTO,ID__USUARIO)
			VALUES
			(?,?)";
			$query = $this->db->query($sql,array($ID__EVENTO,$ID__USUARIO));	
		}
		public function AsignarRecursoEventoHer($ID__EVENTO,$HerSelect,$canther,$descher)
		{			
			$sql="INSERT INTO catconf_073_rel_suministros_eventos
			(ID__EVENTO,ID_SUMHER,VCH_CANTIDAD,VCH_DESCRIPCION)
			VALUES
			(?,?,?,?)";
			$query = $this->db->query($sql,array($ID__EVENTO,$HerSelect,$canther,$descher));	
		}
		
		
		
		
		
		
		
		
		public function EliminarRecursoEventoPrestador($ID__EVENTO,$ID__USUARIO)
		{

			$sql="DELETE FROM catconf_070_rel_evento_prestador
			WHERE  ID__REL=?";
			$query = $this->db->query($sql,array($ID__USUARIO));	
//			die($this->db->last_query());
		}
		public function EliminarRecursoEventoVehiculo($ID__EVENTO,$ID__VEHICULO)
		{			
			$sql="DELETE FROM catconf_068_rel_evento_vehiculo
				WHERE  ID__REL=?";
			$query = $this->db->query($sql,array($ID__VEHICULO));	
//			die($this->db->last_query());
		}
		public function EliminarRecursoEventoHer($ID__EVENTO,$ID_SUMHER)
		{			
			$sql="DELETE FROM catconf_073_rel_suministros_eventos
				WHERE  ID__REL=?";
			$query = $this->db->query($sql,array($ID_SUMHER));	
		}
		public function EliminarRecursoEventoPersonal($ID__EVENTO,$ID__USUARIO)
		{			
			$sql="DELETE FROM catconf_069_rel_evento_personal
			WHERE ID__REL=?";
			$query = $this->db->query($sql,array($ID__USUARIO));	
//			die($this->db->last_query());
		}
		/*Asignacion recursos evento arriba*/
		
		
		/* Catalogo de talleres abajo*/
		public function get_CatalogoTalleres($VCH_NOMBRE)
		{
			$sql="SELECT * FROM catconf_055_catalogotalleres where VCH_NOMBRE like '%".$VCH_NOMBRE."%'";
			$query = $this->db->query($sql)->result_array();	
			return $query;
		}
		
		public function altaCatalogoTalleres($VCH_NOMBRE,$VCH_MATERIAL,$VCH_DESCRIPCION)
		{
			$sql="INSERT INTO catconf_055_catalogotalleres(VCH_NOMBRE,VCH_MATERIAL,VCH_DESCRIPCION)VALUES(?,?,?)";
			$query = $this->db->query($sql,array($VCH_NOMBRE,$VCH_MATERIAL,$VCH_DESCRIPCION));	
			return $this->db->insert_id();
		}
		public function altaArchivosTalleres($ID__TALLER,$VCH_NOMBRE,$VCH_URL_ARCHIVO)
		{
			$sql="INSERT INTO catconf_056_archivostalleres (ID__TALLER,VCH_NOMBRE,VCH_URL_ARCHIVO) VALUES(?,?,?)";
			$query = $this->db->query($sql,array($ID__TALLER,$VCH_NOMBRE,$VCH_URL_ARCHIVO));	
			return $this->db->insert_id();
		}
		public function get_cargaCatalogoTaller($ID__TALLER)
		{
			$sql="SELECT * FROM catconf_055_catalogotalleres where ID__TALLER =".$ID__TALLER;
			$query = $this->db->query($sql)->result_array();	
			return $query;
		}
		public function	get_cargaCatalogoTallerArchivos($ID__TALLER)
		{
			$sql="SELECT * FROM catconf_056_archivostalleres where ID__TALLER =".$ID__TALLER;
			$query = $this->db->query($sql)->result_array();	
			return $query;
		}
		public function editaCatalogoTalleres($VCH_NOMBRE,$VCH_MATERIAL,$VCH_DESCRIPCION,$ID__TALLER)
		{
			$sql="UPDATE catconf_055_catalogotalleres SET VCH_NOMBRE = ?,VCH_MATERIAL = ?,VCH_DESCRIPCION = ? WHERE ID__TALLER = ?";
			$query = $this->db->query($sql,array($VCH_NOMBRE,$VCH_MATERIAL,$VCH_DESCRIPCION,$ID__TALLER));	
			return $this->db->insert_id();
		}		
		
		/* Catalogo de talleres arriba*/	
		
		
		
		/* CatalogoEventosEtiquetas abajo*/
		public function get_Empresa_Evento($ID_EVENTO)
		{
			$sql="select ID__EMPRESA from  catconf_065_eventos where ID__EVENTO=? ";																	  									  
			$query = $this->db->query($sql,array($ID_EVENTO))->row()->ID__EMPRESA;	
			return $query;	
		}
		
		public function get_etiquetas($id)
		{			
			$sql="							
			select count(*) as cuantas,VCH_NOMBRECOMUN,VCH_NOMBREEMPRESA,VCH_ANIO,ID__ESPECIE,ID__EMPRESA  FROM catconf_071_etiquetas
			inner join catconf_009_especies using(ID__ESPECIE)
			inner join catconf_013_empresa using(ID__EMPRESA)
			where ID__EVENTO is null AND NUM_PERDIDA=0 ";
			
			if(!empty($id))
			{
				$sql.=" and ID__EMPRESA=".$id;
			}
			
			$sql.=" group by ID__ESPECIE,ID__EMPRESA,VCH_ANIO
			  order by VCH_NOMBREEMPRESA,VCH_NOMBRECOMUN,VCH_ANIO asc
				   ";																	  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;	
		}
		public function cargarListaEtiquetas($ID__ESPECIE,$ID__EMPRESA,$VCH_ANIO)
		{
			$sql="select VCH_QR from  catconf_071_etiquetas where ID__ESPECIE=? and  ID__EMPRESA=? and VCH_ANIO=? and NUM_PERDIDA=0";																	  									  
			$query = $this->db->query($sql,array($ID__ESPECIE,$ID__EMPRESA,$VCH_ANIO))->result_array();	
			return $query;	
		}
		public function cargarListaEtiquetasDeEvento($ID__ESPECIE,$ID__EVENTO)
		{
			$datosevento = $this->db->query("SELECT * FROM catconf_065_eventos where ID__EVENTO=?",array($ID__EVENTO))->row();//->ID__EMPRESA;	
			$ID__EMPRESA=$datosevento->ID__EMPRESA;
			$VCH_ANIO=substr($datosevento->FEC_FECHAINICIO,0,4);	
			
			$sql="select VCH_QR from  catconf_071_etiquetas where ID__ESPECIE=? and  ID__EMPRESA=? and VCH_ANIO=? and NUM_PERDIDA=0 and ID__EVENTO=?";																	  									  
			$query = $this->db->query($sql,array($ID__ESPECIE,$ID__EMPRESA,$VCH_ANIO,$ID__EVENTO))->result_array();	
			return $query;	
		}
		public function	AltaEtiquetas($ID__ESPECIE,$ID__EMPRESA,$VCH_ANIO,$NUM_CANTIDAD)
		{
			$contador=0;			
			while ($contador<$NUM_CANTIDAD)
			{
				$contador++;
				$sql="select count(VCH_QR)+1 as cuantos from  catconf_071_etiquetas where ID__ESPECIE=? and VCH_ANIO=? order by ID__ETIQUETA desc limit 1";																	  									  
				$qr = $this->db->query($sql,array($ID__ESPECIE,$VCH_ANIO))->result_array();	
				//die($this->db->last_query());
				if(empty($qr))
				{
					$qr=1;
				}
				else
				{
					$qr=$qr[0]["cuantos"];
				}
				$qr=$VCH_ANIO."-".$ID__ESPECIE."-".sprintf('%06d', $qr);

				$sql="INSERT INTO catconf_071_etiquetas
				(ID__ESPECIE,ID__EMPRESA,VCH_ANIO,VCH_QR)
				VALUES
				(?,?,?,?)";																	  									  								
				$this->db->query($sql,array($ID__ESPECIE,$ID__EMPRESA,$VCH_ANIO,$qr));	
			}
			echo "Etiquetas generadas correctamente";
		}
		public function PerdiEtiquetas($VCH_QR)
		{
			$VCH_QR=$this->input->post("VCH_QR");		
			$sql="UPDATE catconf_071_etiquetas SET NUM_PERDIDA = 1 WHERE VCH_QR = ?";
			$this->db->query($sql,array($VCH_QR));	
			echo "La etiqueta ha sido removida del stock";
		}
		public function EncontreEtiquetas($VCH_QR)
		{
			$VCH_QR=$this->input->post("VCH_QR");		
			$sql="UPDATE catconf_071_etiquetas SET NUM_PERDIDA = 0 WHERE VCH_QR = ?";
			$this->db->query($sql,array($VCH_QR));	
			echo "La etiqueta ha sido devuelta al stock";
		}
		
		public function get_reletiquetasAsignadas($id)
		{
			//corregir este query feo...
/*			$sql="select rel.ID__ESPECIE,VCH_NOMBRECOMUN as especie,ubicacion.VCH_NOMBRE as ubicacion,arboladosolicitado as cantidadarboles,count(*) as cantidadetiquetas from catconf_071_etiquetas et
            left join 
            (
				select ID__EVENTO,ID__ESPECIE,FEC_FECHAYHORACARGA,ID__RESPONSABLECARGA,ID__UBICACION,contenedor_id,NUM_EDADMESES,sum(NUM_CANTIDAD) as NUM_CANTIDAD
				from catconf_066_relarboladoasignadoaevento where ID__EVENTO=? group by ID__ESPECIE								
				) rel using (ID__EVENTO)
            inner join catconf_009_especies especies on rel.ID__ESPECIE=especies.ID__ESPECIE
            left join catconf_052_catalogoubicacion ubicacion on rel.ID__UBICACION=ubicacion.ID__UBICACION
            inner join (select sum(NUM_CANTIDAD) as arboladosolicitado,ID__EVENTO  from catconf_066_relarboladoasignadoaevento where ID__EVENTO =?)b on rel.ID__EVENTO=b.ID__EVENTO
            where rel.ID__EVENTO =? and NUM_PERDIDA=0  group by et.ID__ESPECIE,et.ID__EMPRESA,et.VCH_ANIO,et.ID__EVENTO                        
            ";
			$query = $this->db->query($sql,array($id,$id,$id))->result_array();	
	*/					
			$sql="select ID__EVENTO,especies.ID__ESPECIE,VCH_NOMBRECOMUN as especie,sum(NUM_CANTIDAD) as cantidadarboles from 
				(select ID__EVENTO,ID__ESPECIE,FEC_FECHAYHORACARGA,ID__RESPONSABLECARGA,ID__UBICACION,contenedor_id,NUM_EDADMESES,sum(NUM_CANTIDAD) as NUM_CANTIDAD
					from catconf_066_relarboladoasignadoaevento where ID__EVENTO=? group by ID__ESPECIE) conteoEspecie
				left join catconf_009_especies especies on conteoEspecie.ID__ESPECIE=especies.ID__ESPECIE
				group by especies.ID__ESPECIE
							";
			$query = $this->db->query($sql,array($id))->result_array();				
			$i=0;
			foreach($query as $row)
			{
				$query[$i]["cantidadetiquetas"] = $this->db->query("select count(*) as total from catconf_071_etiquetas where ID__ESPECIE=? and ID__evento=? ",array($row["ID__ESPECIE"],$id))->row()->total;				
				$i++;
			}			
			return $query;
			
		}
		public function BusquedaInventarioEtiquetasDisponiblesConFiltro($ID__ESPECIE,$ID__EVENTO)
		{
			$datosevento = $this->db->query("SELECT * FROM catconf_065_eventos where ID__EVENTO=?",array($ID__EVENTO))->row();//->ID__EMPRESA;	
			$ID__EMPRESA=$datosevento->ID__EMPRESA;
			$VCH_ANIO=substr($datosevento->FEC_FECHAINICIO,0,4);				
			//die("pre");			
			$sql="select count(*) as cuantidad from catconf_071_etiquetas where ID__ESPECIE=? and  ID__EMPRESA=? and VCH_ANIO=? and  NUM_PERDIDA=0 and ID__EVENTO is null";			 
			$query = $this->db->query($sql,array($ID__ESPECIE,$ID__EMPRESA, $VCH_ANIO))->row()->cuantidad;	
			return intval($query);
		}
		public function AsignaEtiquetas($cantidad,$ID__ESPECIE,$ID__EVENTO)
		{
			$datosevento = $this->db->query("SELECT * FROM catconf_065_eventos where ID__EVENTO=?",array($ID__EVENTO))->row();
			$ID__EMPRESA=$datosevento->ID__EMPRESA;
			$VCH_ANIO=substr($datosevento->FEC_FECHAINICIO,0,4);	
			
			$cantidad=intval($cantidad);
			$sql="UPDATE catconf_071_etiquetas SET	ID__EVENTO=? where ID__ESPECIE=? and ID__EMPRESA=".$ID__EMPRESA." and VCH_ANIO=".$VCH_ANIO." and ID__EVENTO is null limit ".$cantidad;
			$this->db->query($sql,array($ID__EVENTO,$ID__ESPECIE));				
//						die($this->db->last_query());
			echo "Etiquetas asignadas";
		}
		/* CatalogoEventosEtiquetas abajo*/
		
		
		/*registro de talleres*/
		public function get_estados()
		{			
			$sql="SELECT * FROM catconf_004_estados";
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}
		public function get_municipios()
		{			
			$sql="SELECT * FROM catconf_005_municipios";
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}
		public function get_colonias()
		{			
			$sql="SELECT * FROM catconf_006_colonias";
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}
		public function get_registrotalleres($ID__TALLER, $VCH_TALLER)
		{
			$idt=" ";
			if(($ID__TALLER!=-1)&&($ID__TALLER!=""))
				{
					$idt="ID__TALLER='".$ID__TALLER."' and " ;
				}
			
			$sql="SELECT * FROM catconf_057_registrotalleres where ".$idt." VCH_TALLER like '%".$VCH_TALLER."%'";
			$query = $this->db->query($sql)->result_array();	
//			die($this->db->last_query());
			return $query;	
		}
		/*registro de talleres*/
				
		public function get_etiquetasParaOffline($ID__EVENTO)
		{
			$sql="select 		ID__ETIQUETA,VCH_QR,et.ID__ESPECIE,VCH_NOMBRECOMUN as especie,et.ID__EMPRESA,emp.VCH_NOMBREEMPRESA as empresa from catconf_071_etiquetas 
			et inner join catconf_009_especies especies on et.ID__ESPECIE=especies.ID__ESPECIE
			inner join catconf_013_empresa emp on et.ID__EMPRESA=emp.ID__EMPRESA where ID__EVENTO =? and  NUM_USADA=0";																	  									  
			$query = $this->db->query($sql,array($ID__EVENTO))->result_array();	
			return $query;
			
		}
		public function get_ArboladoParaOffline($ID__EVENTO)
		{			
			$sql="select REL.ID__ESPECIE,VCH_NOMBRECOMUN as especie,rel.ID__UBICACION, ubicacion.VCH_NOMBRE as ubicacion,rel.contenedor_id,contenedor_nombre as contenedor,NUM_EDADMESES,sum(NUM_CANTIDAD) as NUM_CANTIDAD
			, CASE NUM_EDADMESES 
			WHEN NUM_EDADMESES>=0 and NUM_EDADMESES<=3  THEN MES_TRES  
			WHEN NUM_EDADMESES>=4 and NUM_EDADMESES<=6  THEN MES_SEIS  
			WHEN NUM_EDADMESES>=7 and NUM_EDADMESES<=9  THEN MES_NUEVE  
			WHEN NUM_EDADMESES>=10 and NUM_EDADMESES<=12  THEN MES_DOCE  
			WHEN NUM_EDADMESES>=13 and NUM_EDADMESES<=18  THEN MES_DIECIOCHO  
			WHEN NUM_EDADMESES>=19 and NUM_EDADMESES<=24  THEN MES_VEINTICUATRO  
			WHEN NUM_EDADMESES>=25 and NUM_EDADMESES<=30  THEN MES_TREINTA  
			WHEN NUM_EDADMESES>=31 and NUM_EDADMESES<=36  THEN MES_TREINTAYSEIS  
			WHEN NUM_EDADMESES>=37 and NUM_EDADMESES<=42  THEN MES_CUARENTAYDOS  
			WHEN NUM_EDADMESES>=43 and NUM_EDADMESES<=48  THEN MES_CUARENTAYOCHO  
			WHEN NUM_EDADMESES>=49 and NUM_EDADMESES<=60  THEN MES_SESENTA  
			WHEN NUM_EDADMESES>=61 and NUM_EDADMESES<=72  THEN MES_SETENTAYDOS  
			ELSE 'fuera de limite' END
			as precio
				from catconf_066_relarboladoasignadoaevento rel
				 inner join catconf_009_especies especies on rel.ID__ESPECIE=especies.ID__ESPECIE
				 left join catconf_052_catalogoubicacion ubicacion on rel.ID__UBICACION=ubicacion.ID__UBICACION
				 left join catconf_062_contenedores bolsa on rel.contenedor_id=bolsa.contenedor_id
                 left join catconf_053_especieprecio on especies.ID__ESPECIE=catconf_053_especieprecio.ID__ESPECIE
				where ID__EVENTO=?                                 
                group by ID__ESPECIE,NUM_EDADMESES";																	  									  
			$query = $this->db->query($sql,array($ID__EVENTO))->result_array();	
			return $query;
			
		}
		public function get_etiquetasAdopcionCiudadana($ID__EVENTO)
		{
			$sql="select 		ID__ETIQUETA,VCH_QR,et.ID__ESPECIE,VCH_NOMBRECOMUN as especie,et.ID__EMPRESA,emp.VCH_NOMBREEMPRESA as empresa from catconf_071_etiquetas 
			et inner join catconf_009_especies especies on et.ID__ESPECIE=especies.ID__ESPECIE
			inner join catconf_013_empresa emp on et.ID__EMPRESA=emp.ID__EMPRESA  where NUM_USADA=0";																	  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;
			
		}
		public function get_ArboladoAdopcionCiudadana($ID__EVENTO)
		{			
			$sql="select REL.ID__ESPECIE,VCH_NOMBRECOMUN as especie,rel.ID__UBICACION, ubicacion.VCH_NOMBRE as ubicacion,rel.contenedor_id,contenedor_nombre as contenedor,(DATEDIFF(now(),FEC_FECHAGERMINACION)/30),sum(NUM_CANTIDAD) as NUM_CANTIDAD
			, CASE (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=0 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=3  THEN MES_TRES  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=4 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=6  THEN MES_SEIS  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=7 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=9  THEN MES_NUEVE  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=10 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=12  THEN MES_DOCE  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=13 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=18  THEN MES_DIECIOCHO  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=19 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=24  THEN MES_VEINTICUATRO  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=25 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=30  THEN MES_TREINTA  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=31 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=36  THEN MES_TREINTAYSEIS  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=37 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=42  THEN MES_CUARENTAYDOS  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=43 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=48  THEN MES_CUARENTAYOCHO  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=49 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=60  THEN MES_SESENTA  
			WHEN (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)>=61 and (DATEDIFF(now(),FEC_FECHAGERMINACION)/30)<=72  THEN MES_SETENTAYDOS  
			ELSE 'fuera de limite' END
			as precio
				from catconf_064_inventariosglobal rel
				 inner join catconf_009_especies especies on rel.ID__ESPECIE=especies.ID__ESPECIE
				 left join catconf_052_catalogoubicacion ubicacion on rel.ID__UBICACION=ubicacion.ID__UBICACION
				 left join catconf_062_contenedores bolsa on rel.contenedor_id=bolsa.contenedor_id
                 left join catconf_053_especieprecio on especies.ID__ESPECIE=catconf_053_especieprecio.ID__ESPECIE				                   
                group by ID__ESPECIE,(DATEDIFF(now(),FEC_FECHAGERMINACION)/30)";																	  									  
			$query = $this->db->query($sql,array($ID__EVENTO))->result_array();	
						
			return $query;

		}
		
		public function generaArchivoOffline($id)
		{			
			$nods["ID__EVENTO"]=$id;						
			$nods["VCH_NOMBREEVENTO"]=$this->db->query("select VCH_NOMBREEVENTO from catconf_065_eventos where ID__EVENTO=?",array($id))->row()->VCH_NOMBREEVENTO;
			$nods["etiquetas"]=$this->get_etiquetasParaOffline($id);
			$nods["arboles"]=$this->get_ArboladoParaOffline($id);
			return JSON_ENCODE($nods);
		}
		public function generaContenidoAdopcionCiudadana($id)
		{			
			$nods["ID__EVENTO"]=$id;						
			$nods["VCH_NOMBREEVENTO"]="Adopcion Ciudadana";
			$nods["etiquetas"]=$this->get_etiquetasAdopcionCiudadana($id);
			$nods["arboles"]=$this->get_ArboladoAdopcionCiudadana($id);
			return JSON_ENCODE($nods);
		}
		
		
		//Asi deberian enviarlo ellos cuando finalize el evento
		public function planesArchivoImportarAdopcion($id)
		{
			$nods["ID__EVENTO"]=$id;						
			$nods["etiquetas"]=$this->get_etiquetasParaOffline($id);
			//$nods["arboles"]=$this->generaArchivoOffline($id);
			$i=0;
			foreach ($nods["etiquetas"] as $etiqueta)
			{				
				if(rand(0,1))
				{
					$etiqueta["usada"]=1;
				}else
				{
					$etiqueta["usada"]=0;
				}
				$nods["etiquetas"][$i]=$etiqueta;
				$i++;
			}		
							
			$i=0;
			$nods["adopciones"]=array();									
			foreach ($nods["etiquetas"] as $etiqueta)
			{
				if($etiqueta["usada"]==1)
				{
					$arbol["ID__ESPECIE"]="645"; $arbol["NUM_EDAD"]="1";	$arbol["VCH_CODIGOQR"]="2017-645-000002";
					$arbol["VCH_CODIGOQRFINAL"]="2017-645-000002";	$arbol["NUM_CANTIDAD"]="1";	
					$arbol["VCH_LATITUD"]="20.5714541";	$arbol["VCH_LONGITUD"]="-103.4779451";						
										
					$guardabosque["VCH_NOMBRE"]="";	$guardabosque["VCH_APELLIDOPATERNO"]="";	$guardabosque["VCH_APELLIDOMATERNO"]="";
					$guardabosque["VCH_TELEFONO"]="";	$guardabosque["VCH_CELULAR"]="";	$guardabosque["ID__COLONIA"]="0";
					$guardabosque["VCH_CALLE"]="";	$guardabosque["VCH_ENTRECALLE"]="";	$guardabosque["VCH_CORREO"]="";
				
					
					$nods["adopciones"][$i]["arbol"]=$arbol;					
					$nods["adopciones"][$i]["guardabosque"]=$guardabosque;
					$i++;			
				}					
			}									
			die(JSON_ENCODE($nods));
		}
		
		
		
		public function insertarAdopcion($adopcion,$ID__EVENTO)
		{			
			$arbol=$adopcion["arbol"];
			$guardabosque=$adopcion["guardabosque"];
								
			//INSERTAMOS DOMICILIO DE GUARDABOSQUES
			//die(print_r($adopcion["guardabosque"]));
			$ID__DOMICILIO=$this->alta_Domicilio($guardabosque["ID__COLONIA"],$guardabosque["VCH_CALLE"],$guardabosque["VCH_ENTRECALLE"]);			
			
			//INSERTAMOS EL guardabosques
			$sql="
			INSERT INTO `catconf_012_guardabosques`
			(`ID__DOMICILIO`,`VCH_NOMBRE`,`VCH_APELLIDOPATERNO`,`VCH_APELLIDOMATERNO`,`VCH_TELEFONO`,
			`VCH_CELULAR`,`VCH_CORREO`)
			VALUES
			(?,?,?,?,?
			,?,?);
			";
			$query = $this->db->query($sql,
				array(
					$ID__DOMICILIO,$guardabosque["VCH_NOMBRE"],$guardabosque["VCH_APELLIDOPATERNO"],$guardabosque["VCH_APELLIDOMATERNO"],$guardabosque["VCH_TELEFONO"],
					$guardabosque["VCH_CELULAR"],$guardabosque["VCH_CORREO"]
				));	
			$ID__GUARDABOSQUE=$this->db->insert_id();	
			
			//INSERTAMOS EL registro de programacion de la adopcion traoper_049_progadopcion
			$sql="
			INSERT INTO `traoper_049_progadopcion`
			(`ID__ADOPCION`,`FEC_FECHAINICIO`,`FEC_FECHAFIN`,`NUM_SEGUIMIENTO`,`BND_ASIGNADO`)
			VALUES
			(?,now(),now(),1,0)
			";
			$query = $this->db->query($sql,
				array(
					$ID__EVENTO,
				));	
			$ID__PROGRAMACION=$this->db->insert_id();	
			
			//INSERTAMOS EL ARBOL
			$sql="
			INSERT INTO `catconf_020_arboles`
			(
			`ID__ESPECIE`,`NUM_EDAD`,`VCH_PROCEDENCIA`,`VCH_CODIGOQR`,
			`VCH_CODIGOQRFINAL`,`NUM_CANTIDAD`,`VCH_ESTATUS`,`VCH_LATITUD`,`VCH_LONGITUD`,
			`ID__UBICACION`,`FEC_FECHA`)
			VALUES
			(?,?,?,?,
			?,?,?,?,?,
			0,now());";
			$query = $this->db->query($sql,
				array(
					$arbol["ID__ESPECIE"],$arbol["NUM_EDAD"],"  ",$arbol["VCH_CODIGOQR"],
					$arbol["VCH_CODIGOQR"],1,1,$arbol["VCH_LATITUD"],$arbol["VCH_LONGITUD"])
				);	
			$ID__ARBOL=$this->db->insert_id();	


			//INSERTAMOS EL REGISTRO DE ADOPCION CON EL ID DEL ARBOL									
			$sql="
			INSERT INTO `traoper_021_registroadopcion`
			(`ID__GUARDABOSQUE`,`ID__ARBOL`,`ID__EVENTOADOPCION`,
			`NUM_CANTIDAD`,`FEC_FECHA`,`VCH_FOTO`,`VCH_ESTATUS`,`ID__PROGRAMACION`)
			VALUES
			(?,?,?,
			1,now(),null,1,?);";
			$query = $this->db->query($sql,
				array(
						$ID__GUARDABOSQUE,$ID__ARBOL,$ID__EVENTO,$ID__PROGRAMACION
				));	
				
		}
		public function ProcesarEtiquetaTrasEvento($VCH_QR,$NUM_USADA)
		{			
			$queryevento=" ";
			if($NUM_USADA==0)
			{
				$queryevento=", ID__EVENTO = null ";
			}									
			$sql="UPDATE catconf_071_etiquetas set NUM_USADA=".$NUM_USADA." ".$queryevento." where VCH_QR='".$VCH_QR."'";			
			//die($sql);
			$query = $this->db->query($sql);	
		}
		public function FinalizarEvento($JSON)
		{	
			$JSON=JSON_DECODE($JSON);
			$JSON = json_decode(json_encode($JSON), true);
			$ID__EVENTO=$JSON["ID__EVENTO"];
			$etiquetas=$JSON["etiquetas"];
			$adopciones=$JSON["adopciones"];
			
			//por cada etiqueta seteale que esta en uso o liberala del evento
			if(is_array($etiquetas))
			{
				foreach($etiquetas as $etiqueta)	
				{				
						$this->ProcesarEtiquetaTrasEvento($etiqueta["VCH_QR"],$etiqueta["usada"]);					
				}
			}
			
			//Por cada registro de adopcion...enviar el arreglo de guardabosques, y arbol
			if(is_array($adopciones))
			{
				foreach($adopciones as $adopcion)	
				{								
						$this->insertarAdopcion($adopcion,$ID__EVENTO);					
				}			
			}
		}
		
		public function get_Select_talleristas()
		{
			$sql="SELECT ID__USUARIO,concat(VCH_APELLIDOPATERNO,' ',VCH_NOMBRE,' ',VCH_APELLIDOMATERNO) as tallerista FROM catconf_007_usuarios";			
			$sql.=" order by VCH_APELLIDOPATERNO asc ";									  									  
			$query = $this->db->query($sql)->result_array();		
			return $query;			
		}
		public function get_Select_embajadores()
		{
			$sql="SELECT ID__EMBAJADOR,concat(VCH_APELLIDOPATERNO,' ',VCH_NOMBRE,' ',VCH_APELLIDOMATERNO) embajador FROM catconf_019_embajadores";			
			$sql.=" order by VCH_APELLIDOPATERNO asc ";									  									  
			$query = $this->db->query($sql)->result_array();		
			return $query;												
		}
		
		public function inserta_RegistroTaller($data,$talleristas,$embajadores,$asistentes,$ID__COLONIA)
		{	
			
			$ID__DOMICILIO=0;
			if(($ID__COLONIA!=0)&&($ID__COLONIA!=''))
			{
				$ID__DOMICILIO=$this->alta_Domicilio($ID__COLONIA," "," ");												
			}					
			
			//REGISTRO DE TALLERES, DATOS GENERALES, PESTAÑA Datos Principales Y Contacto			
			$sql="INSERT INTO catconf_057_registrotalleres
					(VCH_TALLER,ID__TALLER,NUM_SESIONES,NUM_CONVOCADOS,ID__PATROCINADOR,
					VCH_INSTALACIONES,VCH_CONTACTO,VCH_CARGO,VCH_TELEFONO,VCH_CELULAR,
					VCH_CORREO,ID__DOMICILIO,VCH_NOMBRE,VCH_CLAVETALLER)
					VALUES
					(?,?,?,?,?,
					?,?,?,?,?,
					?,?,?,?);
					";								
			$query = $this->db->query($sql,array(
					$data["VCH_TALLER"],$data["ID__TALLER"],$data["NUM_SESIONES"],$data["NUM_CONVOCADOS"],$data["ID__PATROCINADOR"],
					$data["VCH_INSTALACIONES"],$data["VCH_CONTACTO"],$data["VCH_CARGO"],$data["VCH_TELEFONO"],$data["VCH_CELULAR"],
					$data["VCH_CORREO"],$ID__DOMICILIO ,$data["VCH_TALLER"],$data["VCH_CLAVETALLER"]
												)
									 );		
			$ID__CVETALLER=$this->db->insert_id();	
			//REGISTRO DE TALLERES, DATOS GENERALES, PESTAÑA Datos Principales Y Contacto
									
									
			//Datos Sesiones
			
			$fecha=$data["FEC_FECHA1"];	//inicializar para el while
			$i=1;
			while(!empty($fecha))
			{
				//die($data["FEC_FECHA".($i+1)]."?".print_r($data));
				if(!empty($data["FEC_FECHA".($i)]))
				{										
					$sql="INSERT INTO catconf_058_convocadostalleres
					(ID__CLAVETALLER,FEC_FECHA,VCH_HORA,INT_ASISTENCIA)
					VALUES
					(?,?,?,?)";
					$query = $this->db->query
										($sql,array(
													$ID__CVETALLER,$data["FEC_FECHA".$i],$data["VCH_HORA".$i],$data["INT_ASISTENCIA".$i]
													)
										);		
										
					$fecha=$data["FEC_FECHA".($i++)];
				}
				else
				{
					$fecha=null;
				}				
				
			}
			//Datos Sesiones
									
							
			//Talleristas
			$talleristas=json_decode($talleristas);
			if(is_array($talleristas))
			{
				foreach($talleristas as $tallerista)
				{
					$sql="INSERT INTO catconf_059_talleristasxtaller
						(ID__CLAVETALLER,VCH_NOMBRE)
						VALUES
						(?,?);";
					$query = $this->db->query
										($sql,array(
													$ID__CVETALLER,$tallerista
													)
										);		
					
				}
			}
			//Talleristas				
							
			//Embajadores
			$embajadores=json_decode($embajadores);
			if(is_array($embajadores))
			{
				foreach($embajadores as $embajador)
				{
					$sql="INSERT INTO catconf_060_embajadortaller
							(ID__CLAVETALLER,VCH_NOMBRE)
							VALUES
							(?,?);";
					$query = $this->db->query
										($sql,array(
													$ID__CVETALLER,$embajador
													)
										);		
					
				}
			}
			//Embajadores				
							
			//asistentess
			if(is_array($asistentes))
			{
				
				foreach($asistentes as $asistente)
				{
					$sql="INSERT INTO catconf_061_asistentestalleres
							(ID__CLAVETALLER,VCH_NOMBRE,VCH_CORREO,VCH_TELEFONO)
							VALUES
							(?,?,?,?);";
					$query = $this->db->query
										($sql,array(
													$ID__CVETALLER,$asistente["nombre"],$asistente["correo"],$asistente["telefono"]
													)
										);		
					
					
				}
			}
			//Embajadores									
		}
		public function edita_RegistroTaller($data,$talleristas,$embajadores,$asistentes,$ID__COLONIA,$ID__DOMICILIO)
		{	
			
			
			$ID__DOMICILIO=0;
			if(($ID__COLONIA!=0)&&($ID__COLONIA!=''))
			{
				edita_Domicilio($ID__DOMICILIO,$ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE);
			}					
			
			//REGISTRO DE TALLERES, DATOS GENERALES, PESTAÑA Datos Principales Y Contacto			
			$sql="update catconf_057_registrotalleres
					set VCH_TALLER=?,ID__TALLER=?,NUM_SESIONES=?,NUM_CONVOCADOS=?,ID__PATROCINADOR=?,
					VCH_INSTALACIONES=?,VCH_CONTACTO=?,VCH_CARGO=?,VCH_TELEFONO=?,VCH_CELULAR=?,
					VCH_CORREO=?,VCH_NOMBRE=?,VCH_CLAVETALLER=?
					where ID__CVETALLER=?;
					";								
			$query = $this->db->query($sql,array(
					$data["VCH_TALLER"],$data["ID__TALLER"],$data["NUM_SESIONES"],$data["NUM_CONVOCADOS"],$data["ID__PATROCINADOR"],
					$data["VCH_INSTALACIONES"],$data["VCH_CONTACTO"],$data["VCH_CARGO"],$data["VCH_TELEFONO"],$data["VCH_CELULAR"],
					$data["VCH_CORREO"],$data["VCH_TALLER"],$data["VCH_CLAVETALLER"],$data["ID__CVETALLER"]
												)
									 );		
			$ID__CVETALLER=$data["ID__CVETALLER"];	
			//REGISTRO DE TALLERES, DATOS GENERALES, PESTAÑA Datos Principales Y Contacto
									
									
			//Datos Sesiones
			
			$sql="delete from catconf_058_convocadostalleres where ID__CLAVETALLER=?";
			$query = $this->db->query($sql,array($ID__CVETALLER));	
						
			$fecha=$data["FEC_FECHA1"];	//inicializar para el while
			$i=1;
			while(!empty($fecha))
			{
				//die($data["FEC_FECHA".($i+1)]."?".print_r($data));
				if(!empty($data["FEC_FECHA".($i)]))
				{										
					$sql="INSERT INTO catconf_058_convocadostalleres
					(ID__CLAVETALLER,FEC_FECHA,VCH_HORA,INT_ASISTENCIA)
					VALUES
					(?,?,?,?)";
					$query = $this->db->query
										($sql,array(
													$ID__CVETALLER,$data["FEC_FECHA".$i],$data["VCH_HORA".$i],$data["INT_ASISTENCIA".$i]
													)
										);		
										
					$fecha=$data["FEC_FECHA".($i++)];
				}
				else
				{
					$fecha=null;
				}				
				
			}
			//Datos Sesiones
									
							
			//Talleristas
			$sql="delete from catconf_059_talleristasxtaller where ID__CLAVETALLER=?";
			$query = $this->db->query($sql,array($ID__CVETALLER));	
			
			$talleristas=json_decode($talleristas);
			if(is_array($talleristas))
			{
				foreach($talleristas as $tallerista)
				{
					$sql="INSERT INTO catconf_059_talleristasxtaller
						(ID__CLAVETALLER,VCH_NOMBRE)
						VALUES
						(?,?);";
					$query = $this->db->query
										($sql,array(
													$ID__CVETALLER,$tallerista
													)
										);		
					
				}
			}
			//Talleristas				
							
			//Embajadores
			$sql="delete from catconf_060_embajadortaller where ID__CLAVETALLER=?";
			$query = $this->db->query($sql,array($ID__CVETALLER));	
			$embajadores=json_decode($embajadores);
			if(is_array($embajadores))
			{
				foreach($embajadores as $embajador)
				{
					$sql="INSERT INTO catconf_060_embajadortaller
							(ID__CLAVETALLER,VCH_NOMBRE)
							VALUES
							(?,?);";
					$query = $this->db->query
										($sql,array(
													$ID__CVETALLER,$embajador
													)
										);		
					
				}
			}
			//Embajadores				
							
			//asistentess
			$sql="delete from catconf_061_asistentestalleres where ID__CLAVETALLER=?";
			$query = $this->db->query($sql,array($ID__CVETALLER));	
			if(is_array($asistentes))
			{
				
				foreach($asistentes as $asistente)
				{
					$sql="INSERT INTO catconf_061_asistentestalleres
							(ID__CLAVETALLER,VCH_NOMBRE,VCH_CORREO,VCH_TELEFONO)
							VALUES
							(?,?,?,?);";
					$query = $this->db->query
										($sql,array(
													$ID__CVETALLER,$asistente["nombre"],$asistente["correo"],$asistente["telefono"]
													)
										);		
					
					
				}
			}
			//Embajadores									
		}
		
		public function get_TallerRegistro($ID__CVETALLER)
		{
			$sql="SELECT * FROM catconf_057_registrotalleres where ID__CVETALLER=?";			
			$registrotalleres = $this->db->query($sql,array($ID__CVETALLER))->result_array();		
			
			$sql="SELECT * FROM catconf_058_convocadostalleres where ID__CLAVETALLER=?";			
			$convocadortalleres = $this->db->query($sql,array($ID__CVETALLER))->result_array();		
			
			$sql="SELECT * FROM catconf_059_talleristasxtaller where ID__CLAVETALLER=?";			
			$talleristas = $this->db->query($sql,array($ID__CVETALLER))->result_array();		
			
			$sql="SELECT * FROM catconf_060_embajadortaller where ID__CLAVETALLER=?";			
			$embajadores = $this->db->query($sql,array($ID__CVETALLER))->result_array();		
			
			$sql="SELECT * FROM catconf_061_asistentestalleres where ID__CLAVETALLER=?";			
			$asistentes = $this->db->query($sql,array($ID__CVETALLER))->result_array();					
			
			$query["registrotalleres"]=$registrotalleres;
			$query["convocadortalleres"]=$convocadortalleres;
			$query["talleristas"]=$talleristas;
			$query["embajadores"]=$embajadores;
			$query["asistentes"]=$asistentes;			
			return $query;	
		}
		
		
		/*Nuevo hacia abajo 21 julio*/
		
		public function get_selectEspeciesConAdopcion()
		{												
			$sql="SELECT catconf_009_especies.ID__ESPECIE,catconf_009_especies.VCH_NOMBRECOMUN FROM catconf_009_especies 
			inner join 
			(
				select ID__ESPECIE from catconf_020_arboles group by ID__ESPECIE
			)existentes on catconf_009_especies.ID__ESPECIE=existentes.ID__ESPECIE
			order by VCH_NOMBRECOMUN asc";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	  
		public function get_selectEventosConAdopcion()
		{												
			$sql="SELECT ID__EVENTO,VCH_NOMBREEVENTO FROM catconf_065_eventos 
			inner join 
			(
				select * from traoper_021_registroadopcion group by ID__EVENTOADOPCION
				
			)existentes on catconf_065_eventos.ID__EVENTO=existentes.ID__EVENTOADOPCION
			order by VCH_NOMBREEVENTO asc";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	  
		public function get_selectEmpresasConAdopcion()
		{												
			$sql="
			SELECT ID__EMPRESA,VCH_NOMBREEMPRESA from catconf_013_empresa
			where ID__EMPRESA in 
			(
				SELECT ID__EMPRESA FROM catconf_065_eventos 
			) order by VCH_NOMBREEMPRESA";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}	  
		
		
		
		public function traer_ArbolesMapa($ID__EMPRESA,$ID__EVENTO,$ID__ESPECIE)
		{												
			$sql="
			SELECT * FROM traoper_021_registroadopcion regadop 
				inner join catconf_012_guardabosques guarda on regadop.ID__GUARDABOSQUE=guarda.ID__GUARDABOSQUE
				inner join catconf_020_arboles	arb on regadop.ID__ARBOL =arb.ID__ARBOL
				inner join catconf_065_eventos	eve on regadop.ID__EVENTOADOPCION=eve.ID__EVENTO
				where  1=1
				";													  									  
			if($ID__EMPRESA!=-1)	
			{
				$sql.=" and ID__EMPRESA=".intval($ID__EMPRESA);
			}
			if($ID__EVENTO!=-1)	
			{
				$sql.=" and ID__EVENTO=".intval($ID__EVENTO);
			}
			if($ID__ESPECIE!=-1)	
			{
				$sql.=" and ID__ESPECIE=".intval($ID__ESPECIE);
			}
			$query = $this->db->query($sql)->result_array();	
			//die($this->db->last_query());
			return $query;			
		}	  
		
		
		public function get_Geocerca($ID__ESTADO,$ID__MUNICIPIO)
		{			
					
			if($ID__MUNICIPIO!=-1)
			{
				$sql="select GEOCERCA from catconf_005_municipios where ID__MUNICIPIO =?";													  									  
				$res=$this->db->query($sql,array($ID__MUNICIPIO))->result_array();
			}
			else
			{
				$sql="select GEOCERCA from catconf_004_estados where ID__ESTADO =?";													  									  
				$res=$this->db->query($sql,array($ID__ESTADO))->result_array();	
			}									
			return $res;
		}
		public function altaGeocerca($ID__ESTADO,$ID__MUNICIPIO,$arr)
		{
			try
			{
				if($ID__MUNICIPIO!=-1)
				{
					$sql="update catconf_005_municipios  set GEOCERCA=? where ID__MUNICIPIO =?";													  									  
					$this->db->query($sql,array($arr,$ID__MUNICIPIO));
				}
				else
				{
					$sql="update catconf_004_estados  set GEOCERCA=? where ID__ESTADO =?";													  									  
					$this->db->query($sql,array($arr,$ID__ESTADO));	
				}				
				echo "Geocerca guardada exitosamente";
			}		
			catch(\Exception $e)
			{
				die("No se pudo crear la geocerca ".$e);
			}
		}
		public function liberarDEevento($inventarioInicial,$ID__EVENTO)
		{			 
			die(print_r($inventarioInicial));
			//operaciones entre el JSON de inicio y los registros de adopcion que tenemos en la base de datos			
			$usados=$this->db->query("select ID__ESPECIE,NUM_EDAD,count(*) as usados from catconf_020_arboles where ID__ARBOL in(
			select ID__ARBOL from traoper_021_registroadopcion where ID__EVENTOADOPCION=27)
			group by ID__ESPECIE,NUM_EDAD",array($ID__EVENTO))->result_array();	
			$indiceauxiliar=0;
			foreach($inventarioInicial as $inicial)	//Por cada uno de los iniciales busca si lo tienes en el array de usados y restalo, luego reinserta el inventario inicial en la zona de recuperacion			
			{
				foreach($usados as $usado)
				{
					if(($inicial["ID__ESPECIE"]==$usado["ID__ESPECIE"]) && ($inicial["NUM_EDADMESES"]==$usado["NUM_EDAD"]) )
					{						
						$inventarioInicial[$indiceauxiliar]["NUM_CANTIDAD"]=intval($inventarioInicial[$indiceauxiliar]["NUM_CANTIDAD"])-intval($usado["usados"]);
						break;
					}
				}				
				$indiceauxiliar++;
			}
			//operaciones entre el JSON de inicio y los registros de adopcion que tenemos en la base de datos			
			
			die("not so fast");
			//Recuperacion Inventario
			foreach($inventarioInicial as $inicial)	
			{
				//date("y:F:d",strtotime("-".$inicial["NUM_EDADMESES"]." Months"))								
				$idPREVIO=buscar_altaInventarioGlobalRepetido(0,$inicial["ID__ESPECIE"],0,$inicial["contenedor_id"], date('Y-m-d', strtotime('-'.$inicial["NUM_EDADMESES"].' month')));// ubicacion 0 es zona recuperacion				
				if(!empty($idPREVIO))
				{
					$idPREVIO=$idPREVIO[0]["ID__INVENTARIO"];
					$this->alta_inventarioGlobalCombinar($idPREVIO,$inicial["NUM_CANTIDAD"]);
				}	
				else
				{
					$this->alta_inventarioGlobal(0,$inicial["ID__ESPECIE"],0,$inicial["contenedor_id"],date('Y-m-d', strtotime('-'.$inicial["NUM_EDADMESES"].' month')),$inicial["NUM_CANTIDAD"]);
				}
			}

			//release the stickers	
			$sql="UPDATE catconf_071_etiquetas SET ID__EVENTO = null WHERE ID__EVENTO = ? and NUM_USADA=0;";													  									  
			$this->db->query($sql,array($ID__EVENTO));	
			
			//setear evento a concluido			
			$sql="UPDATE catconf_065_eventos SET VCH_ESTATUS = 2 WHERE ID__EVENTO = ?;";													  									  
			$this->db->query($sql,array($ID__EVENTO));	
			
			
			//Recuperacion Inventario									
		}
}
