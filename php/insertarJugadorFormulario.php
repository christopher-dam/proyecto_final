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

</head>

<body style="margin-top: 200px;">

    <!-- Sydebar para navegar por la aplicación -->

    <a class="btn btn-primary" style="position:fixed; top:0; margin:20px; color:white;" data-bs-toggle="offcanvas" href="#menu" role="button" aria-controls="offcanvasExample">
        Desplegar Menu
    </a>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="menu" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Opciones</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled components">
                <li class="active">
                </li>
                <li>
                    <a href="inicioAdmin.php">Inicio</a>
                </li>
                <li>
                    <a href="entrenador.php">Entrenadores</a>
                </li>
                <li>
                    <a href="jugador.php">Jugadores</a>
                </li>
                <li>
                    <a href="ejercicio.php">Ejercicios</a>
                </li>
                <li>
                    <a href="salir.php">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>

    <?php
        //Conectamos con la BD
        $link = conectar();
        $queryEquipo = "SELECT * FROM equipo;";

        //Ejecutar consulta
        $resultEquipo = mysqli_query($link, $queryEquipo);
        ?>

    <!-- Formulario con propiedades flotantes -->

    <div id="content" style="padding:10px 20px;">
        <div class="container mt-3">
            <h2>Datos del jugador</h2>
            <form id="formInsertar" name="formInsertar" method="post" action="insertarJugador.php" onsubmit="return validarRegistr();" enctype="multipart/form-data">

                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del jugador" name="nombre">
                    <label for="nombre">Nombre del jugador </label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="apellidos" placeholder="Introduce los apellidos del jugador" name="apellidos">
                    <label for="apellidos">Apellidos del jugador</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="dni" placeholder="Ingrese el dni del jugador" name="dni">
                    <label for="dni">DNI del jugador</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="tel" class="form-control" id="telefono" placeholder="Ingrese el número del jugador" name="telefono">
                    <label for="telefono">Teléfono del jugador</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="email" class="form-control" id="email" placeholder="Ingrese el email del jugador" name="email">
                    <label for="email">Email del jugador</label>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <textarea class="form-control" id="observaciones" name="observaciones" placeholder="Ingrese la observación"></textarea>
                    <label for="observaciones">Observaciones</label>
                </div>
                <div>
                    <label class="my-1 mr-2" for="equipos">Equipo al que va inscrito</label>
                    <select class="custom-select" name="equipos" id="equipos">
                        <?php
                        while ($nombreEquipo = mysqli_fetch_array($resultEquipo)) {
                            echo '
                        <option value="' . utf8_encode($nombreEquipo['nombre']) .'">'. utf8_encode($nombreEquipo['nombre']).'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-floating mt-3 mb-3">
                    <input type="text" class="form-control" id="password" placeholder="Ingrese la contraseña del jugador" name="password">
                    <label for="password">Contraseña del jugador</label>
                </div>
                <button style="margin:20px 0px;" type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    </div>
</body>

</html>