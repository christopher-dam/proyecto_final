<?php
session_start();
include("db_connect.php");

?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

	<!--hoja de estilos -->
	<link type="text/css" href="css/estilo.css" rel="stylesheet" />
	<link type="text/css" href="css/sydebar.css" rel="stylesheet" />

	<!-- jQuery -->
	<link rel="stylesheet" href="css/calendar.css">

	<!-- Boxicons CDN Link -->
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="">

	<?php
	//Conectamos con la BD
	$link = conectar();
	?>

	<div class="sidebar">
		<div class="logo-details">
			<div class="logo_name">JustVoley</div>
			<i class='bx bx-menu' id="btn"></i>
		</div>
		<ul class="nav-list">
			<li>
				<a href="inicioJugador.php">
					<i class='bx bx-user'></i>
					<span class="links_name">Inicio</span>
				</a>
				<span class="tooltip">Inicio</span>
			</li>
			<li>
				<a href="salir.php">
					<i class='bx bx-log-out' id="log_out"></i>
					<span class="links_name">Cerrar sesión</span>
				</a>
				<span class="tooltip">Cerrar sesión</span>
		</ul>
	</div>
	<div class="container" style="min-height:500px;">
		<div class=''>
		</div>
		<div class="container">
			<h2>Calendario</h2>
			<div class="page-header">
				<div class="pull-right form-inline">
					<div class="btn-group">
						<button class="btn btn-primary" data-calendar-nav="prev">
							<< Anterior</button>
								<button class="btn btn-default" data-calendar-nav="today">Hoy</button>
								<button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
					</div>
					<div class="btn-group">
						<button class="btn btn-warning" data-calendar-view="year">Año</button>
						<button class="btn btn-warning active" data-calendar-view="month">Mes</button>
						<button class="btn btn-warning" data-calendar-view="week">Semana</button>
						<button class="btn btn-warning" data-calendar-view="day">Día</button>
					</div>
				</div>
				<h3></h3>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div id="showEventCalendar"></div>
				</div>
				<div class="col-md-3">
					<h4>Lista de eventos</h4>
					<ul id="eventlist" class="nav nav-list"></ul>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
		<script type="text/javascript" src="js/calendar.js"></script>
		<script type="text/javascript" src="js/events.js"></script>
		<script src="js/sydebar.js"></script>