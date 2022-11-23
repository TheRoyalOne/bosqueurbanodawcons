<?php
class Arbol_model extends CI_Model 
{
		/* Lo que hice, lo hice sin elección... en el nombre de la paz y la cordura Pero no en el nombre del Doctor*/
        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }        
                
        public function get_MisGuardabosques()
		{							
			//Obtiene TODOS los ID de arboles , guardabosques y nombres por los cuales preguntar
			$compilado=array();
			$compiladoFinal=array();
			$sqls='
			select ID__ARBOL,guard.ID__GUARDABOSQUE,concat(VCH_NOMBRE," ",VCH_APELLIDOPATERNO," ",VCH_APELLIDOMATERNO) nombre from traoper_021_registroadopcion regad 
			lEFT JOIN catconf_012_guardabosques guard ON regad.ID__GUARDABOSQUE=guard.ID__GUARDABOSQUE
			where
			regad.ID__GUARDABOSQUE in 
			(
				SELECT ID__GUARDABOSQUE FROM catconf_075_asignacion_guardabosques_embajador where ID__EMBAJADOR='.$this->session->userdata["logged_in"]["ID__EMBAJADOR"].'
			)
			and regad.ID__GUARDABOSQUE not in 
			(
				select ID__GUARDABOSQUE from traoper_052_seguimientos_fallidos
			)
			and DATE_CREATE >  "2020-01-01 00:00:00"
			order by nombre desc';			

			$arbolesyGuardabosques=$this->db->query($sqls)->result_array();

			//die($this->db->last_query());					
			//echo "<pre>"; die(print_r($otravariable));					



					//Extrae el ultimo seguimiento de cada arbol implicado y su estado (en caso de muerte, se omite)
					$cont =0;
					foreach($arbolesyGuardabosques as $arb) {
						$cont++;

						$sql="SELECT  
						IFNULL(
								( 
								select FEC_FECHA_SEGUIMIENTO from traoper_051_seguimientosresumida where ID__ARBOL=? order by ID__SEGUIMIENTO desc limit 1
								),
							'2000-01-01 00:00:00'
							) AS FEC_FECHA_SEGUIMIENTO,
							IFNULL(VCH_ESTADO,'V') as VCH_ESTADO 
							FROM traoper_051_seguimientosresumida
							where ID__ARBOL=?
							order by ID__SEGUIMIENTO desc limit 1
							";
						$arbExtra=$this->db->query($sql,array($arb["ID__ARBOL"],$arb["ID__ARBOL"]))->row();
						var_dump($cont);
						//die($this->db->last_query());		
						// die("antesif");
						if(empty($arbExtra))
						{
							$VCH_ESTADO="V";
							$FEC_FECHA_SEGUIMIENTO="2020-01-01 00:00:00";
							
						}				
						else
						{
							// die("holielse");
							$VCH_ESTADO=$arbExtra->VCH_ESTADO;
							$FEC_FECHA_SEGUIMIENTO=$arbExtra->FEC_FECHA_SEGUIMIENTO;
						}

							/*
							if($arb['ID__ARBOL']=='71195')
								{
									echo "<pre>"; die(print_r($arb));
								}
							// */				
						if($VCH_ESTADO!="M")
						{
							// die("entreif");					
							$fechalimite=strtotime('-3 month');
							$fechaSeguimiento=strtotime($FEC_FECHA_SEGUIMIENTO);				

							if(($fechaSeguimiento<$fechalimite))
							{
								
								$arb["FEC_FECHA_SEGUIMIENTO"]=$FEC_FECHA_SEGUIMIENTO;
								array_push ($compilado,$arb);																
							}					
						}											
					}	
			//echo "<pre>"; die(print_r($compilado));
			//Extrae todos los guardabosques que tenemos compilados
			$personasCantidad=array_column($compilado,"ID__GUARDABOSQUE");
			//Cuenta Cuantos y nos devuelve array de $algo[{num}]={cantidad};
			$personasCantidad=array_count_values($personasCantidad);
			
			
			//echo "<pre>"; die(print_r($personasCantidad));
			foreach($personasCantidad as $key => $val)
			{
				$compf["ID__GUARDABOSQUE"]=$key;
				$compf["cantidad"]=$val;				
				foreach($compilado as $arb)
				{
					if($arb["ID__GUARDABOSQUE"]==$key)
					{
						$compf["nombre"]=$arb["nombre"];
						$compf["FEC_FECHA_SEGUIMIENTO"]=$arb["FEC_FECHA_SEGUIMIENTO"];												
						break;
					}
				}
				
				array_push($compiladoFinal,$compf);
			}
//		  echo "<pre>"; die(print_r($compiladoFinal));
		  return $compiladoFinal;
		}                   
        public function get_MisGuardabosquesProcesados()
		{							
			//Obtiene TODOS los ID de arboles , guardabosques y nombres por los cuales preguntar
			$compilado=array();
			$compiladoFinal=array();
			$sql='select VCH_CODIGOQR,VCH_RUTA_FOTO_COMPLETA,VCH_RUTA_FOTO_SOLOETIQUETA,ID__SEGUIMIENTO 
					,concat(VCH_APELLIDOPATERNO," ",VCH_APELLIDOMATERNO," ",VCH_NOMBRE) as nombre ,FEC_FECHA_SEGUIMIENTO,VCH_NOMBRECOMUN
					, 	concat(gua.VCH_NOMBRE," ",gua.VCH_APELLIDOPATERNO) as adoptante,gua.VCH_CELULAR, gua.VCH_TELEFONO
					from traoper_051_seguimientosresumida a
									
					inner join catconf_020_arboles b on  a.ID__ARBOL=b.ID__ARBOL 
					inner join traoper_021_registroadopcion reg on a.ID__ARBOL=reg.ID__ARBOL
					inner join catconf_012_guardabosques gua on gua.ID__GUARDABOSQUE=reg.ID__GUARDABOSQUE                
					inner join catconf_009_especies esp on esp.ID__ESPECIE=b.ID__ESPECIE
					where ID__EMBAJADOR=?  order by ID__SEGUIMIENTO desc';			
			$arbolesyGuardabosques=$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__EMBAJADOR"]))->result_array();									
			return $arbolesyGuardabosques;
		}                   
		
		
		public function susarboles($ID__GUARDABOSQUE)
		{	

			//DIE("?".$ID__GUARDABOSQUE);
			$sql="
				select interno.ID__ARBOL,VCH_CODIGOQR,VCH_NOMBRECOMUN,FEC_FECHA_SEGUIMIENTO,VCH_LATITUD,VCH_LONGITUD from
				(
					SELECT arb.ID__ARBOL,arb.VCH_CODIGOQR,VCH_NOMBRECOMUN,VCH_LATITUD,VCH_LONGITUD FROM
					(SELECT * FROM traoper_021_registroadopcion where ID__GUARDABOSQUE=?)reg
					left join catconf_020_arboles arb on reg.ID__ARBOL=arb.ID__ARBOL
					left join catconf_009_especies esp on arb.ID__ESPECIE=esp.ID__ESPECIE
				) interno
				left join 
				(
					select * from traoper_051_seguimientosresumida  group by  ID__ARBOL order by FEC_FECHA_SEGUIMIENTO desc
				) ultimoSeguimiento on interno.ID__ARBOL= ultimoSeguimiento.ID__ARBOL
				
				where FEC_FECHA_SEGUIMIENTO <= NOW() - INTERVAL 3 MONTH
                or FEC_FECHA_SEGUIMIENTO is null
                
				";			
			$rows=$this->db->query($sql,array($ID__GUARDABOSQUE))->result_array();						
			return $rows;
		}
		
		public function GetDatosGuardabosque($ID__GUARDABOSQUE)
		{	
			$sql='SELECT concat(VCH_NOMBRE," ",VCH_APELLIDOPATERNO," ",VCH_APELLIDOMATERNO)nombre,VCH_TELEFONO,VCH_CELULAR,VCH_CORREO
				  FROM catconf_012_guardabosques where ID__GUARDABOSQUE=? limit 1;
				';			
			$rows=$this->db->query($sql,array($ID__GUARDABOSQUE))->result_array();						
			return $rows;
		}
		public function SetEquivocado($ID__GUARDABOSQUE)
		{	
			$sql='INSERT INTO traoper_052_seguimientos_fallidos (ID__EMBAJADOR,ID__GUARDABOSQUE)VALUES(?,?)';			
			$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__EMBAJADOR"],$ID__GUARDABOSQUE));						
		}
		
		
		public function set_ReporteEstadoArbol($IMPORT, $ID__GUARDABOSQUE,	$ID__EMBAJADOR)
		{	
//			$IMPORT=$IMPORT["DATA"];		
	
			$IMPORT["QR"]=preg_replace("/[^0-9\-]/", "", $IMPORT["QR"]);												
			$filenameCompleta="";
			$filenameSoloetiqueta="";
			
			$sql="
				INSERT INTO traoper_051_seguimientosresumida
				(ID__ARBOL,		VCH_ESTADO,		VCH_SALUD,		VCH_CON_ETIQUETA,			VCH_CONTENEDOR,
				VCH_ACCESO_AL_ARBOL,	FEC_FECHA_SEGUIMIENTO,		VCH_UBICACION_REPORTADA,	ID__GUARDABOSQUE,		ID__EMBAJADOR,
				VCH_COMENTARIOS,			VCH_RUTA_FOTO_COMPLETA,			VCH_RUTA_FOTO_SOLOETIQUETA)
				VALUES
				(?,?,?,?,?,
				 ?,now(),?,?,?,
				 ?,?,?);
				";			

			$contestados=$this->db->query($sql,
			array(
					$IMPORT["ID__ARBOL"],	$IMPORT["optradioVCH_ESTADO"],	$IMPORT["optradioVCH_SALUD"],	$IMPORT["optradioVCH_CON_ETIQUETA"],	$IMPORT["optradioVCH_CONTENEDOR"],	
					$IMPORT["optradioVCH_ACCESO_AL_ARBOL"],									$IMPORT["optradioVCH_UBICACION_REPORTADA"],	$ID__GUARDABOSQUE,		$ID__EMBAJADOR,
					$IMPORT["VCH_COMENTARIOS"],	$filenameCompleta,	$filenameSoloetiqueta
				 ));			
				 
				 	 									
			$sql="update catconf_020_arboles set VCH_LATITUD=?,VCH_LONGITUD=? where ID__ARBOL=?";			
			$this->db->query($sql,
			array(	$IMPORT["VCH_LATITUD"],$IMPORT["VCH_LONGITUD"],$IMPORT["ID__ARBOL"]
				 ));	 			 									
		}
		
		
		public function subirPics($IMPORT)
		{
			//die(print_r($IMPORT));

			$IMPORT["VCH_CODIGOQR"]=preg_replace("/[^0-9\-]/", "", $IMPORT["VCH_CODIGOQR"]);												
			$folder="../EXTRA/uploads/seguimiento/".$IMPORT["VCH_CODIGOQR"];
		
			if (!file_exists($folder)) 
			{
				mkdir($folder, 0777,true);	
			}	
				
			$config['upload_path']          = $folder;
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 10000;								
			
			$filenameCompleta="";
			if(!empty($_FILES['VCH_RUTA_FOTO_COMPLETA']['name']))
			{
				$filenameCompleta="C".date('Y-m-d', $_SERVER['REQUEST_TIME']).$_FILES['VCH_RUTA_FOTO_COMPLETA']['name'];			
				$config['file_name'] = $filenameCompleta;
				$config['file_name']=str_replace(' ','',$config['file_name']);
				$config['file_name']= preg_replace('/\.(?=.*\.)/', '', $config['file_name']);
				
				$filenameCompleta=str_replace(' ','',$filenameCompleta);
				$filenameCompleta=preg_replace('/\.(?=.*\.)/', '', $filenameCompleta);
				$this->load->library('upload', $config);									
				if ( ! $this->upload->do_upload('VCH_RUTA_FOTO_COMPLETA'))
				{		
					$error = array('error' => $this->upload->display_errors());
					die(print_r($error));
				}
				ELSE
				{
					$sql='update traoper_051_seguimientosresumida set VCH_RUTA_FOTO_COMPLETA=? where ID__SEGUIMIENTO=?';			
					$this->db->query($sql,array($filenameCompleta,$IMPORT["ID__SEGUIMIENTO"]));			
				}
			}						
			$filenameSoloetiqueta="";
			if(!empty($_FILES['VCH_RUTA_FOTO_SOLOETIQUETA']['name']))
			{			
				$filenameSoloetiqueta="E".date('Y-m-d', $_SERVER['REQUEST_TIME']).$_FILES['VCH_RUTA_FOTO_SOLOETIQUETA']['name'];
				$config['file_name'] = $filenameSoloetiqueta;
				$config['file_name']= str_replace(' ','',$config['file_name']);
				$config['file_name']= preg_replace('/\.(?=.*\.)/', '', $config['file_name']);
				
				$filenameSoloetiqueta=str_replace(' ','',$filenameSoloetiqueta);
				$filenameSoloetiqueta=preg_replace('/\.(?=.*\.)/', '', $filenameSoloetiqueta);
				$this->load->library('upload', $config);									
				$this->upload->initialize($config);			
				if ( ! $this->upload->do_upload('VCH_RUTA_FOTO_SOLOETIQUETA'))
				{		
					$error = array('error' => $this->upload->display_errors());
				}
				ELSE
				{
					$sql='update traoper_051_seguimientosresumida set VCH_RUTA_FOTO_SOLOETIQUETA=? where ID__SEGUIMIENTO=?';			
					$this->db->query($sql,array($filenameSoloetiqueta,$IMPORT["ID__SEGUIMIENTO"]));			
				}
			}
			
			
		}
		
       /*
		public function reportarPropios()
		{	
			$sql="
				select interno.ID__ARBOL,VCH_CODIGOQR,VCH_NOMBRECOMUN,FEC_FECHA_SEGUIMIENTO from
				(
					SELECT arb.ID__ARBOL,arb.VCH_CODIGOQR,VCH_NOMBRECOMUN FROM
					(SELECT * FROM traoper_021_registroadopcion where ID__GUARDABOSQUE=?)reg
					inner join catconf_020_arboles arb on reg.ID__ARBOL=arb.ID__ARBOL
					inner join catconf_009_especies esp on arb.ID__ESPECIE=esp.ID__ESPECIE
				) interno
				left join 
				(
					select * from traoper_051_seguimientosresumida  group by  ID__ARBOL order by FEC_FECHA_SEGUIMIENTO desc
				) ultimoSeguimiento on interno.ID__ARBOL= ultimoSeguimiento.ID__ARBOL";			
			$rows=$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__GUARDABOSQUE"]))->result_array();						
			return $rows;
		}
		
        public function get_DescuentoPorEncuesta()
		{	
			$sql="
				select count(distinct(ID__CVETALLER)) contestados from catconf_074_resultado_evaluacion where ID__GUARDABOSQUE in 
				(
					select ID__GUARDABOSQUE from catconf_012_guardabosques where VCH_CORREO=?
				)";			
			$contestados=$this->db->query($sql,array($this->session->userdata["logged_in"]["VCH_CORREO"]))->row()->contestados;
			return $contestados;
		}                     		
        public function get_seguimientos_por_qr($QR)
		{	
			$sql="
				select interno.ID__ARBOL,VCH_CODIGOQR,VCH_NOMBRECOMUN,FEC_FECHA_SEGUIMIENTO from
					(
						SELECT arb.ID__ARBOL,arb.VCH_CODIGOQR,VCH_NOMBRECOMUN FROM												
						(SELECT * FROM catconf_020_arboles  where VCH_CODIGOQR=?)arb
						inner join traoper_021_registroadopcion reg on reg.ID__ARBOL=arb.ID__ARBOL    						
						inner join catconf_009_especies esp on arb.ID__ESPECIE=esp.ID__ESPECIE
					) interno
					left join 
					(
						select * from traoper_051_seguimientosresumida  group by  ID__ARBOL order by FEC_FECHA_SEGUIMIENTO desc
					) ultimoSeguimiento on interno.ID__ARBOL= ultimoSeguimiento.ID__ARBOL
					limit 1
				";			
			$rows=$this->db->query($sql,array($QR))->result_array();
			echo (JSON_ENCODE($rows));
		}                     		
		
		
		public function set_ReporteEstadoArbol($IMPORT, $ID__GUARDABOSQUE,	$ID__EMBAJADOR)
		{			
			//die(print_r($IMPORT));
			$IMPORT["QR"]=preg_replace("/[^0-9\-]/", "", $IMPORT["QR"]);												
			$folder="C:\\xampp\\htdocs\\Extra\\uploads\\seguimiento\\".$IMPORT["QR"];
						
			if (!file_exists($folder)) 
			{
				mkdir($folder, 0777, true);
			}			
			$config['upload_path']          = $folder;
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 2000;								
			
			$filenameCompleta="";
			if(!empty($_FILES['VCH_RUTA_FOTO_COMPLETA']['name']))
			{
				$filenameCompleta="C".date('Y-m-d', $_SERVER['REQUEST_TIME']);			
				$config['file_name'] = $filenameCompleta;
				$this->load->library('upload', $config);									
				if ( ! $this->upload->do_upload('VCH_RUTA_FOTO_COMPLETA'))
				{		
					$error = array('error' => $this->upload->display_errors());
				}
			}						
			$filenameSoloetiqueta="";
			if(!empty($_FILES['VCH_RUTA_FOTO_SOLOETIQUETA']['name']))
			{			
				$filenameSoloetiqueta="E".date('Y-m-d', $_SERVER['REQUEST_TIME']);
				$config['file_name'] = $filenameSoloetiqueta;
				$this->load->library('upload', $config);									
				$this->upload->initialize($config);			
				if ( ! $this->upload->do_upload('VCH_RUTA_FOTO_SOLOETIQUETA'))
				{		
					$error = array('error' => $this->upload->display_errors());
				}
			}
			
			$sql="
				INSERT INTO traoper_051_seguimientosresumida
				(ID__ARBOL,		VCH_ESTADO,		VCH_SALUD,		VCH_CON_ETIQUETA,			VCH_CONTENEDOR,
				VCH_ACCESO_AL_ARBOL,	FEC_FECHA_SEGUIMIENTO,		VCH_UBICACION_REPORTADA,	ID__GUARDABOSQUE,		ID__EMBAJADOR,
				VCH_COMENTARIOS,			VCH_RUTA_FOTO_COMPLETA,			VCH_RUTA_FOTO_SOLOETIQUETA)
				VALUES
				(?,?,?,?,?,
				 ?,now(),?,?,?,
				 ?,?,?);
				";			
				//$this->session->userdata["logged_in"]["VCH_CORREO"]
			$contestados=$this->db->query($sql,
			array(
					$IMPORT["ID__ARBOL"],	$IMPORT["optradioVCH_ESTADO"],	$IMPORT["optradioVCH_SALUD"],	$IMPORT["optradioVCH_CON_ETIQUETA"],	$IMPORT["optradioVCH_CONTENEDOR"],	
					$IMPORT["optradioVCH_ACCESO_AL_ARBOL"],									$IMPORT["optradioVCH_UBICACION_REPORTADA"],	$ID__GUARDABOSQUE,		$ID__EMBAJADOR,
					$IMPORT["VCH_COMENTARIOS"],	$filenameCompleta,	$filenameSoloetiqueta
				 ));
				 
			if($ID__EMBAJADOR=="")	//No fue el embajador asi que dale puntos
			{
				$sql="select ID__ARBOL from traoper_021_registroadopcion where ID__ARBOL=? and ID__GUARDABOSQUE=?";
				$propio=$this->db->query($sql,array($IMPORT["ID__ARBOL"],$ID__GUARDABOSQUE))->row()->ID__ARBOL;
				 
				if(!empty($propio))
				{
					$this->set_Puntos($ID__GUARDABOSQUE,"Seguimiento",1,$IMPORT["QR"]);
					if(!empty($filenameCompleta))
					{
						$this->set_Puntos($ID__GUARDABOSQUE,"Foto del arbol completo",2,$IMPORT["QR"]);
					}
					if(!empty($filenameSoloetiqueta))
					{
						$this->set_Puntos($ID__GUARDABOSQUE,"Foto de la Etiqueta",3,$IMPORT["QR"]);
					}
				}
				else
				{
					$this->set_Puntos($ID__GUARDABOSQUE,"Seguimiento",2,$IMPORT["QR"]);
					if(!empty($filenameCompleta))
					{
						$this->set_Puntos($ID__GUARDABOSQUE,"Foto del arbol completo",4,$IMPORT["QR"]);
					}
					if(!empty($filenameSoloetiqueta))
					{
						$this->set_Puntos($ID__GUARDABOSQUE,"Foto de la Etiqueta",6,$IMPORT["QR"]);
					}
				}
				 
			}
			

			
		}
		public function set_Puntos($ID__GUARDABOSQUE,$VCH_CONCEPTO,$NUM_PUNTOS,$QR)
		{
			$sql="INSERT INTO traoper_034_historialpuntos
								(ID__GUARDABOSQUE,VCH_CONCEPTO,NUM_PUNTOS,FEC_REGISTRO,VCH_QR)
								VALUES
								(?,?,?,now(),?)";	
			$this->db->query($sql,array($ID__GUARDABOSQUE,$VCH_CONCEPTO,$NUM_PUNTOS,$QR));
		}
		public function get_puntos()
		{
			$sql="select VCH_QR,sum(NUM_PUNTOS) NUM_PUNTOS, FEC_REGISTRO from traoper_034_historialpuntos					
					where ID__GUARDABOSQUE=?	group by 	VCH_QR		order by FEC_REGISTRO asc";			
			$rows=$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__GUARDABOSQUE"]))->result_array();
			return $rows;
		}
		public function get_puntos_por_qr($qr)
		{
			$sql="select VCH_QR,NUM_PUNTOS,FEC_REGISTRO,VCH_CONCEPTO from traoper_034_historialpuntos					
					where VCH_QR=?	order by FEC_REGISTRO asc";			
			$rows=$this->db->query($sql,array($qr))->result_array();			
			echo JSON_ENCODE($rows);
		}*/
}
