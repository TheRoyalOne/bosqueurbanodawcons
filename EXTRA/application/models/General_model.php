<?php
class General_model extends CI_Model 
{

        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }                
		public function get_estados()
		{					
			$query = $this->db->query('SELECT ID__ESTADO,upper(VCH_NOMBRE) VCH_NOMBRE from catconf_004_estados WHERE EXCLUSIVO=0  order by VCH_NOMBRE')->result_array();					
			return $query;			
		}
		public function get_ciudades($ID__ESTADO)
		{	
			/*		
			$sql='SELECT `catconf_005_municipios`.`ID__MUNICIPIO`,upper(`catconf_005_municipios`.`VCH_NOMBRE`) VCH_NOMBRE FROM `catconf_005_municipios` 
			where'.
				//ID__MUNICIPIO>=300000 and 
			 'ID__ESTADO= ? order by `catconf_005_municipios`.`VCH_NOMBRE` asc';
			 */		
			$sql='SELECT `catconf_005_municipios`.`ID__MUNICIPIO`,upper(`catconf_005_municipios`.`VCH_NOMBRE`) VCH_NOMBRE FROM `catconf_005_municipios` 
			where 
			ID__MUNICIPIO>=1500000 and 			
			ID__ESTADO= ? order by `catconf_005_municipios`.`VCH_NOMBRE` asc';
			return ($this->db->query($sql,array($ID__ESTADO))->result_array());	
		}
		public function alta_colonia($ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL)
		{					
			$sql='INSERT INTO catconf_006_colonias (ID__MUNICIPIO,VCH_NOMBRE,VCH_CODIGOPOSTAL) VALUES (?,?,?)';
			$this->db->query($sql,array($ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL));	
		}
		public function get_colonias($ID__ESTADO,$ID__MUNICIPIO,$VCH_NOMBRE,$VCH_CODIGOPOSTAL)
		{		
				
			/*
			 * Para update DB CON IDS ANTERIORES
			$sql="SELECT 
				upper(col.VCH_NOMBRE) as colonia,col.ID__COLONIA,col.VCH_CODIGOPOSTAL,est.VCH_NOMBRE as estado,muni.VCH_NOMBRE as municipio
				FROM catconf_006_colonias col 
				inner join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				inner join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
				where".
					//col.ID__COLONIA>=300000				and
				 "
				(muni.ID__ESTADO ='".$ID__ESTADO."' or '".$ID__ESTADO."'='') and  
				(col.VCH_NOMBRE like '%".$VCH_NOMBRE."%' or '".$VCH_NOMBRE."'='' )  and 
				(VCH_CODIGOPOSTAL like '%".$VCH_CODIGOPOSTAL."%' or '".$VCH_CODIGOPOSTAL."'='') and 
				(col.ID__MUNICIPIO ='".$ID__MUNICIPIO."' or '".$ID__MUNICIPIO."'='')
				order by col.VCH_NOMBRE asc
				limit 100;";	*/
			
					
			$sql="SELECT 
				upper(col.VCH_NOMBRE) as colonia,col.ID__COLONIA,col.VCH_CODIGOPOSTAL,est.VCH_NOMBRE as estado,muni.VCH_NOMBRE as municipio
				FROM catconf_006_colonias col 
				inner join catconf_005_municipios muni on col.ID__MUNICIPIO=muni.ID__MUNICIPIO
				inner join catconf_004_estados est on muni.ID__ESTADO=est.ID__ESTADO
				where ";
				//	col.ID__COLONIA>=1500000				and
				$sql.="(muni.ID__ESTADO ='".$ID__ESTADO."' or '".$ID__ESTADO."'='') and  
				(col.VCH_NOMBRE like '%".$VCH_NOMBRE."%' or '".$VCH_NOMBRE."'='' )  and 
				(VCH_CODIGOPOSTAL like '%".$VCH_CODIGOPOSTAL."%' or '".$VCH_CODIGOPOSTAL."'='') and 
				(col.ID__MUNICIPIO ='".$ID__MUNICIPIO."' or '".$ID__MUNICIPIO."'='')
				order by col.VCH_NOMBRE asc
				limit 1000;";				
//				die($sql);
			return ($this->db->query($sql)->result_array());	
		}				
}

