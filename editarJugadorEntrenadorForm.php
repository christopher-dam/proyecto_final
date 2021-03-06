<?php
session_start();
include("db_connect.php");

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JustApp</title>

  <!-- hoja de estilos -->
  <link type="text/css" href="css/estilo.css" rel="stylesheet" />
  <link type="text/css" href="css/sydebar.css" rel="stylesheet" />

  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">

  <!-- Bootstrap de CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

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


  <?php
  $id_jugador = htmlspecialchars($_GET["id_jugador"]);
  //Conectamos con la BD
  $link = conectar();

  $query = "SELECT * FROM jugador WHERE id=" . $id_jugador . ";";
  $queryEquipo = "SELECT * FROM equipo;";
  //Ejecutar consulta
  $result = mysqli_query($link, $query);
  $resultEquipo = mysqli_query($link, $queryEquipo);
  //Extraemos datos de la consulta 
  $fila = mysqli_fetch_array($result);

  mysqli_close($link);
  ?>

  <!-- Formulario con propiedades flotantes -->

  <div class="container">
    <div style="justify-content: center; align-items:center; min-height:100vh; display:flex;">
      <form style="padding:10px 20px; width: 50%; background-color: rgb(0,0,0,0.5) !important; border-radius: 25px; width: 50%;" id="formEditar" name="formEditar" method="post" action="editarJugadorEntrenador.php" onsubmit="return validarRegistro()" enctype="multipart/form-data">
        <h2 style="font-size: 40px; color:#ffff00;">Datos del jugador</h2>
        <div class="form-floating mb-3 mt-3">
          <textarea type="text" class="form-control" style="height: 100px;" placeholder="a" name="observaciones" id="observaciones"><?php echo $fila["observaciones"]; ?></textarea>
          <label for="observaciones">Observaciones</label>
        </div>
        <div class="form-floating mb-3 mt-3">
          <textarea type="text" class="form-control" style="height: 100px;" placeholder="a" name="lesiones" id="lesiones"><?php echo $fila["lesiones"]; ?></textarea>
          <label for="lesiones">Lesiones</label>
        </div>
        <input type="hidden" name="id" id="id" value="<?php echo utf8_encode($fila["id"]); ?>">
        <button style="margin-bottom:10px;" type="submit" class="btn btn-primary">Editar</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS, Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


  <script type="text/javascript" src="js/validaciones.js"></script>
  <script src="js/sydebar.js"></script>

  </div>
</body>

</html>