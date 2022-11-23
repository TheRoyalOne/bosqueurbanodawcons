<?php
class Inicio_model extends CI_Model 
{

        public function __construct()
        {
                $this->load->database();
        }
        public function login($user,$pass)
		{			 							
			$sql='SELECT * FROM catconf_019_embajadores where VCH_CORREO=? AND VCH_PASSWORD=? and  	FEC_FECHAINICIO < now() and now()< FEC_FECHAFIN ';			
			$query = $this->db->query($sql,array($user,md5($pass)));	
//			$query = $this->db->query($sql,array($user,$pass));	
			//die($this->db->last_query());
			return $query->result_array();		
		}				
		/*public function get_eventos() 
		{
			$sql='SELECT adop.VCH_NOMBRE,adop.FEC_FECHAINICIO,adop.FEC_FECHAFIN,adop.VCH_LUGAR,VCH_NOMBREPATROCINADOR,VCH_ESTATUS FROM extrav2.catconf_010_eventoadopcion adop left join catconf_011_eveadopatrocinador pat
				on adop.ID__EVENTO=pat.ID__EVENTOADOPCION
				 where 
				FEC_FECHAINICIO between DATE_SUB(NOW(), INTERVAL +15 day)   and DATE_SUB(NOW(), INTERVAL -15 day) 
				or 
				FEC_FECHAINICIO between DATE_SUB(NOW(), INTERVAL +15 day)   and DATE_SUB(NOW(), INTERVAL -15 day) 

				 ';			
			$query = $this->db->query($sql);	
			return $query->result_array();		
		}
		public function get_estadosarbol() 
		{
			$sql='SELECT * from estadosarbol';			
			$query = $this->db->query($sql);	
			return $query->result_array();		
		}*/
		
}

