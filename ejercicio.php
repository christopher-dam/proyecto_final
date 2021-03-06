<?php
session_start();
include("db_connect.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html" charset="UTF-8">
    <title>JustApp</title>

    <!--hoja de estilos -->
    <link type="text/css" href="css/estilo.css" rel="stylesheet" />
    <link type="text/css" href="css/sydebar.css" rel="stylesheet" />

    <!--estilo de datatables -->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.11.4/css/dataTables.bootstrap5.min.css" />

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

    <div class="container">

        <h2 style="margin-top: 30px;"><b>Ejercicios</b></h2>
        <div class="card-deck">

            <?php
            //Conectamos con la BD
            $link = conectar();
            $query = "SELECT * FROM ejercicio;";

            //Ejecutar consulta
            $result = mysqli_query($link, $query);

            while ($fila = mysqli_fetch_array($result)) {
                echo '
                        <div class="card">
                            <img class="card-img-top" src=img/' . utf8_encode($fila['foto']) . '>
                            <div class="card-body">
                                <h5 class="card-title">' . $fila['nombre'] . '</h5>
                                <p class="card-text">' . $fila['descripcion'] . '</p>
                                <a style="cursor: pointer;" onclick="return confirmarEjercicio(' . $fila["id"] . ')">
                                <img src="img/delete.png" width="20"></a>
                                </div>
                                </div>';
            }
            mysqli_close($link);
            ?>
        </div>
        <div id="centrado">
            <form id="form1" name="form1" method="post" action="insertarEjercicioFormulario.php">
                <input type="submit" class="btn btn-primary" style="font-weight:bold; color:white; margin-bottom:20px; margin-top:30px;" name="enviar" id="enviar" value="Añadir ejercicio" />
            </form>
        </div>

        <?php
        if (isset($_SESSION["exito"])) {
            echo '<script language="javascript">
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                          })
                          
                          Toast.fire({
                            icon: "success",
                            title: "' . $_SESSION["exito"] . '"
                          })
                        </script>';
            unset($_SESSION["exito"]);
        }
        if (isset($_SESSION["error"])) {
            echo '<script language="javascript">
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                          })
                          
                          Toast.fire({
                            icon: "error",
                            title: "' . $_SESSION["error"] . '"
                          })
                        </script>';
            unset($_SESSION["error"]);
        }
        ?>
    </div>
    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="../jquery/jquery-3.3.1.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../scripts/main.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <script src="js/sydebar.js"></script>
    <script type="text/javascript" src="js/validaciones.js"></script>

</body>

</html>