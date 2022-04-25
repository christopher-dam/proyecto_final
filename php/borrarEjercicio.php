<?php
session_start();
include("conexion_BD.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="DELETE FROM ejercicio WHERE id=".$_GET["id"];
            
    
    //Ejecutar consulta
   if (mysqli_query($link,$query))
        $_SESSION["exito"]="Ejercicio eliminado correctamente";
   else
       $_SESSION["error"]="No se ha podido eliminar el ejercicio";
        
    mysqli_close($link);
    
    header("location:ejercicio.php");
