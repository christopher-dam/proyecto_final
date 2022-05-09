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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link type="text/css" href="css/sydebar.css" rel="stylesheet" />
    <link type="text/css" href="css/estilo.css" rel="stylesheet" />

    <!-- Bootstrap de CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>

<body style="margin-top: 200px;">

     <!-- Sydebar para navegar por la aplicación -->

  <div class="sidebar">
    <div class="logo-details">
      <div class="logo_name">JustVoley</div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
    <li>
        <a href="inicioEntrenador.php">
          <i class='bx bx-user'></i>
          <span class="links_name">Inicio</span>
        </a>
        <span class="tooltip">Inicio</span>
      </li>
      <li>
       <a href="administrarJugadores.php">
         <i class='bx bx-group' ></i>
         <span class="links_name">Jugadores</span>
       </a>
       <span class="tooltip">Jugadores</span>
     </li>
      <li>
        <a href="calendarioEntrenador.php">
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

    <?php
    //Conectamos con la BD
    $link = conectar();
    $queryEntrenador = "SELECT * FROM entrenador WHERE id=" . $_SESSION['id_entrenador'] . ";";

    //Ejecutar consulta
    $result = mysqli_query($link, $queryEntrenador);
    $fila = mysqli_fetch_array($result)
    ?>

     <!-- Formulario con propiedades flotantes -->

    <div id="content" style="padding:10px 20px;">
        <div class="container mt-3">
            <h2>Datos de la cuenta</h2>
            <form id="formEditar" name="formEditar" method="post" action="editarPerfilEntrenador.php" onsubmit="return validarperfil()" enctype="multipart/form-data">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="Cambia tu email" name="email" id="email" value="<?php echo utf8_encode($fila["email"]); ?>" />
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="password" class="form-control" name="password" placeholder="Introduce la nueva contraseña" id="password" />
                    <label for="password">Contraseña</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" name="passwordConfirm" id="passwordConfirm" placeholder="Confirme la nueva contraseña" />
                    <label for="password">Confirmar contraseña</label>
                </div>

                <button style="margin-bottom:20px;" type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <script src="js/sydebar.js"></script>
    <script type="text/javascript" src="js/validaciones.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    </div>
    
</body>
</html>