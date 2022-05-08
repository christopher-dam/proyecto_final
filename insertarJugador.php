<?php
session_start();
include("db_connect.php");


//Conectamos con la BD
$link = conectar();
$pass = $_POST["password"];
$_SESSION["error"] = "";

$queryEquipo = "SELECT * FROM equipo WHERE nombre= '" .($_POST["equipos"]) . "';";
$resultEquipo = mysqli_query($link, $queryEquipo);
$nombreEquipo = mysqli_fetch_array($resultEquipo);

$queryEntrenador = "SELECT * FROM entrenador WHERE nombre= '" .($_POST["entrenador"]) . "';";
$resultEntrenador = mysqli_query($link, $queryEntrenador);
$nombreEntrenador = mysqli_fetch_array($resultEntrenador);

//Insertamos dentro de la tabla actividades

$query = "INSERT INTO jugador
            (nombre,apellidos,dni,telefono,email,password,id_entrenador,id_equipo)
            VALUES (
                    '" . utf8_decode($_POST["nombre"]) . "',
                    '". utf8_decode($_POST["apellidos"]) . "',
                    '" . utf8_decode($_POST["dni"]) . "',
                    " . utf8_decode($_POST["telefono"]) . ",
                    '" . utf8_decode($_POST["email"]) . "',
                    '" . $hash = hash("sha512", $pass) . "',
                    '" . utf8_decode($nombreEntrenador["id"]) . "',
                    " . utf8_decode($nombreEquipo["id"]) . ");";

//Ejecutar consulta

if (mysqli_query($link, $query))
    $_SESSION["exito"] .= "<br> Jugador registrado correctamente";
else
    $_SESSION["error"] .= "<br> No se ha podido registrar el jugador";

mysqli_close($link);

 header("location:jugador.php");
