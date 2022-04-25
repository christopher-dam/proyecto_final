<?php
session_start();
include("conexion_BD.php");


//Conectamos con la BD
$link = conectar();
$pass = $_POST["password"];
$_SESSION["error"] = "";

echo $_POST["equipos"];

$queryEquipo = "SELECT * FROM equipo WHERE nombre= '" .($_POST["equipos"]) . "';";
$resultEquipo = mysqli_query($link, $queryEquipo);
$nombreEquipo = mysqli_fetch_array($resultEquipo);
// //Transformamos la fecha

// $fechaActual = date('Y-m-d');

// //Transformamos el tipo de practica

// $tipo="";

// if($_POST["tipo_practica"] == "dual") {
//     $tipo = "Dual";
// } else if ($_POST["tipo_practica"] == "fct") {
//     $tipo = "FCT";
// } else {
//     $tipo = $_POST["tipo_practica"];
// }

//Insertamos dentro de la tabla actividades

$query = "INSERT INTO jugador
            (nombre,apellidos,dni,telefono,email,observaciones,password,id_equipo)
            VALUES (
                    '" . utf8_decode($_POST["nombre"]) . "',
                    '". utf8_decode($_POST["apellidos"]) . "',
                    '" . utf8_decode($_POST["dni"]) . "',
                    " . utf8_decode($_POST["telefono"]) . ",
                    '" . utf8_decode($_POST["email"]) . "',
                    '" . utf8_decode($_POST["observaciones"]) . "',
                    '" . utf8_decode(md5($pass)) . "',
                    " . utf8_decode($nombreEquipo["id"]) . ");";

//Ejecutar consulta

if (mysqli_query($link, $query))
    $_SESSION["exito"] .= "<br> Jugador registrado correctamente";
else
    $_SESSION["error"] .= "<br> No se ha podido registrar el jugador";

mysqli_close($link);

 header("location:jugador.php");
