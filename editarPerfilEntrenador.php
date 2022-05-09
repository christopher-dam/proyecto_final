<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    
    $query="UPDATE entrenador 
            SET email='".utf8_decode($_POST["email"])."',
            password='".md5($_POST["password"])."'
            WHERE id=".$_SESSION["id_entrenador"].";";
    
    //Ejecutar consulta
   if (mysqli_query($link,$query))
       $_SESSION["error"]="Perfil modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del perfil";
        
    mysqli_close($link);
    
    header("location:inicioEntrenador.php");
