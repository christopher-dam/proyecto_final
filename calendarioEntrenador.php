<?php
session_start();
include("db_connect.php");

            //Conectamos con la BD
            $link = conectar();
            $query = "SELECT * FROM equipo where id_entrenador = {$_SESSION['id_entrenador']};";
            $equipos = [];

            //Ejecutar consulta
            $result = mysqli_query($link, $query);

            while ($fila = mysqli_fetch_array($result)) {
              $equipos[$fila['id']] = $fila['nombre'];
            }
            mysqli_close($link);
            
?>
<!-- Sydebar para navegar por la aplicación -->

<!DOCTYPE html>
<html>

<head>
  <title>Calendar Demo</title>
  <link rel="stylesheet" href="css/calendar.css">

  <!-- hoja de estilos -->
  <link type="text/css" href="css/estilo.css" rel="stylesheet" />
  <link type="text/css" href="css/sydebar.css" rel="stylesheet" />
  
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

<div class="sidebar">
    <div class="logo-details">
      <div class="logo_name">JustVoley</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list" style="padding-left:25px">
      <li>
        <a href="inicioEntrenador.php">
          <i class='bx bx-home'></i>
          <span class="links_name">Inicio</span>
        </a>
        <span class="tooltip">Inicio</span>
      </li>
      <li>
        <a href="administrarJugadores.php">
          <i class='bx bx-group'></i>
          <span class="links_name">Jugadores</span>
        </a>
        <span class="tooltip">Jugadores</span>
      </li>
      <li>
        <a href="calendarioEntrenador.php">
          <i class='bx bx-calendar'></i>
          <span class="links_name">Eventos</span>
        </a>
        <span class="tooltip">Eventos</span>
      </li>
      <li>
        <a href="convocatoria.php">
          <i class='bx bx-list-check'></i>
          <span class="links_name">Convocatorias</span>
        </a>
        <span class="tooltip">Convocatorias</span>
      </li>
      <li>
        <a href="ejercicioEntrenador.php">
          <i class='bx bx-basketball'></i>
          <span class="links_name">Ejercicios</span>
        </a>
        <span class="tooltip">Ejercicios</span>
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
    <form id="calform">
      <input type="hidden" name="req" value="save" />
      <input type="hidden" id="evtid" name="eid" />
      <label for="start">Fecha inicio</label>
      <input type="datetime-local" id="evtstart" name="start" required />
      <label for="end">Fecha fin</label>
      <input type="datetime-local" id="evtend" name="end" required />
      <label for="equipo">Equipo</label>
      <select id="equipo" name="id_equipo">
        <?php
          foreach ($equipos as $id_equipo => $nombre_equipo) {
            printf(
              "<option value='%s'>%s</option>",
              $id_equipo,
              $nombre_equipo
            );
          }
        ?>
      </select>
      <label for="txt">Nombre</label>
      <textarea id="evttxt" name="txt" required></textarea>
      <label for="detalles">Detalles</label>
      <textarea id="detalles" name="detalles" ></textarea>
      <label for="color">Color</label>
      <input type="color" id="evtcolor" name="color" value="#e4edff" required />
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3198.086719410939!2d-4.445595084357511!3d36.72047847988219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd72f774b1af9277%3A0x8e1077312e73a165!2sColegio%20Concertado%20San%20Jos%C3%A9!5e0!3m2!1ses!2ses!4v1652616421588!5m2!1ses!2ses" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      <input type="submit" id="calformsave" value="Save" />
      <input type="button" id="calformdel" value="Delete" />
      <input type="button" id="calformcx" value="Cancel" />
    </form>
  </div>

  <script src="calendarEntrenador.js"></script>
  <script src="js/sydebar.js"></script>

</body>

</html>