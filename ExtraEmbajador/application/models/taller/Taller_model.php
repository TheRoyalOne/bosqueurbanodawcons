<?php
class Taller_model extends CI_Model 
{
		/* Lo que hice, lo hice sin elección... en el nombre de la paz y la cordura Pero no en el nombre del Doctor*/
        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }        
        public function get_talleres()
		{			
//			die(print_r($this->session->userdata))		;
			$where="";			
			$sql='
				select interno.ID__CVETALLER,VCH_TALLER,ID_Resultado_Evaluacion,FEC_FECHA,interno.ID__GUARDABOSQUE from
				(
					select ID__CVETALLER,VCH_TALLER,ID__GUARDABOSQUE from 
						catconf_057_registrotalleres talleres                
					left join'; 
						//(SELECT ID__ASISTENTE,ID__CLAVETALLER FROM catconf_061_asistentestalleres where VCH_CORREO="'.$this->session->userdata["logged_in"]["VCH_CORREO"].'") asistencias												
						$sql.=' 
								(
									SELECT ID__ASISTENTE,ID__CLAVETALLER,ID__GUARDABOSQUE FROM catconf_061_asistentestalleres where ID__GUARDABOSQUE in (
																																	select ID__GUARDABOSQUE from catconf_012_guardabosques where VCH_CORREO="'.$this->session->userdata["logged_in"]["VCH_CORREO"].'"
																																	)
								) asistencias
								
								';
						
						$sql.=' on talleres.ID__CVETALLER = asistencias.ID__CLAVETALLER		
				)interno
				left join 
				(
					select ID_Resultado_Evaluacion,ID__GUARDABOSQUE,ID__CVETALLER from catconf_074_resultado_evaluacion
				) evaluacion 
				on interno.ID__CVETALLER=evaluacion.ID__CVETALLER 

				left join 
				(
					SELECT FEC_FECHA,ID__CLAVETALLER FROM catconf_058_convocadostalleres group by ID__CLAVETALLER
				) convocados on interno.ID__CVETALLER = convocados.ID__CLAVETALLER
				order by ID__CVETALLER asc';																							
			$rows=$this->db->query($sql)->result_array();			
//			die($this->db->last_query());
			return ($rows);	
		}		
		public function EvaluarTaller($IMPORT)
		{
			$sql="    select ID__GUARDABOSQUE from catconf_012_guardabosques where VCH_CORREO='".$this->session->userdata["logged_in"]["VCH_CORREO"]."' ";			
			$ID__GUARDABOSQUE=$this->db->query($sql)->row()->ID__GUARDABOSQUE;	
			if(!is_numeric($ID__GUARDABOSQUE))			
			{
					die;			
			}			
			
			$sqlb="INSERT INTO catconf_074_resultado_evaluacion
				(
				ID__CVETALLER,ID__GUARDABOSQUE,
				VCH_Preparacion_tema, VCH_Claridad_exponer, VCH_Material_Apoyo, VCH_Manejo_tiempo, VCH_Contenido_Taller, VCH_Aclaracion_Dudas,
				VCH_CALIFICACION_EXPECTATIVAS,VCH_JUSTIFICACION_CALIFICACION_EXPECTATIVA,
				VCH_APRENDIZAJE1,VCH_APRENDIZAJE2,VCH_APRENDIZAJE3,
				VCH_EVALUACION_BOSQUEURBANO,				VCH_SUGERENCIAS,
				VCH_PARTICIPA_OTRO,NUM_OTRO_ID__CVETALLER,
				NUM_ENTARADOPOR,VCH_ENTERADOPOROTRO)
				VALUES
				(?,?,
				?,?,?,?,?,?,
				?,?,
				?,?,?,
				?,?,
				?,?,
				?,?)";

			$this->db->query($sqlb,array
							(
							$IMPORT["ID__CVETALLER"],$ID__GUARDABOSQUE,
							$IMPORT["data"]["optradioPREPTEMA"],$IMPORT["data"]["optradioCLARIDAD"],$IMPORT["data"]["optradioAPOYO"],$IMPORT["data"]["optradioMANEJO"],$IMPORT["data"]["optradioCONTENIDO"],$IMPORT["data"]["optradioDUDAS"],
							$IMPORT["data"]["VCH_CALIFICACION_EXPECTATIVAS"],$IMPORT["data"]["VCH_JUSTIFICACION_CALIFICACION_EXPECTATIVA"],
							$IMPORT["data"]["VCH_APRENDIZAJE1"],$IMPORT["data"]["VCH_APRENDIZAJE2"],$IMPORT["data"]["VCH_APRENDIZAJE3"],			
							$IMPORT["data"]["VCH_EVALUACION_BOSQUEURBANO"],			$IMPORT["data"]["VCH_SUGERENCIAS"],			
							$IMPORT["data"]["VCH_PARTICIPA_OTRO"],$IMPORT["data"]["NUM_OTRO_ID__CVETALLER"],
							$IMPORT["data"]["NUM_ENTARADOPOR"],$IMPORT["data"]["VCH_ENTERADOPOROTRO"]
							)
						);				
		}		
		public function get_talleres_Completos()
		{	
			$sql="SELECT ID__CLAVETALLER,VCH_PRECIO,GROUP_CONCAT(STR_TO_DATE(FEC_FECHA,\"%e/%c/%Y\") SEPARATOR ', ') as fechas,GROUP_CONCAT(VCH_HORA SEPARATOR ', ') VCH_HORA,VCH_TALLER FROM catconf_058_convocadostalleres convocados
				  left join catconf_057_registrotalleres interno on interno.ID__CVETALLER = convocados.ID__CLAVETALLER				  
				  group by ID__CLAVETALLER;";			
			$rows=$this->db->query($sql)->result_array();						
			$filteredRows=array();			
			foreach($rows as $row)
			{
				$fechas=explode(",",$row["fechas"]);
				$horas=explode(",",$row["VCH_HORA"]);
				if( strtotime($fechas[0]) > time())	//Si la primera fecha no ha pasado aun, entonces se puede inscribir
				{					
					array_push($filteredRows,$row);
				}				
			}			
			return $filteredRows;
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
		public function InscribirseAction($ID__CVETALLER)
		{	
			$sql="select count(*) valor from catconf_061_asistentestalleres where ID__GUARDABOSQUE=? and  ID__CLAVETALLER=?";			
			$participante=$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__GUARDABOSQUE"],$ID__CVETALLER))->row()->valor;
			if($participante>0)
			{
				$a["status"]="Participante";
				$a["mensaje"]="Ya perteneces a este curso!";
				echo JSON_ENCODE($a);
				return;
			}					
			$sql="select ID__CLAVETALLER,count(*) total from catconf_061_asistentestalleres where ID__CLAVETALLER=?";			
			$registrados=$this->db->query($sql,array($ID__CVETALLER))->row()->total;						
			$sql="select NUM_CONVOCADOS from  catconf_057_registrotalleres where ID__CVETALLER=?";			
			$convocados=$this->db->query($sql,array($ID__CVETALLER))->row()->NUM_CONVOCADOS;									
			if($registrados>=$convocados)
			{
				$a["status"]="Lleno";
				$a["mensaje"]="El cupo del curso se encuentra lleno.";
				echo JSON_ENCODE($a);
				return;
			}																	
			$sql="INSERT INTO catconf_061_asistentestalleres(ID__CLAVETALLER,ID__GUARDABOSQUE)VALUES(?,?);";			
			$this->db->query($sql,array($ID__CVETALLER,$this->session->userdata["logged_in"]["ID__GUARDABOSQUE"]));					
			$a["status"]="exito";
			$a["mensaje"]="Lugar reservado exitosamente!";
			echo JSON_ENCODE($a);
			return;
		
		}
}
