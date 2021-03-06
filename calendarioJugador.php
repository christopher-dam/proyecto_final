<?php
session_start();
include("db_connect.php");

?>
<!-- Sydebar para navegar por la aplicación -->

<!DOCTYPE html>
<html>

<head>
  <title>JustApp</title>
  <link rel="stylesheet" href="css/calendarJugador.css">

  <!-- hoja de estilos -->
  <link type="text/css" href="css/estilo.css" rel="stylesheet" />
  <link type="text/css" href="css/sydebar.css" rel="stylesheet" />

  <!-- Bootstrap de CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <style>
    input:read-only:hover {
      background-color: grey;
    }

    textarea:read-only:hover {
      background-color: grey;
    }
  </style>

</head>

<body>

  <div class="sidebar">
    <div class="logo-details">
      <div class="logo_name">JustVoley</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list" style="padding-left:32px">
      <li>
        <a href="inicioJugador.php">
          <i class='bx bx-home'></i>
          <span class="links_name">Inicio</span>
        </a>
        <span class="tooltip">Inicio</span>
      </li>
      <li>
        <a href="calendarioJugador.php">
          <i class='bx bx-calendar'></i>
          <span class="links_name">Calendario</span>
        </a>
        <span class="tooltip">Calendario</span>
      </li>
      <li>
        <a href="salir.php">
          <i class='bx bx-log-out' id="log_out"></i>
          <span class="links_name">Cerrar sesión</span>
        </a>
        <span class="tooltip">Cerrar sesión</span>
    </ul>
  </div>




  <!-- (A) PERIOD SELECTOR -->
  <div id="calPeriod"><?php
                      // (A1) MONTH SELECTOR
                      // NOTE: DEFAULT TO CURRENT SERVER MONTH YEAR
                      $months = [
                        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril",
                        5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto",
                        9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
                      ];
                      $monthNow = date("m");
                      echo "<select id='calmonth'>";
                      foreach ($months as $m => $mth) {
                        printf(
                          "<option value='%s'%s>%s</option>",
                          $m,
                          $m == $monthNow ? " selected" : "",
                          $mth
                        );
                      }
                      echo "</select>";

                      // (A2) YEAR SELECTOR
                      echo "<input type='number' id='calyear' value='" . date("Y") . "'/>";
                      ?></div>

  <!-- (B) CALENDAR WRAPPER -->
  <div id="calwrap"></div>

  <!-- (C) EVENT FORM -->
  <div id="calblock">
    <div class="container mt-3">
      <form id="calform" style="padding:10px 20px; background-color: rgb(175,167,167,0.8) !important;">
        <input type="hidden" name="req" value="save" />
        <input type="hidden" id="evtid" name="eid" />
        <div class="row">
          <div class="col">
            <label for="start"><b>Fecha de inicio</b></label>
            <input type="datetime-local" class="form-control" id="evtstart" name="start" readonly />
          </div>
          <div class="col">
            <label for="start"><b>Fecha finalización</b></label>
            <input type="datetime-local" class="form-control" id="evtend" name="end" readonly />
          </div>
        </div>
        <div>
          <label for="txt"><b>Nombre</b></label>
          <input type="text" id="evttxt" class="form-control" name="txt" readonly></input>
        </div>
        <div>
          <label for="detalles"><b>Detalles</b></label>
          <textarea id="detalles" class="form-control" name="detalles" readonly></textarea>
        </div>
        <div style="margin-top: 10px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3198.086719410939!2d-4.445595084357511!3d36.72047847988219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72f774b1af9277%3A0x8e1077312e73a165!2sColegio%20Concertado%20San%20Jos%C3%A9!5e0!3m2!1ses!2ses!4v1652616421588!5m2!1ses!2ses" width="100%" height="auto" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <input type="button" id="calformcx" value="Cancelar" />
      </form>
    </div>
  </div>

  <script src="calendarJugador.js"></script>
  <script src="js/sydebar.js"></script>

</body>

</html>