<?php
session_start();
include("conexion_BD.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="UPDATE jugador 
            SET email='".utf8_decode($_POST["email"])."',
            password='".md5($_POST["password"])."'
            WHERE id=".$_SESSION["id_jugador"].";";
    
    //Ejecutar consulta
   if (mysqli_query($link,$query))
       $_SESSION["error"]="Perfil modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del perfil";
        
    mysqli_close($link);
    
    header("location:inicioJugador.php");
