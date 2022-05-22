<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="UPDATE jugador 
            SET observaciones='".$_POST["observaciones"]."',
            lesiones='".$_POST["lesiones"]."'
            WHERE id=".$_POST["id"].";";
    
    //Ejecutar consulta
 
   if (mysqli_query($link,$query))
       $_SESSION["exito"]="Jugador modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del jugador";
        
    mysqli_close($link);
    
    header("location:administrarJugadores.php");
