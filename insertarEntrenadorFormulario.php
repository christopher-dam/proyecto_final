<?php
session_start();
include("db_connect.php");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Gestión Dual</title>

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

    <?php
    //Conectamos con la BD
    $link = conectar();
    $queryEquipo = "SELECT * FROM equipo;";

    //Ejecutar consulta
    $resultEquipo = mysqli_query($link, $queryEquipo);
    ?>

    <!-- Formulario con propiedades flotantes -->

    <div class="container">
        <div style="justify-content: center; align-items:center; min-height:100vh; display:flex;">
            <form id="formInsertar" style="padding:10px 20px; background-color: rgb(0,0,0,0.5) !important; border-radius: 25px;" name="formInsertar" method="post" action="insertarEntrenador.php" onsubmit="return validarRegistro();" enctype="multipart/form-data">
                <h2 style="color:#efef26;">Datos del entrenador</h2>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mb-3 mt-3">
                            <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del entrenador" name="nombre">
                            <label for="nombre">Nombre del entrenador</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="apellidos" placeholder="Introduce los apellidos del entrenador" name="apellidos">
                            <label for="apellidos">Apellidos del entrenador</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-floating mt-3 mb-3">
                            <input type="text" class="form-control" id="dni" placeholder="Ingrese el dni del entrenador" name="dni">
                            <label for="dni">DNI del entrenador</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mt-3 mb-3">
                            <input type="tel" class="form-control" id="telefono" placeholder="Ingrese el teléfono del entrenador" name="telefono">
                            <label for="telefono">Teléfono del entrenador</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="email" placeholder="Ingrese el email del entrenador" name="email">
                    <label for="email">Email del entrenador</label>
                </div>
                <div class="row">
                    <div class="col">
                        <div>
                            <label style="font-size:18px; color:#efef26" class="my-1 mr-2" for="titulacion">Nivel de titulación del entrenador</label>
                            <select class="custom-select" name="titulacion" id="titulacion">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            <label style="font-size:18px; color:#efef26" class="my-1 mr-2" for="equipos">Equipo al que va inscrito</label>
                            <select class="custom-select" name="equipos" id="equipos">
                                <?php
                                while ($nombreEquipo = mysqli_fetch_array($resultEquipo)) {
                                    echo '
                        <option value="' . utf8_encode($nombreEquipo['nombre']) . '">' . utf8_encode($nombreEquipo['nombre']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="password" placeholder="Ingrese la contraseña del entrenador" name="password">
                    <label for="password">Contraseña del entrenador</label>
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