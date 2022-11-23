<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$titulo?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url().'css/bootstrap.css'?>" rel="stylesheet">

    <!-- Bootstrap Table CSS -->
    <link href="<?= base_url().'css/bootstrap-table.css'?>" rel="stylesheet">

    <!-- Bootstrap fileinput CSS -->
    <link href="<?= base_url().'css/fileinput.css'?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url().'css/sb-admin.css'?>" rel="stylesheet">

    <!-- Bootstrap Datepicker CSS -->
    <link href="<?= base_url().'css/datepicker.css'?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?= base_url().'css/plugins/morris.css'?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url().'font-awesome/css/font-awesome.min.css'?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link rel="stylesheet" href="<?= base_url().'css/general.css'?>"></link>
    
     <!-- jQuery -->
    <script src="<?= base_url().'js/jquery.js'?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url().'js/bootstrap.js'?>"></script>
    
    <!-- Bootstrap Table JavaScript -->
    <script src="<?= base_url().'js/bootstrap-table.js'?>"></script>

    <!-- Bootstrap fileinput JavaScript -->
    <script src="<?= base_url().'js/fileinput.js'?>"></script>

    <!-- Morris Charts JavaScript -->
    <?php
	if(isset($graph))
	{
	?>
    <script src="<?= base_url().'js/plugins/morris/raphael.min.js'?>"></script>
    <script src="<?= base_url().'js/plugins/morris/morris.min.js'?>"></script>
    <script src="<?= base_url().'js/plugins/morris/morris-data.js'?>"></script>
	<?php
	}
	?>
    <!-- Boootstrap Treeview-->
    <script src="<?= base_url().'js/bootstrap-treeview.js'?>"></script>

    <!-- Boootstrap Datepicker-->
    <script src="<?= base_url().'js/bootstrap-datepicker.js'?>"></script>
     
     <!-- Boootstrap Datepicker-->
     <script src="<?= base_url().'js/bootbox.min.js'?>"></script>

	 <!--Charts js para el pie-->
	 <script src="<?= base_url().'js/Chart.min.js'?>"></script>
</head>
<body>
<style>
.back{
	margin-top: 50px;
    background-image: url(<?= base_url()?>./imagenes/footer-bg.png),linear-gradient(#96C8FD,#ffffff);
    background-repeat: repeat-x;
    background-attachment: fixed;
    background-position: bottom;
	}
	#background-wrap {
    bottom: 0;
	left: 0;
	padding-top: 50px;
	position: fixed;
	right: 0;
	top: 0;
	z-index: -1;
}

/* KEYFRAMES */

@-webkit-keyframes animateCloud {
    0% {
        margin-left: -1000px;
    }
    100% {
        margin-left: 100%;
    }
}

@-moz-keyframes animateCloud {
    0% {
        margin-left: -1000px;
    }
    100% {
        margin-left: 100%;
    }
}

@keyframes animateCloud {
    0% {
        margin-left: -1000px;
    }
    100% {
        margin-left: 100%;
    }
}

/* ANIMATIONS */

.x1 {
	-webkit-animation: animateCloud 35s linear infinite;
	-moz-animation: animateCloud 35s linear infinite;
	animation: animateCloud 35s linear infinite;
	
	-webkit-transform: scale(0.65);
	-moz-transform: scale(0.65);
	transform: scale(0.65);
}

.x2 {
	-webkit-animation: animateCloud 20s linear infinite;
	-moz-animation: animateCloud 20s linear infinite;
	animation: animateCloud 20s linear infinite;
	
	-webkit-transform: scale(0.3);
	-moz-transform: scale(0.3);
	transform: scale(0.3);
}

.x3 {
	-webkit-animation: animateCloud 30s linear infinite;
	-moz-animation: animateCloud 30s linear infinite;
	animation: animateCloud 30s linear infinite;
	
	-webkit-transform: scale(0.5);
	-moz-transform: scale(0.5);
	transform: scale(0.5);
}

.x4 {
	-webkit-animation: animateCloud 18s linear infinite;
	-moz-animation: animateCloud 18s linear infinite;
	animation: animateCloud 18s linear infinite;
	
	-webkit-transform: scale(0.4);
	-moz-transform: scale(0.4);
	transform: scale(0.4);
}

.x5 {
	-webkit-animation: animateCloud 25s linear infinite;
	-moz-animation: animateCloud 25s linear infinite;
	animation: animateCloud 25s linear infinite;
	
	-webkit-transform: scale(0.55);
	-moz-transform: scale(0.55);
	transform: scale(0.55);
}

/* OBJECTS */

.cloud {
	background: #fff;
	background: -moz-linear-gradient(top,  #fff 5%, #f1f1f1 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(5%,#fff), color-stop(100%,#f1f1f1));
	background: -webkit-linear-gradient(top,  #fff 5%,#f1f1f1 100%);
	background: -o-linear-gradient(top,  #fff 5%,#f1f1f1 100%);
	background: -ms-linear-gradient(top,  #fff 5%,#f1f1f1 100%);
	background: linear-gradient(top,  #fff 5%,#f1f1f1 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fff', endColorstr='#f1f1f1',GradientType=0 );
	
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
	border-radius: 100px;
	
	-webkit-box-shadow: 0 8px 5px rgba(0, 0, 0, 0.1);
	-moz-box-shadow: 0 8px 5px rgba(0, 0, 0, 0.1);
	box-shadow: 0 8px 5px rgba(0, 0, 0, 0.1);

	height: 120px;
	position: relative;
	width: 350px;
}

.cloud:after, .cloud:before {
    background: #fff;
	content: '';
	position: absolute;
	z-indeX: -1;
}

.cloud:after {
	-webkit-border-radius: 100px;
	-moz-border-radius: 100px;
	border-radius: 100px;

	height: 100px;
	left: 50px;
	top: -50px;
	width: 100px;
}

.cloud:before {
	-webkit-border-radius: 200px;
	-moz-border-radius: 200px;
	border-radius: 200px;

	width: 180px;
	height: 180px;
	right: 50px;
	top: -90px;
}
</style>
<body >
<div id="background-wrap">
    <div class="x1">
        <div class="cloud"></div>
    </div>

    <div class="x2">
        <div class="cloud"></div>
    </div>

    <div class="x3">
        <div class="cloud"></div>
    </div>

    <div class="x4">
        <div class="cloud"></div>
    </div>

    <div class="x5">
        <div class="cloud"></div>
    </div>
</div>
