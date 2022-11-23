<?php
class Inicio_model extends CI_Model 
{
        public function __construct()
        {
                $this->load->database();
        }        
		public function CREAR_SERIE($IMPORT)
		{

			IF(EMPTY($IMPORT["VCH_ANIO"])||EMPTY($IMPORT["INICIAL"])||EMPTY($IMPORT["FINAL"]))
			{
				die("datos necesarios no proporcionados");
			}									
			$IMPORT["INICIAL"]=str_replace ("'","-",$IMPORT["INICIAL"]);
			$IMPORT["INICIAL"]=str_replace ("*","-",$IMPORT["INICIAL"]);						
			$IMPORT["FINAL"]=str_replace ("'","-",$IMPORT["FINAL"]);
			$IMPORT["FINAL"]=str_replace ("*","-",$IMPORT["FINAL"]);						

			$formato=explode ("-", $IMPORT["INICIAL"] )[0]."-".explode ("-", $IMPORT["INICIAL"] )[1]."-";

			if(empty(explode ("-", $IMPORT["INICIAL"] )[2])||empty(explode ("-", $IMPORT["FINAL"] )[2]))
			{
				die("formato no valido de etiquetas");
			}
			$inicial=explode ("-", $IMPORT["INICIAL"] )[2];
			$final=explode ("-", $IMPORT["FINAL"] )[2];
			
			$inicial=intval($inicial);
			$final=intval($final);
					
			$i=1;
			while($inicial<=$final)
			{												
				$qr=$formato.sprintf('%06d', $inicial);
				
				//verifica si existe antes de insertar				
				$sql="SELECT VCH_QR FROM catconf_071_etiquetas Where VCH_QR=?";									  									  
				$temp = $this->db->query($sql,array($qr))->row();							
				if(empty($temp))
				{
					$existe=false;
				}
				else
				{
					$existe=true;
				}
								
				if(!$existe)
				{				
					$sql="INSERT INTO catconf_071_etiquetas	(ID__ESPECIE,ID__EMPRESA,VCH_ANIO,VCH_QR)
					VALUES
					(?,?,?,?);";																	  									  								
					$this->db->query($sql,array($IMPORT["ID__ESPECIE"],$IMPORT["ID__EMPRESA"],$IMPORT["VCH_ANIO"],$qr));					
					echo $i."- se genero la -".$qr." ".$this->db->last_query()."</br>";
				}				
				$inicial++;								
				$i++;
			}								
		}		        																
		public function get_empresas()
		{			 							
			$sql='SELECT * from catconf_013_empresa order by VCH_NOMBREEMPRESA asc ';			
			$row = $this->db->query($sql)->result_array();
			return $row;
		}		
		public function get_especies()
		{			 							
			$sql='SELECT * from catconf_009_especies order by VCH_NOMBRECOMUN asc ';			
			$row = $this->db->query($sql)->result_array();
			return $row;
		}						
}

