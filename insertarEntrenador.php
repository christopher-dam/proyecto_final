<?php
session_start();
include("db_connect.php");


//Conectamos con la BD
$link = conectar();
$pass = $_POST["password"];
$_SESSION["error"] = "";

//Insertamos dentro de la tabla entrenador

$query = "INSERT INTO entrenador
            (nombre,apellidos,dni,telefono,email,titulacion,`password`)
            VALUES (
                    '" . $_POST["nombre"] . "',
                    '". $_POST["apellidos"] . "',
                    '" . $_POST["dni"] . "',
                    " . $_POST["telefono"] . ",
                    '" . $_POST["email"] . "',
                    " . $_POST["titulacion"] . ",
                    '" .$hash = hash("sha512", $pass) . "');";

echo $query;

//Ejecutar consulta

if (mysqli_query($link, $query))

    $_SESSION["exito"] .= "<br> Entrenador registrado correctamente";
else
    $_SESSION["error"] .= "<br> No se ha podido registrar el entrenador";

mysqli_close($link);

  header("location:entrenador.php");
