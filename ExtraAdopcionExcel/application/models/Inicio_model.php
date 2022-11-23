<?php
class Inicio_model extends CI_Model 
{

        public function __construct()
        {
                $this->load->database();
        }
        public function get_guardabosqueDireccion($guardabosque)
		{			 							
			//$sql='SELECT ID__GUARDABOSQUE FROM catconf_012_guardabosques where (VCH_NOMBRE=? and VCH_APELLIDOPATERNO=? and VCH_APELLIDOMATERNO=?) or (? !=''  and CORREO= ?) ';			
			//$row = $this->db->query($sql,array($guardabosque["NOMBRE"],$guardabosque["APELLIDO_x0020_PATERNO"],$guardabosque["APELLIDO_x0020_MATERNO"],$guardabosque["CORREO"],$guardabosque["CORREO"]))->row();	
			$sql='SELECT ID__GUARDABOSQUE FROM catconf_012_guardabosques where (VCH_NOMBRE=? and VCH_APELLIDOPATERNO=? and VCH_APELLIDOMATERNO=?) ';			
			$row = $this->db->query($sql,array($guardabosque["NOMBRE"],$guardabosque["APELLIDO_x0020_PATERNO"],$guardabosque["APELLIDO_x0020_MATERNO"]))->row();	
			if(!empty($row))
			{
				return $row->ID__GUARDABOSQUE;
			}
			else //no existe el guardabosques, valida su domicilio e insertalo
			{
				$sql='SELECT ID__COLONIA FROM catconf_006_colonias WHERE upper(VCH_NOMBRE)=upper(?)';	//Existe esa colonia?
				$rowcol = $this->db->query($sql,array($guardabosque["COLONIA"]))->row();		
				if(empty($rowcol))
				{
					$rowcol = new \stdClass();
					$rowcol->ID__COLONIA=0;					
				}
				$sql='INSERT INTO catconf_008_domicilios (ID__COLONIA,VCH_CALLE,VCH_ENTRECALLE)VALUES(?,?,?);';	//inserta el domicilio				
				$this->db->query($sql,array($rowcol->ID__COLONIA,$guardabosque["CALLE"],$guardabosque["ENTRE_x0020_CALLES"]));		
				//die($this->db->last_query());
				$ID__DOMICILIO=$this->db->insert_id();

				//Inserta el guardabosques
				$sql='INSERT INTO catconf_012_guardabosques
						(ID__DOMICILIO,VCH_NOMBRE,VCH_APELLIDOPATERNO,VCH_APELLIDOMATERNO,		VCH_TELEFONO,VCH_CELULAR,VCH_CORREO)
						VALUES
						(?,?,?,?,	?,?,?)';			
				$this->db->query($sql,array($ID__DOMICILIO,$guardabosque["NOMBRE"],$guardabosque["APELLIDO_x0020_PATERNO"],$guardabosque["APELLIDO_x0020_MATERNO"]			,	$guardabosque["TELEFONO"],$guardabosque["CELULAR"],$guardabosque["CORREO"]));										
				return $this->db->insert_id();	//ID__GUARDABOSQUE
			}								
		}				        				
        public function set_adopcion($rowPlanta,$guardabosque,$ID__GUARDABOSQUE,$evento)
		{	
			$FEC_FECHA = DateTime::createFromFormat('d/m/Y', $rowPlanta["FECHA_x0020_ADOPCION"]);	
			$FEC_FECHA=$FEC_FECHA->format('Y-m-d');
			$ID__ESPECIE=explode("-",$rowPlanta["CODIGO_x0020_QR"])[1];
			$sql='INSERT INTO catconf_020_arboles
				(ID__ESPECIE,NUM_TAMANO,NUM_EDAD,VCH_PROCEDENCIA,VCH_CODIGOQR,
				VCH_CODIGOQRFINAL,NUM_CANTIDAD,VCH_ESTATUS,VCH_LATITUD,VCH_LONGITUD,
				ID__UBICACION,FEC_FECHA,ID__EVENTO)
				VALUES
				(?,?,?,?,?,
				?,?,?,?,?,
				?,?,?);';	//inserta el arbol
			$this->db->query($sql,array(
				$ID__ESPECIE,0,0,0,$rowPlanta["CODIGO_x0020_QR"],
				$rowPlanta["CODIGO_x0020_QR"],1,1,0,0,
				0,$FEC_FECHA,$evento			
			));					
//			echo "<br/>".$rowPlanta["CODIGO_x0020_QR"];
			$ID__ARBOL=$this->db->insert_id();
			
			$sql='INSERT INTO traoper_021_registroadopcion
			(ID__GUARDABOSQUE,ID__ARBOL,ID__EVENTOADOPCION,NUM_CANTIDAD,FEC_FECHA,
			VCH_FOTO,VCH_ESTATUS,ID__PROGRAMACION)
			VALUES
			(?,?,?,?,?,
			?,?,?)';	//inserta el arbol
			$this->db->query($sql,array(
				$ID__GUARDABOSQUE,$ID__ARBOL,$evento,1,$FEC_FECHA,
				"",1,0			));											
		}	     				
		
		
		public function get_eventos()
		{			 							
			$sql="SELECT ID__EVENTO,concat(substr(FEC_FECHAINICIO,1,10),\" - \",VCH_NOMBREEVENTO) as VCH_NOMBREEVENTO FROM catconf_065_eventos where VCH_ESTATUS!=1 order by VCH_NOMBREEVENTO desc ";				
			$row = $this->db->query($sql)->result_array();
			return $row;
		}		
		
}

