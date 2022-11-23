<?php
class Preguntas_model extends CI_Model 
{
		/* Lo que hice, lo hice sin elección... en el nombre de la paz y la cordura Pero no en el nombre del Doctor*/
        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }        
        public function get_misPreguntas()
		{	
			$sql="select * from traoper_043_mensaje 
				where ID__MENSAJE not in ( select ID__MENSAJE from traoper_044_respuesta)
						order by FEC_REGISTRO asc 
			";			
			$rows=$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__GUARDABOSQUE"]))->result_array();						
			$filteredRows=array();			
			return $rows;
		}
		public function SendPregunta($pregunta)
		{
			$sql="INSERT INTO traoper_043_mensaje
				(
				ID__GUARDABOSQUE,FEC_REGISTRO,BND_RESPONDIDO,VCH_TEXTO)
				VALUES
				(?,now(),0,?);";			
			$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__GUARDABOSQUE"],$pregunta));									
		}
}
