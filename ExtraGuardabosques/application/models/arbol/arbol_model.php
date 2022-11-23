<?php
class Arbol_model extends CI_Model 
{
		/* Lo que hice, lo hice sin elección... en el nombre de la paz y la cordura Pero no en el nombre del Doctor*/
        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }        
                            
       
		public function reportarPropios()
		{	
			$sql="
				select interno.ID__ARBOL,VCH_CODIGOQR,VCH_NOMBRECOMUN,FEC_FECHA_SEGUIMIENTO,VCH_LATITUD,VCH_LONGITUD from
				(
					SELECT arb.ID__ARBOL,arb.VCH_CODIGOQR,VCH_NOMBRECOMUN,VCH_LATITUD,VCH_LONGITUD FROM
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
				select interno.ID__ARBOL,VCH_CODIGOQR,VCH_NOMBRECOMUN,FEC_FECHA_SEGUIMIENTO,VCH_LATITUD,VCH_LONGITUD  from
					(
						SELECT arb.ID__ARBOL,arb.VCH_CODIGOQR,VCH_NOMBRECOMUN,VCH_LATITUD,VCH_LONGITUD FROM												
						(SELECT * FROM catconf_020_arboles  where VCH_CODIGOQR=?)arb
						left join traoper_021_registroadopcion reg on reg.ID__ARBOL=arb.ID__ARBOL    						
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
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 2000;								
			
			$filenameCompleta="";
			if(!empty($_FILES['VCH_RUTA_FOTO_COMPLETA']['name']))
			{
				$filenameCompleta="C".date('Y-m-d', $_SERVER['REQUEST_TIME']).$_FILES['VCH_RUTA_FOTO_COMPLETA']['name'];			
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
				$filenameSoloetiqueta="E".date('Y-m-d', $_SERVER['REQUEST_TIME']).$_FILES['VCH_RUTA_FOTO_SOLOETIQUETA']['name'];
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
			$this->db->query($sql,
			array(
					$IMPORT["ID__ARBOL"],	$IMPORT["optradioVCH_ESTADO"],	$IMPORT["optradioVCH_SALUD"],	$IMPORT["optradioVCH_CON_ETIQUETA"],	$IMPORT["optradioVCH_CONTENEDOR"],	
					$IMPORT["optradioVCH_ACCESO_AL_ARBOL"],									$IMPORT["optradioVCH_UBICACION_REPORTADA"],	$ID__GUARDABOSQUE,		$ID__EMBAJADOR,
					$IMPORT["VCH_COMENTARIOS"],	$filenameCompleta,	$filenameSoloetiqueta
				 ));
				 
				 
			
			$sql="update catconf_020_arboles set VCH_LATITUD=?,VCH_LONGITUD=? where ID__ARBOL=?";			
			$this->db->query($sql,
			array(	$IMPORT["VCH_LATITUD"],$IMPORT["VCH_LONGITUD"],$IMPORT["ID__ARBOL"]
				 ));	 
				 
//				 die($this->db->last_query());
				 
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
		}
}
