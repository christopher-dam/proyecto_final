<?php
session_start();
include("db_connect.php");


//Conectamos con la BD
$link = conectar();
$pass = $_POST["password"];
$_SESSION["error"] = "";

$query = "INSERT INTO ejercicio
            (nombre,descripcion,foto)
            VALUES (
                    '" . $_POST["nombre"] . "',
                    '". $_POST["descripcion"] . "',
                    '" .basename($_FILES["fotosubida"]["name"]) . "');";
//Ejecutar consulta

if (mysqli_query($link, $query))

    $_SESSION["exito"] .= "<br> Ejercicio registrado correctamente";
else
    $_SESSION["error"] .= "<br> No se ha podido registrar el ejercicio";

mysqli_close($link);

  header("location:ejercicio.php");
