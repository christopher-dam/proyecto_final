<?php
session_start();
include("conexion_BD.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="DELETE FROM entrenador WHERE id=" . $_GET["id_entrenador"];

    //Ejecutar consulta
   if (mysqli_query($link,$query))
        $_SESSION["exito"]="Entrenador eliminado correctamente";
   else
       $_SESSION["error"]="No se ha podido borrar el entrenador";
        
    mysqli_close($link);
    
    header("location:entrenador.php");
