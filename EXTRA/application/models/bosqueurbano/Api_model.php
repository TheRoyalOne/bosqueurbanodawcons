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
			$foto=null;

			if(!empty($arbol["FOTO"]!=''))
			{
				$QRAdopcion=preg_replace("/[^0-9\-]/", "", $arbol["VCH_CODIGOQR"]);												
				$folder="C:\\xampp\\htdocs\\Extra\\uploads\\Evidencias\\".$ID__EVENTO;		
				if (!file_exists($folder)) 
				{
					mkdir($folder, 0777, true);
				}
				$foto=$folder."\\".$QRAdopcion.".jpg";						
				$arbol["FOTO"]=str_replace(' ', '+', $arbol["FOTO"]);										
				file_put_contents($foto, base64_decode($arbol["FOTO"]));				
			}			
												
			//INSERTAMOS EL guardabosques
			$sql="
			INSERT INTO catconf_012_guardabosques
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



				$ID__DOMICILIO=0;
				$ID__GUARDABOSQUE=0;
				if(!empty($rowguarda))
				{
					$ID__DOMICILIO=$rowguarda->ID__DOMICILIO;
					$ID__GUARDABOSQUE=$rowguarda->ID__GUARDABOSQUE;
				}
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

					//$this->setClaveGuardabosque($ID__GUARDABOSQUE);
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
			
			
						
			try
			{
				$sql="
				INSERT INTO catconf_020_arboles
				( ID__ESPECIE,NUM_EDAD,VCH_PROCEDENCIA,VCH_CODIGOQR,
				  VCH_CODIGOQRFINAL,NUM_CANTIDAD,VCH_ESTATUS,VCH_LATITUD,VCH_LONGITUD,
				  ID__UBICACION,FEC_FECHA,ID__EVENTO)
				VALUES
				( '".$arbol['ID__ESPECIE']."','".$arbol['NUM_EDAD']."',' ','".$arbol["VCH_CODIGOQR"]."',
				'".$arbol["VCH_CODIGOQR"]."','1','1','".$arbol["VCH_LATITUD"]."','".$arbol["VCH_LONGITUD"]."',
				'0',now(),'".$ID__EVENTO."');";

				//$this->db->query($sql,array($arbol["ID__ESPECIE"],$arbol["NUM_EDAD"],"  ",$arbol["VCH_CODIGOQR"],$arbol["VCH_CODIGOQR"],1,1,$arbol["VCH_LATITUD"],$arbol["VCH_LONGITUD"],
				//$ID__EVENTO
				//));
				$this->db->query($sql); 
			}
			catch(\Exception $e)
			{			

				$this->db->trans_rollback();						
				die("Error en los datos de entrada - Arbol ->".$sql."<-");
			}			
			$ID__ARBOL=$this->db->insert_id();	


			//INSERTAMOS EL REGISTRO DE ADOPCION CON EL ID DEL ARBOL									
			$sql="
			INSERT INTO `traoper_021_registroadopcion`
			(`ID__GUARDABOSQUE`,`ID__ARBOL`,`ID__EVENTOADOPCION`,
			`NUM_CANTIDAD`,`FEC_FECHA`,`VCH_FOTO`,`VCH_ESTATUS`,`ID__PROGRAMACION`)
			VALUES
			(?,?,?,
			1,now(),?,1,?);";
			
			try
			{
				$this->db->query($sql,array($ID__GUARDABOSQUE,$ID__ARBOL,$ID__EVENTO, $foto	,$ID__PROGRAMACION));
			}
			catch(\Exception $e)
			{
				//die($e);
				$this->db->trans_rollback();
				die("Error en los datos de entrada - Registro de adopcion");
			}

				
		}
		
		public function FinalizarEvento($JSON)	//endpoint offline
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
				$this->db->trans_commit();

				//Por cada registro de adopcion...enviar el arreglo de guardabosques, y arbol
				if(is_array($adopciones))
				{
					$this->db->trans_start();
					foreach($adopciones as $adopcion)	
					{								
						
						$this->insertarAdopcion($adopcion,$ID__EVENTO);														
					}			
					$this->db->trans_commit();			
				}
				//$this->db->trans_rollback();				
				
			}
			catch(\Exception $e)
			{								
				$this->db->trans_rollback();
				echo "Error en los datos de entrada";
			}
			echo "PERFECT";
			
		}





		public function ProcesarEtiquetaTrasEvento($VCH_QR,$NUM_USADA,$ID__EVENTO)
		{			
			$queryevento=" ";
			if($NUM_USADA==1)
			{
				
				$queryevento=", ID__EVENTO = ".$ID__EVENTO;
				$sql="UPDATE catconf_071_etiquetas set NUM_USADA=? ".$queryevento." where VCH_QR=?";						
				try
				{
					$this->db->query($sql,array($NUM_USADA,$VCH_QR));
				}
				catch(\Exception $e)
				{				
				
					$this->db->trans_rollback();
					//die($e);
					die("Error en los datos de entrada - Etiquetas".$e);
				}
			}								
								
		}

		public function setClaveGuardabosque($ID__GUARDABOSQUE)
		{							
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randstring = '';
			for ($i = 0; $i < 6; $i++) 
			{
				$randstring .= $characters[rand(0, strlen($characters)-1)];
			}
			
			$sql="select * from catconf_012_guardabosques where ID__GUARDABOSQUE =?";													  									  
			$correo=$this->db->query($sql,array($ID__GUARDABOSQUE))->row()->VCH_CORREO;	
			
			$sql="update catconf_012_guardabosques  set VCH_PASSWORD=? where ID__GUARDABOSQUE =?";													  									  
			$this->db->query($sql,array(md5($randstring),$ID__GUARDABOSQUE));															
			$this->sendMailGuardabosque($correo,$randstring);
				//die(print_r(get_defined_vars()));
			return; 
		}		
		public function sendMailGuardabosque($correo,$clave)
		{
			
			
			$html="¡Felicidades! has sido registrado como Guardabosque Urbano, tu cuenta de acceso es: <br/>
					Usuario: ".$correo."<br/>
					Contraseña: ".$clave."<br/>
					Ahora eres parte del Bosque Urbano, confiamos en tu compromiso…<br/>
					<br/><br/>
					ATTE.<br/><br/>
					<br/>
					Extra A.C
					";									
			
				$config['protocol']    = 'smtp';
				$config['smtp_host']    = 'ssl://smtp.gmail.com';
				$config['smtp_port']    = '465';
				$config['smtp_timeout'] = '7';
				$config['smtp_user']    = 'vivero@extra.org.mx';
				$config['smtp_pass']    = 'ichliebemeinekatze18';
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['mailtype'] = 'text'; // or html
				$config['validation'] = TRUE; // bool whether to validate email or not   
				$this->load->library('email',$config);
				$this->email->from('noreply@extra.org.mx', 'Extra A.C');				
				$this->email->to($correo);		
				$this->email->subject('Extra A.C - Guardabosques urbano.');
				$this->email->message($html);
				$this->email->send();
			//die(print_r(get_defined_vars()));
		}						
}
