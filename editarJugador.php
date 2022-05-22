<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="UPDATE jugador 
            SET nombre='".$_POST["nombre"]."',
            apellidos='".$_POST["apellidos"]."',
            dni='".$_POST["dni"]."',
            telefono=".$_POST["telefono"].",
            email='".$_POST["email"]."'
            WHERE id=".$_POST["id"].";";
    
    //Ejecutar consulta
 
   if (mysqli_query($link,$query))
       $_SESSION["exito"]="Jugador modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del jugador";
        
    mysqli_close($link);
    
    header("location:jugador.php");
