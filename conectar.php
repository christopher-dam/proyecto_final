<?php
session_start();
include("db_connect.php");

//Llamar a la función de copnexión con la BD
$link = conectar();

// Traer datos de usuario y clave del formulario

$pass = $hash = hash("sha512",$_POST["pass"]);
$email = $_POST["email"];

//Creamos la consulta SQL
$queryAlumno = "SELECT * FROM jugador WHERE email='" . $email .
    "' AND password='" . $pass . "'";
$resultAlumno = mysqli_query($link, $queryAlumno);

$queryEntrenador = "SELECT * FROM entrenador WHERE email='" . $email .
    "' AND password='" . $pass . "'";
$resultEntrenador = mysqli_query($link, $queryEntrenador);

$queryAdmin = "SELECT * FROM administracion WHERE email='" . $email .
    "' AND password='" . $pass . "'";
$resultAdmin = mysqli_query($link, $queryAdmin);

// Si se puede extraer una fila es que el usuario existe y la password es correcta 

if ($fila = mysqli_fetch_array($resultAlumno)) {
    $_SESSION["id_jugador"] = $fila["id"];
    $_SESSION["id_equipo"] = $fila["id_equipo"];
    $_SESSION["id_jugador_entrenador"] = $fila["id_entrenador"];
    header("Location:inicioJugador.php");

} elseif ($fila = mysqli_fetch_array($resultEntrenador)) {
    $_SESSION["id_entrenador"] = $fila["id"];
    header("Location:inicioEntrenador.php");

} elseif ($fila = mysqli_fetch_array($resultAdmin)) {
    $_SESSION["id_admin"] = $fila["id"];
    header("Location:entrenador.php");
    
} else {
    $_SESSION["error"] = "Email o contraseña erróneos";
    header("Location:index.php");
}

// // Cierre de la conexión a la BD
// mysqli_close($link);
