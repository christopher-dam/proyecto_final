<?php
//Función que se conecta a la BD y devuelve el link
function conectar(){
    if(!($link=mysqli_connect("localhost","myjustvole","admin123+","justvoley"))){
        $_SESSION["error"]="Imposible conectar con servidor MySQL o la base de datos";
        exit();
        }
   return $link;    
}
?>