<?php
session_start();
include("db_connect.php");


//Conectamos con la BD
$link = conectar();
$_SESSION["error"] = "";

$queryEntrenador = "SELECT * FROM entrenador WHERE nombre= '" .($_POST["entrenador"]) . "';";
$resultEntrenador = mysqli_query($link, $queryEntrenador);
$nombreEntrenador = mysqli_fetch_array($resultEntrenador);

$query = "INSERT INTO equipo
            (nombre,instagram,email,id_entrenador,sede)
            VALUES (
                    '" . utf8_decode($_POST["nombre"]) . "',
                    '". utf8_decode($_POST["instagram"]) . "',
                    '" . utf8_decode($_POST["email"]) . "',
                    '" . utf8_decode($nombreEntrenador["id"]) . "',
                    '" . utf8_decode($_POST["sede"]) . "');";

// Ejecutar consulta

if (mysqli_query($link, $query))

    $_SESSION["exito"] .= "<br> Equipo registrado correctamente";
else
    $_SESSION["error"] .= "<br> No se ha podido registrar el equipo";

mysqli_close($link);

  header("location:equipo.php");
