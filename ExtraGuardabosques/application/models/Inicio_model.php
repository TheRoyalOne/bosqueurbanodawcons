<?php
class Inicio_model extends CI_Model 
{

        public function __construct()
        {
                $this->load->database();
        }
        public function login($user,$pass)
		{			 							
//			die($pass."     ".md5($pass));
			$sql='SELECT * FROM catconf_012_guardabosques where VCH_CORREO=? AND VCH_PASSWORD=? ';			
			$query = $this->db->query($sql,array($user,md5($pass)));	
//			$query = $this->db->query($sql,array($user,$pass));	
//			die($this->db->last_query());
			return $query->result_array();		
		}				
		public function get_eventos() 
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
		}
		
		
		
		
		
		public function setClaveGuardabosque($cuenta)
		{							
			
			$cuenta=filter_var($cuenta, FILTER_SANITIZE_EMAIL);   			
			$sql="select * from catconf_012_guardabosques where VCH_CORREO =?";													  									  
			$row=$this->db->query($sql,array($cuenta))->row();	
			
			if(empty($row))
			{
				return;
			}		
												
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$randstring = '';
			for ($i = 0; $i < 6; $i++) 
			{
				$randstring .= $characters[rand(0, strlen($characters))];
			}
						
			$sql="update catconf_012_guardabosques  set VCH_PASSWORD=? where ID__GUARDABOSQUE =?";													  									  
			$this->db->query($sql,array(md5($randstring),$row->ID__GUARDABOSQUE));															
			$this->sendMailGuardabosque($cuenta,$randstring);
			return; 
		}
		public function sendMailGuardabosque($correo,$clave)
		{						
			$html="Lamentamos que hayas perdido tu contraseña ,
					tus nuevos datos de acceso son: <br/>
							Usuario: ".$correo."<br/>
					Contraseña: ".$clave."<br/>
					Eres parte del Bosque Urbano, confiamos en tu compromiso…<br/>
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
				$config['smtp_pass']    = '2016-Extra-09';
				$config['charset']    = 'utf-8';
				$config['newline']    = "\r\n";
				$config['mailtype'] = 'text'; // or html
				$config['validation'] = TRUE; // bool whether to validate email or not   
				$this->load->library('email',$config);
				$this->email->from('noreply@extra.org.mx', 'Extra A.C');				
				$this->email->to($correo);		
				$this->email->subject('Extra A.C - Guardabosques urbano.');
				$this->email->message($html);
			    $this->email->set_mailtype("html");
				$this->email->send();			
		}		
		
}

