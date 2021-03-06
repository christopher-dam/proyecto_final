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

    <!--hoja de estilos -->
    <link type="text/css" href="css/estilo.css" rel="stylesheet" />
    <link type="text/css" href="css/sydebar.css" rel="stylesheet" />

    <!--estilos de sweetalert2 -->
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
                <a href="entrenador.php">
                    <i class='bx bx-group'></i>
                    <span class="links_name">Entrenadores</span>
                </a>
                <span class="tooltip">Entrenadores</span>
            </li>
            <li>
                <a href="jugador.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Jugadores</span>
                </a>
                <span class="tooltip">Jugadores</span>
            </li>
            <li>
                <a href="calendarioAdmin.php">
                    <i class='bx bx-calendar'></i>
                    <span class="links_name">Calendario</span>
                </a>
                <span class="tooltip">Calendario</span>
            </li>
            <li>
                <a href="equipo.php">
                    <i class='bx bx-shield'></i>
                    <span class="links_name">Equipos</span>
                </a>
                <span class="tooltip">Equipos</span>
            </li>
            <li>
                <a href="ejercicio.php">
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

    <!-- Formulario con propiedades flotantes -->

    <div class="container">
        <div style="justify-content: center; align-items:center; min-height:100vh; display:flex;">
            <form id="formInsertar" style="padding:10px 20px; width: 50%; background-color: rgb(0,0,0,0.5) !important; border-radius: 25px;" name="formInsertar" method="post" action="insertarEjercicio.php" onsubmit="return validarEjercicio();" enctype="multipart/form-data">
                <h2 style="color:#efef26;">Datos del equipo</h2>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del ejercicio" name="nombre">
                    <label for="nombre">Nombre del ejercicio</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <textarea class="form-control" id="descripcion" placeholder="Ingrese la descripcion del ejercicio" style="height:100px;" name="descripcion"></textarea>
                    <label for="descripcion">Descripción del ejercicio</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="number" class="form-control" id="tiempo" placeholder="Ingrese el nombre del ejercicio" name="tiempo">
                    <label for="nombre">Tiempo del ejercicio (en minutos)</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="participantes" placeholder="Ingrese el nombre del ejercicio" name="participantes">
                    <label for="nombre">Cantidad de participantes (1, 2, ..., Equipo)</label>
                </div>
                <div>
                    <label style="font-size:18px; color:#efef26">Elige fotografía</label>
                    <input type="file" name="fotosubida" id="fotosubida" />
                </div>
                <button style="margin-bottom:20px;" type="submit" class="btn btn-primary">Guardar</button>
                <button onclick="history.go(-1);" style="margin-bottom:20px;" type="volver" class="btn btn-danger float-right">Cancelar</button>
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