<?php
session_start();
include("conexion_BD.php");


//Conectamos con la BD
$link = conectar();
$pass = $_POST["password"];
$_SESSION["error"] = "";

$queryEquipo = "SELECT * FROM equipo WHERE nombre= '" .($_POST["equipos"]) . "';";
$resultEquipo = mysqli_query($link, $queryEquipo);
$nombreEquipo = mysqli_fetch_array($resultEquipo);

//Insertamos dentro de la tabla actividades

$query = "INSERT INTO entrenador
            (nombre,apellidos,dni,telefono,email,titulacion,password, id_equipo)
            VALUES (
                    '" . utf8_decode($_POST["nombre"]) . "',
                    '". utf8_decode($_POST["apellidos"]) . "',
                    '" . utf8_decode($_POST["dni"]) . "',
                    " . utf8_decode($_POST["telefono"]) . ",
                    '" . utf8_decode($_POST["email"]) . "',
                    " . utf8_decode($_POST["titulacion"]) . ",
                    '" .$hash = hash("sha512", $pass) . "',
                    " . utf8_decode($nombreEquipo["id"]) . ");";

echo $query;

//Ejecutar consulta

if (mysqli_query($link, $query))

    $_SESSION["exito"] .= "<br> Entrenador registrado correctamente";
else
    $_SESSION["error"] .= "<br> No se ha podido registrar el entrenador";

mysqli_close($link);

  header("location:entrenador.php");
