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

$query = "INSERT INTO jugador
            (nombre,apellidos,dni,telefono,email,`password`,id_equipo)
            VALUES (
                    '" . $_POST["nombre"] . "',
                    '". $_POST["apellidos"] . "',
                    '" . $_POST["dni"] . "',
                    " . $_POST["telefono"] . ",
                    '" . $_POST["email"] . "',
                    '" . $hash = hash("sha512", $pass) . "',
                    " . $nombreEquipo["id"] . ");";

//Ejecutar consulta

if (mysqli_query($link, $query))
    $_SESSION["exito"] .= "<br> Jugador registrado correctamente";
else
    $_SESSION["error"] .= "<br> No se ha podido registrar el jugador";

mysqli_close($link);

 header("location:jugador.php");
