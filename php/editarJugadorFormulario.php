<?php
session_start();
include("conexion_BD.php");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Gestión Dual</title>

    <!-- hoja de estilos -->
    <link type="text/css" href="../include/estilo.css" rel="stylesheet" />
    <link type="text/css" href="../include/sydebar.css" rel="stylesheet" />

    <!-- script de validaciones -->
    <script type="text/javascript" src="../scripts/validaciones.js"></script>

    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <!-- Bootstrap de CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <a href="inicioAdmin.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Inicio</span>
                </a>
                <span class="tooltip">Inicio</span>
            </li>
            <li>
                <a href="entrenador.php">
                    <i class='bx bx-calendar'></i>
                    <span class="links_name">Entrenadores</span>
                </a>
                <span class="tooltip">Entrenadores</span>
            </li>
            <li>
                <a href="jugador.php">
                    <i class='bx bx-book'></i>
                    <span class="links_name">Jugadores</span>
                </a>
                <span class="tooltip">Jugadores</span>
            </li>
            <li>
                <a href="ejercicio.php">
                    <i class='bx bx-book'></i>
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

    <div id="content" style="padding:10px 20px;">
        <div class="container mt-3">
            <h2>Datos del Jugador</h2>
            <form id="formEditar" name="formEditar" method="post" action="editarJugador.php" onsubmit="return validarRegistro()" enctype="multipart/form-data">
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="a" name="nombre" id="nombre" value="<?php echo utf8_encode($fila["nombre"]); ?>" />
                    <label for="nombre">Nombre</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" placeholder="a" name="apellidos" id="apellidos" value="<?php echo utf8_encode($fila["apellidos"]); ?>" />
                    <label for="apellidos">Apellidos</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" name="dni" id="dni" placeholder="a" value="<?php echo utf8_encode($fila["dni"]); ?>" />
                    <label for="dni">DNI</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input class="form-control" id="telefono" name="telefono" placeholder="a" value="<?php echo utf8_encode($fila["telefono"]); ?>" />
                    <label for="telefono">Telefono</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input class="form-control" id="email" name="email" placeholder="a" value="<?php echo utf8_encode($fila["email"]); ?>" />
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input class="form-control" id="observaciones" name="observaciones" placeholder="a" value="<?php echo utf8_encode($fila["observaciones"]); ?>" />
                    <label for="observaciones">Observaciones</label>
                </div>
        </div>
        <input type="hidden" name="id" id="id" value="<?php echo utf8_encode($fila["id"]); ?>">
        <button style="margin-bottom:20px;" type="submit" class="btn btn-primary">Editar</button>
    </div>
    </div>

    <script src="../scripts/sydebar.js"></script>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    </div>
</body>

</html>