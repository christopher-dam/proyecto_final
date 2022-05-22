<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    $pass = $_POST["password"];
    
    $query="UPDATE jugador 
            SET email='".$_POST["email"]."',
            nick='" .$_POST["nick"] . "',
            password='".md5($_POST["password"])."'
            WHERE id=".$hash = hash("sha512", $pass) .";";
    
    //Ejecutar consulta
   if (mysqli_query($link,$query))
       $_SESSION["error"]="Perfil modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del perfil";
        
    mysqli_close($link);
    
    header("location:inicioJugador.php");
