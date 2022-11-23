<?php
class Preguntas_model extends CI_Model 
{
		/* Lo que hice, lo hice sin elección... en el nombre de la paz y la cordura Pero no en el nombre del Doctor*/
        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }        
        public function get_FAQS()
		{
			$sql="select * from catconf_077_faqs";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}
        public function get_Categorias()
		{
			$sql="select * from traoper_043_mensajecategoria";													  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;			
		}
        public function get_misPreguntas()
		{	
			$sql="Select m.FEC_REGISTRO fecha_realizada,r.FEC_REGISTRO fecha_contestada, ID__RESPUESTA,m.VCH_TEXTO pregunta, r.VCH_TEXTO respuesta,m.ID__MENSAJE,VCH_FILE from
				(select * From traoper_043_mensaje where ID__GUARDABOSQUE=?) m
				left join  traoper_044_respuesta r 
													on  m.ID__MENSAJE=r.ID__MENSAJE";			
			$rows=$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__GUARDABOSQUE"]))->result_array();						
			$filteredRows=array();			
			return $rows;
		}
		public function SendPregunta($pregunta,$ID__CATEGORIA)
		{
			$sql="INSERT INTO traoper_043_mensaje
				(
				ID__GUARDABOSQUE,FEC_REGISTRO,BND_RESPONDIDO,VCH_TEXTO,ID__CATEGORIA)
				VALUES
				(?,now(),0,?,?);";			
			$this->db->query($sql,array($this->session->userdata["logged_in"]["ID__GUARDABOSQUE"],$pregunta,$ID__CATEGORIA));									
		}
}
