<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="UPDATE entrenador 
            SET nombre='".utf8_decode($_POST["nombre"])."',
            apellidos='".utf8_decode($_POST["apellidos"])."',
            dni='".utf8_decode($_POST["dni"])."',
            telefono=".utf8_decode($_POST["telefono"]).",
            email='".utf8_decode($_POST["email"])."',
            titulacion='".utf8_decode($_POST["titulacion"])."'
            WHERE id=".$_POST["id"].";";
    
            echo $query;

    //Ejecutar consulta
 
   if (mysqli_query($link,$query))
       $_SESSION["exito"]="Entrenador modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del entrenador";
        
    mysqli_close($link);
    
    header("location:entrenador.php");
