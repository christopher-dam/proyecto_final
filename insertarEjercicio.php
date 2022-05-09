<?php
session_start();
include("conexion_BD.php");


//Conectamos con la BD
$link = conectar();
$pass = $_POST["password"];
$_SESSION["error"] = "";


// $queryEquipo = "SELECT * FROM equipo WHERE nombre= '" . strval($_POST["equipos"]) . "';";
// $resultEquipo = mysqli_query($link, $queryEquipo);
// $nombreEquipo = mysqli_fetch_array($resultEquipo);

//Insertamos dentro de la tabla actividades

$query = "INSERT INTO ejercicio
            (nombre,descripcion,foto)
            VALUES (
                    '" . utf8_decode($_POST["nombre"]) . "',
                    '". utf8_decode($_POST["descripcion"]) . "',
                    '" .basename($_FILES["fotosubida"]["name"]) . "');";
//Ejecutar consulta

if (mysqli_query($link, $query))

    $_SESSION["exito"] .= "<br> Ejercicio registrado correctamente";
else
    $_SESSION["error"] .= "<br> No se ha podido registrar el ejercicio";

mysqli_close($link);

  header("location:ejercicio.php");
