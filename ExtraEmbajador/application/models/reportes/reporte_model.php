<?php
class Reporte_model extends CI_Model 
{

        public function __construct()
        {
                $this->load->database();
                $this->load->library('session');
        }
        public function fechaHumana($valor)
        {
			
//			date ("n",)
		}
        
        /*Perfiles Abajo*/
        public function get_reporteAdopcion()
		{
			//			$query = $this->db->get('catconf_001_perfiles');					 
			//			die(print_r($query->result_array()));
		}		
		public function get_selectEspecies()
		{
			$sql="SELECT ID__ESPECIE,VCH_NOMBRECOMUN FROM catconf_009_especies order by VCH_NOMBRECOMUN asc";										  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;	
		}		
		/*CatalogoEventos abajo*/
		public function get_selectEventos()
		{
			$sql="SELECT ID__EVENTO,VCH_NOMBREEVENTO
						FROM catconf_065_eventos where VCH_TIPO=1  order by VCH_NOMBREEVENTO asc";										  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;	
		}
		/*CatalogoEventos abajo*/
		public function get_selectEmpresas()
		{
			$sql="SELECT ID__EMPRESA,VCH_NOMBREEMPRESA
						FROM catconf_013_empresa order by VCH_NOMBREEMPRESA asc";										  									  
			$query = $this->db->query($sql)->result_array();	
			return $query;	
		}
		
		public function generaReporteAdopcion( $fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$VCH_ESTATUS  )
		{
	
		}
		
