<?php
//Función que se conecta a la BD y devuelve el link
function conectar(){
    if(!($link=mysqli_connect("localhost","root","","club"))){
        $_SESSION["error"]="Imposible conectar con servidor MySQL o la base de datos";
        header("Location:index.php");
        exit;
        }
   return $link;    
}
