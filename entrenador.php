<?php
session_start();
include("db_connect.php");

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Aplicación Gestión Dual</title>

    <!--hoja de estilos -->
    <link type="text/css" href="ccs/estilo.css" rel="stylesheet" />
    <link type="text/css" href="css/sydebar.css" rel="stylesheet" />

    <!--estilo de datatables -->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.11.4/css/dataTables.bootstrap5.min.css" />

    <!--estilos de sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <!--estilos de boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <?php
    //Conectamos con la BD
    $link = conectar();
    $query = "SELECT * FROM entrenador;";

    //Ejecutar consulta
    $result = mysqli_query($link, $query);
    ?>

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
                <a href="jugador.php">
                    <i class='bx bx-group'></i>
                    <span class="links_name">Jugadores</span>
                </a>
                <span class="tooltip">Jugadores</span>
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
    
    <!-- Contenedor del datatable -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <h2 style="margin-top: 30px;"><b>Entrenadores</b></h2>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead style="background-color:white">
                            <tr>
                                <th>Editar</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Titulación</th>
                                <th>Equipo</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody style="background-color:white">
                            <?php

                            while ($fila = mysqli_fetch_array($result)) {
                                echo "<tr>
                                <td><a href='editarEntrenadorFormulario.php?id_entrenador=" . $fila["id"] . "'>
                                <img src='img/edit.png' width='20'></a></td>
                                <td>" . utf8_encode($fila['nombre']) . "</td>
                                <td>" . utf8_encode($fila['apellidos']) . "</td>
                                <td>" . utf8_encode($fila['dni']) . "</td>
                                <td>" . utf8_encode($fila['telefono']) . "</td>
                                <td>" . utf8_encode($fila['email']) . "</td>
                                <td>" . utf8_encode($fila['titulacion']) . "</td>
                                <td>";

                                $queryEquipo = "SELECT nombre FROM equipo WHERE id=" . utf8_encode($fila['id_equipo']) . ";";

                                $resultEquipo = mysqli_query($link, $queryEquipo);

                                $nombreEquipo = mysqli_fetch_array($resultEquipo);

                                echo $nombreEquipo['nombre']     .  "</td>
                                <td><a onclick='return confirmarEntrenador(" . $fila['id'] . ")'>
                                <img src='img/delete.png' width='20'></a></td>
                                </tr>";
                            }

                            mysqli_close($link);
                            ?>
                        </tbody>
                    </table>

                    <div id="centrado">
                        <form id="form1" name="form1" method="post" action="insertarEntrenadorFormulario.php">
                            <input type="submit" class="btn btn-primary" style="font-weight:bold; color:white; margin-bottom:20px;" name="enviar" id="enviar" value="Insertar entrenador" />
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
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="jquery/jquery-3.3.1.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- Sydebar JS -->
    <script type="text/javascript" src="js/validaciones.js"></script>
    <script src="js/sydebar.js"></script>

</body>

</html>