		public function getAllInfoEventos($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$VCH_ESTATUS)
		{

			$where="where VCH_TIPO=1 and FEC_FECHAINICIO >= '".$fechaInicio." 23:59:59' and '".$fechafin."  23:59:59' >= FEC_FECHAFIN";		
			if($ID__EVENTO!=-1)			
			{
				$where.=" and catconf_065_eventos.ID__EVENTO=".intval($ID__EVENTO);
				$nombreevento = $this->db->query("select VCH_NOMBREEVENTO from catconf_065_eventos where ID__EVENTO=?",array($ID__EVENTO))->result_array()[0]["VCH_NOMBREEVENTO"];	
			}
			else
			{
				$nombreevento ="Todos";
			}
			if($ID__EMPRESA!=-1)			
			{
				$where.=" and catconf_065_eventos.ID__EMPRESA=".intval($ID__EMPRESA);
				$nombreempresa = $this->db->query("select VCH_NOMBREEMPRESA from catconf_013_empresa where ID__EMPRESA=?",array($ID__EMPRESA))->result_array()[0]["VCH_NOMBREEMPRESA"];	
			}
			else
			{
				$nombreempresa="Todos";
			}		
			if($VCH_ESTATUS!=-1)			
			{
				$where.=" and catconf_065_eventos.VCH_ESTATUS=".intval($VCH_ESTATUS);
				switch($VCH_ESTATUS)
				{
					case 0: {$nombrestatus="Inactivo";break;}
					case 1: {$nombrestatus="Activo";break;}
					case 2:{$nombrestatus="Finalizado";break;}

				}
			}			
			else
			{
				$nombrestatus="Todos";
			}
				
			$sql="SELECT count(*) as total FROM catconf_065_eventos ".$where;	
			$sql.=" order by VCH_NOMBREEVENTO asc";										  									  
			$totaleventos = $this->db->query($sql)->result_array()[0]["total"];	
			//die($this->db->last_query());
						
			$sql="SELECT count(distinct(ID__EMPRESA)) as total FROM catconf_065_eventos ".$where;	
			$sql.=" order by VCH_NOMBREEVENTO asc";										  									  
			$totalPatrocinadores = $this->db->query($sql)->result_array()[0]["total"];				
									
			$sql="SELECT count(*) cant,substr(FEC_FECHAINICIO,1,10) as fecha FROM catconf_065_eventos  ".$where;	
			$sql.=" group by substr(FEC_FECHAINICIO,1,10)  order by substr(FEC_FECHAINICIO,1,10) asc";										  									  
			$totalEventosPorDia = $this->db->query($sql)->result_array();				
									
			$sql="SELECT count(*) cant,VCH_NOMBREEMPRESA FROM catconf_065_eventos  
					inner join catconf_013_empresa on catconf_065_eventos.ID__EMPRESA=catconf_013_empresa.ID__EMPRESA  ".$where;	
			$sql.=" group by  catconf_013_empresa.ID__EMPRESA  order by VCH_NOMBREEMPRESA asc";										  									  
			$totalEventosPorPatrocinador = $this->db->query($sql)->result_array();				
			$indaux=0;
			foreach($totalEventosPorPatrocinador as $evpatro)
			{				
				$totalEventosPorPatrocinador[$indaux++]["porcentaje"]=intval(($evpatro["cant"]/$totaleventos)*100);
			}
			//die(print_r($totalEventosPorPatrocinador));
			
			
			$sql="SELECT count(*) cant,VCH_ESTATUS FROM catconf_065_eventos ".$where;	
			$sql.=" group by  VCH_ESTATUS";										  									  
			$eventosPorEstatus = $this->db->query($sql)->result_array();	
			
			$sql="select VCH_NOMBREEVENTO,llevados,entregados from 
			(
				(
					select * from catconf_065_eventos ".$where. "
				)eventos
			inner join
			(SELECT sum(NUM_CANTIDAD) llevados,ID__EVENTO FROM catconf_066_relarboladoasignadoaevento group by ID__EVENTO)llevado
			on eventos.ID__EVENTO=llevado.ID__EVENTO
			left join
			(select sum(NUM_CANTIDAD) entregados,ID__EVENTOADOPCION from traoper_021_registroadopcion group by  ID__EVENTOADOPCION)Entregados 
			on eventos.ID__EVENTO=Entregados.ID__EVENTOADOPCION) ";												  									  
			$eventosPorEficiencia = $this->db->query($sql)->result_array();	
			
			$sql="SELECT VCH_NOMBREEVENTO,VCH_LATITUD,VCH_LONGITUD FROM catconf_065_eventos ".$where;	
			$sql.="";										  									  
			$eventosUbicados = $this->db->query($sql)->result_array();
			
			
			//echo "<pre>";			die(print_r(get_defined_vars()));
			$data=array();											
			$data["nombreevento"]=$nombreevento;
			$data["nombreempresa"]=$nombreempresa;
			$data["nombrestatus"]=$nombrestatus;			
			$data["totaleventos"]=$totaleventos;
			$data["totalPatrocinadores"]=$totalPatrocinadores;
			$data["totalEventosPorDia"]=$totalEventosPorDia;
			$data["totalEventosPorPatrocinador"]=$totalEventosPorPatrocinador;
			$data["eventosPorEficiencia"]=$eventosPorEficiencia;
			$data["eventosPorEstatus"]=$eventosPorEstatus;		
			$data["eventosUbicados"]=$eventosUbicados;		
			
			return $data;
		}
		public function getAllInfoReforesta($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$VCH_ESTATUS)
		{

			$where="where VCH_TIPO=2 and FEC_FECHAINICIO >= '".$fechaInicio." 23:59:59' and '".$fechafin."  23:59:59' >= FEC_FECHAFIN";		
			if($ID__EVENTO!=-1)			
			{
				$where.=" and catconf_065_eventos.ID__EVENTO=".intval($ID__EVENTO);
				$nombreevento = $this->db->query("select VCH_NOMBREEVENTO from catconf_065_eventos where ID__EVENTO=?",array($ID__EVENTO))->result_array()[0]["VCH_NOMBREEVENTO"];	
			}
			else
			{
				$nombreevento ="Todos";
			}
			if($ID__EMPRESA!=-1)			
			{
				$where.=" and catconf_065_eventos.ID__EMPRESA=".intval($ID__EMPRESA);
				$nombreempresa = $this->db->query("select VCH_NOMBREEMPRESA from catconf_013_empresa where ID__EMPRESA=?",array($ID__EMPRESA))->result_array()[0]["VCH_NOMBREEMPRESA"];	
			}
			else
			{
				$nombreempresa="Todos";
			}		
			
				
			$sql="SELECT count(*) as total FROM catconf_065_eventos ".$where;	
			$sql.=" order by VCH_NOMBREEVENTO asc";										  									  
			$totaleventos = $this->db->query($sql)->result_array()[0]["total"];	
//			die($this->db->last_query());
						
			$sql="SELECT count(distinct(ID__EMPRESA)) as total FROM catconf_065_eventos ".$where;	
			$sql.=" order by VCH_NOMBREEVENTO asc";										  									  
			$totalPatrocinadores = $this->db->query($sql)->result_array()[0]["total"];				
			
			
			//tomar el JSON de empresas y vincular al nombre (BD no soportaba JSON 5.4)
			$sql="select replace(replace(VCH_EMPRESASREFOR,'[',''),']','') as ID__EMPRESA,ID__EVENTO from catconf_065_eventos ".$where." and VCH_EMPRESASREFOR is not null and VCH_EMPRESASREFOR!='' ";			  
			$reforestacionesPorPatrocinador = $this->db->query($sql)->result_array();
//						die(print_r($reforestacionesPorPatrocinador));				
			//todas las empresas parseo a diccionario			
			$sql="Select ID__EMPRESA,VCH_NOMBREEMPRESA from catconf_013_empresa ";			  
			$arremp = $this->db->query($sql)->result_array();							
			$temp["ID__EMPRESA"]=array();
			$temp["VCH_NOMBREEMPRESA"]=array();
			foreach($arremp as $emp)
			{
				array_push($temp["ID__EMPRESA"],intval($emp["ID__EMPRESA"]));
				array_push($temp["VCH_NOMBREEMPRESA"],$emp["VCH_NOMBREEMPRESA"]);
			}			
			$arremp=array_combine ( $temp["ID__EMPRESA"] , $temp["VCH_NOMBREEMPRESA"] );//			echo "<pre>";die(print_r($arremp));

			//Aplana el array y cuenta repetidos
			$arrayaparicion=array();
			foreach($reforestacionesPorPatrocinador as $refpat)
			{
				$tempSeparado=explode(",",$refpat["ID__EMPRESA"]  );
				foreach($tempSeparado as $sep)
				{
					array_push($arrayaparicion , 	str_replace('"','',$sep) );
				}				
			}
			$contRep =array_count_values($arrayaparicion);				
			
			//por cada uno busca el match con el ID
			$totalReforestaPorEmpresa=array();
			foreach(array_keys($contRep) as $rep)
			{
				$obj["id"]=$rep;
				$obj["nombre"]=$arremp[$rep];
				$obj["apariciones"]=$contRep[$rep];
				array_push($totalReforestaPorEmpresa,$obj);
				$contRep[$rep]=$arremp[$rep];
			}
			
			$sql="SELECT count(*) cant,substr(FEC_FECHAINICIO,1,10) as fecha FROM catconf_065_eventos  ".$where;	
			$sql.=" group by substr(FEC_FECHAINICIO,1,10)  order by substr(FEC_FECHAINICIO,1,10) asc";										  									  
			$totalEventosPorDia = $this->db->query($sql)->result_array();				
									
			$sql="SELECT count(*) as c,VCH_TIPOREFORESTA FROM catconf_065_eventos ".$where;	
			$sql.=" group by VCH_TIPOREFORESTA";										  									  
			$totalEventosPortipotemp = $this->db->query($sql)->result_array();		
						
			$totalEventosPortipo["empresarial"]=0;
			$totalEventosPortipo["masivo"]=0;
			$totalEventosPortipo["ambas"]=0;
			$totalEventosPortipo["taller"]=0;
			foreach($totalEventosPortipotemp as $tipo)
			{
				switch($tipo["VCH_TIPOREFORESTA"])
				{
					case 1:
					{
						$totalEventosPortipo["empresarial"]=$totalEventosPortipo["empresarial"]+$tipo["c"];
						break;
					}
					case 2:
					{
						$totalEventosPortipo["masivo"]=$totalEventosPortipo["masivo"]+$tipo["c"];
						break;
					}
					case 3:
					{
						//echo "win";
						$totalEventosPortipo["ambas"]=$totalEventosPortipo["ambas"]+$tipo["c"];
						break;
					}
					case 4:
					{
						$totalEventosPortipo["taller"]=$totalEventosPortipo["taller"]+$tipo["c"];
						break;
					}				
				}
			}
			
			$sql="
				SELECT sum(NUM_CANTIDAD) NUM_CANTIDAD,ID__EVENTO,rel.ID__ESPECIE,VCH_NOMBRECOMUN FROM catconf_066_relarboladoasignadoaevento rel
				left join catconf_009_especies esp on rel.ID__ESPECIE=esp.ID__ESPECIE
				where ID__EVENTO in 
				(
					SELECT ID__EVENTO FROM catconf_065_eventos ".$where."
				)
				 group by ID__ESPECIE;
				";	
			$totalReforestacionesPorEspecie = $this->db->query($sql)->result_array();		
					
			$sql="
				SELECT sum(NUM_CANTIDAD) NUM_CANTIDAD,rel.ID__EVENTO,rel.ID__ESPECIE,VCH_NOMBRECOMUN,VCH_NOMBREEVENTO,FEC_FECHAINICIO FROM catconf_066_relarboladoasignadoaevento rel
				left join catconf_009_especies esp on rel.ID__ESPECIE=esp.ID__ESPECIE
				left join catconf_065_eventos ev on rel.ID__EVENTO=ev.ID__EVENTO
				where rel.ID__EVENTO in 
				(
					SELECT ID__EVENTO FROM catconf_065_eventos ".$where."
				)
				 group by rel.ID__EVENTO, reL.ID__ESPECIE ORDER BY rel.ID__EVENTO ASC;
				";	
			$totalReforestacionesPorEventoArbolado = $this->db->query($sql)->result_array();				
			//echo "<pre>";	die(print_r($totalReforestacionesPorEventoArbolado))	;
			
			$sql="SELECT sum(NUM_ARBOLESSOLICITADOS) CANT,rel.ID__EVENTO,VCH_NOMBREEVENTO FROM catconf_065_eventos inner join catconf_066_relarboladoasignadoaevento rel
				on catconf_065_eventos.ID__EVENTO=rel.ID__EVENTO  ".$where." group by rel.ID__EVENTO
				";	
			$GRAFTOTALARBOLADO = $this->db->query($sql)->result_array();				
		
			$data=array();											
			$data["nombreevento"]=$nombreevento;
			$data["nombreempresa"]=$nombreempresa;		
			$data["totaleventos"]=$totaleventos;
			$data["totalPatrocinadores"]=$totalPatrocinadores;
			$data["totalEventosPorDia"]=$totalEventosPorDia;
			$data["totalEventosPortipo"]=$totalEventosPortipo;
			$data["reforestacionesPorPatrocinador"]=$totalReforestaPorEmpresa;
			$data["GRAFTOTALARBOLADO"]=$GRAFTOTALARBOLADO;
			$data["totalReforestacionesPorEspecie"]=$totalReforestacionesPorEspecie;
			$data["totalReforestacionesPorEventoArbolado"]=$totalReforestacionesPorEventoArbolado;
			
			return $data;
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function getAllInfoAdopciudadana($fechaInicio,$fechafin,$ID__EVENTO,$ID__EMPRESA,$ID__ESPECIE,$listado)
		{
			$where="where VCH_TIPO=1 and FEC_FECHAINICIO >= '".$fechaInicio." 23:59:59' and '".$fechafin."  23:59:59' >= FEC_FECHAFIN";		
			$whereespecie="";
			if($ID__EVENTO!=-1)			
			{
				$where.=" and catconf_065_eventos.ID__EVENTO=".intval($ID__EVENTO);
				$nombreevento = $this->db->query("select VCH_NOMBREEVENTO from catconf_065_eventos where ID__EVENTO=?",array($ID__EVENTO))->result_array()[0]["VCH_NOMBREEVENTO"];	
			}
			else
			{
				$nombreevento ="Todos";
			}
			if($ID__EMPRESA!=-1)			
			{
				$where.=" and catconf_065_eventos.ID__EMPRESA=".intval($ID__EMPRESA);
				$nombreempresa = $this->db->query("select VCH_NOMBREEMPRESA from catconf_013_empresa where ID__EMPRESA=?",array($ID__EMPRESA))->result_array()[0]["VCH_NOMBREEMPRESA"];	
			}
			else
			{
				$nombreempresa="Todos";
			}		
			if($ID__ESPECIE!=-1)			
			{
				$nombreespecie=$this->db->query("select VCH_NOMBRECOMUN from catconf_009_especies where ID__ESPECIE=?",array($ID__ESPECIE))->result_array()[0]["VCH_NOMBRECOMUN"];	
			}			
			else
			{
				$nombreespecie="Todos";
			}					
																																
			$sql="SELECT count(*) as total FROM catconf_065_eventos ".$where;				
			if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
			{
				$sql.=" and ID__EVENTO in (";
					$sql.=" 
						select ID__EVENTOADOPCION as ID__EVENTO from traoper_021_registroadopcion reg inner join catconf_020_arboles arb
						on reg.ID__ARBOL=arb.ID__ARBOL
						where ID__ESPECIE = ".$ID__ESPECIE."
						group by ID__EVENTOADOPCION";
				$sql.=")";
			}													  									  
			$totaleventos = $this->db->query($sql)->result_array()[0]["total"];	
			
			$sql="SELECT count(distinct(ID__EMPRESA)) as total FROM catconf_065_eventos ".$where;				
			if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
			{
				$sql.=" and ID__EVENTO in (";
					$sql.=" 
						select ID__EVENTOADOPCION as ID__EVENTO from traoper_021_registroadopcion reg inner join catconf_020_arboles arb
						on reg.ID__ARBOL=arb.ID__ARBOL
						where ID__ESPECIE = ".$ID__ESPECIE."
						group by ID__EVENTOADOPCION";
				$sql.=")";
			}													  									  
			$totalpatrocinadores = $this->db->query($sql)->result_array()[0]["total"];	
		//die($this->db->last_query());
			
			$sql="
			select ifnull(sum(NUM_CANTIDAD),0) as total from (
			select sum(arb.NUM_CANTIDAD) as NUM_CANTIDAD,ID__EVENTOADOPCION from traoper_021_registroadopcion  reg inner join catconf_020_arboles arb on reg.ID__ARBOL=arb.ID__ARBOL"; 
					if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
						{
							$sql.=" where ID__ESPECIE = ".$ID__ESPECIE;						
						}
																										$sql.=" group by ID__EVENTOADOPCION)conteo 
			inner join 
			(
			
			SELECT ID__EVENTO  FROM catconf_065_eventos ".$where;				
			if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
			{
				$sql.=" and ID__EVENTO in (";
					$sql.=" 
						select ID__EVENTOADOPCION as ID__EVENTO from traoper_021_registroadopcion reg inner join catconf_020_arboles arb
						on reg.ID__ARBOL=arb.ID__ARBOL
						where ID__ESPECIE = ".$ID__ESPECIE."
						group by ID__EVENTOADOPCION";
				$sql.=")";
			}				
			$sql.=")id on conteo.ID__EVENTOADOPCION=id.ID__EVENTO";					  									  
			$totaladoptados = $this->db->query($sql)->result_array()[0]["total"];	
//			die($this->db->last_query());
				
							
			$sql="
			select * from (
			
				select sum(arb.NUM_CANTIDAD) as NUM_CANTIDAD,substr(reg.FEC_FECHA,1,10) fecha,ID__EVENTOADOPCION from traoper_021_registroadopcion reg inner join catconf_020_arboles arb on reg.ID__ARBOL=arb.ID__ARBOL";
				if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
						{
							$sql.=" where ID__ESPECIE = ".$ID__ESPECIE;						
						}
				$sql.=" group by substr(FEC_FECHA,1,10),ID__EVENTOADOPCION
				
				
			)conteo 
			inner join 
			(			
			SELECT ID__EVENTO  FROM catconf_065_eventos ".$where;				
			
				$sql.=" and ID__EVENTO in (";
					$sql.=" 
						select ID__EVENTOADOPCION as ID__EVENTO from traoper_021_registroadopcion reg inner join catconf_020_arboles arb
						on reg.ID__ARBOL=arb.ID__ARBOL ";
						if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
						{
							$sql.=" where ID__ESPECIE = ".$ID__ESPECIE;						
						}
						$sql.=" group by ID__EVENTOADOPCION";
				$sql.=")";
							
			$sql.=")id on conteo.ID__EVENTOADOPCION=id.ID__EVENTO";					  									  
			$totalporfecha = $this->db->query($sql)->result_array();	
			//die($this->db->last_query());
			
			$sql="
			select * from (
				select sum(arb.NUM_CANTIDAD) as NUM_CANTIDAD,ID__EVENTOADOPCION from traoper_021_registroadopcion reg inner join catconf_020_arboles arb on reg.ID__ARBOL=arb.ID__ARBOL";
				if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
						{
							$sql.=" where ID__ESPECIE = ".$ID__ESPECIE;						
						}
				$sql.=" group by ID__EVENTOADOPCION
			)conteo 
			inner join 
			(			
			SELECT ID__EVENTO,VCH_NOMBREEVENTO  FROM catconf_065_eventos ".$where;				
			
				$sql.=" and ID__EVENTO in (";
					$sql.=" 
						select ID__EVENTOADOPCION as ID__EVENTO from traoper_021_registroadopcion reg inner join catconf_020_arboles arb
						on reg.ID__ARBOL=arb.ID__ARBOL ";
						if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
						{
							$sql.=" where ID__ESPECIE = ".$ID__ESPECIE;						
						}
						$sql.=" group by ID__EVENTOADOPCION";
				$sql.=")";
							
			$sql.=")id on conteo.ID__EVENTOADOPCION=id.ID__EVENTO";					  									  
			$totalporevento = $this->db->query($sql)->result_array();	
				
				
			$sql="			
			select * from
			(
				select VCH_NOMBREEMPRESA,emp.ID__EMPRESA,ID__EVENTO from
				(select VCH_NOMBREEMPRESA,ID__EMPRESA from catconf_013_empresa) emp
				inner join
				(
					select ID__EVENTO,ID__EMPRESA from catconf_065_eventos ".$where." 
				) idempresas on emp.ID__EMPRESA=idempresas.ID__EMPRESA
			)exterior
				inner join 
				(
					 select ID__EVENTOADOPCION as ID__EVENTO,sum(reg.NUM_CANTIDAD) cant from traoper_021_registroadopcion reg 
					 inner join catconf_020_arboles arb on reg.ID__ARBOL=arb.ID__ARBOL";					 
					 if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
						{
							$sql.=" where ID__ESPECIE = ".$ID__ESPECIE;						
						}					 
					$sql.=" group by ID__EVENTO
				)adop on exterior.ID__EVENTO=adop.ID__EVENTO
				";					
			$totalporpatronos = $this->db->query($sql)->result_array();							
			
			$sql="			
			select sum(cant) cant ,esp.ID__ESPECIE, VCH_NOMBRECOMUN from
			(
				select ID__EVENTO,ID__EMPRESA from catconf_065_eventos ".$where." 
			)exterior

			inner join 
			(
					 select ID__EVENTOADOPCION as ID__EVENTO,sum(reg.NUM_CANTIDAD) cant, ID__ESPECIE  from traoper_021_registroadopcion reg 
				 inner join catconf_020_arboles arb on reg.ID__ARBOL=arb.ID__ARBOL";					 
				 if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
					{
						$sql.=" where ID__ESPECIE = ".$ID__ESPECIE;						
					}					 
				$sql.="  group by ID__ESPECIE,ID__EVENTO
			)adop on exterior.ID__EVENTO=adop.ID__EVENTO
			inner join catconf_009_especies esp on adop.ID__ESPECIE=esp.ID__ESPECIE
			group by ID__ESPECIE
				";					
			$totalporespecie = $this->db->query($sql)->result_array();	
			//die($this->db->last_query());
			
			
			$sql="			
			select VCH_LATITUD,VCH_LONGITUD,ID__EVENTOADOPCION from catconf_020_arboles arb
			inner join traoper_021_registroadopcion tra on arb.ID__ARBOL=tra.ID__ARBOL
			where ";
			 if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
					{
						$sql.=" ID__ESPECIE = ".$ID__ESPECIE." and ";						
					}	
			$sql.="		
			  ID__EVENTOADOPCION in
			(
				select ID__EVENTO from catconf_065_eventos ".$where." 
			)";					
			$localizaciones = $this->db->query($sql)->result_array();	
			//die($this->db->last_query());
				
				
			$list=null;
			if($listado==1)
			{
			$sql="			
			select ID__EVENTOADOPCION,VCH_CODIGOQR, nombre ,  domicilio,VCH_NOMBRECOMUN  from catconf_065_eventos ev
			inner join
			(
				select ID__EVENTOADOPCION,VCH_CODIGOQR,concat(VCH_NOMBRE,' ',VCH_APELLIDOPATERNO,' ',VCH_APELLIDOMATERNO) nombre , concat(VCH_CALLE,' ',VCH_ENTRECALLE) domicilio,VCH_NOMBRECOMUN 
				from traoper_021_registroadopcion reg 
				inner join catconf_020_arboles arb on reg.ID__ARBOL=arb.ID__ARBOL    
				inner join  catconf_009_especies esp on arb.ID__ESPECIE =esp.ID__ESPECIE
				inner join catconf_012_guardabosques gua on reg.ID__GUARDABOSQUE=gua.ID__GUARDABOSQUE    
				left join catconf_008_domicilios dom on gua.ID__DOMICILIO=dom.ID__DOMICILIO";
				if($ID__ESPECIE!=-1&&$ID__ESPECIE!='')
					{
						$sql.=" where esp.ID__ESPECIE = ".$ID__ESPECIE." ";						
					}
			$sql.="
			)b on ev.ID__EVENTO=b.ID__EVENTOADOPCION
				";					
			$list = $this->db->query($sql)->result_array();	
			}
			//die($this->db->last_query());
			

			
			$data["nombreevento"]=$nombreevento;
			$data["nombreempresa"]=$nombreempresa;
			$data["nombreespecie"]=$nombreespecie;
			$data["totaleventos"]=$totaleventos;
			$data["totalpatrocinadores"]=$totalpatrocinadores;		
			$data["totaladoptados"]=$totaladoptados;	
			$data["totalporfecha"]=$totalporfecha;		
			$data["totalporevento"]=$totalporevento;
			$data["totalporpatronos"]=$totalporpatronos;					
			$data["totalporespecie"]=$totalporespecie;	
			$data["localizaciones"]=$localizaciones;
			$data["listado"]=$listado;	
			$data["list"]=$list;	
							
			return $data;
		}
}

