<?php
class Api_model extends CI_Model 
{
		/* Lo que hice, lo hice sin elección... en el nombre de la paz y la cordura Pero no en el nombre del Doctor*/
        public function __construct()
        {
				/*$config['hostname'] = "localhost";
				$config['username'] = "myusername";
				$config['password'] = "mypassword";
				$config['database'] = $customUserDatabase;
				$config['dbdriver'] = "mysql";
				$config['dbprefix'] = "";
				$config['pconnect'] = FALSE;
				$config['db_debug'] = TRUE;*/
                //$this->load->database($config);
                $this->load->database();
                $this->load->library('session');
        }        				        
        public function alta_Domicilio($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE)
		{								
			$sql='INSERT INTO catconf_008_domicilios(ID__COLONIA,VCH_CALLE,VCH_ENTRECALLE)VALUES(?,?,?)';						
			try
			{
				$this->db->query($sql,array($ID__COLONIA,$VCH_CALLE,$VCH_ENTRECALLE));
				return $this->db->insert_id();
			}
			catch(\Exception $e)
			{
				//die($e);
				$this->db->trans_rollback();
				die("Error en los datos de entrada - Domicilio");
			}
			
		}		
		public function insertarAdopcion($adopcion,$ID__EVENTO)
		{			
			$arbol=$adopcion["arbol"];
			$guardabosque=$adopcion["guardabosque"];
														
			//INSERTAMOS EL guardabosques
			$sql="
			INSERT INTO `catconf_012_guardabosques`
			(`ID__DOMICILIO`,`VCH_NOMBRE`,`VCH_APELLIDOPATERNO`,`VCH_APELLIDOMATERNO`,`VCH_TELEFONO`,
			`VCH_CELULAR`,`VCH_CORREO`)
			VALUES
			(?,?,?,?,?
			,?,?);
			";
			$sqlBusqueda="
			select * from catconf_012_guardabosques
			where VCH_NOMBRE=? and VCH_APELLIDOPATERNO=? and VCH_APELLIDOMATERNO=?";
			
			try
			{				
				$rowguarda=$this->db->query($sqlBusqueda,array($guardabosque["VCH_NOMBRE"],$guardabosque["VCH_APELLIDOPATERNO"],$guardabosque["VCH_APELLIDOMATERNO"]))->row();												
				$ID__DOMICILIO=$rowguarda->ID__DOMICILIO;
				$ID__GUARDABOSQUE=$rowguarda->ID__GUARDABOSQUE;
				if($ID__DOMICILIO!=0&&(!empty($ID__DOMICILIO)))				
				{
					//Ya existe domicilio y guardabosques
				}
				else
				{
					//INSERTAMOS DOMICILIO DE GUARDABOSQUES			
					$ID__DOMICILIO=$this->alta_Domicilio($guardabosque["ID__COLONIA"],$guardabosque["VCH_CALLE"],$guardabosque["VCH_ENTRECALLE"]);			
					
					//Insertamos guardabosques					
					$this->db->query($sql,array(
						$ID__DOMICILIO,$guardabosque["VCH_NOMBRE"],$guardabosque["VCH_APELLIDOPATERNO"],$guardabosque["VCH_APELLIDOMATERNO"],$guardabosque["VCH_TELEFONO"],
						$guardabosque["VCH_CELULAR"],$guardabosque["VCH_CORREO"]
					));																			
					$ID__GUARDABOSQUE=$this->db->insert_id();						
				}

			}
			catch(\Exception $e)
			{
				//die($e);
				$this->db->trans_rollback();
				die("Error en los datos de entrada - Guardabosques");
			}
			
			//INSERTAMOS EL registro de programacion de la adopcion traoper_049_progadopcion
			$sql="
			INSERT INTO `traoper_049_progadopcion`
			(`ID__ADOPCION`,`FEC_FECHAINICIO`,`FEC_FECHAFIN`,`NUM_SEGUIMIENTO`,`BND_ASIGNADO`)
			VALUES
			(?,now(),now(),1,0)
			";			
			
			try
			{
				$this->db->query($sql,array($ID__EVENTO));
				$ID__PROGRAMACION=$this->db->insert_id();	
			}
			catch(\Exception $e)
			{
				//die($e);
				$this->db->trans_rollback();
				die("Error en los datos de entrada - Programacion de adopcion");
			}
			
			
			
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
			try
			{
				$this->db->query($sql,array($arbol["ID__ESPECIE"],$arbol["NUM_EDAD"],"  ",$arbol["VCH_CODIGOQR"],$arbol["VCH_CODIGOQR"],1,1,$arbol["VCH_LATITUD"],$arbol["VCH_LONGITUD"]));
			}
			catch(\Exception $e)
			{
				//die($e);
				$this->db->trans_rollback();
				die("Error en los datos de entrada - Arbol");
			}			
			$ID__ARBOL=$this->db->insert_id();	


			//INSERTAMOS EL REGISTRO DE ADOPCION CON EL ID DEL ARBOL									
			$sql="
			INSERT INTO `traoper_021_registroadopcion`
			(`ID__GUARDABOSQUE`,`ID__ARBOL`,`ID__EVENTOADOPCION`,
			`NUM_CANTIDAD`,`FEC_FECHA`,`VCH_FOTO`,`VCH_ESTATUS`,`ID__PROGRAMACION`)
			VALUES
			(?,?,?,
			1,now(),null,1,?);";
			
			try
			{
				$this->db->query($sql,array($ID__GUARDABOSQUE,$ID__ARBOL,$ID__EVENTO,$ID__PROGRAMACION));
			}
			catch(\Exception $e)
			{
				//die($e);
				$this->db->trans_rollback();
				die("Error en los datos de entrada - Registro de adopcion");
			}
				
		}
		public function ProcesarEtiquetaTrasEvento($VCH_QR,$NUM_USADA,$ID__EVENTO)
		{			
			$queryevento=" ";
			if($NUM_USADA==0)
			{
				//$queryevento=", ID__EVENTO = null ";
			}	
			else
			{
				$queryevento=", ID__EVENTO = ".$ID__EVENTO;
			}								
			$sql="UPDATE catconf_071_etiquetas set NUM_USADA=? ".$queryevento." where VCH_QR=?";						
			
			try
			{
				$this->db->query($sql,array($NUM_USADA,$VCH_QR));
			}
			catch(\Exception $e)
			{				
			
				$this->db->trans_rollback();
				//die($e);
				die("Error en los datos de entrada - Etiquetas");
			}
		}
		public function FinalizarEvento($JSON)
		{	
			$ID__EVENTO=$JSON["ID__EVENTO"];
			$etiquetas=$JSON["etiquetas"];
			$adopciones=$JSON["adopciones"];						
			try
			{				
				$this->db->trans_start();
				//por cada etiqueta seteale que esta en uso o liberala del evento
				if(is_array($etiquetas))
				{
					foreach($etiquetas as $etiqueta)	
					{									
							$this->ProcesarEtiquetaTrasEvento($etiqueta["VCH_QR"],$etiqueta["usada"],$ID__EVENTO);
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
				//$this->db->trans_rollback();				
				$this->db->trans_commit();
			}
			catch(\Exception $e)
			{								
				$this->db->trans_rollback();
				echo "Error en los datos de entrada";
			}
			
		}						
}
