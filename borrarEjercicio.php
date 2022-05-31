<?php
session_start();
include("db_connect.php");

//Conectamos con la BD
$link = conectar();

$query = "DELETE FROM ejercicio WHERE id=" . $_GET["id"];
$otraQuery = "SELECT * FROM ejercicio where id=" . $_GET["id"];

$result = mysqli_query($link, $otraQuery);

while ($fila = mysqli_fetch_array($result)) {
    $file = "img/".$fila['foto'];
}

//Ejecutar consulta
if (mysqli_query($link, $query)){
    $_SESSION["exito"] = "Ejercicio eliminado correctamente";
    if (isset($file)){
     unlink($file);   
    }
}else
    $_SESSION["error"] = "No se ha podido borrar el ejercicio";

mysqli_close($link);

header("location:ejercicio.php");
