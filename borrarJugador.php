<?php
session_start();
include("db_connect.php");

//Conectamos con la BD
$link = conectar();

$query = "DELETE FROM jugador WHERE id=" . $_GET["id_jugador"];

//Ejecutar consulta
if (mysqli_query($link, $query))
    $_SESSION["exito"] = "Jugador eliminado correctamente";
else
    $_SESSION["error"] = "No se ha podido borrar el jugador";

mysqli_close($link);

header("location:jugador.php");
