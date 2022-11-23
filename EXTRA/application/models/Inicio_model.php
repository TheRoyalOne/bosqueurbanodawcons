<?php
class Inicio_model extends CI_Model 
{

        public function __construct()
        {
                $this->load->database();
        }
        public function login($user,$pass)
		{			 							
			$sql='SELECT `catconf_007_usuarios`.`ID__USUARIO`,`catconf_007_usuarios`.`ID__PERFIL`,`catconf_007_usuarios`.`VCH_NOMBRE`,`catconf_007_usuarios`.`VCH_APELLIDOPATERNO`,`catconf_007_usuarios`.`VCH_APELLIDOMATERNO`,`catconf_007_usuarios`.`VCH_CORREO`,`catconf_007_usuarios`.`VCH_TELEFONO`,`catconf_007_usuarios`.`VCH_CELULAR`,`catconf_007_usuarios`.`VCH_PUESTO`,`catconf_007_usuarios`.`VCH_ESTATUS`,`catconf_007_usuarios`.`VCH_USUARIO`,`catconf_007_usuarios`.`VCH_OBSERVACIONES`,`catconf_007_usuarios`.`ID__DOMICILIO` FROM catconf_007_usuarios where VCH_USUARIO=? AND VCH_PASSWORD=? ';			
			$query = $this->db->query($sql,array($user,md5($pass)));	
			return $query->result_array();		
		}				
        public function get_permisos($ID__PERFIL)
		{			 							
			$sql='SELECT ID__PERMISO FROM catconf_003_perfilespermisos where ID__PERFIL=?;';			
			$query = $this->db->query($sql,array($ID__PERFIL));	
			return $query->result_array();		
		}				
		
		public function get_eventos() 
		{
			$sql='SELECT VCH_NOMBREEVENTO as VCH_NOMBRE,adop.FEC_FECHAINICIO,adop.FEC_FECHAFIN,VCH_NOMBRELUGAR as VCH_LUGAR,VCH_NOMBREPATROCINADOR,VCH_ESTATUS 
				FROM catconf_065_eventos adop 
				left join catconf_011_eveadopatrocinador pat
				on adop.ID__EVENTO=pat.ID__EVENTOADOPCION
				 where 
				FEC_FECHAINICIO between DATE_SUB(NOW(), INTERVAL +15 day)   and DATE_SUB(NOW(), INTERVAL -15 day) 
				or 
				FEC_FECHAINICIO between DATE_SUB(NOW(), INTERVAL +15 day)   and DATE_SUB(NOW(), INTERVAL -15 day) 
				order by FEC_FECHAINICIO asc
				 ';			
			$query = $this->db->query($sql);	
			return $query->result_array();		
		}
		public function get_estadosarbol() 
		{
			$sql='SELECT VCH_ESTADO,count(*) cantidad from traoper_051_seguimientosresumida WHERE YEAR(FEC_FECHA_SEGUIMIENTO) = YEAR(CURDATE()) group by VCH_ESTADO';			
			$query = $this->db->query($sql);	
			return $query->result_array();		
		}
		public function get_totalAdop() 
		{
			$sql='select count(*) total from traoper_021_registroadopcion WHERE YEAR(FEC_FECHA) = YEAR(CURDATE())';			
			$total = $this->db->query($sql)->row()->total;	
			return $total;		
		}
		public function get_totalarb() 
		{
			$sql=' SELECT sum(inv.NUM_CANTIDAD) as total FROM catconf_064_inventariosglobal inv left join catconf_052_catalogoubicacion cat on cat.ID__UBICACION = inv.ID__UBICACION where cat.INT_ESTATUS = 1';			
			$total = $this->db->query($sql)->row()->total;	
			return $total;		
		}
		public function get_totalarbAdop() 
		{
			/*$sql=' select count(*) total
				from
				(
					SELECT ID__EVENTO FROM catconf_065_eventos  WHERE YEAR(FEC_FECHAINICIO) = YEAR(CURDATE()) and VCH_TIPO=1
				)evs
				right join catconf_020_arboles arb on evs.ID__EVENTO=arb.ID__EVENTO
				';	*/		
			$sql='select count(*) total from   catconf_020_arboles arb 
where ID__EVENTO in (SELECT ID__EVENTO FROM catconf_065_eventos  WHERE YEAR(FEC_FECHAINICIO) = YEAR(CURDATE()) and VCH_TIPO=1 ) or ID__EVENTO=0              ';
			$total = $this->db->query($sql)->row()->total;	
			return $total;		
		}
		public function get_saludsarbol() 
		{
			$sql='SELECT VCH_SALUD,count(*) cantidad from traoper_051_seguimientosresumida WHERE YEAR(FEC_FECHA_SEGUIMIENTO) = YEAR(CURDATE()) group by VCH_SALUD';			
			$query = $this->db->query($sql);	
			return $query->result_array();		
		}
		
}

