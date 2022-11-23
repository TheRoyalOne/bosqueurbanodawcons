<div id="page-wrapper">
    <div class="container-fluid">
     <!-- Page Heading -->
     <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <small>Inicio</small> 
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-offset-1 col-lg-10">
         <?php 
         		
          $datos=array(); 
			// sort($eventos)
			//   var_dump($eventos);
			//   die;
          foreach($eventos as $evento)
          {			  
			  $textstatus="";
			  switch($evento["VCH_ESTATUS"])
			  {
				  case 1:
				  {
					$textstatus="Activo";		  
					break;
				  }
				  case 0:
				  {
					$textstatus="Inactivo";		  
					break;
				  }
				  case 2:
				  {
					  $textstatus="Terminado";
					break;
				  }
			  }
			  array_push($datos,$evento["VCH_NOMBRE"],$evento["FEC_FECHAINICIO"],$evento["FEC_FECHAFIN"],$evento["VCH_LUGAR"],$evento["VCH_NOMBREPATROCINADOR"],$textstatus);
		  
			}
		//   var_dump($datos);
		//   die;
          $template= array('table_open'=>"<table data-toggle='table' data-align='center' data-halign='center' data-classes='table table-hover table-no-bordered' data-height='270' >",
		  'thead_open'=>"<thead style='background-color:#00A89C; color:#fff;' >");
          $this->table->set_template($template);
          $this->table->set_heading('Evento','Fecha de inicio','Fecha de termino','Lugar','Patrocinador','Estatus');
          echo  $this->table->generate($this->table->make_columns($datos,6));
         ?>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<hr>      
		</div>
	
	</div>
    <div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="form-group text-center">
				<label class="text-center "> <b class="lblTitulo">Total adopciones </b></label>				
				<label class="col-lg-12 text-center"> <b class="lblTotalArboles"><?php
//				echo "<pre>";die(print_r(get_defined_vars()));
				
				 echo $totaladop ?></b></label>				
			</div>      
		</div>
	
	</div>
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="form-group text-center">
				<label class="col-lg-12 text-center "> <b class="lblTitulo">Total árboles en inventario</b></label>				
				<label class="col-lg-12 text-center"> <b class="lblTotalArboles"><?=$totalarb?></b></label>				
			</div>      
		</div>

	
	</div>
    <div class="row">
		<!--<div class="col-lg-4 col-md-4 text-center">
			<label for="" class="text-center col-lg-12 col-md-12 col-xs-12">Total de Arboles</label>
			<label for="" class="text-center col-lg-12 col-md-12 col-xs-12">1000</label>
		</div>-->
		<div class="col-lg-offset-2 col-lg-4 col-md-offset-2 col-md-4 col-xs-6 text-center">
			
			<div class="chart-container"  style="position: relative;">
				<canvas id="pieEstado" />
				<!--<div id="estadoArbol"></div>-->
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-xs-6 text-center">
			<div class="chart-container text-center" style="position: relative;">
				<canvas id="pieSalud" />
			</div>
		</div>
	</div>
		 
		 
		 
        
        
        
        
            <!--
    <!--<div class="row">
        <div class="col-lg-offset-3 col-lg-6">
         <?php 

          $datos=array('Dulces Michel','Patrocinio','02/05/2016 - 28/04/2017'); 
          $template= array('table_open'=>"<table class='table table-hover'>");
          $this->table->set_template($template);
          $this->table->set_heading('Empresa/Institución','Concepto','Fecha');
          echo  $this->table->generate($this->table->make_columns($datos,3));

         ?>
        </div>
    </div>-->
</div>
</div>

<!-- Esta etiqueta se abre en la vista menu.php -->
</div>
<script>
// Morris.Donut({
//   element: 'estadoArbol',
//   colors:["#00FF00","#8B6914","#FFFF00"],
//   data: [
//     {label: "Vivo", value: <?=$arboles["vivos"]?>},
//     {label: "Muerto", value: <?=$arboles["muertos"]?>},
//     {label: "Sin datos", value: <?=$arboles["desconocidos"]?>}
//   ]	
// });
// Morris.Donut({
//   element: 'saludArbol',
//   colors:["#00FF00","#8B6914","#FFFF00"],
//   data: [
//     {label: "Sano", value: 0},
//     {label: "Enfermo", value: 32},
//     {label: "Sin datos", value: 20}
//   ]
// });
var pie = document.getElementById("pieEstado").getContext('2d');

var pieChart1 = new Chart(pie,{
	type: 'pie',
	data: {
		datasets: [{
			data: [<?=$arboles["vivos"]?>,<?=$arboles["muertos"]?>,<?=($totalarbAdop-$arboles["muertos"]-$arboles["vivos"])?>],
			backgroundColor:['#afe14f','#00A89C','#A59A95']
		}],
		labels: ['Vivo','Muerto','Sin datos']
	},
	options:{
		responsive:true ,
		maintainAspectRatio:true,
		legend:{
			display: true,
			position: 'bottom',
			labels: {
				boxWidth:15
			}

		},
		title:{
			display: true,
			text:'Estado de Arbol',
			position: 'top',
			fontSize: 16
		}
	}

});

var pie2 = document.getElementById("pieSalud").getContext('2d');

var pieChart1 = new Chart(pie2,{
	type: 'pie',
	data: {
		datasets: [{
			data: [<?=$salud["sanos"]?>,<?=$salud["enfermos"]?>,<?=$salud["desconocidos"]?>,<?=$totalarbAdop-$salud["enfermos"]-$salud["sanos"]-$salud["desconocidos"]?>],
			backgroundColor:['#afe14f','#00A89C','#00A94F','#A59A95']
		}],
		labels: ['Sano','Enfermo','Otro','Sin datos']
	},
	options:{
		responsive:true,
		maintainAspectRatio:true,
		legend:{
			display: true,
			position: 'bottom',
			labels: {
				boxWidth:15
			}
			

		},
		title:{
			display: true,
			text:'Salud de Arbol',
			position: 'top',
			fontSize: 16
		}
	}

});

</script>
