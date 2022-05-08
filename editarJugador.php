<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="UPDATE jugador 
            SET nombre='".utf8_decode($_POST["nombre"])."',
            apellidos='".utf8_decode($_POST["apellidos"])."',
            dni='".utf8_decode($_POST["dni"])."',
            telefono=".utf8_decode($_POST["telefono"]).",
            email='".utf8_decode($_POST["email"])."'
            WHERE id=".$_POST["id"].";";
    
    //Ejecutar consulta
 
   if (mysqli_query($link,$query))
       $_SESSION["exito"]="Jugador modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del jugador";
        
    mysqli_close($link);
    
    header("location:jugador.php");
