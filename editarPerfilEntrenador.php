<?php
session_start();
include("db_connect.php");

    //Conectamos con la BD
    $link=conectar();
    $pass = $_POST["password"];
    
    $query="UPDATE entrenador 
            SET email='".$_POST["email"]."',
            password='". $hash = hash("sha512", $pass)."'
            WHERE id=".$_SESSION["id_entrenador"].";";
    
    //Ejecutar consulta
   if (mysqli_query($link,$query))
       $_SESSION["error"]="Perfil modificado correctamente";
   else
       $_SESSION["error"]="No se han podido actualizar los datos del perfil";
        
    mysqli_close($link);
    
    header("location:inicioEntrenador.php");
