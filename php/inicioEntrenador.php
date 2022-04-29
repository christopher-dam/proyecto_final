<?php
session_start();
include("conexion_BD.php");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Aplicación Gestión Dual</title>
    <link type="text/css" href="../include/estilo.css" rel="stylesheet" />
    <link type="text/css" href="../include/sydebar.css" rel="stylesheet" />

    <!-- Bootstrap de CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     <!-- Boxicons CDN Link -->
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <!-- Sydebar para navegar por la aplicación -->

    <div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">JustVoley</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
     <li>
       <a href="calendario.php">
         <i class='bx bx-calendar' ></i>
         <span class="links_name">Eventos</span>
       </a>
       <span class="tooltip">Eventos</span>
     </li>
     <li>
       <a href="administrarJugadores.php">
         <i class='bx bx-group' ></i>
         <span class="links_name">Jugadores</span>
       </a>
       <span class="tooltip">Jugadores</span>
     </li>
     <li>
     <a href="../archivos/manual_entrenador.pdf" download="manual_entrenador.pdf">
         <i class='bx bx-book'></i>
         <span class="links_name">Manual</span>
       </a>
       <span class="tooltip">Manual</span>
     </li>
     <li>
       <a href="salir.php">
         <i class='bx bx-log-out' id="log_out" ></i>
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
            $queryEntrenador = "SELECT * FROM entrenador WHERE id=" . $_SESSION['id_entrenador'] . ";";



            //Ejecutar consulta
            $result = mysqli_query($link, $queryEntrenador);
            if ($fila = mysqli_fetch_array($result)) {

                // //Sacamos los datos del equipo
                // $queryEquipo = "SELECT * FROM equipo WHERE id=" . $fila['id_equipo'] . ";";
                // $resultEquipo = mysqli_query($link, $queryEquipo);
                // $nombreEquipo = mysqli_fetch_array($resultEquipo);

                // //Sacamos los datos del tutor
                // $queryTutor = "SELECT * FROM profesor WHERE id=" . $fila['profesor_id'] . ";";
                // $resultTutor = mysqli_query($link, $queryTutor);
                // $nombreTutor = mysqli_fetch_array($resultTutor);

                echo '<div id="content">
                <div class="container rounded bg-white mt-5 mb-5">
                <div class="row">
                    <div class="col-md-3 border-right">
                    <a href="editarPerfilEntrenadorFormulario.php">
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Editar Perfil</button></div>
                    </a>
                        <div class="d-flex flex-column align-items-center text-center p-3"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"></span></div>
                    </div>
                    <div class="col-md-9 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3"><img width="300px" src="../imagenes/cesur.png"></div>
                        <div class="p-3 py-5" style="margin-top: 0px">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Perfil</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4"><label class="labels"><b>Nombre</b></label><p>'. $fila['nombre'] .' </p></div>
                                <div class="col-md-4"><label class="labels"><b>Apellidos</b></label><p> ' . $fila['apellidos'] . '</p></div>
                                <div class="col-md-4"><label class="labels"><b>Email</b></label><p> ' . $fila['email'] . '</p></div>
                            </div>
                            <div class="row mt-3" style="margin-top: 20px">
                                <div class="col-md-4"><label class="labels"><b>Teléfono</b></label><p> ' . $fila['telefono'] . '</p></div>
                                <div class="col-md-4"><label class="labels"><b>DNI</b></label><p>' . $fila['dni'] . ' </p></div>
                            </div>
                            <div class="row mt-3" style="margin-top: 20px">
                                <div class="col-md-4"><label class="labels"><b>Titulacion de nivel</b></label><p> ' . $fila['titulacion'] . '</p></div>
                            </div>
                           
                        </div>

                    </div>
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
    <script src="../scripts/sydebar.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</body>

</html>