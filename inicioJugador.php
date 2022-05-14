<?php
session_start();
include("db_connect.php");

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>JustApp</title>

  <!-- hoja de estilos -->
  <link type="text/css" href="css/estilo.css" rel="stylesheet" />
  <link type="text/css" href="css/sydebar.css" rel="stylesheet" />

  <!-- Bootstrap de CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

  <style>
    .mb-0 {
      font-size: 18px;
      font-weight: bold;
    }
  </style>
</head>

<body>

  <!-- Sydebar para navegar por la aplicación -->

  <div class="sidebar">
    <div class="logo-details">
      <div class="logo_name">JustVoley</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
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
        <a href="ejercicioJugador.php">
          <i class='bx bx-basketball'></i>
          <span class="links_name">Ejercicios</span>
        </a>
        <span class="tooltip">Ejercicios</span>
      </li>
      <li>
        <a href="archivos/manual_jugador.pdf" download="manual_jugador.pdf">
          <i class='bx bx-book'></i>
          <span class="links_name">Manual</span>
        </a>
        <span class="tooltip">Manual</span>
      </li>
      <li>
        <a href="salir.php">
          <i class='bx bx-log-out' id="log_out"></i>
          <span class="links_name">Cerrar sesión</span>
        </a>
        <span class="tooltip">Cerrar sesión</span>
    </ul>
  </div>

  <!-- Contenedor donde se muestran los datos -->

  <div class="container w-75 mt-5 ">
    <div class="row" style="margin-top: 100px; margin-bottom: 100px;">
      <?php

      //Conectamos con la BD
      $link = conectar();
      $queryJugador = "SELECT * FROM jugador WHERE id=" . $_SESSION['id_jugador'] . ";";

      //Ejecutar consulta
      $result = mysqli_query($link, $queryJugador);
      if ($fila = mysqli_fetch_array($result)) {

        //Sacamos los datos del equipo
        $queryEquipo = "SELECT * FROM equipo WHERE id=" . $fila['id_equipo'] . ";";
        $resultEquipo = mysqli_query($link, $queryEquipo);
        $nombreEquipo = mysqli_fetch_array($resultEquipo);

        echo '<div class="container">
                <div class="main-body">
                      <div class="row gutters-sm">
                        <div class="col-md-4 mb-3">
                          <div class="card">
                            <div class="card-body">
                              <div class="d-flex flex-column align-items-center text-center">
                                <img src=img/' . utf8_encode($fila['foto']) . ' class="rounded-circle" width="150">
                                <div class="mt-3">
                                  <h4 id="nick"><p> ' . $fila['nick'] . '</p></h4>
                                  <p class="text-secondary mb-1">Just Voley</p>
                                  <p class="text-muted font-size-sm">More than just a game</p>
                                  <a href="editarPerfilJugadorFormulario.php">
                                  <button class="btn btn-primary">Editar</button>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="card mb-3">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Nombre completo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <p style="color:black;">' . $fila['nombre'] . ' ' . $fila['apellidos'] . ' </p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">DNI</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <p style="color:black;">' . $fila['dni'] . ' </p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <p style="color:black;"> ' . $fila['email'] . '</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Teléfono</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <p style="color:black;"> ' . $fila['telefono'] . '</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Equipo</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <p style="color:black;"> ' . $nombreEquipo['nombre'] . '</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>';
      }

      ?>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

  <script src="js/sydebar.js"></script>
</body>

</html>