<?php
session_start();
include("db_connect.php");

$link = conectar();

$otraQuery = "SELECT * FROM jugador where id=" . $_SESSION["id_jugador"];

$result = mysqli_query($link, $otraQuery);

    //Conectamos con la BD
    $link=conectar();
    $pass = $_POST["password"];
    
    $query="UPDATE jugador 
            SET email='".$_POST["email"]."',
            nick='" .$_POST["nick"] . "',
            password='". $hash = hash("sha512", $pass)."'
            WHERE id=".$_SESSION["id_jugador"] .";";
    
    //Ejecutar consulta
   if (mysqli_query($link,$query))
       $_SESSION["error"]="Perfil modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del perfil";
        
    mysqli_close($link);
    
    header("location:inicioJugador.php");
