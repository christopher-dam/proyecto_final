<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="DELETE FROM equipo WHERE id=" . $_GET["id"];

    //Ejecutar consulta
   if (mysqli_query($link,$query))
        $_SESSION["exito"]="Equipo eliminado correctamente";
   else
       $_SESSION["error"]="No se ha podido borrar el equipo";
        
    mysqli_close($link);
    
    header("location:equipo.php");
