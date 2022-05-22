<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="UPDATE entrenador 
            SET nombre='".$_POST["nombre"]."',
            apellidos='".$_POST["apellidos"]."',
            dni='".$_POST["dni"]."',
            telefono=".$_POST["telefono"].",
            email='".$_POST["email"]."',
            titulacion='".$_POST["titulacion"]."'
            WHERE id=".$_POST["id"].";";
    
            echo $query;

    //Ejecutar consulta
 
   if (mysqli_query($link,$query))
       $_SESSION["exito"]="Entrenador modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del entrenador";
        
    mysqli_close($link);
    
    header("location:entrenador.php");
